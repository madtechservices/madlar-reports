<x-tomato-admin-layout>
    <x-slot name="header">
        <h1 class="text-2xl font-bold mb-4">{{trans('tomato-admin::global.crud.create')}} {{__('Report')}}</h1>
    </x-slot>
    <x-splade-modal class="font-main">
        <?php $schema = ["conditions" => [], "aggregate" => []];?>
        <x-splade-form class="flex flex-col space-y-4" action="{{route('admin.reports.store')}}" method="post"
                       :default="$schema">

            <x-splade-input label="{{__('Report name')}}" name="report_name" type="text"
                            placeholder="{{__('the title of this report')}}"/>


            <x-splade-select name="type" label="{{__('Type')}}" placeholder="{{__('which type you want to use')}}">
                <option value="table">{{__('table')}}</option>
                <option value="widget">{{__('widget')}}</option>
                <option value="chart">{{__('chart')}}</option>
            </x-splade-select>
            <?php $tables = array_keys(config('tomato-sauce.schema'));?>
            <x-splade-select name="table_name" label="{{__('Table Tame')}}"
                             placeholder="{{__('choose the main table')}}">
                @foreach($tables as $table)
                    <option value="{{$table}}">{{(__($table))}}</option>

                @endforeach
            </x-splade-select>


            <x-splade-select multiple name="joins" label="{{__('Table Relations')}}" remote-root="model"
                             option-label="name"
                             option-value="name" placeholder="{{__('choose the relations of the main table name')}}"
                             remote-url="`/admin/reports/getJoins/api/${form.table_name}`"/>


            <span class="block mb-1 text-gray-700 font-sans dark:text-white">{{__("Conditions")}}</span>
            <x-tomato-repeater :options="['label']" type="repeater" id="site_menu" name="conditions"
                               label="{{__('conditions')}}">

                <x-splade-select v-model="repeater.main[key].column" name="column" label="{{__('column name')}}"
                                 remote-root="model" option-label="name" option-value="name"
                                 placeholder="{{__('the column which you want to perform a condition')}}"
                                 remote-url="`/admin/reports/getColumns/api/${form.table_name}`"/>

                <x-splade-select v-model="repeater.main[key].operator" name="operator" label="{{__('operator')}}"
                                 placeholder="operator">
                    <option value="<">{{__("<")}}</option>
                    <option value=">">{{__(">")}}</option>
                    <option value="=">{{__("=")}}</option>
                    <option value="!=">{{__("!=")}}</option>
                </x-splade-select>
                <x-splade-input v-model="repeater.main[key].value" name="value" class="my-2" type="text"
                                placeholder="{{__('value')}}" label="{{__('value')}}"/>
            </x-tomato-repeater>

            <span class="block mb-1 text-gray-700 font-sans dark:text-white">{{__("Aggregations")}}</span>

            <x-tomato-repeater :options="['label']" type="repeater" id="site_menu" name="aggregate"
                               label="{{__('aggregate')}}">

                <x-splade-select v-model="repeater.main[key].columns" name="columns"
                                 label="{{__('column name')}}" remote-root="model" option-label="name"
                                 option-value="name"
                                 placeholder="{{__('column name')}}"
                                 remote-url="`/admin/reports/getColumns/api/${form.table_name}`"/>

                <x-splade-select v-model="repeater.main[key].type" name="type" label="{{__('type')}}"
                                 placeholder="type">
                    <option value="group">group</option>
                    <option value="count">count</option>
                    <option value="order">order</option>
                </x-splade-select>
                <x-splade-select v-model="repeater.main[key].dir" name="dir" label="{{__('dir')}}" placeholder="dir">
                    <option value="asc">{{__("asc")}}</option>
                    <option value="desc">{{__("desc")}}</option>
                </x-splade-select>
            </x-tomato-repeater>


            <x-splade-select v-if="`${form.type}` == 'chart'" name="fields" label="{{__('Fields')}}"
                             remote-root="model" option-label="name" option-value="name"
                             placeholder="{{__('the columns you want to show in table case')}}"
                             remote-url="`/admin/reports/getColumns/api/${form.table_name}`"/>

            <x-splade-select v-if="`${form.type}` != 'chart'" multiple name="fields" label="{{__('Fields')}}"
                             remote-root="model" option-label="name" option-value="name"
                             placeholder="{{__('the columns you want to show in table case')}}"
                             remote-url="`/admin/reports/getColumns/api/${form.table_name}`"/>

            <x-splade-input label="{{__('Rows count')}}" type='number' name="rows_count"
                            placeholder="{{__('numbers of rows you want to show')}}"/>

            <x-splade-checkbox label="{{__('Is active)}}" name="is_active" value="1" label="Is active"/>

            <x-splade-submit label="{{trans('tomato-admin::global.crud.create-new')}} {{__('Report')}}"
                             :spinner="true"/>
        </x-splade-form>
    </x-splade-modal>

</x-tomato-admin-layout>
