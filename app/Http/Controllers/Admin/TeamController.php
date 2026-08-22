<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Team;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index():View
    {
    $team=Team::all();
    return view('admin.team.index')->with('team',$team);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.team.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        

        $request->validate([
            'name' => 'required|string',
            'des' => 'required|string',
            'code' => 'required|string',
            'img' => 'required|image|mimes:svg,png,jpg,jpeg,webp|max:2048',
           
        ]);
        if ($request->hasFile('img')) {
            $path = $request->file('img')->store('uploads/team', 'public');
            $validated['img'] = $path;
        }
      
    
        Team::create([
            'name' => $request->name,
            'des' => $request->des,
            'code' => $request->code,
            'img' => $path,
           
        ]);
    
        return redirect('admin/team')->with('flash_message', 'team Added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
        $team = Team::find($id);
        return view('admin.team.show')->with('team', $team);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $team = Team::find($id);
        return view('admin.team.edit')->with('team', $team);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'des' => 'required|string|max:255',
        'code' => 'required|string|max:255',
        'img' => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:2048',
    ]);

    $team = Team::findOrFail($id);

    // تحديث البيانات العامة
    $team->name = $validated['name'];
    $team->des = $validated['des'];
    $team->code = $validated['code'];

    // فقط إذا تم رفع صورة جديدة
    if ($request->hasFile('img')) {
        $path = $request->file('img')->store('uploads/team', 'public');
        $team->img = $path;
    }

    $team->save();

    return redirect('admin/team')->with('success', 'تم التحديث بنجاح');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Team::destroy($id);
        return redirect('admin/team')->with('flash_message', 'team deleted!'); 
    }
}
