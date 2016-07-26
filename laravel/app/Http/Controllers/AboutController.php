<?php namespace App\Http\Controllers;
use DB;
use Request;
class AboutController extends Controller
{
    public function index(){
        return view('about/about');
    }
}