# Nekomimi

- **Created by Saulo Popov Zambiasi**.
- **Created in 2005**
- **Last update 2018.04.05**

Nekomimi is a simple PHP information manager for HTML
documents. This resource was initially developed for my
own needs and projects, until I decided that it might
be interesting to release for others to use if it is of
any use to anyone. Its features includes:

* internationalization;
* variables;
* templates;
* debug file manager;
* request (get/post) information manager.

## Example

A test.php/test.html is a example using resources of Nekomimi.

It's important configure 4 global variables in your main program:

```
$_NEKO_PATH = "nekomimi/";
$_STRING_PATH = $_NEKO_PATH . "strings/";
$_LANGUAGE = 'enUS';
$_STRING = array();
```

- ***$_NEKO_PATH***: path to nemomimi root folder;
- ***$_STRING_PATH***: path to your internationalization strings. It
can be stored inside NEKOPATH folder, but you can choose your own
place;
- ***$_LANGUAGE***: your language. You can create your own language
file on STRINGPATH with format strings_yourlang.php, and set
LANGUAGE as "yourlang". You can also use a language stored on a
database. 
- ***$_STRING***: it is the array of strings used to
change and translate.

## Observation

Right now I'm a little out of time. When I have time I will do a
better tutorial on using this feature.

# Copyright and license

Copyright 2018 Saulo Popov Zambiasi

Licensed under the Apache License, Version 2.0 (the "License");
you may not use this file except in compliance with the License.
You may obtain a copy of the License at

    http://www.apache.org/licenses/LICENSE-2.0

Unless required by applicable law or agreed to in writing, software
distributed under the License is distributed on an "AS IS" BASIS,
WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
See the License for the specific language governing permissions and
limitations under the License.






