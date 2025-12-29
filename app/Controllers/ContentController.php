<?php

namespace App\Controllers;

use App\Models\{
    ContentModel,
    ContentMetaModel,
    ContentCategoryModel,
    RegionModel
};

use App\Services\RegionService;

class ContentController extends BaseController
{
    protected ContentModel $content;
    protected ContentMetaModel $meta;
    protected ContentCategoryModel $category;
    protected RegionModel $region;
    protected RegionService $regionService;

    public function __construct()
    {
        $this->content  = new ContentModel();
        $this->meta     = new ContentMetaModel();
        $this->category = new ContentCategoryModel();
        $this->region   = new RegionModel();
        $this->regionService = new RegionService();
    }

    public function index()
    {
        $contents = $this->content
            ->select('contents.*, content_categories.name as category_name')
            ->join('content_categories', 'content_categories.id = contents.category_id')
            ->where('user_id', user_id())
            ->orderBy('created_at', 'DESC')
            ->findAll();

        return view('content/index', [
            'contents' => $contents
        ]);
    }

    public function create()
    {
        return view('content/form', [
            'categories' => $this->category->active()->findAll(),
        ]);
    }

    public function store()
    {
        $provinceCode = (int) $this->request->getPost('province_code');
        $cityCode     = (int) $this->request->getPost('city_code');
        $districtCode = (int) $this->request->getPost('district_code');
        $villageCode  = (int) $this->request->getPost('village_code');

        $provinceName = $this->regionService->getProvinceName($provinceCode);
        $cityName     = $this->regionService->getCityName($cityCode);
        $districtName = $this->regionService->getDistrictName($districtCode);
        $villageName  = $villageCode
            ? $this->regionService->getVillageName($villageCode)
            : null;

        $regionId = $this->region->findOrCreate([
            'province_code'  => $provinceCode,
            'province_name'  => $provinceName,
            'city_code'      => $cityCode,
            'city_name'      => $cityName,
            'district_code'  => $districtCode,
            'district_name'  => $districtName,
            'village_code'   => $villageCode,
            'village_name'   => $villageName,
            'slug'           => url_title(
                $provinceName . ' ' .
                    $cityName . ' ' .
                    $districtName . ' ' .
                    $villageName,
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

    public function edit(int $id)
    {
        $content = $this->content
            ->where('id', $id)
            ->where('user_id', user_id()) // keamanan
            ->first();

        if (!$content) {
            return redirect()->to('/konten')->with('error', 'Konten tidak ditemukan');
        }

        $categories = $this->category->findAll();

        return view('content/form', [
            'content'    => $content,
            'categories' => $categories,

            // ⬇️ untuk auto-select wilayah
            'region' => [
                'province' => $content['province_code'] ?? null,
                'city'     => $content['city_code'] ?? null,
                'district' => $content['district_code'] ?? null,
                'village'  => $content['village_code'] ?? null,
            ],
        ]);
    }


    public function update(int $id)
    {
        $content = $this->content
            ->where('id', $id)
            ->where('user_id', user_id())
            ->first();

        if (!$content) {
            return redirect()->to('/konten')->with('error', 'Konten tidak ditemukan');
        }

        // Ambil kode wilayah
        $provinceCode = (int) $this->request->getPost('province_code');
        $cityCode     = (int) $this->request->getPost('city_code');
        $districtCode = (int) $this->request->getPost('district_code');
        $villageCode  = (int) $this->request->getPost('village_code');

        // Resolve nama wilayah via service
        $provinceName = $this->regionService->getProvinceName($provinceCode);
        $cityName     = $this->regionService->getCityName($cityCode);
        $districtName = $this->regionService->getDistrictName($districtCode);
        $villageName  = $villageCode
            ? $this->regionService->getVillageName($villageCode)
            : null;

        // Find or create region
        $regionId = $this->region->findOrCreate([
            'province_code'  => $provinceCode,
            'province_name'  => $provinceName,
            'city_code'      => $cityCode,
            'city_name'      => $cityName,
            'district_code'  => $districtCode,
            'district_name'  => $districtName,
            'village_code'   => $villageCode,
            'village_name'   => $villageName,
            'slug' => url_title(
                trim("$provinceName $cityName $districtName $villageName"),
                '-',
                true
            ),
        ]);

        // Update konten
        $this->content->update($id, [
            'category_id' => $this->request->getPost('category_id'),
            'region_id'   => $regionId,
            'title'       => $this->request->getPost('title'),
            'slug'        => url_title($this->request->getPost('title'), '-', true),
            'summary'     => $this->request->getPost('summary'),
            'content'     => $this->request->getPost('content'),
            'updated_at'  => date('Y-m-d H:i:s'),
        ]);

        // Meta (kalau ada)
        $this->meta->setMeta($id, $this->request->getPost('meta') ?? []);

        return redirect()->to('/konten')->with('success', 'Konten berhasil diperbarui');
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
