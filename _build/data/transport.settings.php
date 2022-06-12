<?php
/**
 * systemSettings transport file for Canonical extra
 *
 * Copyright 2010-2014 Bob Ray <https://bobsguides.com>
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
  'name' => 'Canonical always (merge)',
  'description' => 'setting_canonical_always_desc',
  'namespace' => 'canonical',
  'xtype' => 'combo-boolean',
  'value' => true,
  'area' => 'canonical',
), '', true, true);
return $systemSettings;
