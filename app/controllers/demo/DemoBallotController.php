<?php

/**
 * hualian工程
 *
 * DemoBallotController.php文件
 *
 * User: Administrator
 * DateTime: 2015-01-28 15:22
 */
class DemoBallotController extends BaseController
{
    public function index()
    {
//        $strContent = 'HT@63134|SP=3&63135|SP=3/1&63136|SP=3/1/0&63137|RQ=3,SP=3/1/0@3*4@1';
//        $strContent = 'HT@63092|RQ=1,SP=0&63093|RQ=3,SP=1@2*1@1';
        $strContent = 'HT@63146|RQ=3/1,SP=3/1&63147|RQ=3/1,SP=3/1&63148|RQ=3/1,SP=3/1@2*1,3*1@1';
//        $strContent = 'HT@63146|RQ=3/1,SP=3/1&63147|RQ=3/1,SP=3/1&63148|RQ=3/1,SP=3/1@3*1@1';
//        var_dump(self::splitPassType($strContent));

        $intBallot = 0;
        foreach(self::splitPassType($strContent) as $val){
            $intBallot += self::getBallotNum($val);
        }
        var_dump($intBallot);

//        var_dump(self::getBallotNum($strContent));
    }

    /**
     *混投注数（带重复）
     * @param $strMatchContent
     * @return int
     * @throws MyException
     */
    private function getBallotNum($strMatchContent)
    {
        $matchs = self::getMatchs($strMatchContent);
        $intBallotNum = 0;
        foreach ($matchs as $match) {
            $intBallotNum += self::getHtBallotDuplite($match);
        }
        return $intBallotNum;
    }

    /**
     *拆分投注内容
     * @param $strMatchContent
     * @return array
     * @throws MyException
     */
    private function getMatchInfo($strMatchContent)
    {
        $arrData = array('flag' => '', 'content' => '', 'guoGuanType' => '', 'multiple' => 1);
        $arrMatchInfo = explode('@', $strMatchContent);
        if (4 != count($arrMatchInfo)) {
            throw new MyException('方案内容格式不正确', 0);
        }
        $arrData['flag'] = $arrMatchInfo[0];
        $arrData['content'] = $arrMatchInfo[1];
        $arrData['gouGuanType'] = $arrMatchInfo[2];
        $arrData['multiple'] = $arrMatchInfo[3];

        return $arrData;
    }

    /**
     *将多串玩法投注内容拆分
     * @param $strMatchContent
     * @return array
     * @throws MyException
     */
    private function getMatchs($strMatchContent)
    {
        $arrMatchs = array();
        $matchInfo = self::getMatchInfo($strMatchContent);
        //比赛场次数
        $content = explode('&', $matchInfo['content']);
        $matchNum = count($content);
        //过关类型
        $type = $matchInfo['gouGuanType'];
        $guoGuanTpye = explode('*', $type);
        $guoGuanNum = $guoGuanTpye[0];
        $arrPaiLie = self::combine($matchNum, $guoGuanNum);
        foreach ($arrPaiLie as $pKey => $pVal) {
            foreach ($pVal as $key => $val) {
                if (0 == $key) {
                    $arrMatchs[$pKey] = $content[$val];
                } else {
                    $arrMatchs[$pKey] .= '&' . $content[$val];
                }
            }
        }
        foreach ($arrMatchs as $mKey => $mVal) {
            $arrMatchs[$mKey] = $matchInfo['flag'] . '@' . $mVal . '@' . $type . '@' . $matchInfo['multiple'];
        }
        return $arrMatchs;
    }

    private function getHtBallotDuplite($strContent)
    {
        $intBallot = 0;
        $arrContents = array();
        //将投注内容解析为单一场次只有一种玩法的投注内容
        $arrContent = explode('@', $strContent);
        if (4 != count($arrContent)) {
            throw new MyException('投注内容格式不正确', 0);
        }

        $arrContentInfo = explode('&', $arrContent['1']);
        $content = array();
        //拆分
        foreach ($arrContentInfo as $infoKey => $infoVal) {
            $info = explode('|', $infoVal);
            if (2 != count($info)) {
                throw new MyException('方案内容格式不正确', 0);
            }
            $matchId = $info[0];
            $playTypes = explode(',', $info[1]);
            foreach ($playTypes as $type) {
                $content[$infoKey][] = $matchId . '|' . $type;
            }
        }
//        var_dump($content);exit;
        $matchContent = self::fun($content, array(), 1);

//        var_dump($matchContent);
//        exit;
        foreach ($matchContent as $mKey => $mVal) {
            $str = '';
            foreach ($mVal as $key => $val) {
                if (0 == $key) {
                    $str = $val;
                } else {
                    $str .= '&' . $val;
                }
            }
            $arrContents[] = $arrContent[0] . '@' . $str . '@' . $arrContent[2] . '@' . $arrContent[3];
        }
        //计算注数
        foreach ($arrContents as $aVal) {
            $matchCountent = self::getHtMatchContent($aVal);
            $intBallot += self::getProjectNum($matchCountent['arrChangCi'], $matchCountent['passTypes']);
        }
        return $intBallot;
    }

    function getProjectNum($arrChangCi, $arrGuoGuanType)
    {
        $intTotalNum = 0;
        foreach ($arrGuoGuanType as $guoGuanType) {
            $arrType = self::getPassDetail($guoGuanType);
            $type = $arrType[1];
            foreach ($type as $key => $val) {
                $type[$key] = $val . '*1';
            }
            $intTotalNum += self::getProjectTotalNumber($arrChangCi, $type);
        }
        return $intTotalNum;
    }

    private function getPassDetail($passType)
    {

        if ($passType == '单关') {
            $atier = array(1);
            return array(1, $atier);
        } else if ($passType == '1*1') {
            $atier = array(1);
            return array(1, $atier);
        } else if ($passType == '2*1') {
            $atier = array(2);
            return array(2, $atier);
        } else if ($passType == '3*1') {
            $atier = array(3);
            return array(3, $atier);
        } else if ($passType == '3*3') {
            $atier = array(2);
            return array(3, $atier);
        } else if ($passType == '3*4') {
            $atier = array(2, 3);
            return array(3, $atier);
        } else if ($passType == '4*1') {
            $atier = array(4);
            return array(4, $atier);
        } else if ($passType == '4*4') {
            $atier = array(3);
            return array(4, $atier);
        } else if ($passType == '4*5') {
            $atier = array(3, 4);
            return array(4, $atier);
        } else if ($passType == '4*6') {
            $atier = array(2);
            return array(4, $atier);
        } else if ($passType == '4*11') {
            $atier = array(2, 3, 4);
            return array(4, $atier);
        } else if ($passType == '5*1') {
            $atier = array(5);
            return array(5, $atier);
        } else if ($passType == '5*5') {
            $atier = array(4);
            return array(5, $atier);
        } else if ($passType == '5*6') {
            $atier = array(4, 5);
            return array(5, $atier);
        } else if ($passType == '5*10') {
            $atier = array(2);
            return array(5, $atier);
        } else if ($passType == '5*16') {
            $atier = array(3, 4, 5);
            return array(5, $atier);
        } else if ($passType == '5*20') {
            $atier = array(2, 3);
            return array(5, $atier);
        } else if ($passType == '5*26') {
            $atier = array(2, 3, 4, 5);
            return array(5, $atier);
        } else if ($passType == '6*1') {
            $atier = array(6);
            return array(6, $atier);
        } else if ($passType == '6*6') {
            $atier = array(5);
            return array(6, $atier);
        } else if ($passType == '6*7') {
            $atier = array(5, 6);
            return array(6, $atier);
        } else if ($passType == '6*15') {
            $atier = array(2);
            return array(6, $atier);
        } else if ($passType == '6*20') {
            $atier = array(3);
            return array(6, $atier);
        } else if ($passType == '6*22') {
            $atier = array(4, 5, 6);
            return array(6, $atier);
        } else if ($passType == '6*35') {
            $atier = array(2, 3);
            return array(6, $atier);
        } else if ($passType == '6*42') {
            $atier = array(3, 4, 5, 6);
            return array(6, $atier);
        } else if ($passType == '6*50') {
            $atier = array(2, 3, 4);
            return array(6, $atier);
        } else if ($passType == '6*57') {
            $atier = array(2, 3, 4, 5, 6);
            return array(6, $atier);
        } else if ($passType == '7*1') {
            $atier = array(7);
            return array(7, $atier);
        } else if ($passType == '7*7') {
            $atier = array(6);
            return array(7, $atier);
        } else if ($passType == '7*8') {
            $atier = array(6, 7);
            return array(7, $atier);
        } else if ($passType == '7*21') {
            $atier = array(5);
            return array(7, $atier);
        } else if ($passType == '7*35') {
            $atier = array(4);
            return array(7, $atier);
        } else if ($passType == '7*120') {
            $atier = array(2, 3, 4, 5, 6, 7);
            return array(7, $atier);
        } else if ($passType == '8*1') {
            $atier = array(8);
            return array(8, $atier);
        } else if ($passType == '8*8') {
            $atier = array(7);
            return array(8, $atier);
        } else if ($passType == '8*9') {
            $atier = array(7, 8);
            return array(8, $atier);
        } else if ($passType == '8*28') {
            $atier = array(6);
            return array(8, $atier);
        } else if ($passType == '8*56') {
            $atier = array(5);
            return array(8, $atier);
        } else if ($passType == '8*70') {
            $atier = array(4);
            return array(8, $atier);
        } else if ($passType == '8*247') {
            $atier = array(2, 3, 4, 5, 6, 7, 8);
            return array(8, $atier);
        } else {
            return array(0, array());
//		throw new MyException("过关方式不存在", 1);
        }
    }

    /**
     * 根据比赛场次和过关方式，计算方案总注数
     * @param $arrChangCi array(2,3)两场比赛，玩法分别有2种和3种
     * @param $arrGuoGuanType array('1*1','2*1')过关方式
     * @return int
     */
    public function getProjectTotalNumber($arrChangCi, $arrGuoGuanType)
    {
        $intSum = count($arrChangCi);
        $intAllDanGeZhuHe = 0;

        for ($i = 0; $i < count($arrGuoGuanType); $i++) {
            $strGuoGuanType = $arrGuoGuanType[$i];
            $arrSubGuoGuanType = explode('*', $strGuoGuanType);
            $intLen = (int)$arrSubGuoGuanType[0];
            $intZhuShu = (int)$arrSubGuoGuanType[1];
            $arrCombine = self::combine($intSum, $intLen);

            $intSumDanGeZhuHe = 0;
            for ($j = 0; $j < count($arrCombine); $j++) {
                $intDanGeZhuHe = 1;
                for ($k = 0; $k < count($arrCombine[$j]); $k++) {
                    $intIndex = $arrCombine[$j][$k];
                    $intDanGeZhuHe *= $arrChangCi[$intIndex];
                }
                $intSumDanGeZhuHe += $intDanGeZhuHe;
            }
            $intAllDanGeZhuHe += $intSumDanGeZhuHe * $intZhuShu;
        }

        return $intAllDanGeZhuHe;
    }

    /**
     *解析混投投注内容
     * @param $strMatchContent投注内容
     * @return array('type' => '', 'passTypes' => '', 'sumMatch' => '', 'arrMatchs' => '','arrMatchPlayType' => '','sumPassType' => '', 'arrChangCi' => '','mutiple' => '');
     */
    private function getHtMatchContent($strMatchContent)
    {
        $returnData = array('type' => '', 'passTypes' => '', 'sumMatch' => '', 'arrMatchs' => '', 'arrMatchPlayType' => '', 'sumPassType' => '', 'arrChangCi' => '', 'mutiple' => '');
        $changCi = array();
        $arrMatchs = array();
        $arrMatchPlayType = array();
        if (empty($strMatchContent)) {
            return false;
        }
        $matchContent = explode('@', $strMatchContent);
        if (4 != count($matchContent)) {
            return false; //投注内容格式不正确
        }
        $returnData['type'] = $matchContent[0];
        $returnData['passTypes'] = explode(',', $matchContent[2]);
        $returnData['sumPassType'] = count($returnData['passTypes']);
        $returnData['mutiple'] = $matchContent[3];

        $arrContent = explode('&', $matchContent[1]);
        $returnData['sumMatch'] = count($arrContent);

        foreach ($arrContent as $contKey => $contVal) {
            $contents = explode('|', $contVal);
            if (2 != count($contents)) {
                return false;
            }
            $matchId = $contents[0];
            if (!in_array($matchId, $arrMatchs)) {
                $arrMatchs[] = $matchId;
            }
            $content = explode(',', $contents[1]);
            foreach ($content as $con) {
                $match = explode('=', $con);
                if (2 != count($match)) {
                    return false;
                }
                $playType = $match[0];
                $matchInfo = explode('/', $match[1]);
                if (array_key_exists($matchId, $changCi)) {
                    $changCi[$matchId] += count($matchInfo);
                } else {
                    $changCi[$matchId] = count($matchInfo);
                }

                $matchPlayType = array($matchId => $playType);
                if (!in_array($matchPlayType, $arrMatchPlayType)) {
                    $arrMatchPlayType[] = $matchPlayType;
                }
            }
        }

        $arrChangCi = array();
        foreach ($changCi as $val) {
            $arrChangCi[] = $val;
        }
        $returnData['arrMatchs'] = $arrMatchs;
        $returnData['arrMatchPlayType'] = $arrMatchPlayType;
        $returnData['arrChangCi'] = $arrChangCi;
        return $returnData;
    }

    /**
     *排列组合算法
     * @param $intSum
     * @param $intLen
     * @return array
     */
    private function combine($intSum, $intLen)
    {
        for ($i = 0; $i < $intSum; $i++) {
            $arr[$i] = $i;
        }
        $a = array();
        $boolFirstCall = true;
        $b = self::format($a, 0, $arr, $intLen, $boolFirstCall);
        return $b;
    }

    /**
     *排列组合
     * @param $res
     * @param $index
     * @param $arr
     * @param $intLen
     * @param $boolFirstCall
     * @return array
     */
    private function format($res, $index, $arr, $intLen, $boolFirstCall)
    {
        static $total;
        static $b;
        if ($boolFirstCall == true) {
            $total = 0;
            $b = array();
            $boolFirstCall = false;
        }
        $new_arr = $res;
        if ($index == count($arr)) {
            if (count($new_arr) == $intLen) {
                $b[] = $new_arr;
                $total++;
            }
            return '';
        }
        self::format($new_arr, $index + 1, $arr, $intLen, $boolFirstCall);
        $new_arr[] = $arr[$index];
        self::format($new_arr, $index + 1, $arr, $intLen, $boolFirstCall);
        return $b;
    }

    /**
     *笛卡尔乘积递归算法
     * @param $arr
     * @param array $tmp
     * @param int $first
     * @return array
     */
    private function fun($arr, $tmp = array(), $first = 0)
    {
        global $res;
        if ($first == 1) {
            $res = array();
        }
        foreach (array_shift($arr) AS $v) {
            $tmp[] = $v;
            if ($arr) {
                self::fun($arr, $tmp);
            } else {
                $res[] = $tmp;
            }
            array_pop($tmp);
        }
        return $res;
    }

    private function splitPassType($strContent){
        if( !is_string($strContent)){
            return false;
        }
        $arrContent = explode('@',$strContent);

        if( 4 != count($arrContent)){
            return false;
        }

        $flag = $arrContent[0];
        $content = $arrContent[1];
        $playType = $arrContent[2];
        $mulitple = $arrContent[3];

        $arrPlayType = explode(',',$playType);
        $resData = [];
        foreach($arrPlayType as $key => $val){
            $resData[] = $flag . '@' . $content . '@' . $val . '@' . $mulitple;
        }

        return $resData;
    }

}