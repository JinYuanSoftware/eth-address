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
        while($num > 0){
            $num -= 1;
            $password = $this->GetRandStr(8);
            $rep = $this->post($this->nodeUrl,$this->createDate("personal_newAccount",$password));
            var_dump($rep);
        }

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
        $ch = curl_init();
        $data = json_encode($data);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json', 'Content-Length:' . strlen($data)]);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        // curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($ch);
        curl_close($ch);
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
