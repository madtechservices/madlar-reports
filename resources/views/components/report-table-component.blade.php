@foreach($report as $table)
    <div aria-hidden="true" class=" space-y-4 filament-hr border-t dark:border-gray-700"></div>
    <div class="space-y-2">
        <div class="flex justify-center">
            <nav
                class="filament-tabs flex overflow-x-auto items-center p-1 space-x-1 rtl:space-x-reverse text-sm text-gray-600 bg-gray-500/5 rounded-xl dark:bg-gray-500/20">
                <p class="flex whitespace-nowrap items-center h-8 px-5 font-medium rounded-lg whitespace-nowrap focus:outline-none focus:ring-2 focus:ring-primary-600 focus:ring-inset text-primary-600 shadow bg-white dark:text-white dark:bg-primary-600">
                    {{$table['name']}}
                </p>

            </nav>
        </div>
    </div>
    <div class="flex flex-col mt-3 mb-6">
        <div class="-my-2 overflow-x-auto">
            <div class="py-2 align-middle inline-block min-w-full sm:px-px">
                <div class="shadow relative sm:rounded-md sm:overflow-hidden">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-600 bg-white dark:bg-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>

                            @foreach($table['columns'] as $column)
                                <th class="pr-6 py-3 text-left text-xs font-medium tracking-wide text-gray-500 dark:text-white"
                                    style=""><span
                                        class="flex flex-row items-center">
                    <span class="uppercase">{{ $column }}</span></span>
                                </th>
                            @endforeach
                        </tr>

                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-600 bg-white dark:bg-gray-800">
                        @foreach($table['data'] as $item)
                            <tr>
                                @foreach($item as $key=>$value)
                                    <td class="whitespace-nowrap text-sm px-6 py-4 text-gray-500 dark:text-gray-200"
                                        style="">
                                        {{ $value }}
                                    </td>
                                @endforeach
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endforeach

