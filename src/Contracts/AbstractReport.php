<?php


namespace TomatoPHP\TomatoSauce\Contracts;


use Illuminate\Support\Facades\DB;
use TomatoPHP\TomatoSauce\Models\Report;

class AbstractReport
{
    protected array $schema;

    protected Report $model;

    protected mixed $builder;


    /**
     * AbstractReport constructor.
     */
    public function __construct()
    {
        $this->schema = config('tomato-sauce.schema');
    }

    /**
     * @param Report $model
     * @return AbstractReport
     */
    public function setModel(Report $model): static
    {
        $this->builder = DB::table($model->table_name);
        $this->model = $model;

        return $this;
    }


    protected function makeJoin()
    {
        if (isset($this->model->joins))
            foreach ($this->model->joins as $join) {
                $this->builder->join($join['name'], $this->schema[$this->model->table_name]['relationships'][$join['name']]['first'], '=', $this->schema[$this->model->table_name]['relationships'][$join['name']]['second']);
            }
    }

    protected function makeCondition()
    {
        if (isset($this->model->conditions))
            foreach ($this->model->conditions as $condition) {
                $this->builder->where($condition['column'], $condition['operator'], $condition['value']);
            }

    }

    protected function makeFields()
    {
        if (isset($this->model->fields) && !empty($this->model->fields))
            $this->builder->select($this->model->fields[0]["label"]);
    }

    protected function makeAggregate()
    {
        if (isset($this->model->aggregate) && !empty($this->model->aggregate))
            foreach ($this->model->aggregate as $aggregate) {

                if ($aggregate['type'] == 'group') {
                    if (str_contains($aggregate['columns'], "created_at")) {
                        $this->builder->addSelect(DB::raw('DATE(' . $aggregate["columns"] . ') as aggregate_date'));

                        $aggregate['columns'] = 'aggregate_date';
                    }

                    $this->builder->groupBy($aggregate['columns']);

                }
                if ($aggregate['type'] == 'count')
                    $this->builder->addSelect(DB::raw('count(' . $aggregate["columns"] . ') as data_values'));
                if ($aggregate['type'] == 'order')
                    $this->builder->orderBy($aggregate["columns"], $aggregate['dir']);

            }
    }

    protected function makeGetter()
    {
        if (isset($this->model->rows_count) && !empty($this->model->rows_count))
            $this->builder = $this->builder->limit($this->model->rows_count)->get();
        else
            $this->builder = $this->builder->get();
    }

}
