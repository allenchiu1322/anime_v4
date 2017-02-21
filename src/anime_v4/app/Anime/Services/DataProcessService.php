<?php
namespace App\Anime\Services;

use App\Anime\Repositories\TitleRepository;

class DataProcessService {

    protected $titleRepository;

    public function __construct() {
        $this->titleRepository = new TitleRepository;
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

                }
            } else if ($param->action == 'get') {
                if ($param->type == 'title') {

                    $body = $this->titleRepository->get_data($param->data);
                    $message = 'OK';
                    $result = '200';

                }
            } else if ($param->action == 'delete') {
                if ($param->type == 'title') {

                    $id = $this->titleRepository->delete_data($param->data);

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
