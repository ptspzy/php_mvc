<?php

class DatasController
{

    public function aaa()
    {
        echo 'DatasController';
    }

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

    function getArticleInfoById($id)
    {

    }

    function showArticleChart()
    {
        $ids = [35658, 4, 1284];

        $articles = [];
        for ($i = 0; $i < count($ids); $i++) {
            $articles[$i]['name'] = ArticleModel::getArticleNameById($ids[$i]);
            $articles[$i]['data'] = ArticleModel::getCountByDay($ids[$i]);
        }


        //var_dump($articles);die;

        $article = json_encode($articles, JSON_UNESCAPED_UNICODE);

        require_once('views/datas/article_chart.php');
    }

    function showChapterChart()
    {
        $articleid = 35658;

        $ids = ChapterModel::getVipChapterIds($articleid);

        $chapters = [];
        for ($i = 0; $i < count($ids); $i++) {
            $chapters[$i]['name'] = ChapterModel::getChapterNameById($ids[$i]['id']);
            $chapters[$i]['data'] = ChapterModel::getCountByHour($articleid,$ids[$i]['id']);
        }

        //var_dump($chapters);die;
        $chapters = json_encode($chapters, JSON_UNESCAPED_UNICODE);

        require_once('views/datas/chapter_chart1.php');
    }
}

?>