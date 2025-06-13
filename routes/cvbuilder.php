<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Services\CVBuilder\CvAddressController;
use App\Http\Controllers\Services\CVBuilder\CvEducationController;
use App\Http\Controllers\Services\CVBuilder\CvExperienceController;
use App\Http\Controllers\Services\CVBuilder\CvLanguageController;
use App\Http\Controllers\Services\CVBuilder\CvLinkController;
use App\Http\Controllers\Services\CVBuilder\CvPersonalInfoController;
use App\Http\Controllers\Services\CVBuilder\CvProjectController;
use App\Http\Controllers\Services\CVBuilder\CvSkillController;
use App\Http\Controllers\Services\CVBuilder\CvTemplateController;
use App\Http\Controllers\Services\CVBuilder\CvTrainingController;

Route::middleware(['auth'])->group(function () {
    Route::get('/personal-info/edit', [CvPersonalInfoController::class, 'edit'])->name('cvbuilder.personal_info.edit');
    Route::post('/personal-info', [CvPersonalInfoController::class, 'update'])->name('cvbuilder.personal_info.update');

    Route::get('/educations/edit', [CvEducationController::class, 'edit'])->name('cvbuilder.educations.edit');
    Route::put('/educations', [CvEducationController::class, 'update'])->name('cvbuilder.educations.update');

    Route::get('/experiences/edit', [CvExperienceController::class, 'edit'])->name('cvbuilder.experiences.edit');
    Route::put('/experiences', [CvExperienceController::class, 'update'])->name('cvbuilder.experiences.update');

    Route::get('/trainings/edit', [CvTrainingController::class, 'edit'])->name('cvbuilder.trainings.edit');
    Route::put('/trainings', [CvTrainingController::class, 'update'])->name('cvbuilder.trainings.update');

    Route::get('/skills/edit', [CvSkillController::class, 'edit'])->name('cvbuilder.skills.edit');
    Route::put('/skills', [CvSkillController::class, 'update'])->name('cvbuilder.skills.update');

    Route::get('/projects/edit', [CvProjectController::class, 'edit'])->name('cvbuilder.projects.edit');
    Route::put('/projects', [CvProjectController::class, 'update'])->name('cvbuilder.projects.update');

    Route::get('/languages/edit', [CvLanguageController::class, 'edit'])->name('cvbuilder.languages.edit');
    Route::put('/languages', [CvLanguageController::class, 'update'])->name('cvbuilder.languages.update');

    Route::get('/links/edit', [CvLinkController::class, 'edit'])->name('cvbuilder.links.edit');
    Route::put('/links', [CvLinkController::class, 'update'])->name('cvbuilder.links.update');

    Route::get('/address/edit', [CvAddressController::class, 'edit'])->name('cvbuilder.address.edit');
    Route::put('/address', [CvAddressController::class, 'update'])->name('cvbuilder.address.update');


    Route::get('/templates', [CvTemplateController::class, 'index'])->name('cvbuilder.templates.index');
    Route::get('/download/{template}', [CvTemplateController::class, 'download'])->name('cvbuilder.templates.download');
    Route::get('/{template}', [CvTemplateController::class, 'show'])->name('cvbuilder.templates.show');

});



