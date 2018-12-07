<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Visitor
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Visitor newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Visitor newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Visitor query()
 * @mixin \Eloquent
 */
class Visitor extends Model
{
    //
    public function schedules()
    {
        # withTimestamps will ensure the pivot table has its created_at/updated_at fields automatically maintained
        return $this->belongsToMany('App\Schedule')->withTimestamps();
    }
}
