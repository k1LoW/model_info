graph G {
<?php foreach ($models as $key => $model): ?>
node<?php echo $model['className']; ?> 
[label="{<table><?php echo $model['className']; ?>
|<cols><?php $first = true;?>
<?php foreach ($model['_schema'] as $f => $field): ?>
<?php echo (!$first) ? "\l" : ''; ?><?php echo $f;?><?php $first = false; ?>
<?php endforeach; ?>\l}", 
shape=Mrecord];

<?php if (!empty($model['belongsTo'])): ?>
<?php foreach ($model['belongsTo'] as $m => $mm): ?>
node<?php echo $model['className']; ?> -- node<?php echo $m; ?> [headlabel="0,1",label="(belongsTo)"];
<?php endforeach; ?>
<?php endif; ?>

<?php if (!empty($model['hasMany'])): ?>
<?php foreach ($model['hasMany'] as $m => $mm): ?>
node<?php echo $model['className']; ?> -- node<?php echo $m; ?> [headlabel="0,1",label="(hasMany)"];
<?php endforeach; ?>
<?php endif; ?>

<?php if (!empty($model['hasAndBelongsToMany'])): ?>
<?php foreach ($model['hasAndBelongsToMany'] as $m => $mm): ?>
node<?php echo $model['className']; ?> -- node<?php echo $m; ?> [headlabel="0,1",label="(hasAndBelongsToMany)"];
<?php endforeach; ?>
<?php endif; ?>
<?php endforeach; ?>


}