<?php

namespace App\Controllers;

use App\Models\{
    ContentModel,
    ContentMetaModel,
    ContentCategoryModel,
    RegionModel
};

class ContentController extends BaseController
{
    protected ContentModel $content;
    protected ContentMetaModel $meta;
    protected ContentCategoryModel $category;
    protected RegionModel $region;

    public function __construct()
    {
        $this->content  = new ContentModel();
        $this->meta     = new ContentMetaModel();
        $this->category = new ContentCategoryModel();
        $this->region   = new RegionModel();
    }

    public function index()
    {
        $userId = user_id();

        $data['contents'] = $this->content
            ->where('user_id', $userId)
            ->orderBy('created_at', 'DESC')
            ->findAll();

        return view('content/index', $data);
    }

    public function create()
    {
        return view('content/form', [
            'categories' => $this->category->active()->findAll(),
        ]);
    }

    public function store()
    {
        $regionId = $this->region->findOrCreate([
            'province_code'  => $this->request->getPost('province_code'),
            'province_name'  => $this->request->getPost('province_name'),
            'city_code'      => $this->request->getPost('city_code'),
            'city_name'      => $this->request->getPost('city_name'),
            'district_code'  => $this->request->getPost('district_code'),
            'district_name'  => $this->request->getPost('district_name'),
            'village_code'   => $this->request->getPost('village_code'),
            'village_name'   => $this->request->getPost('village_name'),
            'slug'           => url_title(
                $this->request->getPost('province_name') . ' ' .
                    $this->request->getPost('city_name') . ' ' .
                    $this->request->getPost('district_name') . ' ' .
                    $this->request->getPost('village_name'),
                '-',
                true
            ),
        ]);

        $status = in_groups(['administrator', 'korespondensi'])
            ? 'published'
            : 'draft';

        $contentId = $this->content->insert([
            'user_id'     => user_id(),
            'category_id' => $this->request->getPost('category_id'),
            'region_id'   => $regionId,
            'title'       => $this->request->getPost('title'),
            'slug'        => url_title($this->request->getPost('title'), '-', true),
            'summary'     => $this->request->getPost('summary'),
            'content'     => $this->request->getPost('content'),
            'status'      => $status,
        ]);

        $this->meta->setMeta($contentId, $this->request->getPost('meta') ?? []);

        return redirect()->to('/konten')->with('success', 'Konten berhasil disimpan');
    }

    public function edit($id)
    {
        $content = $this->content->find($id);

        if (!$content || $content['user_id'] !== user_id()) {
            throw new \CodeIgniter\Exceptions\PageForbiddenException();
        }

        return view('content/form', [
            'content'    => $content,
            'meta'       => $this->meta->getMeta($id),
            'categories' => $this->category->active()->findAll(),
        ]);
    }

    public function update($id)
    {
        $this->content->update($id, [
            'title'   => $this->request->getPost('title'),
            'summary' => $this->request->getPost('summary'),
            'content' => $this->request->getPost('content'),
        ]);

        $this->meta->setMeta($id, $this->request->getPost('meta') ?? []);

        return redirect()->to('/konten')->with('success', 'Konten diperbarui');
    }

    public function show($slug)
    {
        $content = $this->content
            ->published()
            ->where('slug', $slug)
            ->first();

        if (!$content) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        }

        $this->content->incrementViews($content['id']);

        return view('content/show', [
            'content' => $content,
            'meta'    => $this->meta->getMeta($content['id']),
        ]);
    }
}
