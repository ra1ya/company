<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ServicesController extends Controller
{
    public function index(): View
    {
        return view('admin.services.index', ['services' => Service::query()->latest()->get()]);
    }

    public function create(): View
    {
        return view('admin.services.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'icon' => ['required', 'image', 'mimes:svg,png,jpg,jpeg,webp', 'max:2048'],
        ]);

        $validated['icon'] = $request->file('icon')->store('uploads/services', 'public');
        Service::create($validated);

        return redirect()->route('admin.services.index')->with('flash_message', 'Service added successfully.');
    }

    public function show(string $id): View
    {
        return view('admin.services.show', ['services' => Service::findOrFail($id)]);
    }

    public function edit(string $id): View
    {
        return view('admin.services.edit', ['services' => Service::findOrFail($id)]);
    }

    public function update(Request $request, string $id): RedirectResponse
    {
        $service = Service::findOrFail($id);
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'icon' => ['nullable', 'image', 'mimes:svg,png,jpg,jpeg,webp', 'max:2048'],
        ]);

        $service->name = $validated['name'];

        if ($request->hasFile('icon')) {
            $oldIcon = $service->icon;
            $service->icon = $request->file('icon')->store('uploads/services', 'public');
            if ($oldIcon) {
                Storage::disk('public')->delete($oldIcon);
            }
        }

        $service->save();

        return redirect()->route('admin.services.index')->with('flash_message', 'Service updated successfully.');
    }

    public function destroy(string $id): RedirectResponse
    {
        $service = Service::findOrFail($id);
        if ($service->icon) {
            Storage::disk('public')->delete($service->icon);
        }
        $service->delete();

        return redirect()->route('admin.services.index')->with('flash_message', 'Service deleted successfully.');
    }
}
