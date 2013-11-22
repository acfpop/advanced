<?phpYii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/fancybox/jquery.mousewheel-3.0.4.pack.js');Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/fancybox/jquery.fancybox-1.3.4.pack.js');Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/js/fancybox/jquery.fancybox-1.3.4.css');?><script type="text/javascript">    $(document).ready(function() {        /* This is basic - uses default settings */        $("a#single_image").fancybox();        /* Using custom settings */        $("a#inline").fancybox({            'hideOnContentClick': true        });        /* Apply fancybox to multiple items */        $("a.group").fancybox({            'transitionIn'	:	'elastic',            'transitionOut'	:	'elastic',            'speedIn'		:	600,            'speedOut'		:	200,            'overlayShow'	:	false        });        $("#LinkOrder").click(function (event) {            $('#orderForm').submit();         });        /*         * 暴力清除商品浏览历史记录！         */        $("#clearRec").click(function (event) {            $.ajax({                url: "<?php echo Yii::app()->createUrl('/item/clearHistory') ?>",                async: false            }),            $(".recent").html("").append("<div style='padding:20px'>没有商品浏览记录!</div>");        });        /*         * 加入进货单          */        $("#LinkPurchase").click(function (event) {            $.ajax({                type:"POST",                url: "<?php echo Yii::app()->createUrl('/cart/addCart') ?>",<!--                data: "item_id="+--><?php //echo $model->item_id ?><!--+"&qty="+--><?php //echo $model->min_number ?><!--,-->                success: function(){                    alert('成功加入采购单');                }            })        });    });</script><?php$this->pageTitle = $model->title . ' - ' . Yii::app()->name . ' - 查看商品';$this->breadcrumbs = array(    '商品列表' => array('/item-list-all'),    $model->category->name => array('/item/index', 'category_id' => $model->category->id),    $model->title,);?><div class="item-detail">    <div class="item-detail-summary clearfix">        <div class="grid_9 alpha">            <div class="item-detail-img">                <a id="single_image" href="<?php echo $model->getMainPicUrl() ?>">                    <?php echo $model->getMainPic() ?></a>            </div>                <p align="center">点击可以查看清晰大图</p>            <!-- JiaThis Button BEGIN -->            <div id="jiathis_style_32x32">                <a class="jiathis_button_qzone"></a>                <a class="jiathis_button_tsina"></a>                <a class="jiathis_button_tqq"></a>                <a class="jiathis_button_renren"></a>                <a class="jiathis_button_kaixin001"></a>                <a href="http://www.jiathis.com/share" class="jiathis jiathis_txt jtico jtico_jiathis" target="_blank"></a>                <a class="jiathis_counter_style"></a>            </div>            <script type="text/javascript" src="http://v2.jiathis.com/code/jia.js" charset="utf-8"></script>            <!-- JiaThis Button END -->        </div>        <div class="grid_16 omega">            <?php echo CHtml::beginForm(array('/cart/addToCart'), 'POST', array('id' => 'orderForm')) ?>            <div class="item-detail-title">                <h3><?php echo $model->title ?></h3>            </div>            <div class="item-detail-meta">                <?php echo CHtml::hiddenField('id', $model->item_id) ?>                <?php echo CHtml::hiddenField('pic_url', $model->getSmallThumb()) ?>                <?php echo CHtml::hiddenField('sn', $model->sn) ?>                    <?php echo CHtml::hiddenField('title', $model->title) ?>                <?php echo CHtml::hiddenField('name', $model->item_id) ?>                <?php echo CHtml::hiddenField('price', $model->shop_price) ?>                <ul>                    <li class="price1">建议零售价：<?php echo $model->currency . $model->market_price ?></li>                    <li class="price2">批发价：<em><?php echo $model->currency . $model->shop_price ?></em></li>                    <li class="sn">商品编号：<?php echo $model->sn ?></li>                    <li class="unit">计量单位：<?php echo $model->unit ?></li>                    <li class="min_number">最少订货量：<?php echo $model->min_number ?> <?php echo $model->unit ?></li>                    <li class="stock">库存：<?php echo $model->stock ?> <?php echo $model->unit ?></li>                    <li class="click_count">浏览次数：<?php echo $model->click_count ?>次</li>                    <li>我要订购：<?php echo CHtml::textField('qty', $model->min_number, array('size' => '4', 'maxlength' => '5')) ?> <?php echo $model->unit ?></li>                </ul>            </div>            <div class="d-action clearfix">                <dl class="clearfix">                    <dd class="d-btn-buy">                        <a data-type="order" title="点击此按钮，到下一步确认购买信息。" target="_self" href="#" id="LinkOrder" class="dmtrack"  rel="nofollow" >立即购买</a>                    </dd>                    <dd class="d-btn-add">                        <a data-type="purchase"  class="dmtrack" id="LinkPurchase" href="#" target="_self" title="加入进货单" rel="nofollow">加入进货单</a>                    </dd>                </dl>            </div>            <?php echo CHtml::endForm(); ?>            <div class="box">                <div class="box-title">同类推荐</div>                <div class="box-content tuijian">                    <?php                    $cri = new CDbCriteria(array(                                'condition' => 'item_id != ' . $model->item_id . ' and category_id =' . $model->category_id,                                'limit' => '3'                            ));                    $items = Item::model()->findAll($cri);                    if ($items) {                        echo '<ul>';                        foreach ($items as $i) {                            ?>                            <li>                                <div class="image"><?php echo $i->getRecommendThumb() ?></div>                                <div class="title"><?php echo $i->getTitle() ?></div>                                <div class="clear"></div>                                <div class="price">零售价：<span class="currency"><?php echo $i->currency ?></span><em><?php echo $i->market_price ?></em></div>                                <div class="price">批发价：<span class="currency"><?php echo $i->currency ?></span><em><?php echo $i->shop_price ?></em></div>                            </li>                            <?php                        }                        echo '</ul>';                    } else {                        ?>                        <p style="text-align:center">没有找到同类其他商品!</p>                    <?php } ?>                </div>            </div>        </div>    </div>    <div class="clear"></div>    <div style="margin-top:20px;">        <div class="grid_19 alpha" style="overflow:hidden">            <?php            $this->widget('zii.widgets.jui.CJuiTabs', array(                'tabs' => array(                    '商品详情' => $this->renderPartial("_desc", array("model" => $model), true),//                '支付方式' => array('content' => 'Content for tab 2', 'id' => 'tab2'),                    '支付方式' => $this->renderPartial("_payment", array("model" => $model), true),                    // panel 3 contains the content rendered by a partial view                    '配送方式' => $this->renderPartial("_shipping", array("model" => $model), true),                    '常见问题' => $this->renderPartial("_faq", array("model" => $model), true),                ),                // additional javascript options for the tabs plugin                'options' => array(                    'collapsible' => true,                ),            ));            ?>        </div>        <div class="grid_6 omega">            <div class="box" >                <div class="box-title">最近浏览过的商品<div class="extra"><a id="clearRec" href="javascript:void(0)">清空</a></div></div>                <div class="recent">                    <?php $this->widget('widgets.default.WItemHistory') ?>                </div>            </div>            <div class="box">                <div class="box-title">相关资讯</div>                <div class="box-content">                </div>            </div>        </div>    </div></div>