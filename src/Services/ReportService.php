<?php


namespace TomatoPHP\TomatoSauce\Services;


use TomatoPHP\TomatoSauce\Contracts\IReportInterface;
use TomatoPHP\TomatoSauce\Models\Report;

class ReportService
{

    private array $schema;
    private IReportInterface $reportInstance;
    private array $data;


    /**
     * ReportService constructor.
     * @param Report $model
     * @param ReportFactory $reportFactory
     */
    public function __construct(private Report $model ,private ReportFactory $reportFactory)
    {
    }

    /**
     * @return array
     */
    public function getReport():array
    {

        $reports = $this->model->where("page_name", 'TestPage')->where('is_active',1)->get()->sortBy('sort');

        foreach ($reports as $report) {

            $this->reportInstance=$this->reportFactory->register()->get($report->type);
            $this->data[]=$this->reportInstance->setModel($report)->make();


        }
        return $this->data;

    }
}
