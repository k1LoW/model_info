<div class="actions">
    <ul>
        <li><?php echo $html->link(__('Back',true), array('controller' => 'model_info', 'action' => 'index')); ?></li>
    </ul>
</div>
<div>
    <?php foreach ($tables as $t => $table): ?>
    <div class="table">
        <table>
            <tr>
                <th colspan="2"><?php echo $t; ?></th>
            </tr>
            <?php foreach ($table['fields'] as $f => $field): ?>
            <tr class="field">
                <td><?php echo $f; ?></td>
                <td><?php echo $field['type']; ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
    <?php endforeach; ?>
</div>