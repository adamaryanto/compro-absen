<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\Highlight;
use App\Models\ProductModule;
use App\Models\Stat;
use App\Models\Step;

class SiteController extends Controller
{
    public function index()
    {
        $highlights = Highlight::active()->get();
        $modules = ProductModule::active()->get();
        $steps = Step::active()->get();
        $stats = Stat::active()->get();
        $faqs = Faq::active()->get();

        return view('site.home', compact('highlights', 'modules', 'steps', 'stats', 'faqs'));
    }
}
