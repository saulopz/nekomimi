<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Configure nekomimi framework
$_NEKOPATH = "./";
$_STRINGPATH = $_NEKOPATH . "strings/";
$_LANGUAGE = "enUS";

include_once $_NEKOPATH . 'Nekomimi.php';

$request = new Request();
$num = 0;
if ($request->exists("num")) {
    $num = $request->get("num");
}
if ($request->exists("button")) {
    switch ($request->get("button")) {
        case "plus" :
            $num++;
            break;
        case "minus" :
            if ($num > 0) $num--;
            break;
        case "reset" :
            $num = 0;
            break;
    }
}

$file = file_get_contents("test.html");
$tpl = new Template($file, "page");

$line = "";
for ($i = 0; $i < $num; $i++) {
    $tplLine = new Template($file, "line");
    $tplLine->setVar("i", $i);
    $line .= $tplLine;
}
$tpl->set("line", $line);

$message = Template::getString("message", array("n" => $num));
$tpl->setVar("message", $message);
$tpl->setVar("num", $num);
echo $tpl;

