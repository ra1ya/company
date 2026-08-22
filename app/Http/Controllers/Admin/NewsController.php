<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class NewsController extends Controller
{
    public function index(): View
    {
        return view('admin.news.index', ['news' => News::query()->latest()->get()]);
    }

    public function create(): View
    {
        return view('admin.news.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'img' => ['required', 'image', 'mimes:svg,png,jpg,jpeg,webp', 'max:2048'],
            'det' => ['required', 'string', 'max:3000'],
        ]);

        $validated['img'] = $request->file('img')->store('uploads/news', 'public');
        News::create($validated);

        return redirect()->route('admin.news.index')->with('flash_message', 'News item added successfully.');
    }

    public function show(string $id): View
    {
        return view('admin.news.show', ['news' => News::findOrFail($id)]);
    }

    public function edit(string $id): View
    {
        return view('admin.news.edit', ['news' => News::findOrFail($id)]);
    }

    public function update(Request $request, string $id): RedirectResponse
    {
        $news = News::findOrFail($id);
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'img' => ['nullable', 'image', 'mimes:svg,png,jpg,jpeg,webp', 'max:2048'],
            'det' => ['required', 'string', 'max:3000'],
        ]);

        $news->title = $validated['title'];
        $news->det = $validated['det'];

        if ($request->hasFile('img')) {
            $oldImage = $news->img;
            $news->img = $request->file('img')->store('uploads/news', 'public');
            if ($oldImage) {
                Storage::disk('public')->delete($oldImage);
            }
        }

        $news->save();

        return redirect()->route('admin.news.index')->with('flash_message', 'News item updated successfully.');
    }

    public function destroy(string $id): RedirectResponse
    {
        $news = News::findOrFail($id);
        if ($news->img) {
            Storage::disk('public')->delete($news->img);
        }
        $news->delete();

        return redirect()->route('admin.news.index')->with('flash_message', 'News item deleted successfully.');
    }
}
