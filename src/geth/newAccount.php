<?php

namespace src\geth;

class newAccount
{
    public $nodeUrl;
    public function __construct($nodeUrl)
    {
        $this->nodeUrl = $nodeUrl;
    }
    public function newAddress($keyPath,$num)
    {
        $list = [];
        while($num > 0){
            $num -= 1;
            $password = $this->GetRandStr(8);
            $rep = $this->post($this->nodeUrl,$this->createDate("personal_newAccount",[$password]));
            if(isset($rep['result'])){
                // 读取私钥
                $address = $rep['result'];
                $privateKey = $this->GetPrivateKey($keyPath,$address);
                $list [] = ["address" => $address , "privateKey" => $privateKey];
            }            
        }
        return $list;
    }

    public function GetPrivateKey($keyPath,$address){
        $address = ltrim($address,"0x");
        var_dump($address);
        if(is_dir($keyPath)){
            $list = scandir($keyPath);
            foreach($list as $keyName){
                if(strpos($keyName,$address)){
                    var_dump($keyName);
                    $PrivatKey = file_get_contents($keyPath.'/'.$keyName);
                    return $PrivatKey;
                }
            }
        }
        return false;
    }

    public function GetRandStr($length)
    {
        //字符组合
        $str = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $len = strlen($str) - 1;
        $randstr = '';
        for ($i = 0; $i < $length; $i++) {
            $num = mt_rand(0, $len);
            $randstr .= $str[$num];
        }
        return $randstr;
    }
    public  function post($url, $data = [], $header = [])
    {
        echo json_encode($data);
        $ch = curl_init();
        $data = json_encode($data);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json', 'Content-Length:' . strlen($data)]);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($ch);
        curl_close($ch);
        var_dump($result);
        return json_decode($result,1);
    }
    public  function createDate($method, $params)
    {
        return [
            "jsonrpc" => "2.0",
            "method" => $method,
            "params" => $params,
            "id" => intval(time() . rand(1000, 9999))
        ];
    }
}
