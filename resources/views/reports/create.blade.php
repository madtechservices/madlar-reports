<x-tomato-admin-layout>
    <x-slot name="header">
        <h1 class="text-2xl font-bold mb-4">{{trans('tomato-admin::global.crud.create')}} {{__('Report')}}</h1>
    </x-slot>


    <div class="my-4">
        <x-splade-form :default="[
            'conditions' => [],
            'aggregate' => [],
            'type' => 'table',
            'table_name' => array_keys(config('tomato-sauce.schema'))[0]
        ]" class="flex flex-col space-y-4" action="{{route('admin.reports.store')}}" method="post" >


            <x-splade-data default="{tab: 'tab1'}">
               <div class="flex justify-start">
                   <button class="border py-2 px-6 rounded-lg" :class="{'bg-primary-500 text-white hover:bg-primary-700': data.tab ==='tab1'}" @click.prevent="data.tab = 'tab1'">
                       Select Type
                   </button>
                   <button class="border py-2 px-6 rounded-lg mx-2" :class="{'bg-primary-500 text-white hover:bg-primary-700': data.tab ==='tab2'}" @click.prevent="data.tab = 'tab2'">
                       Report Details
                   </button>
                   <button class="border py-2 px-6 rounded-lg mx-2" :class="{'bg-primary-500 text-white hover:bg-primary-700': data.tab ==='tab3'}" @click.prevent="data.tab = 'tab3'">
                       Conditions
                   </button>
               </div>

                <div v-show="data.tab === 'tab1'" class="border bg-white shadow-sm rounded-lg py-4 px-4">
                    <div class="flex flex justify-center">
                        <div @click="form.type = 'table'" :class="{'bg-primary-500 text-white': form.type === 'table'}" class="cursor-pointer flex flex-col justify-center border py-4 px-4 rounded-lg bg-gray-200 h-32 w-32">
                            <div>
                                <div class="flex flex-col justify-center">
                                    <i :class="{'text-white': form.type === 'table', ' text-primary-500': form.type !== 'table'}" class="bx bx-table bx-lg text-center"></i>
                                </div>
                                <h1 class="text-center font-bold text-xl mt-4" >Table</h1>
                            </div>
                        </div>
                        <div @click="form.type = 'widget'" :class="{'bg-primary-500 text-white': form.type === 'widget'}" class="cursor-pointer flex flex-col justify-center border py-4 px-4 rounded-lg bg-gray-200 h-32 w-32 mx-4">
                            <div>
                                <div class="flex flex-col justify-center">
                                    <i :class="{'text-white': form.type === 'table', ' text-primary-500': form.type !== 'widget'}" class="bx bxs-widget bx-lg text-center"></i>
                                </div>
                                <h1 class="text-center font-bold text-xl mt-4">Widget</h1>
                            </div>
                        </div>
                        <div @click="form.type = 'chart'" :class="{'bg-primary-500 text-white': form.type === 'chart'}" class="cursor-pointer flex flex-col justify-center border py-4 px-4 rounded-lg bg-gray-200 h-32 w-32">
                            <div>
                                <div class="flex flex-col justify-center">
                                    <i :class="{'text-white': form.type === 'table', ' text-primary-500': form.type !== 'chart'}" class="bx bx-chart bx-lg text-center"></i>
                                </div>
                                <h1 class="text-center font-bold text-xl mt-4">Chat</h1>
                            </div>
                        </div>
                    </div>
                    <hr class="my-4">
                    <div class="flex justify-end">
                        <button @click.prevent="data.tab='tab2'" class="border py-2 px-6 rounded-lg bg-primary-500 text-white hover:bg-primary-700">
                            Next
                        </button>
                    </div>
                </div>
                <div v-show="data.tab === 'tab2'" class="border bg-white shadow-sm rounded-lg py-4 px-4 flex flex-col space-y-4">
                    <x-splade-input label="{{__('Report name')}}" name="report_name" type="text"
                                    placeholder="{{__('the title of this report')}}"/>

                    <x-splade-select name="table_name" label="{{__('Table Name')}}"
                                     placeholder="{{__('choose the main table')}}">
                        @php $tables = array_keys(config('tomato-sauce.schema')); @endphp
                        @foreach($tables as $table)
                            <option value="{{$table}}">{{(__($table))}}</option>
                        @endforeach
                    </x-splade-select>

                    <x-splade-select v-show="form.table_name" choices multiple name="joins" label="{{__('Table Relations')}}" remote-root="model"
                                     option-label="name"
                                     option-value="name" help="{{__('choose the relations of the main table name')}}"
                                     remote-url="`/admin/reports/getJoins/api/${form.table_name}`"/>

                    <x-splade-select choices v-if="`${form.type}` == 'chart' && `${form.type}` != 'widget'" name="fields" label="{{__('Fields')}}"
                                     remote-root="model" option-label="name" option-value="name"
                                     help="{{__('the columns you want to show in table case')}}"
                                     remote-url="`/admin/reports/getColumns/api/${form.table_name}`"/>

                    <x-splade-select v-if="`${form.type}` != 'chart' && `${form.type}` != 'widget'" multiple choices name="fields" label="{{__('Fields')}}"
                                     remote-root="model" option-label="name" option-value="name"
                                     help="{{__('the columns you want to show in table case')}}"
                                     remote-url="`/admin/reports/getColumns/api/${form.table_name}`"/>

                    <x-splade-input v-if="`${form.type}` === 'table'" label="{{__('Rows count')}}" type='number' name="rows_count" placeholder="{{__('numbers of rows you want to show')}}"/>

                    <x-splade-checkbox label="{{ __('Is active') }}" name="is_active" value="1" label="Is active" />



                    <hr class="my-4">
                    <div class="flex justify-end">
                        <button @click.prevent="data.tab='tab3'" :disabled="form.report_name === ''" :class="{'bg-gray-400  hover:bg-gray-300 cursor-not-allowed': form.report_name === '', 'bg-primary-500  hover:bg-primary-700 cursor-pointer': form.report_name !== ''}"  class="border py-2 px-6 rounded-lg  text-white">
                            Next
                        </button>
                    </div>
                </div>
                <div v-show="data.tab === 'tab3'" class="border  bg-white shadow-sm rounded-lg py-4 px-4 flex flex-col space-y-4">
                    <span class="block mb-1 text-gray-700 font-sans dark:text-white">{{__("Conditions")}}</span>
                    <x-tomato-repeater :options="['column', 'operator', 'value']" type="repeater" id="conditions" name="conditions"
                                       label="{{__('conditions')}}">

                        <div class="flex flex-col space-y-4">
                            <x-splade-select choices v-model="repeater.main[key].column" name="column" label="{{__('column name')}}"
                                             remote-root="model" option-label="name" option-value="name"
                                             help="{{__('the column which you want to perform a condition')}}"
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
                        </div>
                    </x-tomato-repeater>

                    <span class="block mb-1 text-gray-700 font-sans dark:text-white">{{__("Aggregations")}}</span>

                    <x-tomato-repeater :options="['columns', 'type', 'dir']" type="repeater" id="aggregate" name="aggregate"
                                       label="{{__('aggregate')}}">

                        <div class="flex flex-col space-y-4">
                            <x-splade-select choices v-model="repeater.main[key].columns" name="columns"
                                             label="{{__('column name')}}" remote-root="model" option-label="name"
                                             option-value="name"
                                             placeholder="{{__('column name')}}"
                                             remote-url="`/admin/reports/getColumns/api/${form.table_name}`" required/>

                            <x-splade-select v-model="repeater.main[key].type" name="type" label="{{__('type')}}"
                                             placeholder="type" required>
                                <option value="group">group</option>
                                <option value="count">count</option>
                                <option value="order">order</option>
                            </x-splade-select>
                            <x-splade-select v-model="repeater.main[key].dir" name="dir" label="{{__('dir')}}" placeholder="dir" required>
                                <option value="asc">{{__("asc")}}</option>
                                <option value="desc">{{__("desc")}}</option>
                            </x-splade-select>
                        </div>
                    </x-tomato-repeater>

                    <span class="block mb-1 text-gray-500 font-sans dark:text-white">{{__("if you are select widget type you must set an aggregate")}}</span>

                    <hr class="my-4">
                    <div class="flex justify-end">
                        <button type="submit" :disabled="form.report_name === '' || (form.aggregate.length < 1 && form.type === 'widget')" :class="{'bg-gray-400  hover:bg-gray-300 cursor-not-allowed': form.report_name === '' || (form.aggregate.length < 1 && form.type === 'widget'), 'bg-primary-500  hover:bg-primary-700 cursor-pointer': !(form.report_name === '' || (form.aggregate.length < 1 && form.type === 'widget'))}"  class="border py-2 px-6 rounded-lg  text-white">
                            {{  trans('tomato-admin::global.crud.create-new') }} {{__('Report')}}
                        </button>
                    </div>
                </div>
            </x-splade-data>
        </x-splade-form>
    </div>

</x-tomato-admin-layout>
