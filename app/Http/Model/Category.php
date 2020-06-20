<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /*
     * 返回分类
     * */
    public function getTreeCate()
    {
        $cate = $this->orderBy('sort', 'asc')->orderBy('id', 'asc')->get();
        return self::list_level($cate, 0, 0);
    }

    /*
     * 无限级分类
     * @param $level 分类级别
     * @param $pid 父级id
     * @param $data 所有分类
     **/
    public static function list_level($data, $pid, $level)
    {
        static $array = [];
        foreach ($data as $k => $v) {
            if ($pid == $v->pid) {
                $v->level = $level;
                $array[] = $v;
                self::list_level($data, $v->id, $level + 1);
            }
        }
        return $array;
    }
}
