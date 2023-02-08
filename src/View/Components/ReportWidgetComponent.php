<?php

namespace TomatoPHP\TomatoSauce\View\Components;

use Illuminate\View\Component;

class ReportWidgetComponent extends Component
{
    /**
     * ReportTableComponent constructor.
     * @param $
     */
    public function __construct(public $report)
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('tomato-sauce::components.report-widget-component');
    }
}
