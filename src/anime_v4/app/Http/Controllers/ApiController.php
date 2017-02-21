<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Anime\Services\ApiService;
use App\Anime\Services\DataProcessService;

class ApiController extends Controller
{

    protected $apiService;
    protected $dataProcessService;

    public function __construct() {
        $this->apiService = new ApiService;
        $this->dataProcessService = new DataProcessService;
    }

    public function build_api_param() {
        /*
        $param = [
            'action' => 'set',
            'type' => 'title',
            'data' => [
                'title' => '境界的彼方',
                'title_jp' => '境界の彼方',
            ]
        ];
        $param = [
            'action' => 'get',
            'type' => 'title',
            'data' => [
                'title' => '女',
            ]
        ];
         */
        $param = [
            'action' => 'delete',
            'type' => 'title',
            'data' => [
                'id' => 13,
            ]
        ];
        return json_encode($param);
    }

    public function data_process(Request $request) {

        //參數檢查
        $param = json_decode($request->param);
        $check = TRUE;
        if (!$param) {
            $ret = $this->apiService->format_output('400', 'Param Error!');
            $check = FALSE;
        } else {
            $ret = $this->apiService->format_output('200', 'OK');
        }

        //處理資料
        if ($check) {
            $result = $this->dataProcessService->process_data($param);
            if ($result === TRUE) {
                $ret = $this->apiService->format_output('200', 'OK');
            } else {
                if (is_array($result)) {
                    if ((isset($result['result']) && isset($result['message']))) {
                        $ret = $this->apiService->format_output($result['result'], $result['message'], $result['body']);
                    } else {
                        $ret = $this->apiService->format_output('500', __FILE__ . __LINE__);
                    }
                } else {
                    $ret = $this->apiService->format_output('500', __FILE__ . __LINE__);
                }
            }

        }

        return $ret;

    }
}
