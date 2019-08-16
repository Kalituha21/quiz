<?php
/**
 * @var View $this
 * @var array $params
 */

use Quiz\View;


$content = $this->renderContent($params);

$this->registerCssFile('https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css');
$this->registerJsFile('https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js');
$this->registerJsFile('https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js');
$this->registerJsFile('https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js');
$this->registerCssFile('assets/styles.css');
?>

<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php if ($this->cssFiles): ?>
        <?php foreach ($this->cssFiles as $cssFile): ?>
            <link rel="stylesheet" href="<?= $cssFile; ?>">
        <?php endforeach; ?>
    <?php endif; ?>
    <?php if ($this->jsFiles): ?>
        <?php foreach ($this->jsFiles as $jsFile): ?>
            <script src="<?= $jsFile; ?>"></script>
        <?php endforeach; ?>
    <?php endif; ?>

</head>
<body>
<div id="app">
    <?= $this->renderView('header'); ?>

    <?= $this->renderView('messages'); ?>


    <?= $content; ?>
</div>

<?php if ($this->js): ?>
<script>
    <?= $this->js ?>
</script>
<?php endif; ?>
<script src="assets/scripts.js"></script>
<script src="vue.js"></script>
</body>
</html>
