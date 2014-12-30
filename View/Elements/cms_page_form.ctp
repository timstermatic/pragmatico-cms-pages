<?php echo $this->Form->create();?>

<div class="row">
  
  <div class="col-md-8">
    <?php echo $this->Form->input('Page.title', array('class'=>'form-control'));?>
    <?php echo $this->Form->input('Page.content', array('class'=>'form-control editor', 'type'=>'textarea'));?>
    <hr>
    <fieldset><legend>SEO</legend>
      <?php echo $this->Form->input('Page.meta_title', array('class'=>'form-control'));?>
      <?php echo $this->Form->input('Page.meta_keywords', array('class'=>'form-control'));?>
      <?php echo $this->Form->input('Page.meta_description', array('class'=>'form-control'));?>
        <label>URL</label>
      <div class="input-group">
        <span class="input-group-addon" id="basic-addon1"><?php echo Router::url('/', true);?></span>
        <?php echo $this->Form->input('Page.url', array('class'=>'form-control', 'aria-describedby'=>'basic-addon1', 'div'=>false, 'label'=>false));?>
      </div>
      <br>
    </fieldset>
    <?php echo $this->Form->submit(_('Save changes'), array('class'=>'btn btn-success'));?>
  </div>

  <div class="col-md-4">
    <?php echo $this->Form->input('Page.parent', 
      array('class'=>'form-control', 'options'=>array('NULL'=>__('None (Top Level)'), 1=>__('Yes')) ));?>
    <?php echo $this->Form->input('Page.in_navigation', 
      array('class'=>'form-control', 'options'=>array(0=>__('No'), 1=>__('Yes')) ));?>
    <?php echo $this->Form->input('Page.published', 
      array('class'=>'form-control', 'options'=>array(0=>__('No'), 1=>__('Yes')) ));?>
  </div>

</div>

<?php echo $this->Form->end();?>

<?php echo $this->Html->script(Router::url('/vendor/ckeditor/ckeditor.js', true));?>
<?php echo $this->Html->script(Router::url('/vendor/ckeditor/adapters/jquery.js', true));?>
<script>
  $( 'textarea.editor' ).ckeditor();
</script>
