<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;
use App\Http\Model\Category;

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

    public static function indexList($size = 10)
    {
        return self::where(["status" => 1])->orderBy('id', 'desc')->paginate($size);
    }

    public static function recommendList()
    {
        return self::where(["status" => 1, "recommend" => 1])->orderBy('updated_at', 'desc')->get();
    }

    public static function clickList()
    {
        return self::where(["status" => 1])->orderBy('views', 'desc')->limit(5)->get();
    }

    public static function cateList($id, $size = 10)
    {
        $cate_ids = (new Category())->getCateChild($id);
        return self::whereIn('cate_id', $cate_ids)->orderBy('id', 'desc')->paginate($size);
    }



}
