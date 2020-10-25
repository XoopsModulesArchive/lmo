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
if ('' != $file) {
    require 'lmo-openfile.php';

    $breite = 16;

    if (1 != $hidr) {
        $breite -= 1;
    }

    if (2 == $minus) {
        $dummy = ' colspan="3" align="center"';

        $breite += 2;
    } else {
        $dummy = ' align="right"';
    }

    $endtab = $st;

    $tabdat = ' ';

    require 'lmo-calctable.php';

    $platz0 = [''];

    $platz0 = array_pad($array, $anzteams + 1, '');

    for ($x = 0; $x < $anzteams; $x++) {
        $x3 = (int)mb_substr($tab2[$x], 34);

        $platz0[$x3] = $x + 1;
    }

    $addt2 = $PHP_SELF . '?action=table&amp;file=' . $file . '&amp;tabtype=' . $tabtype . '&amp;endtab=';

    if (!isset($save)) {
        $save = 0;
    }

    if (1 == $save) {
        $xa = '';

        $xb = '';

        $xc = 0;

        for ($i = 1; $i <= $anzteams; $i++) {
            if ($i < 10) {
                $xa .= '0';

                $xb .= '0';
            }

            $xa .= $i;

            $xb .= trim($_POST['xplatz' . $i]);

            if ($i == trim($_POST['xplatz' . $i])) {
                $xc++;
            }
        }

        if ($xc == $anzteams) {
            $handp[$st - 1] = 0;
        } else {
            $handp[$st - 1] = $xb;
        }

        require 'lmo-savefile.php';
    }

    $handt = array_pad($array, $anzteams + 2, '');

    for ($i = 0; $i < $anzteams; $i++) {
        if (0 != $handp[$st - 1]) {
            $handt[$i + 1] = (int)mb_substr($handp[$st - 1], $i * 2, 2);
        } else {
            $handt[$i + 1] = $i + 1;
        }
    }

    $addr = $PHP_SELF . '?action=admin&amp;todo=edit&amp;file=' . $file . '&amp;st=';

    $addb = $PHP_SELF . '?action=admin&amp;todo=tabs&amp;file=' . $file . '&amp;st=';

    $breite = 16;

    if (1 == $spez) {
        $breite += 2;
    } ?>

    <table class="lmosta" cellspacing="0" cellpadding="0" border="0">
        <tr>
            <td align="center">
                <table cellspacing="0" cellpadding="0" border="0">
                    <tr>
                        <?php
                        for ($i = 1; $i <= $anzst; $i++) {
                            $j = $i;

                            $k = $text[413];

                            echo '<td align="right" ';

                            if ($i != $st) {
                                echo "class=\"lmost0\"><a href=\"javascript:chklmolink('" . $addb . $i . "');\" title=\"" . $k . '">' . $j . '</a>';
                            } else {
                                echo 'class="lmost1">' . $j;
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
                    <form name="lmoedit" action="<?php echo $PHP_SELF; ?>" method="post" onSubmit="return chklmopas2(<?php echo $anzteams; ?>)">
                        <input type="hidden" name="action" value="admin">
                        <input type="hidden" name="todo" value="tabs">
                        <input type="hidden" name="save" value="1">
                        <input type="hidden" name="file" value="<?php echo $file; ?>">
                        <input type="hidden" name="st" value="<?php echo $st; ?>">
                        <tr>
                            <td class="lmost4" colspan="4"><?php echo $st . '. ' . $text[2]; ?></td>
                            <td class="lmost4" width="2">&nbsp;</td>
                            <td class="lmost4" align="right"><?php echo $text[33]; ?></td>
                            <td class="lmost4" align="right"><?php echo $text[34]; ?></td>
                            <?php if (1 != $hidr) {
                            echo '<td class="lmost4" align="right">' . $text[35] . '</td>';
                        } ?>
                            <td class="lmost4" align="right"><?php echo $text[36]; ?></td>
                            <?php if (0 == $tabpkt) {
                            echo '<td class="lmost4" width="2">&nbsp;</td><td class="lmost4"' . $dummy . '>' . $text[37] . '</td>';
                        } ?>
                            <td class="lmost4" width="2">&nbsp;</td>
                            <td class="lmost4" colspan="3" align="center"><?php echo $text[38]; ?></td>
                            <td class="lmost4" align="right"><?php echo $text[39]; ?></td>
                            <?php if (1 == $tabpkt) {
                            echo '<td class="lmost4" width="2">&nbsp;</td><td class="lmost4"' . $dummy . '>' . $text[37] . '</td>';
                        } ?>
                        </tr>

                        <?php
                        $j = 1;

    for ($x = 1; $x <= $anzteams; $x++) {
        $i = (int)mb_substr($tab2[$x - 1], 34);

        if ($i == $favteam) {
            $dummy = '<b>';

            $dumm2 = '</b>';
        } else {
            $dummy = '';

            $dumm2 = '';
        }

        $dumm1 = 'lmost5'; ?>
                            <tr>
                                <td class="<?php echo $dumm1; ?>" align="right"><acronym title="<?php echo $text[414] ?>"><select class="lmoadminein" name="xplatz<?php echo $x; ?>" onChange="dolmoedi2(<?php echo $anzteams; ?>,'xplatz<?php echo $x; ?>')">
                                            <?php
                                            for ($y = 1; $y <= $anzteams; $y++) {
                                                echo '<option value="' . $y . '"';

                                                if ($y == $handt[$x]) {
                                                    echo ' selected';
                                                }

                                                echo '>' . $y . '</option>';
                                            } ?>
                                        </select></acronym></td>
                                <td class="<?php echo $dumm1; ?>">
                                    <nobr><?php echo $dummy . $teams[$i] . $dumm2; ?></nobr>
                                </td>
                                <td class="<?php echo $dumm1; ?>" width="2">&nbsp;</td>
                                <td class="<?php echo $dumm1; ?>">
                                    <?php
                                    if (('' != $teamn[$i]) || ((0 != $strafp[$i]) || (0 != $strafm[$i]))) {
                                        $dum27 = addslashes($teams[$i]);

                                        if ((0 != $strafp[$i]) || (0 != $strafm[$i])) {
                                            $dum27 .= '\\n\\n' . $text[128] . ': ' . $strafp[$i];

                                            if (2 == $minus) {
                                                $dum27 .= ':' . $strafm[$i];
                                            }
                                        }

                                        if ('' != $teamn[$i]) {
                                            $dum27 .= '\\n\\n' . $text[22] . ':\\n' . $teamn[$i];
                                        }

                                        echo "<a href=\"javascript:alert('" . $dum27 . "');\" title=\"" . str_replace('\\n', '&#10;', $dum27) . '"><img src="lmo-st2.gif" width="16" height="16" border="0"></a>';
                                    } else {
                                        echo '&nbsp;';
                                    } ?>
                                </td>
                                <td class="<?php echo $dumm1; ?>" width="2">&nbsp;</td>
                                <td class="<?php echo $dumm1; ?>" align="right"><?php echo $dummy . $spiele[$i] . $dumm2; ?></td>
                                <td class="<?php echo $dumm1; ?>" align="right"><?php echo $dummy . $siege[$i] . $dumm2; ?></td>
                                <?php if (1 != $hidr) { ?>
                                    <td class="<?php echo $dumm1; ?>" align="right"><?php echo $dummy . $unent[$i] . $dumm2; ?></td>
                                <?php } ?>
                                <td class="<?php echo $dumm1; ?>" align="right"><?php echo $dummy . $nieder[$i] . $dumm2; ?></td>
                                <?php
                                if (0 == $tabpkt) {
                                    echo '<td class="' . $dumm1 . '" width="2">&nbsp;</td><td class="' . $dumm1 . '" align="right"><b>' . $punkte[$i] . '</b></td>';

                                    if (2 == $minus) {
                                        echo '<td class="' . $dumm1 . '" align="center" width="4"><b>' . ':' . '</b></td>';

                                        echo '<td class="' . $dumm1 . '"><b>' . $negativ[$i] . '</b></td>';
                                    }
                                } ?>
                                <td class="<?php echo $dumm1; ?>" width="2">&nbsp;</td>
                                <td class="<?php echo $dumm1; ?>" align="right"><?php echo $dummy . $etore[$i] . $dumm2; ?></td>
                                <td class="<?php echo $dumm1; ?>" align="center" width="4"><?php echo $dummy; ?>:<?php echo $dumm2; ?></td>
                                <td class="<?php echo $dumm1; ?>"><?php echo $dummy . $atore[$i] . $dumm2; ?></td>
                                <td class="<?php echo $dumm1; ?>" align="right"><?php echo $dummy . $dtore[$i] . $dumm2; ?></td>
                                <?php
                                if (1 == $tabpkt) {
                                    echo '<td class="' . $dumm1 . '" width="2">&nbsp;</td><td class="' . $dumm1 . '" align="right"><b>' . $punkte[$i] . '</b></td>';

                                    if (2 == $minus) {
                                        echo '<td class="' . $dumm1 . '" align="center" width="4"><b>' . ':' . '</b></td>';

                                        echo '<td class="' . $dumm1 . '"><b>' . $negativ[$i] . '</b></td>';
                                    }
                                } ?>
                            </tr>
                        <?php
    } ?>
                        <tr>
                            <td class="lmost4" colspan="<?php echo $breite; ?>" align="center">
                                <acronym title="<?php echo $text[114] ?>"><input class="lmoadminbut" type="submit" name="best" value="<?php echo $text[415]; ?>"></acronym>
                            </td>
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
                        $st0 = $st - 1;

    if ($st > 1) {
        echo "<td class=\"lmost2\"><a href=\"javascript:chklmolink('" . $addr . $st0 . "');\" title=\"" . $text[6] . '">' . $text[5] . '</a></td>';
    }

    if (-1 != $st) {
        echo "<td class=\"lmost2\" align=\"center\"><a href=\"javascript:chklmolink('" . $addr . "-1');\" title=\"" . $text[100] . '">' . $text[99] . '</a></td>';
    } else {
        echo '<td class="lmost1" align="center">' . $text[99] . '</td>';
    }

    if (1 == $hands) {
        if ('edit' != $todo) {
            echo "<td class=\"lmost2\" align=\"center\"><a href=\"javascript:chklmolink('" . $addr . $st . "');\" title=\"" . $text[411] . '">' . $text[412] . '</a></td>';
        } else {
            echo '<td class="lmost1" align="center">' . $text[412] . '</td>';
        }
    }

    if (2 == $lmouserok) {
        if (-2 != $st) {
            echo "<td class=\"lmost2\" align=\"center\"><a href=\"javascript:chklmolink('" . $addr . "-2');\" title=\"" . $text[102] . '">' . $text[101] . '</a></td>';
        } else {
            echo '<td class="lmost1" align="center">' . $text[101] . '</td>';
        }
    }

    $st0 = $st + 1;

    if ($st < $anzst) {
        echo "<td align=\"right\" class=\"lmost2\"><a href=\"javascript:chklmolink('" . $addr . $st0 . "');\" title=\"" . $text[8] . '">' . $text[7] . '</a></td>';
    } ?>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

<?php
} ?>
