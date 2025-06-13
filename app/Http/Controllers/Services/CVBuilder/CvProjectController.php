<?php

namespace App\Http\Controllers\Services\CVBuilder;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class CvProjectController extends Controller
{
    public function edit()
    {
        $projects = auth()->user()->cvProjects;

        return view('cvbuilder.projects.edit', compact('projects'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'cv_projects.*.id' => 'nullable|exists:cv_projects,id',
            'cv_projects.*.name' => 'required|string|max:255',
            'cv_projects.*.url' => 'nullable|url',
            'cv_projects.*.completion_date' => 'nullable|date',
            'cv_projects.*.description' => 'nullable|string',
        ]);

        // حذف المشاريع القديمة
        auth()->user()->cvProjects()->delete();

        // إعادة إضافة المشاريع الجديدة
        foreach ($request->input('cv_projects', []) as $projectData) {
            auth()->user()->cvProjects()->create($projectData);
        }
        return redirect()->back()->with('success', 'تم حفظ المشاريع بنجاح.');
    }
}
