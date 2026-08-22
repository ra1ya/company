<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Custom;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class CustomController extends Controller
{
    public function index(): View
    {
        return view('admin.custom.index', ['custom' => Custom::query()->latest()->get()]);
    }

    public function create(): View
    {
        return view('admin.custom.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'img' => ['required', 'image', 'mimes:svg,png,jpg,jpeg,webp', 'max:2048'],
        ]);

        $validated['img'] = $request->file('img')->store('uploads/clients', 'public');
        Custom::create($validated);

        return redirect()->route('admin.custom.index')->with('flash_message', 'Client image added successfully.');
    }

    public function show(string $id): View
    {
        return view('admin.custom.show', ['custom' => Custom::findOrFail($id)]);
    }

    public function edit(string $id): View
    {
        return view('admin.custom.edit', ['custom' => Custom::findOrFail($id)]);
    }

    public function update(Request $request, string $id): RedirectResponse
    {
        $custom = Custom::findOrFail($id);
        $request->validate([
            'img' => ['nullable', 'image', 'mimes:svg,png,jpg,jpeg,webp', 'max:2048'],
        ]);

        if ($request->hasFile('img')) {
            $oldImage = $custom->img;
            $custom->img = $request->file('img')->store('uploads/clients', 'public');
            $custom->save();

            if ($oldImage) {
                Storage::disk('public')->delete($oldImage);
            }
        }

        return redirect()->route('admin.custom.index')->with('flash_message', 'Client image updated successfully.');
    }

    public function destroy(string $id): RedirectResponse
    {
        $custom = Custom::findOrFail($id);
        if ($custom->img) {
            Storage::disk('public')->delete($custom->img);
        }
        $custom->delete();

        return redirect()->route('admin.custom.index')->with('flash_message', 'Client image deleted successfully.');
    }
}
