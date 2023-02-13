<?php

namespace TomatoPHP\TomatoSauce\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use ProtoneMedia\Splade\Facades\Toast;
use TomatoPHP\TomatoPHP\Services\Tomato;
use TomatoPHP\TomatoSauce\Models\Report;

class ReportController extends Controller
{
    /**
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        return Tomato::index(
            request: $request,
            view: 'tomato-sauce::reports.index',
            table: \TomatoPHP\TomatoSauce\Tables\ReportTable::class,
        );
    }

    //TODO: to use on update method

    // public function edit(\TomatoPHP\TomatoSauce\Models\Report $model): View
    // {
    //     // $model->fields = $model->fields[0]['label'];
    //     return view('tomato-sauce::reports.edit', [
    //         "model" => $model
    //     ]);
    // }

    /**
     * @param array $columns
     * @return array
     */
    private function castArray(array $columns): array
    {

        $data = [];
        foreach (collect($columns)->pluck('name')->toArray() as $key => $cast) {
            $data[] = ["name" => $cast];
        }
        return $data;

    }

    /**
     * @param $table
     * @return JsonResponse
     */
    public function getJoins($table): JsonResponse
    {
        $casts = config('tomato-sauce.schema')[$table]['relationships'] ?? [];

        if (!empty($casts))
            $casts = $this->castArray($casts);

        return response()->json([
            'model' => $casts,
        ]);
    }

    /**
     * @param $table
     * @return JsonResponse
     */
    public function getColumns($table): JsonResponse
    {
        $columns = config('tomato-sauce.schema')[$table]['columns'] ?? [];

        if (!empty($columns)){
            $data = [];
            foreach ($columns as $key => $column) {
                foreach ($column as $item)
                $data[] = ["name" => $key.'.'.$item];
            }
        }

        return response()->json([
            'model' => $data,
        ]);
    }

    /**
     * @return View
     */
    public function create(): View
    {

        if (config('tomato-sauce.schema'))
            return Tomato::create(view: 'tomato-sauce::reports.create');

        Toast::title(__("You Need To File Report Config First"))->danger()->autoDismiss(5);
        return view('tomato-sauce::reports.index');

    }

    /**
     * @param \TomatoPHP\TomatoSauce\Http\Requests\Report\ReportStoreRequest $request
     * @return RedirectResponse
     */
    public function store(\TomatoPHP\TomatoSauce\Http\Requests\Report\ReportStoreRequest $request): RedirectResponse
    {
        $sorts = ["widget" => 1, "chart" => 2, "table" => 3];
        $request->validated();
        $data = $request->all();
        if (isset($data['fields']) && !empty($data['fields']))
            $data['fields'] = [
                ["label" => (gettype($data['fields']) == 'array') ? array_values($data['fields']) : [$data['fields']]]
            ];
        else
            $data['fields'] = [];
        $temp = [];
        if (isset($data['joins']) && !empty($data['joins']))
            foreach ($data['joins'] as $table)
                $temp[] = ["name" => $table];
        $data['joins'] = $temp;

        $data['sort'] = $sorts[$data['type']];
        $data['page_name'] = "testPage";

        $record = Report::create($data);


        Toast::title("done")->success()->autoDismiss(2);
        return redirect()->route('admin.reports.index');
    }

    public function destroy(\TomatoPHP\TomatoSauce\Models\Report $model): RedirectResponse
    {
        return Tomato::destroy(
            model: $model,
            message: 'Report deleted successfully',
            redirect: 'admin.reports.index',
        );
    }
}
