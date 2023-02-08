<?php


namespace TomatoPHP\TomatoSauce\Services;


use TomatoPHP\TomatoSauce\Contracts\IReportInterface;

class ReportFactory
{

    public array $reports = [];

    /**
     * @return ReportFactory
     */
    public function register(): static
    {
        $this->reports['table'] = new TableService();
        $this->reports['widget'] = new WidgetService();
        $this->reports['chart'] = new ChartService();
        return $this;
    }


    /**
     * @param string $name
     * @return IReportInterface
     */
    public function get(string $name):IReportInterface
    {
        if (array_key_exists($name, $this->reports)) {
            return $this->reports[$name];
        }

        throw new \RuntimeException("This report not registered");
    }


}
