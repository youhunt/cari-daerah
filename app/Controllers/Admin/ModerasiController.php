<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ContentModel;

class ModerasiController extends BaseController
{
    public function index()
    {
        $model = new ContentModel();

        return view('admin/moderasi', [
            'contents' => $model
                ->whereIn('status', ['draft', 'flagged'])
                ->orderBy('created_at', 'DESC')
                ->findAll(),
            'breadcrumb' => [
                ['label' => 'Dashboard', 'url' => '/dashboard'],
                ['label' => 'Moderasi', 'url' => null],
            ],
        ]);
    }

    public function update($id)
    {
        $status = $this->request->getPost('status');

        (new ContentModel())->update($id, [
            'status' => $status
        ]);

        return redirect()->back()->with('success', 'Status diperbarui');
    }
}
