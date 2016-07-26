<?php
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
?>