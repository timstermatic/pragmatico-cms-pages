<h2><i class="glyphicon glyphicon-file"></i> <?php echo __('Page Manager');?></h2>

<?php echo $this->Session->flash();?>


<table class="table table-striped">
  <tr>
    <th><?php echo __('Title');?></th>
    <th><?php echo __('Navigation');?></th>
    <th><?php echo __('Status');?></th>
    <th></th>
  </tr>
    <tbody id="sortable">
    <?php foreach($pages as $p) { ?>
    <tr id="row_<?php echo $p['Page']['id'];?>">
      <td><?php echo $p['Page']['title'];?></td>
      <td><?php echo $p['Page']['in_navigation']==1?'<span class="label label-success">Yes</span>':'<span class="label label-default">No</span>';?></td>
      <td><?php echo $p['Page']['published']==1?'<span class="label label-success">Published</span>':'<span class="label label-default">Draft</span>';?></td>
      <td>
        <?php echo $this->Html->link(__('edit'), array('action'=>'edit', $p['Page']['revision_of_page_id']));?> | 
        <?php echo $this->Html->link(__('delete'), array('action'=>'delete', $p['Page']['revision_of_page_id'], $p['Page']['parent_id']),
        false, __('Are you sure you want to delete the page "%s"', $p['Page']['title']));?> 
      </td>
    </tr>
    <?php } ?>
    </tbody>
</table>

<?php echo $this->Html->script('Pages.sortable');?>

<script> 
$("#sortable").tableDnD({onDragClass: "being_dragged",onDrop: function(table, row) {
	$.ajax({
		type: "GET",
		url: "<?php echo Router::url('/cms/pages/pages/reorder', true);?>",
		data: $.tableDnD.serialize()
	});
}});
</script> 
