<?php
/**
 * snippets transport file for Canonical extra
 *
 * Copyright 2010-2017 Bob Ray <https://bobsguides.com>
 * Created on 08-24-2014
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
/* @var xPDOObject[] $snippets */


$snippets = array();

$snippets[1] = $modx->newObject('modSnippet');
$snippets[1]->fromArray(array (
  'id' => 1,
  'property_preprocess' => false,
  'name' => 'Canonical',
  'description' => 'Create a canonical tag for Symlinks for SEO',
  'properties' => NULL,
), '', true, true);
$snippets[1]->setContent(file_get_contents($sources['source_core'] . '/elements/snippets/canonical.snippet.php'));

return $snippets;
