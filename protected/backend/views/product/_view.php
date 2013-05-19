<?php
/* @var $this ProductController */
/* @var $data array */
?>


<?php
//$model = Product::model()->findByPk($data['productID']);

$model = $data;
if ($index == 0) {
    ?>
    <tr>
        <th class="span1" style="text-align: center;"><?php echo CHtml::checkBox('checkAll');?></th>
        <th class="span1"><?php echo CHtml::encode($model->getAttributeLabel('productID'));?></th>
        <th class="span2">Картинка</th>
        <th class="span2"><?php echo CHtml::encode($model->getAttributeLabel('name'));?></th>
        <th class="span1"><?php echo CHtml::encode($model->getAttributeLabel('productStatusID'));?></th>
        <th class="span1"><?php echo CHtml::encode($model->getAttributeLabel('discount'));?></th>
        <th class="span1"><?php echo CHtml::encode($model->getAttributeLabel('createdOn'));?></th>
        <th class="span1"><?php echo CHtml::encode($model->getAttributeLabel('modifiedOn'));?></th>
    </tr>
<?php
}
?>

<tr>
    <th class="span1" style="text-align: center;"><?php echo CHtml::checkBox('product');?></th>
    <td class="span1"><?php echo CHtml::link($model->productID, array('view', 'id' => $model->productID));?></td>
    <td class="span2 product-image-cell"><?php echo CHtml::link(CHtml::image($model->thumbnail()), array('view', 'id' => $model->productID));?></td>
    <td class="span2"><?php echo CHtml::link($model->name, array('view', 'id' => $model->productID)); ?></td>
    <td class="span1"><?php echo CHtml::encode(ProductStatus::model()->findByPk($model->productStatusID)->name); ?></td>
    <td class="span1"><?php echo CHtml::encode($model->discount); ?></td>
    <td class="span1">
        <small><?php echo CHtml::encode(date("H:i:s d/m/Y", $model->createdOn)); ?></small>
    </td>
    <td class="span1">
        <small><?php echo CHtml::encode(date("H:i:s d/m/Y", $model->modifiedOn)); ?></small>
    </td>
</tr>