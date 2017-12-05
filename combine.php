<?php

$path_parts=pathinfo($_SERVER[REQUEST_URI]);
$cache = true;
$cachedir = $DOCUMENT_ROOT . '/cache';
$cssdir = $DOCUMENT_ROOT . $path_parts['dirname'];
$jsdir = $DOCUMENT_ROOT . $path_parts['dirname'];


?>