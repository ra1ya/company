<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\About;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AboutController extends Controller
{
    public function index(): View
    {
        return view('admin.about.index', ['about' => About::query()->latest()->get()]);
    }

    public function create(): View
    {
        return view('admin.about.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'des_ar' => ['required', 'string', 'max:5000'],
            'des_en' => ['required', 'string', 'max:5000'],
        ]);

        About::create($validated);

        return redirect()->route('admin.about.index')->with('flash_message', 'Company profile added successfully.');
    }

    public function show(string $id): View
    {
        return view('admin.about.show', ['about' => About::findOrFail($id)]);
    }

    public function edit(string $id): View
    {
        return view('admin.about.edit', ['about' => About::findOrFail($id)]);
    }

    public function update(Request $request, string $id): RedirectResponse
    {
        $about = About::findOrFail($id);
        $validated = $request->validate([
            'des_ar' => ['required', 'string', 'max:5000'],
            'des_en' => ['required', 'string', 'max:5000'],
        ]);

        $about->update($validated);

        return redirect()->route('admin.about.index')->with('flash_message', 'Company profile updated successfully.');
    }

    public function destroy(string $id): RedirectResponse
    {
        About::findOrFail($id)->delete();

        return redirect()->route('admin.about.index')->with('flash_message', 'Company profile deleted successfully.');
    }
}
