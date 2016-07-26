<?php namespace App\Http\Controllers;
use DB;
use Request;
class PersonalController extends Controller
{
    public function index(){
        return view('personal/personal');
    }
}