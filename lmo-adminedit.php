<?php

//
// LigaManager Online 3.02a
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
if ('' != $file) {
    $ftest0 = 1;

    $liga = mb_substr($file, mb_strrpos($file, '/') + 1, -4);

    if (0 == $immeralle) {
        $ftest0 = 0;

        $ftest1 = '';

        $ftest1 = preg_split('[,]', $ligenzutippen);

        if (isset($ftest1)) {
            for ($u = 0, $uMax = count($ftest1); $u < $uMax; $u++) {
                if ($ftest1[$u] == $liga) {
                    $ftest0 = 1;
                }
            }
        }
    }

    if (!isset($nlines)) {
        $nlines = '';
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
    }

    require 'lmo-openfile.php';

    if (!isset($save)) {
        $save = 0;
    }

    if (1 == $save) {
        $me = ['0', 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

        if (2 == $HTTP_SESSION_VARS['lmouserok']) {
            $datum1[$st - 1] = trim($_POST['xdatum1']);

            if ('' != $datum1[$st - 1]) {
                $datum = preg_split('[.]', $datum1[$st - 1]);

                $dummy = strtotime($datum[0] . ' ' . $me[(int)$datum[1]] . ' ' . $datum[2]);

                if ($dummy > -1) {
                    $datum1[$st - 1] = strftime('%d.%m.%Y', $dummy);
                } else {
                    $datum1[$st - 1] = '';
                }
            }

            $datum2[$st - 1] = trim($_POST['xdatum2']);

            if ('' != $datum2[$st - 1]) {
                $datum = preg_split('[.]', $datum2[$st - 1]);

                $dummy = strtotime($datum[0] . ' ' . $me[(int)$datum[1]] . ' ' . $datum[2]);

                if ($dummy > -1) {
                    $datum2[$st - 1] = strftime('%d.%m.%Y', $dummy);
                } else {
                    $datum2[$st - 1] = '';
                }
            }
        }

        if (1 == $hands) {
            for ($i = $st - 1; $i < $stanz; $i++) {
                $handp[$i] = 0;
            }
        }

        for ($i = 0; $i < $anzsp; $i++) {
            if (0 == $lmtype) {
                $dum1 = trim($_POST['xatdat' . $i]);

                $dum2 = trim($_POST['xattim' . $i]);

                if ('' != $dum1) {
                    if ('' == $dum2) {
                        $dum2 = $deftime;
                    }

                    $datu1 = preg_split('[.]', $dum1);

                    $datu2 = preg_split('[:]', $dum2);

                    $dummy = strtotime($datu1[0] . ' ' . $me[(int)$datu1[1]] . ' ' . $datu1[2] . ' ' . $datu2[0] . ':' . $datu2[1]);

                    if ($dummy > -1) {
                        $mterm[$st - 1][$i] = $dummy;
                    } else {
                        $mterm[$st - 1][$i] = '';
                    }
                }
            } else {
                for ($n = 0; $n < $modus[$st - 1]; $n++) {
                    $dum1 = trim($_POST['xatdat' . $i . $n]);

                    $dum2 = trim($_POST['xattim' . $i . $n]);

                    if ('' != $dum1) {
                        if ('' == $dum2) {
                            $dum2 = $deftime;
                        }

                        $datu1 = preg_split('[.]', $dum1);

                        $datu2 = preg_split('[:]', $dum2);

                        $dummy = strtotime($datu1[0] . ' ' . $me[(int)$datu1[1]] . ' ' . $datu1[2] . ' ' . $datu2[0] . ':' . $datu2[1]);

                        if ($dummy > -1) {
                            $mterm[$st - 1][$i][$n] = $dummy;
                        } else {
                            $mterm[$st - 1][$i][$n] = '';
                        }
                    }
                }
            }

            if (2 == $lmouserok) {
                $teama[$st - 1][$i] = $_POST['xteama' . $i];

                $teamb[$st - 1][$i] = $_POST['xteamb' . $i];
            }

            if (0 == $lmtype) {
                $goala[$st - 1][$i] = trim($_POST['xgoala' . $i]);

                if ('' == $goala[$st - 1][$i]) {
                    $goala[$st - 1][$i] = -1;
                } elseif ('_' == $goala[$st - 1][$i]) {
                    $goala[$st - 1][$i] = -1;
                } elseif ('X' == mb_strtoupper($goala[$st - 1][$i])) {
                    $goala[$st - 1][$i] = 0;

                    $msieg[$st - 1][$i] = 1;
                } else {
                    $goala[$st - 1][$i] = (int)trim($goala[$st - 1][$i]);

                    if ('' == $goala[$st - 1][$i]) {
                        $goala[$st - 1][$i] = '0';
                    }
                }

                $goalb[$st - 1][$i] = trim($_POST['xgoalb' . $i]);

                if ('' == $goalb[$st - 1][$i]) {
                    $goalb[$st - 1][$i] = -1;
                } elseif ('_' == $goalb[$st - 1][$i]) {
                    $goalb[$st - 1][$i] = -1;
                } elseif ('X' == mb_strtoupper($goalb[$st - 1][$i])) {
                    $goalb[$st - 1][$i] = 0;

                    $msieg[$st - 1][$i] = 2;
                } else {
                    $goalb[$st - 1][$i] = (int)trim($goalb[$st - 1][$i]);

                    if ('' == $goalb[$st - 1][$i]) {
                        $goalb[$st - 1][$i] = '0';
                    }
                }

                $msieg[$st - 1][$i] = $_POST['xmsieg' . $i];

                if (1 == $spez) {
                    $mspez[$st - 1][$i] = $_POST['xmspez' . $i];
                }

                $mnote[$st - 1][$i] = trim($_POST['xmnote' . $i]);

                $mberi[$st - 1][$i] = trim($_POST['xmberi' . $i]);

                if (2 == $lmouserok && 1 == $ftest0) {
                    $mtipp[$st - 1][$i] = trim($_POST['xmtipp' . $i]);
                }

                if (($st < $anzst) && ($favteam > 0) && ($stat1 == $favteam)) {
                    for ($y = 0; $y < $anzsp; $y++) {
                        if ($teama[$st][$y] == $favteam) {
                            $stat2 = $teamb[$st][$y];
                        }

                        if ($teamb[$st][$y] == $favteam) {
                            $stat2 = $teama[$st][$y];
                        }
                    }
                }
            } else {
                for ($n = 0; $n < $modus[$st - 1]; $n++) {
                    $goala[$st - 1][$i][$n] = trim($_POST['xgoala' . $i . $n]);

                    if ('' == $goala[$st - 1][$i][$n]) {
                        $goala[$st - 1][$i][$n] = -1;
                    } elseif ('_' == $goala[$st - 1][$i][$n]) {
                        $goala[$st - 1][$i][$n] = -1;
                    } else {
                        $goala[$st - 1][$i][$n] = (int)trim($goala[$st - 1][$i][$n]);

                        if ('' == $goala[$st - 1][$i][$n]) {
                            $goala[$st - 1][$i][$n] = '0';
                        }
                    }

                    $goalb[$st - 1][$i][$n] = trim($_POST['xgoalb' . $i . $n]);

                    if ('' == $goalb[$st - 1][$i][$n]) {
                        $goalb[$st - 1][$i][$n] = -1;
                    } elseif ('_' == $goalb[$st - 1][$i][$n]) {
                        $goalb[$st - 1][$i][$n] = -1;
                    } else {
                        $goalb[$st - 1][$i][$n] = (int)trim($goalb[$st - 1][$i][$n]);

                        if ('' == $goalb[$st - 1][$i][$n]) {
                            $goalb[$st - 1][$i][$n] = '0';
                        }
                    }

                    $mspez[$st - 1][$i][$n] = $_POST['xmspez' . $i . $n];

                    $mnote[$st - 1][$i][$n] = trim($_POST['xmnote' . $i . $n]);

                    $mberi[$st - 1][$i][$n] = trim($_POST['xmberi' . $i . $n]);

                    if (2 == $lmouserok && 1 == $ftest0) {
                        $mtipp[$st - 1][$i][$n] = trim($_POST['xmtipp' . $i . $n]);
                    }
                }

                if (($st < $anzst) && ($favteam > 0) && ($stat1 == $favteam)) {
                    for ($y = 0; $y < $anzsp; $y++) {
                        if ($teama[$st][$y] == $favteam) {
                            $stat2 = $teamb[$st][$y];
                        }

                        if ($teamb[$st][$y] == $favteam) {
                            $stat2 = $teama[$st][$y];
                        }
                    }
                }
            }
        }

        if (1 == $ftest0) { // Liga darf getippt werden
            if (1 == $aktauswert) {
                require 'lmo-tippsavewert.php';
            }

            if (1 == $aktauswertges) {
                require 'lmo-tippsavewertgesamt.php';
            }
        }

        $stz = trim($_POST['xstx']);

        if (0 != $stz) {
            $stx = $stz;
        } else {
            $stx = $st;
        }

        $stz = $st;

        $st = $stx;

        $nticker = trim($_POST['xnticker']);

        $nlines = preg_split("[\n]", $_POST['xnlines']);

        if (count($nlines) > 0) {
            for ($z = count($nlines) - 1; $z >= 0; $z--) {
                $y = array_pop($nlines);

                if ('' != $y) {
                    array_unshift($nlines, $y);
                }
            }
        }

        if (0 == count($nlines)) {
            $nticker = 0;
        }

        require 'lmo-savefile.php';

        $st = $stz;
    }

    if (0 != $lmtype) {
        if ($st > 1) {
            $teamt = array_pad(['0'], 129, '0');

            for ($i = 0; $i < ($st - 1); $i++) {
                for ($j = 0; $j < (($anzteams / 2) + 1); $j++) {
                    $m1 = [$goala[$i][$j][0], $goala[$i][$j][1], $goala[$i][$j][2], $goala[$i][$j][3], $goala[$i][$j][4], $goala[$i][$j][5], $goala[$i][$j][6]];

                    $m2 = [$goalb[$i][$j][0], $goalb[$i][$j][1], $goalb[$i][$j][2], $goalb[$i][$j][3], $goalb[$i][$j][4], $goalb[$i][$j][5], $goalb[$i][$j][6]];

                    $m = call_user_func('gewinn', $i, $j, $modus[$i], $m1, $m2);

                    if (1 == $m) {
                        $teamt[$teamb[$i][$j]] = 1;
                    } elseif (2 == $m) {
                        $teamt[$teama[$i][$j]] = 1;
                    }

                    if ((1 == $klfin) && ($i == $st - 2)) {
                        if (1 == $m) {
                            $teamt[$teamb[$i][$j]] = 2;
                        } elseif (2 == $m) {
                            $teamt[$teama[$i][$j]] = 2;
                        }
                    }
                }
            }
        }
    }

    $addr = $PHP_SELF . '?action=admin&amp;todo=edit&amp;file=' . $file . '&amp;st=';

    $addb = $PHP_SELF . '?action=admin&amp;todo=tabs&amp;file=' . $file . '&amp;st=';

    $breite = 17;

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
                                echo "class=\"lmost0\"><a href=\"javascript:chklmolink('" . $addr . $i . "');\" title=\"" . $k . '">' . $j . '</a>';
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

                    <form name="lmoedit" action="<?php echo $PHP_SELF; ?>" method="post" onSubmit="return chklmopass()">

                        <input type="hidden" name="action" value="admin">
                        <input type="hidden" name="todo" value="edit">
                        <input type="hidden" name="save" value="1">
                        <input type="hidden" name="file" value="<?php echo $file; ?>">
                        <input type="hidden" name="st" value="<?php echo $st; ?>">
                        <tr>
                            <td class="lmost4" colspan="<?php echo $breite - 4; ?>">
                                <nobr><?php echo $st; ?>. <?php echo $text[2]; ?>
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
    } ?>
                                    <?php if (2 == $lmouserok) { ?>
                                        <?php echo ' ' . $text[3] . ' '; ?><acronym title="<?php echo $text[105] ?>"><input class="lmoadminein" type="text" name="xdatum1" size="10" maxlength="10" value="<?php echo $datum1[$st - 1]; ?>" onChange="dolmoedit()"></acronym><a
                                                href="javascript:opencal('xdatum1','<?php echo $dum1; ?>')" title="<?php echo $text[139]; ?>" onMouseOver="lmoimg('d1',img5)" onMouseOut="lmoimg('d1',img4)"><img src="lmo-admin4.gif" name="ximgd1" width="14" height="10" border="0"></a>
                                        <?php echo ' ' . $text[4] . ' '; ?><acronym title="<?php echo $text[106] ?>"><input class="lmoadminein" type="text" name="xdatum2" size="10" maxlength="10" value="<?php echo $datum2[$st - 1]; ?>" onChange="dolmoedit()"></acronym><a
                                                href="javascript:opencal('xdatum2','<?php echo $dum2; ?>')" title="<?php echo $text[139]; ?>" onMouseOver="lmoimg('d2',img5)" onMouseOut="lmoimg('d2',img4)"><img src="lmo-admin4.gif" name="ximgd2" width="14" height="10" border="0"></a>
                                    <?php } ?>
                                </nobr>
                            </td>
                            <?php if (0 == $lmtype) { ?>
                                <td class="lmost4" width="2">
                                    <nobr><acronym title="<?php echo $text[213] ?>"><?php echo $text[217]; ?></acronym></nobr>
                                </td>
                            <?php } ?>
                            <td class="lmost4" width="2">
                                <nobr><acronym title="<?php echo $text[112] ?>"><?php echo $text[218]; ?></acronym></nobr>
                            </td>
                            <td class="lmost4" width="2">
                                <nobr><acronym title="<?php echo $text[263] ?>"><?php echo $text[262]; ?></acronym></nobr>
                            </td>
                            <?php if (2 == $lmouserok && 1 == $ftest0) { ?>
                                <td class="lmost4" width="2">
                                    <nobr><acronym title="<?php echo $text[557] ?>"><?php echo $text[557]; ?></acronym></nobr>
                                </td>
                            <?php } ?>
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

    for ($i = 0; $i < $anzsp; $i++) {
        if (0 == $lmtype) {
            ?>
                                <tr>
                                    <?php
                                    if ($mterm[$st - 1][$i] > 0) {
                                        $dum1 = strftime('%d.%m.%Y', $mterm[$st - 1][$i]);

                                        $dum2 = strftime('%H:%M', $mterm[$st - 1][$i]);

                                        $dum3 = $me[(int)strftime('%m', $mterm[$st - 1][$i])] . ' ' . strftime('%Y', $mterm[$st - 1][$i]);
                                    } else {
                                        $dum1 = '';

                                        $dum2 = '';

                                        $dum3 = '';
                                    } ?>
                                    <td class="lmost5">
                                        <nobr><acronym title="<?php echo $text[122] ?>"><input class="lmoadminein" type="text" name="xatdat<?php echo $i; ?>" size="10" maxlength="10" value="<?php echo $dum1; ?>" onChange="dolmoedit()"></acronym><a
                                                    href="javascript:opencal('xatdat<?php echo $i; ?>','<?php echo $dum3; ?>')" title="<?php echo $text[139]; ?>" onMouseOver="lmoimg('<?php echo $i; ?>c',img5)" onMouseOut="lmoimg('<?php echo $i; ?>c',img4)"><img src="lmo-admin4.gif"
                                                                                                                                                                                                                                                                      name="ximg<?php echo $i; ?>c"
                                                                                                                                                                                                                                                                      width="14" height="10" border="0"></a>
                                        </nobr>
                                    </td>
                                    <td class="lmost5"><acronym title="<?php echo $text[123] ?>"><input class="lmoadminein" type="text" name="xattim<?php echo $i; ?>" size="5" maxlength="5" value="<?php echo $dum2; ?>" onChange="dolmoedit()"></acronym></td>
                                    <td class="lmost5" width="2">&nbsp;</td>
                                    <td class="lmost5" align="right">
                                        <nobr>

                                            <?php if (2 == $lmouserok) { ?>
                                                <acronym title="<?php echo $text[107] ?>">
                                                    <select class="lmoadminein" name="xteama<?php echo $i; ?>" onChange="dolmoedit()">
                                                        <?php
                                                        for ($y = 0; $y <= $anzteams; $y++) {
                                                            echo '<option value="' . $y . '"';

                                                            if ($y == $teama[$st - 1][$i]) {
                                                                echo ' selected';
                                                            }

                                                            echo '>' . $teams[$y] . '</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                </acronym>
                                            <?php } else {
                                                            echo $teams[$teama[$st - 1][$i]];
                                                        } ?>

                                        </nobr>
                                    </td>
                                    <td class="lmost5" align="center" width="10">-</td>
                                    <td class="lmost5">
                                        <nobr>

                                            <?php if (2 == $lmouserok) { ?>
                                                <acronym title="<?php echo $text[108] ?>">
                                                    <select class="lmoadminein" name="xteamb<?php echo $i; ?>" onChange="dolmoedit()">
                                                        <?php
                                                        for ($y = 0; $y <= $anzteams; $y++) {
                                                            echo '<option value="' . $y . '"';

                                                            if ($y == $teamb[$st - 1][$i]) {
                                                                echo ' selected';
                                                            }

                                                            echo '>' . $teams[$y] . '</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                </acronym>
                                                <?php
                                            } else {
                                                echo $teams[$teamb[$st - 1][$i]];
                                            }

            if ('-1' == $goala[$st - 1][$i]) {
                $goala[$st - 1][$i] = '_';
            }

            if ('-1' == $goalb[$st - 1][$i]) {
                $goalb[$st - 1][$i] = '_';
            } ?>

                                        </nobr>
                                    </td>
                                    <td class="lmost5" width="2">&nbsp;</td>
                                    <td class="lmost5" align="right"><acronym title="<?php echo $text[109] ?>"><input class="lmoadminein" type="text" name="xgoala<?php echo $i; ?>" size="4" maxlength="4" value="<?php echo $goala[$st - 1][$i]; ?>" onChange="lmotorgte('a','<?php echo $i; ?>')"
                                                                                                                      onKeyDown="lmotorclk('a','<?php echo $i; ?>',event.keyCode)"></acronym></td>
                                    <td class="lmost5" align="center">
                                        <table cellpadding="0" cellspacing="0" border="0">
                                            <tr>
                                                <td><a href="javascript:lmotorauf('a','<?php echo $i; ?>',1);" title="<?php echo $text[120]; ?>" onMouseOver="lmoimg('<?php echo $i; ?>a',img1)" onMouseOut="lmoimg('<?php echo $i; ?>a',img0)"><img src="lmo-admin0.gif" name="ximg<?php echo $i; ?>a"
                                                                                                                                                                                                                                                     width="7" height="7" border="0"></a></td>
                                            </tr>
                                            <tr>
                                                <td><a href="javascript:lmotorauf('a','<?php echo $i; ?>',-1);" title="<?php echo $text[120]; ?>" onMouseOver="lmoimg('<?php echo $i; ?>b',img3)" onMouseOut="lmoimg('<?php echo $i; ?>b',img2)"><img src="lmo-admin2.gif" name="ximg<?php echo $i; ?>b"
                                                                                                                                                                                                                                                      width="7" height="7" border="0"></a></td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td class="lmost5" align="center" width="8">:</td>
                                    <td class="lmost5" align="right"><acronym title="<?php echo $text[110] ?>"><input class="lmoadminein" type="text" name="xgoalb<?php echo $i; ?>" size="4" maxlength="4" value="<?php echo $goalb[$st - 1][$i]; ?>" onChange="lmotorgte('b','<?php echo $i; ?>')"
                                                                                                                      onKeyDown="lmotorclk('b','<?php echo $i; ?>',event.keyCode)"></acronym></td>
                                    <td class="lmost5" align="center">
                                        <table cellpadding="0" cellspacing="0" border="0">
                                            <tr>
                                                <td><a href="javascript:lmotorauf('b','<?php echo $i; ?>',1);" title="<?php echo $text[121]; ?>" onMouseOver="lmoimg('<?php echo $i; ?>f',img1)" onMouseOut="lmoimg('<?php echo $i; ?>f',img0)"><img src="lmo-admin0.gif" name="ximg<?php echo $i; ?>f"
                                                                                                                                                                                                                                                     width="7" height="7" border="0"></a></td>
                                            </tr>
                                            <tr>
                                                <td><a href="javascript:lmotorauf('b','<?php echo $i; ?>',-1);" title="<?php echo $text[121]; ?>" onMouseOver="lmoimg('<?php echo $i; ?>d',img3)" onMouseOut="lmoimg('<?php echo $i; ?>d',img2)"><img src="lmo-admin2.gif" name="ximg<?php echo $i; ?>d"
                                                                                                                                                                                                                                                      width="7" height="7" border="0"></a></td>
                                            </tr>
                                        </table>
                                    </td>
                                    <?php if (1 == $spez) { ?>
                                        <td class="lmost5" width="2">&nbsp;</td>
                                        <td class="lmost5">
                                            <acronym title="<?php echo $text[111] ?>">
                                                <select class="lmoadminein" name="xmspez<?php echo $i; ?>" onChange="dolmoedit()">
                                                    <?php
                                                    echo '<option';
                                                    if ('&nbsp;' == $mspez[$st - 1][$i]) {
                                                        echo ' selected';
                                                    }
                                                    echo '>_</option>';
                                                    echo '<option';
                                                    if ($mspez[$st - 1][$i] == $text[0]) {
                                                        echo ' selected';
                                                    }
                                                    echo '>' . $text[0] . '</option>';
                                                    echo '<option';
                                                    if ($mspez[$st - 1][$i] == $text[1]) {
                                                        echo ' selected';
                                                    }
                                                    echo '>' . $text[1] . '</option>';
                                                    ?>
                                                </select>
                                            </acronym>
                                        </td>
                                    <?php } ?>
                                    <td class="lmost5" width="2">&nbsp;</td>
                                    <td class="lmost5">
                                        <acronym title="<?php echo $text[213] ?>">
                                            <select class="lmoadminein" name="xmsieg<?php echo $i; ?>" onChange="dolmoedit()">
                                                <?php
                                                echo '<option value="0"';

            if (0 == $msieg[$st - 1][$i]) {
                echo ' selected';
            }

            echo '>_</option>';

            echo '<option value="1"';

            if (1 == $msieg[$st - 1][$i]) {
                echo ' selected';
            }

            echo '>' . $text[214] . '</option>';

            echo '<option value="2"';

            if (2 == $msieg[$st - 1][$i]) {
                echo ' selected';
            }

            echo '>' . $text[215] . '</option>';

            echo '<option value="3"';

            if (3 == $msieg[$st - 1][$i]) {
                echo ' selected';
            }

            echo '>' . $text[216] . '</option>'; ?>
                                            </select>
                                        </acronym>
                                    </td>
                                    <td class="lmost5"><acronym title="<?php echo $text[112] ?>"><input class="lmoadminein" type="text" name="xmnote<?php echo $i; ?>" size="16" maxlength="255" value="<?php echo $mnote[$st - 1][$i]; ?>" onChange="dolmoedit()"></acronym></td>
                                    <td class="lmost5"><acronym title="<?php echo $text[263] ?>"><input class="lmoadminein" type="text" name="xmberi<?php echo $i; ?>" size="16" maxlength="128" value="<?php echo $mberi[$st - 1][$i]; ?>" onChange="dolmoedit()"></acronym></td>
                                    <?php if (2 == $lmouserok && 1 == $ftest0) { ?>
                                        <td class="lmost5"><acronym title="<?php echo $text[557] ?>">
                                                <select class="lmoadminein" name="xmtipp<?php echo $i; ?>" onChange="dolmoedit()">
                                                    <?php
                                                    echo '<option value="0"';
                                                    if ($mtipp[$st - 1][$i] < 1) {
                                                        echo ' selected';
                                                    }
                                                    echo '>_</option>';
                                                    echo '<option value="1"';
                                                    if (1 == $mtipp[$st - 1][$i]) {
                                                        echo ' selected';
                                                    }
                                                    echo '>' . $text[699] . '</option>';
                                                    ?>
                                                </select>
                                            </acronym>
                                        </td>
                                    <?php } ?>

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
                                        if ($mterm[$st - 1][$i][$n] > 0) {
                                            $dum1 = strftime('%d.%m.%Y', $mterm[$st - 1][$i][$n]);

                                            $dum2 = strftime('%H:%M', $mterm[$st - 1][$i][$n]);

                                            $dum3 = $me[(int)strftime('%m', $mterm[$st - 1][$i][$n])] . ' ' . strftime('%Y', $mterm[$st - 1][$i][$n]);
                                        } else {
                                            $dum1 = '';

                                            $dum2 = '';

                                            $dum3 = '';
                                        } ?>
                                        <td class="lmost5">
                                            <nobr><acronym title="<?php echo $text[122] ?>"><input class="lmoadminein" type="text" name="xatdat<?php echo $i . $n; ?>" size="10" maxlength="10" value="<?php echo $dum1; ?>" onChange="dolmoedit()"></acronym><a
                                                        href="javascript:opencal('xatdat<?php echo $i . $n; ?>','<?php echo $dum3; ?>')" title="<?php echo $text[139]; ?>" onMouseOver="lmoimg('<?php echo $i . $n; ?>c',img5)" onMouseOut="lmoimg('<?php echo $i . $n; ?>c',img4)"><img
                                                            src="lmo-admin4.gif" name="ximg<?php echo $i . $n; ?>c" width="14" height="10" border="0"></a></nobr>
                                        </td>
                                        <td class="lmost5"><acronym title="<?php echo $text[123] ?>"><input class="lmoadminein" type="text" name="xattim<?php echo $i . $n; ?>" size="5" maxlength="5" value="<?php echo $dum2; ?>" onChange="dolmoedit()"></acronym></td>
                                        <td class="lmost5" width="2">&nbsp;</td>
                                        <?php if (0 == $n) { ?>
                                            <td class="lmost5" align="right">
                                                <nobr>

                                                    <?php if (2 == $lmouserok) { ?>
                                                        <acronym title="<?php echo $text[107] ?>">
                                                            <select class="lmoadminein" name="xteama<?php echo $i; ?>" onChange="dolmoedit()">
                                                                <?php
                                                                if ((1 == $klfin) && ($st == $anzst) && (1 == $i)) {
                                                                    echo '<option value="0"';

                                                                    if (0 == $teama[$st - 1][$i]) {
                                                                        echo ' selected';
                                                                    }

                                                                    echo '>' . $teams[0] . '</option>';

                                                                    for ($y = 1; $y <= $anzteams; $y++) {
                                                                        if (2 == $teamt[$y]) {
                                                                            echo '<option value="' . $y . '"';

                                                                            if ($y == $teama[$st - 1][$i]) {
                                                                                echo ' selected';
                                                                            }

                                                                            echo '>' . $teams[$y] . '</option>';
                                                                        }
                                                                    }
                                                                } else {
                                                                    for ($y = 0; $y <= $anzteams; $y++) {
                                                                        if (0 == $teamt[$y]) {
                                                                            echo '<option value="' . $y . '"';

                                                                            if ($y == $teama[$st - 1][$i]) {
                                                                                echo ' selected';
                                                                            }

                                                                            echo '>' . $teams[$y] . '</option>';
                                                                        }
                                                                    }
                                                                }
                                                                ?>
                                                            </select>
                                                        </acronym>
                                                    <?php } else {
                                                                    echo $teams[$teama[$st - 1][$i]];
                                                                } ?>

                                                </nobr>
                                            </td>
                                            <td class="lmost5" align="center" width="10">-</td>
                                            <td class="lmost5">
                                                <nobr>

                                                    <?php if (2 == $lmouserok) { ?>
                                                        <acronym title="<?php echo $text[108] ?>">
                                                            <select class="lmoadminein" name="xteamb<?php echo $i; ?>" onChange="dolmoedit()">
                                                                <?php
                                                                if ((1 == $klfin) && ($st == $anzst) && (1 == $i)) {
                                                                    echo '<option value="0"';

                                                                    if (0 == $teamb[$st - 1][$i]) {
                                                                        echo ' selected';
                                                                    }

                                                                    echo '>' . $teams[0] . '</option>';

                                                                    for ($y = 1; $y <= $anzteams; $y++) {
                                                                        if (2 == $teamt[$y]) {
                                                                            echo '<option value="' . $y . '"';

                                                                            if ($y == $teamb[$st - 1][$i]) {
                                                                                echo ' selected';
                                                                            }

                                                                            echo '>' . $teams[$y] . '</option>';
                                                                        }
                                                                    }
                                                                } else {
                                                                    for ($y = 0; $y <= $anzteams; $y++) {
                                                                        if (0 == $teamt[$y]) {
                                                                            echo '<option value="' . $y . '"';

                                                                            if ($y == $teamb[$st - 1][$i]) {
                                                                                echo ' selected';
                                                                            }

                                                                            echo '>' . $teams[$y] . '</option>';
                                                                        }
                                                                    }
                                                                }
                                                                ?>
                                                            </select>
                                                        </acronym>
                                                    <?php } else {
                                                                    echo $teams[$teamb[$st - 1][$i]];
                                                                } ?>

                                                </nobr>
                                            </td>
                                        <?php } else { ?>
                                            <td class="lmost5" colspan="3">&nbsp;</td>
                                            <?php
                                        }

                if ('-1' == $goala[$st - 1][$i][$n]) {
                    $goala[$st - 1][$i][$n] = '_';
                }

                if ('-1' == $goalb[$st - 1][$i][$n]) {
                    $goalb[$st - 1][$i][$n] = '_';
                } ?>
                                        <td class="lmost5" width="2">&nbsp;</td>
                                        <td class="lmost5" align="right"><acronym title="<?php echo $text[109] ?>"><input class="lmoadminein" type="text" name="xgoala<?php echo $i . $n; ?>" size="4" maxlength="4" value="<?php echo $goala[$st - 1][$i][$n]; ?>"
                                                                                                                          onChange="lmotorgte('a','<?php echo $i . $n; ?>')" onKeyDown="lmotorclk('a','<?php echo $i . $n; ?>',event.keyCode)"></acronym></td>
                                        <td class="lmost5" align="center">
                                            <table cellpadding="0" cellspacing="0" border="0">
                                                <tr>
                                                    <td><a href="javascript:lmotorauf('a','<?php echo $i . $n; ?>',1);" title="<?php echo $text[120]; ?>" onMouseOver="lmoimg('<?php echo $i . $n; ?>a',img1)" onMouseOut="lmoimg('<?php echo $i . $n; ?>a',img0)"><img src="lmo-admin0.gif"
                                                                                                                                                                                                                                                                        name="ximg<?php echo $i . $n; ?>a"
                                                                                                                                                                                                                                                                        width="7" height="7" border="0"></a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><a href="javascript:lmotorauf('a','<?php echo $i . $n; ?>',-1);" title="<?php echo $text[120]; ?>" onMouseOver="lmoimg('<?php echo $i . $n; ?>b',img3)" onMouseOut="lmoimg('<?php echo $i . $n; ?>b',img2)"><img src="lmo-admin2.gif"
                                                                                                                                                                                                                                                                         name="ximg<?php echo $i . $n; ?>b"
                                                                                                                                                                                                                                                                         width="7" height="7"
                                                                                                                                                                                                                                                                         border="0"></a></td>
                                                </tr>
                                            </table>
                                        </td>
                                        <td class="lmost5" align="center" width="8">:</td>
                                        <td class="lmost5" align="right"><acronym title="<?php echo $text[110] ?>"><input class="lmoadminein" type="text" name="xgoalb<?php echo $i . $n; ?>" size="4" maxlength="4" value="<?php echo $goalb[$st - 1][$i][$n]; ?>"
                                                                                                                          onChange="lmotorgte('b','<?php echo $i . $n; ?>')" onKeyDown="lmotorclk('b','<?php echo $i . $n; ?>',event.keyCode)"></acronym></td>
                                        <td class="lmost5" align="center">
                                            <table cellpadding="0" cellspacing="0" border="0">
                                                <tr>
                                                    <td><a href="javascript:lmotorauf('b','<?php echo $i . $n; ?>',1);" title="<?php echo $text[121]; ?>" onMouseOver="lmoimg('<?php echo $i . $n; ?>f',img1)" onMouseOut="lmoimg('<?php echo $i . $n; ?>f',img0)"><img src="lmo-admin0.gif"
                                                                                                                                                                                                                                                                        name="ximg<?php echo $i . $n; ?>f"
                                                                                                                                                                                                                                                                        width="7" height="7" border="0"></a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><a href="javascript:lmotorauf('b','<?php echo $i . $n; ?>',-1);" title="<?php echo $text[121]; ?>" onMouseOver="lmoimg('<?php echo $i . $n; ?>d',img3)" onMouseOut="lmoimg('<?php echo $i . $n; ?>d',img2)"><img src="lmo-admin2.gif"
                                                                                                                                                                                                                                                                         name="ximg<?php echo $i . $n; ?>d"
                                                                                                                                                                                                                                                                         width="7" height="7"
                                                                                                                                                                                                                                                                         border="0"></a></td>
                                                </tr>
                                            </table>
                                        </td>
                                        <td class="lmost5" width="2">&nbsp;</td>
                                        <td class="lmost5">
                                            <acronym title="<?php echo $text[111] ?>">
                                                <select class="lmoadminein" name="xmspez<?php echo $i . $n; ?>" onChange="dolmoedit()">
                                                    <?php
                                                    echo '<option';

                if ('&nbsp;' == $mspez[$st - 1][$i][$n]) {
                    echo ' selected';
                }

                echo '>_</option>';

                echo '<option';

                if ($mspez[$st - 1][$i][$n] == $text[0]) {
                    echo ' selected';
                }

                echo '>' . $text[0] . '</option>';

                echo '<option';

                if ($mspez[$st - 1][$i][$n] == $text[1]) {
                    echo ' selected';
                }

                echo '>' . $text[1] . '</option>'; ?>
                                                </select>
                                            </acronym>
                                        </td>
                                        <td class="lmost5" width="2">&nbsp;</td>
                                        <td class="lmost5"><acronym title="<?php echo $text[112] ?>"><input class="lmoadminein" type="text" name="xmnote<?php echo $i . $n; ?>" size="16" maxlength="255" value="<?php echo $mnote[$st - 1][$i][$n]; ?>" onChange="dolmoedit()"></acronym></td>
                                        <td class="lmost5"><acronym title="<?php echo $text[263] ?>"><input class="lmoadminein" type="text" name="xmberi<?php echo $i . $n; ?>" size="16" maxlength="128" value="<?php echo $mberi[$st - 1][$i][$n]; ?>" onChange="dolmoedit()"></acronym></td>
                                        <?php if (2 == $lmouserok && 1 == $ftest0) { ?>
                                            <td class="lmost5"><acronym title="<?php echo $text[557] ?>">
                                                    <select class="lmoadminein" name="xmtipp<?php echo $i . $n; ?>" onChange="dolmoedit()">
                                                        <?php
                                                        echo '<option value="0"';
                                                        if ($mtipp[$st - 1][$i][$n] < 1) {
                                                            echo ' selected';
                                                        }
                                                        echo '>_</option>';
                                                        echo '<option value="1"';
                                                        if (1 == $mtipp[$st - 1][$i][$n]) {
                                                            echo ' selected';
                                                        }
                                                        echo '>' . $text[699] . '</option>';
                                                        ?>
                                                    </select>
                                                </acronym>
                                            </td>
                                        <?php } ?>
                                    </tr>
                                <?php
            } ?>
                                <?php if (($modus[$st - 1] > 1) && ($i < $anzsp - 1)) { ?>
                                    <tr>
                                        <td class="lmost5" colspan="<?php echo $breite; ?>">&nbsp;</td>
                                    </tr>
                                <?php }
        }
    } ?>
                        <tr>
                            <td class="lmost4" colspan="<?php echo $breite; ?>" align="center">
                                <nobr><?php echo $text[206]; ?></nobr>
                            </td>
                        </tr>
                        <tr>
                            <td class="lmost5" colspan="<?php echo $breite; ?>" align="center">
                                <nobr><acronym title="<?php echo $text[192] ?>"><?php echo $text[191]; ?> <select class="lmoadminein" name="xstx" onChange="dolmoedit()">
                                            <?php
                                            for ($y = 0; $y <= $anzst; $y++) {
                                                echo '<option value="' . $y . '"';

                                                if (1 == $save) {
                                                    if (0 == $y) {
                                                        echo '>' . $text[403] . '</option>';
                                                    } else {
                                                        if ($y == $stx) {
                                                            echo ' selected';
                                                        }

                                                        echo '>' . $y . '. ' . $text[2] . '</option>';
                                                    }
                                                } else {
                                                    if (0 == $y) {
                                                        echo ' selected>' . $text[403] . '</option>';
                                                    } else {
                                                        echo '>' . $y . '. ' . $text[2] . '</option>';
                                                    }
                                                }
                                            } ?>
                                        </select></acronym>
                            </td>
                        </tr>
                        <tr>
                            <td class="lmost5" colspan="<?php echo $breite; ?>" align="center">
                                <acronym title="<?php echo $text[208] ?>"><?php echo $text[207]; ?> <select class="lmoadminein" name="xnticker" onChange="dolmoedit()"><?php echo '<option value="1"';

    if (1 == $nticker) {
        echo ' selected';
    }

    echo '>' . $text[181] . '</option>';

    echo '<option value="0"';

    if (0 == $nticker) {
        echo ' selected';
    }

    echo '>' . $text[182] . '</option>'; ?></select></acronym><br>
                                <acronym title="<?php echo $text[210] ?>"><textarea class="lmoadminein" name="xnlines" cols="50" rows="4" wrap="off" onChange="dolmoedit()"><?php if (count($nlines) > 0) {
        for ($y = 0, $yMax = count($nlines); $y < $yMax; $y++) {
            echo $nlines[$y] . "\n";
        }
    } ?></textarea></acronym>
                            </td>
                        </tr>
                        <tr>
                            <td class="lmost4" colspan="<?php echo $breite; ?>" align="center">
                                <acronym title="<?php echo $text[114] ?>"><input class="lmoadminbut" type="submit" name="best" value="<?php echo $text[103]; ?>"></acronym>
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
        echo "<td class=\"lmost2\" align=\"left\"><a href=\"javascript:chklmolink('" . $addr . $st0 . "');\" title=\"" . $text[6] . '">' . $text[5] . '</a></td>';
    }

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
