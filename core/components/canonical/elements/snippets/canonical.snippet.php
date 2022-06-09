<?php
/**
 * Canonical snippet for Canonical extra
 *
 * Copyright 2010-2022 Bob Ray <https://bobsguides.com>
 * @created 07-31-2010
 *
 * Canonical is free software; you can redistribute it and/or modify it under the
 * terms of the GNU General Public License as published by the Free Software
 * Foundation; either version 2 of the License, or (at your option) any later
 * version.
 *
 * Canonical is distributed in the hope that it will be useful, but WITHOUT ANY
 * WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR
 * A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along with
 * Canonical; if not, write to the Free Software Foundation, Inc., 59 Temple
 * Place, Suite 330, Boston, MA 02111-1307 USA
 *
 * @package canonical
 */

/******************************
 *             Usage           *
 *******************************
 *
 * /*
 * Install the snippet with Package Manager and put the
 * following snippet tag in the <head> section of all templates
 * [[!Canonical]]
 */
/** @var $modx modX */

$targetId = '';
$link = '';

$prefix = $modx->getVersionData()['version'] >= 3
    ? 'MODX\Revolution\\'
    : '';

$isMODX3 = empty($prefix) ? false : true;

/** @var array $scriptProperties */
$docId = (int)$modx->resource->get('id');
$mergeFields = (bool)$modx->getOption('symlink_merge_fields', null);
$canonicalAlways = (bool)$modx->getOption('canonical_always', $scriptProperties, true);
$canonicalId = false;

if ($mergeFields) {
    /* Default settings (symlink_merge_fields is on);
       $id may be Symlink ID or ID of regular page */

    /* See if we're a SymLink */
    $doc = $modx->getObject($prefix . 'modResource', $docId);

    /* The first one will only work if class_key is removed from
       forward_merge_excludes */
    if ($doc->get('class_key') == $prefix . 'modSymLink') {
        /* We're in a Symlink */
        $canonicalId = (int)$doc->get('content');
    } else { /* It's a regular page*/
        $canonicalId = $canonicalAlways ? $docId : false;
    }

} else {
    /* Non-Default install settings; (symlink_merge_fields is on)
       $docId is always the ID of the target page or current page */
    if ($canonicalAlways) {
        $canonicalId = $docId; // we're done
    } else {

        /* See if there's a related Symlink */
        $c = array(
            'content' => $docId,
            'class_key' => $prefix . 'modSymlink',
        );
        /* Yes. SymLink Page and target pages get a tag */
        if ($modx->getCount($prefix . 'modResource', $c)) {
            $canonicalId = $docId;
        }
    }
}
return ($canonicalId)
    ? '<link rel="canonical" href="' .
    $modx->makeUrl($canonicalId, "", "", 'full') .
    '" />'
    : '';