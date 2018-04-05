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

class MultiLang
{
    public static function set($language)
    {
        global $_LANGUAGE, $_STRING_PATH, $_STRING;
        $file = $_STRING_PATH . "strings_" . $language . ".php";
        if (file_exists($file)) {
            $_LANGUAGE = $language;
            include $file;
        }
    }

    /**
     * getString
     * @param $name : Name of string to get from translation files.
     * @param null $vet : array with name and value of vars to change.
     * @return mixed
     */
    public static function get($name, $vet = null)
    {
        global $_STRING;
        if (!array_key_exists($name, $_STRING)) {
            return "{" . $name . "}";
        }
        $out = $_STRING[$name];
        if (is_array($vet)) {
            foreach ($vet as $key => $value) {
                $out = str_ireplace("{" . $key . "}", $value, $out);
            }
        }
        return $out;
    }

    public static function translate($content)
    {
        $find = array();
        $pos = 0;
        while ($ini = stripos($content, "{str:", $pos)) {
            $ini += 5;
            $end = stripos($content, "}", $ini);
            if ($end) {
                $offset = $end - $ini;
                array_push($find, substr($content, $ini, $offset));
            }
            $pos = $end;
        }
        foreach ($find as $key => $value) {
            $tmp = str_ireplace("{str:" . $value . "}",
                MultiLang::get($value), $content);
            $content = $tmp;
        }
        return $content;
    }
}

MultiLang::set($_LANGUAGE);