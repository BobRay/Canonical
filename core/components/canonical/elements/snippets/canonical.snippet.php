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
       $id may be Symlink ID, or ID of regular page;
       it will never be the ID of a target page
     */

    /* See if we're a SymLink */
    $q = 'SELECT id,content,class_key FROM ' . $modx->getTableName($prefix . 'modResource') . ' WHERE id = ' . $docId;

    $stmt = $modx->prepare($q);
    if ($stmt->execute()) {
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


//    $doc = $modx->getObject($prefix . 'modResource', $docId);

    /* The "if" code will only execute if
       request is for a SymLink */
    if ($result[0]['class_key'] == $prefix . 'modSymLink') {
        /* It's a SymLink */
        $canonicalId = (int)$result[0]['content'];
    } else {
        /* It's a regular page; both SymLinks
            and targets get a tag; this one doesn't
            unless all pages do */
        $canonicalId = $canonicalAlways ? $docId : false;
    }

} else {
    /* Non-Default install settings; (symlink_merge_fields is off)
       $docId is always the ID of a target page, or current page
       if current page is not a Symlink */
    if ($canonicalAlways) {
        $canonicalId = $docId; // we're done
    } else {

        /* See if there's a related Symlink */
        $q = 'SELECT COUNT(*) as total FROM ' . $modx->getTableName($prefix . 'modResource') . ' WHERE content = ' . $docId . ' AND class_key = "modSymLink"';

        $stmt = $modx->prepare($q);
        if ($stmt->execute()) {
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        $count = $result[0]['total'];

        if ($count > 0) {
            // if ($modx->getCount($prefix . 'modResource', $c)) {
            /* Yes. SymLink Page and target pages get a tag */
            $canonicalId = $docId;
        }
    }
}
/* $canonicalId will be false if page isn't getting a tag */
return ($canonicalId)
    ? '<link rel="canonical" href="' .
    $modx->makeUrl($canonicalId, "", "", 'full') .
    '" />'
    : '';