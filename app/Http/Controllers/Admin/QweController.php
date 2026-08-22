<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Qwes;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class QweController extends Controller
{
    public function index(): View
    {
        return view('admin.qwes.index', ['qwes' => Qwes::query()->latest()->get()]);
    }

    public function create(): View
    {
        return view('admin.qwes.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'qwe' => ['required', 'string', 'max:500'],
            'ans' => ['required', 'string', 'max:2000'],
        ]);

        Qwes::create($validated);

        return redirect()->route('admin.qwes.index')->with('flash_message', 'FAQ added successfully.');
    }

    public function show(string $id): View
    {
        return view('admin.qwes.show', ['qwes' => Qwes::findOrFail($id)]);
    }

    public function edit(string $id): View
    {
        return view('admin.qwes.edit', ['qwes' => Qwes::findOrFail($id)]);
    }

    public function update(Request $request, string $id): RedirectResponse
    {
        $qwes = Qwes::findOrFail($id);
        $validated = $request->validate([
            'qwe' => ['required', 'string', 'max:500'],
            'ans' => ['required', 'string', 'max:2000'],
        ]);

        $qwes->update($validated);

        return redirect()->route('admin.qwes.index')->with('flash_message', 'FAQ updated successfully.');
    }

    public function destroy(string $id): RedirectResponse
    {
        Qwes::findOrFail($id)->delete();

        return redirect()->route('admin.qwes.index')->with('flash_message', 'FAQ deleted successfully.');
    }
}
