<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        $this->display('Index/index');
    }
    public function httppost(){
        $url = "http://localhost/10/jiekou/tp/Home/Interface/login";
        $email = $_POST['email'];
        $password = $_POST['password'];
        if (($ch = curl_init($url)) == false) {
            throw new Exception(sprintf("curl_init error for url %s.", $url));
        }
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 600);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        $postResult = @curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
//        if ($postResult === false || $http_code != 200 || curl_errno($ch)) {
//            $error = curl_error($ch);
//            curl_close($ch);
//            throw new Exception("HTTP POST FAILED:$error");
//        } else {
//            // $postResult=str_replace("\xEF\xBB\xBF", '', $postResult);
//            switch (curl_getinfo($ch, CURLINFO_CONTENT_TYPE)) {
//                case 'application/json':
//                    $postResult = json_decode($postResult);
//                    break;
//            }
//            curl_close($ch);
//            return $postResult;
//        }
    }
    public function login(){
        $postUrl = "http://localhost/10/jiekou/tp/Home/Interface/login";
            $email = $_GET['email'];
            $password = $_GET['password'];
        $res = httpPost($postUrl); //$parms
        $res = json_decode($res);
        print_r(urldecode(json_encode($res)));
    }
}