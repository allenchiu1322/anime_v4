<?php
namespace App\Anime\Services;

use App\Anime\Repositories\TitleRepository;
use App\Anime\Repositories\SeiyuuRepository;
use App\Anime\Repositories\CharacterRepository;

class DataProcessService {

    protected $titleRepository;
    protected $seiyuuRepository;
    protected $characterRepository;

    public function __construct() {
        $this->titleRepository = new TitleRepository;
        $this->seiyuuRepository = new SeiyuuRepository;
        $this->characterRepository = new CharacterRepository;
    }

    public function process_data($param) {
        $check = TRUE;

        //檢查參數
        if ($check) {
            if (!in_array($param->action, array('set', 'get', 'delete'))) {
                $check = FALSE;
                $message = 'action ERROR';
            }
        }

        if ($check) {
            if (!in_array($param->type, array('title', 'seiyuu', 'character'))) {
                $check = FALSE;
                $message = 'type ERROR';
            }
        }

        //寫入參數時要有內容
        if ($check) {
            if ($param->action == 'set') {
                if ($param->type == 'title') {
                    if (($param->data->title == '') || ($param->data->title_jp == '')) {
                        $check = FALSE;
                        $message = 'data ERROR';
                    }
                } else if ($param->type == 'seiyuu') {
                    if (($param->data->seiyuu == '') || ($param->data->seiyuu_jp == '')) {
                        $check = FALSE;
                        $message = 'data ERROR';
                    }
                } else if ($param->type == 'character') {
                    if (($param->data->character == '') || ($param->data->character_jp == '') || ($param->data->seiyuu == '') || ($param->data->title == '')) {
                        $check = FALSE;
                        $message = 'data ERROR';
                    }
                }
            } else if ($param->action == 'delete') {
                if (!isset($param->data->id) || !is_numeric($param->data->id)) {
                    $check = FALSE;
                    $message = 'param ERROR';
                }
            }
        }

        //執行操作
        if ($check) {
            if ($param->action == 'set') {
                if ($param->type == 'title') {
                    $id = $this->titleRepository->set_data($param->data);
                } else if ($param->type == 'seiyuu') {
                    $id = $this->seiyuuRepository->set_data($param->data);
                } else if ($param->type == 'character') {
                    $id = $this->characterRepository->set_data($param->data);
                }
            } else if ($param->action == 'get') {
                if ($param->type == 'title') {
                    $body = $this->titleRepository->get_data($param->data);
                    $message = 'OK';
                    $result = '200';
                } else if ($param->type == 'seiyuu') {
                    $body = $this->seiyuuRepository->get_data($param->data);
                    $message = 'OK';
                    $result = '200';
                } else if ($param->type == 'character') {
                    $body = $this->characterRepository->get_data($param->data);
                    $message = 'OK';
                    $result = '200';
                }
            } else if ($param->action == 'delete') {
                if ($param->type == 'title') {
                    $id = $this->titleRepository->delete_data($param->data);
                } else if ($param->type == 'seiyuu') {
                    $id = $this->seiyuuRepository->delete_data($param->data);
                } else if ($param->type == 'character') {
                    $id = $this->characterRepository->delete_data($param->data);
                }
            }
        }

        if ($check) {
            if (isset($body)) {
                return array('result' => '200', 'message' => $message, 'body' => $body);
            } else {
                return TRUE;
            }
        } else {
            return array('result' => '403', 'message' => $message);
        }

    }

}
