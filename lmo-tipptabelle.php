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
if ('' != $file && 1 == $tipptabelle1) {
    if (0 == $endtab) {
        $endtab = $anzst;

        $tabdat = '';
    } else {
        $tabdat = $endtab . '. ' . $text[2];
    }

    if (!isset($tabtype)) {
        $tabtype = 0;
    }

    if (!isset($nick)) {
        $nick = $lmotippername;
    }

    if (1 == $einsichterst) {
        require_once 'lmo-tippaenderbar.php';
    }

    if ('' != $file) {
        if ('' != $nick) {
            $m = 0;

            $tippfile = $dirtipp . mb_substr($file, mb_strrpos($file, '/') + 1, -4) . '_' . $nick . '.tip';

            require 'lmo-tippopenfileall.php';

            $anztipper = 1;

            if (($endtab > 1) && (0 == $tabtype) && ('' != $tabdat)) {
                $endtab--;

                require 'lmo-tippcalctable.php';

                $endtab++;

                $platz1 = [''];

                $platz1 = array_pad($array, $anzteams + 1, '');

                for ($x = 0; $x < $anzteams; $x++) {
                    $x3 = (int)mb_substr($tab0[$x], 42);

                    $platz1[$x3] = $x + 1;
                }
            }

            require 'lmo-tippcalctable.php';
        } elseif (1 == $tipptabelle) { // alle Tipper
            $tabdat = '';

            $verz = opendir($dirtipp);

            $dummy = [''];

            $liga = mb_substr($file, mb_strrpos($file, '/') + 1, -4);

            while ($files = readdir($verz)) {
                if (mb_strtolower(mb_substr($files, 0, mb_strrpos($files, '_'))) == mb_strtolower($liga) && '.tip' == mb_strtolower(mb_substr($files, -4))) {
                    $dummy[] = $files;
                }
            }

            closedir($verz);

            array_shift($dummy);

            $anztipper = count($dummy);

            for ($m = 0; $m < $anztipper; $m++) {
                $nick = mb_substr($dummy[$m], mb_strrpos($dummy[$m], '_') + 1, -4);

                $tippfile = $dirtipp . mb_substr($file, mb_strrpos($file, '/') + 1, -4) . '_' . $nick . '.tip';

                require 'lmo-tippopenfileall.php';

                require 'lmo-tippcalctable.php';
            }

            $nick = '';
        }
    }

    $platz0 = [''];

    $platz0 = array_pad($array, $anzteams + 1, '');

    for ($x = 0; $x < $anzteams; $x++) {
        $x3 = (int)mb_substr($tab0[$x], 42);

        $platz0[$x3] = $x + 1;
    }

    if ('' == $tabdat) {
        $addt1 = $PHP_SELF . '?action=tipp&amp;todo=tabelle&amp;file=' . $file . '&amp;PHPSESSID=' . $PHPSESSID . '&amp;nick=' . $nick . '&amp;tabtype=';
    } else {
        $addt1 = $PHP_SELF . '?action=tipp&amp;todo=tabelle&amp;file=' . $file . '&amp;endtab=' . $endtab . '&amp;PHPSESSID=' . $PHPSESSID . '&amp;nick=' . $nick . '&amp;tabtype=';
    }

    $addt2 = $PHP_SELF . '?action=tipp&amp;todo=tabelle&amp;file=' . $file . '&amp;PHPSESSID=' . $PHPSESSID . '&amp;tabtype=' . $tabtype . '&amp;nick=' . $nick . '&amp;endtab=';

    $addt = $PHP_SELF . '?action=tipp&amp;todo=tabelle&amp;file=' . $file . '&amp;endtab=&amp;PHPSESSID=' . $PHPSESSID . '&amp;nick='; ?>

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
        <?php if ('' != $nick) { ?>
            <tr>
                <td align="center">
                    <table cellspacing="0" cellpadding="0" border="0">
                        <tr>
                            <?php
                            $hoy1 = 1;
                            //  if ($tabtype==3){$hoy1=($anzst/2+1);}
                            if (3 != $tabtype and 4 != $tabtype) {
                                echo '<td align="right" valign="top" class="lmost1" colspan="3" rowspan="4">';

                                if (1 == $lmtype) {
                                    echo $text[370];
                                } else {
                                    echo $text[2];
                                }

                                echo ':';

                                echo '&nbsp;</td>';

                                for ($i = $hoy1; $i <= $anzst; $i++) {
                                    echo '<td align="right" ';

                                    if (($i != $endtab) || (($i == $endtab) && ('' == $tabdat))) {
                                        echo 'class="lmost0"><a href="' . $addt2 . $i . '" title="' . $text[9] . '">' . $i . '</a>';
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
                                    } elseif (($anzst > 25) && (0 == ($anzst % 2))) {
                                        if ($i == $anzst / 2) {
                                            echo '</tr><tr>';
                                        }
                                    }
                                }
                            }
                            ?>
                        <tr>
                    </table>
                </td>
            </tr>
        <?php } // ende if($nick!="")?>
        <tr>
            <td class="lmost4" align="center">
                <?php if ($nick == $lmotippername && '' != $nick) {
                                echo $text[673];
                            } elseif ('' != $nick) {
                                echo $text[681] . ' ' . $nick;
                            } else {
                                echo $text[684];
                            } ?>
            </td>
        </tr>
        <?php if ('' != $nick) { ?>
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
                            echo '<td ';
                            $i += 1;
                            include 'lmo-zustat-config.php';
                            if ($i != $tabtype && 1 == $einhinrueck) {
                                echo 'class="lmost0"><a href="' . $addt1 . $i . '" title="' . $text[490] . '">' . $text[490] . '</a>';
                            } elseif (1 == $einhinrueck) {
                                echo 'class="lmost1">' . $text[490];
                            }
                            echo '&nbsp;</td>';

                            echo '<td ';
                            $i -= 1;
                            if ($i != $tabtype && 1 == $einhinrueck) {
                                echo 'class="lmost0"><a href="' . $addt1 . $i . '" title="' . $text[476] . '">' . $text[476] . '</a>';
                            } elseif (1 == $einhinrueck) {
                                echo 'class="lmost1">' . $text[476];
                            }
                            echo '&nbsp;</td>';
                            ?>
                        <tr>
                    </table>
                </td>
            </tr>
        <?php } // ende if($nick!="")

    if (2 == $minus) {
        $dummy = ' colspan="3" align="center"';
    } else {
        $dummy = ' align="right"';
    } ?>
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
                        <?php if (1 == $tippmodus) { ?>
                            <td class="lmost4" width="2">&nbsp;</td>
                            <td class="lmost4" colspan="3" align="center"><?php echo $text[38]; ?></td>
                            <td class="lmost4" align="right"><?php echo $text[39]; ?></td>
                        <?php } ?>
                        <?php if (1 == $tabpkt) {
        echo '<td class="lmost4" width="2">&nbsp;</td><td class="lmost4"' . $dummy . '>' . $text[37] . '</td>';
    } ?>
                        <td class="lmost4" align="right"><?php echo $text[37] . '/' . $text[33]; ?></td>
                    </tr>

                    <?php
                    $j = 1;

    for ($x = 1; $x <= $anzteams; $x++) {
        $i = (int)mb_substr($tab0[$x - 1], 42);

        if ($i == $favteam) {
            $dummy = '<strong>';

            $dumm2 = '</strong>';
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
                                echo '<td class="' . $dumm1 . '" width="2">&nbsp;</td><td class="' . $dumm1 . '" align="right">' . $punkte[$i] . '</td>';

                                if (2 == $minus) {
                                    echo '<td class="' . $dumm1 . '" align="center" width="4">' . ':' . '</td>';

                                    echo '<td class="' . $dumm1 . '">' . $negativ[$i] . '</td>';
                                }
                            }

        if (1 == $tippmodus) {
            ?>
                                <td class="<?php echo $dumm1; ?>" width="2">&nbsp;</td>
                                <td class="<?php echo $dumm1; ?>" align="right"><?php echo $dummy . $etore[$i] . $dumm2; ?></td>
                                <td class="<?php echo $dumm1; ?>" align="center" width="4"><?php echo $dummy; ?>:<?php echo $dumm2; ?></td>
                                <td class="<?php echo $dumm1; ?>"><?php echo $dummy . $atore[$i] . $dumm2; ?></td>
                                <td class="<?php echo $dumm1; ?>" align="right"><?php echo $dummy . $dtore[$i] . $dumm2; ?></td>
                                <?php
        }

        if (1 == $tabpkt) {
            echo '<td class="' . $dumm1 . '" width="2">&nbsp;</td><td class="' . $dumm1 . '" align="right">' . $punkte[$i] . '</td>';

            if (2 == $minus) {
                echo '<td class="' . $dumm1 . '" align="center" width="4">' . ':' . '</td>';

                echo '<td class="' . $dumm1 . '">' . $negativ[$i] . '</td>';
            }
        } ?>
                            <td class="<?php echo $dumm1; ?>" align="right"><b><?php echo $dummy . number_format($quote[$i] / 100, 2, '.', ',') . $dumm2; ?></b></td>
                        </tr>
                    <?php
    } ?>

                </table>
            </td>
        </tr>


        <?php if (1 == $wertverein && 0 == $tabtype) { ?>
            <tr>
                <td><?php echo '&nbsp;' ?></td>
            </tr>
            <tr>
                <td class="lmost4" align="center"><?php echo $text[761]; ?></td>
            </tr>
            <?php
            $st = $endtab;

            if ('' != $nick) {
                $m = 0;

                $auswertfile = $dirtipp . 'auswert/vereine/' . mb_substr($file, mb_strrpos($file, '/') + 1, -4) . '_' . $nick . '.ver';

                if (($endtab > 1) && (0 == $tabtype) && ('' != $tabdat)) {
                    $endtab--;

                    require 'lmo-tippcalcwertverein.php';

                    $platz1 = [''];

                    $platz1 = array_pad($array, $anzteams + 1, '');

                    for ($x = 0; $x < $anzteams; $x++) {
                        $x3 = (int)mb_substr($tab0[$x], 25);

                        $platz1[$x3] = $x + 1;
                    }

                    $endtab++;
                }

                require 'lmo-tippcalcwertverein.php';
            } elseif (1 == $tipptabelle) { // alle Tipper
                $tabdat = '';

                $verz = opendir($dirtipp . 'auswert/vereine/');

                $dummy = [''];

                $liga = mb_substr($file, mb_strrpos($file, '/') + 1, -4);

                while ($files = readdir($verz)) {
                    if (mb_strtolower(mb_substr($files, 0, mb_strrpos($files, '_'))) == mb_strtolower($liga) && '.ver' == mb_strtolower(mb_substr($files, -4))) {
                        $dummy[] = $files;
                    }
                }

                closedir($verz);

                array_shift($dummy);

                $anztipper = count($dummy);

                for ($m = 0; $m < $anztipper; $m++) {
                    $nick = mb_substr($dummy[$m], mb_strrpos($dummy[$m], '_') + 1, -4);

                    $auswertfile = $dirtipp . 'auswert/vereine/' . mb_substr($file, mb_strrpos($file, '/') + 1, -4) . '_' . $nick . '.ver';

                    require 'lmo-tippcalcwertverein.php';
                }

                $nick = '';
            }

            $platz0 = [''];
            if (!isset($anzteams)) {
                $anzteams = 0;
            }
            $platz0 = array_pad($array, $anzteams + 1, '');
            for ($x = 0; $x < $anzteams; $x++) {
                $x3 = (int)mb_substr($tab0[$x], 25);

                $platz0[$x3] = $x + 1;
            }
            ?>
            <tr>
                <td align="center" class="lmost3">
                    <table class="lmostb" cellspacing="0" cellpadding="0" border="0">
                        <tr>
                            <td class="lmost4" colspan="3">
                                <?php
                                $dummy = ' align="right"';
                                echo $tabdat;
                                ?>
                            </td>
                            <td class="lmost4" width="2">&nbsp;</td>
                            <td class="lmost4"<?php echo $dummy; ?>>
                                <?php echo $text[33]; // Spiele getippt?></td>
                            <td class="lmost4" width="2">&nbsp;</td>
                            <td class="lmost4"<?php echo $dummy; ?>>
                                <?php
                                if (1 == $tippmodus) {
                                    echo $text[37];
                                } else {
                                    echo $text[622];
                                }
                                ?></td>
                            <td class="lmost4" width="2">&nbsp;</td>
                            <td class="lmost4"<?php echo $dummy; ?>><b>
                                    <?php
                                    if (1 == $tippmodus) {
                                        echo $text[37] . '/' . $text[33];
                                    } else {
                                        echo $text[623] . '&#37;';
                                    }
                                    ?></b></td>
                        </tr>
                        <?php
                        $j = 1;
                        $spv = -1;
                        $ppv = -1;
                        for ($x = 1; $x <= $anzteams; $x++) {
                            $i = (int)mb_substr($tab0[$x - 1], 25);

                            if ($team[$i] == $favteam) { // favteam
                                $dummy = '<b>';

                                $dumm2 = '</b>';
                            } else {
                                $dummy = '';

                                $dumm2 = '';
                            }

                            $dumm1 = 'lmost5'; ?>
                            <tr>
                                <td class="<?php echo $dumm1; ?>" align="right">
                                    <?php
                                    echo $dummy . $x . $dumm2; ?>
                                </td>
                                <?php
                                $y = 0;

                            if (($endtab > 1) && ('' != $tabdat) && $tipppunktegesamt[(int)mb_substr($tab0[0], 25)] > 0) {
                                if ($platz0[$i] < $platz1[$i]) {
                                    $y = 1;
                                } elseif ($platz0[$i] > $platz1[$i]) {
                                    $y = 2;
                                }
                            }

                            if ('' != $tabdat) {
                                echo '<td class="' . $dumm1 . '"';

                                echo '><img src="lmo-tab' . $y . '.gif" width="9" height="9" border="0">';

                                echo '</td>';
                            } else {
                                echo '<td class="' . $dumm1 . '">&nbsp;</td>';
                            } ?>
                                <td class="<?php echo $dumm1; ?>"><?php echo $dummy . $teams[$team[$i]] . $dumm2; ?></td>
                                <?php
                                echo '<td class="' . $dumm1 . '" width="2">&nbsp;</td><td class="' . $dumm1 . '" align="right">';

                            echo $dummy . $spielegetippt[$i] . $dumm2;

                            echo '</td>';

                            echo '<td class="' . $dumm1 . '" width="2">&nbsp;</td><td class="' . $dumm1 . '" align="right">';

                            echo $dummy . $tipppunktegesamt[$i] . $dumm2;

                            echo '</td>';

                            $quote = 0;

                            if (0 != $spielegetippt[$i]) {
                                if (1 == $tippmodus) {
                                    $quote = number_format($tipppunktegesamt[$i] / $spielegetippt[$i], 2, '.', ',');
                                }

                                if (0 == $tippmodus) {
                                    $quote = number_format($tipppunktegesamt[$i] / $spielegetippt[$i] * 100, 2, '.', ',');
                                }
                            }

                            echo '<td class="' . $dumm1 . '" width="2">&nbsp;</td><td class="' . $dumm1 . '" align="right">';

                            echo $dummy . '<b>' . $quote . '</b>' . $dumm2;

                            echo '</td>';

                            $spv = $spielegetippt[$i]; // merken
                                $ppv = $tipppunktegesamt[$i]; ?>
                            </tr>
                            <?php
                        } // ende for($x=1;$x<=$anzteams;$x++)
                        ?>

                    </table>
                </td>
            </tr>
        <?php } ?>







        <?php
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
        <tr>
            <td class="lmocross4" align="center">
                <?php if ($nick != $lmotippername && '' != $lmotippername) {
                                echo '<a href="' . $addt . $lmotippername . '" title="' . $text[673] . '">' . $text[682] . '</a>';
                            }

    echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';

    if ('' != $nick && 1 == $tipptabelle) {
        echo '<a href="' . $addt . '" title="' . $text[684] . '">' . $text[683] . '</a>';
    } ?>
            </td>
        </tr>
    </table>
<?php
} ?>

