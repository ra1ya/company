<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index():View
    {
    $news=News::all();
    return view('admin.news.index')->with('news',$news);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.news.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        

        $request->validate([
            'title' => 'required|string',
            'img' => 'required|image|mimes:svg,png,jpg,jpeg,webp|max:2048',
            'det' => 'required|string',
        ]);
        if ($request->hasFile('img')) {
            $path = $request->file('img')->store('uploads/news', 'public');
            $validated['img'] = $path;
        }
      
    
        News::create([
            'title' => $request->title,
            'img' => $path,
            'det' => $request->det,
        ]);
    
        return redirect('admin/news')->with('flash_message', 'News Added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
        $news = News::find($id);
        return view('admin.news.show')->with('news', $news);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $news = News::find($id);
        return view('admin.news.edit')->with('news', $news);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        
        $news = News::findOrFail($id);
    
        $validated = $request->validate([
            'title' => 'required|string',
            'img' => 'nullable|image|mimes:png,jpg,jpeg,webp,svg|max:2048',
            'det' => 'required|string',
        ]);
    
        // تحديث الاسم
        $news->title = $validated['title'];
        $news->img   =  $validated['img'];
        $news->det   =  $validated['det'];
        // إذا تم رفع صورة جديدة
        if ($request->hasFile('img')) {
            $path = $request->file('img')->store('uploads/news', 'public');
            $news->img = $path;
        }
    
        $news->save();
    
        return redirect('admin/news')->with('success', 'تم التحديث بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        News::destroy($id);
        return redirect('admin/news')->with('flash_message', 'news deleted!'); 
    }
}
