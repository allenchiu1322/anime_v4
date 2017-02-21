<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

//use App\Http\Controllers\Controller;
//use App\Anime\Repositories\TitleRepository;
use App\Anime\Services\ApiService;
use App\Anime\Services\DataProcessService;

/*
use Anime\Repositories\TitleRepository;
use App\Title;
 */

class ApiController extends Controller
{

    protected $apiService;
    protected $dataProcessService;

    public function __construct() {
//        $this->titleRepository = $titleRepository;
//        $this->api_service = new apiService;
        $this->apiService = new ApiService;
        $this->dataProcessService = new DataProcessService;
    }
    /*
    protected $titleRepository;

    public function __construct(TitleRepository $titleRepository) {
        $this->titleRepository = $titleRepository;
    }
     */

    /*
    //todo: 寫三種table的crud
    public function test2() {
        $title = new Title;
        $data = [
            'test_data' => $title->all(),
        ];

        return var_dump($data);
        //return json_encode($data);
    }

    public function test3() {
        $title = new Title;

        $title->title = 'test' . rand(0, 1000);
        $title->title_jp = 'test_jp';
        $title->comment = '';

        $ret = $title->save();

        var_dump($title->id);

    }

    public function test4() {
        $title = Title::firstOrNew(['title' => 'test614']);
        if ($title->exists) {

        } else {
            $title->title_jp = 'test_jp';
            $title->comment = '';
            $title->save();
        }

        var_dump($title->id);
        echo(time());

    }

    public function test5() {
        $title = Title::firstOrNew(['title' => 'test462']);
        $title->title_jp = 'test_jp' . rand(0,9999);
        $title->comment = '';
        $title->save();

        echo(time());

    }

    public function test6() {
        $title = Title::where('title', '=', 'test461')->delete();
        var_dump($title);

    }
     */

    public function test6() {
        echo('orz');
    }

    /*
    public function test7() {
        $ret = $this->titleRepository->load_test_data();
        var_dump($ret);
    }
     */

    public function test8() {
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

    public function test9(Request $request) {
        var_dump(json_decode($request->param));
    }

    public function test10() {
        return $this->apiService->format_output('100', 'OK');
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
