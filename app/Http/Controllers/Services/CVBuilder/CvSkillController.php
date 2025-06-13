<?php

namespace App\Http\Controllers\Services\CVBuilder;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CvSkillController extends Controller
{
    public function edit()
    {
        $skills = auth()->user()->cvSkills;
        return view('cvbuilder.skills.edit', compact('skills'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'cv_skills.*.name' => 'required|string|max:255',
            'cv_skills.*.level' => 'required|string',
        ]);

        auth()->user()->cvSkills()->delete();

        foreach ($request->input('cv_skills', []) as $skillData) {
            auth()->user()->cvSkills()->create($skillData);
        }

        return back()->with('success', 'تم حفظ المهارات بنجاح.');
    }
}
