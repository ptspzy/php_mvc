<?php

/**
 * Created by PhpStorm.
 * User: pzy
 * Date: 16-12-2
 * Time: 下午12:03
 */
class ChapterModel
{
    public static function getChapterNameById($id)
    {
        $db = Db::getInstance();

        $req = $db->prepare('SELECT chaptername FROM jieqi_article_chapter WHERE chapterid = :id');

        $req->execute(array('id' => $id));

        $post = $req->fetch();

        return $post['chaptername'];
    }

    public static function getVipChapterIds($articleId)
    {
        $db = Db::getInstance();

        $defaultLimit = 5;

        $articleid = 35658;

        $sql = <<<EOF
            SELECT
                chapterid as id
            FROM 
                jieqi_article_chapter
            WHERE 
                articleid = :articleid 
             and 
                isvip = 1
            ORDER BY 
                chapterorder 
            limit :defaultLimit                  
EOF;

        $sth = $db->prepare($sql);

        $sth->bindParam(':articleid', $articleid, PDO::PARAM_INT);
        $sth->bindParam(':defaultLimit', $defaultLimit, PDO::PARAM_INT);

        $sth->execute();

        $result_arr = $sth->fetchAll(PDO::FETCH_ASSOC);

        return $result_arr;
    }


    public static function getCountByHour($articleid, $chapterid)
    {
        $db = Db::getInstance();

//        $defaultBeginTime = date("Y-m-d", strtotime("-7 day")) . " 00:00:00";

        // For testing
        $defaultBeginTime = 1343797200;//2012-08-01 13:00:00
        $endTime = 1347789600;
        //$articleid = 35658;
        $sql = <<<EOF
            SELECT 
                count( * ) AS num, 
                from_unixtime( buytime , '%Y-%m-%d %H:00:00' ) AS time
            FROM    
                jieqi_article_sale  
            WHERE 
                articleid = :articleid
             and
                chapterid = :chapterid
             and
                  buytime > :defaultBeginTime
             and 
                  buytime < :endTime 
            GROUP BY 
                from_unixtime( buytime , '%Y-%m-%d %H:00:00' )  
            ORDER BY
                buytime
EOF;


        $sth = $db->prepare($sql);

        $sth->bindParam(':articleid', $articleid, PDO::PARAM_INT);
        $sth->bindParam(':chapterid', $chapterid, PDO::PARAM_INT);
        $sth->bindParam(':defaultBeginTime', $defaultBeginTime, PDO::PARAM_STR, 12);
        $sth->bindParam(':endTime', $endTime, PDO::PARAM_STR, 12);

        $sth->execute();

        $result_arr = $sth->fetchAll(PDO::FETCH_ASSOC);

        $lengthResult = count($result_arr);

        $length = round(($endTime - $defaultBeginTime) / 3600);

        $result = array(array());

        $time = strtotime(date("Y-m-d H:00:00", $defaultBeginTime));
        for ($i = 0; $i < $length; $i++) {
            $result[$i]['time'] = date("Y-m-d H:00:00", $time + 3600 * $i);
            $result[$i]['num'] = '0';
        }

        $position = 0;
        for ($i = 0; $i < $lengthResult; $i++) {
            for ($j = $position; $j < $length; $j++) {
                if($result[$j]['time'] == $result_arr[$i]['time']){
                    $result[$j]['num'] = $result_arr[$i]['num'];
                }
                $position = $j;
                break;
            }

        }
//        var_dump($result);die;

        //累加求和
//        $length = count($result_arr) - 1;
//        for ($i = 0; $i < $length; $i++) {
//            $result_arr[$i + 1]['num'] += $result_arr[$i]['num'];
//        }

        $result_arr = $result_arr ? $result_arr : "";
        return $result_arr;
    }
}