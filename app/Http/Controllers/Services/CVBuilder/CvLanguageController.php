<?php

namespace App\Http\Controllers\Services\CVBuilder;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CvLanguageController extends Controller
{
    public function edit()
    {
        $languages = auth()->user()->cvLanguages;
        return view('cvbuilder.languages.edit', compact('languages'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'cv_languages.*.id' => 'nullable|exists:cv_languages,id',
            'cv_languages.*.name' => 'required|string|max:255',
            'cv_languages.*.proficiency' => 'required|max:20',
        ]);

        auth()->user()->cvLanguages()->delete();

        foreach ($request->input('cv_languages', []) as $languageData) {
            auth()->user()->cvLanguages()->create($languageData);
        }

        return redirect()->back()->with('success', 'تم حفظ اللغات بنجاح.');
    }
}
