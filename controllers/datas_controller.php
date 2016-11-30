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
        echo json_encode($result_arr,JSON_UNESCAPED_UNICODE);

//        foreach ($req->fetchAll() as $sale) {
//            $list[] = new ArticleSale($sale['saleid'], $sale['buytime'], $sale['articlename']);
//        }

    }

    function showArticleChart(){
        require_once('views/datas/article_chart.php');
    }

    function showChapterChart(){
        require_once('views/datas/chapter_chart.php');
    }
}

?>