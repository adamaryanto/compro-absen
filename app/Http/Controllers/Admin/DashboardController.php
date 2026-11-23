<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Models\Highlight;
use App\Models\ProductModule;
use App\Models\Setting;
use App\Models\Stat;
use App\Models\Step;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $counts = [
            'keunggulan' => Highlight::count(),
            'modul' => ProductModule::count(),
            'langkah' => Step::count(),
            'faq' => Faq::count(),
            'statistik' => Stat::count(),
        ];

        $updatedAt = collect([
            Setting::max('updated_at'),
            Highlight::max('updated_at'),
            ProductModule::max('updated_at'),
            Step::max('updated_at'),
            Faq::max('updated_at'),
            Stat::max('updated_at'),
        ])->filter()->max();

        return view('admin.dashboard', compact('counts', 'updatedAt'));
    }
}
