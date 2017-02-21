<?php
namespace App\Anime\Repositories;

use Illuminate\Database\Eloquent\Collection;
use App\Title;

class TitleRepository {

    public function set_data($data) {

        $title = Title::firstOrNew(['title' => $data->title ]);
        if ($title->exists) {

        } else {
            $title->title_jp = $data->title_jp;
            if (isset($data->comment)) {
                $title->comment = $data->comment;
            } else {
                $title->comment = '';
            }
            $title->save();
        }

        $id = $title->id;

    }

    public function get_data($data) {
        //取用資料限制參數，否則給預設值
        if (isset($data->offset) && is_numeric($data->offset)) {
            $offset = $data->offset;
        } else {
            $offset = 0;
        }

        if (isset($data->limit) && is_numeric($data->limit)) {
            $limit = $data->limit;
        } else {
            $limit = 10;
        }

        if (isset($data->orderby) && in_array($data->limit, array('title'))) {
            $orderby = $data->orderby;
        } else {
            $orderby = 'id';
        }

        //取資料
        if (isset($data->id) && is_numeric($data->id)) {
            $ret = Title::where('id', '=', $data->id)->get();
        } else if (isset($data->title) && is_string($data->title) && ($data->title <> '')) {
            $ret = Title::where('title', 'LIKE', '%' . $data->title . '%')->offset($offset)->limit($limit)->orderby($orderby)->get();
        } else {
            $ret = Title::offset($offset)->limit($limit)->orderby($orderby)->get();
        }

        return $ret;

    }

    public function delete_data($data) {
        $ret = Title::where('id', '=', $data->id)->delete();
        return $ret;
    }

}

