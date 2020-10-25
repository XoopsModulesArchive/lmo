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
function getmicrotime()
{
    [$usec, $sec] = explode(' ', microtime());

    return ((float)$usec + (float)$sec);
}

$startzeit = getmicrotime();
if ('tipp' == $action) {
    if (!isset($lmotippername)) {
        $lmotippername = '';
    }

    if (!isset($lmotipperpass)) {
        $lmotipperpass = '';
    }

    if (!isset($lmotipperverein)) {
        $lmotipperverein = '';
    }

    if ($HTTP_SESSION_VARS['lmotipperok'] < 1 && $HTTP_SESSION_VARS['lmotipperok'] > -4) {
        $xtippername2 = '';

        if (isset($xtippername) && isset($xtipperpass)) {
            $lmotippername = $xtippername;

            $lmotipperpass = $xtipperpass;

            $dumma = [''];

            $pswfile = $tippauthtxt;

            $datei = fopen($pswfile, 'rb');

            while (!feof($datei)) {
                $zeile = fgets($datei, 1000);

                $zeile = rtrim($zeile);

                if ('' != $zeile) {
                    $dumma[] = $zeile;
                }
            }

            fclose($datei);

            array_shift($dumma);

            $HTTP_SESSION_VARS['lmotipperok'] = -2;

            for ($i = 0; $i < count($dumma) && -2 == $HTTP_SESSION_VARS['lmotipperok']; $i++) {
                $dummb = preg_split('[|]', $dumma[$i]);

                if ($lmotippername == $dummb[0]) { // Nick gefunden
                    $HTTP_SESSION_VARS['lmotipperok'] = -1;

                    if ($lmotipperpass == $dummb[1]) { // Passwort richtig
                        $lmotipperverein = $dummb[5];

                        $HTTP_SESSION_VARS['lmotipperok'] = $dummb[2];

                        if (5 == $HTTP_SESSION_VARS['lmotipperok']) {
                            array_shift($dumma);
                        }
                    }
                }
            }
        }
    }

    if (-5 == $HTTP_SESSION_VARS['lmotipperok']) { // Passwort-Anforderung
        require 'lmo-tippemailpass.php';
    }

    if ($HTTP_SESSION_VARS['lmotipperok'] < 1 && $HTTP_SESSION_VARS['lmotipperok'] > -4) {
        $addw = $PHP_SELF . '?action=tipp&amp;todo=wert&amp;file=';

        $adda = $PHP_SELF . '?action=tipp&amp;todo=';

        if (('wert' == $todo && 1 != $all) || 'fieber' == $todo || 'edit' == $todo) {
            require 'lmo-openfilename.php';
        } elseif ('einsicht' == $todo) {
            require 'lmo-openfilest.php';
        } elseif ('tabelle' == $todo) {
            require 'lmo-openfile.php';
        } elseif ('wert' == $todo && 1 == $all) {
        } ?>

        <table class="lmomaina" cellspacing="0" cellpadding="0" border="0">
            <tr>
                <td class="lmomain0" colspan="3" align="center">
                    <nobr>
                        <?php echo $text[500] . ' ';

        if (isset($titel)) {
            echo $titel;
        } ?>
                    </nobr>
                </td>
            </tr>
            <tr>
                <td class="lmomain1" align="left">
                    <nobr>

                        <?php
                        echo '&nbsp;&nbsp;';

        if ('' != $todo && 'logout' != $todo) {
            echo '<a href="' . $PHP_SELF . '?action=tipp" title="' . $text[553] . '">' . $text[552] . '</a>';
        } else {
            echo $text[552];
        }

        echo '&nbsp;&nbsp;';

        if ('' != $file && 'viewer' != $file) {
            if (1 == $tippeinsicht) {
                if ('einsicht' != $todo) {
                    echo '<a href="' . $adda . 'einsicht&amp;file=' . $file . '" title="' . $text[657] . '">' . $text[657] . '</a>';
                } else {
                    echo $text[657];
                }

                echo '&nbsp;&nbsp;';
            }

            if (0 == $lmtype && 1 == $tipptabelle1 && 1 == $tipptabelle) {
                if ('tabelle' != $todo) {
                    echo '<a href="' . $adda . 'tabelle&amp;file=' . $file . '&amp;endtab=' . $endtab . '&amp;nick=" title="' . $text[684] . '">' . $text[672] . '</a>';
                } else {
                    echo $text[672];
                }

                echo '&nbsp;&nbsp;';
            }

            if (1 == $tippfieber) {
                if ('fieber' != $todo) {
                    echo '<a href="' . $adda . 'fieber&amp;file=' . $file . '" title="' . $text[134] . '">' . $text[133] . '</a>';
                } else {
                    echo $text[133];
                }

                echo '&nbsp;&nbsp;';
            }

            if ('wert' != $todo || 1 == $all) {
                echo '<a href="' . $adda . 'wert&amp;file=' . $file . '" title="' . $text[554] . '">' . $text[554] . '</a>';
            } else {
                echo $text[554];
            }

            echo '&nbsp;&nbsp;';
        }

        /*    if($gesamt==1){
              if($todo!="wert" || $all!=1){echo "<a href=\"".$adda."wert&amp;file=".$file."&amp;all=1\" title=\"".$text[556]."\">".$text[556]."</a>";}
              else{echo $text[556];}
              }
        */

        echo '&nbsp;&nbsp;'; ?>
                    </nobr>
                </td>
                <td class="lmomain1" width="8">&nbsp;</td>
                <td class="lmomain1" align="right">
                    <nobr>
                        <?php
                        if (1 == $regeln) {
                            echo '<a href="' . $regelnlink . '">' . $text[685] . '</a>';

                            echo '&nbsp;&nbsp;';
                        }

        if ('' != $todo && 'logout' != $todo) {
            echo '<a href="' . $PHP_SELF . '?action=tipp" title="' . $text[659] . '">' . $text[659] . '</a>';
        } else {
            echo $text[659];
        }

        echo '&nbsp;&nbsp;';

        if ('info' != $todo) {
            echo '<a href="' . $adda . 'info&amp;file=' . $file . '" title="' . $text[21] . '">' . $text[20] . '</a>';
        } else {
            echo $text[20];
        }

        echo '&nbsp;'; ?>

                    </nobr>
                </td>
            </tr>
            <tr>
                <td class="lmomain1" colspan="3" align="center">

                    <?php
                    if ('wert' == $todo) {
                        require 'lmo-tippwert.php';
                    } elseif ('fieber' == $todo) {
                        require 'lmo-tippfieber.php';
                    } elseif ('einsicht' == $todo) {
                        require 'lmo-tippeinsicht.php';
                    } elseif ('tabelle' == $todo) {
                        require 'lmo-tipptabelle.php';
                    } elseif ('info' == $todo) {
                        require 'lmo-showinfo.php';
                    } else {
                        ?>

                        <table class="lmosta" width="100%" cellspacing="0" cellpadding="0" border="0">
                            <tr>
                                <td align="center" class="lmost1">
                                    <font color=black><?php echo $text[658]; ?></font>
                                </td>
                            </tr>
                            <tr>
                                <td align="center" class="lmost3">
                                    <table width="100%" class="lmostb" cellspacing="0" cellpadding="0" border="0">
                                        <form name="lmotippedit" action="<?php echo $PHP_SELF; ?>" method="post">

                                            <input type="hidden" name="action" value="tipp">
                                            <tr>
                                                <td class="lmost4" colspan="2">
                                                    <nobr><?php echo $text[544]; ?></nobr>
                                                </td>
                                            </tr>
                                            <?php if (-2 == $HTTP_SESSION_VARS['lmotipperok']) { // Benutzer nicht gefunden?>
                                                <tr>
                                                    <td class="lmost5" align="right" colspan="2"><font color=red><?php echo $text[543]; ?></font></td>
                                                </tr>
                                            <?php } ?>
                                            <?php if (isset($xtippersub) & '' == $HTTP_SESSION_VARS['lmotipperok'] && !isset($emailbody)) { // Benutzer nicht freigeschaltet?>
                                                <tr>
                                                    <td class="lmost5" align="right" colspan="2"><font color=red><?php echo $text[648]; ?></font></td>
                                                </tr>
                                            <?php } ?>
                                            <tr>
                                                <td class="lmost5" align="right"><acronym title="<?php echo $text[307] ?>"><?php echo ' ' . $text[523]; ?></acronym></td>
                                                <td class="lmost5"><acronym title="<?php echo $text[307] ?>"><input class="lmoadminein" type="text" name="xtippername" size="16" maxlength="32" value="<?php echo $lmotippername; ?>"></acronym></a>
                                            </tr>
                                            <tr>
                                                <?php if (-1 == $HTTP_SESSION_VARS['lmotipperok']) {
                            $xtippername2 = $lmotippername; // Passwort falsch?>
                                            <tr>
                                                <td class="lmost5" align="right" colspan="2"><font color=red><?php echo $text[542]; ?></font></td>
                                            </tr>
                                        <?php
                        } ?>
                                            <tr>
                                                <td class="lmost5" align="right"><acronym title="<?php echo $text[309] ?>"><?php echo ' ' . $text[308]; ?></acronym></td>
                                                <td class="lmost5"><acronym title="<?php echo $text[309] ?>"><input class="lmoadminein" type="password" name="xtipperpass" size="16" maxlength="32" value="<?php echo $lmotipperpass; ?>"></acronym></a>
                                            </tr>
                                            <tr>
                                                <td class="lmost5">&nbsp;</td>
                                                <td class="lmost5"><acronym title="<?php echo $text[311] ?>"><input class="lmoadminbut" type="submit" name="xtippersub" value="<?php echo $text[512]; ?>"></acronym></td>
                                            </tr>
                                        </form>
                                        <?php
                                        if ($xoopsUser || 0 == $tippmitreg) {
                                            ?>
                                            <tr>
                                                <td class="lmost4" colspan="2">
                                                    <nobr><?php echo $text[545]; ?></nobr>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="lmost5" align="right">
                                                    <nobr><?php echo $text[546]; ?></nobr>
                                                </td>
                                                <form name="lmotippedit" action="<?php echo $PHP_SELF; ?>" method="post">
                                                    <input type="hidden" name="action" value="tipp">
                                                    <input type="hidden" name="todo" value="newtipper">
                                                    <td class="lmost5"><acronym title="<?php echo $text[511] ?>"><input class="lmoadminbut" type="submit" name="xtippersub" value="<?php echo $text[511]; ?>"></acronym></td>
                                                </form>
                                            </tr>
                                            <?php
                                        } else {
                                            ?>
                                            <tr>
                                                <td class="lmost4" colspan="2">
                                                    <nobr><?php echo _LMO_US_REGTEXT1; ?></nobr>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="lmost5" align="right">
                                                    <nobr><?php echo _LMO_US_REGTEXT2; ?></nobr>
                                                </td>
                                                <form name="lmotippedit" action="<?php echo XOOPS_URL . '/user.php'; ?>" method="post">
                                                    <td class="lmost5"><acronym title="<?php echo $text[512] ?>"><input class="lmoadminbut" type="submit" name="xtippersub" value="<?php echo $text[512]; ?>"></acronym></td>
                                                </form>
                                            </tr>
                                            <tr>
                                                <td class="lmost5" align="right">
                                                    <nobr><?php echo _LMO_US_REGTEXT2; ?></nobr>
                                                </td>
                                                <form name="lmotippedit" action="<?php echo XOOPS_URL . '/register.php'; ?>" method="post">
                                                    <td class="lmost5"><acronym title="<?php echo _LMO_US_REGTEXT3 ?>"><input class="lmoadminbut" type="submit" name="xtippersub" value="<?php echo _LMO_US_REGTEXT3; ?>"></acronym></td>
                                                </form>
                                            </tr>
                                            <?php
                                        } ?>
                                        <tr>
                                            <td class="lmost4" colspan="2">
                                                <nobr><?php echo $text[504]; ?></nobr>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="lmost5" colspan="2">
                                                <center>
                                                    <?php
                                                    $ftype = '.l98';

                        require 'lmo-tippnewdir.php';

                        $dummy = preg_split('[|]', $tt1);

                        $ftest2 = preg_split('[|]', $tt0);

                        if (isset($dummy) && isset($ftest2)) {
                            for ($u = 0, $uMax = count($dummy); $u < $uMax; $u++) {
                                if ('' != $dummy[$u] && '' != $ftest2[$u]) {
                                    $dummy[$u] = mb_substr($dummy[$u], 0, -4);

                                    $auswertfile = $dirtipp . 'auswert/' . $dummy[$u] . '.aus'; ?>
                                                                <li class="lmoadminli"><a href="<?php echo $addw . $dirliga . $dummy[$u] . '.l98'; ?>"><?php echo $ftest2[$u];

                                    echo '</a>';

                                    if (file_exists($auswertfile)) {
                                        echo '<br><small>' . $text[583] . ': ' . date('d.m.Y H:i', filectime($auswertfile)) . '</small>';
                                    } ?></li>
                                                                <?php
                                }
                            }
                        }

                        if (1 == $gesamt && $u > 2) {
                            $auswertfile = $dirtipp . 'auswert/gesamt.aus'; ?>
                                                        <li class="lmoadminli"><a href="<?php echo $addw . '&amp;all=1' ?>"><strong><?php echo $text[525] . '</a>';

                            if (file_exists($auswertfile)) {
                                echo '<br><small>' . $text[583] . ': ' . date('d.m.Y H:i', filectime($auswertfile)) . '</small>';
                            } ?> </strong></li>
                                                    <?php
                        }

                        $auswertfile = ''; ?>
                                                </center>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="lmost4" colspan="2">
                                                <nobr><?php echo $text[574]; ?></nobr>
                                            </td>
                                        </tr>

                                        <form name="lmotippedit" action="<?php echo $PHP_SELF; ?>" method="post">
                                            <input type="hidden" name="action" value="tipp">
                                            <input type="hidden" name="todo" value="getpass">
                                            <?php if (-3 == $HTTP_SESSION_VARS['lmotipperok']) { // Benutzer nicht gefunden?>
                                                <tr>
                                                    <td class="lmost5" align="right" colspan="2"><font color=red><?php echo $text[543]; ?></font></td>
                                                </tr>
                                            <?php } ?>
                                            <tr>
                                                <td class="lmost5" align="right"><?php echo ' ' . $text[523] . ' ' . $text[718] . ' ' . $text[719]; ?></td>
                                                <td class="lmost5"><acronym title="<?php echo $text[307] ?>"><input class="lmoadminein" type="text" name="xtippername2" size="16" maxlength="32" value="<?php echo $xtippername2; ?>"></acronym></a>
                                            </tr>
                                            <tr>
                                                <td class="lmost5" align="right"><?php echo $text[575]; ?></td>
                                                <td class="lmost5"><acronym title="<?php echo $text[576] ?>"><input class="lmoadminbut" type="submit" name="xtippersub" value="<?php echo $text[576]; ?>"></acronym></td>
                                            </tr>
                                        </form>
                                    </table>
                        </table>
                    <?php
                    } ?>
                </td>
            </tr>
            <?php require 'lmo-tippfusszeile.php'; ?>
        </table>

        <?php
    }

    $HTTP_SESSION_VARS['lmotipperok'] = $HTTP_SESSION_VARS['lmotipperok'];

    $lmotippername = $lmotippername;

    $HTTP_SESSION_VARS['lmotipperpass'] = $lmotipperpass;
}
?>
