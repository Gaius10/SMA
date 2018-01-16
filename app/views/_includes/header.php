<?php if (!defined("ROOT_PATH")) exit("Internal Error"); ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $this->title ?></title>

    <!--JavaScript-->
    <script language="JavaScript" src="<?=HOME_URL?>/libs/javascript/jquery.js"></script>
    <script language="JavaScript" src="<?=HOME_URL?>/libs/javascript/valida.js"></script>

    <script language="JavaScript" src="<?=HOME_URL?>/app/views/_javascript/script.js"></script>
    <script language="JavaScript" src="<?=HOME_URL?>/app/views/_javascript/js_functions.js"></script>

    <!--CSS RESET-->
    <link rel="stylesheet" type="text/css" href="<?=STYLE_URL?>/reset.css">
    <!--ESTILO GLOBAL-->
    <link rel="stylesheet" type="text/css" href="<?=STYLE_URL?>/global.css">
    <!--ICONS-->
    <link rel="stylesheet" type="text/css" href="<?=HOME_URL?>/libs/font-awesome/css/font-awesome.css">

    <!-- ESTILOS ESPECÍFICOS -->
    <?php if (isset($styleRequires) and is_array($styleRequires)): ?>
    	<?php foreach ($styleRequires as $v): ?>
            <?php $dir = explode('/', $v); ?>
            <?php $dir = end($dir); ?>
    		<link rel="stylesheet" type="text/css" href="<?=STYLE_URL."/$v"?>/<?= $dir ?>Mobile.css">
    		<link rel="stylesheet" type="text/css" href="<?=STYLE_URL."/$v"?>/<?= $dir ?>Desktop.css">
    	<?php endforeach; ?>
    <?php endif; ?>
</head>
<body>
    <div class="all">
        