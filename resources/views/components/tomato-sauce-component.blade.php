@foreach($data as $key=>$report)
    @if($key== 'table')
        <x-report-table :$report/>
    @elseif($key== 'widget')
        <x-report-widget :$report/>
    @elseif($key== 'chart')
        <x-report-chart :$report/>
    @endif
@endforeach
