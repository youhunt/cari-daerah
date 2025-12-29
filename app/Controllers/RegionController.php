<?php

namespace App\Controllers;

use App\Services\RegionService;
use CodeIgniter\Controller;

class RegionController extends Controller
{
    protected RegionService $region;

    public function __construct()
    {
        $this->region = new RegionService();
    }

    public function provinsi()
    {
        return $this->response->setJSON(
            $this->region->provinsi()
        );
    }

    public function kabupaten($provinsiId)
    {
        return $this->response->setJSON(
            $this->region->kabupatenByProvinsi((int) $provinsiId)
        );
    }

    public function kecamatan($kabupatenId)
    {
        return $this->response->setJSON(
            $this->region->kecamatanByKabupaten((int) $kabupatenId)
        );
    }

    public function desa($kecamatanId)
    {
        return $this->response->setJSON(
            $this->region->desaByKecamatan((int) $kecamatanId)
        );
    }
}
