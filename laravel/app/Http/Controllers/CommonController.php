<?php
namespace App\Http\Controllers;
//use App\Http\Controllers\Controller;
use DB;
use Request;
//use Illuminate\Session;
header("content-type:text/html;charset=utf-8");
class CommonController extends Controller
{
    public function __construct(){
        session_start();
        $uid=$_SESSION["uid"];
        $token=$_SESSION["token"];
//        echo $uid;die;
//        $data['uid']=$uid;
//        $data['token']=$token;
//        $url="";
//        $this->curl($url,$data);
        $users = DB::table('job_token')->where('uid', '=',$uid)->where('token','=',$token)->get();
//        print_r($users);die;
        if(!$users){
            session_destroy();
            echo "<script>alert('账号已在别处登录，被迫下线');location.href='http://www.lg.com/jiekou/laravel/public'</script>";
        }

    }
}