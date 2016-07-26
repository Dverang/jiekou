<?php
class GEncrypt extends GSuperclass {
    protected static function keyED($txt,$encrypt_key){
        $encrypt_key = md5($encrypt_key);
        $ctr=0;
        $tmp = "";
        for ($i=0;$i<strlen($txt);$i++){
            if ($ctr==strlen($encrypt_key)) $ctr=0;
            $tmp.= substr($txt,$i,1) ^ substr($encrypt_key,$ctr,1);
            $ctr++;
        }
        return $tmp;
    }

    public static function encrypt($txt,$key){
        //$encrypt_key = md5(rand(0,32000)); 
        $encrypt_key = md5(((float) date("YmdHis") + rand(10000000000000000,99999999999999999)).rand(100000,999999));
        $ctr=0;
        $tmp = "";
        for ($i=0;$i<strlen($txt);$i++){
            if ($ctr==strlen($encrypt_key)) $ctr=0;
            $tmp.= substr($encrypt_key,$ctr,1) . (substr($txt,$i,1) ^ substr($encrypt_key,$ctr,1));
            $ctr++;
        }
        return base64_encode(self::keyED($tmp,$key));
    }

    public static function decrypt($txt,$key){
        $txt = self::keyED( base64_decode($txt),$key);
        $tmp = "";
        for ($i=0;$i<strlen($txt);$i++){
            $md5 = substr($txt,$i,1);
            $i++;
            $tmp.= (substr($txt,$i,1) ^ $md5);
        }
        return $tmp;
    }
}
?>
<?php
/**
 * 原理：请求分配token的时候，想办法分配一个唯一的token, base64( time + rand + action)
 * 如果提交，将这个token记录，说明这个token以经使用，可以跟据它来避免重复提交。
 *
 */
class GToken {

    /**
     * 得到当前所有的token
     *
     * @return array
     */
    public static function getTokens(){
        $tokens = $_SESSION[GConfig::SESSION_KEY_TOKEN ];
        if (empty($tokens) && !is_array($tokens)) {
            $tokens = array();
        }
        return $tokens;
    }

    /**
     * 产生一个新的Token
     *
     * @param string $formName
     * @param 加密密钥 $key
     * @return string
     */

    public static function granteToken($formName,$key = GConfig::ENCRYPT_KEY ){
        $token = GEncrypt::encrypt($formName.":".session_id(),$key);
        return $token;
    }

    /**
     * 删除token,实际是向session 的一个数组里加入一个元素，说明这个token以经使用过，以避免数据重复提交。
     *
     * @param string $token
     */
    public static function dropToken($token){
        $tokens = self::getTokens();
        $tokens[] = $token;
        GSession::set(GConfig::SESSION_KEY_TOKEN ,$tokens);
    }

    /**
     * 检查是否为指定的Token
     *
     * @param string $token    要检查的token值
     * @param string $formName
     * @param boolean $fromCheck 是否检查来路,如果为true,会判断token中附加的session_id是否和当前session_id一至.
     * @param string $key 加密密钥
     * @return boolean
     */

    public static function isToken($token,$formName,$fromCheck = false,$key = GConfig::ENCRYPT_KEY){
        $tokens = self::getTokens();

        if (in_array($token,$tokens)) //如果存在，说明是以使用过的token
            return false;

        $source = split(":", GEncrypt::decrypt($token,$key));

        if($fromCheck)
            return $source[1] == session_id() && $source[0] == $formName;
        else
            return $source[0] == $formName;
    }
}
?>
