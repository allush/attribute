<?php
/* @var $this ProductController */
/* @var $data Product */
?>


<?php
if ($index == 0) {
    ?>
    <tr>
        <th style="text-align: center;"><?php echo CHtml::checkBox('checkAll');?></th>
        <th><?php echo CHtml::encode($data->getAttributeLabel('productID'));?></th>
        <th>Картинка</th>
        <th><?php echo CHtml::encode($data->getAttributeLabel('name'));?></th>
        <th><?php echo CHtml::encode($data->getAttributeLabel('productStatusID'));?></th>
        <th><?php echo CHtml::encode($data->getAttributeLabel('discount'));?></th>
        <th><?php echo CHtml::encode($data->getAttributeLabel('createdOn'));?></th>
        <th><?php echo CHtml::encode($data->getAttributeLabel('modifiedOn'));?></th>
    </tr>
<?php
}
?>

<tr>
    <th style="text-align: center;"><?php echo CHtml::checkBox('product');?></th>
    <td><?php echo CHtml::encode($data->productID);?></td>
    <td><?php echo CHtml::encode($data->pictures[0]->filename);?></td>
    <td><?php echo CHtml::encode($data->name); ?></td>
    <td><?php echo CHtml::encode($data->productStatusID); ?></td>
    <td><?php echo CHtml::encode($data->discount); ?></td>
    <td><?php echo CHtml::encode($data->createdOn); ?></td>
    <td><?php echo CHtml::encode($data->modifiedOn); ?></td>
</tr>