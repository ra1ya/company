<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Say;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class SayController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index():View
    {
    $say=Say::all();
    return view('admin.say.index')->with('say',$say);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.say.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        

        $request->validate([
            'name' => 'required|string',
            'des' => 'required|string',
            'say' => 'required|string',
            'img' => 'required|image|mimes:svg,png,jpg,jpeg,webp|max:2048',
           
        ]);
        if ($request->hasFile('img')) {
            $path = $request->file('img')->store('uploads/say', 'public');
            $validated['img'] = $path;
        }
      
    
        Say::create([
            'name' => $request->name,
            'des' => $request->des,
            'say' => $request->say,
            'img' => $path,
           
        ]);
    
        return redirect('admin/say')->with('flash_message', 'say Added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
        $say = Say::find($id);
        return view('admin.say.show')->with('say', $say);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $say = Say::find($id);
        return view('admin.say.edit')->with('say', $say);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'des' => 'required|string|max:255',
        'say' => 'required|string|max:255',
        'img' => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:2048',
    ]);

    $say = Say::findOrFail($id);

    // تحديث البيانات العامة
    $say->name = $validated['name'];
    $say->des = $validated['des'];
    $say->say = $validated['say'];

    // فقط إذا تم رفع صورة جديدة
    if ($request->hasFile('img')) {
        $path = $request->file('img')->store('uploads/say', 'public');
        $say->img = $path;
    }

    $say->save();

    return redirect('admin/say')->with('success', 'تم التحديث بنجاح');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Say::destroy($id);
        return redirect('admin/say')->with('flash_message', 'say deleted!'); 
    }
}
