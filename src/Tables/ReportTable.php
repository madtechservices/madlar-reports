<?php

namespace Tomatophp\TomatoSauce\Tables;

use Illuminate\Http\Request;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\Facades\Toast;
use ProtoneMedia\Splade\SpladeTable;

class ReportTable extends AbstractTable
{
    /**
     * Create a new instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the user is authorized to perform bulk actions and exports.
     *
     * @return bool
     */
    public function authorize(Request $request)
    {
        return true;
    }

    /**
     * The resource or query builder.
     *
     * @return mixed
     */
    public function for()
    {
        return \TomatoPHP\TomatoSauce\Models\Report::query();
    }

    /**
     * Configure the given SpladeTable.
     *
     * @param \ProtoneMedia\Splade\SpladeTable $table
     * @return void
     */
    public function configure(SpladeTable $table)
    {
        $table
            ->withGlobalSearch(label: trans('tomato-admin::global.search'),columns: ['id',])
            ->bulkAction(
                label: trans('tomato-admin::global.crud.delete'),
                each: fn (\TomatoPHP\TomatoSauce\Models\Report $model) => $model->delete(),
                after: fn () => Toast::danger('Report Has Been Deleted')->autoDismiss(2),
                confirm: true
            )
            ->export()
            ->defaultSort('id')
            ->column(
                label: __('Id'),
                key: 'id',
                sortable: true)
            ->column(
                label: __('Name'),
                key: 'report_name',
                sortable: true)
            ->column(
                label: __('Type'),
                key: 'type',
                sortable: true)
            ->column(
                label: __('Table'),
                key: 'table_name',
                sortable: true)
            ->column(
                label: __('Is Active?'),
                key: 'is_active',
                sortable: true)
            ->column(key: 'actions',label: trans('tomato-admin::global.crud.actions'))
            ->paginate(15);
    }
}
