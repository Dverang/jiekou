<?php namespace App\Http\Controllers;
use DB;
use Request;
class IndexController extends Controller
{
    public function index(){
        return view('index/index');
    }
}