<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) {
    die();
}

require_once('classes/helpers/helper.php');
require_once('classes/editor.php');

use LayoutEditor\Editor;

$config = [
  'Row'                            => 'base',
  'Img'                            => 'base',
  'Col'                            => 'base',
  'TextComponent'                  => 'base',
  'WysiwygEditor'                  => 'base',
];

if (is_file(dirname(__FILE__).'/config/blocks.json')) {
    $blocks = json_decode(file_get_contents(dirname(__FILE__).'/config/blocks.json'), true);
    $config = array_merge($config, $blocks);
}

Editor::init($config);
