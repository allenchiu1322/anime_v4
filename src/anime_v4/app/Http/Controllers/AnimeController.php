<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View;
use Route;

class AnimeController extends Controller
{

    public function __construct() {
        //給template偵測目前網址用
        list($route, $action) = explode('@', Route::getCurrentRoute()->getActionName());
        View::share('route', $route);
        View::share('action', $action);

        $a_title = '';
        $a_seiyuu = '';
        $a_character = '';
        $a_maintain = '';

        if ($action == 'title') {
            $a_title = ' active';
        } else if ($action == 'seiyuu') {
            $a_seiyuu = ' active';
        } else if ($action == 'character') {
            $a_character = ' active';
        } else if ($action == 'maintain') {
            $a_maintain = ' active';
        }

        View::share('a_title', $a_title);
        View::share('a_seiyuu', $a_seiyuu);
        View::share('a_character', $a_character);
        View::share('a_maintain', $a_maintain);
    }

    public function index() {
        return view('index');
    }

    public function title() {
        return view('title');
    }

    public function seiyuu() {
        return view('seiyuu');
    }

    public function character() {
        return view('character');
    }

    public function maintain() {
        return view('maintain');
    }

}
