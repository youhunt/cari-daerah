<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

use \Myth\Auth\Models\UserModel;
use \Myth\Auth\Password;
use \Myth\Auth\Entities\User;
use \Myth\Auth\Models\GroupModel;
use \Myth\Auth\Config\Auth as AuthConfig;

class UserController extends BaseController
{
    protected $auth;

    /**
     * @var AuthConfig
     */
    protected $config;

    public function __construct()
    {
        $this->config = config('Auth');
        $this->auth = service('authentication');
    }

    public function index()
    {
        $userModel = new UserModel();
        $data['users'] = $userModel->findAll();

        $groupModel = new GroupModel();

        foreach ($data['users'] as $row) {
            if ($row->id !== '1') {
                $dataRow['group'] = $groupModel->getGroupsForUser($row->id);
                $dataRow['row'] = $row;
                $data['row' . $row->id] = view('admin/users/row', $dataRow);
            }
        }

        $data['groups'] = $groupModel->findAll();

        $data['title'] = 'Users';
        $data['breadcrumb'] = [
            ['label' => 'Dashboard', 'url' => '/dashboard'],
            ['label' => 'Pengguna', 'url' => '/admin/users'],
            ['label' => 'Daftar Pengguna', 'url' => null],
        ];
        return view('admin/users/index', $data);
    }

    public function activate()
    {
        $userId = $this->request->getVar('id');
        if (($userId == null) || ($userId === '1') || $userId === '2') {
            return redirect()->to(base_url('/admin/users/index'));
        } else {
            $userModel = new UserModel();

            $data = [
                'activate_hash' => null,
                'active' => $this->request->getVar('active') == '0' || '' ? '1' : '0',
            ];
            $userModel->update($userId, $data);

            return redirect()->to(base_url('/admin/users/index'));
        }
    }

    public function changePassword($id = null)
    {
        if (($id == null) || ($id === '1')) {
            return redirect()->to(base_url('/admin/users/index'));
        } else {
            $groupModel = new GroupModel();
            $group = $groupModel->getGroupsForUser($id);
            if ($group[0]['name'] === 'administrator') {
                return redirect()->to(base_url('/admin/users/index'));
            } else {
                $data = [
                    'id' => $id,
                    'title' => 'Update Password',
                ];
                $data['breadcrumb'] = [
                    ['label' => 'Dashboard', 'url' => '/dashboard'],
                    ['label' => 'Pengguna', 'url' => '/admin/users'],
                    ['label' => 'Ganti Password', 'url' => null],
                ];
                return view('admin/users/set_password', $data);
            }
        }
    }

    public function setPassword()
    {
        $id = $this->request->getVar('id');
        if (($id == null) || ($id === 1)) {
            return redirect()->to(base_url('/admin/users/index'));
        }
        $rules = [
            'password'     => 'required|strong_password',
            'pass_confirm' => 'required|matches[password]',
        ];

        if (! $this->validate($rules)) {
            $data = [
                'id' => $id,
                'title' => 'Update Password',
                'validation' => $this->validator,
            ];
            $data['breadcrumb'] = [
                ['label' => 'Dashboard', 'url' => '/dashboard'],
                ['label' => 'Pengguna', 'url' => '/admin/users'],
                ['label' => 'Set Password', 'url' => null],
            ];

            return view('admin/users/set_password', $data);
        } else {
            $userModel = new UserModel();
            $data = [
                'password_hash' => Password::hash($this->request->getVar('password')),
                'reset_hash' => null,
                'reset_at' => null,
                'reset_expires' => null,
            ];
            $userModel->update($this->request->getVar('id'), $data);

            return redirect()->to(base_url('/admin/users/index'));
        }
    }

    public function changeGroup()
    {
        $userId = $this->request->getVar('id');

        if (($userId == null) || ($userId === '1') || $userId === '2') {
            return redirect()->to(base_url('/admin/users/index'));
        }

        $groupId = $this->request->getVar('group');

        $groupModel = new GroupModel();
        $groupModel->removeUserFromAllGroups(intval($userId));

        $groupModel->addUserToGroup(intval($userId), intval($groupId));

        return redirect()->to(base_url('/admin/users/index'));
    }

    public function add()
    {

        $data = [
            'title' => 'Add Users',
            'config' => $this->config,
            'breadcrumb' => [
                ['label' => 'Dashboard', 'url' => '/dashboard'],
                ['label' => 'Pengguna', 'url' => '/admin/users'],
                ['label' => 'Tambah Pengguna', 'url' => null],
            ],
        ];

        return view('admin/users/add', $data);
    }

    public function save()
    {
        $users = model(UserModel::class);

        $rules = [
            'username' => 'required|alpha_numeric_space|min_length[3]|max_length[30]|is_unique[users.username]',
            'email'    => 'required|valid_email|is_unique[users.email]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $rules = [
            'password'     => 'required|strong_password',
            'pass_confirm' => 'required|matches[password]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Save the user
        $allowedPostFields = array_merge(['password'], $this->config->validFields, $this->config->personalFields);
        $user = new User($this->request->getPost($allowedPostFields));

        $this->config->requireActivation === null ? $user->activate() : $user->generateActivateHash();

        // Ensure default group gets assigned if set
        if (! empty($this->config->defaultUserGroup)) {
            $users = $users->withGroup($this->config->defaultUserGroup);
        }

        if (! $users->save($user)) {
            return redirect()->back()->withInput()->with('errors', $users->errors());
        }

        if ($this->config->requireActivation !== null) {
            $activator = service('activator');
            $sent = $activator->send($user);

            if (! $sent) {
                return redirect()->back()->withInput()->with('error', $activator->error() ?? lang('Auth.unknownError'));
            }

            // Success!
            return redirect()->to(base_url('/admin/users/index'));
        }

        // Success!
        return redirect()->to(base_url('/admin/users/index'));
    }
}
