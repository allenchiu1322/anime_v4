<?php
namespace App\Anime\Services;
//use App\Anime\Repositories\TitleRepository;

use Illuminate\Http\Response;

class ApiService {

//    private $title;

    /*
    public function __construct(Title $title) {
        $this->title = $title;
    }
     */

//    public function load_test_data() {
//        $title_repo = new TitleRepository();
//        $data = $title_repo->get_all();
//        return $data;
//        /*
//        $test_data = $this->title->get();
//        return $test_data;
//         */
//    }

    public function format_output($code, $message, $body = '') {
        $ret = [
            'result' => $code,
            'message' => $message,
            'body' => $body,
        ];
        return response()->json($ret);
    }
}
