
        <li class="dropdown">
          <?php echo $this->Html->link('<i class="glyphicon glyphicon-file"></i> ' . __('Pages') . ' <span class="caret"></span>', '#', 
                  array('class'=>'dropdown-toggle', 'data-toggle'=>'dropdown', 'role'=>'button', 'aria-expanded'=>false, 'escape'=>false));?>
          <ul class="dropdown-menu" role="menu">
            <li><?php echo $this->Html->link('<i class="glyphicon glyphicon glyphicon-list-alt"></i> '. __('view all'), 
                        array('plugin'=>'pages', 'controller'=>'pages', 'action'=>'index'),
                        array('escape'=>false));?></li>
            <li><?php echo $this->Html->link('<i class="glyphicon glyphicon-plus-sign"></i> '. __('create'), 
                        array('plugin'=>'pages', 'controller'=>'pages', 'action'=>'create'),
                        array('escape'=>false));?></li>
          </ul>
        </li>
