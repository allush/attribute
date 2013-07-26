<?php
/* @var $this ProductController */
/* @var $data Product */
?>

<?php
if ($index == 0) {
    ?>
    <tr>
        <th class="span1" style="text-align: center;"><?php echo CHtml::checkBox('checkAll');?></th>
        <th class="span1"><?php echo CHtml::encode($data->getAttributeLabel('productID'));?></th>
        <th class="span2"><?php echo CHtml::encode($data->getAttributeLabel('group'));?></th>
        <th class="span2">Картинка</th>
        <th class="span2"><?php echo CHtml::encode($data->getAttributeLabel('name'));?></th>
        <th class="span1"><?php echo CHtml::encode($data->getAttributeLabel('productStatusID'));?></th>
        <th class="span1"><?php echo CHtml::encode($data->getAttributeLabel('discount'));?></th>
        <th class="span1"><?php echo CHtml::encode($data->getAttributeLabel('createdOn'));?></th>
        <th class="span1"><?php echo CHtml::encode($data->getAttributeLabel('modifiedOn'));?></th>
    </tr>
<?php
}
?>

<tr>
    <th class="span1"
        style="text-align: center;"><?php echo CHtml::checkBox('productID[]', false, array('value' => $data->productID));?></th>
    <td class="span1"><?php echo CHtml::link($data->productID, array('view', 'id' => $data->productID));?></td>
    <td class="span1"><?php echo ($data->group !== null) ? $data->group : 'Нет';?></td>
    <td class="span2 product-image-cell"><?php echo CHtml::link(CHtml::image($data->thumbnail()), array('view', 'id' => $data->productID));?></td>
    <td class="span2"><?php echo CHtml::link($data->name, array('view', 'id' => $data->productID)); ?></td>
    <td class="span1"><?php echo CHtml::encode(ProductStatus::model()->findByPk($data->productStatusID)->name); ?></td>
    <td class="span1"><?php echo CHtml::encode($data->discount); ?></td>
    <td class="span1">
        <small><?php echo CHtml::encode(date("H:i:s d/m/Y", $data->createdOn)); ?></small>
    </td>
    <td class="span1">
        <small><?php echo CHtml::encode(date("H:i:s d/m/Y", $data->modifiedOn)); ?></small>
    </td>
</tr>