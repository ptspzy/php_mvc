<?php

/**
 * Created by PhpStorm.
 * User: pzy
 * Date: 16-12-1
 * Time: 下午3:38
 */
class ArticleModel
{
    // we define 3 attributes
    // they are public so that we can access them using $post->author directly
    public $id;
    public $articlename;

    public function __construct($id, $articlename)
    {
        $this->id = $id;
        $this->articlename = $articlename;
    }

    public static function all()
    {
        $list = [];
        $db = Db::getInstance();
        $req = $db->query('SELECT * FROM posts');

        foreach ($req->fetchAll() as $post) {
            $list[] = new Post($post['id'], $post['articlename']);
        }

        return $list;
    }

    public static function find($id)
    {
        $db = Db::getInstance();
        $id = intval($id);
        $req = $db->prepare('SELECT id ,articlename FROM jieqi_article_article WHERE id = :id');

        $req->execute(array('id' => $id));

        $post = $req->fetch();

        return new ArticleModel($post['id'], $post['articlename']);
    }

    public static function getArticleNameById($id)
    {
        $db = Db::getInstance();
        $id = intval($id);
        $req = $db->prepare('SELECT articlename FROM jieqi_article_article WHERE articleid = :id');

        $req->execute(array('id' => $id));

        $post = $req->fetch();

        return $post['articlename'];
    }

    public static function getCountByDay($articleid, $beginTime, $endTime)
    {
        $db = Db::getInstance();

        $defaultBeginTime = date("Y-m-d", strtotime("-7 day")) . " 00:00:00";
        $defaultBeginTime = time($defaultBeginTime);

        // For testing
        $defaultBeginTime = 0;//1173743584
        $endTime = time();//1474297261
        //$articleid = 35658;

        $sql = <<<EOF
            SELECT 
                count( * ) AS num, 
                from_unixtime( buytime , '%Y-%m-%d' ) AS time
            FROM 
                test_yueloo.jieqi_article_sale  
            WHERE 
                articleid = :articleid 
             and
                  buytime > :defaultBeginTime
             and 
                  buytime < :endTime     
            GROUP BY 
                from_unixtime( buytime , '%Y%m%d' )                       
EOF;


        $sth = $db->prepare($sql);

        $sth->bindParam(':articleid', $articleid, PDO::PARAM_INT);
        $sth->bindParam(':defaultBeginTime', $defaultBeginTime, PDO::PARAM_STR, 12);
        $sth->bindParam(':endTime', $endTime, PDO::PARAM_STR, 12);

        $sth->execute();

        $result_arr = $sth->fetchAll(PDO::FETCH_ASSOC);

        $length = count($result_arr) - 1;
        for ($i = 0; $i < $length; $i++) {
            $result_arr[$i + 1]['num'] += $result_arr[$i]['num'];

           // echo $result_arr[$i + 1]['num'].'</br>';
        }
        //die;
//        var_dump($result_arr);die;
        return $result_arr;
    }

    public static function getCountByHour($articleid,$chapterid, $beginTime, $endTime)
    {
        $db = Db::getInstance();

        $defaultBeginTime = date("Y-m-d", strtotime("-7 day")) . " 00:00:00";
        $defaultBeginTime = time($defaultBeginTime);

        // For testing
        $defaultBeginTime = 0;//1173743584
        $endTime = time();//1474297261
        //$articleid = 35658;

        $sql = <<<EOF
            SELECT 
                count( * ) AS num, 
                from_unixtime( buytime , '%Y-%m-%d' ) AS time
            FROM 
                test_yueloo.jieqi_article_sale  
            WHERE 
                articleid = :articleid
             and
                chapterid = :chapterid
             and
                  buytime > :defaultBeginTime
             and 
                  buytime < :endTime     
            GROUP BY 
                from_unixtime( buytime , '%Y%m%d' )                       
EOF;


        $sth = $db->prepare($sql);

        $sth->bindParam(':articleid', $articleid, PDO::PARAM_INT);
        $sth->bindParam(':defaultBeginTime', $defaultBeginTime, PDO::PARAM_STR, 12);
        $sth->bindParam(':endTime', $endTime, PDO::PARAM_STR, 12);

        $sth->execute();

        $result_arr = $sth->fetchAll(PDO::FETCH_ASSOC);

        $length = count($result_arr) - 1;
        for ($i = 0; $i < $length; $i++) {
            $result_arr[$i + 1]['num'] += $result_arr[$i]['num'];

            // echo $result_arr[$i + 1]['num'].'</br>';
        }
        //die;
//        var_dump($result_arr);die;
        return $result_arr;
    }
}

?>