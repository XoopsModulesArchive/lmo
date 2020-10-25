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
// Jocker-Hack 001
// Copyright (C) 2002 by Ufuk Altinkaynak
// ufuk.a@arcor.de
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

if ('' != $file && 'einsicht' == $todo && 1 == $tippeinsicht) {
    $showzus = 0;

    require_once 'lmo-tippcalcpkt.php';

    require_once 'lmo-tippaenderbar.php';

    if (!isset($st) || '' == $st || 0 == $st) {
        $st = $stx;
    }

    require 'lmo-tippcalceinsicht.php';

    if (!isset($anzseite)) {
        $anzseite = 20;
    }

    if (!isset($anztipper)) {
        $anztipper = 0;
    }

    if (!isset($von)) {
        $von = 0;
    }

    if (!isset($start)) {
        $start = 0;
    }

    if ($start >= $anztipper) {
        $start = 0;
    }

    if ($anzseite < 1) {
        $anzseite = 20;
    } ?>

    <table class="lmosta" cellspacing="0" cellpadding="0" border="0">
        <tr>
            <td align="center" class="lmost1">
                <font color=black><?php if (5 == $HTTP_SESSION_VARS['lmotipperok']) {
        echo $lmotippername;

        if ('' != $lmotipperverein) {
            echo ' - ' . $lmotipperverein;
        }
    } else {
        echo $text[658];
    } ?></font>
            </td>
        </tr>
        <?php if (1 == $einsichterst) { ?>
            <tr>
            <td class="lmost4" align="center"><?php echo $text[720] . ' ' . $text[716]; ?></td></tr><?php } ?>
        <?php if (2 == $einsichterst) { ?>
            <tr>
            <td class="lmost4" align="center"><?php echo $text[720] . ' ' . $text[717]; ?></td></tr><?php } ?>
        <tr>
            <td align="center">
                <table cellspacing="0" cellpadding="0" border="0">
                    <tr>
                        <?php
                        $addr = $PHP_SELF . '?action=tipp&amp;todo=einsicht&amp;file=' . $file . '&amp;PHPSESSID=' . $PHPSESSID . '&amp;start=' . $start . '&amp;st=';

    $addt = $PHP_SELF . '?action=tipp&amp;todo=tabelle&amp;file=' . $file . '&amp;PHPSESSID=' . $PHPSESSID . '&amp;endtab=&amp;nick=';

    $addt3 = $PHP_SELF . '?action=tipp&amp;todo=einsicht&amp;file=' . $file . '&amp;PHPSESSID=' . $PHPSESSID . '&amp;st=' . $st . '&amp;start=';

    echo '<td align="right" valign="top" class="lmost1" colspan="3" rowspan="4">';

    if (1 == $lmtype) {
        echo $text[370];
    } else {
        echo $text[2];
    }

    echo ':';

    echo '&nbsp;</td>';

    for ($i = 1; $i <= $anzst; $i++) {
        if (1 == $lmtype) {
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
        } else {
            $j = $i;

            $k = $text[9];
        }

        echo '<td align="right" ';

        if ($i != $st) {
            echo 'class="lmost0"><a href="' . $addr . $i . '" title="' . $k . '">' . $j . '</a>';
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
        } elseif (($anzst > 25) && (0 == ($anzst % 2))) {
            if ($i == $anzst / 2) {
                echo '</tr><tr>';
            }
        }
    } ?>
                    </tr>
                </table>
            </td>
        </tr>
        <?php $anzseiten = $anztipper / $anzseite;

    if ($anzseiten > 1) {
        ?>
            <tr>
                <td align="center">
                    <table cellspacing="0" cellpadding="0" border="0">
                        <tr>
                            <?php
                            echo '<td align="right" valign="top" class="lmost1" rowspan="' . (floor($anzseiten / 10) + 1) . '">' . $text[664] . '&nbsp;</td>';

        for ($i = 0; $i < $anzseiten; $i++) {
            $von = $i * $anzseite;

            $bis = ($i + 1) * $anzseite - 1;

            if ($bis >= $anztipper) {
                $bis = $anztipper - 1;
            }

            if ($von != $start) {
                echo '<td class="lmost0"><nobr><a href="' . $addt3 . $von . '">';
            } else {
                echo '<td class="lmost1"><nobr>';
            }

            $k1 = mb_strtolower(mb_substr($tippernick[(int)mb_substr($tab0[$von], -6)], 0, 3));

            $k2 = mb_strtolower(mb_substr($tippernick[(int)mb_substr($tab0[$bis], -6)], 0, 3));

            echo $k1 . '-' . $k2;

            if ($von != $start) {
                echo '</a>';
            }

            echo '&nbsp;</nobr></td>';

            if (0 == ($i + 1) % 10) {
                echo '</tr><tr>';
            }
        } ?>
                        </tr>
                    </table>
                </td>
            </tr>
        <?php
    } // ende if($anzseiten>1)?>
        <tr>
            <td align="center" class="lmost3">
                <table class="lmostb" cellspacing="0" cellpadding="0" border="0">
                    <?php
                    $tab1 = [''];

    $nw = 0;

    $ende = $start + $anzseite;

    if ($ende > $anztipper) {
        $ende = $anztipper;
    }

    if (!isset($tab0)) {
        $tab0 = [''];
    }

    //if($anztipper<1){exit;}

    for ($l = $start - 1; $l <= ($ende + 2); $l++) {
        if ($l >= $start && $l < $ende) {
            $k = (int)mb_substr($tab0[$l], -6);
        }

        if (0 == $lmtype) {
            $anzmodus = 1;
        } else {
            $anzmodus = $modus[$st - 1];
        } ?>
                        <tr>
                            <td align="right" class="lmocross4">
                                <?php
                                if ($l >= $start && $l < $ende) {
                                    echo '<nobr>' . $tippernick[$k] . '</nobr>';
                                } // Nickname links

        elseif ($l == $ende && $anztipper > 0) {
            echo '<nobr>' . $text[688] . '</nobr>';
        } // Tipptendenz

        elseif ($l == ($ende + 1) && $anztipper > 0 && 1 == $tippmodus) {
            echo '<nobr>' . '&Oslash;-' . $text[530] . '</nobr>';
        } // Durchschnittstipp?>
                            </td>
                            <?php
                            $punktetipper = 0;

        for ($i = 0; $i < $anzsp; $i++) {
            if ($teama[$st - 1][$i] > 0 && $teamb[$st - 1][$i] > 0) {
                for ($n = 0; $n < $anzmodus; $n++) {
                    if ($l == $start) {
                        if (1 == $einsichterst) {
                            $plus = 0;

                            if (0 == $lmtype) {
                                $btip[$i] = tippaenderbar($mterm[$st - 1][$i], $datum1[$st - 1], $datum2[$st - 1]);
                            } else {
                                $btip[$i][$n] = tippaenderbar($mterm[$st - 1][$i][$n], $datum1[$st - 1], $datum2[$st - 1]);
                            }
                        } elseif (2 == $einsichterst) {
                            if (0 != $lmtype) {
                                if ('_' != $goala[$st - 1][$i][$n] && '_' != $goalb[$st - 1][$i][$n]) {
                                    $btip[$i][$n] = false;
                                } else {
                                    $btip[$i][$n] = true;
                                }
                            } else {
                                if ('_' != $goala[$st - 1][$i] && '_' != $goalb[$st - 1][$i]) {
                                    $btip[$i] = false;
                                } else {
                                    $btip[$i] = true;
                                }
                            }
                        } else { // Tipps immer anzeigen
                            if (0 != $lmtype) {
                                $btip[$i][$n] = false;
                            } else {
                                $btip[$i] = false;
                            }
                        }
                    }

                    if ($l == ($start - 1) || $l == ($ende + 2)) {
                        ?>
                                            <td align="center" valign="center" class="lmocross4">
                                                <nobr>
                                                    <?php
                                                    if (0 == $n) {
                                                        echo $teamk[$teama[$st - 1][$i]] . '<br>';
                                                    }

                        if (0 != $lmtype) {
                            echo $goala[$st - 1][$i][$n] . ':' . $goalb[$st - 1][$i][$n];

                            if (1 == $mtipp[$st - 1][$i][$n]) {
                                echo $text[730];

                                $nw = 1;
                            }
                        } else {
                            echo $goala[$st - 1][$i] . ':' . $goalb[$st - 1][$i];

                            if (1 == $mtipp[$st - 1][$i]) {
                                echo $text[730];

                                $nw = 1;
                            }
                        }

                        if (0 == $n) {
                            echo '<br>' . $teamk[$teamb[$st - 1][$i]];
                        } ?>
                                                </nobr>
                                            </td>
                                            <?php
                    } elseif ($l < $ende) {
                        if ((0 == $lmtype && true === $btip[$i]) || (0 != $lmtype && true === $btip[$i][$n])) { ?>
                                                <td align="center" class="lmocross5">
                                                <?php
                                            } else {
                                                if (0 != $lmtype) {
                                                    if (-1 == $tippa[$k][$i][$n]) {
                                                        $tippa[$k][$i][$n] = '_';
                                                    }

                                                    if (-1 == $tippb[$k][$i][$n]) {
                                                        $tippb[$k][$i][$n] = '_';
                                                    }
                                                } else {
                                                    if (-1 == $tippa[$k][$i]) {
                                                        $tippa[$k][$i] = '_';
                                                    }

                                                    if (-1 == $tippb[$k][$i]) {
                                                        $tippb[$k][$i] = '_';
                                                    }
                                                }

                                                $punktespiel = -1;

                                                if (0 != $lmtype) {
                                                    if ('_' != $tippa[$k][$i][$n]) {
                                                        if (1 == $jokertipp && $jksp2[$k] == ($i + 1) . ($n + 1)) {
                                                            $jkspfaktor = $jokertippmulti;
                                                        } else {
                                                            $jkspfaktor = 1;
                                                        }

                                                        if ('_' != $goala[$st - 1][$i][$n]) {
                                                            $punktespiel = tipppunkte($tippa[$k][$i][$n], $tippb[$k][$i][$n], $goala[$st - 1][$i][$n], $goalb[$st - 1][$i][$n], 0, $mspez[$st - 1][$i][$n], $text[0], $text[1], $jkspfaktor, $mtipp[$st - 1][$i][$n]);
                                                        }
                                                    } else {
                                                        $jkspfaktor = 1;
                                                    }
                                                } else {
                                                    if ('_' != $tippa[$k][$i]) {
                                                        if (1 == $jokertipp && $jksp2[$k] == $i + 1) {
                                                            $jkspfaktor = $jokertippmulti;
                                                        } else {
                                                            $jkspfaktor = 1;
                                                        }

                                                        if ('_' != $goala[$st - 1][$i]) {
                                                            $punktespiel = tipppunkte($tippa[$k][$i], $tippb[$k][$i], $goala[$st - 1][$i], $goalb[$st - 1][$i], $msieg[$st - 1][$i], $mspez[$st - 1][$i], $text[0], $text[1], $jkspfaktor, $mtipp[$st - 1][$i]);
                                                        }
                                                    } else {
                                                        $jkspfaktor = 1;
                                                    }
                                                }

                                                if (1 == $tippmodus) { // Ergebnis-Tippmodus
                                                    if ($punktespiel > $rtor * $jkspfaktor) { ?>
                                                        <td align="center" class="lmost7">
                                                        <?php
                                                    } else { ?>
                                                        <td align="center" class="lmocross5">
                                                        <?php
                                                    }

                                                    echo '<nobr>';

                                                    $dummy1 = '';

                                                    $dummy2 = '';

                                                    $dummy3 = '';

                                                    $dummy4 = '';

                                                    if ($punktespiel == $rergebnis * $jkspfaktor || $punktespiel == ($rergebnis + $rremis) * $jkspfaktor) {
                                                        $dummy1 = '<b>';

                                                        $dummy4 = '</b>';
                                                    } elseif ($punktespiel == $rtendenzdiff * $jkspfaktor || $punktespiel == ($rtendenzdiff + $rremis) * $jkspfaktor) {
                                                        $dummy2 = '<b>';

                                                        $dummy3 = '</b>';
                                                    }

                                                    if ($jkspfaktor > 1) {
                                                        echo '<font color=red>';
                                                    }

                                                    if (0 != $lmtype) {
                                                        if ($rtor > 0 && ($punktespiel == $rtor * $jkspfaktor || $punktespiel == ($rtendenz + $rtor) * $jkspfaktor)) {
                                                            if ($goala[$st - 1][$i][$n] == $tippa[$k][$i][$n]) {
                                                                $dummy1 = '<b>';

                                                                $dummy2 = '</b>';
                                                            } elseif ($goalb[$st - 1][$i][$n] == $tippb[$k][$i][$n]) {
                                                                $dummy3 = '<b>';

                                                                $dummy4 = '</b>';
                                                            }
                                                        }

                                                        echo $dummy1 . $tippa[$k][$i][$n] . $dummy2 . ':' . $dummy3 . $tippb[$k][$i][$n] . $dummy4;
                                                    } else {
                                                        if ($rtor > 0 && ($punktespiel == $rtor * $jkspfaktor || $punktespiel == ($rtendenz + $rtor) * $jkspfaktor)) {
                                                            if ($goala[$st - 1][$i] == $tippa[$k][$i]) {
                                                                $dummy1 = '<b>';

                                                                $dummy2 = '</b>';
                                                            } elseif ($goalb[$st - 1][$i] == $tippb[$k][$i]) {
                                                                $dummy3 = '<b>';

                                                                $dummy4 = '</b>';
                                                            }
                                                        }

                                                        echo $dummy1 . $tippa[$k][$i] . $dummy2 . ':' . $dummy3 . $tippb[$k][$i] . $dummy4;
                                                    }

                                                    if ($jkspfaktor > 1) {
                                                        echo '</font>';
                                                    }

                                                    echo ' <small>';

                                                    if ($punktespiel >= 0) {
                                                        echo $punktespiel;
                                                    } else {
                                                        echo '&nbsp;';
                                                    }

                                                    echo '</small></nobr>';
                                                } else { // Tendenz-Modus
                                                    if ($punktespiel > 0) { ?>
                                                        <td align="center" class="lmost7">
                                                        <?php
                                                    } else { ?>
                                                        <td align="center" class="lmocross5">
                                                        <?php
                                                    }

                                                    if ($jkspfaktor > 1) {
                                                        echo '<font color=red>';
                                                    }

                                                    if (0 != $lmtype) {
                                                        if ('_' == $tippa[$k][$i][$n] || '_' == $tippb[$k][$i][$n]) {
                                                            echo '_';
                                                        } elseif ($tippa[$k][$i][$n] == $tippb[$k][$i][$n]) {
                                                            echo '0';
                                                        } elseif ($tippa[$k][$i][$n] > $tippb[$k][$i][$n]) {
                                                            echo '1';
                                                        } elseif ($tippa[$k][$i][$n] < $tippb[$k][$i][$n]) {
                                                            echo '2';
                                                        }
                                                    } else {
                                                        if ('_' == $tippa[$k][$i] || '_' == $tippb[$k][$i]) {
                                                            echo '_';
                                                        } elseif ($tippa[$k][$i] == $tippb[$k][$i]) {
                                                            echo '0';
                                                        } elseif ($tippa[$k][$i] > $tippb[$k][$i]) {
                                                            echo '1';
                                                        } elseif ($tippa[$k][$i] < $tippb[$k][$i]) {
                                                            echo '2';
                                                        }
                                                    }

                                                    if ($jkspfaktor > 1) {
                                                        echo '</font>';
                                                    }
                                                }

                                                if ($punktespiel > 0) {
                                                    $punktetipper += $punktespiel;
                                                }
                                            } ?>
                                            </td>
                                            <?php
                    } elseif ($l == $ende) {
                        ?>
                                            <td align="center" class="lmocross4">
                                                <nobr>
                                                    <?php
                                                    if ($anztipper > 0) {
                                                        if (0 == $lmtype && false === $btip[$i]) {
                                                            echo $tendenz1[$i] . '-' . $tendenz0[$i] . '-' . $tendenz2[$i];
                                                        } elseif (0 != $lmtype && false === $btip[$i][$n]) {
                                                            echo $tendenz1[$i][$n] . '-' . $tendenz0[$i][$n] . '-' . $tendenz2[$i][$n];
                                                        }
                                                    } ?>
                                                </nobr>
                                            </td>
                                            <?php
                    } elseif ($l == ($ende + 1)) {
                        ?>
                                            <td align="center" class="lmocross4">
                                                <nobr>
                                                    <?php
                                                    if ($anztipper > 0 && 1 == $tippmodus) {
                                                        if (0 == $lmtype && false === $btip[$i]) {
                                                            if ($anzgetippt[$i] > 0) {
                                                                if ($toregesa[$i] < 10 && $toregesb[$i] < 10) {
                                                                    $nachkomma = 1;
                                                                } else {
                                                                    $nachkomma = 0;
                                                                }

                                                                echo number_format(($toregesa[$i] / $anzgetippt[$i]), $nachkomma, '.', ',') . ':' . number_format(($toregesb[$i] / $anzgetippt[$i]), $nachkomma, '.', ',');
                                                            }
                                                        } elseif (0 != $lmtype && false === $btip[$i][$n]) {
                                                            if ($anzgetippt[$i][$n] > 0) {
                                                                if ($toregesa[$i][$n] < 10 && $toregesb[$i][$n] < 10) {
                                                                    $nachkomma = 1;
                                                                } else {
                                                                    $nachkomma = 0;
                                                                }

                                                                echo number_format(($toregesa[$i][$n] / $anzgetippt[$i][$n]), $nachkomma, '.', ',') . ':' . number_format(($toregesb[$i][$n] / $anzgetippt[$i][$n]), $nachkomma, '.', ',');
                                                            }
                                                        }
                                                    } ?>
                                                </nobr>
                                            </td>
                                            <?php
                    }
                } // ende for($n=0;$n<$anzmodus;$n++)
            }
        } // ende for($i=0;$i<$anzsp;$i++)?>
                            <td class="lmocross4">
                                <nobr>
                                    <?php if ($l >= $start && $l < $ende) {
            echo '= ' . $punktetipper . ' ' . $text[37];
        } ?>
                                </nobr>
                            </td>
                            <td class="lmocross4">
                                <nobr>
                                    <?php if (1 == $tipptabelle1 && $l >= $start && $l < $ende && 0 == $lmtype) {
            echo '<a href="' . $addt . htmlentities($tippernick[$k], ENT_QUOTES | ENT_HTML5) . '" title="' . $text[681] . ' ' . $tippernick[$k] . '">' . $text[672] . '</a>';
        } ?>
                                </nobr>
                            </td>
                        </tr>
                        <?php
    } // ende for($l=$start-1;$l<=$ende;$l++)?>
                </table>
            </td>
        </tr>
        <?php
        if ($anzseiten > 1 && $anzseiten < 11) {
            ?>
            <tr>
                <td align="center">
                    <table cellspacing="0" cellpadding="0" border="0">
                        <tr>
                            <?php
                            echo '<td align="right" valign="top" class="lmost1" rowspan="' . (floor($anzseiten / 10) + 1) . '">' . $text[664] . '&nbsp;</td>';

            for ($i = 0; $i < $anzseiten; $i++) {
                $von = $i * $anzseite;

                $bis = ($i + 1) * $anzseite - 1;

                if ($bis >= $anztipper) {
                    $bis = $anztipper - 1;
                }

                if ($von != $start) {
                    echo '<td class="lmost0"><nobr><a href="' . $addt3 . $von . '">';
                } else {
                    echo '<td class="lmost1"><nobr>';
                }

                $k1 = mb_strtolower(mb_substr($tippernick[(int)mb_substr($tab0[$von], -6)], 0, 3));

                $k2 = mb_strtolower(mb_substr($tippernick[(int)mb_substr($tab0[$bis], -6)], 0, 3));

                echo $k1 . '-' . $k2;

                if ($von != $start) {
                    echo '</a>';
                }

                echo '&nbsp;</nobr></td>';

                if (0 == ($i + 1) % 10) {
                    echo '</tr><tr>';
                }
            } ?>
                        </tr>
                    </table>
                </td>
            </tr>
        <?php
        } // ende if($anzseiten>1)
        ?>
    </table>
    <?php
} // ende if(($file!="") && ($todo=="einsicht"))?>
