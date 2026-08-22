<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Custom;
use App\Models\News;
use App\Models\Qwes;
use App\Models\Say;
use App\Models\Service;
use App\Models\Team;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        return view('in', [
            'services' => Service::query()->latest()->get(),
            'about' => About::query()->latest()->first(),
            'qwes' => Qwes::query()->latest()->get(),
            'news' => News::query()->latest()->get(),
            'custom' => Custom::query()->latest()->get(),
            'team' => Team::query()->latest()->get(),
            'say' => Say::query()->latest()->get(),
        ]);
    }
}
