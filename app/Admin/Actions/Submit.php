<?php

namespace App\Admin\Actions;

use Illuminate\Database\Eloquent\Model;
use OpenAdmin\Admin\Actions\RowAction;
use Carbon\Carbon;
use App\Models\Cases;

class Submit extends RowAction
{

    public $name = 'copy';

    public $icon = 'icon-check-square';

    public function handle(Cases $cases)
    {

        if ($cases->Status == 1) {
            $cases->Submission = Carbon::now()->format('Y-m-d');
            $cases->Status = 2;
        }

        if ($cases->Status == 2) {
            $cases->Status = 2;
        }

        elseif ($cases->Status == 3) {
            $cases->Submission = Carbon::now()->format('Y-m-d');
            $cases->Status = 4;
        }

        $cases->save();

        return $this->response()->success('Case Submitted!')->refresh();
    }

    public function dialog()
    {
        $this->question('Are you sure to Mark as Complete?', '', ['icon'=>'question','confirmButtonText'=>'Yes']);
    }
}