<?php
/**
 * Resolver for Canonical extra
 *
 * Copyright 2010-2014 Bob Ray <https://bobsguides.com>
 * Created on 06-11-2022
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
 * @package canonical
 * @subpackage build
 */

/* @var $object xPDOObject */
/* @var $modx modX */

/* @var array $options */

if ($object->xpdo) {
    $modx =& $object->xpdo;
    switch ($options[xPDOTransport::PACKAGE_ACTION]) {
        case xPDOTransport::ACTION_INSTALL:
        case xPDOTransport::ACTION_UPGRADE:

        $prefix = $modx->getVersionData()['version'] >= 3
            ? 'MODX\Revolution\\'
            : '';
        $c = array('name' => 'setting_canonical_always');
        $entry = $modx->getObject($prefix . 'modLexiconEntry', $c);

        if (!$entry) {
            $entry = $modx->newObject($prefix . 'modLexiconEntry');
        }
        $entry->set('name', 'setting_canonical_always');
        $entry->set('value', 'Canonical always (merge)');
        $entry->set('topic', 'default');
        $entry->set('namespace', 'canonical');
        if ($entry->save()) {
            $modx->log(modX::LOG_LEVEL_INFO, 'Adjusted setting name');
        };

            break;

        case xPDOTransport::ACTION_UNINSTALL:
            break;
    }
}

return true;