<?php

namespace App\Http\Controllers\Services\CVBuilder;
use App\Http\Controllers\Controller;
use App\Models\CvPersonalInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CvPersonalInfoController extends Controller
{
    public function edit()
    {
        $personalInfo = auth()->user()->cvPersonalInfo;

        return view('cvbuilder.personal_info.edit', compact('personalInfo'));
    }

    public function update(Request $request)
    {
        $personalInfo = auth()->user()->cvPersonalInfo;

        $data = $request->validate([
            'job_title' => 'nullable|string|max:255',
            'bio' => 'nullable|string',
            'profile_image' => 'nullable|image|max:2048',
            'gender' => 'nullable ',
            'marital_status' => 'nullable|string|max:255',
            'birth_date' => 'nullable|date',
            'website' => 'nullable|url',
            'country' => 'nullable|string|max:255',
            'nationality' => 'nullable|string|max:255',
            'health_status' => 'nullable|string|max:255',
            'military_status' => 'nullable|string|max:255',
            'name' => 'required|string|max:255',
            'phone' => 'required|regex:/^[0-9]{6,15}$/',
            'phone_country_code' => 'required|string|max:5',
        ]);

        if ($request->hasFile('profile_image')) {
            if (!empty($personalInfo->profile_image) && Storage::exists($personalInfo->profile_image)) {
                Storage::delete($personalInfo->profile_image);
            }
            $data['profile_image'] = $request->file('profile_image')->store('profile_images', 'public');
        }

        $fullPhone = $request->input('phone_country_code') . ltrim($request->input('phone'), '0');

        auth()->user()->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone_number' => $fullPhone,
        ]);

        CvPersonalInfo::updateOrCreate(
            ['user_id' => auth()->id()],
            $data
        );

        return redirect()->back()->with('success', 'تم حفظ البيانات بنجاح.');
    }
}
