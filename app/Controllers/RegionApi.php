<?php

namespace App\Controllers;

use App\Services\RegionService;

class RegionApi extends BaseController
{
    public function provinsi()
    {
        $service = new RegionService();
        return $this->response->setJSON($service->provinsi());
    }

    public function kabupaten($provinsiId)
    {
        $service = new RegionService();
        return $this->response->setJSON(
            $service->kabupatenByProvinsi($provinsiId)
        );
    }

    public function kecamatan($kabupatenId)
    {
        $service = new RegionService();
        return $this->response->setJSON(
            $service->kecamatanByKabupaten($kabupatenId)
        );
    }

    public function desa($kecamatanId)
    {
        $service = new RegionService();
        return $this->response->setJSON(
            $service->desaByKecamatan($kecamatanId)
        );
    }
}
