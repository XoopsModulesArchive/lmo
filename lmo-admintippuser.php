<?php

//
// LigaManager Online 3.02
// Copyright (C) 1997-2002 by Frank Hollwitz
// webmaster@hollwitz.de / http://php.hollwitz.de
//
// Tippspiel-AddOn 1.20
// Copyright (C) 2002 by Frank Albrecht
// fkalbrecht@web.de
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
require_once 'lmo-admintest.php';
if (2 == $HTTP_SESSION_VARS['lmouserok']) {
    $users = [''];

    if (!isset($del)) {
        $del = '';
    }

    if (!isset($save)) {
        $save = 0;
    }

    $pswfile = $tippauthtxt;

    $datei = fopen($pswfile, 'rb');

    while (!feof($datei)) {
        $zeile = fgets($datei, 1000);

        $zeile = trim(rtrim($zeile));

        if ('' != $zeile) {
            $users[] = $zeile;
        }
    }

    fclose($datei);

    if (-1 == $save) { /// neuen User speichern
        $users[] = trim($_POST['xnickx']) . '|' . trim($_POST['xpassx']) . '|5|||||||1|1|EOL';

        require 'lmo-tippsaveauth.php';
    } elseif ('' != $del) {
        $gef = 0;

        for ($i = 1; $i < count($users) && 0 == $gef; $i++) {
            $dummb = preg_split('[|]', $users[$i]);

            if ($del == $dummb[0]) { // Nick gefunden
                $gef = 1;

                $del = $i;
            }
        }

        if (1 == $gef) {
            $userf3 = preg_split('[|]', $users[$del]);

            $verz = opendir(mb_substr($dirtipp, 0, -1));

            $dummy = [''];

            while ($files = readdir($verz)) {
                if ($userf3[0] . '.tip' == mb_substr($files, -4 - mb_strlen($userf3[0]))) {
                    $dummy[] = $files;
                }
            }

            closedir($verz);

            array_shift($dummy);

            $anztippfiles = count($dummy);

            for ($k = 0; $k < $anztippfiles; $k++) {
                @unlink($dirtipp . $dummy[$k]); // Tipps löschen
            }

            for ($i = $del + 1, $iMax = count($users); $i < $iMax; $i++) {
                $users[$i - 1] = $users[$i];
            }

            array_pop($users); // die letzte Zeile abgeschnitten

            require 'lmo-tippsaveauth.php';
        }
    }

    $adda = $PHP_SELF . '?action=admin&amp;todo=tipp';

    $addo = $PHP_SELF . '?action=admin&amp;todo=tippoptions';

    $adde = $PHP_SELF . '?action=admin&amp;todo=tippemail'; ?>

    <table class="lmosta" cellspacing="0" cellpadding="0" border="0">
        <tr>
            <td class="lmost1" align="center"><?php echo $text[614] ?></td>
        </tr>
        <tr>
            <td align="center" class="lmost3">
                <table class="lmostb" cellspacing="0" cellpadding="0" border="0">

                    <?php
                    if (count($users) > 1) {
                        if (!isset($sort)) {
                            $sort = 'id';
                        }

                        $adds = $PHP_SELF . '?action=admin&amp;todo=tippuser&amp;sort=';

                        $added = $PHP_SELF . '?action=admin&amp;todo=tippuseredit&amp;nick=';

                        $addd = $PHP_SELF . '?action=admin&amp;todo=tippuser&amp;sort=' . $sort . '&amp;del='; ?>
                    <tr>
                        <td class="lmost4" align="right">
                            <nobr>
                                <?php
                                if ('id' != $sort) {
                                    echo "<a href=\"javascript:chklmolink('" . $adds . "id');\">";
                                }

                        echo 'ID'; // ID

                        if ('id' != $sort) {
                            echo '</a>';
                        } ?></nobr>
                        </td>
                        <td class="lmost4">
                            <nobr>
                                <?php
                                if ('nick' != $sort) {
                                    echo "<a href=\"javascript:chklmolink('" . $adds . "nick');\">";
                                }

                        echo $text[523]; // Nickname

                        if ('nick' != $sort) {
                            echo '</a>';
                        } ?></nobr>
                        </td>
                        <td class="lmost4">
                            <nobr>
                                <?php
                                if ('pass' != $sort) {
                                    echo "<a href=\"javascript:chklmolink('" . $adds . "pass');\">";
                                }

                        echo $text[323]; // passwort

                        if ('pass' != $sort) {
                            echo '</a>';
                        } ?></nobr>
                        </td>
                        <td class="lmost4">
                            <nobr>
                                <?php
                                if ('name' != $sort) {
                                    echo "<a href=\"javascript:chklmolink('" . $adds . "name');\">";
                                }

                        echo $text[634]; // Name

                        if ('name' != $sort) {
                            echo '</a>';
                        } ?></nobr>
                        </td>
                        <td class="lmost4">
                            <nobr>
                                <?php
                                if ('team' != $sort) {
                                    echo "<a href=\"javascript:chklmolink('" . $adds . "team');\">";
                                }

                        echo $text[527]; // Team

                        if ('team' != $sort) {
                            echo '</a>';
                        } ?></nobr>
                        </td>
                        <td class="lmost4">
                            <nobr>
                                <?php
                                if ('ltipp' != $sort) {
                                    echo "<a href=\"javascript:chklmolink('" . $adds . "ltipp');\">";
                                }

                        echo $text[770]; // letzter Tipp

                        if ('ltipp' != $sort) {
                            echo '</a>';
                        } ?></nobr>
                        </td>
                        <td class="lmost4">&nbsp;</td>
                        <td class="lmost4">&nbsp;</td>
                    </tr>

                    <?php
                    $anztipper = count($users);

                        $id = array_pad($array, $anztipper, '');

                        $nick = array_pad($array, $anztipper, '');

                        $pass = array_pad($array, $anztipper, '');

                        $name = array_pad($array, $anztipper, '');

                        $email = array_pad($array, $anztipper, '');

                        $team = array_pad($array, $anztipper, '');

                        $ltipp = array_pad($array, $anztipper, '');

                        for ($i = 1; $i < $anztipper; $i++) {
                            $userd = preg_split('[|]', $users[$i]);

                            $id[$i] = $i;

                            $nick[$i] = $userd[0];

                            $pass[$i] = $userd[1];

                            $name[$i] = mb_substr($userd[3], mb_strpos($userd[3], ' ') + 1) . ', ' . mb_substr($userd[3], 0, mb_strpos($userd[3], ' '));

                            $email[$i] = $userd[4];

                            $team[$i] = $userd[5];

                            $ltipp[$i] = 0;

                            $verz = opendir(mb_substr($dirtipp, 0, -1));

                            while ($files = readdir($verz)) {
                                if (mb_substr($files, -5 - mb_strlen($userd[0])) == '_' . $userd[0] . '.tip') {
                                    if (filectime($dirtipp . $files) > $ltipp[$i]) {
                                        $ltipp[$i] = filemtime($dirtipp . $files);
                                    }
                                }
                            }

                            closedir($verz);
                        }

                        $tab0 = [''];

                        for ($a = 1; $a < $anztipper; $a++) {
                            if ('id' == $sort) {
                                $tab0[] = (50000000 + $id[$a]) . (50000000 + $a);
                            } elseif ('nick' == $sort) {
                                $tab0[] = mb_strtolower($nick[$a]) . (50000000 + $a);
                            } elseif ('pass' == $sort) {
                                $tab0[] = mb_strtolower($pass[$a]) . (50000000 + $a);
                            } elseif ('name' == $sort) {
                                $tab0[] = mb_strtolower($name[$a]) . (50000000 + $a);
                            } elseif ('email' == $sort) {
                                $tab0[] = mb_strtolower($email[$a]) . (50000000 + $a);
                            } elseif ('team' == $sort) {
                                $tab0[] = mb_strtolower($team[$a]) . (50000000 + $a);
                            } elseif ('ltipp' == $sort) {
                                $tab0[] = $ltipp[$a] . (50000000 + $a);
                            }
                        }

                        array_shift($tab0);

                        sort($tab0, SORT_STRING);

                        for ($x = 1;
                    $x < $anztipper;
                    $x++) {
                            $i = (int)mb_substr($tab0[$x - 1], -7); ?>
                    <tr>
                        <td class="lmost5" align="right"><?php echo $id[$i]; ?></td>
                        <td class="lmost5"><a href="mailto:<?php echo $email[$i]; ?>"><?php echo $nick[$i]; ?></a></td>
                        <td class="lmost5"><?php echo $pass[$i]; ?></td>
                        <td class="lmost5"><?php echo $name[$i]; ?></td>
                        <td class="lmost5"><?php echo $team[$i]; ?></td>
                        <td class="lmost5"><?php if ($ltipp[$i] > 0) {
                                echo date('d.m.Y H:i', $ltipp[$i]);
                            } ?></td>
                        <?php
                        echo "<td class=\"lmost5\"><a href=\"javascript:chklmolink('" . $added . $nick[$i] . "');\">" . $text[598] . '</a></td>';

                            echo "<td class=\"lmost5\"><a href=\"javascript:chklmolink('" . $addd . $nick[$i] . "');\">" . $text[82] . '</a></td>';
                        }
                    } ?>

                    <tr>
                        <td class="lmost4" colspan="8">
                            <nobr><?php echo $text[636]; ?></nobr>
                        </td>
                    </tr>
                    <form name="lmoeditx" action="<?php echo $PHP_SELF; ?>" method="post">
                        <input type="hidden" name="action" value="admin">
                        <input type="hidden" name="todo" value="tippuser">
                        <input type="hidden" name="save" value="-1">
                        <tr>
                            <td class="lmost5" align="right"><?php if (!isset($anztipper)) {
                        $anztipper = 1;
                    }

    echo $anztipper; ?></td>
                            <td class="lmost5"><input class="lmoadminein" type="text" name="xnickx" size="10" maxlength="32" value="NeuerNick"></td>
                            <td class="lmost5"><input class="lmoadminein" type="text" name="xpassx" size="10" maxlength="32" value="<?php require('lmo-adminuserpass.php') ?>"></td>
                            <td class="lmost5"><acronym title="<?php echo $text[327] ?>"><input class="lmoadminbut" type="submit" name="bestx" value="<?php echo $text[329]; ?>"></acronym></td>
                        </tr>
                    </form>

                </table>
            </td>
        </tr>
        <tr>
            <td>
                <table width="100%" cellspacing="0" cellpadding="0" border="0">
                    <tr>
                        <?php
                        echo "<td class=\"lmost2\" align=\"center\"><a href=\"javascript:chklmolink('" . $adda . "');\" title=\"" . $text[563] . '">' . $text[563] . '</a></td>';

    echo "<td class=\"lmost2\" align=\"center\"><a href=\"javascript:chklmolink('" . $adde . "');\" title=\"" . $text[665] . '">' . $text[665] . '</a></td>';

    echo '<td class="lmost1" align="center">' . $text[614] . '</td>';

    echo "<td class=\"lmost2\" align=\"center\"><a href=\"javascript:chklmolink('" . $addo . "');\" title=\"" . $text[555] . '">' . $text[86] . '</a></td>'; ?>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
<?php
} ?>
