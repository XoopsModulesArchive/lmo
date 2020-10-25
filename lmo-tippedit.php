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
require_once 'lmo-tipptest.php';
if ('' != $file) {
    $showzus = 0;

    require_once 'lmo-tippcalcpkt.php';

    require_once 'lmo-tippaenderbar.php';

    if (!isset($nlines)) {
        $nlines = '';
    }

    function gewinn($gsp, $gmod, $m1, $m2)
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
                    $erg = 1;
                } elseif ($m2[0] < $m1[1]) {
                    $erg = 2;
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
    }

    require 'lmo-tippopenfile.php';

    if (!isset($save)) {
        $save = 0;
    }

    if (1 == $save) {
        if (1 == $jokertipp) {
            $jksp = trim($_POST['xjokerspiel']);
        }

        for ($i = 0; $i < $anzsp; $i++) {
            if (0 == $lmtype) {
                $plus = 0;

                $btip = tippaenderbar($mterm[$st - 1][$i], $datum1[$st - 1], $datum2[$st - 1]);

                if (true === $btip) {
                    if (1 == $tippmodus) {
                        $goaltippa[$i] = trim($_POST['xtippa' . $i]);

                        if ('' == $goaltippa[$i] || $goaltippa[$i] < 0) {
                            $goaltippa[$i] = -1;
                        } elseif ('_' == $goaltippa[$i]) {
                            $goaltippa[$i] = -1;
                        } else {
                            $goaltippa[$i] = (int)trim($goaltippa[$i]);

                            if ('' == $goaltippa[$i]) {
                                $goaltippa[$i] = '0';
                            }
                        }

                        $goaltippb[$i] = trim($_POST['xtippb' . $i]);

                        if ('' == $goaltippb[$i] || $goaltippb[$i] < 0) {
                            $goaltippb[$i] = -1;
                        } elseif ('_' == $goaltippb[$i]) {
                            $goaltippb[$i] = -1;
                        } else {
                            $goaltippb[$i] = (int)trim($goaltippb[$i]);

                            if ('' == $goaltippb[$i]) {
                                $goaltippb[$i] = '0';
                            }
                        }
                    } elseif (0 == $tippmodus) {
                        if (!isset($_POST['xtipp' . $i])) {
                            $_POST['xtipp' . $i] = 0;
                        }

                        if (1 == $_POST['xtipp' . $i]) {
                            $goaltippa[$i] = '1';

                            $goaltippb[$i] = '0';
                        } elseif (2 == $_POST['xtipp' . $i]) {
                            $goaltippa[$i] = '0';

                            $goaltippb[$i] = '1';
                        } elseif (3 == $_POST['xtipp' . $i]) {
                            $goaltippa[$i] = '0';

                            $goaltippb[$i] = '0';
                        } else {
                            $goaltippa[$i] = '-1';

                            $goaltippb[$i] = '-1';
                        }
                    }
                }
            } else {
                for ($n = 0; $n < $modus[$st - 1]; $n++) {
                    $plus = 0;

                    $btip = tippaenderbar($mterm[$st - 1][$i][$n], $datum1[$st - 1], $datum2[$st - 1]);

                    if (true === $btip) {
                        if (1 == $tippmodus) {
                            $goaltippa[$i][$n] = trim($_POST['xtippa' . $i . $n]);

                            if ('' == $goaltippa[$i][$n] || $goaltippa[$i][$n] < 0) {
                                $goaltippa[$i][$n] = -1;
                            } elseif ('_' == $goaltippa[$i][$n]) {
                                $goaltippa[$i][$n] = -1;
                            } else {
                                $goaltippa[$i][$n] = (int)trim($goaltippa[$i][$n]);

                                if ('' == $goaltippa[$i][$n]) {
                                    $goaltippa[$i][$n] = '0';
                                }
                            }

                            $goaltippb[$i][$n] = trim($_POST['xtippb' . $i . $n]);

                            if ('' == $goaltippb[$i][$n] || $goaltippb[$i][$n] < 0) {
                                $goaltippb[$i][$n] = -1;
                            } elseif ('_' == $goaltippb[$i][$n]) {
                                $goaltippb[$i][$n] = -1;
                            } else {
                                $goaltippb[$i][$n] = (int)trim($goaltippb[$i][$n]);

                                if ('' == $goaltippb[$i][$n]) {
                                    $goaltippb[$i][$n] = '0';
                                }
                            }
                        } elseif (0 == $tippmodus) {
                            if (!isset($_POST['xtipp' . $i . $n])) {
                                $_POST['xtipp' . $i . $n] = 0;
                            }

                            if (1 == $_POST['xtipp' . $i . $n]) {
                                $goaltippa[$i][$n] = '1';

                                $goaltippb[$i][$n] = '0';
                            } elseif (2 == $_POST['xtipp' . $i . $n]) {
                                $goaltippa[$i][$n] = '0';

                                $goaltippb[$i][$n] = '1';
                            } elseif (3 == $_POST['xtipp' . $i . $n]) {
                                $goaltippa[$i][$n] = '0';

                                $goaltippb[$i][$n] = '0';
                            } else {
                                $goaltippa[$i][$n] = '-1';

                                $goaltippb[$i][$n] = '-1';
                            }
                        }
                    }
                }
            }
        }

        if (1 == $jokertipp) {
            require 'lmo-tippjokeranticheat.php';
        }

        require 'lmo-tippsavefile.php';

        if (1 == $akteinsicht) {
            require 'lmo-tippsaveeinsicht1.php';
        }
    }

    $addr = $PHP_SELF . '?action=tipp&amp;todo=edit&amp;file=' . $file . '&amp;st=';

    $addb = $PHP_SELF . '?action=tipp&amp;todo=tabs&amp;file=' . $file . '&amp;st=';

    $breite = 17;

    if (1 == $spez) {
        $breite += 2;
    }

    if (1 == $showtendenzabs) {
        $breite += 2;
    }

    if (1 == $showtendenzpro) {
        $breite += 2;
    }

    if (1 == $showdurchschntipp) {
        $breite += 2;
    }

    if (1 == $datm) {
        $breite++;
    }

    if (!isset($hidr)) {
        $hidr = 0;
    }

    //  if($lmtype==1 && $modus[$st-1]!=2){$hidr=1;} // bei KO-Turnier außer bei Hin- und Rückspiel keinen Remistipp zulassen

    if (1 == $hidr) {
        $breite--;
    }

    if (0 == $tippmodus) {
        $breite -= 2;
    }

    $savebutton = 0;

    if (1 == $showtendenzabs || 1 == $showtendenzpro || (1 == $showdurchschntipp && 1 == $tippmodus)) {
        require_once 'lmo-tippcalceinsicht.php';
    } ?>

    <table class="lmosta" cellspacing="0" cellpadding="0" border="0">
        <tr>
            <td align="center" class="lmost1">
                <font color=black><?php echo $lmotippername;

    if ('' != $lmotipperverein) {
        echo ' - ' . $lmotipperverein;
    } ?></font>
            </td>
        </tr>
        <tr>
            <td class="lmost4" align="center">
                <?php if ($tippbis > 0) {
        echo $text[587] . ' ' . $tippbis . ' ' . $text[588];
    } ?>
            </td>
        </tr>
        <tr>
            <td align="center">
                <table cellspacing="0" cellpadding="0" border="0">
                    <tr>
                        <?php
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
            echo 'class="lmost0"><a href="' . $addr . $i . '&amp;PHPSESSID=' . $PHPSESSID . '" title="' . $k . '">' . $j . '</a>';
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
        <tr>
            <td align="center" class="lmost3">
                <table class="lmostb" cellspacing="0" cellpadding="0" border="0">
                    <form name="lmoedit" action="<?php echo $PHP_SELF; ?>" method="post">

                        <input type="hidden" name="action" value="tipp">
                        <input type="hidden" name="todo" value="edit">
                        <input type="hidden" name="save" value="1">
                        <input type="hidden" name="file" value="<?php echo $file; ?>">
                        <input type="hidden" name="st" value="<?php echo $st; ?>">
                        <tr>
                            <?php
                            if ('' != $datum1[$st - 1]) {
                                $datum = preg_split('[.]', $datum1[$st - 1]);

                                $dum1 = $me[(int)$datum[1]] . ' ' . $datum[2];
                            } else {
                                $dum1 = '';
                            }

    if ('' != $datum2[$st - 1]) {
        $datum = preg_split('[.]', $datum2[$st - 1]);

        $dum2 = $me[(int)$datum[1]] . ' ' . $datum[2];
    } else {
        $dum2 = '';
    }

    if (1 == $lmtype) {
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
    } ?>
                            <td class="lmost4" colspan="<?php echo $datm + 5; ?>">
                                <nobr>
                                    <?php if (0 == $lmtype) {
        echo $st . '. ' . $text[2];
    } else {
        echo $j;
    } ?>
                                    <?php if (1 == $dats) { ?>
                                        <?php if ('' != $datum1[$st - 1]) {
        echo ' ' . $text[3] . ' ' . $datum1[$st - 1];
    } ?>
                                        <?php if ('' != $datum2[$st - 1]) {
        echo ' ' . $text[4] . ' ' . $datum2[$st - 1];
    } ?>
                                    <?php } ?>
                                </nobr>
                            </td>
                            <?php if (1 == $showtendenzabs || 1 == $showtendenzpro) { ?>
                                <td class="lmost4" align="center" colspan="<?php if (1 == $showtendenzabs && 1 == $showtendenzpro) {
        echo '4';
    } else {
        echo '2';
    } ?>">
                                    <nobr><?php echo $text[688]; // Tipptendenz absolut?></nobr>
                                </td>
                            <?php } ?>
                            <?php if (1 == $tippmodus) { ?>
                                <?php if (1 == $showdurchschntipp) { ?>
                                    <td class="lmost4" align="center" colspan="2">
                                        <nobr><?php echo '&Oslash;-' . $text[530]; // DurchschnittsTipp?></nobr>
                                    </td>
                                <?php } ?>
                                <td class="lmost4" align="center" colspan="<?php if (1 == $pfeiltipp) {
        echo '5';
    } else {
        echo '3';
    } ?>">
                                    <nobr><?php echo $text[709]; // Dein Tipp?></nobr>
                                </td>
                            <?php } ?>
                            <?php if (0 == $tippmodus) { ?>
                                <td class="lmost4" align="center">
                                    <nobr><?php echo '1'; ?></nobr>
                                </td>
                                <?php if (0 == $hidr) { ?>
                                    <td class="lmost4" align="center">
                                        <nobr><?php echo '0'; ?></nobr>
                                    </td>
                                <?php } ?>
                                <td class="lmost4" align="center">
                                    <nobr><?php echo '2'; ?></nobr>
                                </td>
                            <?php } ?>
                            <?php if (1 == $jokertipp) { ?>
                            <td class="lmost4" align="center">
                                <nobr><?php echo $text[902]; ?>
                                    <?php } ?>
                            <td class="lmost4" colspan="3" align="center">
                                <nobr><?php echo $text[531]; // Ergebnis
                                    ?></nobr>
                            </td>
                            <?php
                            if (1 == $spez) {
                                ?>
                                <td class="lmost4" colspan="2">&nbsp;</td>
                            <?php
                            } // ende $spez==1
                            ?>
                            <td class="lmost4" colspan="2" align="right">
                                <nobr><?php echo $text[37]; // PP
                                    ?></nobr>
                            </td>
                            <td class="lmost4" colspan="1">&nbsp;</td>
                        </tr>

                        <?php
                        if (0 != $lmtype) {
                            $anzsp = $anzteams;

                            for ($i = 0; $i < $st; $i++) {
                                $anzsp /= 2;
                            }

                            if ((1 == $klfin) && ($st == $anzst)) {
                                $anzsp += 1;
                            }
                        }

    $punktespieltag = 0;

    $nw = 0;

    $jokertippaktiv = true;

    $plus = 1;

    if (0 == $lmtype) {
        $btip = array_pad($array, $anzsp + 1, 'false');

        for ($i = 0; $i < $anzsp; $i++) {
            $btip[$i] = tippaenderbar($mterm[$st - 1][$i], $datum1[$st - 1], $datum2[$st - 1]);

            if (1 == $jokertipp && $jksp == ($i + 1) && false === $btip[$i]) {
                $jokertippaktiv = false;
            }
        }
    } else {
        $btip = array_pad($array, $anzsp + 1, '');

        for ($i = 0; $i < $anzsp; $i++) {
            $btip[$i] = array_pad(['false'], $modus[$st - 1] + 1, 'false');

            for ($n = 0; $n < $modus[$st - 1]; $n++) {
                $btip[$i][$n] = tippaenderbar($mterm[$st - 1][$i][$n], $datum1[$st - 1], $datum2[$st - 1]);

                if (1 == $jokertipp && $jksp == ($i + 1) . ($n + 1) && false === $btip[$i][$n]) {
                    $jokertippaktiv = false;
                }
            }
        }
    }

    for ($i = 0; $i < $anzsp; $i++) {
        if ($teama[$st - 1][$i] > 0 && $teamb[$st - 1][$i] > 0) {
            if (0 == $lmtype) {
                ?>
                                    <tr>
                                        <?php
                                        if (2 == $einsichterst) {
                                            if ('_' != $goala[$st - 1][$i] && '_' != $goalb[$st - 1][$i]) {
                                                $btip1 = false;
                                            } else {
                                                $btip1 = true;
                                            }
                                        } else {
                                            $btip1 = false;
                                        }

                if (1 == $datm) {
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
                                                if (($favteam > 0) && ($favteam == $teama[$st - 1][$i])) {
                                                    echo '<strong>';
                                                }

                echo $teams[$teama[$st - 1][$i]];

                if (($favteam > 0) && ($favteam == $teama[$st - 1][$i])) {
                    echo '</strong>';
                } ?>
                                            </nobr>
                                        </td>
                                        <td class="lmost5" align="center" width="10">-</td>
                                        <td class="lmost5" align="left">
                                            <nobr>

                                                <?php
                                                if (($favteam > 0) && ($favteam == $teamb[$st - 1][$i])) {
                                                    echo '<strong>';
                                                }

                echo $teams[$teamb[$st - 1][$i]];

                if (($favteam > 0) && ($favteam == $teamb[$st - 1][$i])) {
                    echo '</strong>';
                }

                if ('_' == $goaltippa[$i]) {
                    $goaltippa[$i] = '';
                }

                if ('_' == $goaltippb[$i]) {
                    $goaltippb[$i] = '';
                }

                if ('-1' == $goaltippa[$i]) {
                    $goaltippa[$i] = '';
                }

                if ('-1' == $goaltippb[$i]) {
                    $goaltippb[$i] = '';
                } ?>
                                            </nobr>
                                        </td>
                                        <td class="lmost5">&nbsp;</td>
                                        <?php if (1 == $showtendenzabs) { ?>
                                            <td align="center" class="lmost5">
                                                <nobr>
                                                    <?php
                                                    if (false === $btip1) {
                                                        if (!isset($tendenz1[$i])) {
                                                            $tendenz1[$i] = 0;
                                                        }

                                                        if (!isset($tendenz0[$i])) {
                                                            $tendenz0[$i] = 0;
                                                        }

                                                        if (!isset($tendenz2[$i])) {
                                                            $tendenz2[$i] = 0;
                                                        }

                                                        echo $tendenz1[$i] . '-' . $tendenz0[$i] . '-' . $tendenz2[$i];
                                                    }
                                                    ?>
                                                </nobr>
                                            </td>
                                            <td class="lmost5">&nbsp;</td>
                                        <?php } ?>
                                        <?php if (1 == $showtendenzpro) { ?>
                                            <td align="center" class="lmost5">
                                                <nobr>
                                                    <?php
                                                    if (false === $btip1) {
                                                        if (!isset($anzgetippt[$i])) {
                                                            $anzgetippt[$i] = 0;
                                                        }

                                                        if ($anzgetippt[$i] > 0) {
                                                            if (!isset($tendenz1[$i])) {
                                                                $tendenz1[$i] = 0;
                                                            }

                                                            if (!isset($tendenz0[$i])) {
                                                                $tendenz0[$i] = 0;
                                                            }

                                                            if (!isset($tendenz2[$i])) {
                                                                $tendenz2[$i] = 0;
                                                            }

                                                            echo number_format(($tendenz1[$i] / $anzgetippt[$i] * 100), 0, '.', ',') . '%-' . number_format(($tendenz0[$i] / $anzgetippt[$i] * 100), 0, '.', ',') . '%-' . number_format(($tendenz2[$i] / $anzgetippt[$i] * 100), 0, '.', ',') . '%';
                                                        } else {
                                                            echo '&nbsp;';
                                                        }
                                                    }
                                                    ?>
                                                </nobr>
                                            </td>
                                            <td class="lmost5">&nbsp;</td>
                                        <?php } ?>
                                        <?php
                                        if (true === $btip[$i]) {
                                            $savebutton = 1;
                                        }

                if (1 == $tippmodus) {
                    if (1 == $showdurchschntipp) { ?>
                                                <td align="center" class="lmost5">
                                                    <nobr>
                                                        <?php
                                                        if (false === $btip1) {
                                                            if (!isset($anzgetippt[$i])) {
                                                                $anzgetippt[$i] = 0;
                                                            }

                                                            if ($anzgetippt[$i] > 0) {
                                                                if (!isset($toregesa[$i])) {
                                                                    $toregesa[$i] = 0;
                                                                }

                                                                if (!isset($toregesb[$i])) {
                                                                    $toregesb[$i] = 0;
                                                                }

                                                                if ($toregesa[$i] < 10 && $toregesb[$i] < 10) {
                                                                    $nachkomma = 1;
                                                                } else {
                                                                    $nachkomma = 0;
                                                                }

                                                                echo number_format(($toregesa[$i] / $anzgetippt[$i]), $nachkomma, '.', ',') . ':' . number_format(($toregesb[$i] / $anzgetippt[$i]), $nachkomma, '.', ',');
                                                            } else {
                                                                echo '&nbsp;';
                                                            }
                                                        }
                                                        ?>
                                                    </nobr>
                                                </td>
                                                <td class="lmost5">&nbsp;</td>
                                            <?php } ?>
                                            <?php if (true === $btip[$i]) { ?>
                                                <td class="lmost5" align="right"><acronym title="<?php echo $text[741] ?>"><input class="lmoadminein" type="text" name="xtippa<?php echo $i; ?>" size="4" maxlength="4" value="<?php echo $goaltippa[$i]; ?>"
                                                                                                                                  onKeyDown="lmotorclk('a','<?php echo $i; ?>',event.keyCode)"></acronym></td>
                                                <?php if (1 == $pfeiltipp) { ?>
                                                    <td class="lmost5" align="center">
                                                        <table cellpadding="0" cellspacing="0" border="0">
                                                            <tr>
                                                                <td><a href="javascript:lmotorauf('a','<?php echo $i; ?>',1);" title="<?php echo $text[743]; ?>" onMouseOver="lmoimg('<?php echo $i; ?>a',img1)" onMouseOut="lmoimg('<?php echo $i; ?>a',img0)"><img src="lmo-admin0.gif"
                                                                                                                                                                                                                                                                     name="ximg<?php echo $i; ?>a" width="7"
                                                                                                                                                                                                                                                                     height="7" border="0"></a></td>
                                                            </tr>
                                                            <tr>
                                                                <td><a href="javascript:lmotorauf('a','<?php echo $i; ?>',-1);" title="<?php echo $text[743]; ?>" onMouseOver="lmoimg('<?php echo $i; ?>b',img3)" onMouseOut="lmoimg('<?php echo $i; ?>b',img2)"><img src="lmo-admin2.gif"
                                                                                                                                                                                                                                                                      name="ximg<?php echo $i; ?>b"
                                                                                                                                                                                                                                                                      width="7" height="7" border="0"></a>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                <?php } ?>
                                            <?php } else { ?>
                                                <?php if (1 == $pfeiltipp) { ?>
                                                    <td class="lmost5">&nbsp;</td>
                                                <?php } ?>
                                                <td class="lmost5" align="right"><?php echo $goaltippa[$i]; ?></td>
                                            <?php } ?>
                                            <td class="lmost5">:</td>
                                            <?php if (true === $btip[$i]) { ?>
                                                <td class="lmost5" align="right"><acronym title="<?php echo $text[742] ?>"><input class="lmoadminein" type="text" name="xtippb<?php echo $i; ?>" size="4" maxlength="4" value="<?php echo $goaltippb[$i]; ?>"
                                                                                                                                  onKeyDown="lmotorclk('b','<?php echo $i; ?>',event.keyCode)"></acronym></td>
                                                <?php if (1 == $pfeiltipp) { ?>
                                                    <td class="lmost5" align="center">
                                                        <table cellpadding="0" cellspacing="0" border="0">
                                                            <tr>
                                                                <td><a href="javascript:lmotorauf('b','<?php echo $i; ?>',1);" title="<?php echo $text[744]; ?>" onMouseOver="lmoimg('<?php echo $i; ?>f',img1)" onMouseOut="lmoimg('<?php echo $i; ?>f',img0)"><img src="lmo-admin0.gif"
                                                                                                                                                                                                                                                                     name="ximg<?php echo $i; ?>f" width="7"
                                                                                                                                                                                                                                                                     height="7" border="0"></a></td>
                                                            </tr>
                                                            <tr>
                                                                <td><a href="javascript:lmotorauf('b','<?php echo $i; ?>',-1);" title="<?php echo $text[744]; ?>" onMouseOver="lmoimg('<?php echo $i; ?>d',img3)" onMouseOut="lmoimg('<?php echo $i; ?>d',img2)"><img src="lmo-admin2.gif"
                                                                                                                                                                                                                                                                      name="ximg<?php echo $i; ?>d"
                                                                                                                                                                                                                                                                      width="7" height="7" border="0"></a>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                <?php } ?>
                                            <?php } else { ?>
                                                <td class="lmost5" align="left"><?php echo $goaltippb[$i]; ?></td>
                                                <?php if (1 == $pfeiltipp) { ?>
                                                    <td class="lmost5">&nbsp;</td>
                                                <?php } ?>
                                            <?php } ?>
                                        <?php
                } // ende ($tippmodus==1)?>
                                        <?php if (0 == $tippmodus) {
                    $tipp = -1;

                    if ('' == $goaltippa[$i] || '' == $goaltippb[$i]) {
                        $tipp = -1;
                    } elseif ($goaltippa[$i] > $goaltippb[$i]) {
                        $tipp = 1;
                    } elseif ($goaltippa[$i] == $goaltippb[$i]) {
                        $tipp = 0;
                    } elseif ($goaltippa[$i] < $goaltippb[$i]) {
                        $tipp = 2;
                    } ?>
                                            <td class="lmost5" align="center"><acronym title="<?php echo $text[595] ?>"><input type="radio" name="xtipp<?php echo $i; ?>" value="1" <?php if (1 == $tipp) {
                        echo ' checked';
                    }

                    if (false === $btip[$i]) {
                        echo ' disabled';
                    } ?>></acronym></td>
                                            <?php if (0 == $hidr) { ?>
                                                <td class="lmost5" align="center"><acronym title="<?php echo $text[596] ?>"><input type="radio" name="xtipp<?php echo $i; ?>" value="3" <?php if (0 == $tipp) {
                        echo ' checked';
                    }
                                                        if (false === $btip[$i]) {
                                                            echo ' disabled';
                                                        } ?>></acronym></td>
                                            <?php } ?>
                                            <td class="lmost5" align="center"><acronym title="<?php echo $text[597] ?>"><input type="radio" name="xtipp<?php echo $i; ?>" value="2" <?php if (2 == $tipp) {
                                                            echo ' checked';
                                                        }

                    if (false === $btip[$i]) {
                        echo ' disabled';
                    } ?>></acronym></td>
                                        <?php
                } // ende ($tippmodus==0)?>
                                        <?php if (1 == $jokertipp) { ?>
                                            <td class="lmost5" align="center"><acronym title="<?php echo $text[903] ?>"><input type="radio" name="xjokerspiel" value="<?php echo $i + 1; ?>" <?php if ($jksp == $i + 1) {
                    echo ' checked';
                }
                                                    if (false === $btip[$i]) {
                                                        echo ' disabled';
                                                    } elseif (false === $jokertippaktiv) {
                                                        echo ' disabled';
                                                    } ?>></acronym></td>
                                        <?php } ?>
                                        <td class="lmost7" align="right"><?php echo $goala[$st - 1][$i]; ?></td>
                                        <td class="lmost7">:</td>
                                        <td class="lmost7" align="left"><?php echo $goalb[$st - 1][$i]; ?></td>
                                        <?php if (1 == $spez) { ?>
                                            <td class="lmost7" width="2">&nbsp;</td>
                                            <td class="lmost7"><?php echo $mspez[$st - 1][$i]; ?></td>
                                        <?php } ?>
                                        <td class="lmost5" width="2">&nbsp;</td>
                                        <td class="lmost5"><strong>
                                                <?php
                                                if (1 == $jokertipp && $jksp == $i + 1) {
                                                    $jkspfaktor = $jokertippmulti;
                                                } else {
                                                    $jkspfaktor = 1;
                                                }

                $punktespiel = -1;

                if ('' != $goaltippa[$i] && '' != $goaltippb[$i] && '_' != $goala[$st - 1][$i] && '_' != $goalb[$st - 1][$i]) {
                    $punktespiel = tipppunkte($goaltippa[$i], $goaltippb[$i], $goala[$st - 1][$i], $goalb[$st - 1][$i], $msieg[$st - 1][$i], $mspez[$st - 1][$i], $text[0], $text[1], $jkspfaktor, $mtipp[$st - 1][$i]);
                }

                if (-1 == $punktespiel) {
                    echo '-';
                } elseif (-2 == $punktespiel) {
                    echo $text[730];

                    $nw = 1;
                } else {
                    if (1 == $tippmodus) {
                        echo $punktespiel;
                    } else {
                        if ($punktespiel > 0) {
                            echo '<img src="right.gif" width="16" height="16" border="0">';

                            if ($punktespiel > 1) {
                                echo '+' . ($punktespiel - 1);
                            }
                        } else {
                            echo '<img src="wrong.gif" width="16" height="16" border="0">';
                        }
                    }
                }

                if ($punktespiel > 0) {
                    $punktespieltag += $punktespiel;
                } ?>
                                                </b></td>
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
                } ?>

                                        </td>
                                    </tr>
                                    <?php
            } else {
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
                                            <?php
                                            if (2 == $einsichterst) {
                                                if ('_' != $goala[$st - 1][$i][$n] && '_' != $goalb[$st - 1][$i][$n]) {
                                                    $btip1 = false;
                                                } else {
                                                    $btip1 = true;
                                                }
                                            } else {
                                                $btip1 = false;
                                            }

                    if (1 == $datm) {
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
                                            <?php if (0 == $n) {
                        $m1 = [$goala[$st - 1][$i][0], $goala[$st - 1][$i][1], $goala[$st - 1][$i][2], $goala[$st - 1][$i][3], $goala[$st - 1][$i][4], $goala[$st - 1][$i][5], $goala[$st - 1][$i][6]];

                        $m2 = [$goalb[$st - 1][$i][0], $goalb[$st - 1][$i][1], $goalb[$st - 1][$i][2], $goalb[$st - 1][$i][3], $goalb[$st - 1][$i][4], $goalb[$st - 1][$i][5], $goalb[$st - 1][$i][6]];

                        $m = call_user_func('gewinn', $i, $modus[$st - 1], $m1, $m2);

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
                        } ?>

                                                <?php
                                                if (($favteam > 0) && ($favteam == $teama[$st - 1][$i])) {
                                                    echo '<b>';
                                                }

                        echo $teams[$teama[$st - 1][$i]];

                        if (($favteam > 0) && ($favteam == $teama[$st - 1][$i])) {
                            echo '</b>';
                        } ?>

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

                        if (($favteam > 0) && ($favteam == $teamb[$st - 1][$i])) {
                            echo '<strong>';
                        }

                        echo $teams[$teamb[$st - 1][$i]];

                        if (($favteam > 0) && ($favteam == $teamb[$st - 1][$i])) {
                            echo '</strong>';
                        } ?>

                                                </nobr></td>
                                            <?php
                    } else { ?>
                                                <td class="lmost5" colspan="3">&nbsp;</td>
                                                <?php
                                            }

                    if ('_' == $goaltippa[$i][$n]) {
                        $goaltippa[$i][$n] = '';
                    }

                    if ('_' == $goaltippb[$i][$n]) {
                        $goaltippb[$i][$n] = '';
                    }

                    if ('-1' == $goaltippa[$i][$n]) {
                        $goaltippa[$i][$n] = '';
                    }

                    if ('-1' == $goaltippb[$i][$n]) {
                        $goaltippb[$i][$n] = '';
                    } ?>
                                            <td class="lmost5" width="2">&nbsp;</td>
                                            <?php
                                            if (1 == $showtendenzabs) { ?>
                                                <td align="center" class="lmost5">
                                                    <nobr>
                                                        <?php
                                                        if (false === $btip1) {
                                                            if (!isset($tendenz1[$i][$n])) {
                                                                $tendenz1[$i][$n] = 0;
                                                            }

                                                            if (!isset($tendenz0[$i][$n])) {
                                                                $tendenz0[$i][$n] = 0;
                                                            }

                                                            if (!isset($tendenz2[$i][$n])) {
                                                                $tendenz2[$i][$n] = 0;
                                                            }

                                                            echo $tendenz1[$i][$n] . '-' . $tendenz0[$i][$n] . '-' . $tendenz2[$i][$n];
                                                        }
                                                        ?>
                                                    </nobr>
                                                </td>
                                                <td class="lmost5">&nbsp;</td>
                                            <?php } ?>
                                            <?php if (1 == $showtendenzpro) { ?>
                                                <td align="center" class="lmost5">
                                                    <nobr>
                                                        <?php
                                                        if (false === $btip1) {
                                                            if (!isset($anzgetippt[$i][$n])) {
                                                                $anzgetippt[$i][$n] = 0;
                                                            }

                                                            if ($anzgetippt[$i][$n] > 0) {
                                                                if (!isset($tendenz1[$i][$n])) {
                                                                    $tendenz1[$i][$n] = 0;
                                                                }

                                                                if (!isset($tendenz0[$i][$n])) {
                                                                    $tendenz0[$i][$n] = 0;
                                                                }

                                                                if (!isset($tendenz2[$i][$n])) {
                                                                    $tendenz2[$i][$n] = 0;
                                                                }

                                                                echo number_format(($tendenz1[$i][$n] / $anzgetippt[$i][$n] * 100), 0, '.', ',') . '%-' . number_format(($tendenz0[$i][$n] / $anzgetippt[$i][$n] * 100), 0, '.', ',') . '%-' . number_format(
                                                                    ($tendenz2[$i][$n] / $anzgetippt[$i][$n] * 100),
                                                                    0,
                                                                    '.',
                                                                    ','
                                                                ) . '%';
                                                            } else {
                                                                echo '&nbsp;';
                                                            }
                                                        }
                                                        ?>
                                                    </nobr>
                                                </td>
                                                <td class="lmost5">&nbsp;</td>
                                            <?php } ?>
                                            <?php
                                            if (true === $btip[$i][$n]) {
                                                $savebutton = 1;
                                            }

                    if (1 == $tippmodus) {
                        if (1 == $showdurchschntipp) { ?>
                                                    <td align="center" class="lmost5">
                                                        <nobr>
                                                            <?php
                                                            if (false === $btip1) {
                                                                if (!isset($anzgetippt[$i][$n])) {
                                                                    $anzgetippt[$i][$n] = 0;
                                                                }

                                                                if ($anzgetippt[$i][$n] > 0) {
                                                                    if (!isset($toregesa[$i][$n])) {
                                                                        $toregesa[$i][$n] = 0;
                                                                    }

                                                                    if (!isset($toregesb[$i][$n])) {
                                                                        $toregesb[$i][$n] = 0;
                                                                    }

                                                                    if ($toregesa[$i][$n] < 10 && $toregesb[$i][$n] < 10) {
                                                                        $nachkomma = 1;
                                                                    } else {
                                                                        $nachkomma = 0;
                                                                    }

                                                                    echo number_format(($toregesa[$i][$n] / $anzgetippt[$i][$n]), $nachkomma, '.', ',') . ':' . number_format(($toregesb[$i][$n] / $anzgetippt[$i][$n]), $nachkomma, '.', ',');
                                                                } else {
                                                                    echo '&nbsp;';
                                                                }
                                                            }
                                                            ?>
                                                        </nobr>
                                                    </td>
                                                    <td class="lmost5">&nbsp;</td>
                                                <?php }

                        if (true === $btip[$i][$n]) { ?>
                                                    <td class="lmost5" align="right"><acronym title="<?php echo $text[741] ?>"><input class="lmoadminein" type="text" name="xtippa<?php echo $i . $n; ?>" size="4" maxlength="4" value="<?php echo $goaltippa[$i][$n]; ?>"
                                                                                                                                      onKeyDown="lmotorclk('a','<?php echo $i . $n; ?>',event.keyCode)"></acronym></td>
                                                    <?php if (1 == $pfeiltipp) { ?>
                                                        <td class="lmost5" align="center">
                                                            <table cellpadding="0" cellspacing="0" border="0">
                                                                <tr>
                                                                    <td><a href="javascript:lmotorauf('a','<?php echo $i . $n; ?>',1);" title="<?php echo $text[743]; ?>" onMouseOver="lmoimg('<?php echo $i . $n; ?>a',img1)" onMouseOut="lmoimg('<?php echo $i . $n; ?>a',img0)"><img src="lmo-admin0.gif"
                                                                                                                                                                                                                                                                                        name="ximg<?php echo $i
                                                                                                                                                                                                                                                                                                             . $n; ?>a"
                                                                                                                                                                                                                                                                                        width="7" height="7"
                                                                                                                                                                                                                                                                                        border="0"></a></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><a href="javascript:lmotorauf('a','<?php echo $i . $n; ?>',-1);" title="<?php echo $text[743]; ?>" onMouseOver="lmoimg('<?php echo $i . $n; ?>b',img3)" onMouseOut="lmoimg('<?php echo $i . $n; ?>b',img2)"><img
                                                                                    src="lmo-admin2.gif" name="ximg<?php echo $i . $n; ?>b" width="7" height="7" border="0"></a></td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    <?php } ?>
                                                <?php } else { ?>
                                                    <?php if (1 == $pfeiltipp) { ?>
                                                        <td class="lmost5">&nbsp;</td>
                                                    <?php } ?>
                                                    <td class="lmost5" align="right"><?php echo $goaltippa[$i][$n]; ?></td>
                                                <?php } ?>
                                                <td class="lmost5">:</td>
                                                <?php if (true === $btip[$i][$n]) { ?>
                                                    <td class="lmost5" align="right"><acronym title="<?php echo $text[742] ?>"><input class="lmoadminein" type="text" name="xtippb<?php echo $i . $n; ?>" size="4" maxlength="4" value="<?php echo $goaltippb[$i][$n]; ?>"
                                                                                                                                      onKeyDown="lmotorclk('b','<?php echo $i . $n; ?>',event.keyCode)"></acronym></td>
                                                    <?php if (1 == $pfeiltipp) { ?>
                                                        <td class="lmost5" align="center">
                                                            <table cellpadding="0" cellspacing="0" border="0">
                                                                <tr>
                                                                    <td><a href="javascript:lmotorauf('b','<?php echo $i . $n; ?>',1);" title="<?php echo $text[744]; ?>" onMouseOver="lmoimg('<?php echo $i . $n; ?>f',img1)" onMouseOut="lmoimg('<?php echo $i . $n; ?>f',img0)"><img src="lmo-admin0.gif"
                                                                                                                                                                                                                                                                                        name="ximg<?php echo $i
                                                                                                                                                                                                                                                                                                             . $n; ?>f"
                                                                                                                                                                                                                                                                                        width="7" height="7"
                                                                                                                                                                                                                                                                                        border="0"></a></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><a href="javascript:lmotorauf('b','<?php echo $i . $n; ?>',-1);" title="<?php echo $text[744]; ?>" onMouseOver="lmoimg('<?php echo $i . $n; ?>d',img3)" onMouseOut="lmoimg('<?php echo $i . $n; ?>d',img2)"><img
                                                                                    src="lmo-admin2.gif" name="ximg<?php echo $i . $n; ?>d" width="7" height="7" border="0"></a></td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    <?php } ?>
                                                <?php } else { ?>
                                                    <td class="lmost5"><?php echo $goaltippb[$i][$n]; ?></td>
                                                    <?php if (1 == $pfeiltipp) { ?>
                                                        <td class="lmost5">&nbsp;</td>
                                                    <?php } ?>
                                                <?php } ?>
                                            <?php
                    } // ende $tippmodus==1?>
                                            <?php if (0 == $tippmodus) {
                        if ('' == $goaltippa[$i][$n] || '' == $goaltippb[$i][$n]) {
                            $tipp = -1;
                        } elseif ($goaltippa[$i][$n] > $goaltippb[$i][$n]) {
                            $tipp = 1;
                        } elseif ($goaltippa[$i][$n] == $goaltippb[$i][$n]) {
                            $tipp = 0;
                        } elseif ($goaltippa[$i][$n] < $goaltippb[$i][$n]) {
                            $tipp = 2;
                        } ?>
                                                <td class="lmost5" align="right"><acronym title="<?php echo $text[595] ?>"><input type="radio" name="xtipp<?php echo $i . $n; ?>" value="1" <?php if (1 == $tipp) {
                            echo ' checked';
                        }

                        if (false === $btip[$i][$n]) {
                            echo ' disabled';
                        } ?>></acronym></td>
                                                <?php if (0 == $hidr) { ?>
                                                    <td class="lmost5" align="center"><acronym title="<?php echo $text[596] ?>"><input type="radio" name="xtipp<?php echo $i . $n; ?>" value="3" <?php if (0 == $tipp) {
                            echo ' checked';
                        }
                                                            if (false === $btip[$i][$n]) {
                                                                echo ' disabled';
                                                            } ?>></acronym></td>
                                                <?php } ?>
                                                <td class="lmost5" align="right"><acronym title="<?php echo $text[597] ?>"><input type="radio" name="xtipp<?php echo $i . $n; ?>" value="2" <?php if (2 == $tipp) {
                                                                echo ' checked';
                                                            }

                        if (false === $btip[$i][$n]) {
                            echo ' disabled';
                        } ?>></acronym></td>
                                            <?php
                    } // ende ($tippmodus==0)?>
                                            <?php if (1 == $jokertipp) { ?>
                                                <td class="lmost5" align="center"><acronym title="<?php echo $text[903] ?>"><input type="radio" name="xjokerspiel" value="<?php echo($i + 1) . ($n + 1); ?>" <?php if ($jksp == ($i + 1) . ($n + 1)) {
                        echo ' checked';
                    }
                                                        if (false === $btip[$i][$n]) {
                                                            echo ' disabled';
                                                        } elseif (false === $jokertippaktiv) {
                                                            echo ' disabled';
                                                        } ?>></acronym></td>
                                            <?php } ?>
                                            <td class="lmost7" align="right"><?php echo $goala[$st - 1][$i][$n]; ?></td>
                                            <td class="lmost7">:</td>
                                            <td class="lmost7"><?php echo $goalb[$st - 1][$i][$n]; ?></td>
                                            <td class="lmost7"><?php echo $mspez[$st - 1][$i][$n]; ?></td>
                                            <td class="lmost5" width="2">&nbsp;</td>
                                            <td class="lmost5"><strong>
                                                    <?php
                                                    if (1 == $jokertipp && $jksp == ($i + 1) . ($n + 1)) {
                                                        $jkspfaktor = $jokertippmulti;
                                                    } else {
                                                        $jkspfaktor = 1;
                                                    }

                    $punktespiel = -1;

                    if ('' != $goaltippa[$i][$n] && '' != $goaltippb[$i][$n] && '_' != $goala[$st - 1][$i][$n] && '_' != $goalb[$st - 1][$i][$n]) {
                        $punktespiel = tipppunkte($goaltippa[$i][$n], $goaltippb[$i][$n], $goala[$st - 1][$i][$n], $goalb[$st - 1][$i][$n], 0, $mspez[$st - 1][$i][$n], $text[0], $text[1], $jkspfaktor, $mtipp[$st - 1][$i][$n]);
                    }

                    if (-1 == $punktespiel) {
                        echo '-';
                    } elseif (-2 == $punktespiel) {
                        echo $text[730];

                        $nw = 1;
                    } else {
                        if (1 == $tippmodus) {
                            echo $punktespiel;
                        } else {
                            if ($punktespiel > 0) {
                                echo '<img src="right.gif" width="16" height="16" border="0">';

                                if ($punktespiel > 1) {
                                    echo '+' . ($punktespiel - 1);
                                }
                            } else {
                                echo '<img src="wrong.gif" width="16" height="16" border="0">';
                            }
                        }
                    }

                    if ($punktespiel > 0) {
                        $punktespieltag += $punktespiel;
                    } ?>
                                                    </b></td>
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
                        $dummy = addslashes($teams[$teama[$st - 1][$i][$n]] . ' - ' . $teams[$teamb[$st - 1][$i][$n]] . ' ' . $goala[$st - 1][$i][$n] . ':' . $goalb[$st - 1][$i][$n]) . ' ' . $mspez[$st - 1][$i][$n];

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
                } ?>
                                    <?php if (($modus[$st - 1] > 1) && ($i < $anzsp - 1)) { ?>
                                        <tr>
                                            <td class="lmost5" colspan="<?php echo $breite; ?>">&nbsp;</td>
                                        </tr>
                                    <?php }
            }
        }
    } ?>

                        <tr>
                            <td class="lmost4" colspan="<?php echo $datm * 2 + 10 - $hidr; ?>" align="right"><?php if ($imvorraus >= 0 && $st > ($stx + $imvorraus)) {
        echo $text[677];
    } ?>
                                <?php if (1 == $savebutton) { ?>
                                    <acronym title="<?php echo $text[114] ?>"><input class="lmoadminbut" type="submit" name="best" value="<?php echo $text[508]; ?>"<?php if ($imvorraus >= 0 && $st > ($stx + $imvorraus)) {
        echo ' disabled';
    } ?>></acronym>
                                <?php } else {
        echo '&nbsp;';
    } ?>
                            </td>
                            <td class="lmost4" colspan="<?php echo $breite - $datm - 9; ?>" align="right">
                                <nobr>
                                    <?php
                                    echo $text[37] . ' ';

    if (0 == $lmtype) {
        echo $text[2];
    } else {
        echo $j;
    }

    echo ': ' . $punktespieltag; ?>
                                </nobr>
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
        //  	echo "<td class=\"lmost2\"><a href=\"".$addr.$st0."&amp;PHPSESSID=".$PHPSESSID."\" title=\"".$text[6]."\">".$text[5]."</a></td>";

        echo "<td class=\"lmost2\" align='left'>&nbsp;<a href=\"" . $addr . $st0 . '&amp;PHPSESSID=' . $PHPSESSID . '" title="' . $text[6] . "\"><img src=\"./images/left.gif\" width='9' height='9' border=\"0\"></a></td>";
    }

    $st0 = $st + 1;

    if ($st < $anzst) {
        echo '<td align="right" class="lmost2"><a href="' . $addr . $st0 . '&amp;PHPSESSID=' . $PHPSESSID . '" title="' . $text[8] . "\"><img src=\"./images/right.gif\" width='9' height='9' border=\"0\"></a>&nbsp;</td>";
    } ?>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

<?php
} ?>
