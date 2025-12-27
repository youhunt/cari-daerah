<?php

namespace App\Services;

use CodeIgniter\HTTP\CURLRequest;

class RegionService
{
    protected string $baseUrl = 'https://api-wilayah.belajardisiniaja.com';
    protected string $token;

    public function __construct()
    {
        $this->token = getenv('WILAYAH_API_TOKEN');
    }

    protected function request(string $uri): array
    {
        /** @var CURLRequest $client */
        $client = service('curlrequest');

        $response = $client->request('GET', $this->baseUrl . $uri, [
            'headers' => [
                'Content-Type'  => 'application/json',
                'Authorization' => 'Bearer ' . $this->token,
            ],
            'http_errors' => false,
            'timeout' => 30,
        ]);

        if ($response->getStatusCode() !== 200) {
            return [];
        }

        return json_decode($response->getBody(), true) ?? [];
    }

    // =========================
    // PUBLIC METHODS
    // =========================

    public function provinsi(): array
    {
        return $this->request('/provinsi');
    }

    public function provinsiById(int $id): array
    {
        return $this->request("/provinsi/{$id}");
    }

    public function kabupatenByProvinsi(int $provinsiId): array
    {
        return $this->request("/kabupaten/getByProvinsi/{$provinsiId}");
    }

    public function kecamatanByKabupaten(int $kabupatenId): array
    {
        return $this->request("/kecamatan/getByKabupaten/{$kabupatenId}");
    }

    public function desaByKecamatan(int $kecamatanId): array
    {
        return $this->request("/desa/getByKecamatan/{$kecamatanId}");
    }
}
