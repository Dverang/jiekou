<?php
namespace Home\Controller;
use Think\Controller;
class ListController extends CommonController{
    //职位列表接口
    public function index(){
        $page=empty($_REQUEST['page']) ? 1 :$_REQUEST['page'];
        $page_size=empty($_REQUEST['page_size']) ? 2 : $_REQUEST['page_size'];
        $user_model=M('inviteinfo');
            $count=$user_model->count();
        $page_number=ceil($count/$page_size);
        $limit=($page-1)*$page_size;
       $user_list=$user_model->limit($limit,$page_size)->select();
        $next=$page+1>$page_number?$page_number:$page+1;
//        print_r($user_list);die;
//            if(!$user_list){
//                $this->success('','5','nononoon');
//            }
        //print_r($user_list);die;

        $this->success($user_list,0,'success',$page_number,$next);
    }

}