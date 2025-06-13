<?php

namespace App\Http\Controllers\Services\CVBuilder;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CvExperienceController extends Controller
{
    public function edit()
    {
        $experiences = auth()->user()->cvExperiences;
        return view('cvbuilder.experiences.edit', compact('experiences'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'cv_experiences.*.id' => 'nullable|exists:cv_experiences,id',
            'cv_experiences.*.company' => 'required|string|max:255',
            'cv_experiences.*.position' => 'required|string|max:255',
            'cv_experiences.*.start_date' => 'nullable|date',
            'cv_experiences.*.end_date' => 'nullable|date|after_or_equal:cv_experiences.*.start_date',
            'cv_experiences.*.description' => 'nullable|string',
        ]);


        // حذف الخبرات القديمة
        auth()->user()->cvExperiences()->delete();

        // إعادة إضافة الخبرات الجديدة
        foreach ($request->input('cv_experiences', []) as $experienceData) {
            auth()->user()->cvExperiences()->create($experienceData);
        }

        return redirect()->back()->with('success', 'تم حفظ الخبرات بنجاح.');
    }
}
