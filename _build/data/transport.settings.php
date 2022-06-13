<?php
/**
 * systemSettings transport file for Canonical extra
 *
 * Copyright 2010-2022 Bob Ray <https://bobsguides.com>
 * Created on 06-11-2022
 *
 * @package canonical
 * @subpackage build
 */

if (! function_exists('stripPhpTags')) {
    function stripPhpTags($filename) {
        $o = file_get_contents($filename);
        $o = str_replace('<' . '?' . 'php', '', $o);
        $o = str_replace('?>', '', $o);
        $o = trim($o);
        return $o;
    }
}
/* @var $modx modX */
/* @var $sources array */
/* @var xPDOObject[] $systemSettings */


$systemSettings = array();

$systemSettings[1] = $modx->newObject('modSystemSetting');
$systemSettings[1]->fromArray(array (
  'key' => 'canonical_always',
  'value' => true,
  'xtype' => 'combo-boolean',
  'namespace' => 'canonical',
  'area' => 'canonical',
  'name' => 'setting_canonical_always',
  'description' => 'setting_canonical_always_desc',
), '', true, true);
return $systemSettings;
