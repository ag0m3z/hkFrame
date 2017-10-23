<?php
/**
 * Created by PhpStorm.
 * User: agomez
 * Date: 23/09/2017
 * Time: 12:35 AM
 */

?>
<!DOCTYPE html>
<html >
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title><?=\core\core::$_nombreApp?></title>
    <?=\core\core::includeJS('plugins/jQuery/jquery-3.2.1.js',false)?>
    <?=\core\core::includeJS('content/js/jsGeneral.js',false)?>
    <?=\core\core::includeJS('content/js/jsLogin.js',false)?>
</head>

<body class="full">


<div class="contenedor">
    <h2>Iniciar Sesion</h2>
    <input id="luser">
    <button id="btnLoginIn">Iniciar Sesion</button>
</div>

</body>
<script language="JavaScript">
    //Inicializar Scripts
</script>
</html>