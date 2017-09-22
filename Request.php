<?php

/* ======================================================================
 * Nekomimi v2.0
 * https://github.com/saulopz/nekomimi
 * Last update: 2017.09.22
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

/**
 * Class Request
 */
class Request
{
    private $data;

    public function __construct()
    {
        $this->data = array();
        foreach ($_GET as $name => $value) {
            $this->data[$name] = $value;
        }
        foreach ($_POST as $name => $value) {
            $this->data[$name] = $value;
        }
        foreach ($_FILES as $name => $value) {
            $this->data[$name] = $value;
        }
    }

    public function set($name, $value)
    {
        $this->data[$name] = $value;
    }

    public function get($name)
    {
        return $this->data[$name];
    }

    public function exists($name)
    {
        return array_key_exists($name, $this->data);
    }

    public function __toString()
    {
        return json_encode($this);
    }
}