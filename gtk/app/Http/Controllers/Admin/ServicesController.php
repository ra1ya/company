<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use App\Models\Service;
use Illuminate\Support\Carbon;


use Illuminate\Http\Request;

class ServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index():View
    {
        $services = Service::all();
        return view('admin.services.index')->with('services',$services);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.services.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'icon' => 'required|image|mimes:svg,png,jpg,jpeg,webp|max:2048',
        ]);
    
        $path = null;
    
        if ($request->hasFile('icon')) {
            $path = $request->file('icon')->store('uploads/services', 'public');
        }
    
        Service::create([
            'name' => $validated['name'],
            'icon' => $path,
        ]);
    
        return redirect('admin/services')->with('flash_message', 'تمت إضافة الخدمة بنجاح!');
    }
    
    
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $services = Service::find($id);
        return view('admin.services.show')->with('services', $services);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $services = Service::find($id);
        return view('admin.services.edit')->with('services', $services);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $service = Service::findOrFail($id);
    
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'nullable|image|mimes:png,jpg,jpeg,webp,svg|max:2048',
        ]);
    
        // تحديث الاسم
        $service->name = $validated['name'];
    
        // إذا تم رفع صورة جديدة
        if ($request->hasFile('icon')) {
            $path = $request->file('icon')->store('uploads/services', 'public');
            $service->icon = $path;
        }
    
        $service->save();
    
        return redirect('admin/services')->with('success', 'تم التحديث بنجاح');
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Service::destroy($id);
        return redirect('admin/services')->with('flash_message', 'services deleted!'); 
    }
}
