<div class="actions">
    <ul>
        <li><?php echo $html->link(__('Back',true), array('controller' => 'model_info', 'action' => 'index')); ?></li>
        <li><?php echo $html->link(__('Model Info',true), array('controller' => 'cakes', 'action' => 'index')); ?></li>
    </ul>
</div>
<?php echo $html->image(array('action' => 'image')); ?>
