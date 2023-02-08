<x-splade-modal class="font-main">
    <h1 class="text-2xl font-bold mb-4">{{trans('tomato-admin::global.crud.view')}} {{__('Report')}} #{{$model->id}}</h1>

    <div class="flex flex-col space-y-4">
        
          <div class="flex justify-between">
              <div>
                  <h3 class="text-lg font-bold">
                      {{__('Page name')}}
                  </h3>
              </div>
              <div>
                  <h3 class="text-lg">
                      {{ $model->page_name}}
                  </h3>
              </div>
          </div>

          <div class="flex justify-between">
              <div>
                  <h3 class="text-lg font-bold">
                      {{__('Report name')}}
                  </h3>
              </div>
              <div>
                  <h3 class="text-lg">
                      {{ $model->report_name}}
                  </h3>
              </div>
          </div>

          <div class="flex justify-between">
              <div>
                  <h3 class="text-lg font-bold">
                      {{__('Type')}}
                  </h3>
              </div>
              <div>
                  <h3 class="text-lg">
                      {{ $model->type}}
                  </h3>
              </div>
          </div>

          <div class="flex justify-between">
              <div>
                  <h3 class="text-lg font-bold">
                      {{__('Sort')}}
                  </h3>
              </div>
              <div>
                  <h3 class="text-lg">
                      {{ $model->sort}}
                  </h3>
              </div>
          </div>

          <div class="flex justify-between">
              <div>
                  <h3 class="text-lg font-bold">
                      {{__('Table name')}}
                  </h3>
              </div>
              <div>
                  <h3 class="text-lg">
                      {{ $model->table_name}}
                  </h3>
              </div>
          </div>

          
          
          
          <div class="flex justify-between">
              <div>
                  <h3 class="text-lg font-bold">
                      {{__('Rows count')}}
                  </h3>
              </div>
              <div>
                  <h3 class="text-lg">
                      {{ $model->rows_count}}
                  </h3>
              </div>
          </div>

          
          <div class="flex justify-between">
              <div>
                  <h3 class="text-lg font-bold">
                      {{__('Is active')}}
                  </h3>
              </div>
              <div>
                  <h3 class="text-lg">
                      {{ $model->is_active}}
                  </h3>
              </div>
          </div>

    </div>
</x-splade-modal>
