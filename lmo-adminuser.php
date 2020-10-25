<?php

// LigaManager Online 3.02
// Copyright (C) 1997-2002 by Frank Hollwitz
// webmaster@hollwitz.de / http://php.hollwitz.de
// überarbeitet für Xoops RC3 Copyright (C) 2002 by Hans Marx
// webmaster@bama-webdesign.de / http://www.bama-webdesign.de
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

include '../../mainfile.php';
require_once XOOPS_ROOT_PATH . '/class/xoopslists.php';
require_once XOOPS_ROOT_PATH . '/class/xoopsformloader.php';
require XOOPS_ROOT_PATH . "/modules/$ModName/include/function.php";

$userdir = $modadminurl . '&action=admin&todo=user';

switch ($userop) {
    case 'modifyUserSave':

        OpenTable();
        $a_dirlist = getLigenListAsArray(XOOPS_ROOT_PATH . '/modules/lmo/ligen/');
        $i = 1;
        $helfer_ligen = '';
        while (count($a_dirlist[$i]['files'])) {
            if (1 == $check_helfer_liga[$i]) {
                $helfer_ligen .= $a_dirlist[$i]['files'] . ',';
            }

            $i += 1;
        }

        if ('' == $helfer_ligen) {
            header('Location:' . $userdir . "&userop=delUser&nachr=notliga&uid=$uid");

            exit();
        }
        $helfer_ligen = mb_substr($helfer_ligen, 0, -1);
        //		$db = XoopsDatabaseFactory::getDatabaseConnection();
        //		$myts = MyTextSanitizer::getInstance();
        $sql = 'SELECT * FROM ' . $db->prefix('lmo_helfer') . " WHERE uid_lmo = $uid";
        $result = $GLOBALS['xoopsDB']->queryF($sql);
        if (!$myrow = $db->fetch_array($result)) {
            $sql = 'INSERT INTO ' . $db->prefix('lmo_helfer') . " (id, uid_lmo, ligen) VALUES (0, '$uid', '$helfer_ligen')";
        } else {
            $sql = 'UPDATE ' . $db->prefix('lmo_helfer') . " SET ligen='$helfer_ligen' WHERE uid_lmo=$uid";
        }
        if (!$result = $db->query($sql)) {
            echo "<p><font size='3'><b>" . _LMO_NOTWORK . '</b></font></p>';

            CloseTable();

            exit();
        }
        CloseTable();
        header('Location:' . $userdir);
        break;
    case 'modifyUser':
        global $db, $xoopsConfig, $xoopsModule;
        //		$db = XoopsDatabaseFactory::getDatabaseConnection();
        //		$myts = MyTextSanitizer::getInstance();
        $a_dirlist = getLigenListAsArray(XOOPS_ROOT_PATH . '/modules/lmo/ligen/');
        OpenTable();
        $helfer = new XoopsUser($uid);
        echo '<div><h4>' . sprintf(_LMO_HELFTITEL1, $helfer->getVar('uname')) . '</h4>';
        if (!count($a_dirlist)) {
            echo '[ ' . _LMO_NOLIGA . ' ]';
        } else {
            echo "<form name='modifyUserSave' action='$userdir' method='post'>";

            echo "<table width='100%' border='0' cellspacing='1' cellpadding='4' class='bg2'>" . '<tr>' . "<td class='bg1' width='10%' align='center'><b>" . _LMO_SELLIGA . '</b></td>' . "<td class='bg1'><b>" . _LMO_LIGA . '</b></td>';

            $i = 1;

            while (count($a_dirlist[$i]['bez'])) {
                echo "</tr><td class='bg3' align='center'><input type='checkbox' name='check_helfer_liga[$i]' value='1'";

                $sql = 'SELECT * FROM ' . $db->prefix('lmo_helfer') . ' WHERE uid_lmo = ' . $helfer->uid() . '';

                $result = $GLOBALS['xoopsDB']->queryF($sql);

                while (false !== ($val = $GLOBALS['xoopsDB']->fetchBoth($result))) {
                    if (preg_match($a_dirlist[$i]['files'], $val[ligen])) {
                        echo ' checked';
                    }
                }

                echo '>';

                echo "</td><td class='bg3'><b>" . $a_dirlist[$i]['bez'] . '</b></td></tr>';

                $i += 1;
            }

            echo "<tr><td class='bg3' colspan='2' align='center'><input type='submit' value='" . _LMO_GO . "'></td></tr>";

            echo "<input type='hidden' name='userop' value='modifyUserSave'>";

            echo "<input type='hidden' name='uid' value='" . $helfer->uid() . "'>";

            echo '</form></table>';
        }

        CloseTable();
        break;
    case 'delUser':
        OpenTable();
        $userdata = new XoopsUser($uid);
        if ('notliga' == $nachr) {
            echo '<div><br><h4>' . sprintf(_LMO_AYSYWTDU2, $userdata->getVar('uname')) . '</h4>';

            echo sprintf(_LMO_BYTHIS2, $userdata->getVar('uname'));
        } else {
            echo '<div><br><h4>' . sprintf(_LMO_AYSYWTDU, $userdata->getVar('uname')) . '</h4>';

            echo sprintf(_LMO_BYTHIS, $userdata->getVar('uname'));
        }
        echo '<br><br>';
        echo "<table><tr><td>\n";
        echo myTextForm($userdir . '&userop=delUserConf&del_uid=' . $userdata->getVar('uid'), _LMO_YES);
        echo "</td><td>\n";
        echo myTextForm($userdir, _LMO_NO);
        echo "</td></tr></table>\n";
        echo '</div>';
        CloseTable();
        break;
    case 'delUserConf':
        global $db, $xoopsConfig, $xoopsModule;

        $helfer = new XoopsUser($del_uid);
        //		$db = XoopsDatabaseFactory::getDatabaseConnection();
        //		$myts = MyTextSanitizer::getInstance();
        $sql = 'DELETE FROM ' . $db->prefix('lmo_helfer') . ' WHERE uid_lmo = ' . $helfer->uid() . '';
        if (!$result = $db->query($sql)) {
            OpenTable();

            echo "<p><font size='3'><b>" . _LMO_NOTWORK . '</b></font></p>';

            echo $del_uid . '<br>';

            echo $helfer->uid() . '<br>';

            CloseTable();

            exit();
        }

        header('Location:' . $userdir);
        break;
    default:
        global $db, $xoopsConfig, $xoopsModule;
        OpenTable();
        $editform = new XoopsThemeForm(_LMO_HELFTITEL, 'edithelfer', '' . $userdir . '');
        $helfer_select = new XoopsFormSelect(_LMO_NICKNAME, 'uid');
        $helfer_select->addOptionArray(getHelferList());
        $op_select = new XoopsFormSelect('', 'userop');
        $op_select->addOptionArray(['modifyUser' => _LMO_MODIFYUSER, 'delUser' => _LMO_DELUSER]);
        $submit_button = new XoopsFormButton('', 'submit', _LMO_GO, 'submit');
        $fct_hidden = new XoopsFormHidden('fct', 'users');
        $editform->addElement($helfer_select);
        $editform->addElement($op_select);
        $editform->addElement($submit_button);
        $editform->addElement($fct_hidden);
        $editform->display();
        CloseTable();
        echo '<br>';
        OpenTable();
        echo "<p><font size='3'><b>" . _LMO_HELFTITEL2 . '</b></font></p>';
        echo "<table width='100%' border='0' cellspacing='1' cellpadding='4' class='bg2'>" . '<tr>' . "<td class='bg1' width='30%'><b>" . _LMO_NICKNAME . '</b></td>' . "<td class='bg1' width='70%'><b>" . _LMO_USERLIGEN . '</b></td>' . '</tr>';
        $a_dirlist = getLigenListAsArray(XOOPS_ROOT_PATH . '/modules/lmo/ligen/');
        //		$db = XoopsDatabaseFactory::getDatabaseConnection();
        //		$myts = MyTextSanitizer::getInstance();
        $sql = 'SELECT * FROM ' . $db->prefix('lmo_helfer') . '';
        $result = $GLOBALS['xoopsDB']->queryF($sql);
        if (!$GLOBALS['xoopsDB']->getRowsNum($result)) {
            echo "<td class='bg3'><b>" . _LMO_HELFNOT . "</b></td><td class='bg3'>&nbsp;</td>";
        } else {
            while (false !== ($val = $GLOBALS['xoopsDB']->fetchBoth($result))) {
                $helfer = new XoopsUser($val[uid_lmo]);

                $i = 1;

                $x = 0;

                $bezlist = '';

                while (count($a_dirlist[$i]['files'])) {
                    if (preg_match($a_dirlist[$i]['files'], $val[ligen])) {
                        $bezlist .= $a_dirlist[$i]['bez'] . '<br>';
                    }

                    $i += 1;
                }

                echo "<td class='bg3' valign='top'><b>" . $helfer->uname() . '</b></td>';

                echo "<td class='bg3'><b>" . $bezlist . '</b></td></tr>';
            }
        }
        echo '</table>';
        CloseTable();
        break;
}
