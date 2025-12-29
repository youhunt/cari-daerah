<?php

namespace App\Controllers;

use App\Models\ContentModel;
use App\Models\RegionModel;

class PublicController extends BaseController
{
    protected $content;
    protected $region;

    public function __construct()
    {
        $this->content = new ContentModel();
        $this->region  = new RegionModel();
    }

    // LIST PUBLIK
    public function index()
    {
        $contents = $this->content
            ->select('contents.*, regions.province_name, regions.city_name, regions.district_name')
            ->join('regions', 'regions.id = contents.region_id', 'left')
            ->where('contents.status', 'published')
            ->orderBy('contents.created_at', 'DESC')
            ->paginate(10);

        return view('public/index', [
            'contents' => $contents,
            'pager'    => $this->content->pager,
            'title'    => 'Cari Cerita Daerah, Kuliner & Wisata Indonesia',
        ]);
    }

    // DETAIL PUBLIK (SHOW)
    public function show(string $slug)
    {
        $content = $this->content
            ->select('contents.*, regions.*')
            ->join('regions', 'regions.id = contents.region_id', 'left')
            ->where('contents.slug', $slug)
            ->where('contents.status', 'published')
            ->first();

        if (!$content) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        // increment views (opsional)
        $this->content->where('id', $content['id'])->increment('views');

        return view('public/show', [
            'content' => $content,
            'title'   => $content['title'] . ' | CariDaerah',
            'meta'    => [
                'description' => $content['summary'],
            ],
        ]);
    }
}
