<?php
$this->breadcrumbs=array(
	'Work'=>array('list'),
	$model->title,
);

$this->menu=array(
array('label'=>'Create Work','icon'=>'plus','url'=>array('create')),
array('label'=>'Update Work','icon'=>'pencil','url'=>array('update','id'=>$model->item_id)),
array('label'=>'Delete Work','icon'=>'trash','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->item_id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage Work','icon'=>'cog','url'=>array('list')),
);
?>

<h1>View Work #<?php echo $model->item_id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'item_id',
		'category_id',
		'type_id',
		'title',
		'sn',
		'unit',
		'stock',
		'min_number',
		'market_price',
		'shop_price',
		'currency',
		'skus',
		'props',
		'props_name',
		'item_imgs',
		'prop_imgs',
		'pic_url',
		'desc',
		'location',
		'post_fee',
		'express_fee',
		'ems_fee',
		'is_show',
		'is_promote',
		'is_new',
		'is_hot',
		'is_best',
		'is_discount',
		'click_count',
		'sort_order',
		'create_time',
		'update_time',
		'language',
),
)); ?>
