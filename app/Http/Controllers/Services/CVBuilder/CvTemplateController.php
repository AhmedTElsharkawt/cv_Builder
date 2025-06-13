<?php

namespace App\Http\Controllers\Services\CVBuilder;

use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\View;

class CvTemplateController extends Controller
{
    public function index()
    {
        return view('cvbuilder.templates.index');
    }

    public function show($template)
    {
        if (!View::exists("cvbuilder.templates.views.$template")) {
            abort(404);
        }

        $user = auth()->user();
        return view("cvbuilder.templates.views.$template", [
            'user' => $user,
        ]);
    }

    public function download($template)
    {
        $user = auth()->user();
        if (! View::exists("cvbuilder.templates.views.$template")) {
            abort(404);
        }
        // يمكنك ضبط حجم الورق واتجاهه إذا أردت:
        $pdf = Pdf::loadView("cvbuilder.templates.views.$template", compact('user'))
                  ->setPaper('a4', 'portrait'); // أو 'landscape'
        // اسم الملف: يمكنك تخصيصه
        $filename = "{$user->name}_{$user->cvPersonalInfo->job_title} CV.pdf";
        // تنزيل مباشر
        return $pdf->stream($filename);
        // أو للعرض في المتصفح inline:
        // return $pdf->stream($filename);
    }

}
