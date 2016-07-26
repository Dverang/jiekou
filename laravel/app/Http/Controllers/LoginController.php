<?php namespace App\Http\Controllers;
use DB;
use Request;
class LoginController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
//    public $enableCsrfValidation = false;
//    public $enableCsrfValidation = false;
    public function __construct()
    {
        $this->middleware('guest');
    }
    //登陆界面
    public function index(){
        //生成token
//        $toke = md5(((float) date("YmdHis") + rand(100,999)).rand(1000,9999));
        return view('login');
    }
    //登陆
    public function login( Request $request){
        $url = 'http://www.lg.com/jiekou/tp/Home/Interface/login';
        $param = [
            'email' => Request::input('email'),
            'password' => Request::input('password'),
        ];

        $api_result = $this->CurlPost( $url , $param );
        // print_r($api_result);die;\
        if( $api_result['status'] == 0 ){
            session_start();
            $_SESSION["uid"]=$api_result['uid'];
            $_SESSION["token"]=$api_result['token'];
            echo '0';
        }else{
            echo $api_result['msg'];
        }
    }
    function CurlPost($url, $param = null, $timeout = 10 ) {

        //初始化curl
        $curl = curl_init();

        curl_setopt($curl, CURLOPT_URL, $url); // 设置请求的路径
        curl_setopt($curl, CURLOPT_POST, 1); //设置POST提交
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1 ); //显示输出结果
        curl_setopt($curl, CURLOPT_TIMEOUT, $timeout);

        //提交数据
        if (is_array($param)) {
            curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($param));
        } else {
            curl_setopt($curl, CURLOPT_POSTFIELDS, $param);
        }

        //执行请求
        $data = $data_str = curl_exec($curl);

        //处理错误
        if ($error = curl_error($curl)) {
            $logdata = array(
                'url' => $url,
                'param' => $param,
                'error' => '<span style="color:red;font-weight: bold">' . $error . '</span>',
            );
            var_dump($logdata);exit;
        }


        curl_close($curl);

        //json数据转换为数组
        $data = json_decode( $data , true );

        if( !is_array( $data ) ){
            $data = $data_str;
        }
        return $data;
    }
    //注册页面
    public function register(Request $request){
        if(Request::input()){
            $url = 'http://www.lg.com/jiekou/tp/Home/Interface/register';
            $param = [
                'email' => Request::input('email'),
                'password' => Request::input('password'),
            ];
//        print_r($param);die;
            $api_result = $this->CurlPost( $url , $param );
            if( $api_result['status'] == 0 ){
                //写入session
                echo '注册成功';
            }else{
                echo $api_result['msg'];
            }
        }else{
          return view('register');
        }

    }
}