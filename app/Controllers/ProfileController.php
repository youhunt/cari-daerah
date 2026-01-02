<?php

namespace App\Controllers;

use App\Models\UserProfilesModel;

class ProfileController extends BaseController
{
    protected $profileModel;

    public function __construct()
    {
        $this->profileModel = new UserProfilesModel();
    }

    public function index()
    {
        $user = user();

        $profile = $this->profileModel->find($user->id);

        return view('profile/index', [
            'title' => 'Profil Saya',
            'profile' => $profile,
        ]);
    }

    public function update()
    {
        $user = user();

        $data = [
            'user_id'   => $user->id,
            'full_name' => trim($this->request->getPost('full_name')),
        ];

        $existing = $this->profileModel->find($user->id);

        if ($existing) {
            $this->profileModel->update($user->id, $data);
        } else {
            $this->profileModel->insert($data);
        }

        return redirect()->to('/profile')->with('success', 'Profil berhasil diperbarui');
    }
}
