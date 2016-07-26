<?php namespace App\Http\Controllers;
use DB;
use Request;
class ListController extends CommonController {
//    public function __construct()
//    {
//        $this->middleware('guest');
//    }
    //职位列表
    public function index(){
        $url="http://www.lg.com/jiekou/tp/Home/list";
        $arr=$this->CurlPost($url);
//        print_r($arr);die;
        return view('list/list',['arr'=>$arr]);
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
    //加载更多
    public function page(Request $request){
        $p=Request::input('p');
//        $page_number=Request::input('page_number');
        $url="http://www.lg.com/jiekou/tp/Home/list";
        $param = [
            'page' => $p,
        ];
//        print_r($param);die;
        $arr=$this->CurlPost($url,$param);
//        print_r($arr);die;
        $str="";
        foreach ($arr['data'] as $v){
            $str.="<div class='wz'>";
            $str.="<input type='hidden' id='page' value='$arr[page]'/>";
                $str.="<h3><a href='#' title='$v[zpzw]'>$v[zpzw]</a></h3>";
                $str.="<dl>";
                $str.="<dt><img src='images/s.jpg' width='200'  height='123' alt=''></dt>";
                $str.="<dd>";
                $str.="<p class='dd_text_1'>";
        $str.="招聘人数: <span style='color: #ff0000'>".$v['zprs']."</span>";
        $str.="学历要求:<span style='color: #ff0000'>".$v['zpxt']."</span>";
        $str.="工作地址:<span style='color: #ff0000'>".$v['zpfrom']."</span>";
        $str.="工作经验:<span style='color: #ff0000'>".$v['zpmoney']."</span>";
        $str.="薪资:<span style='color: #ff0000'>".$v['zpminyear']."</span>--<span style='color: #ff0000'>$v[zpmaxyear]</span>K<br>
        公司简介:".$v['jianjie'];
                        $str.="</p>";
                       $str.=" <p class='dd_text_2'>";
                        $str.="    <span class='left author'>".$v['qyname2']."</span><span class='left sj'>时间:$v[uptime]</span>
                            <span class='left fl'>分类:<a href='#' title='$v[gztype]'>$v[gztype]</a></span><span class='left yd'><a href='#' title='查看详情'>查看详情</a>
               </span>";
                        $str.="<div class='clear'></div>";
                        $str.="</p>";
                    $str.="</dd>";
                    $str.="<div class='clear'></div>";
                $str.="</dl>";
            $str.="</div>";
            }
        echo $str;
    }
}