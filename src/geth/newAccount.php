<?php

namespace src\geth;

class newAccount
{
    public function newAddress()
    {
        $n = 1000;
        while($n > 0){
            $n -= 1;
            $password = $this->GetRandStr(8);
            exec("chmod +x /src/sh/newAccount.sh",$rep);
            exec("sh /src/sh/newAccount.sh $password",$rep);
            var_dump($rep);
        }

    }
    private function GetRandStr($length)
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
}
