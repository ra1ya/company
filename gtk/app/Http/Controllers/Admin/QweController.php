<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Qwes;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class QweController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index():View
    {
    $qwes=Qwes::all();
    return view('admin.qwes.index')->with('qwes',$qwes);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.qwes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $input = $request->all();
        Qwes::create($input);
        return redirect('admin/qwes')->with('flash_message', 'Qwes Addedd!');
       
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
        $qwes = Qwes::find($id);
        return view('admin.qwes.show')->with('qwes', $qwes);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $qwes = Qwes::find($id);
        return view('admin.qwes.edit')->with('qwes', $qwes);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $qwes = Qwes::find($id);
        $input = $request->all();
        $qwes->update($input);
        return redirect('admin/qwes')->with('flash_message', 'qwes Updated!'); 
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Qwes::destroy($id);
        return redirect('admin/qwes')->with('flash_message', 'qwes deleted!'); 
    }
}
