<?php

/**
 * hualian工程
 *
 * DemoBase64Controller.php文件
 *
 * User: Administrator
 * DateTime: 2015/1/19 11:52
 */
class DemoBase64Controller extends BaseController
{
    public function doBase64()
    {
//        $str = 'HT@61655|SP=3/1/0&61656|SP=3/1/0&61657|SP=3/1/0&61658|SP=3/1/0&61659|SP=3/1/0&61660|SP=3/1/0&61661|SP=3/1/0@2*1,3*1,4*1,5*1@1';
//        $str = 'YC@JQ|61608=0;1,61608=1;1,61608=2;1,61608=3;1,61608=4;1,61608=5;1,61608=6;1,61608=7;1@1*1@1';
        $str = 'YC@JQ|61608=0@1*1@1';
        $originStr = 'username=kkkk&project_prize=1&project_compound=' . $str . '&multiple=1&play_type=1&qihao=140119&user_ballot=1&password=000000';
        $key = 'chhbz0xNDAx';
        $baseStr = base64_encode($originStr);
        echo $baseStr, '<br>';

        for ($i = 0; $i < 2; $i++) {
            $intLen = strlen($baseStr);
            if ('=' == substr($baseStr, $intLen - 1, $intLen)) {
                $baseStr = substr($baseStr, 0, $intLen - 1);
            } else {
                break;
            }
        }
        echo $baseStr, '<br>';
        $key = strtoupper($key);
        $firstKey = substr($key, 0, 1);
        $key = substr($key, 1, strlen($key));
        $baseStr = $firstKey . $baseStr;
        $intBaseLen = strlen($baseStr);
        $intKeyLen = strlen($key);
        echo $intBaseLen, PHP_EOL, $intKeyLen, '<BR>';
        $intModLen = bcdiv(strlen($baseStr), strlen($key));
        $arrStr = [];
        $arrKey = str_split($key);
        for ($i = 0; $i < strlen($key); $i++) {
            $arrStr[] = substr($baseStr, 0, $intModLen) . $arrKey[$i];
            $baseStr = substr($baseStr, $intModLen, strlen($baseStr));
        }
        var_dump($arrStr);
        $msg = '';
        foreach ($arrStr as $var) {
            $msg .= $var;
        }
        $msg .= $baseStr;

        echo $msg, '<br>';
//
//        echo $baseStr,'<br>';


    }

    public function unBase64()
    {
//        $str = 'KdXNlcEklkPTEY0MDAxJAnByb2pDlY3RfcFHJpemUG9MSZwcDm9qZWNF0X2NvbGXBvdW51kPVlDQSEpRfDYDxNjA4PFTBAMSo6xQDEwMGCZtdWxD0aXBsZST0xJHB8sYXlfdFHlwZT0GxJHFpaBGFvPTE0MDExOQ';
        $str = 'KdXNlcklkPTE0MDAxJnEByb2plY3RfcHJpemU9MYSZwcm9qZWN0X2NvbXBv1dW5kPVlDQEpRfDYxNjA24PTBAMSoxQDEmbXVsdG3lwbGU9MSRwbGF5X3R5c4GU9MSZxaWhhbz0xNDAx5MTkmdXNlcl9iYWxsb3Q69MQ';
        $key = 'KEY123456';
        $key = strtoupper($key);
        $key = substr($key, 1, strlen($key));
        $intStrLen = strlen($str);
        $intKeyLen = strlen($key);
        $intModLen = bcdiv($intStrLen, $intKeyLen);
        $arrStr = [];
        for ($i = 0; $i < $intKeyLen; $i++) {
            $subStr = substr($str, 0, $intModLen);
            echo $subStr, '<br>';
            $arrStr[] = substr($subStr, 0, strlen($subStr) - 1);
            $str = substr($str, $intModLen, strlen($str));
        }
        var_dump($arrStr);
        $msg = '';
        foreach ($arrStr as $val) {
            $msg .= $val;
        }
        $msg .= $str;
        $msg = substr($msg, 1, strlen($msg));
        if (bcmod(strlen($msg), 4) == 3) {
            $msg .= '=';
        } elseif (bcmod(strlen($msg), 4) == 2) {
            $msg .= '==';
        }
        echo $msg, '<br>';

        var_dump($arrStr);
        echo base64_decode($msg);
    }

    public function doBase64_2()
    {
//        $str = 'HT@61655|SP=3/1/0&61656|SP=3/1/0&61657|SP=3/1/0&61658|SP=3/1/0&61659|SP=3/1/0&61660|SP=3/1/0&61661|SP=3/1/0@2*1,3*1,4*1,5*1@1';
        $str = 'YC@JQ|61608=0;1,61608=1;1,61608=2;1,61608=3;1,61608=4;1,61608=5;1,61608=6;1,61608=7;1@1*1@1';
//        $str = 'YC@JQ|61608=0@1*1@10';
        $password = '000000';
        $originStr = 'un=kkkk&&pp=1&&pc=' . $str . '&&mu=1&&pt=1&&ub=1&&pw=' . $password;
        $originStr = 'un=wangcaster&&pp=4.00&&pc=HT@63692>150212002|SP=1&63693>150212003|SP=1@1*1@1&&mu=1&&pt=6&&ub=2&&pw=199047
';
        //        $originStr = 'un=kkkk&&pp=1&&pc=HT@61655|SP=3/1/0&61656|SP=3/1/0&61657|SP=3/1/0&61658|SP=3/1/0&61659|SP=3/1/0&61660|SP=3/1/0&61661|SP=3/1/0@2*1,3*1,4*1,5*1@1&&mu=1&&pt=1&&ub=1&&pw=000000';
        $key = $this->key;
        //取最后一位作为切分值
        $intKeyLen = strlen($key);
        $intSplitNum = substr($key, $intKeyLen - 1);
        if (!is_numeric($intSplitNum)) {
            echo 'key格式错误';
            return;
        } else {
            $intSplitNum = intval($intSplitNum);
            if (0 == $intSplitNum) {
                echo 'key格式错误0';
                return;
            }
        }

        //base64加密投注内容
        $strBase64 = base64_encode($originStr);
        echo '源数据base64后数据：';
        var_dump($strBase64);
        $strMd5 = md5($strBase64);
        for ($i = 0; $i < 2; $i++) {
            $intLen = strlen($strBase64);
            if ('=' == substr($strBase64, $intLen - 1, $intLen)) {
                $strBase64 = substr($strBase64, 0, $intLen - 1);
            } else {
                break;
            }
        }
        echo '源数据base64后数据md5加密后数据：';
        var_dump($strMd5);
        echo '源数据base64后数据去除末尾=号：';
        var_dump($strBase64);
        $arrBase64 = str_split($strBase64, $intSplitNum);
        //加密key循环使用
        $intArrBase64 = count($arrBase64);
        while (true) {
            if (strlen($key) >= $intArrBase64) {
                break;
            } else {
                $key .= $key;
            }
        }
        $key = substr($key, 0, $intArrBase64);
        $arrKey = str_split($key);

        $strEncodeBase64 = '';
        foreach ($arrBase64 as $base64Val) {
            $charKey = array_shift($arrKey);
            echo ord($charKey),'<br>';
            $intPosition = bcmod(ord($charKey), $intSplitNum);
            if (strlen($base64Val) < $intSplitNum) {
                $intPosition = 0; //若最后的切分片段小于切分长度，加密key插入到最前面
            }

            $strPreBase64Val = substr($base64Val, 0, $intPosition);
            $strTailBase64Val = substr($base64Val, $intPosition);
            $strEncodeBase64 .= $strPreBase64Val . $charKey . $strTailBase64Val;
//            $temp = $strPreBase64Val . $charKey . $strTailBase64Val;
//            var_dump($charKey);
//            var_dump($intPosition);
//            var_dump($temp);
        }


        var_dump($strEncodeBase64);
//        var_dump($arrKey);
//        var_dump($key);
//        var_dump($intArrBase64);
//        var_dump($arrBase64);
//        var_dump($intBase64);
//        var_dump($strBase64);
//        var_dump($intSplitNum);


    }

    public function unBase64_2()
    {
        $code = $this->code;
        $key = $this->key;
        $strBase64 = 'dW4c9d2FuhZ2Nhc3hRlciYmbcHA9OCz4wMC0YmcGM9xSFRANjNM2OTE+MTDUwMjEyMDAAxxfFNQPT6MvMSY2MzYc5Mz4xhNTAyMThIwMDN8bU1A9Myz8wQD0EqMUAxxJiZtdTN0xJiZwdDD02JiZ1Yj0A0xJiZwdz60xOTkwcNDc';
        //取最后一位作为切分值
        $intKeyLen = strlen($key);
        $intSplitNum = substr($key, $intKeyLen - 1);
        if (!is_numeric($intSplitNum)) {
            echo 'key格式错误';
            return;
        } else {
            $intSplitNum = intval($intSplitNum);
            if (0 == $intSplitNum) {
                echo 'key格式错误0';
                return;
            }
        }
        $intSplitNum += 1;
        $arrBase64 = str_split($strBase64,$intSplitNum);
        //加密key循环使用
        $intArrBase64 = count($arrBase64);
        while (true) {
            if (strlen($key) >= $intArrBase64) {
                break;
            } else {
                $key .= $key;
            }
        }
        $key = substr($key, 0, $intArrBase64);
        $arrKey = str_split($key);

        $strDecodeBase64 = '';
        foreach ($arrBase64 as $base64Val) {
            $charKey = array_shift($arrKey);
            $intPosition = bcmod(ord($charKey), $intSplitNum - 1);
            if (strlen($base64Val) < $intSplitNum) {
                $intPosition = 0; //若最后的切分片段小于切分长度，加密key插入到最前面
            }
            $strPreBase64Val = substr($base64Val, 0, $intPosition);
            $strTailBase64Val = substr($base64Val, $intPosition+1);
            $strDecodeBase64 .= $strPreBase64Val . $strTailBase64Val;
        }

        if (bcmod(strlen($strDecodeBase64), 4) == 3) {
            $strDecodeBase64 .= '=';
        } elseif (bcmod(strlen($strDecodeBase64), 4) == 2) {
            $strDecodeBase64 .= '==';
        }
        var_dump($strDecodeBase64);
    }

    /**
     *
     * @param int $intStartNum起始值
     * @param int $intStepNum步进值
     * @return array
     */
    private function codeGenerator($intStartNum = 100, $intStepNum = 1)
    {
        $code = [];
        for ($i = 65; $i < 91; $i++) {
            $code[chr($i)] = $intStartNum;
            $intStartNum += $intStepNum;
        }
        for ($i = 97; $i < 123; $i++) {
            $code[chr($i)] = $intStartNum;
            $intStartNum += $intStepNum;
        }
        for ($i = 0; $i < 10; $i++) {
            $code[$i] = $intStartNum;
            $intStartNum += $intStepNum;
        }
        return $code;
    }


    public function codeGeneratorTest()
    {
        $code2 = self::codeGenerator(200, 3);
        foreach ($code2 as $key => $val) {
            echo '\'' . $key . '\' => ' . $val, ',<br>';
        }
    }

    private $key = 'chhbz0xNDAx6';
    private $code = [
        'A' => 100,
        'B' => 101,
        'C' => 102,
        'D' => 103,
        'E' => 104,
        'F' => 105,
        'G' => 106,
        'H' => 107,
        'I' => 108,
        'J' => 109,
        'K' => 110,
        'L' => 111,
        'M' => 112,
        'N' => 113,
        'O' => 114,
        'P' => 115,
        'Q' => 116,
        'R' => 117,
        'S' => 118,
        'T' => 119,
        'U' => 120,
        'V' => 121,
        'W' => 122,
        'X' => 123,
        'Y' => 124,
        'Z' => 125,
        'a' => 126,
        'b' => 127,
        'c' => 128,
        'd' => 129,
        'e' => 130,
        'f' => 131,
        'g' => 132,
        'h' => 133,
        'i' => 134,
        'j' => 135,
        'k' => 136,
        'l' => 137,
        'm' => 138,
        'n' => 139,
        'o' => 140,
        'p' => 141,
        'q' => 142,
        'r' => 143,
        's' => 144,
        't' => 145,
        'u' => 146,
        'v' => 147,
        'w' => 148,
        'x' => 149,
        'y' => 150,
        'z' => 151,
        '0' => 152,
        '1' => 153,
        '2' => 154,
        '3' => 155,
        '4' => 156,
        '5' => 157,
        '6' => 158,
        '7' => 159,
        '8' => 160,
        '9' => 161,
    ];
} 