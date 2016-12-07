<?php

class DatasController
{
    public function test(){
        echo "This is a test";
    }

    function showArticleChart()
    {
        $ids = [4, 35658, 1284];

        $articles = [];
        for ($i = 0; $i < count($ids); $i++) {
            $articles[$i]['name'] = ArticleModel::getArticleNameById($ids[$i]);
            $articles[$i]['data'] = ArticleModel::getCountByDay($ids[$i]);
        }

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
            $chapters[$i]['data'] = ChapterModel::getCountByHour($articleid, $ids[$i]['id']);
        }

        $chapters = json_encode($chapters, JSON_UNESCAPED_UNICODE);

        require_once('views/datas/chapter_chart1.php');
    }
}

?>