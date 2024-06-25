<?php

namespace App\Admin\Controllers;

use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use \App\Models\Patients;

class PatientsController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Patients';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Patients());
        $grid->filter(function($filter){
            $filter->disableIdFilter();
            $filter->like('PatientName','Patient Name');  
            $filter->like('PatientIC','Patient IC');
            $filter->between('PatientAge', 'Patient Age');  
            $filter->like('PatientRace', 'Patient Race');
        });

        $grid->column('PatientID', __('Patient ID'));
        $grid->column('PatientName', __('Patient Name'));
        $grid->column('PatientIC', __('Patient IC'));
        $grid->column('PatientAge', __('Patient Age'));
        $grid->column('PatientBirthDate', __('Patient Birth Date'));
        $grid->column('PatientRace', __('Patient Race'));
        $grid->column('PatientAddress', __('Patient Address'));
        $grid->column('PatientUKSP', __('Patient UKSP'));
        $grid->column('PatientPCR', __('Patient PCR'));
        $grid->column('created_at', __('Created at'));
        $grid->column('created_at')->hide();
        $grid->column('updated_at', __('Updated at'));
        $grid->column('updated_at')->hide();

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Patients::findOrFail($id));

        $show->field('PatientID', __('Patient ID'));
        $show->field('PatientName', __('Patient Name'));
        $show->field('PatientIC', __('Patient IC'));
        $show->field('PatientAge', __('PatientAge'));
        $show->field('PatientBirthDate', __('Patient Birth Date'));
        $show->field('PatientRace', __('Patient Race'));
        $show->field('PatientAddress', __('Patient Address'));
        $show->field('PatientUKSP', __('Patient UKSP'));
        $show->field('PatientPCR', __('Patient PCR'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Patients());

        $form->text('PatientName', __('Patient Name'));
        $form->text('PatientIC', __('Patient IC'))->inputmask(['mask' => '999999-99-9999']);;
        $form->number('PatientAge', __('Patient Age'));
        $form->date('PatientBirthDate', __('Patient Birth Date'))->default(date('Y-m-d'));
        $form->text('PatientRace', __('Patient Race'));
        $form->text('PatientAddress', __('Patient Address'));
        $form->text('PatientUKSP', __('Patient UKSP'));
        $form->text('PatientPCR', __('Patient PCR'));

        return $form;
    }
}