<?php


namespace TomatoPHP\TomatoSauce\Services;


use Illuminate\Support\Facades\DB;
use TomatoPHP\TomatoSauce\Contracts\AbstractReport;
use TomatoPHP\TomatoSauce\Contracts\IReportInterface;

class TableService extends AbstractReport implements IReportInterface
{


    public function make(): array
    {

        $this->makeJoin();

        $this->makeCondition();

        $this->makeFields();

        $this->makeAggregate();

        $this->makeGetter();


        return [
            "type" => $this->model->type,
            "name" => $this->model->report_name,
            "data" => $this->builder->toArray(),
            "columns" => array_values($this->model->fields[0]["label"]),
        ];

    }
}
