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
    if ('' == $tabtype) {
        $tabtype = 0;
    }

    $endtab = $st;

    $addp = $PHP_SELF . '?action=program&amp;file=' . $file . '&amp;selteam=';

    $addr = $PHP_SELF . '?action=results&amp;file=' . $file . '&amp;st=';

    $breite = 10;

    if (1 == $spez) {
        $breite += 2;
    }

    if (1 == $datm) {
        $breite += 1;
    }

    if ($endtab > 1) {
        $endtab--;

        require 'lmo-calctable.php';

        $platz1 = [''];

        $platz1 = array_pad($array, $anzteams + 1, '');

        for ($x = 0; $x < $anzteams; $x++) {
            $platz1[(int)mb_substr($tab0[$x], 34)] = $x + 1;
        }

        $endtab++;
    }

    if (2 == $tabonres) {
        $tabtype = 1;

        require 'lmo-calctable.php';

        $hplatz = [''];

        $hplatz = array_pad($array, $anzteams + 1, '');

        for ($x = 0; $x < $anzteams; $x++) {
            $hplatz[(int)mb_substr($tab0[$x], 34)] = $x + 1;
        }

        $hspiele = $spiele;

        $hsiege = $siege;

        $hunent = $unent;

        $hnieder = $nieder;

        $hpunkte = $punkte;

        $hnegativ = $negativ;

        $hetore = $etore;

        $hatore = $atore;

        $hdtore = $dtore;

        $tabtype = 2;

        require 'lmo-calctable.php';

        $aplatz = [''];

        $aplatz = array_pad($array, $anzteams + 1, '');

        for ($x = 0; $x < $anzteams; $x++) {
            $aplatz[(int)mb_substr($tab0[$x], 34)] = $x + 1;
        }

        $aspiele = $spiele;

        $asiege = $siege;

        $aunent = $unent;

        $anieder = $nieder;

        $apunkte = $punkte;

        $anegativ = $negativ;

        $aetore = $etore;

        $aatore = $atore;

        $adtore = $dtore;

        $tabtype = 0;
    }

    require 'lmo-calctable.php';

    $platz0 = [''];

    $platz0 = array_pad($array, $anzteams + 1, '');

    for ($x = 0; $x < $anzteams; $x++) {
        $platz0[(int)mb_substr($tab0[$x], 34)] = $x + 1;
    } ?>

    <table class="lmosta" cellspacing="0" cellpadding="0" border="0">
        <tr>
            <td align="center">
                <table cellspacing="0" cellpadding="0" border="0">
                    <tr>
                        <?php
                        for ($i = 1; $i <= $anzst; $i++) {
                            echo '<td align="right" ';

                            if ($i != $st) {
                                echo 'class="lmost0"><a href="' . $addr . $i . '" title="' . $text[9] . '">' . $i . '</a>';
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
                    <tr>
                        <td class="lmost4" colspan="<?php echo $breite; ?>"><?php echo $st; ?>. <?php echo $text[2]; ?>
                            <?php if (1 == $dats) { ?>
                                <?php if ('' != $datum1[$st - 1]) {
                            echo ' ' . $text[3] . ' ' . $datum1[$st - 1];
                        } ?>
                                <?php if ('' != $datum2[$st - 1]) {
                            echo ' ' . $text[4] . ' ' . $datum2[$st - 1];
                        } ?>
                            <?php } ?>
                        </td>
                    </tr>

                    <?php for ($i = 0; $i < $anzsp; $i++) {
                            if (($teama[$st - 1][$i] > 0) && ($teamb[$st - 1][$i] > 0)) { ?>
                            <tr>

                                <?php if (1 == $datm) {
                                if ($mterm[$st - 1][$i] > 0) {
                                    $dum1 = strftime($datf, $mterm[$st - 1][$i]);
                                } else {
                                    $dum1 = '';
                                } ?>
                                    <td class="lmost5">
                                        <nobr><?php echo $dum1; ?></nobr>
                                    </td>
                                <?php
                            } ?>

                                <td class="lmost5" width="2">&nbsp;</td>
                                <td class="lmost5" align="right">
                                    <nobr>

                                        <?php
                                        echo '<a href="' . $addp . $teama[$st - 1][$i] . '" title="' . $text[269] . '">';
                                        if (($favteam > 0) && ($favteam == $teama[$st - 1][$i])) {
                                            echo '<b>';
                                        }
                                        echo $teams[$teama[$st - 1][$i]];
                                        if (($favteam > 0) && ($favteam == $teama[$st - 1][$i])) {
                                            echo '</b>';
                                        }
                                        echo '</a>';
                                        ?>

                                    </nobr>
                                </td>
                                <td class="lmost5" align="center" width="10">-</td>
                                <td class="lmost5">
                                    <nobr>

                                        <?php
                                        echo '<a href="' . $addp . $teamb[$st - 1][$i] . '" title="' . $text[269] . '">';
                                        if (($favteam > 0) && ($favteam == $teamb[$st - 1][$i])) {
                                            echo '<b>';
                                        }
                                        echo $teams[$teamb[$st - 1][$i]];
                                        if (($favteam > 0) && ($favteam == $teamb[$st - 1][$i])) {
                                            echo '</b>';
                                        }
                                        echo '</a>';
                                        ?>

                                    </nobr>
                                </td>
                                <td class="lmost5" width="2">&nbsp;</td>
                                <td class="lmost5" align="right"><?php echo $goala[$st - 1][$i]; ?></td>
                                <td class="lmost5" align="center" width="8">:</td>
                                <td class="lmost5"><?php echo $goalb[$st - 1][$i]; ?></td>
                                <?php if (1 == $spez) { ?>
                                    <td class="lmost5" width="2">&nbsp;</td>
                                    <td class="lmost5"><?php echo $mspez[$st - 1][$i]; ?></td>
                                <?php } ?>
                                <td class="lmost5" width="2">&nbsp;</td>
                                <td class="lmost5">

                                    <?php
                                    if (1 == $urlb) {
                                        if ('' != $mberi[$st - 1][$i]) {
                                            echo '<a href="' . $mberi[$st - 1][$i] . '" target="_blank" title="' . $text[270] . '"><img src="lmo-st1.gif" width="16" height="16" border="0"></a>';
                                        } else {
                                            echo '&nbsp;';
                                        }
                                    }
                                    if (('' != $mnote[$st - 1][$i]) || ($msieg[$st - 1][$i] > 0)) {
                                        $dummy = addslashes($teams[$teama[$st - 1][$i]] . ' - ' . $teams[$teamb[$st - 1][$i]] . ' ' . $goala[$st - 1][$i] . ':' . $goalb[$st - 1][$i]);

                                        if (3 == $msieg[$st - 1][$i]) {
                                            $dummy .= ' / ' . $goalb[$st - 1][$i] . ':' . $goala[$st - 1][$i];
                                        }

                                        if (1 == $spez) {
                                            $dummy .= ' ' . $mspez[$st - 1][$i];
                                        }

                                        if (1 == $msieg[$st - 1][$i]) {
                                            $dummy .= '\\n\\n' . $text[219] . ':\\n' . addslashes($teams[$teama[$st - 1][$i]] . ' ' . $text[211]);
                                        }

                                        if (2 == $msieg[$st - 1][$i]) {
                                            $dummy .= '\\n\\n' . $text[219] . ':\\n' . addslashes($teams[$teamb[$st - 1][$i]] . ' ' . $text[211]);
                                        }

                                        if (3 == $msieg[$st - 1][$i]) {
                                            $dummy .= '\\n\\n' . $text[219] . ':\\n' . addslashes($text[212]);
                                        }

                                        if ('' != $mnote[$st - 1][$i]) {
                                            $dummy .= '\\n\\n' . $text[22] . ':\\n' . $mnote[$st - 1][$i];
                                        }

                                        echo "<a href=\"javascript:alert('" . $dummy . "');\" title=\"" . str_replace('\\n', '&#10;', $dummy) . '"><img src="lmo-st2.gif" width="16" height="16" border="0"></a>';
                                    } else {
                                        echo '&nbsp;';
                                    }
                                    ?>

                                </td>
                            </tr>
                            <?php
                        }
                        }

    if (2 == $minus) {
        $dummy = ' colspan="3" align="center"';
    } else {
        $dummy = ' align="right"';
    }

    $breite = 11;

    if (2 == $minus) {
        $breite += 2;
    } ?>

                </table>
            </td>
        </tr>
        <tr>
            <td>
                <table width="100%" cellspacing="0" cellpadding="0" border="0">
                    <tr>
                        <?php $st0 = $st - 1;

    if ($st > 1) {
        echo '<td class="lmost2"><a href="' . $addr . $st0 . '" title="' . $text[6] . '">' . $text[5] . '</a></td>';
    } ?>
                        <?php $st0 = $st + 1;

    if ($st < $anzst) {
        echo '<td align="right" class="lmost2"><a href="' . $addr . $st0 . '" title="' . $text[8] . '">' . $text[7] . '</a></td>';
    } ?>
                    </tr>
                </table>
            </td>
        </tr>


        <tr>
            <td align="center" class="lmost3">
                <table class="lmostb" cellspacing="0" cellpadding="0" border="0">
                    <?php
                    if (2 == $tabonres) {
                        ?>
                        <tr>
                            <td class="lmost4" colspan="6">&nbsp;</td>
                            <td class="lmost4" colspan="<?php echo $breite; ?>">&nbsp;
                            <td class="lmost4" width="2">&nbsp;</td>
                            <td class="lmost4" colspan="<?php echo $breite; ?>"><?php echo $text[41]; ?></td>
                            <td class="lmost4" width="2">&nbsp;</td>
                            <td class="lmost4" colspan="<?php echo $breite; ?>"><?php echo $text[42]; ?></td>
                        </tr>
                        <?php
                    } ?>

                    <tr>
                        <td class="lmost4" colspan="6">&nbsp;</td>
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
                        <?php
                        if (2 == $tabonres) {
                            ?>
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
                            <?php
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

        if ($endtab > 1) {
            if ($platz0[$i] < $platz1[$i]) {
                $y = 1;
            } elseif ($platz0[$i] > $platz1[$i]) {
                $y = 2;
            }
        }

        echo '<td class="' . $dumm1 . '"';

        echo '><img src="lmo-tab' . $y . '.gif" width="9" height="9" border="0">';

        echo '</td>'; ?>
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
                            }

        if (2 == $tabonres) {
            $dumm1 = 'lmotab6'; ?>
                                <td class="<?php echo $dumm1; ?>" width="2">&nbsp;</td>
                                <td class="<?php echo $dumm1; ?>" align="right"><?php echo $dummy . $hspiele[$i] . $dumm2; ?></td>
                                <td class="<?php echo $dumm1; ?>" align="right"><?php echo $dummy . $hsiege[$i] . $dumm2; ?></td>
                                <td class="<?php echo $dumm1; ?>" align="right"><?php echo $dummy . $hunent[$i] . $dumm2; ?></td>
                                <td class="<?php echo $dumm1; ?>" align="right"><?php echo $dummy . $hnieder[$i] . $dumm2; ?></td>
                                <?php
                                if (0 == $tabpkt) {
                                    echo '<td class="' . $dumm1 . '" width="2">&nbsp;</td><td class="' . $dumm1 . '" align="right"><b>' . $hpunkte[$i] . '</b></td>';

                                    if (2 == $minus) {
                                        echo '<td class="' . $dumm1 . '" align="center" width="4"><b>' . ':' . '</b></td>';

                                        echo '<td class="' . $dumm1 . '"><b>' . $hnegativ[$i] . '</b></td>';
                                    }
                                } ?>
                                <td class="<?php echo $dumm1; ?>" width="2">&nbsp;</td>
                                <td class="<?php echo $dumm1; ?>" align="right"><?php echo $dummy . $hetore[$i] . $dumm2; ?></td>
                                <td class="<?php echo $dumm1; ?>" align="center" width="4"><?php echo $dummy; ?>:<?php echo $dumm2; ?></td>
                                <td class="<?php echo $dumm1; ?>"><?php echo $dummy . $hatore[$i] . $dumm2; ?></td>
                                <td class="<?php echo $dumm1; ?>" align="right"><?php echo $dummy . $hdtore[$i] . $dumm2; ?></td>
                                <?php
                                if (1 == $tabpkt) {
                                    echo '<td class="' . $dumm1 . '" width="2">&nbsp;</td><td class="' . $dumm1 . '" align="right"><b>' . $hpunkte[$i] . '</b></td>';

                                    if (2 == $minus) {
                                        echo '<td class="' . $dumm1 . '" align="center" width="4"><b>' . ':' . '</b></td>';

                                        echo '<td class="' . $dumm1 . '"><b>' . $hnegativ[$i] . '</b></td>';
                                    }
                                }

            $dumm1 = 'lmotab7'; ?>
                                <td class="<?php echo $dumm1; ?>" width="2">&nbsp;</td>
                                <td class="<?php echo $dumm1; ?>" align="right"><?php echo $dummy . $aspiele[$i] . $dumm2; ?></td>
                                <td class="<?php echo $dumm1; ?>" align="right"><?php echo $dummy . $asiege[$i] . $dumm2; ?></td>
                                <td class="<?php echo $dumm1; ?>" align="right"><?php echo $dummy . $aunent[$i] . $dumm2; ?></td>
                                <td class="<?php echo $dumm1; ?>" align="right"><?php echo $dummy . $anieder[$i] . $dumm2; ?></td>
                                <?php
                                if (0 == $tabpkt) {
                                    echo '<td class="' . $dumm1 . '" width="2">&nbsp;</td><td class="' . $dumm1 . '" align="right"><b>' . $apunkte[$i] . '</b></td>';

                                    if (2 == $minus) {
                                        echo '<td class="' . $dumm1 . '" align="center" width="4"><b>' . ':' . '</b></td>';

                                        echo '<td class="' . $dumm1 . '"><b>' . $anegativ[$i] . '</b></td>';
                                    }
                                } ?>
                                <td class="<?php echo $dumm1; ?>" width="2">&nbsp;</td>
                                <td class="<?php echo $dumm1; ?>" align="right"><?php echo $dummy . $aetore[$i] . $dumm2; ?></td>
                                <td class="<?php echo $dumm1; ?>" align="center" width="4"><?php echo $dummy; ?>:<?php echo $dumm2; ?></td>
                                <td class="<?php echo $dumm1; ?>"><?php echo $dummy . $aatore[$i] . $dumm2; ?></td>
                                <td class="<?php echo $dumm1; ?>" align="right"><?php echo $dummy . $adtore[$i] . $dumm2; ?></td>
                                <?php
                                if (1 == $tabpkt) {
                                    echo '<td class="' . $dumm1 . '" width="2">&nbsp;</td><td class="' . $dumm1 . '" align="right"><b>' . $apunkte[$i] . '</b></td>';

                                    if (2 == $minus) {
                                        echo '<td class="' . $dumm1 . '" align="center" width="4"><b>' . ':' . '</b></td>';

                                        echo '<td class="' . $dumm1 . '"><b>' . $anegativ[$i] . '</b></td>';
                                    }
                                }
        } ?>
                        </tr>
                    <?php
    } ?>

                </table>
            </td>
        </tr>


    </table>

<?php
} ?>
