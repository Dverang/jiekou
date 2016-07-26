<?php
namespace Home\Controller;

use Think\Controller;

class CommonController extends Controller
{
    /**
     * 失败输出
     */
    public function failure( $error_status = 1 , $error_msg = 'ERROR' , $error_data = array() , $other_data = array() ){

        //拼装数据
        $error_arr = array();

        //失败的状态码
        $error_arr['status'] = $error_status;

        //失败的提示信息
        $error_arr['msg'] = $error_msg;

        //失败返回的错误数据
        $error_arr['data'] = $error_data;

       return json_encode( $error_arr);

    }
//    /**
//     * 成功输出
//     */
//    public function success($data = array() ,$success_status = 0 , $success_msg = 'success',$other_data="",$page=""){
//        //拼装数据
//        $error_arr = array();
//        //失败的状态码
//        $error_arr['status'] = $success_status;
//
//        //失败的提示信息
//        $error_arr['msg'] = $success_msg;
//
//        //失败返回的错误数据
//        $error_arr['data'] = $data;
//        $error_arr['other_data'] = $other_data;
//        $error_arr['page'] = $page;
//        echo json_encode($error_arr);
//    }
    /**
     * 成功输出
     */
    public function success($data = array() ,$success_status = 0 , $success_msg = 'success',$other_data="",$page="",$token="",$uid=""){
        //拼装数据
        $error_arr = array();
        //失败的状态码
        $error_arr['status'] = $success_status;

        //失败的提示信息
        $error_arr['msg'] = $success_msg;

        //失败返回的错误数据
        $error_arr['data'] = $data;
        $error_arr['other_data'] = $other_data;
        $error_arr['page'] = $page;
        $error_arr['token'] = $token;
        $error_arr['uid'] = $uid;
        echo json_encode($error_arr);
    }
}