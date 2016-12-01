<?php

class DatasController
{
    public function test()
    {

        $article_sale = ArticleSale::all();

        echo json_encode($article_sale, JSON_UNESCAPED_UNICODE);
        //require_once('views/datas/datas.php');
    }

    public function test001()
    {
        $list = [];
        $db = Db::getInstance();

        $beginTime = date("Y-m-d", strtotime("-7 day")) . " 00:00:00";
        $beginTime = time($beginTime);

        //测试数据
        $beginTime = 1473743584;
        $endTime = 1474297261;

        $sql = <<<EOF
            select
                 * 
             from 
                 jieqi_article_sale 
             where
                buytime >'$beginTime'
             and 
                buytime <'$endTime'            
EOF;

        //查询七天数据
        $req = $db->query($sql);
        $result_arr = $req->fetchAll();
        echo json_encode($result_arr, JSON_UNESCAPED_UNICODE);

//        foreach ($req->fetchAll() as $sale) {
//            $list[] = new ArticleSale($sale['saleid'], $sale['buytime'], $sale['articlename']);
//        }

    }

    function showArticleChart()
    {
        $list = [];
        $db = Db::getInstance();

        $defaultBeginTime = date("Y-m-d", strtotime("-7 day")) . " 00:00:00";
        $defaultBeginTime = time($defaultBeginTime);

        $currentTime = time();

        // For testing
        $defaultBeginTime = 1473743584;
        $currentTime = 1474297261;

        $sql = <<<EOF
            SELECT 
                count( * ) AS num, 
                from_unixtime( buytime , '%Y-%m-%d' ) AS time,
                articlename
            FROM 
                test_yueloo.jieqi_article_sale  
            WHERE 
                articleid = 35658 
             and
                  buytime >'$defaultBeginTime'
             and 
                  buytime <'$currentTime'      
            GROUP BY 
                from_unixtime( buytime , '%Y%m%d' )                       
EOF;

        $req = $db->query($sql);
        $result_arr = $req->fetchAll(PDO::FETCH_ASSOC);

        var_dump($result_arr);die;
        echo json_encode($result_arr, JSON_UNESCAPED_UNICODE);

        $article = json_encode($result_arr, JSON_UNESCAPED_UNICODE);

        require_once('views/datas/article_chart.php');
    }

    function showChapterChart()
    {
        require_once('views/datas/chapter_chart.php');
    }
}

?>