<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Say;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class SayController extends Controller
{
    public function index(): View
    {
        return view('admin.say.index', ['say' => Say::query()->latest()->get()]);
    }

    public function create(): View
    {
        return view('admin.say.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'des' => ['required', 'string', 'max:500'],
            'say' => ['required', 'string', 'max:2000'],
            'img' => ['required', 'image', 'mimes:svg,png,jpg,jpeg,webp', 'max:2048'],
        ]);

        $validated['img'] = $request->file('img')->store('uploads/testimonials', 'public');
        Say::create($validated);

        return redirect()->route('admin.say.index')->with('flash_message', 'Testimonial added successfully.');
    }

    public function show(string $id): View
    {
        return view('admin.say.show', ['say' => Say::findOrFail($id)]);
    }

    public function edit(string $id): View
    {
        return view('admin.say.edit', ['say' => Say::findOrFail($id)]);
    }

    public function update(Request $request, string $id): RedirectResponse
    {
        $say = Say::findOrFail($id);
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'des' => ['required', 'string', 'max:500'],
            'say' => ['required', 'string', 'max:2000'],
            'img' => ['nullable', 'image', 'mimes:svg,png,jpg,jpeg,webp', 'max:2048'],
        ]);

        $say->fill([
            'name' => $validated['name'],
            'des' => $validated['des'],
            'say' => $validated['say'],
        ]);

        if ($request->hasFile('img')) {
            $oldImage = $say->img;
            $say->img = $request->file('img')->store('uploads/testimonials', 'public');
            if ($oldImage) {
                Storage::disk('public')->delete($oldImage);
            }
        }

        $say->save();

        return redirect()->route('admin.say.index')->with('flash_message', 'Testimonial updated successfully.');
    }

    public function destroy(string $id): RedirectResponse
    {
        $say = Say::findOrFail($id);
        if ($say->img) {
            Storage::disk('public')->delete($say->img);
        }
        $say->delete();

        return redirect()->route('admin.say.index')->with('flash_message', 'Testimonial deleted successfully.');
    }
}
