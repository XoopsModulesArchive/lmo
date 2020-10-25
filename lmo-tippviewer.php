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
require_once 'lmo-tipptest.php';
if (1 == $viewertipp && 'viewer' == $file) {
    require_once 'lmo-tippcalcpkt.php';

    require_once 'lmo-tippaenderbar.php';

    $verz = opendir(mb_substr($dirliga, 0, -1));

    $dateien = [''];

    while ($files = readdir($verz)) {
        if (file_exists($dirtipp . mb_substr($files, 0, -4) . '_' . $lmotippername . '.tip')) {
            $ftest = 1;

            if (1 != $immeralle) {
                $ftest = 0;

                $ftest1 = '';

                $ftest1 = preg_split('[,]', $ligenzutippen);

                if (isset($ftest1)) {
                    for ($u = 0, $uMax = count($ftest1); $u < $uMax; $u++) {
                        if ($ftest1[$u] == mb_substr($files, 0, -4)) {
                            $ftest = 1;
                        }
                    }
                }
            }

            if (1 == $ftest) {
                $dateien[] = $files;
            }
        }
    }

    closedir($verz);

    array_shift($dateien);

    sort($dateien);

    $anzligen = count($dateien);

    $teams = array_pad($array, 65, '');

    $teams[0] = '___';

    $liga = [''];

    $titel = [''];

    $lmtype = [''];

    $anzst = [''];

    $hidr = [''];

    $dats = [''];

    $datm = [''];

    $spieltag = [''];

    $modus = [''];

    $datum1 = [''];

    $datum2 = [''];

    $spiel = [''];

    $teama = [''];

    $teamb = [''];

    $goala = [''];

    $goalb = [''];

    $mspez = [''];

    $mtipp = [''];

    $mnote = [''];

    $msieg = [''];

    $mterm = [''];

    $tippa = [''];

    $tippb = [''];

    $jksp = [''];

    $jokertippaktiv = ['0'];

    $anzspiele = 0;

    if (!isset($save)) {
        $save = 0;
    }

    if (1 == $save) {
        $start = trim($_POST['xstart']);

        $now1 = trim($_POST['xnow']);

        $then1 = trim($_POST['xthen']);
    } else {
        if (!isset($start)) {
            $start = 0;
        }

        $now1 = strtotime('+' . $start . ' day');

        $then1 = strtotime('+' . ($start + $viewertage) . ' day');
    }

    $now1 = strftime('%d.%m.%Y', $now1);

    $now = mktime(0, 0, 0, mb_substr($now1, 3, 2), mb_substr($now1, 0, 2), mb_substr($now1, -4));

    $then = strftime('%d.%m.%Y', $then1);

    $then = mktime(0, 0, 0, mb_substr($then, 3, 2), mb_substr($then, 0, 2), mb_substr($then, -4));

    $then1 = strftime('%d.%m.%Y', ($then - 1));

    for ($liganr = 0; $liganr < $anzligen; $liganr++) {
        $file = $dirliga . $dateien[$liganr];

        $tippfile = $dirtipp . mb_substr($dateien[$liganr], 0, -4) . '_' . $lmotippername . '.tip';

        require 'lmo-tippopenfileviewer.php';
    }

    array_shift($liga);

    array_shift($titel);

    array_shift($lmtype);

    array_shift($anzst);

    array_shift($hidr);

    array_shift($dats);

    array_shift($datm);

    array_shift($spieltag);

    array_shift($modus);

    array_shift($datum1);

    array_shift($datum2);

    array_shift($spiel);

    array_shift($teama);

    array_shift($teamb);

    array_shift($goala);

    array_shift($goalb);

    array_shift($mspez);

    array_shift($mtipp);

    array_shift($mnote);

    array_shift($msieg);

    array_shift($mterm);

    array_shift($tippa);

    array_shift($tippb);

    if (1 == $save) {
        $now = time();

        $start1 = 0;

        $start2 = 0;

        for ($i = 0; $i < $anzspiele; $i++) {
            $btip = tippaenderbar($mterm[$i], $datum1[$i], $datum2[$i]);

            if (true === $btip) {
                if (1 == $jokertipp && isset($_POST['xjokerspiel_' . $liga[$i] . '_' . $spieltag[$i]])) {
                    $jksp[$i] = trim($_POST['xjokerspiel_' . $liga[$i] . '_' . $spieltag[$i]]);

                    if ($jokertippaktiv[$i] > 0 && $jokertippaktiv[$i] < $now) {
                        $jksp[$i] = 0;
                    } // jokeranticheat
                }

                if (1 == $tippmodus) {
                    $tippa[$i] = trim($_POST['xtippa' . $i]);

                    if ('' == $tippa[$i] || $tippa[$i] < 0) {
                        $tippa[$i] = -1;
                    } elseif ('_' == $tippa[$i]) {
                        $tippa[$i] = -1;
                    } else {
                        $tippa[$i] = (int)trim($tippa[$i]);

                        if ('' == $tippa[$i]) {
                            $tippa[$i] = '0';
                        }
                    }

                    $tippb[$i] = trim($_POST['xtippb' . $i]);

                    if ('' == $tippb[$i] || $tippb[$i] < 0) {
                        $tippb[$i] = -1;
                    } elseif ('_' == $tippb[$i]) {
                        $tippb[$i] = -1;
                    } else {
                        $tippb[$i] = (int)trim($tippb[$i]);

                        if ('' == $tippb[$i]) {
                            $tippb[$i] = '0';
                        }
                    }
                } elseif (0 == $tippmodus) {
                    if (!isset($_POST['xtipp' . $i])) {
                        $_POST['xtipp' . $i] = 0;
                    }

                    if (1 == $_POST['xtipp' . $i]) {
                        $tippa[$i] = '1';

                        $tippb[$i] = '0';
                    } elseif (2 == $_POST['xtipp' . $i]) {
                        $tippa[$i] = '0';

                        $tippb[$i] = '1';
                    } elseif (3 == $_POST['xtipp' . $i]) {
                        $tippa[$i] = '0';

                        $tippb[$i] = '0';
                    } else {
                        $tippa[$i] = '-1';

                        $tippb[$i] = '-1';
                    }
                }
            }

            if ($i == ($anzspiele - 1) || $liga[$i] != $liga[$i + 1]) {
                $tippfile = $dirtipp . $liga[$i] . '_' . $lmotippername . '.tip';

                require 'lmo-tippsavefileviewer.php';

                $start1 = $i + 1;
            }

            if (1 == $akteinsicht && ($i == ($anzspiele - 1) || $spieltag[$i] != $spieltag[$i + 1] || $liga[$i] != $liga[$i + 1])) {
                $einsichtfile = $dirtipp . 'einsicht/' . $liga[$i] . '_' . $spieltag[$i] . '.ein';

                require 'lmo-tippsaveeinsichtviewer.php';

                $start2 = $i + 1;
            }
        }
    }

    if (1 == $showtendenzabs || 1 == $showtendenzpro || (1 == $showdurchschntipp && 1 == $tippmodus)) {
        $tendenz1 = array_pad(['0'], $anzspiele + 1, '0');

        $tendenz0 = array_pad(['0'], $anzspiele + 1, '0');

        $tendenz2 = array_pad(['0'], $anzspiele + 1, '0');

        $toregesa = array_pad(['0'], $anzspiele + 1, '0');

        $toregesb = array_pad(['0'], $anzspiele + 1, '0');

        $anzgetippt = array_pad(['0'], $anzspiele + 1, '0');

        $btip = array_pad(['false'], $anzspiele + 1, '0');

        $start2 = 0;

        for ($i = 0; $i < $anzspiele; $i++) {
            if ($i == ($anzspiele - 1) || $spieltag[$i] != $spieltag[$i + 1] || $liga[$i] != $liga[$i + 1]) {
                $einsichtfile = $dirtipp . 'einsicht/' . $liga[$i] . '_' . $spieltag[$i] . '.ein';

                require 'lmo-tippcalceinsichtviewer.php';

                $start2 = $i + 1;
            }
        }
    }

    $addr = $PHP_SELF . '?action=tipp&amp;todo=edit&amp;file=viewer&amp;start=';

    $breite = 17;

    if (1 == $tippmodus && 1 == $pfeiltipp) {
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

    if (1 == $jokertipp) {
        $breite++;
    }

    $savebutton = 0;

    $file = 'viewer';

    $nw = 0; ?>

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
            <td align="center" class="lmost1">
                <?php echo $text[758] . ' ' . $now1 . ' ' . $text[4] . ' ' . $then1; ?>
            </td>
        </tr>
        <tr>
            <td align="center" class="lmost3">
                <table class="lmostb" cellspacing="0" cellpadding="0" border="0">
                    <form name="lmoedit" action="<?php echo $PHP_SELF; ?>" method="post">

                        <input type="hidden" name="action" value="tipp">
                        <input type="hidden" name="todo" value="edit">
                        <input type="hidden" name="save" value="1">
                        <input type="hidden" name="file" value="viewer">
                        <input type="hidden" name="xstart" value="<?php echo $start; ?>">
                        <input type="hidden" name="xnow" value="<?php echo $now; ?>">
                        <input type="hidden" name="xthen" value="<?php echo $then; ?>">
                        <?php
                        if (0 == $anzspiele) {
                            ?>
                            <tr>
                                <td class="lmost4" colspan="<?php echo $breite; ?>">
                                    <nobr><?php echo $text[762]; ?></nobr>
                                </td>
                            </tr>
                            <?php
                        }

    for ($i = 0; $i < $anzspiele; $i++) {
        if (0 == $i || $liga[$i] != $liga[$i - 1]) {
            ?>
                                <tr>
                                    <td class="lmost4" colspan="<?php echo $breite; ?>">
                                        <nobr><?php echo $titel[$i]; ?></nobr>
                                    </td>
                                </tr>
                                <?php
        }

        if (0 == $i || $liga[$i] != $liga[$i - 1] || $spieltag[$i] != $spieltag[$i - 1]) {
            if ('' != $datum1[$i]) {
                $datum = preg_split('[.]', $datum1[$i]);

                $dum1 = $me[(int)$datum[1]] . ' ' . $datum[2];
            } else {
                $dum1 = '';
            }

            if ('' != $datum2[$i]) {
                $datum = preg_split('[.]', $datum2[$i]);

                $dum2 = $me[(int)$datum[1]] . ' ' . $datum[2];
            } else {
                $dum2 = '';
            }

            if (1 == $lmtype[$i]) {
                if ($spieltag[$i] == $anzst[$i]) {
                    $j = $text[374];
                } elseif ($anzst[$i] - 1 == $spieltag[$i]) {
                    $j = $text[373];
                } elseif ($anzst[$i] - 2 == $spieltag[$i]) {
                    $j = $text[372];
                } elseif ($anzst[$i] - 3 == $spieltag[$i]) {
                    $j = $text[371];
                } else {
                    $j = $spieltag[$i] . '. ' . $text[370];
                }
            } ?>
                                <tr>
                                    <td class="lmost4" colspan="6">
                                        <nobr>
                                            <?php if (1 == $tippeinsicht) {
                echo '<a href="' . $PHP_SELF . '?action=tipp&amp;todo=einsicht&amp;file=' . $dirliga . $liga[$i] . '.l98&amp;st=' . $spieltag[$i] . '">';
            } ?>
                                            <?php if (0 == $lmtype[$i]) {
                echo $spieltag[$i] . '. ' . $text[2];
            } else {
                echo $j;
            } ?>
                                            <?php if (1 == $tippeinsicht) {
                echo '</a>';
            } ?>
                                            <?php if (1 == $dats[$i]) { ?>
                                                <?php if ('' != $datum1[$i]) {
                echo ' ' . $text[3] . ' ' . $datum1[$i];
            } ?>
                                                <?php if ('' != $datum2[$i]) {
                echo ' ' . $text[4] . ' ' . $datum2[$i];
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
                                        <?php if (0 == $hidr[$i]) { ?>
                                            <td class="lmost4" align="center">
                                                <nobr><?php echo '0'; ?></nobr>
                                            </td>
                                        <?php } else { ?>
                                            <td class="lmost4">&nbsp;</td>
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
                                    <td class="lmost4" colspan="2">&nbsp;</td>
                                    <td class="lmost4" colspan="2" align="right">
                                        <nobr><?php echo $text[37]; // PP
                                            ?></nobr>
                                    </td>
                                    <td class="lmost4">&nbsp;</td>
                                </tr>
                                <?php
        }

        if (2 == $einsichterst) {
            if ('_' != $goala[$i] && '_' != $goalb[$i]) {
                $btip1 = false;
            } else {
                $btip1 = true;
            }
        } else {
            $btip1 = false;
        }

        if (1 == $datm[$i]) {
            if ($mterm[$i] > 0) {
                $datf = '%d.%m. %H:%M';

                $dum1 = strftime($datf, $mterm[$i]);
            } else {
                $dum1 = '';
            } ?>
                                <tr>
                                <td class="lmost5">
                                    <nobr><?php echo $dum1; ?></nobr>
                                </td>
                            <?php
        } ?>
                            <td class="lmost5" width="2">&nbsp;</td>
                            <td class="lmost5" align="right">
                                <nobr>
                                    <?php
                                    echo $teama[$i]; ?>
                                </nobr>
                            </td>
                            <td class="lmost5" align="center" width="10">-</td>
                            <td class="lmost5" align="left">
                                <nobr>
                                    <?php
                                    echo $teamb[$i];

        if ('_' == $tippa[$i]) {
            $tippa[$i] = '';
        }

        if ('_' == $tippb[$i]) {
            $tippb[$i] = '';
        }

        if ('-1' == $tippa[$i]) {
            $tippa[$i] = '';
        }

        if ('-1' == $tippb[$i]) {
            $tippb[$i] = '';
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
                            <?php }

        $plus = 1;

        $btip = tippaenderbar($mterm[$i], $datum1[$i], $datum2[$i]);

        if (true === $btip) {
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
                                <?php }

            if (true === $btip) { ?>
                                    <td class="lmost5" align="right"><acronym title="<?php echo $text[741] ?>"><input class="lmoadminein" type="text" name="xtippa<?php echo $i; ?>" size="4" maxlength="4" value="<?php echo $tippa[$i]; ?>" onKeyDown="lmotorclk('a','<?php echo $i; ?>',event.keyCode)"></acronym>
                                    </td>
                                    <?php if (1 == $pfeiltipp) { ?>
                                        <td class="lmost5" align="center">
                                            <table cellpadding="0" cellspacing="0" border="0">
                                                <tr>
                                                    <td><a href="javascript:lmotorauf('a','<?php echo $i; ?>',1);" title="<?php echo $text[743]; ?>" onMouseOver="lmoimg('<?php echo $i; ?>a',img1)" onMouseOut="lmoimg('<?php echo $i; ?>a',img0)"><img src="lmo-admin0.gif" name="ximg<?php echo $i; ?>a"
                                                                                                                                                                                                                                                         width="7" height="7" border="0"></a></td>
                                                </tr>
                                                <tr>
                                                    <td><a href="javascript:lmotorauf('a','<?php echo $i; ?>',-1);" title="<?php echo $text[743]; ?>" onMouseOver="lmoimg('<?php echo $i; ?>b',img3)" onMouseOut="lmoimg('<?php echo $i; ?>b',img2)"><img src="lmo-admin2.gif" name="ximg<?php echo $i; ?>b"
                                                                                                                                                                                                                                                          width="7" height="7" border="0"></a></td>
                                                </tr>
                                            </table>
                                        </td>
                                    <?php }
                                } else {
                                    if (1 == $pfeiltipp) { ?>
                                        <td class="lmost5">&nbsp;</td>
                                    <?php } ?>
                                    <td class="lmost5" align="right"><?php echo $tippa[$i]; ?></td>
                                <?php
                                } ?>
                                <td class="lmost5" width="2">:</td>
                                <?php if (true === $btip) { ?>
                                    <td class="lmost5" align="right"><acronym title="<?php echo $text[742] ?>"><input class="lmoadminein" type="text" name="xtippb<?php echo $i; ?>" size="4" maxlength="4" value="<?php echo $tippb[$i]; ?>" onKeyDown="lmotorclk('b','<?php echo $i; ?>',event.keyCode)"></acronym>
                                    </td>
                                    <?php if (1 == $pfeiltipp) { ?>
                                        <td class="lmost5" align="center">
                                            <table cellpadding="0" cellspacing="0" border="0">
                                                <tr>
                                                    <td><a href="javascript:lmotorauf('b','<?php echo $i; ?>',1);" title="<?php echo $text[744]; ?>" onMouseOver="lmoimg('<?php echo $i; ?>f',img1)" onMouseOut="lmoimg('<?php echo $i; ?>f',img0)"><img src="lmo-admin0.gif" name="ximg<?php echo $i; ?>f"
                                                                                                                                                                                                                                                         width="7" height="7" border="0"></a></td>
                                                </tr>
                                                <tr>
                                                    <td><a href="javascript:lmotorauf('b','<?php echo $i; ?>',-1);" title="<?php echo $text[744]; ?>" onMouseOver="lmoimg('<?php echo $i; ?>d',img3)" onMouseOut="lmoimg('<?php echo $i; ?>d',img2)"><img src="lmo-admin2.gif" name="ximg<?php echo $i; ?>d"
                                                                                                                                                                                                                                                          width="7" height="7" border="0"></a></td>
                                                </tr>
                                            </table>
                                        </td>
                                    <?php } ?>
                                <?php } else { ?>
                                    <td class="lmost5"><?php echo $tippb[$i]; ?></td>
                                    <?php if (1 == $pfeiltipp) { ?>
                                        <td class="lmost5">&nbsp;</td>
                                    <?php } ?>
                                <?php } ?>
                            <?php
        } // ende ($tippmodus==1)?>
                            <?php if (0 == $tippmodus) {
            $tipp = -1;

            if ('' == $tippa[$i] || '' == $tippb[$i]) {
                $tipp = -1;
            } elseif ($tippa[$i] > $tippb[$i]) {
                $tipp = 1;
            } elseif ($tippa[$i] == $tippb[$i]) {
                $tipp = 0;
            } elseif ($tippa[$i] < $tippb[$i]) {
                $tipp = 2;
            } ?>
                                <td class="lmost5" align="center"><acronym title="<?php echo $text[595] ?>"><input type="radio" name="xtipp<?php echo $i; ?>" value="1" <?php if (1 == $tipp) {
                echo ' checked';
            }

            if (false === $btip) {
                echo ' disabled';
            } ?>></acronym></td>
                                <?php if (0 == $hidr[$i]) { ?>
                                    <td class="lmost5" align="center"><acronym title="<?php echo $text[596] ?>"><input type="radio" name="xtipp<?php echo $i; ?>" value="3" <?php if (0 == $tipp) {
                echo ' checked';
            }
                                            if (false === $btip) {
                                                echo ' disabled';
                                            } ?>></acronym></td>
                                <?php } else { ?>
                                    <td class="lmost5">&nbsp;</td>
                                <?php } ?>
                                <td class="lmost5" align="center"><acronym title="<?php echo $text[597] ?>"><input type="radio" name="xtipp<?php echo $i; ?>" value="2" <?php if (2 == $tipp) {
                                                echo ' checked';
                                            }

            if (false === $btip) {
                echo ' disabled';
            } ?>></acronym></td>
                            <?php
        } // ende ($tippmodus==0)?>
                            <?php if (1 == $jokertipp) {
            if ($jokertippaktiv[$i] > 0 && $jokertippaktiv[$i] < time()) {
                $btip = false;
            } ?>
                                <td class="lmost5" align="center"><acronym title="<?php echo $text[903] ?>"><input type="radio" name="xjokerspiel_<?php echo $liga[$i] . '_' . $spieltag[$i]; ?>" value="<?php echo $spiel[$i]; ?>" <?php if ($jksp[$i] == $spiel[$i]) {
                echo ' checked';
            }

            if (false === $btip) {
                echo ' disabled';
            } ?>></acronym></td>
                            <?php
        } ?>
                            <td class="lmost7" align="right"><?php echo $goala[$i]; ?></td>
                            <td class="lmost7" width="2">:</td>
                            <td class="lmost7" align="left"><?php echo $goalb[$i]; ?></td>
                            <td class="lmost7" width="2">&nbsp;</td>
                            <td class="lmost7"><?php echo $mspez[$i]; ?></td>
                            <td class="lmost5" width="2">&nbsp;</td>
                            <td class="lmost5" align="right"><strong>
                                    <?php
                                    if (1 == $jokertipp && $jksp[$i] == $spiel[$i]) {
                                        $jkspfaktor = $jokertippmulti;
                                    } else {
                                        $jkspfaktor = 1;
                                    }

        $punktespiel = -1;

        if ('' != $tippa[$i] && '' != $tippb[$i] && '_' != $goala[$i] && '_' != $goalb[$i]) {
            $punktespiel = tipppunkte($tippa[$i], $tippb[$i], $goala[$i], $goalb[$i], $msieg[$i], $mspez[$i], $text[0], $text[1], $jkspfaktor, $mtipp[$i]);
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
        } ?>
                                    </b></td>
                            <td class="lmost5">

                                <?php
                                if (('' != $mnote[$i]) || ($msieg[$i] > 0) || ($mtipp[$i] > 0)) {
                                    $dummy = addslashes($teama[$i] . ' - ' . $teamb[$i] . ' ' . $goala[$i] . ':' . $goalb[$i]);

                                    if (3 == $msieg[$i]) {
                                        $dummy .= ' / ' . $goalb[$i] . ':' . $goala[$i];
                                    }

                                    $dummy .= ' ' . $mspez[$i];

                                    if (1 == $msieg[$i]) {
                                        $dummy .= '\\n\\n' . $text[219] . ':\\n' . addslashes($teama[$i] . ' ' . $text[211]);
                                    }

                                    if (2 == $msieg[$i]) {
                                        $dummy .= '\\n\\n' . $text[219] . ':\\n' . addslashes($teamb[$i] . ' ' . $text[211]);
                                    }

                                    if (3 == $msieg[$i]) {
                                        $dummy .= '\\n\\n' . $text[219] . ':\\n' . addslashes($text[212]);
                                    }

                                    if ('' != $mnote[$i]) {
                                        $dummy .= '\\n\\n' . $text[22] . ':\\n' . $mnote[$i];
                                    }

                                    if (1 == $mtipp[$i]) {
                                        $dummy .= '\\n\\n' . $text[731] . '\\n';
                                    }

                                    echo "<a href=\"javascript:alert('" . $dummy . "');\" title=\"" . str_replace('\\n', '&#10;', $dummy) . '"><img src="lmo-st2.gif" width="16" height="16" border="0"></a>';
                                } else {
                                    echo '&nbsp;';
                                } ?>
                            </td>
                            </tr>
                        <?php
    } ?>

                        <tr>
                            <td class="lmost4" colspan="<?php echo $breite; ?>" align="right">
                                <nobr>
                                    <?php if (1 == $savebutton) { ?>
                                        <acronym title="<?php echo $text[114] ?>"><input class="lmoadminbut" type="submit" name="best" value="<?php echo $text[508]; ?>"></acronym>
                                    <?php } ?>
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
                        echo '<td align="left" class="lmost2">&nbsp;<a href="' . $addr . ($start - $viewertage) . '&amp;PHPSESSID=' . $PHPSESSID . '" title="' . $viewertage . ' ' . $text[757] . "\"><img src=\"./images/left.gif\" width='9' height='9' border=\"0\"></a></td>";

    echo '<td align="right" class="lmost2"><a href="' . $addr . ($start + $viewertage) . '&amp;PHPSESSID=' . $PHPSESSID . '" title="' . $viewertage . ' ' . $text[756] . "\"><img src=\"./images/right.gif\" width='9' height='9' border=\"0\"></a>&nbsp;</td>"; ?>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <?php
}
$einsichtfile = '';
$tippfile = '';
?>
