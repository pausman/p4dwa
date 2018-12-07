<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Schedule
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Schedule newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Schedule newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Schedule query()
 * @mixin \Eloquent
 */
class Schedule extends Model
{
    //
    public function visitors()
    {
        # withTimestamps will ensure the pivot table has its created_at/updated_at fields automatically maintained
        return $this->belongsToMany('App\Visitor')->withTimestamps();
    }
}
