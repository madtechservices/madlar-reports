<div class="grid grid-cols-1 gap-4 mb-6 filament-widgets-container lg:grid-cols-3 lg:gap-8">
    @foreach($report as $widget)
        <div class="col-span-1 filament-widget filament-account-widget">
            <div class="p-2 space-y-2 bg-white shadow rounded-xl dark:border-gray-600 dark:bg-gray-800">
                <div class="space-y-2">
                    <div class="px-4 py-2 space-y-4">
                        <div class=" items-center h-12 space-v-4 rtl:space-v-reverse">
                            <div
                                class=" items-center space-x-2 rtl:space-x-reverse text-sm font-medium text-gray-500 dark:text-gray-200">

                                <span>{{$widget['model']['report_name']}}</span>
                            </div>

                            <div class="text-3xl">
                                @foreach (get_object_vars($widget['data']) as $var => $val)
                                    {{$val}}

                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

</div>


