<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function vueTest()
    {

        return view('tests.vueTest');
    }

    public function vueTestPost($id)
    {
        return $id;
    }
}
