<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    //
    public function category()
    {
        $this->hasOne('App\Http\Model\Category', 'id', 'cate_id');
    }

    public function user()
    {
        $this->belongsTo('App\Http\Model\AdminUser', 'id', 'u_id');
    }

    public function label()
    {
        $this->hasOne('App\Http\Model\Label', 'id', 'label_id');
    }
}
