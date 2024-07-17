<?php

namespace App\Admin\Controllers;

use Carbon\Carbon;
use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use App\Admin\Selectable\UsersSelect;
use \App\Models\Cases;
use App\Admin\Actions\Submit;
use App\Console\Commands\updateStatus;

class CasesController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Cases';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        
        $grid = new Grid(new Cases());

        //Filter Selector
        $grid->selector(function (Grid\Tools\Selector $selector) {
            $selector->select('Status', 'Status', [
                1 => 'Pending',
                2 => 'Completed',
                3 => 'Overdue',
                4 => 'Late Completion',
            ]);
        });

        //Filter function
        $grid->filter(function($filter){
            $filter->disableIdFilter();
            $filter->like('patients.PatientName','Patient Name');  
            $filter->like('CaseClassification', __('Case Classification'));
            $filter->like('CaseDiagnosis', __('Case Diagnosis'));  
            $filter->like('CaseZone', __('Case Zone'));
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
        $grid->column('Admission Date')->display(function () {
            if ($this->Day < 10) {
                return $this->Month . '-0' . $this->Day ;
              } else {
                return $this->Month . '-' . $this->Day;
              }
        });
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
            $actions->add(new Submit());
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

        $form->belongsTo('PatientID', UsersSelect::class,'Patient')->required();
        $form->date('Start', __('Start'))->readonly()->default(Carbon::now()->format('Y-m-d'));
        $form->hidden('Month')->default(Carbon::now()->format('Y-m'));
        $form->hidden('Day')->default(Carbon::now()->format('d'));
        $form->date('Deadline', __('Deadline'))->readonly()->default(Carbon::now()->addDays(2)->format('Y-m-d'));
        $form->text('CaseClassification', __('Case Classification'))->required();
        $form->text('CaseDiagnosis', __('Case Diagnosis'))->required();
        $form->text('CaseZone', __('Case Zone'))->required();
        $form->textarea('CaseNote', __('Case Note'));

        return $form;
    }
}
