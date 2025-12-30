<?php

namespace App\Controllers;

class UploadController extends BaseController
{
    public function ckeditor()
    {
        $file = $this->request->getFile('upload');

        if ($file && $file->isValid()) {
            $name = $file->getRandomName();
            $file->move('uploads/ckeditor', $name);

            return $this->response->setJSON([
                'url' => base_url('uploads/ckeditor/' . $name)
            ]);
        }

        return $this->response->setStatusCode(400);
    }
}