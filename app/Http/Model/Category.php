<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    /**
     * @param $id
     * @return array
     */
    public static function getOne($id)
    {
        $data = self::select(['id', 'cate_name', 'keywords', 'description'])->where(['id' => $id, 'status' => 1])->get()->toArray();
        return empty($data) ? [] : $data[0];
    }

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

    /**
     * 返回顶级分类
     * @return mixed
     */
    public static function getTopCate()
    {
        return self::where(["status" => 1, "pid" => 0])->orderBy('sort', 'asc')->orderBy('id', 'asc')->get();
    }

    /**
     * 获取当前分类的子分类
     * @param $id
     * @return array
     */
    public function getCateChild($id)
    {
        $data = $this->select(['id', 'pid'])->where(['status' => 1])->get()->toArray();
        $array = $this->_getChildren($data, $id);
        $array[] = $id;
        return $array;
    }

    /**
     * @param $data
     * @param $id
     * @return array
     */
    private function _getChildren($data, $id)
    {
        static $res = [];
        foreach ($data as $v) {
            if ($v['pid'] == $id) {
                $res[] = $v['id'];
                $this->_getchildren($data, $v['id']);
            }
        }
        return $res;
    }

}
