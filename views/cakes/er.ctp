<?php echo $javascript->link('../model_info/js/recursive.js'); ?>
<div class="actions">
    <ul>
        <li><?php echo $html->link(__('Back',true), array('controller' => 'model_info', 'action' => 'index')); ?></li>
    </ul>
</div>
<div id="reset"><?php __('Reset'); ?></div>
<div id="recursive">
    <ul>
        <li>-1</li>
        <li>0</li>
        <li>1</li>
        <li>2</li>
    </ul>
</div>
<?php foreach ($models as $m => $model):?>
<div class="model" id="<?php echo $model['className']; ?>">
<table>
    <tr>
        <th colspan="2"><?php echo $model['className']; ?></th>
    </tr>
    <?php foreach ($model['_schema'] as $s => $field): ?>
    <tr>
        <td><?php echo $s; ?></td>
        <td><?php echo $field['type']; ?></td>
    </tr>
    <?php endforeach; ?>
</table>
<table class="assocs">

    <?php if (!empty($model['belongsTo'])): ?>
    <tr>
        <th colspan="2">belongsTo</th>
    </tr>
    <?php foreach ($model['belongsTo'] as $b => $belongsTo): ?>
    <tr class="assoc belongsTo">
        <td class="className"><?php echo $belongsTo['className']; ;?></td>
        <td class="foreignKey"><?php echo $belongsTo['foreignKey']; ;?></td>
    </tr>
    <?php endforeach; ?>
    <?php endif; ?>

    <?php if (!empty($model['hasMany'])): ?>
    <tr>
        <th colspan="2">hasMany</th>
    </tr>
    <?php foreach ($model['hasMany'] as $b => $hasMany): ?>
    <tr class="assoc hasMany">        
        <td class="className"><?php echo $hasMany['className']; ;?></td>
        <td class="foreignKey"><?php echo $hasMany['foreignKey']; ;?></td>
    </tr>
    <?php endforeach; ?>
    <?php endif; ?>

    <?php if (!empty($model['hasOne'])): ?>
    <tr>
        <th colspan="2">hasOne</th>
    </tr>
    <?php foreach ($model['hasOne'] as $b => $hasOne): ?>
    <tr class="assoc hasOne">        
        <td class="className"><?php echo $hasOne['className']; ;?></td>
        <td class="foreignKey"><?php echo $hasOne['foreignKey']; ;?></td>
    </tr>
    <?php endforeach; ?>
    <?php endif; ?>

    <?php if (!empty($model['hasAndBelongsToMany'])): ?>
    <tr>
        <th colspan="2">hasAndBelongsToMany</th>
    </tr>
    <?php foreach ($model['hasAndBelongsToMany'] as $b => $hasAndBelongsToMany): ?>
    <tr class="assoc hasAndBelongsToMany">        
        <td class="className"><?php echo $hasAndBelongsToMany['className']; ;?></td>
        <td class="foreignKey"><?php echo $hasAndBelongsToMany['foreignKey']; ;?></td>
    </tr>
    <?php endforeach; ?>
    <?php endif; ?>

</table>
</div>
<?php endforeach; ?>