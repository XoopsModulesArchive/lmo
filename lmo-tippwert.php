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
if (0 == $endtab) {
    if (isset($anzst)) {
        $endtab = $anzst;
    }

    $tabdat = '';
} else {
    $tabdat = $endtab . '. ' . $text[2];
}

//  if($stwertmodus=="bis" ){$endtab=$anzst;}
if (1 == $all) {
    $endtab = 0;

    $tabdat = '';

    $anzst = 0;
} else {
    $st = $endtab;
}
if (!isset($wertung)) {
    $wertung = 'einzel';
}
if (!isset($gewicht)) {
    $gewicht = 'absolut';
}
if (!isset($stwertmodus)) {
    $stwertmodus = 'nur';
}
if (('' != $tabdat && 'nur' == $stwertmodus) || 1 == $all) {
    $showstsiege = 0;
}
if (!isset($anzseite1)) {
    $anzseite1 = 30;
}
if (!isset($von)) {
    $von = 1;
}
if (!isset($start)) {
    $start = 1;
}
if (!isset($eigpos)) {
    $eigpos = 1;
}
if ($anzseite1 < 1) {
    $anzseite1 = 30;
}

if ($endtab > 1 && '' != $tabdat && 'nur' != $stwertmodus) {
    $endtab--;

    if ('einzel' == $wertung || 'intern' == $wertung) {
        require 'lmo-tippcalcwert.php';
    } else {
        require 'lmo-tippcalcwertteam.php';
    }

    if ('team' == $wertung) {
        $anztipper = $teamsanzahl;
    }

    $platz1 = [''];

    $platz1 = array_pad($array, $anztipper + 1, '');

    for ($x = 0; $x < $anztipper; $x++) {
        $x3 = (int)mb_substr($tab0[$x], -7);

        $platz1[$x3] = $x + 1;
    }

    $endtab++;
}
if ('einzel' == $wertung || 'intern' == $wertung) {
    require 'lmo-tippcalcwert.php';
} else {
    require 'lmo-tippcalcwertteam.php';
}

if ('team' == $wertung) {
    $anztipper = $teamsanzahl;
}
$platz0 = [''];
if (!isset($anztipper)) {
    $anztipper = 0;
}
$platz0 = array_pad($array, $anztipper + 1, '');
for ($x = 0; $x < $anztipper; $x++) {
    $x3 = (int)mb_substr($tab0[$x], -7);

    $platz0[$x3] = $x + 1;
}
if ('' == $tabdat) {
    $addt1 = $PHP_SELF . '?action=tipp&amp;todo=wert&amp;all=' . $all . '&amp;file=' . $file . '&amp;PHPSESSID=' . $PHPSESSID . '&amp;gewicht=' . $gewicht . '&amp;wertung=';
} else {
    $addt1 = $PHP_SELF . '?action=tipp&amp;todo=wert&amp;stwertmodus=' . $stwertmodus . '&amp;PHPSESSID=' . $PHPSESSID . '&amp;file=' . $file . '&amp;gewicht=' . $gewicht . '&amp;endtab=' . $endtab . '&amp;wertung=';
}
$addt2 = $PHP_SELF . '?action=tipp&amp;todo=wert&amp;stwertmodus=' . $stwertmodus . '&amp;gewicht=' . $gewicht . '&amp;PHPSESSID=' . $PHPSESSID . '&amp;all=' . $all . '&amp;file=' . $file . '&amp;wertung=' . $wertung . '&amp;teamintern=' . str_replace(' ', '%20', $teamintern) . '&amp;endtab=';
if ('' == $tabdat) {
    $addt3 = $PHP_SELF . '?action=tipp&amp;todo=wert&amp;stwertmodus=' . $stwertmodus . '&amp;gewicht=' . $gewicht . '&amp;PHPSESSID=' . $PHPSESSID . '&amp;all=' . $all . '&amp;file=' . $file . '&amp;wertung=' . $wertung . '&amp;teamintern=' . str_replace(' ', '%20', $teamintern) . '&amp;start=';
} else {
    $addt3 = $PHP_SELF
             . '?action=tipp&amp;todo=wert&amp;stwertmodus='
             . $stwertmodus
             . '&amp;gewicht='
             . $gewicht
             . '&amp;PHPSESSID='
             . $PHPSESSID
             . '&amp;all='
             . $all
             . '&amp;file='
             . $file
             . '&amp;wertung='
             . $wertung
             . '&amp;teamintern='
             . str_replace(' ', '%20', $teamintern)
             . '&amp;endtab='
             . $endtab
             . '&amp;start=';
}
$addt4 = $PHP_SELF . '?action=tipp&amp;todo=wert&amp;gewicht=' . $gewicht . '&amp;file=' . $file . '&amp;endtab=' . $endtab . '&amp;PHPSESSID=' . $PHPSESSID . '&amp;wertung=' . $wertung . '&amp;teamintern=' . str_replace(' ', '%20', $teamintern) . '&amp;stwertmodus=';
if ('' == $tabdat) {
    $addt5 = $PHP_SELF . '?action=tipp&amp;todo=wert&amp;all=' . $all . '&amp;file=' . $file . '&amp;PHPSESSID=' . $PHPSESSID . '&amp;wertung=' . $wertung . '&amp;teamintern=' . str_replace(' ', '%20', $teamintern) . '&amp;gewicht=';
} else {
    $addt5 = $PHP_SELF . '?action=tipp&amp;todo=wert&amp;stwertmodus=' . $stwertmodus . '&amp;PHPSESSID=' . $PHPSESSID . '&amp;file=' . $file . '&amp;endtab=' . $endtab . '&amp;wertung=' . $wertung . '&amp;teamintern=' . str_replace(' ', '%20', $teamintern) . '&amp;gewicht=';
}

?>

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
    <?php if (1 != $all) { ?>
        <tr>
            <td align="center">
                <table cellspacing="0" cellpadding="0" border="0">
                    <tr>
                        <?php
                        echo '<td align="right" valign="top" class="lmost1" colspan="3" rowspan="4">';
                        echo $text[785] . ':'; // Spieltagswertung:
                        echo '&nbsp;</td>';
                        for ($i = 1; $i <= $anzst; $i++) {
                            echo '<td align="right" ';

                            if (1 == $lmtype) {
                                if ($i == $anzst) {
                                    $j = $text[364];
                                } elseif ($i == $anzst - 1) {
                                    $j = $text[362];
                                } elseif ($i == $anzst - 2) {
                                    $j = $text[360];
                                } elseif ($i == $anzst - 3) {
                                    $j = $text[358];
                                } else {
                                    $j = $i;
                                }
                            } else {
                                $j = $i;
                            }

                            if (($i != $endtab) || (($i == $endtab) && ('' == $tabdat))) {
                                echo 'class="lmost0"><a href="' . $addt2 . $i . '" title="' . $text[45] . '">' . $j . '</a>';
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
                        }
                        ?>
                    </tr>
                </table>
            </td>
        </tr>
    <?php } //if($all!=1)
    if ($tipperimteam >= 0) {
        ?>
        <tr>
            <td align="center">
                <table cellspacing="0" cellpadding="0" border="0">
                    <tr>
                        <?php
                        echo '<td ';

        if ('einzel' == $wertung) {
            echo 'class="lmost1">' . $text[561];
        } else {
            echo 'class="lmost0"><a href="' . $addt1 . 'einzel" title="' . $text[559] . '">' . $text[561] . '</a>';
        }

        echo '&nbsp;</td>';

        echo '<td ';

        if ('team' == $wertung) {
            echo 'class="lmost1">' . $text[562];
        } else {
            echo 'class="lmost0"><a href="' . $addt1 . 'team" title="' . $text[560] . '">' . $text[562] . '</a>';
        }

        echo '&nbsp;</td>';

        if ('' != $lmotipperverein || 'intern' == $wertung) {
            echo '<td ';

            if ('intern' == $wertung) {
                echo 'class="lmost1">' . $text[644];
            } else {
                echo 'class="lmost0"><a href="' . $addt1 . 'intern&amp;teamintern=' . str_replace(' ', '%20', $lmotipperverein) . '" title="' . $text[644] . '">' . $text[644] . '</a>';
            }

            echo '&nbsp;</td>';
        } ?>
                    </tr>
                </table>
            </td>
        </tr>
    <?php
    }
    if ('' != $tabdat) { ?>
        <tr>
            <td align="center">
                <table cellspacing="0" cellpadding="0" border="0">
                    <tr>
                        <?php
                        echo '<td ';
                        if ('nur' == $stwertmodus) {
                            echo 'class="lmost1">' . $text[702];
                        } else {
                            echo 'class="lmost0"><a href="' . $addt4 . 'nur" title="' . $text[702] . '">' . $text[702] . '</a>';
                        }
                        echo '&nbsp;</td>';
                        echo '<td ';
                        if ('bis' == $stwertmodus) {
                            echo 'class="lmost1">' . $text[703];
                        } else {
                            echo 'class="lmost0"><a href="' . $addt4 . 'bis" title="' . $text[703] . '">' . $text[703] . '</a>';
                        }
                        echo '&nbsp;</td>';
                        ?>
                    </tr>
                </table>
            </td>
        </tr>
    <?php }
    $dummy = ' align="right"';
    if ('intern' == $wertung) {
        $start = 1;

        $anzseite1 = $anztipper;
    }
    if ($anzseite1 > 0) {
        $anzseiten = $anztipper / $anzseite1;
    }
    if ($anzseiten > 1) { ?>
        <tr>
            <td align="center">
                <table cellspacing="0" cellpadding="0" border="0">
                    <tr>
                        <?php
                        echo '<td class="lmost1">' . $text[705] . '&nbsp;</td>';
                        for ($i = 0; $i < $anzseiten; $i++) {
                            $von = ($i * $anzseite1) + 1;

                            $bis = ($i + 1) * $anzseite1;

                            if ($bis > $anztipper) {
                                $bis = $anztipper;
                            }

                            if ($von != $start) {
                                echo '<td class="lmost0"><a href="' . $addt3 . $von . '">';
                            } else {
                                echo '<td class="lmost1">';
                            }

                            echo $von . '-' . $bis;

                            if ($von != $start) {
                                echo '</a>';
                            }

                            echo '&nbsp;</td>';
                        }
                        ?>
                    </tr>
                </table>
            </td>
        </tr>
    <?php } // ende if($anzseiten>1)?>

    <tr>
        <td align="center" class="lmost3">
            <table class="lmostb" cellspacing="0" cellpadding="0" border="0">
                <tr>
                    <td class="lmost4" colspan="3">
                        <?php
                        if (isset($lmtype) && 1 == $lmtype && '' != $tabdat) {
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
                            }

                            echo $j;
                        } else {
                            echo $tabdat;
                        }
                        ?>
                    </td>
                    <td class="lmost4" width="2">&nbsp;</td>

                    <?php
                    if ('einzel' == $wertung || 'intern' == $wertung) {
                        if ($tipperimteam >= 0) {
                            ?>
                            <td class="lmost4"><?php echo $text[527]; // Team
                                ?></td>
                            <td class="lmost4" width="2">&nbsp;</td>
                            <?php
                        }
                    } else { // Teamwertung
                        ?>
                        <td class="lmost4" align="right"><?php echo $text[526]; // Anzahl Tipper
                            ?></td>
                        <td class="lmost4" width="2">&nbsp;</td>
                        <td class="lmost4" align="right"><?php echo $text[526] . '&Oslash;'; // Anzahl Tipper Durchschnitt
                            ?></td>
                        <td class="lmost4" width="2">&nbsp;</td>
                    <?php } ?>
                    <td class="lmost4" <?php echo $dummy; ?>>
                        <?php if ('spiele' != $gewicht) {
                                echo '<a href="' . $addt5 . 'spiele">';
                            }
                        echo $text[623]; // Spiele getippt
                        if ('spiele' != $gewicht) {
                            echo '</a>';
                        }
                        ?></td>
                    <?php
                    if (1 == $showzus) {
                        if (1 == $tippmodus) {
                            if ($rergebnis > 0) { ?>
                                <td class="lmost4" width="2">&nbsp;</td>
                                <td class="lmost4" align="right"><?php echo $text[721]; // RE
                                    ?></td>
                            <?php }

                            if ($rtendenzdiff > $rtendenz) { ?>
                                <td class="lmost4" width="2">&nbsp;</td>
                                <td class="lmost4" align="right"><?php echo $text[722]; // RTD
                                    ?></td>
                            <?php }

                            if ($rtendenz > 0) { ?>
                                <td class="lmost4" width="2">&nbsp;</td>
                                <td class="lmost4" align="right"><?php echo $text[723]; // RT
                                    ?></td>
                            <?php }

                            if ($rtor > 0) { ?>
                                <td class="lmost4" width="2">&nbsp;</td>
                                <td class="lmost4" align="right"><?php echo $text[724]; // RG
                                    ?></td>
                            <?php }
                        } // ende if($tippmodus==1)
                        if ($rremis > 0) { ?>
                            <td class="lmost4" width="2">&nbsp;</td>
                            <td class="lmost4" align="right"><?php echo $text[725]; // UB
                                ?></td>
                        <?php }

                        if (1 == $jokertipp) { ?>
                            <td class="lmost4" width="2">&nbsp;</td>
                            <td class="lmost4" align="right"><?php echo $text[726]; // JP
                                ?></td>
                        <?php }
                    } // ende if($showzus==1)
                    if (1 == $showstsiege) { ?>
                        <td class="lmost4" width="2">&nbsp;</td>
                        <td class="lmost4" align="right"><?php echo $text[590]; // GS
                            ?></td>
                    <?php }
                    ?>
                    <td class="lmost4" width="2">&nbsp;</td>
                    <td class="lmost4" <?php echo $dummy; ?>>
                        <?php if ('relativ' != $gewicht) {
                        echo '<a href="' . $addt5 . 'relativ" title="' . $text[650] . '">';
                    }
                        if (1 == $tippmodus) {
                            echo $text[623] . '&Oslash;';
                        } else {
                            echo $text[623] . '&#37;';
                        }
                        if ('relativ' != $gewicht) {
                            echo '</a>';
                        }
                        ?></td>
                    <td class="lmost4" width="2">&nbsp;</td>
                    <td class="lmost4" <?php echo $dummy; ?>>
                        <?php if ('absolut' != $gewicht) {
                            echo '<a href="' . $addt5 . 'absolut" title="' . $text[649] . '">';
                        }
                        if (1 == $tippmodus) {
                            echo $text[37];
                        } else {
                            echo $text[622];
                        }
                        if ('absolut' != $gewicht) {
                            echo '</a>';
                        }
                        ?></td>

                </tr>

                <?php
                $eigplatz = $anztipper + 2;
                $j = 1;
                $ende = $start + $anzseite1 - 1;
                if ($ende > $anztipper) {
                    $ende = $anztipper;
                }
                if (!isset($lx)) {
                    $lx = 1;
                }
                if (!isset($lax)) {
                    $lax = 0;
                }
                if ($anztipper > 0) {
                    $laeng = mb_strlen($tab0[0]);
                }
                for ($x = 1; $x <= $anztipper; $x++) {
                    $i = (int)mb_substr($tab0[$x - 1], -7);

                    if (($x >= $start && $x <= $ende) || $i == $eigpos) {
                        $poswechs = 1;

                        if ($x > 1) {
                            for ($k = 0; $k <= $laeng - 24; $k += 8) {
                                if ((int)mb_substr($tab0[$x - 1], $k + 1, 7) != (int)mb_substr($tab0[$x - 2], $k + 1, 7)) {
                                    break;
                                }

                                if ($k == $laeng - 24) {
                                    $poswechs = 0;
                                }
                            }
                        }

                        if (1 == $x || 1 == $poswechs) {
                            $lx = $x;
                        }

                        if ('intern' != $wertung || $teamintern == $tipperteam[$i]) {
                            if ($lx == $x) {
                                $lax = $x;
                            }

                            if ($i == $eigpos) {
                                $eigplatz = $x;
                            }

                            if (($x == $start && $eigplatz < $x - 1) || ($x == $eigplatz && $x > $ende + 1)) {
                                ?>
                                <tr>
                                    <td class="lmost5" align="right">...
                                    </td>
                                </tr>
                                <?php
                            }

                            if ((('einzel' == $wertung || 'intern' == $wertung) && $lmotippername == $tippernick[$i]) || ('team' == $wertung && $lmotipperverein == $team[$i])) {
                                $dummy = '<strong>';

                                $dumm2 = '</strong>';
                            } else {
                                $dummy = '';

                                $dumm2 = '';
                            }

                            $dumm1 = 'lmost5';

                            if ((('intern' != $wertung && 1 == $lax) || ('intern' == $wertung && 1 == $lx)) && $tipppunktegesamt[$i] > 0) {
                                $dumm1 = 'lmost9a';
                            }

                            if ((('intern' != $wertung && 2 == $lax) || ('intern' == $wertung && 2 == $lx)) && $tipppunktegesamt[$i] > 0) {
                                $dumm1 = 'lmost9b';
                            }

                            if ((('intern' != $wertung && 3 == $lax) || ('intern' == $wertung && 3 == $lx)) && $tipppunktegesamt[$i] > 0) {
                                $dumm1 = 'lmost9c';
                            }

                            if ('team' == $wertung || '' != $tippernick[$i]) {
                                ?>
                                <tr>
                                <td class="<?php echo $dumm1; ?>" align="right">
                                    <?php
                                    if ($lax == $x) {
                                        echo $dummy . $x . $dumm2;
                                    } elseif ('intern' == $wertung && $lax != $lx) {
                                        echo $dummy . $lx . $dumm2;

                                        $lax = $lx;
                                    } else {
                                        echo '&nbsp;';
                                    } ?>
                                </td>
                                <?php
                                $y = 0;

                                if (($endtab > 1) && ('' != $tabdat) && $tipppunktegesamt[(int)mb_substr($tab0[0], -7)] > 0 && 'nur' != $stwertmodus) {
                                    if ($platz0[$i] < $platz1[$i]) {
                                        $y = 1;
                                    } elseif ($platz0[$i] > $platz1[$i]) {
                                        $y = 2;
                                    }
                                }

                                if ('' != $tabdat && 'nur' != $stwertmodus) {
                                    echo '<td class="' . $dumm1 . '"';

                                    echo '><img src="lmo-tab' . $y . '.gif" width="9" height="9" border="0">';

                                    echo '</td>';
                                } else {
                                    echo '<td class="' . $dumm1 . '">&nbsp;</td>';
                                } ?>
                                <?php
                                if ('einzel' == $wertung || 'intern' == $wertung) {
                                    ?>
                                    <td class="<?php echo $dumm1; ?>">
                                        <nobr>
                                            <?php
                                            echo $dummy;

                                    if (1 == $showname) {
                                        if (1 == $showemail) {
                                            echo '<a href=mailto:' . $tipperemail[$i] . '>';
                                        }

                                        echo $tippername[$i];

                                        if (1 == $showemail) {
                                            echo '</a>';
                                        }
                                    }

                                    if (1 == $shownick || (0 == $showemail && 0 == $showname)) {
                                        if (1 == $showname) {
                                            echo ' (';
                                        }

                                        if (0 == $showname && 1 == $showemail) {
                                            echo '<a href=mailto:' . $tipperemail[$i] . '>';
                                        }

                                        echo $tippernick[$i];

                                        if (0 == $showname && 1 == $showemail) {
                                            echo '</a>';
                                        }

                                        if (1 == $showname) {
                                            echo ')';
                                        }
                                    } elseif (1 == $showemail && 0 == $showname) {
                                        echo '<a href=mailto:' . $tipperemail[$i] . '>' . $tipperemail[$i] . '</a>';
                                    }

                                    echo $dumm2; ?>
                                        </nobr>
                                    </td>
                                    <?php
                                } else {
                                    ?>
                                    <td class="<?php echo $dumm1; ?>"><?php if ('intern' != $wertung && ' ' != $team[$i]) {
                                        echo '<a href="' . $addt1 . 'intern&amp;teamintern=' . str_replace(' ', '%20', $team[$i]) . '" title="' . $text[644] . '">';
                                    }

                                    echo $dummy . $team[$i] . $dumm2;

                                    if ('intern' != $wertung && ' ' != $team[$i]) {
                                        echo '</a>';
                                    } ?></td>
                                    <?php
                                }

                                if ($tipperimteam >= 0) {
                                    if ('einzel' == $wertung || 'intern' == $wertung) {
                                        if ('' == $tipperteam[$i]) {
                                            $tipperteam[$i] = '&nbsp;';
                                        } ?>
                                        <td class="<?php echo $dumm1; ?>" width="2">&nbsp;</td>
                                        <td class="<?php echo $dumm1; ?>">
                                            <nobr><?php if ('intern' != $wertung && '&nbsp;' != $tipperteam[$i]) {
                                            echo '<a href="' . $addt1 . 'intern&amp;teamintern=' . str_replace(' ', '%20', $tipperteam[$i]) . '" title="' . $text[644] . '">';
                                        }

                                        echo $dummy . $tipperteam[$i] . $dumm2;

                                        if ('intern' != $wertung && '&nbsp;' != $tipperteam[$i]) {
                                            echo '</a>';
                                        } ?></nobr>
                                        </td>
                                        <?php
                                    } else {
                                        ?>
                                        <td class="<?php echo $dumm1; ?>" width="2">&nbsp;</td>
                                        <td class="<?php echo $dumm1; ?>" align="right"><?php echo $dummy . $tipperimteam[$i] . $dumm2; ?></td>
                                        <td class="<?php echo $dumm1; ?>" width="2">&nbsp;</td>
                                        <td class="<?php echo $dumm1; ?>" align="right"><?php echo $dummy . number_format($tipppunktegesamt[$i] / $tipperimteam[$i], 2, '.', ',') . $dumm2; ?></td>
                                    <?php
                                    }
                                }

                                echo '<td class="' . $dumm1 . '" width="2">&nbsp;</td><td class="' . $dumm1 . '" align="right">';

                                if ('spiele' == $gewicht) {
                                    echo '<strong>';
                                } else {
                                    echo $dummy;
                                }

                                echo $spielegetipptgesamt[$i];

                                if ('spiele' == $gewicht) {
                                    echo '</strong>';
                                } else {
                                    echo $dumm2;
                                }

                                echo '</td>';

                                if (1 == $showzus) {
                                    if (1 == $tippmodus) {
                                        if ($rergebnis > 0) {
                                            if ('' == $punkte1gesamt[$i]) {
                                                $punkte1gesamt[$i] = '&nbsp;';
                                            } ?>
                                            <td class="<?php echo $dumm1; ?>" width="2">&nbsp;</td>
                                            <td class="<?php echo $dumm1; ?>" align="right"><?php echo $dummy . $punkte1gesamt[$i] . $dumm2; ?></td>
                                        <?php
                                        }

                                        if ($rtendenzdiff > $rtendenz) {
                                            if ('' == $punkte2gesamt[$i]) {
                                                $punkte2gesamt[$i] = '&nbsp;';
                                            } ?>
                                            <td class="<?php echo $dumm1; ?>" width="2">&nbsp;</td>
                                            <td class="<?php echo $dumm1; ?>" align="right"><?php echo $dummy . $punkte2gesamt[$i] . $dumm2; ?></td>
                                        <?php
                                        } else {
                                            $punkte3gesamt[$i] += $punkte2gesamt[$i];
                                        }

                                        if ($rtendenz > 0) {
                                            if ('' == $punkte3gesamt[$i]) {
                                                $punkte3gesamt[$i] = '&nbsp;';
                                            } ?>
                                            <td class="<?php echo $dumm1; ?>" width="2">&nbsp;</td>
                                            <td class="<?php echo $dumm1; ?>" align="right"><?php echo $dummy . $punkte3gesamt[$i] . $dumm2; ?></td>
                                        <?php
                                        }

                                        if ($rtor > 0) {
                                            if ('' == $punkte4gesamt[$i]) {
                                                $punkte4gesamt[$i] = '&nbsp;';
                                            } ?>
                                            <td class="<?php echo $dumm1; ?>" width="2">&nbsp;</td>
                                            <td class="<?php echo $dumm1; ?>" align="right"><?php echo $dummy . $punkte4gesamt[$i] . $dumm2; ?></td>
                                        <?php
                                        }
                                    } // ende if($tippmodus==1)

                                    if ($rremis > 0) {
                                        if ('' == $punkte5gesamt[$i]) {
                                            $punkte5gesamt[$i] = '&nbsp;';
                                        } ?>
                                        <td class="<?php echo $dumm1; ?>" width="2">&nbsp;</td>
                                        <td class="<?php echo $dumm1; ?>" align="right"><?php echo $dummy . $punkte5gesamt[$i] . $dumm2; ?></td>
                                    <?php
                                    }

                                    if (1 == $jokertipp) {
                                        if ('' == $punkte6gesamt[$i]) {
                                            $punkte6gesamt[$i] = '&nbsp;';
                                        } ?>
                                        <td class="<?php echo $dumm1; ?>" width="2">&nbsp;</td>
                                        <td class="<?php echo $dumm1; ?>" align="right"><?php echo $dummy . $punkte6gesamt[$i] . $dumm2; ?></td>
                                    <?php
                                    }
                                } // ende if($showzus==1)

                                if (1 == $showstsiege) {
                                    if ('' == $stsiege[$i]) {
                                        $stsiege[$i] = '&nbsp;';
                                    } ?>
                                    <td class="<?php echo $dumm1; ?>" width="2">&nbsp;</td>
                                    <td class="<?php echo $dumm1; ?>" align="right"><?php echo $dummy . $stsiege[$i] . $dumm2; ?></td>
                                <?php
                                }

                                $quotegesamt[$i] = number_format($quotegesamt[$i] / 100, 2, '.', ',');

                                echo '<td class="' . $dumm1 . '" width="2">&nbsp;</td><td class="' . $dumm1 . '" align="right">';

                                if ('relativ' == $gewicht) {
                                    echo '<strong>';
                                } else {
                                    echo $dummy;
                                }

                                echo $quotegesamt[$i];

                                if ('relativ' == $gewicht) {
                                    echo '</strong>';
                                } else {
                                    echo $dumm2;
                                }

                                echo '</td>';

                                echo '<td class="' . $dumm1 . '" width="2">&nbsp;</td><td class="' . $dumm1 . '" align="right">';

                                if ('absolut' == $gewicht) {
                                    echo '<strong>';
                                } else {
                                    echo $dummy;
                                }

                                echo $tipppunktegesamt[$i];

                                if ('absolut' == $gewicht) {
                                    echo '</strong>';
                                } else {
                                    echo $dumm2;
                                }

                                echo '</td>';
                            } // ende if($wertung!="intern" || $teamintern==$tipperteam[$i])

                            ?>
                            </tr>
                            <?php
                        } // ende   if($wertung=="team" || $tippernick[$i]!="")
                    } // ende   if(($x>=$start && $x<=$ende) || $i==$eigpos)
                } // ende for($x=1;$x<=$anztipper;$x++)
                ?>

            </table>
        </td>
    </tr>
    <?php if ($anzseiten > 1) { ?>
        <tr>
            <td align="center">
                <table cellspacing="0" cellpadding="0" border="0">
                    <tr>
                        <?php
                        echo '<td class="lmost1">' . $text[705] . '&nbsp;</td>';
                        for ($i = 0; $i < $anzseiten; $i++) {
                            $von = ($i * $anzseite1) + 1;

                            $bis = ($i + 1) * $anzseite1;

                            if ($bis > $anztipper) {
                                $bis = $anztipper;
                            }

                            if ($von != $start) {
                                echo '<td class="lmost0"><a href="' . $addt3 . $von . '">';
                            } else {
                                echo '<td class="lmost1">';
                            }

                            echo $von . '-' . $bis;

                            if ($von != $start) {
                                echo '</a>';
                            }

                            echo '&nbsp;</td>';
                        }
                        ?>
                    </tr>
                </table>
            </td>
        </tr>
    <?php } // ende if($anzseiten>1)

    if ('' != $tabdat) { ?>
        <tr>
            <td>
                <table width="100%" cellspacing="0" cellpadding="0" border="0">
                    <tr>
                        <?php $st0 = $endtab - 1;
                        if ($endtab > 1) {
                            echo '<td class="lmost2" align="left">&nbsp;<a href="' . $addt2 . $st0 . '" title="' . $text[43] . "\"><img src=\"./images/left.gif\" width='9' height='9' border=\"0\"></a></td>";
                        } ?>
                        <?php $st0 = $endtab + 1;
                        if ($endtab < $anzst) {
                            echo '<td align="right" class="lmost2"><a href="' . $addt2 . $st0 . '" title="' . $text[44] . "\"><img src=\"./images/right.gif\" width='9' height='9' border=\"0\"></a>&nbsp;</td>";
                        } ?>
                    </tr>
                </table>
            </td>
        </tr>
    <?php } ?>
</table>
