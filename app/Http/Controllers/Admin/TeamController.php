<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Team;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class TeamController extends Controller
{
    public function index(): View
    {
        return view('admin.team.index', ['team' => Team::query()->latest()->get()]);
    }

    public function create(): View
    {
        return view('admin.team.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'des' => ['required', 'string', 'max:1000'],
            'code' => ['required', 'string', 'max:255'],
            'img' => ['required', 'image', 'mimes:svg,png,jpg,jpeg,webp', 'max:2048'],
        ]);

        $validated['img'] = $request->file('img')->store('uploads/team', 'public');
        Team::create($validated);

        return redirect()->route('admin.team.index')->with('flash_message', 'Team member added successfully.');
    }

    public function show(string $id): View
    {
        return view('admin.team.show', ['team' => Team::findOrFail($id)]);
    }

    public function edit(string $id): View
    {
        return view('admin.team.edit', ['team' => Team::findOrFail($id)]);
    }

    public function update(Request $request, string $id): RedirectResponse
    {
        $team = Team::findOrFail($id);
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'des' => ['required', 'string', 'max:1000'],
            'code' => ['required', 'string', 'max:255'],
            'img' => ['nullable', 'image', 'mimes:svg,png,jpg,jpeg,webp', 'max:2048'],
        ]);

        $team->fill([
            'name' => $validated['name'],
            'des' => $validated['des'],
            'code' => $validated['code'],
        ]);

        if ($request->hasFile('img')) {
            $oldImage = $team->img;
            $team->img = $request->file('img')->store('uploads/team', 'public');
            if ($oldImage) {
                Storage::disk('public')->delete($oldImage);
            }
        }

        $team->save();

        return redirect()->route('admin.team.index')->with('flash_message', 'Team member updated successfully.');
    }

    public function destroy(string $id): RedirectResponse
    {
        $team = Team::findOrFail($id);
        if ($team->img) {
            Storage::disk('public')->delete($team->img);
        }
        $team->delete();

        return redirect()->route('admin.team.index')->with('flash_message', 'Team member deleted successfully.');
    }
}
