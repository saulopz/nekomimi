<?php

/* ======================================================================
 * Nekomimi v2.1
 * https://github.com/saulopz/nekomimi
 * Last update: 2018.04.05
 * ======================================================================
 * Copyright 2018 Saulo Popov Zambiasi
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

error_reporting(E_ALL);
ini_set('display_errors', 1);

include_once 'Nekomimi.php';

$request = new Request();
$num = 0;
$lang = "enUS";
if ($request->exists("num")) {
    $num = $request->get("num");
}
if (!$request->exists("buttonSetLang")) {
    if ($request->exists("lang")) {
        $lang = $request->get("lang");
        MultiLang::set($lang);
    }
} else {
    $lang = $request->get("buttonSetLang");
    MultiLang::set($lang);
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

$message = MultiLang::get("message", array("n" => $num));
$tpl->setVar("message", $message);
$tpl->setVar("num", $num);
$tpl->setVar("lang", $lang);
echo $tpl;
