<?php

namespace App\Controllers;

use App\Models\ContentModel;

class DashboardController extends BaseController
{
    protected $content;

    public function __construct()
    {
        $this->content = new ContentModel();
    }

    public function index()
    {
        $userId = user_id();

        // Total konten milik user
        $totalContent = $this->content
            ->where('user_id', $userId)
            ->countAllResults();

        // Konten published
        $published = $this->content
            ->where('user_id', $userId)
            ->where('status', 'published')
            ->countAllResults();

        // Khusus admin: konten pending
        $pending = null;
        if (in_groups('administrator')) {
            $pending = $this->content
                ->where('status', 'draft')
                ->countAllResults();
        }

        return view('admin/dashboard', [
            'totalContent' => $totalContent,
            'published'    => $published,
            'pending'      => $pending,

            // breadcrumb (UX)
            'breadcrumb' => [
                ['label' => 'Dashboard', 'url' => null],
            ],
        ]);
    }
}
