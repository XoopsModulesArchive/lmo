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
if ('' != $file) {
    if (!isset($tabtype)) {
        $tabtype = 0;
    }

    if (($endtab > 1) && (0 == $tabtype) && ('' != $tabdat)) {
        $endtab--;

        require 'lmo-calctable.php';

        $platz1 = [''];

        $platz1 = array_pad($array, $anzteams + 1, '');

        for ($x = 0; $x < $anzteams; $x++) {
            $x3 = (int)mb_substr($tab0[$x], 34);

            $platz1[$x3] = $x + 1;
        }

        $endtab++;
    }

    require 'lmo-calctable.php';

    $platz0 = [''];

    $platz0 = array_pad($array, $anzteams + 1, '');

    for ($x = 0; $x < $anzteams; $x++) {
        $x3 = (int)mb_substr($tab0[$x], 34);

        $platz0[$x3] = $x + 1;
    }

    if ('' == $tabdat) {
        $addt1 = $PHP_SELF . '?action=table&amp;file=' . $file . '&amp;tabtype=';
    } else {
        $addt1 = $PHP_SELF . '?action=table&amp;file=' . $file . '&amp;endtab=' . $endtab . '&amp;tabtype=';
    }

    $addt2 = $PHP_SELF . '?action=table&amp;file=' . $file . '&amp;tabtype=' . $tabtype . '&amp;endtab='; ?>

    <table class="lmosta" cellspacing="0" cellpadding="0" border="0">
        <tr>
            <td align="center">
                <table cellspacing="0" cellpadding="0" border="0">
                    <tr>
                        <?php
                        for ($i = 1; $i <= $anzst; $i++) {
                            echo '<td align="right" ';

                            if (($i != $endtab) || (($i == $endtab) && ('' == $tabdat))) {
                                echo 'class="lmost0"><a href="' . $addt2 . $i . '" title="' . $text[45] . '">' . $i . '</a>';
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
            <td align="center">
                <table cellspacing="0" cellpadding="0" border="0">
                    <tr>
                        <?php
                        for ($i = 0; $i < 3; $i++) {
                            echo '<td ';

                            if ($i != $tabtype) {
                                echo 'class="lmost0"><a href="' . $addt1 . $i . '" title="' . $text[27 + $i] . '">' . $text[40 + $i] . '</a>';
                            } else {
                                echo 'class="lmost1">' . $text[40 + $i];
                            }

                            echo '&nbsp;</td>';
                        }

    if (2 == $minus) {
        $dummy = ' colspan="3" align="center"';
    } else {
        $dummy = ' align="right"';
    } ?>
                    <tr>
                </table>
            </td>
        </tr>
        <tr>
            <td align="center" class="lmost3">
                <table class="lmostb" cellspacing="0" cellpadding="0" border="0">
                    <tr>
                        <td class="lmost4" colspan="5"><?php echo $tabdat; ?></td>
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
        $i = (int)mb_substr($tab0[$x - 1], 34);

        if ($i == $favteam) {
            $dummy = '<b>';

            $dumm2 = '</b>';
        } else {
            $dummy = '';

            $dumm2 = '';
        }

        $dumm1 = 'lmost5';

        if (0 == $tabtype) {
            if ((1 == $x) && (0 != $champ)) {
                $dumm1 = 'lmotab1';

                $j = 2;
            }

            if (($x >= $j) && ($x < $j + $anzcl) && ($anzcl > 0)) {
                $dumm1 = 'lmotab2';
            }

            if (($x >= $j + $anzcl) && ($x < $j + $anzcl + $anzck) && ($anzck > 0)) {
                $dumm1 = 'lmotab3';
            }

            if (($x >= $j + $anzcl + $anzck) && ($x < $j + $anzcl + $anzck + $anzuc) && ($anzuc > 0)) {
                $dumm1 = 'lmotab4';
            }

            if (($x <= $anzteams) && ($x > $anzteams - $anzab) && ($anzab > 0)) {
                $dumm1 = 'lmotab5';
            }

            if (($x <= $anzteams - $anzab) && ($x > $anzteams - $anzab - $anzar) && ($anzar > 0)) {
                $dumm1 = 'lmotab8';
            }
        } ?>
                        <tr>
                            <td class="<?php echo $dumm1; ?>" align="right"><?php echo $dummy . $x . $dumm2; ?></td>
                            <?php
                            $y = 0;

        if (($endtab > 1) && (0 == $tabtype) && ('' != $tabdat)) {
            if ($platz0[$i] < $platz1[$i]) {
                $y = 1;
            } elseif ($platz0[$i] > $platz1[$i]) {
                $y = 2;
            }
        }

        if ('' != $tabdat) {
            echo '<td class="' . $dumm1 . '"';

            if (0 == $tabtype) {
                echo '><img src="lmo-tab' . $y . '.gif" width="9" height="9" border="0">';
            } else {
                echo ' width="2">&nbsp;';
            }

            echo '</td>';
        } else {
            echo '<td class="' . $dumm1 . '">&nbsp;</td>';
        } ?>
                            <td class="<?php echo $dumm1; ?>">
                                <nobr>
                                    <?php
                                    if (('' != $teamu[$i]) && (1 == $urlt)) {
                                        echo '<a href="' . $teamu[$i] . '" target="_blank" title="' . $text[46] . '">';
                                    }

        echo $dummy . $teams[$i] . $dumm2;

        if (('' != $teamu[$i]) && (1 == $urlt)) {
            echo '</a>';
        } ?>
                                </nobr>
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

                                    echo '<td class="' . $dumm1 . "\" align='left'><b>" . $negativ[$i] . '</b></td>';
                                }
                            } ?>
                            <td class="<?php echo $dumm1; ?>" width="2">&nbsp;</td>
                            <td class="<?php echo $dumm1; ?>" align="right"><?php echo $dummy . $etore[$i] . $dumm2; ?></td>
                            <td class="<?php echo $dumm1; ?>" align="center" width="4"><?php echo $dummy; ?>:<?php echo $dumm2; ?></td>
                            <td class="<?php echo $dumm1; ?>" align='left'><?php echo $dummy . $atore[$i] . $dumm2; ?></td>
                            <td class="<?php echo $dumm1; ?>" align="right"><?php echo $dummy . $dtore[$i] . $dumm2; ?></td>
                            <?php
                            if (1 == $tabpkt) {
                                echo '<td class="' . $dumm1 . '" width="2">&nbsp;</td><td class="' . $dumm1 . '" align="right"><b>' . $punkte[$i] . '</b></td>';

                                if (2 == $minus) {
                                    echo '<td class="' . $dumm1 . '" align="center" width="4"><b>' . ':' . '</b></td>';

                                    echo '<td class="' . $dumm1 . "\" align='left'><b>" . $negativ[$i] . '</b></td>';
                                }
                            } ?>
                        </tr>
                    <?php
    } ?>

                </table>
            </td>
        </tr>
        <?php if ('' != $tabdat) { ?>
            <tr>
                <td>
                    <table width="100%" cellspacing="0" cellpadding="0" border="0">
                        <tr>
                            <?php $st0 = $endtab - 1;
                            if ($endtab > 1) {
                                echo '<td class="lmost2"><a href="' . $addt2 . $st0 . '" title="' . $text[43] . '">' . $text[5] . '</a></td>';
                            } ?>
                            <?php $st0 = $endtab + 1;
                            if ($endtab < $anzst) {
                                echo '<td align="right" class="lmost2"><a href="' . $addt2 . $st0 . '" title="' . $text[44] . '">' . $text[7] . '</a></td>';
                            } ?>
                        </tr>
                    </table>
                </td>
            </tr>
        <?php } ?>
    </table>

<?php
} ?>
