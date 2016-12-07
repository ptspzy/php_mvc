<?php

/**
 * Created by PhpStorm.
 * User: pzy
 * Date: 16-12-1
 * Time: 下午3:38
 */
class ArticleModel
{
    public static function getArticleNameById($id)
    {
        $db = Db::getInstance();
        $id = intval($id);
        $req = $db->prepare('SELECT articlename FROM jieqi_article_article WHERE articleid = :id');

        $req->execute(array('id' => $id));

        $post = $req->fetch();

        return $post['articlename'];
    }

    public static function getCountByDay($articleid)
    {
        $db = Db::getInstance();
//
//        $defaultBeginTime = date("Y-m-d", strtotime("-7 day")) . " 00:00:00";
//        $defaultBeginTime = time($defaultBeginTime);

        // For testing
        $defaultBeginTime = 1173743584;
        $endTime = time();

        $sql = <<<EOF
            SELECT 
                count(*) AS num, 
                from_unixtime( buytime , '%Y-%m-%d' ) AS time
            FROM 
                jieqi_article_sale  
            WHERE 
                articleid = :articleid 
             and
                  buytime > :defaultBeginTime
             and 
                  buytime < :endTime     
            GROUP BY 
                from_unixtime( buytime , '%Y%m%d' )
            ORDER BY 
                buytime
EOF;


        $sth = $db->prepare($sql);

        $sth->bindParam(':articleid', $articleid, PDO::PARAM_INT);
        $sth->bindParam(':defaultBeginTime', $defaultBeginTime, PDO::PARAM_STR, 12);
        $sth->bindParam(':endTime', $endTime, PDO::PARAM_STR, 12);

        $sth->execute();

        $result_arr = $sth->fetchAll(PDO::FETCH_ASSOC);

        $lengthResult = count($result_arr);

        $length = (int)(($endTime - $defaultBeginTime) / 86400) + 1;

        //存储格式化好的数据（时间节点无数据需要设置0值）
        $result = array(array());


        $time = strtotime(date("Y-m-d", $defaultBeginTime));

        for ($i = 0; $i < $length; $i++) {

            $result[$i]['num'] = '0';
            $result[$i]['time'] = date("Y-m-d", $time + 86400 * $i);
        }

        $position = 0;
        for ($i = 0; $i < $lengthResult; $i++) {
            for ($j = $position; $j < $length; $j++) {
                if ($result[$j]['time'] == $result_arr[$i]['time']) {
                    $result[$j]['num'] = $result_arr[$i]['num'];
                    $position = $j;
                    break;
                }
            }

        }

//        //累加求和
//        for ($i = 0; $i < $length - 1; $i++) {
//            $result[$i + 1]['num'] += $result[$i]['num'];
//        }

        return $result;
    }
}

?>
