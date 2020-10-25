<?php

//
// überarbeitet für XOOPS 2.0 RC2 von
// Hans Marx, webmaster@bama-webdesign.de / http://www.bama-webdesign.de
//
include 'header.php';

if ('lmo' == $xoopsConfig['startpage']) {
    $xoopsOption['show_rblock'] = 0;

    require XOOPS_ROOT_PATH . '/header.php';

    make_cblock();

    echo '<br>';
} else {
    $xoopsOption['show_rblock'] = 0;

    require XOOPS_ROOT_PATH . '/header.php';
}
if (!isset($action)) {
    $action = '';
}
if ('tipp' == $action) {
    session_start();
}
if ('bbopf' == $xoopsTheme['thename'] || 'bbopf_breit' == $xoopsTheme['thename']) {
    $table_title = 'Liga-Manager auf ' . $meta['title'];

    OpenTable('100%', $table_title);
} else {
    $table_title = '';

    OpenTable('100%', $table_title);

    echo '<center><h5>Liga-Manager auf ' . $meta['title'] . '</h5></center>';
}

$ModName = $xoopsModule->dirname();
$progurl = XOOPS_URL . "/modules/$ModName";
$modurl = XOOPS_URL . "/modules/$ModName/index.php?file=index";
$moddir = XOOPS_ROOT_PATH . "/modules/$ModName";
$modimages = XOOPS_URL . "/modules/$ModName/images";
$modstyle = XOOPS_URL . "/modules/$ModName";
$index = 0;

include $moddir . '/include/function.php';

$a_dirlist = getLigenListAsArray(XOOPS_ROOT_PATH . '/modules/lmo/ligen/');

if (1 == count($a_dirlist)) {
    $datafile = 'modules/lmo/ligen/' . $a_dirlist[1]['files'] . '.l98';

    $file = 'index';
}

echo '<center>';
require XOOPS_ROOT_PATH . '/modules/' . $xoopsModule->dirname() . '/lmo-start.php';
echo '</center>';
CloseTable($table_title);

require XOOPS_ROOT_PATH . '/footer.php';
