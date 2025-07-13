<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Custom;
use App\Models\News;
use App\Models\Qwes;
use App\Models\Say;
use Illuminate\Contracts\View\View;
use App\Models\Service;
use App\Models\Team;
use Illuminate\Support\Carbon;


use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index():View
    {
        $services = Service::all();
        $about = About::latest()->first(); // نأتي بآخر نبذة مضافة
       $qwes = Qwes::all();
       $news = News::all();
       $custom= Custom::all();
       $team=Team::all();
       $say=Say::all();
        return view('in', compact('services', 'about' , 'qwes','news','custom','team','say'));
    }

}
