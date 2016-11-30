<?php

/**
 * Created by PhpStorm.
 * User: pzy
 * Date: 16-11-30
 * Time: 上午11:31
 */
class ArticleSale
{
    public $id;
    public $buytime;
    public $articlename;

    public function __construct($id, $buytime, $articlename)
    {
        $this->id = $id;
        $this->buytime = $buytime;
        $this->articlename = $articlename;
    }

    public static function all()
    {
        $list = [];
        $db = Db::getInstance();
        $req = $db->query('SELECT * FROM jieqi_article_sale limit 1000');

        foreach ($req->fetchAll() as $sale) {
            $list[] = new ArticleSale($sale['saleid'],$sale['buytime'],$sale['articlename']);
        }

        return $list;
    }

    public static function find($id)
    {
        $db = Db::getInstance();
        // we make sure $id is an integer
        $id = intval($id);
        $req = $db->prepare('SELECT * FROM posts WHERE id = :id');
        // the query was prepared, now we replace :id with our actual $id value
        $req->execute(array('id' => $id));
        $post = $req->fetch();

        return new Post($post['id'], $post['author'], $post['content']);
    }
}