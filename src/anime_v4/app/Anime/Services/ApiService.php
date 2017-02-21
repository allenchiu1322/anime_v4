<?php
namespace App\Anime\Services;

use Illuminate\Http\Response;

class ApiService {

    public function format_output($code, $message, $body = '') {
        $ret = [
            'result' => $code,
            'message' => $message,
            'body' => $body,
        ];
        return response()->json($ret);
    }
}
