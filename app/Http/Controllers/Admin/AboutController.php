<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\About;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $about = About::all();
        return view('admin.about.index')->with('about',$about);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.about.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->all();
        About::create($input);
        return redirect('admin/about')->with('flash_message', 'About Addedd!');
       
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $about = About::find($id);
        return view('admin.about.show')->with('about', $about);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $about = About::find($id);
        return view('admin.about.edit')->with('about', $about);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $about = About::find($id);
        $input = $request->all();
        $about->update($input);
        return redirect('admin/about')->with('flash_message', 'about Updated!'); 
    
      
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        About::destroy($id);
        return redirect('admin/about')->with('flash_message', 'about deleted!'); 
    }
}
