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
    $addp = $PHP_SELF . '?action=program&amp;file=' . $file . '&amp;selteam=';

    $addr = $PHP_SELF . '?action=results&amp;file=' . $file . '&amp;st=';

    $breite = 10;

    if (1 == $spez) {
        $breite += 2;
    }

    if (1 == $datm) {
        $breite += 1;
    }

    $anzsp = $anzteams;

    for ($i = 0; $i < $st; $i++) {
        $anzsp /= 2;
    }

    if ((1 == $klfin) && ($st == $anzst)) {
        $anzsp += 1;
    }

    function gewinn($gst, $gsp, $gmod, $m1, $m2)
    {
        $erg = 0;

        if (1 == $gmod) {
            if ($m1[0] > $m2[0]) {
                $erg = 1;
            } elseif ($m1[0] < $m2[0]) {
                $erg = 2;
            }
        } elseif (2 == $gmod) {
            if (($m1[0] + $m1[1]) > ($m2[0] + $m2[1])) {
                $erg = 1;
            } elseif (($m1[0] + $m1[1]) < ($m2[0] + $m2[1])) {
                $erg = 2;
            } else {
                if ($m2[0] > $m1[1]) {
                    $erg = 2;
                } elseif ($m2[0] < $m1[1]) {
                    $erg = 1;
                }
            }
        } else {
            $erg1 = 0;

            $erg2 = 0;

            for ($k = 0; $k < $gmod; $k++) {
                if (('_' != $m1[$k]) && ('_' != $m2[$k])) {
                    if ($m1[$k] > $m2[$k]) {
                        $erg1++;
                    } elseif ($m1[$k] < $m2[$k]) {
                        $erg2++;
                    }
                }
            }

            if ($erg1 > ($gmod / 2)) {
                $erg = 1;
            } elseif ($erg2 > ($gmod / 2)) {
                $erg = 2;
            }
        }

        return $erg;
    } ?>

    <table class="lmosta" cellspacing="0" cellpadding="0" border="0">
        <tr>
            <td align="center">
                <table cellspacing="0" cellpadding="0" border="0">
                    <tr>
                        <?php
                        for ($i = 1; $i <= $anzst; $i++) {
                            echo '<td align="right" ';

                            if ($i == $anzst) {
                                $j = $text[364];

                                $k = $text[365];
                            } elseif ($i == $anzst - 1) {
                                $j = $text[362];

                                $k = $text[363];
                            } elseif ($i == $anzst - 2) {
                                $j = $text[360];

                                $k = $text[361];
                            } elseif ($i == $anzst - 3) {
                                $j = $text[358];

                                $k = $text[359];
                            } else {
                                $j = $i;

                                $k = $text[366];
                            }

                            if ($i != $st) {
                                echo 'class="lmost0"><a href="' . $addr . $i . '" title="' . $k . '">' . $j . '</a>';
                            } else {
                                echo 'class="lmost1">' . $j;
                            }

                            echo '&nbsp;</td>';
                        } ?>
                    <tr>
                </table>
            </td>
        </tr>
        <tr>
            <td align="center" class="lmost3">
                <table class="lmostb" cellspacing="0" cellpadding="0" border="0">
                    <tr>
                        <?php
                        if ($st == $anzst) {
                            $j = $text[374];
                        } elseif ($st == $anzst - 1) {
                            $j = $text[373];
                        } elseif ($st == $anzst - 2) {
                            $j = $text[372];
                        } elseif ($st == $anzst - 3) {
                            $j = $text[371];
                        } else {
                            $j = $st . '. ' . $text[370];
                        } ?>
                        <td class="lmost4" colspan="<?php echo $breite; ?>"><?php echo $j; ?>
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
                    <?php
                    for ($i = 0; $i < $anzsp; $i++) {
                        if (($teama[$st - 1][$i] > 0) && ($teamb[$st - 1][$i] > 0)) {
                            for ($n = 0; $n < $modus[$st - 1]; $n++) {
                                ?>
                                <?php if ((1 == $klfin) && ($st == $anzst)) { ?>
                                    <tr>
                                        <td class="lmost8" colspan=<?php echo $breite; ?>>
                                            <nobr><?php if (1 == $i) {
                                    echo '&nbsp;<br>';
                                }
                                                echo $text[419 + $i]; ?></nobr>
                                        </td>
                                    </tr>
                                <?php } ?>
                                <tr>

                                    <?php if (1 == $datm) {
                                                    if ($mterm[$st - 1][$i][$n] > 0) {
                                                        $dum1 = strftime($datf, $mterm[$st - 1][$i][$n]);
                                                    } else {
                                                        $dum1 = '';
                                                    } ?>
                                        <td class="lmost5">
                                            <nobr><?php echo $dum1; ?></nobr>
                                        </td>
                                    <?php
                                                } ?>

                                    <td class="lmost5" width="2">&nbsp;</td>
                                    <?php
                                    if (0 == $n) {
                                        $m1 = [$goala[$st - 1][$i][0], $goala[$st - 1][$i][1], $goala[$st - 1][$i][2], $goala[$st - 1][$i][3], $goala[$st - 1][$i][4], $goala[$st - 1][$i][5], $goala[$st - 1][$i][6]];

                                        $m2 = [$goalb[$st - 1][$i][0], $goalb[$st - 1][$i][1], $goalb[$st - 1][$i][2], $goalb[$st - 1][$i][3], $goalb[$st - 1][$i][4], $goalb[$st - 1][$i][5], $goalb[$st - 1][$i][6]];

                                        $m = call_user_func('gewinn', $st - 1, $i, $modus[$st - 1], $m1, $m2);

                                        if ((1 == $klfin) && ($st == $anzst)) {
                                            if (0 == $i) {
                                                if (1 == $m) {
                                                    echo '<td class="lmost9a" align="right"><nobr>';
                                                } elseif (2 == $m) {
                                                    echo '<td class="lmost9b" align="right"><nobr>';
                                                } else {
                                                    echo '<td class="lmost5" align="right"><nobr>';
                                                }
                                            } elseif (1 == $i) {
                                                if (1 == $m) {
                                                    echo '<td class="lmost9c" align="right"><nobr>';
                                                } else {
                                                    echo '<td class="lmost5" align="right"><nobr>';
                                                }
                                            }
                                        } else {
                                            if (1 == $m) {
                                                echo '<td class="lmost7" align="right"><nobr>';
                                            } else {
                                                echo '<td class="lmost5" align="right"><nobr>';
                                            }
                                        }

                                        echo '<a href="' . $addp . $teama[$st - 1][$i] . '" title="' . $text[269] . '">';

                                        if (($favteam > 0) && ($favteam == $teama[$st - 1][$i])) {
                                            echo '<b>';
                                        }

                                        echo $teams[$teama[$st - 1][$i]];

                                        if (($favteam > 0) && ($favteam == $teama[$st - 1][$i])) {
                                            echo '</b>';
                                        }

                                        echo '</a>'; ?>

                                        </nobr></td>
                                        <td class="lmost5" align="center" width="10">-</td>

                                        <?php
                                        if ((1 == $klfin) && ($st == $anzst)) {
                                            if (0 == $i) {
                                                if (2 == $m) {
                                                    echo '<td class="lmost9a"><nobr>';
                                                } elseif (1 == $m) {
                                                    echo '<td class="lmost9b"><nobr>';
                                                } else {
                                                    echo '<td class="lmost5"><nobr>';
                                                }
                                            } elseif (1 == $i) {
                                                if (2 == $m) {
                                                    echo '<td class="lmost9c"><nobr>';
                                                } else {
                                                    echo '<td class="lmost5"><nobr>';
                                                }
                                            }
                                        } else {
                                            if (2 == $m) {
                                                echo '<td class="lmost7"><nobr>';
                                            } else {
                                                echo '<td class="lmost5"><nobr>';
                                            }
                                        }

                                        echo '<a href="' . $addp . $teamb[$st - 1][$i] . '" title="' . $text[269] . '">';

                                        if (($favteam > 0) && ($favteam == $teamb[$st - 1][$i])) {
                                            echo '<b>';
                                        }

                                        echo $teams[$teamb[$st - 1][$i]];

                                        if (($favteam > 0) && ($favteam == $teamb[$st - 1][$i])) {
                                            echo '</b>';
                                        }

                                        echo '</a>'; ?>

                                        </nobr></td>
                                    <?php
                                    } else { ?>
                                        <td class="lmost5" colspan="3">&nbsp;</td>
                                    <?php } ?>
                                    <td class="lmost5" width="2">&nbsp;</td>
                                    <td class="lmost5" align="right"><?php echo $goala[$st - 1][$i][$n]; ?></td>
                                    <td class="lmost5" align="center" width="8">:</td>
                                    <td class="lmost5"><?php echo $goalb[$st - 1][$i][$n]; ?></td>
                                    <td class="lmost5" width="2">&nbsp;</td>
                                    <td class="lmost5"><?php echo $mspez[$st - 1][$i][$n]; ?></td>
                                    <td class="lmost5" width="2">&nbsp;</td>
                                    <td class="lmost5">

                                        <?php
                                        if (1 == $urlb) {
                                            if ('' != $mberi[$st - 1][$i][$n]) {
                                                echo '<a href="' . $mberi[$st - 1][$i][$n] . '" target="_blank" title="' . $text[270] . '"><img src="lmo-st1.gif" width="16" height="16" border="0"></a>';
                                            } else {
                                                echo '&nbsp;';
                                            }
                                        }

                                if ('' != $mnote[$st - 1][$i][$n]) {
                                    $dummy = addslashes($teams[$teama[$st - 1][$i]] . ' - ' . $teams[$teamb[$st - 1][$i]] . ' ' . $goala[$st - 1][$i][$n] . ':' . $goalb[$st - 1][$i][$n]) . ' ' . $mspez[$st - 1][$i][$n];

                                    if ('' != $mnote[$st - 1][$i][$n]) {
                                        $dummy .= '\\n\\n' . $text[22] . ':\\n' . $mnote[$st - 1][$i][$n];
                                    }

                                    echo "<a href=\"javascript:alert('" . $dummy . "');\" title=\"" . str_replace('\\n', '&#10;', $dummy) . '"><img src="lmo-st2.gif" width="16" height="16" border="0"></a>';
                                } else {
                                    echo '&nbsp;';
                                } ?>

                                    </td>
                                </tr>
                            <?php
                            }

                            if (($modus[$st - 1] > 1) && ($i < $anzsp - 1)) { ?>
                                <tr>
                                    <td class="lmost5" colspan="<?php echo $breite; ?>">&nbsp;</td>
                                </tr>
                            <?php }
                        }
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
        echo '<td class="lmost2"><a href="' . $addr . $st0 . '" title="' . $text[368] . '">' . $text[5] . '</a></td>';
    } ?>
                        <?php $st0 = $st + 1;

    if ($st < $anzst) {
        echo '<td align="right" class="lmost2"><a href="' . $addr . $st0 . '" title="' . $text[369] . '">' . $text[7] . '</a></td>';
    } ?>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

<?php
} ?>
