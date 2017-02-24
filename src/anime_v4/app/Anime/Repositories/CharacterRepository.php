<?php
namespace App\Anime\Repositories;

use Illuminate\Database\Eloquent\Collection;
use App\Character;

use App\Anime\Repositories\TitleRepository;
use App\Anime\Repositories\SeiyuuRepository;

class CharacterRepository {

    protected $titleRepository;
    protected $seiyuuRepository;

    public function __construct() {
        $this->titleRepository = new TitleRepository;
        $this->seiyuuRepository = new SeiyuuRepository;
    }

    public function set_data($data) {

        //先建立作品和聲優資料
        $title = $this->titleRepository->set_data((object)[
            'title' => $data->title,
            'title_jp' => '',
        ]);
        $seiyuu = $this->seiyuuRepository->set_data((object)[
            'seiyuu' => $data->seiyuu,
            'seiyuu_jp' => '',
        ]);

        $character = Character::firstOrNew(['character' => $data->character ]);
        $character->character_jp = $data->character_jp;
        if (isset($data->comment)) {
            $character->comment = $data->comment;
        } else {
            $character->comment = '';
        }
        $character->title = $title;
        $character->seiyuu = $seiyuu;
        $character->save();

        $id = $character->id;

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

        if (isset($data->orderby) && in_array($data->limit, array('character'))) {
            $orderby = $data->orderby;
        } else {
            $orderby = 'id';
        }

        //取資料
        if (isset($data->id) && is_numeric($data->id)) {
            $ret = Character::where('id', '=', $data->id)->get();
        } else if (isset($data->character) && is_string($data->character) && ($data->character <> '')) {
            $ret = Character::where('character', 'LIKE', '%' . $data->character . '%')->offset($offset)->limit($limit)->orderby($orderby)->get();
        } else {
            $ret = Character::offset($offset)->limit($limit)->orderby($orderby)->get();
        }

        return $ret;

    }

    public function delete_data($data) {
        $ret = Character::where('id', '=', $data->id)->delete();
        return $ret;
    }

}

