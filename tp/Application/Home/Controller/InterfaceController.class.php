<?php
namespace Home\Controller;
use Think\Controller;
class InterfaceController extends CommonController{
    //登陆接口
    public function login(){
        if(empty($_REQUEST['email'])){
            echo $this->failure(2, '邮箱不能为空');
            die;
        }else{
            $email=$_REQUEST['email'];
        }
        if(empty($_REQUEST['password'])){
            echo $this->failure(2, '密码不能为空');
            die;
        }else{
            $password=$_REQUEST['password'];
        }
        $User = M("users"); // 实例化User对象// 查找status值为1name值为think的用户数据
        $user_token=M("job_token");
        $data = $User->where("email='$email' AND pwd='$password'")->find();
        if(empty($data)){
            echo $this->failure(2, '账号或密码不正确');
            die;
        }else{
            $uid=$data['id'];
            $where=array(
                'uid'=>$uid,
            );
            $token=$user_token->where($where)->find();
            if(empty($token)){
                $token=md5($data['id']).rand(1,20);
                $data['uid'] = $data['id'];
                $data['token'] = $token;
                $data['edittime']=time();
                $user_token->add($data);
            }else
            {
                $token=md5($data['id']).rand(1,20);
//                echo $token;die;
                $data['token'] = $token;
                $data['edittime']=time();
                $user_token->where("uid=$uid")->save($data); // 根据条件更新记录
            }
//            echo $this->failure(0,'登陆成功',$data,$token,$uid);
            echo $this->success($data,'0','登陆成功','','',$token,$uid);
            exit;
        }
    }
    //注册接口
    public function register(){
        if(empty($_REQUEST['email'])){
            echo $this->failure(2, '邮箱不能为空');
            die;
        }else{
            $email=$_REQUEST['email'];
            $reg='/^[0-9a-zA-Z]+@(([0-9a-zA-Z]+)[.])+[a-z]{2,4}$/i';
            if(preg_match($reg,$email)){
                $email=$_REQUEST['email'];
            }else{
                echo $this->failure(2, '邮箱格式不正确');
                die;
            }

        }
        if(empty($_REQUEST['password'])){
            echo $this->failure(2, '密码不能为空');
            die;
        }else{
            $password=$_REQUEST['password'];
        }
        $User = M("users"); // 实例化User对象// 查找status值为1name值为think的用户数据
        $data = $User->where("email='$email'")->find();
        if($data){
            echo $this->failure(2, '邮箱已存在');
            die;
        }else{
            $User = M("users"); // 实例化User对象
            $data['pwd'] = $password;
            $data['email'] = $email;
            $User->add($data);
            if($data){
                echo $this->failure(0, '注册成功');die;
            }
        }
    }
    //分页
    /**
     * @param page 页码
     * @param page_size 每页条数
     */
    public function page(){
        $page=empty($_REQUEST['page'])?1:$_REQUEST['page'];
        $page_size= empty($_REQUEST['page_size'])?10:$_REQUEST['page_size'];
        $User = M("users");
        $count=$User->count();
        $page_count=ceil($count/$page_size);
        $limit=($page-1)*$page_size;
        $user_list=$User->limit($limit,$page_size)->order('id desc')->select();
        echo $this->failure($user_list, '',0,['page_count'=>$page_count]);
    }
}
?>