<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    //
    public function category()
    {
        return $this->hasOne('App\Http\Model\Category', 'id', 'cate_id');
    }

    public function user()
    {
        return $this->belongsTo('App\Http\Model\AdminUser', 'u_id', 'id');
    }

    public function label()
    {
        return $this->hasOne('App\Http\Model\Label', 'id', 'label_id');
    }
}
