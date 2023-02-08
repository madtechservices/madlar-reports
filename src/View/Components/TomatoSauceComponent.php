<?php

namespace TomatoPHP\TomatoSauce\View\Components;

use Illuminate\View\Component;
use TomatoPHP\TomatoSauce\Services\ReportService;

class TomatoSauceComponent extends Component
{
    public $data;

    /**
     * ReportFactoryComponent constructor.
     * @param $
     */
    public function __construct(private ReportService $reportService)
    {
        //
        $this->data=$reportService->getReport();
        $this->data=collect($this->data)->groupBy('type');
    }
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('tomato-sauce::components.tomato-sauce-component')->with('data',$this->data);
    }
}
