<?php


namespace TomatoPHP\TomatoSauce\Contracts;


use TomatoPHP\TomatoSauce\Models\Report;

interface IReportInterface
{

    /**
     * @return array
     */
    public function make():array;

    /**
     * @param Report $model
     * @return IReportInterface
     */
    public function setModel(Report $model):static;
}
