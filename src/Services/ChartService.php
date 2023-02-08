<?php


namespace TomatoPHP\TomatoSauce\Services;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use TomatoPHP\TomatoSauce\Contracts\AbstractReport;
use TomatoPHP\TomatoSauce\Contracts\IReportInterface;

class ChartService extends AbstractReport implements IReportInterface
{


    public function make(): array
    {

        $this->makeJoin();

        $this->makeCondition();

        $this->builder->addSelect(DB::raw($this->model->fields[0]["label"][0] . ' as labels'));

        $this->makeAggregate();

        $this->makeGetter();


        return [
            "type" => $this->model->type,
            "name" => $this->model->report_name,
            "data" => $this->builder->pluck('data_values'),
            "columns" => $this->builder->pluck('labels'),
        ];
    }
}
