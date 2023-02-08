<x-splade-modal class="font-main">
    <h1 class="text-2xl font-bold mb-4">{{trans('tomato-admin::global.crud.edit')}} {{__('Report')}} #{{$model->id}}</h1>

    <x-splade-form class="flex flex-col space-y-4" action="{{route('admin.reports.update', $model->id)}}" method="post" :default="$model">
        
          <x-splade-input label="{{__('Page name')}}" name="page_name" type="text"  placeholder="Page name" />
          <x-splade-input label="{{__('Report name')}}" name="report_name" type="text"  placeholder="Report name" />
          <x-splade-input label="{{__('Type')}}" name="type" type="text"  placeholder="Type" />
          <x-splade-input label="{{__('Sort')}}" type='number' name="sort" placeholder="Sort" />
          <x-splade-input label="{{__('Table name')}}" name="table_name" type="text"  placeholder="Table name" />
          
          
          
          <x-splade-input label="{{__('Rows count')}}" type='number' name="rows_count" placeholder="Rows count" />
          
          <x-splade-checkbox label="{{__('Is active)}}" name="is_active" value="1" label="Is active" />

        <x-splade-submit label="{{trans('tomato-admin::global.crud.update')}} {{__('Report')}}" :spinner="true" />
    </x-splade-form>
</x-splade-modal>
