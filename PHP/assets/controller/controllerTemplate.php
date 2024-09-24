<?php

require_once '../model/modelTemplate.php';

$template = new Template();

if($_POST['op'] == 1){
    $res = $template -> firstFunction($_POST['id'], $_FILES);
    echo($res);
}else if($_POST['op'] == 2){
    $res = $template -> secondFunction($POST['id'], $_POST['name']);
    echo($res);
}

?>