<?php
/**
 * Canonical snippet for Canonical extra
 *
 * Copyright 2010-2017 Bob Ray <https://bobsguides.com>
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

/*
Install the snippet with Package Manager and put the
following snippet tag in the <head> section of all templates
[[!Canonical]]
*/
/** @var $modx modX */

$docId = $modx->resource->get('id');
$query = $modx->newQuery("modSymLink");

$query->select(array(
    'id',
    'class_key',
    'content',
));
$query->where(array(
    'id' => $docId,
    'class_key' => 'modSymLink'
));

if ($query->prepare() && $query->stmt->execute()) {
    $results = $query->stmt->fetchAll(PDO::FETCH_ASSOC);
}

if (!empty($results)) {
    $id = (integer) $results[0]['content'];
    $url = $modx->makeUrl($id, '', '', 'full');
    return '<link rel="canonical" href="' . $url . '" />';
}
return '';