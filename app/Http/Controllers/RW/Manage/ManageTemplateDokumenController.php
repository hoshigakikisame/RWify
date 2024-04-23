<?php

namespace App\Http\Controllers\RW\Manage;

// Illuminate

// App
use App\Http\Controllers\Controller;
use App\Decorators\SearchableDecorator;
use App\Models\TemplateDokumenModel;
use App\Models\UserModel;


class ManageTemplateDokumenController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function manageTemplateDokumenPage()
    {

        $reqQuery = request()->q;

        $templateDokumenInstances = (new SearchableDecorator(TemplateDokumenModel::class))->search($reqQuery);

        $data = [
            "templateDokumenInstances" => $templateDokumenInstances
        ];

        return view('rw.manage.templateDokumen', $data);
    }

    public function addNewTemplateDokumen()
    {
        request()->validate([
            'nama_template' => 'required', 
            'path_template' => 'required'
        ]);

        $data = [
            'nama_template' => request()->nama_template,
            'path_template' => request()->path_template
        ];

        $newTemplate = TemplateDokumenModel::create($data);

        if (!$newTemplate) {
            session()->flash('danger', 'Insert Failed.');
        } else {
            session()->flash('success', 'Insert Success.');
        }

        return redirect()->route('rw.manage.templateDokumen');
    }

    // update template dokumen with validation
    public function updateTemplateDokumen()
    {
        request()->validate([
            'id_template_dokumen' => 'required',
            'nama_template' => 'required',
            'path_template' => 'required'
        ]);

        $idTemplateDokumen = request()->id_templateDokumen;
        $templateDokumen = TemplateDokumenModel::find($idTemplateDokumen);

        if (!$templateDokumen) {
            session()->flash('danger', 'Update Failed.');
        } else {
            $templateDokumen->setNamaTemplate(request()->nama_template);
            $templateDokumen->setPathTemplate(request()->path_template);
            $templateDokumen->save();

            session()->flash('success', 'Update Success.');
        }

        return redirect()->route('rw.manage.templateDokumen');
    }

    public function deleteTemplateDokumen()
    {

        request()->validate([
            'id_template_dokumen' => 'required',
        ]);

        $idTemplateDokumen = request()->id_template_dokumen;

        $templateDokumen = TemplateDokumenModel::find($idTemplateDokumen);

        if (!$templateDokumen) {
            session()->flash('danger', 'Delete Failed');
        } else {
            $templateDokumen->delete();
            session()->flash('success', 'Delete Success.');
        }

        return redirect()->route('rw.manage.templateDokumen');
    }
}
