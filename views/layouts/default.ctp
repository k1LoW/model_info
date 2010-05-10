<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <?php echo $html->charset(); ?>
    <title>
        <?php __('CakePHP: the rapid development php framework:'); ?>
        <?php echo $title_for_layout; ?>
    </title>
    <script type="text/javascript" src="http://www.google.com/jsapi"></script>
    <script type="text/javascript">google.load("jquery", "1.3");</script>
    <?php
        echo $html->meta('icon');
        echo $html->css('/model_info/css/model_info');
        echo $scripts_for_layout;
    ?>
</head>
<body>
    <div id="container">
        <div id="header">
            <h1><?php echo $html->link(__('CakePHP: the rapid development php framework', true), 'http://cakephp.org'); ?></h1>
        </div>
        <div id="content">

            <?php echo $session->flash(); ?>

            <?php echo $content_for_layout; ?>

        </div>
        <div id="footer">
            <?php echo $html->link(
                    $html->image('cake.power.gif', array('alt'=> __("CakePHP: the rapid development php framework", true), 'border'=>"0")),
                    'http://www.cakephp.org/',
                    array('target'=>'_blank'), null, false
                );
            ?>
        </div>
    </div>
</body>
</html>