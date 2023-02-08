<?php

namespace TomatoPHP\TomatoSauce\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $type
 * @property string $table_name
 * @property string $aggregate
 * @property integer $rows_count
 * @property mixed $fields
 * @property string $created_at
 * @property string $updated_at
 */
class Report extends Model
{
    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';
    protected $casts = ['fields'=>"array",'joins'=>"array",'aggregate'=>"array","conditions"=>"array"];

    /**
     * @var array
     */
    protected $guarded = ['id'];
}
