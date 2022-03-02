#!/bin/php
<?php
require 'Page.php';

$page = new Page();

$page->id = $argv[1];

$page->templateDir = __DIR__ . "/views";
$page->template = $page->templateDir . "/template.php";
$page->view = $page->templateDir . "/". $page->id .".php";

echo $page;