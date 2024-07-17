<?php

namespace App\Admin\Selectable;

use App\Models\Patients;
use OpenAdmin\Admin\Grid\Filter;
use OpenAdmin\Admin\Grid\Selectable;

class UsersSelect extends Selectable
{
    public $model = Patients::class;
    protected $perPage = 5;
    public static $display_field = "tag"; // display field when using in grid

    public function make()
    {
        $this->column('PatientID', __('Patient ID'));
        $this->column('PatientName', __('Patient Name'));
        $this->column('PatientIC', __('Patient IC'));

        $this->filter(function (Filter $filter) {
            $filter->disableIdFilter();
            $filter->equal('PatientID','Patient ID');
            $filter->like('PatientName','Patient Name');
            $filter->equal('PatientIC','Patient IC');
        });
    }

    public static function display()
    {
        return function ($value) {

            // For belongs to many relationships
            if (is_array($value)) {
                return implode(self::$seperator, array_map(function ($tag) {
                    return "<span data-key=\"{$tag['id']}\" class='".(self::$labelClass)."'>{$tag['tag']}</span>";
                }, $value));
            }

            // For belongsTo relationship
            return "<span data-key=\"".$value."\" class='".(self::$labelClass)."'>".optional($this->user)->name."</span>";
            //Note: the data-key needs double quotes for javascript selector

        };
    }
}
