<?php

//
// LigaManager Online 3.02b
// Copyright (C) 1997-2002 by Frank Hollwitz
// webmaster@hollwitz.de / http://php.hollwitz.de
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
if (('' != $file) && (2 == $HTTP_SESSION_VARS['lmouserok'])) {
    require 'lmo-openfile.php';

    if (!isset($team)) {
        $team = '';
    }

    if (!isset($save)) {
        $save = 0;
    }

    if (1 == $save) {
        for ($i = 1; $i <= $anzteams; $i++) {
            if ('' != $_POST['xteams' . $i]) {
                $teams[$i] = $_POST['xteams' . $i];
            }

            $teamk[$i] = $_POST['xteamk' . $i];

            if ('' == $teamk[$i]) {
                $teamk[$i] = mb_substr($teams[$i], 0, 5);
            }

            $teamu[$i] = $_POST['xteamu' . $i];

            $teamn[$i] = $_POST['xteamn' . $i];

            if (0 == $lmtype) {
                $strafp[$i] = (int)$_POST['xstrafp' . $i];

                if (2 == $minus) {
                    $strafm[$i] = (int)$_POST['xstrafm' . $i];
                }
            }
        }

        require 'lmo-savefile.php';
    } elseif ('' != $team) {
        if ($team > 1) {
            if ($anzteams > 4) {
                for ($i = 0; $i < $anzst; $i++) {
                    for ($j = 0; $j < $anzsp; $j++) {
                        if (($teama[$i][$j] == $team) || ($teamb[$i][$j] == $team)) {
                            $teama[$i][$j] = 0;

                            $teamb[$i][$j] = 0;

                            $goala[$i][$j] = -1;

                            $goalb[$i][$j] = -1;

                            $msieg[$i][$j] = 0;

                            $mterm[$i][$j] = '';

                            $mnote[$i][$j] = '';

                            $mberi[$i][$j] = '';

                            if (1 == $spez) {
                                $mspez[$i][$j] = '_';
                            }
                        }
                    }

                    for ($j = $anzsp - 2; $j >= 0; $j--) {
                        if ((0 == $teama[$i][$j]) && (0 == $teamb[$i][$j]) && (-1 == $goala[$i][$j]) && (-1 == $goalb[$i][$j])) {
                            for ($k = $j + 1; $k < $anzsp; $k++) {
                                $teama[$i][$k - 1] = $teama[$i][$k];

                                $teamb[$i][$k - 1] = $teamb[$i][$k];

                                $goala[$i][$k - 1] = $goala[$i][$k];

                                $goalb[$i][$k - 1] = $goalb[$i][$k];

                                $msieg[$i][$k - 1] = $msieg[$i][$k];

                                $mterm[$i][$k - 1] = $mterm[$i][$k];

                                $mnote[$i][$k - 1] = $mnote[$i][$k];

                                $mberi[$i][$k - 1] = $mberi[$i][$k];

                                if (1 == $spez) {
                                    $mspez[$i][$k - 1] = $mspez[$i][$k];
                                }
                            }

                            $teama[$i][$anzsp - 1] = 0;

                            $teamb[$i][$anzsp - 1] = 0;

                            $goala[$i][$anzsp - 1] = -1;

                            $goalb[$i][$anzsp - 1] = -1;

                            $msieg[$i][$anzsp - 1] = 0;

                            $mterm[$i][$anzsp - 1] = '';

                            $mnote[$i][$anzsp - 1] = '';

                            $mberi[$i][$anzsp - 1] = '';

                            if (1 == $spez) {
                                $mspez[$i][$anzsp - 1] = '_';
                            }
                        }
                    }

                    for ($j = 0; $j < $anzsp; $j++) {
                        if ($teama[$i][$j] > $team) {
                            $teama[$i][$j]--;
                        }

                        if ($teamb[$i][$j] > $team) {
                            $teamb[$i][$j]--;
                        }
                    }
                }

                if ($favteam == $team) {
                    $favteam = 0;
                } elseif ($favteam > $team) {
                    $favteam--;
                }

                if ($selteam == $team) {
                    $selteam = 0;
                } elseif ($selteam > $team) {
                    $selteam--;
                }

                if ($stat1 == $team) {
                    $stat1 = $stat2;

                    $stat2 = $team;
                } elseif ($stat1 > $team) {
                    $stat1--;
                }

                if ($stat2 == $team) {
                    $stat2 = 0;
                } elseif ($stat2 > $team) {
                    $stat2--;
                }

                for ($i = $team + 1; $i <= $anzteams; $i++) {
                    $teams[$i - 1] = $teams[$i];

                    $teamk[$i - 1] = $teamk[$i];

                    $teamu[$i - 1] = $teamu[$i];

                    $teamn[$i - 1] = $teamn[$i];

                    $strafp[$i - 1] = $strafp[$i];

                    if (2 == $minus) {
                        $strafm[$i - 1] = $strafm[$i];
                    }
                }

                $teams[$anzteams] = '';

                $teamk[$anzteams] = '';

                $teamu[$anzteams] = '';

                $teamn[$anzteams] = '';

                $strafp[$anzteams] = 0;

                if (2 == $minus) {
                    $strafm[$anzteams] = 0;
                }

                $anzteams--;

                require 'lmo-savefile.php';
            }
        } elseif (-1 == $team) {
            if ($anzteams < 40) {
                $anzteams++;

                $teams[$anzteams] = 'Neue Mannschaft';

                $teamk[$anzteams] = 'Mneu';

                $teamu[$anzteams] = '';

                $teamn[$anzteams] = '';

                $strafp[$anzteams] = 0;

                if (2 == $minus) {
                    $strafm[$anzteams] = 0;
                }

                require 'lmo-savefile.php';
            }
        }
    }

    if (0 == $lmtype) {
        $breite = 7;
    } else {
        $breite = 5;
    }

    $addr = $PHP_SELF . '?action=admin&amp;todo=edit&amp;file=' . $file . '&amp;st=';

    $addb = $PHP_SELF . '?action=admin&amp;todo=tabs&amp;file=' . $file . '&amp;st=';

    $addz = $PHP_SELF . '?action=admin&amp;todo=edit&amp;file=' . $file . '&amp;st=-2&amp;team='; ?>

    <table class="lmosta" cellspacing="0" cellpadding="0" border="0">
        <tr>
            <td align="center">
                <table cellspacing="0" cellpadding="0" border="0">
                    <tr>
                        <?php
                        for ($i = 1; $i <= $anzst; $i++) {
                            echo '<td align="right" ';

                            if ($i != $st) {
                                echo "class=\"lmost0\"><a href=\"javascript:chklmolink('" . $addr . $i . "');\" title=\"" . $text[9] . '">' . $i . '</a>';
                            } else {
                                echo 'class="lmost1">' . $i;
                            }

                            echo '&nbsp;</td>';

                            if (($anzst > 49) && (0 == ($anzst % 4))) {
                                if (($i == $anzst / 4) || ($i == $anzst / 2) || ($i == $anzst / 4 * 3)) {
                                    echo '</tr><tr>';
                                }
                            } elseif (($anzst > 38) && (0 == ($anzst % 3))) {
                                if (($i == $anzst / 3) || ($i == $anzst / 3 * 2)) {
                                    echo '</tr><tr>';
                                }
                            } elseif (($anzst > 29) && (0 == ($anzst % 2))) {
                                if ($i == $anzst / 2) {
                                    echo '</tr><tr>';
                                }
                            }
                        } ?>
                    <tr>
                </table>
            </td>
        </tr>
        <tr>
            <td align="center" class="lmost3">
                <table class="lmostb" cellspacing="0" cellpadding="0" border="0">

                    <form name="lmoedit" action="<?php echo $PHP_SELF; ?>" method="post" onSubmit="return chklmopass()">

                        <input type="hidden" name="action" value="admin">
                        <input type="hidden" name="todo" value="edit">
                        <input type="hidden" name="save" value="1">
                        <input type="hidden" name="file" value="<?php echo $file; ?>">
                        <input type="hidden" name="st" value="<?php echo $st; ?>">

                        <tr>
                            <td class="lmost4"><?php echo $text[127]; ?></td>
                            <td class="lmost4" width="2">&nbsp;</td>
                            <?php if (0 == $lmtype) { ?>
                                <td class="lmost4" align="center"><?php echo $text[128]; ?></td>
                                <td class="lmost4" width="2">&nbsp;</td>
                            <?php } ?>
                            <?php if (0 == $lmtype) { ?>
                                <td class="lmost4"><?php echo $text[404]; ?></td>
                                <td class="lmost4" width="2">&nbsp;</td>
                            <?php } ?>
                            <td class="lmost4"><?php echo $text[129]; ?></td>
                            <?php if (0 == $lmtype) { ?>
                                <td class="lmost5" width="2">&nbsp;</td>
                                <td class="lmost5">
                                    <nobr>
                                        <?php
                                        if ('' != $team) {
                                            echo "<a href=\"javascript:chklmolink('" . $addr . "-3');\" title=\"" . $text[339] . '">' . $text[338] . '</a>';
                                        } else {
                                            echo '&nbsp;';
                                        }
                                        ?>
                                    </nobr>
                                </td>
                            <?php } ?>
                        </tr>
                        <?php for ($i = 1; $i <= $anzteams; $i++) { ?>
                            <tr>
                                <td class="lmost5">
                                    <nobr>
                                        <acronym title="<?php echo $text[125] ?>"><input class="lmoadminein" type="text" name="xteams<?php echo $i; ?>" size="32" maxlength="32" value="<?php echo htmlspecialchars($teams[$i], ENT_QUOTES | ENT_HTML5); ?>" onChange="dolmoedit()"></acronym>
                                        <acronym title="<?php echo $text[126] ?>"><input class="lmoadminein" type="text" name="xteamk<?php echo $i; ?>" size="5" maxlength="5" value="<?php echo $teamk[$i]; ?>" onChange="dolmoedit()"></acronym>
                                    </nobr>
                                </td>
                                <td class="lmost5" width="2">&nbsp;</td>
                                <?php if (0 == $lmtype) { ?>
                                    <td class="lmost5" align="center">
                                        <nobr>
                                            <acronym title="<?php echo $text[131] ?>">
                                                <input class="lmoadminein" type="text" name="xstrafp<?php echo $i; ?>" size="4" maxlength="4" value="<?php echo $strafp[$i]; ?>" onChange="dolmoedit()">
                                                <?php if (2 == $minus) { ?>
                                                    : <input class="lmoadminein" type="text" name="xstrafm<?php echo $i; ?>" size="4" maxlength="4" value="<?php echo $strafm[$i]; ?>" onChange="dolmoedit()">
                                                <?php } ?>
                                            </acronym>
                                        </nobr>
                                    </td>
                                    <td class="lmost5" width="2">&nbsp;</td>
                                <?php } ?>
                                <?php if (0 == $lmtype) { ?>
                                    <td class="lmost5">
                                        <nobr>
                                            <acronym title="<?php echo $text[405] ?>"><input class="lmoadminein" type="text" name="xteamn<?php echo $i; ?>" size="30" maxlength="255" value="<?php echo $teamn[$i]; ?>" onChange="dolmoedit()"></acronym>
                                        </nobr>
                                    </td>
                                    <td class="lmost5" width="2">&nbsp;</td>
                                <?php } ?>
                                <td class="lmost5">
                                    <nobr>
                                        <acronym title="<?php echo $text[130] ?>"><input class="lmoadminein" type="text" name="xteamu<?php echo $i; ?>" size="30" maxlength="128" value="<?php echo $teamu[$i]; ?>" onChange="dolmoedit()"></acronym>
                                    </nobr>
                                </td>
                                <?php if (0 == $lmtype) { ?>
                                    <td class="lmost5" width="2">&nbsp;</td>
                                    <td class="lmost5">
                                        <nobr><a href="javascript:dteamlmolink('<?php echo $addz . $i; ?>','<?php echo $teams[$i]; ?>');" title="<?php echo $text[334]; ?>"><?php echo $text[333]; ?></a></nobr>
                                    </td>
                                <?php } ?>
                            </tr>
                        <?php } ?>
                        <tr>
                            <td class="lmost4" colspan="<?php echo $breite; ?>" align="right">
                                <acronym title="<?php echo $text[114] ?>"><input class="lmoadminbut" type="submit" name="best" value="<?php echo $text[132]; ?>"></acronym>
                            </td>
                            <?php if (0 == $lmtype) { ?>
                                <td class="lmost5" width="2">&nbsp;</td>
                                <td class="lmost5">
                                    <nobr><a href="javascript:ateamlmolink('<?php echo $addz; ?>-1');" title="<?php echo $text[337]; ?>"><?php echo $text[336]; ?></a></nobr>
                                </td>
                            <?php } ?>
                    </form>

                </table>
            </td>
        </tr>

        <tr>
            <td>
                <table width="100%" cellspacing="0" cellpadding="0" border="0">
                    <tr>
                        <?php
                        if (-1 != $st) {
                            echo "<td class=\"lmost2\" align=\"center\"><a href=\"javascript:chklmolink('" . $addr . "-1');\" title=\"" . $text[100] . '">' . $text[99] . '</a></td>';
                        } else {
                            echo '<td class="lmost1" align="center">' . $text[99] . '</td>';
                        }

    if (1 == $hands) {
        if ('tabs' != $todo) {
            echo "<td class=\"lmost2\" align=\"center\"><a href=\"javascript:chklmolink('" . $addb . $stx . "');\" title=\"" . $text[409] . '">' . $text[410] . '</a></td>';
        } else {
            echo '<td class="lmost1" align="center">' . $text[410] . '</td>';
        }
    }

    if (-2 != $st) {
        echo "<td class=\"lmost2\" align=\"center\"><a href=\"javascript:chklmolink('" . $addr . "-2');\" title=\"" . $text[102] . '">' . $text[101] . '</a></td>';
    } else {
        echo '<td class="lmost1" align="center">' . $text[101] . '</td>';
    } ?>
                    </tr>
                </table>
            </td>
        </tr>

    </table>

<?php
} ?>
