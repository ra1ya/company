<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Custom;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class customController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index():View
    {
    $custom=Custom::all();
    return view('admin.custom.index')->with('custom',$custom);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.custom.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        

        $request->validate([
            
            'img' => 'required|image|mimes:svg,png,jpg,jpeg,webp|max:2048',
          
        ]);
        if ($request->hasFile('img')) {
            $path = $request->file('img')->store('uploads/news', 'public');
            $validated['img'] = $path;
        }
      
    
        Custom::create([
            
            'img' => $path,
            
        ]);
    
        return redirect('admin/custom')->with('flash_message', 'Custom Added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
        $custom = Custom::find($id);
        return view('admin.custom.show')->with('custom', $custom);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $custom = Custom::find($id);
        return view('admin.custom.edit')->with('custom', $custom);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        
        $custom = Custom::findOrFail($id);
    
        $validated = $request->validate([
    
            'img' => 'nullable|image|mimes:png,jpg,jpeg,webp,svg|max:2048',
        
        ]);
    
        // تحديث الاسم
        
      //  $custom->img   =  $validated['img'];
    
        // إذا تم رفع صورة جديدة
        if ($request->hasFile('img')) {
            $path = $request->file('img')->store('uploads/news', 'public');
            $custom->img = $path;
        }
    
        $custom->save();
    
        return redirect('admin/custom')->with('success', 'تم التحديث بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Custom::destroy($id);
        return redirect('admin/custom')->with('flash_message', 'custom deleted!'); 
    }
}
