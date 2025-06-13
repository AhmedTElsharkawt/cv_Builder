<?php

namespace App\Http\Controllers\Services\CVBuilder;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CvLinkController extends Controller
{
    public function edit()
    {
        $links = auth()->user()->cvLinks;

        return view('cvbuilder.links.edit', compact('links'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'cv_links.*.id' => 'nullable|exists:cv_links,id',
            'cv_links.*.label' => 'required|string|max:255',
            'cv_links.*.url' => 'required|url|max:255',
        ]);

        auth()->user()->cvLinks()->delete();

        foreach ($request->input('cv_links', []) as $linkData) {
            auth()->user()->cvLinks()->create($linkData);
        }

        return redirect()->back()->with('success', 'تم حفظ الروابط بنجاح.');
    }
}
