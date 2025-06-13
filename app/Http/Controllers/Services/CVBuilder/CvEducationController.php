<?php

namespace App\Http\Controllers\Services\CVBuilder;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CvEducation;

class CvEducationController extends Controller
{
    public function edit()
    {
        $educations = CvEducation::where('user_id', auth()->id())->get();
        return view('cvbuilder.educations.edit', compact('educations'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'cv_educations.*.id' => 'nullable|exists:cv_educations,id',
            'cv_educations.*.institution' => 'required|string|max:255',
            'cv_educations.*.major' => 'nullable|string|max:255',
            'cv_educations.*.degree' => 'nullable|string',
            'cv_educations.*.graduation_date' => 'nullable|date',
            'cv_educations.*.description' => 'nullable|string',
        ]);

        // حذف الخبرات القديمة
        auth()->user()->cvEducations()->delete();

        // إعادة إضافة الخبرات الجديدة
        foreach ($request->input('cv_educations', []) as $educationData) {
            auth()->user()->cvEducations()->create($educationData);
        }

        return redirect()->back()->with('success', 'تم حفظ المؤهلات بنجاح.');
    }
}
