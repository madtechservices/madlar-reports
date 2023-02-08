<?php

namespace TomatoPHP\TomatoSauce\View\Components;

use Illuminate\View\Component;

class ReportChartComponent extends Component
{

    /**
     * ReportChartComponent constructor.
     * @param $
     */
    public function __construct(public $report)
    {
        //
        $temp=[];
        foreach ($this->report as $key => $value){
            $this->report[$key]=array_merge($value,["chartData"=>[
                "labels"=> $value["columns"],
                "datasets"=> [ [ "data"=> $value["data"]] ]
            ]]);
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('tomato-sauce::components.report-chart-component');
    }
}
