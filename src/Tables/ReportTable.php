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
        return \Modules\Reports\Entities\Report::query();
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
                each: fn (\Modules\Reports\Entities\Report $model) => $model->delete(),
                after: fn () => Toast::danger('Report Has Been Deleted')->autoDismiss(2),
                confirm: true
            )
            ->export()
            ->defaultSort('id')
            ->column(
                label: 'Id',
                key: 'id',
                sortable: true)
            ->column(
                label: 'Page_name',
                key: 'page_name',
                sortable: true)
            ->column(
                label: 'Report_name',
                key: 'report_name',
                sortable: true)
            ->column(
                label: 'Type',
                key: 'type',
                sortable: true)
            ->column(
                label: 'Sort',
                key: 'sort',
                sortable: true)
            ->column(
                label: 'Table_name',
                key: 'table_name',
                sortable: true)
            ->column(
                label: 'Joins',
                key: 'joins',
                sortable: true)
            ->column(
                label: 'Conditions',
                key: 'conditions',
                sortable: true)
            ->column(
                label: 'Aggregate',
                key: 'aggregate',
                sortable: true)
            ->column(
                label: 'Rows_count',
                key: 'rows_count',
                sortable: true)
            ->column(
                label: 'Fields',
                key: 'fields',
                sortable: true)
            ->column(
                label: 'Is_active',
                key: 'is_active',
                sortable: true)
            ->column(key: 'actions',label: trans('tomato-admin::global.crud.actions'))
            ->paginate(15);
    }
}
