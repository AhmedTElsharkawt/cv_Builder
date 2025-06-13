<?php

namespace App\Http\Controllers\Services\CVBuilder;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CvAddressController extends Controller
{
    public function edit()
    {
        $address = auth()->user()->cvAddress;
        return view('cvbuilder.address.edit', compact('address'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'cv_address' => 'required|string|max:1000',
        ]);

        auth()->user()->cvAddress()->updateOrCreate([], [
            'full_address' => $data['cv_address'],
        ]);

        return redirect()->back()->with('success', 'تم حفظ العنوان بنجاح.');
    }
}
