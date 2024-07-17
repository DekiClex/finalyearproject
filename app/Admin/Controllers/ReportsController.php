<?php

namespace App\Admin\Controllers;

use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use \App\Models\Cases;

class ReportsController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Reports';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Cases());

        $grid->disableCreateButton();
        $grid->disableColumnSelector();
        $grid->expandFilter();

        //Filter function
        $grid->filter(function($filter){
            $filter->disableIdFilter();
            $filter->month('Start',  __('Month'));
            $filter->year('created_at',  __('Year'));
        });

        //Grid display
        $grid->column('CaseID', __('Case ID'));
        $grid->column('PatientID', __('Patient ID'));
        $grid->column('patients.PatientName', __('Patient Name'));
        $grid->column('CaseClassification', __('Case Classification'));
        $grid->column('CaseDiagnosis', __('Case Diagnosis'));
        $grid->column('CaseZone', __('Case Zone'));
        $grid->column('Start', __('Admission Date'));
        $grid->column('Submission', __('Submission Date'));
        $grid->column('Status', __('Status'))->using([
            1 => 'Pending',
            2 => 'Completed',
            3 => 'Overdue',
            4 => 'Late Completion',
        ], 'Unknown')->dot([
            1 => 'warning',
            2 => 'success',
            3 => 'danger',
            4 => 'danger',
        ], 'warning');

        $grid->actions(function ($actions) {
            $actions->disableDelete();
            $actions->disableEdit();
        });
        $grid->batchActions(function ($batch) {
            $batch->disableEdit();
            $batch->disableDelete();
        });

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
        $show = new Show(Cases::findOrFail($id));

        $show->field('CaseID', __('Case ID'));
        $show->field('PatientID', __('Patient ID'));
        $show->field('patients.PatientName', __('Patient Name'));    
        $show->field('patients.PatientIC', __('Patient IC'));
        $show->field('patients.PatientAge', __('Patient Age'));
        $show->field('patients.PatientBirthDate', __('Patient Birth Date'));
        $show->field('patients.PatientRace', __('Patient Race'));
        $show->field('patients.PatientAddress', __('Patient Address'));
        $show->field('patients.PatientUKSP', __('Patient UKSP'));
        $show->field('patients.PatientPCR', __('Patient PCR'));
        $show->divider();
        $show->field('CaseClassification', __('Case Classification'));
        $show->field('CaseDiagnosis', __('Case Diagnosis'));
        $show->field('CaseZone', __('Case Zone'));
        $show->field('CaseNote', __('Case Note'));
        $show->field('Start', __('Admission Date'));
        $show->field('Status', __('Status'))->using([
            1 => 'Pending',
            2 => 'Completed',
            3 => 'Overdue',
            4 => 'Late Completion',
        ], 'Unknown');

        $show->panel()->tools(function ($tools) {
            $tools->disableEdit();
            $tools->disableDelete();
        });

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Cases());



        return $form;
    }
}
