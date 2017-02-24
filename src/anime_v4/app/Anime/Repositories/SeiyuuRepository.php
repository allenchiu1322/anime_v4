<?php
namespace App\Anime\Repositories;

use Illuminate\Database\Eloquent\Collection;
use App\Seiyuu;

class SeiyuuRepository {

    public function set_data($data) {

        $seiyuu = Seiyuu::firstOrNew(['seiyuu' => $data->seiyuu ]);
        $seiyuu->seiyuu_jp = $data->seiyuu_jp;
        if (isset($data->comment)) {
            $seiyuu->comment = $data->comment;
        } else {
            $seiyuu->comment = '';
        }
        $seiyuu->save();

        $id = $seiyuu->id;

        return $id;

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

        if (isset($data->orderby) && in_array($data->limit, array('seiyuu'))) {
            $orderby = $data->orderby;
        } else {
            $orderby = 'id';
        }

        //取資料
        if (isset($data->id) && is_numeric($data->id)) {
            $ret = Seiyuu::where('id', '=', $data->id)->get();
        } else if (isset($data->seiyuu) && is_string($data->seiyuu) && ($data->seiyuu <> '')) {
            $ret = Seiyuu::where('seiyuu', 'LIKE', '%' . $data->seiyuu . '%')->offset($offset)->limit($limit)->orderby($orderby)->get();
        } else {
            $ret = Seiyuu::offset($offset)->limit($limit)->orderby($orderby)->get();
        }

        return $ret;

    }

    public function delete_data($data) {
        $ret = Seiyuu::where('id', '=', $data->id)->delete();
        return $ret;
    }

}

