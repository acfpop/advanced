<?php/* * To change this template, choose Tools | Templates * and open the template in the editor. */class WCategory extends CWidget {    public function init() {        parent::init();    }    public function run() {        $key = $_REQUEST['key'];        $category=Category::model()->findByPk(3);        $model = $category->findByAttributes(array('url' => $key));        $childs=$model->children()->findAll();        foreach($childs as $child)        $ids[] = $child->id;        $this->render('category', array(            'model' => $model,        ));    }}