<?php

namespace App\Http\Controllers\Services\CVBuilder;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CvTrainingController extends Controller
{
    public function edit()
    {
        $trainings = auth()->user()->cvTrainings;
        return view('cvbuilder.trainings.edit', compact('trainings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'cv_trainings.*.id' => 'nullable|exists:cv_trainings,id',
            'cv_trainings.*.title' => 'required|string|max:255',
            'cv_trainings.*.provider' => 'nullable|string|max:255',
            'cv_trainings.*.start_date' => 'nullable|date',
            'cv_trainings.*.end_date' => 'nullable|date',
            'cv_trainings.*.description' => 'nullable|string',
        ]);

        // حذف الدورات القديمة
        auth()->user()->cvTrainings()->delete();

        // إعادة الإضافة
        foreach ($request->input('cv_trainings', []) as $trainingData) {
            auth()->user()->cvTrainings()->create($trainingData);
        }

        return back()->with('success', 'تم حفظ الدورات التدريبية بنجاح.');
    }
}
