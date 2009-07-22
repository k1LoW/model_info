graph G {
node [fontsize=12]
<?php foreach ($models as $key => $model): ?>
node<?php echo $model['className']; ?> 
[label="{<table><?php echo $model['className']; ?>
|<cols><?php $first = true;?>
<?php foreach ($model['_schema'] as $f => $field): ?>
<?php echo (!$first) ? "\l" : ''; ?><?php echo $f;?> : <?php echo $field['type']; ?><?php $first = false; ?>
<?php endforeach; ?>\l}", 
shape=Mrecord];

<?php if (!empty($model['belongsTo'])): ?>
<?php foreach ($model['belongsTo'] as $m => $mm): ?>
node<?php echo $model['className']; ?> -- node<?php echo $mm['className']; ?> [taillabel="<?php echo $mm['foreignKey']; ?>", label="[belongsTo]", arrowtail=crow, fontsize=10, color="#CECF63"];
<?php endforeach; ?>
<?php endif; ?>

<?php if (!empty($model['hasMany'])): ?>
<?php foreach ($model['hasMany'] as $m => $mm): ?>
node<?php echo $model['className']; ?> -- node<?php echo $mm['className']; ?> [headlabel="<?php echo $mm['foreignKey']; ?>", label="[hasMany]", arrowhead=crow, fontsize=10, color="#EF3021"];
<?php endforeach; ?>
<?php endif; ?>

<?php if (!empty($model['hasAndBelongsToMany'])): ?>
<?php foreach ($model['hasAndBelongsToMany'] as $m => $mm): ?>
node<?php echo $model['className']; ?> -- node<?php echo $mm['className']; ?> [label="[hasAndBelongsToMany]", arrowhead=crow, arrowtail=crow, fontsize=10, color="#003D4C"]
<?php endforeach; ?>
<?php endif; ?>

<?php endforeach; ?>
}