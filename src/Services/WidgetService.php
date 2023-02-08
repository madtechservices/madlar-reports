<?php


namespace TomatoPHP\TomatoSauce\Services;


use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use TomatoPHP\TomatoSauce\Contracts\AbstractReport;
use TomatoPHP\TomatoSauce\Contracts\IReportInterface;
use TomatoPHP\TomatoSauce\Models\Report;

class WidgetService extends AbstractReport implements IReportInterface
{


    public function make(): array
    {

        $this->makeJoin();

        $this->makeCondition();

        $this->makeFields();

        $this->makeAggregate();

        return [
            "type" => $this->model->type,
            "name" => $this->model->report_name,
            "data" => $this->builder->first(),
            "model" => ["report_name" => $this->model->report_name],
        ];

    }


}
