<?php
/**
 * Created by PhpStorm.
 * User: alejandro.gomez
 * Date: 03/10/2017
 * Time: 06:47 PM
 */

include "../../../core/core.php";
\core\core::HeaderContetType();

echo json_encode(array('result'=>"ok"));