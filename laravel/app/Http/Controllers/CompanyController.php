<?php namespace App\Http\Controllers;
use DB;
use Request;
class CompanyController extends Controller
{
    public function index(){
        return view('company/company');
    }
}