<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use OpenAdmin\Admin\Admin;
use OpenAdmin\Admin\Controllers\Dashboard;
use OpenAdmin\Admin\Layout\Column;
use OpenAdmin\Admin\Layout\Content;
use OpenAdmin\Admin\Layout\Row;
use \App\Models\Cases;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index(Content $content)
    {
        return $content
            ->css_file(Admin::asset("open-admin/css/pages/dashboard.css"))
            ->title('Home')
            ->row(Dashboard::title())
            ->row(function (Row $row) {

                $row->column(4, function (Column $column) {
                    $pendingCount = Cases::where('Status', '1')->count();

                    $column->append(Dashboard::environment());
                    $column->row('<h3 class="dashboard-title">' . $pendingCount . '</h3>');
                });

                $row->column(4, function (Column $column) {

                    $completedCount = Cases::where('Status','2')
                                                ->where('Month', '=', Carbon::now()->format('Y-m'))
                                                ->count();

                    $column->append(Dashboard::extensions());
                    $column->row('<h3 class="dashboard-title">' . $completedCount . '</h3>');
                });

                $row->column(4, function (Column $column) {
                    $overdueCasesCount = Cases::where('Status','3')->count();

                    $column->append(Dashboard::dependencies());
                    $column->row('<h3 class="dashboard-title">' . $overdueCasesCount . '</h3>');
                });
            });
    }
}
