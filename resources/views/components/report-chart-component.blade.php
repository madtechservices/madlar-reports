
<div class="grid grid-cols-1 gap-4 mb-6 filament-widgets-container lg:grid-cols-2 lg:gap-8">

@foreach($report as $chart)

<div>
    <div aria-hidden="true" class=" space-y-4 filament-hr border-t dark:border-gray-700"></div>

    <div class="space-y-2">
        <div class=" justify-center">
            <nav
                class="filament-tabs flex overflow-x-auto items-center p-1 space-x-1 rtl:space-x-reverse text-sm text-gray-600 bg-gray-500/5 rounded-xl dark:bg-gray-500/20">
                <p class="flex whitespace-nowrap items-center h-8 px-5 font-medium rounded-lg whitespace-nowrap focus:outline-none focus:ring-2 focus:ring-primary-600 focus:ring-inset text-primary-600 shadow bg-white dark:text-white dark:bg-primary-600">
                    {{$chart['name']}}
                </p>

            </nav>
        </div>
    </div>
   <charts :data="@js($chart['chartData'])"  />
</div>
@endforeach
</div>



