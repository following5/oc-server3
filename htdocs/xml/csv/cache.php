<?php
/***************************************************************************
 * for license information see LICENSE.md
 ***************************************************************************/

$opt['rootpath'] = __DIR__ . '/../../';
require_once __DIR__ . '/../../lib2/web.inc.php';
require_once __DIR__ . '/../../lib2/logic/cache.class.php';

header('Content-type: text/html; charset=utf-8');

$cache = null;
if (isset($_REQUEST['cacheid'])) {
    $cacheId = (int) $_REQUEST['cacheid'];
    $cache = new cache($cacheId);
} else {
    if (isset($_REQUEST['uuid'])) {
        $uuid = $_REQUEST['uuid'];
        $cache = cache::fromUUID($uuid);
    } else {
        if (isset($_REQUEST['wp'])) {
            $wp = $_REQUEST['wp'];
            $cache = cache::fromWP($wp);
        }
    }
}

if ($cache === null) {
    echo '0';
} else {
    if (!$cache->isPublic()) {
        echo '0';
    } else {
        echo $cache->getCacheId();
        echo ';';
        echo '"' . mb_ereg_replace('"', '\"', $cache->getName()) . '"';
        echo ';';
        echo '"' . mb_ereg_replace('"', '\"', $cache->getUsername()) . '"';
        echo ';';
        echo '"' . mb_ereg_replace('"', '\"', $cache->getWPOC()) . '"';
        echo ';';
        echo '"' . mb_ereg_replace('"', '\"', $cache->getWPGC()) . '"';
        echo ';';
        echo '""'; // obsolete Navicache WP
    }
}
