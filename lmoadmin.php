<?php

//
// LigaManager Online 3.02
// Copyright (C) 1997-2002 by Frank Hollwitz
// webmaster@hollwitz.de / http://php.hollwitz.de
//
// überarbeitet für XOOPS RC3 von
// Hans Marx, webmaster@bama-webdesign.de / http://www.bama-webdesign.de
//
// This program is free software; you can redistribute it and/or
// modify it under the terms of the GNU General Public License as
// published by the Free Software Foundation; either version 2 of
// the License, or (at your option) any later version.
//
// This program is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
// General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with this program; if not, write to the Free Software
// Foundation, Inc., 675 Mass Ave, Cambridge, MA 02139, USA.
//
include 'admin_header.php';

OpenTable();
session_start();

if ($xoopsUser->isAdmin($xoopsModule->mid())) {
    $HTTP_SESSION_VARS['lmouserok'] = 2;

    $HTTP_SESSION_VARS['lmouserfile'] = '';
} else {
    $sql = 'SELECT * FROM ' . $db->prefix('lmo_helfer') . ' WHERE uid_lmo = ' . $xoopsUser->uid() . '';

    $result = $db->query($sql);

    while (false !== ($val = $db->fetch_array($result))) {
        if ($val[uid_lmo] == $xoopsUser->uid()) {
            $HTTP_SESSION_VARS['lmouserok'] = 1;

            $HTTP_SESSION_VARS['lmouserfile'] = $val[ligen];
        } else {
            redirect_header(XOOPS_URL . '/', 3, _NOPERM);

            exit();
        }
    }
}
define('LMO_AUTH', 1);
session_register('lmouserok', 'lmousername', 'lmouserpass', 'lmouserfile');
if (!isset($lmouserok)) {
    $lmouserok = '0';
}

if (isset($HTTP_SESSION_VARS['lmouserok'])) {
    $lmouserok = $HTTP_SESSION_VARS['lmouserok'];
}
if (isset($HTTP_SESSION_VARS['lmouserfile'])) {
    $lmouserfile = $HTTP_SESSION_VARS['lmouserfile'];
}

if (!isset($todo)) {
    $todo = '';
}
if ('logout' == $todo) {
    $lmouserok = '0';

    $lmouserpass = '';

    $HTTP_SESSION_VARS['lmouserok'] = 0;

    $HTTP_SESSION_VARS['lmouserfile'] = '';

    header('Location:' . XOOPS_URL . '');

    exit();
}
$ModName = $xoopsModule->dirname();

$modurl = XOOPS_URL . "/modules/$ModName/index.php?file=index";
$modadminurl = 'lmoadmin.php?file=lmoadmin';
$moddir = XOOPS_ROOT_PATH . "/modules/$ModName";
$progdir = XOOPS_ROOT_PATH . "/modules/$ModName";
//$tippspieldir=XOOPS_ROOT_PATH."/modules/$ModName/tippspiel";
$modimages = XOOPS_URL . "/modules/$ModName/images";
$modauth = XOOPS_ROOT_PATH . "/modules/$ModName/auth";
$dirstyle = XOOPS_ROOT_PATH . "/modules/$ModName";
$modstyle = XOOPS_URL . "/modules/$ModName";
echo "<link rel=stylesheet type=\"text/css\" href=\"$modstyle/lmo-style.css\">";
echo '<center>';

$action = 'admin';
$array = [''];
require 'lmo-langload.php';

setlocale(LC_TIME, 'de_DE');
if ($lmouserok > 0) {
    require 'lmo-cfgload.php';

    require 'lmo-tippcfgload.php';

    require 'lmo-adminmain.php';
}
echo '</center>';
CloseTable();
bama_cp_footer();
