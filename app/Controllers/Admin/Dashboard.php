<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ContentModel;

class Dashboard extends BaseController
{
    public function index()
    {
        $content = new ContentModel();

        return view('admin/dashboard', [
            'pending'  => $content->where('status', 'draft')->countAllResults(),
            'flagged'  => $content->where('status', 'flagged')->countAllResults(),
            'published' => $content->whereIn('status', ['published', 'verified'])->countAllResults(),
        ]);
    }
}
