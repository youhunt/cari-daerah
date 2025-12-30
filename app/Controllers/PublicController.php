<?php

namespace App\Controllers;

use App\Models\ContentModel;
use App\Models\RegionModel;
use App\Models\PhotoModel;
use \Myth\Auth\Models\UserModel;

class PublicController extends BaseController
{
    protected $content;
    protected $region;
    protected $photo;
    protected $userModel;

    public function __construct()
    {
        $this->content = new ContentModel();
        $this->region  = new RegionModel();
        $this->photo   = new PhotoModel();
        $this->userModel = new UserModel();
    }

    // LIST PUBLIK
    public function index()
    {
        $keyword   = $this->request->getGet('q');
        $category  = $this->request->getGet('kategori');
        $province  = $this->request->getGet('provinsi');

        $builder = $this->content
            ->select('contents.*, content_categories.name as category_name,
                  regions.province_name, regions.city_name, photos.path as hero_image,
                  user_profiles.full_name, users.username')
            ->join('content_categories', 'content_categories.id = contents.category_id')
            ->join('regions', 'regions.id = contents.region_id')
            ->join('photos', 'photos.content_id = contents.id AND photos.is_primary = 1', 'left')
            ->join('users', 'users.id = contents.user_id', 'left')
            ->join('user_profiles', 'user_profiles.user_id = contents.user_id', 'left')
            ->where('contents.status', 'published');

        if ($keyword) {
            $builder->groupStart()
                ->like('contents.title', $keyword)
                ->orLike('contents.summary', $keyword)
                ->groupEnd();
        }

        if ($category) {
            $builder->where('content_categories.slug', $category);
        }

        if ($province) {
            $builder->where('regions.province_code', $province);
        }

        $contents = $builder->paginate(10);

        return view('public/index', [
            'contents' => $contents,
            'pager'    => $this->content->pager,
            'title'    => 'Cari Daerah, Kuliner & Wisata Indonesia',
            'meta'     => [
                'description' =>
                'Cari daerah, cari kuliner, cari wisata, dan cerita lokal Indonesia.',
            ],
        ]);
    }

    // DETAIL PUBLIK (SHOW)
    public function show(string $slug)
    {
        $content = $this->content
            ->select('contents.*, content_categories.name as category_name,
                  regions.*, user_profiles.full_name, users.username')
            ->join('content_categories', 'content_categories.id = contents.category_id')
            ->join('regions', 'regions.id = contents.region_id')
            ->join('photos', 'photos.content_id = contents.id AND photos.is_primary = 1', 'left')
            ->join('users', 'users.id = contents.user_id', 'left')
            ->join('user_profiles', 'user_profiles.user_id = contents.user_id', 'left')
            ->where('contents.slug', $slug)
            ->where('contents.status', 'published')
            ->first();

        $heroPhoto = $this->photo->primary($content['id']);

        if (! $content) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $this->content->where('id', $content['id'])->increment('views');

        return view('public/show', [
            'content' => $content,
            'title'   => $content['title'] . ' | CariDaerah',
            'meta'    => [
                'description' => $content['summary'],
            ],
            'heroPhoto' => $heroPhoto,
        ]);
    }

    public function author($username)
    {
        $user = $this->userModel
            ->where('username', $username)
            ->first();

        $contents = $this->content
            ->where('user_id', $user['id'])
            ->where('status', 'published')
            ->findAll();

        return view('public/author', [
            'author' => $user,
            'contents' => $contents,
            'title' => 'Profil Penulis ' . $user['full_name'],
        ]);
    }

}
