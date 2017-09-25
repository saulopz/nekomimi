<?php

/* ======================================================================
 * Nekomimi v2.0
 * https://github.com/saulopz/nekomimi
 * Last update: 2017.09.25
 * ======================================================================
 * Copyright 2017 Saulo Popov Zambiasi
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

include_once $_STRINGPATH . "strings_" . $_LANGUAGE . ".php";

/**
 * Class Template
 */
class Template
{
    private $name;
    private $content;

    /**
     * Nekomimi constructor.
     * @param $content : contains a file content as a string format. It is
     * a html templates page loaded with file_get_contents("filename.html").
     * @param $name : template name in content.
     */
    public function __construct($content, $name)
    {
        $this->name = $name;
        $this->content = $this->make($content);
        $this->translation();
    }

    private function make($content)
    {
        $begin = "<!-- tpl:" . $this->name . " -->";
        $end = "<!-- /tpl:" . $this->name . " -->";
        $posBegin = stripos($content, $begin) + strlen($begin);
        $posEnd = stripos($content, $end);
        if (!$posBegin || !$posEnd) return "";
        return substr($content, $posBegin, $posEnd - $posBegin);
    }

    private function translation()
    {
        $find = array();
        $pos = 0;
        while ($ini = stripos($this->content, "{str:", $pos)) {
            $ini += 5;
            $end = stripos($this->content, "}", $ini);
            if ($end) {
                $offset = $end - $ini;
                array_push($find, substr($this->content, $ini, $offset));
            }
            $pos = $end;
        }
        foreach ($find as $key => $value) {
            $tmp = str_ireplace("{str:" . $value . "}",
                Template::getString($value), $this->content);
            $this->content = $tmp;
        }
    }

    /**
     * getString
     * @param $name : Name of string to get from translation files.
     * @param null $vet : array with name and value of vars to change.
     * @return mixed
     */
    public static function getString($name, $vet = null)
    {
        global $_STRING;
        $out = $_STRING[$name];
        if (is_array($vet)) {
            foreach ($vet as $key => $value) {
                $out = str_ireplace("{" . $key . "}", $value, $out);
            }
        }
        return $out;
    }

    public function setVar($name, $value)
    {
        $tmp = str_ireplace("{" . $name . "}", $value, $this->content);
        $this->content = $tmp;
    }

    public function set($templateName, $content)
    {
        $begin = "<!-- tpl:" . $templateName . " -->";
        $end = "<!-- /tpl:" . $templateName . " -->";
        $posBegin = stripos($this->content, $begin) - 1;
        $posEnd = stripos($this->content, $end) + strlen($end) + 1;

        $tmp = substr($this->content, 0, $posBegin);
        $tmp .= $content;
        $tmp .= substr($this->content, $posEnd, strlen($this->content));
        $this->content = $tmp;
    }

    public function __toString()
    {
        return $this->content;
    }
}