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
if (!isset($nw)) {
    $nw = 0;
}
?>
<tr>
    <td class="lmomain2" colspan="3" align="right">
        <table width="100%" cellspacing="0" cellpadding="0" border="0">
            <tr>
                <td class="lmomain2" valign="top" align="left">
                    <nobr>
                        <?php if ('wert' == $todo) { ?>
                            <?php echo '<strong>' . $text[589] . ':</strong><br>'; /// Zeichenerklaerung?>
                            <?php if ('team' == $wertung) { ?>
                                <?php echo $text[619] . ': ' . $text[620] . '&nbsp;&nbsp;&nbsp;<br>'; // AT?>
                                <?php echo $text[619] . '&Oslash;: ' . $text[708] . '&nbsp;&nbsp;&nbsp;<br>'; // AT?>
                            <?php } ?>
                            <?php echo $text[623] . ': ' . $text[617] . '&nbsp;&nbsp;&nbsp;<br>'; // SG?>
                            <?php if (1 == $showstsiege) {
    echo $text[590] . ': ' . $text[771] . '&nbsp;&nbsp;&nbsp;<br>';
} // GS?>
                            <?php echo $text[623];
                            if (1 == $tippmodus) {
                                echo '&Oslash;: ' . $text[624];
                            } else {
                                echo '&#37;: ' . $text[625];
                            }
                            echo '&nbsp;&nbsp;&nbsp;<br>'; ?>
                            <?php if (1 == $tippmodus) {
                                echo $text[37] . ': ' . $text[616];
                            } else {
                                echo $text[622] . ': ' . $text[618];
                            }
                            echo '&nbsp;&nbsp;&nbsp;<br>'; // PP?>
                        <?php } ?>
                        <?php if ('wert' == $todo || 'edit' == $todo || 'einsicht' == $todo) { ?>
                            <?php if (1 == $tippmodus) { ?>
                                <?php echo '<strong>' . $text[608] . ':</strong><br>'; // Punkteverteilung?>
                                <?php if ($rergebnis > 0) {
                                echo $text[721] . ': ' . $text[534] . ': ' . $rergebnis . ' ' . $text[538] . '&nbsp;&nbsp;&nbsp;<br>';
                            } ?>
                                <?php if ($rtendenzdiff > $rtendenz) {
                                echo $text[722] . ': ' . $text[535] . ': ' . $rtendenzdiff . ' ' . $text[538] . '&nbsp;&nbsp;&nbsp;<br>';
                            } ?>
                                <?php if ($rtendenz > 0) {
                                echo $text[723] . ': ' . $text[536] . ': ' . $rtendenz . ' ' . $text[538] . '&nbsp;&nbsp;&nbsp;<br>';
                            } ?>
                                <?php if ($rtor > 0) {
                                echo $text[724] . ': ' . $text[537] . ': ' . $rtor . ' ' . $text[538] . '&nbsp;&nbsp;&nbsp;<br>';
                            } ?>
                            <?php } ?>
                            <?php if ($rremis > 0) {
                                echo $text[725] . ': ' . $text[692] . ': ' . $rremis . ' ' . $text[538] . '&nbsp;&nbsp;&nbsp;<br>';
                            } ?>
                            <?php if (1 == $jokertipp && 'einsicht' == $todo) {
                                echo '<font color=red>' . $text[787] . '</font>: ' . $text[902] . '&nbsp;&nbsp;&nbsp;<br>';
                            } ?>
                            <?php if (1 == $jokertipp && 'wert' == $todo) {
                                echo $text[726] . ': ' . $text[727] . '&nbsp;&nbsp;&nbsp;<br>';
                            } ?>
                            <?php if (1 == $jokertipp && 'edit' == $todo) {
                                echo $text[904] . ': ' . $jokertippmulti . '&nbsp;&nbsp;&nbsp;<br>';
                            } ?>
                            <?php if (1 == $nw) {
                                echo $text[730] . ' ' . $text[731] . '&nbsp;&nbsp;&nbsp;<br>';
                            } ?>
                        <?php } ?>
                    </nobr>
                </td>
                <td class="lmomain2" align="right" valign="bottom" rowspan="2">
                    <nobr>
                        <?php if (!isset($auswertfile)) {
                                $auswertfile = '';
                            }
                        if (!isset($tippfile)) {
                            $tippfile = '';
                        }
                        if (!isset($einsichtfile)) {
                            $einsichtfile = '';
                        }
                        if ('' == $auswertfile) {
                            $auswertfile = $einsichtfile;
                        }
                        if ('' != $auswertfile && file_exists($auswertfile)) {
                            $auswertstand = date('d.m.Y H:i', filectime($auswertfile)); // Stand der *.aus-Datei

                            echo $text[583] . ': ' . $auswertstand . '<br>';
                        } ?>
                        <?php if ('' != $tippfile && 1 != $all && ('tabelle' != $todo || '' != $nick) && file_exists($tippfile)) {
                            $tippstand = date('d.m.Y H:i', filectime($tippfile)); // Stand der *_user.tip-Datei

                            echo $text[586] . ': ' . $tippstand . '<br>';
                        } ?>
                        <?php if ('' != $file && 1 != $all && isset($stand) && '' != $stand) {
                            echo $text[406] . ': ' . $stand . '<br>';
                        } // Stand der *.l98-Datei?>
                        <?php if (1 == $calctime) {
                            echo $text[471] . ': ' . number_format((getmicrotime() - $startzeit), 4, '.', ',') . ' sek.<br>';
                        } ?>
                        <?php echo $text[54]; ?> - <?php echo $text[55]; ?><br>
                        <?php echo $text[584]; ?> - <?php echo $text[585]; ?>
                    </nobr>
                </td>
            </tr>
            <tr>
                <td class="lmomain1" valign="bottom" align="left">
                    <?php
                    if ('' != $file && 0 == $lmtype && 1 != $all) {
                        echo '<a href="' . $PHP_SELF . '?file=' . $file . '&amp;action=table">' . $text[599] . '</a>&nbsp;&nbsp;&nbsp;<br>';
                    }
                    if ('' != $todo && 'logout' != $todo) {
                        echo '<a href="' . $PHP_SELF . '?action=tipp&amp;PHPSESSID=' . $PHPSESSID . '">' . $text[501] . '</a>&nbsp;&nbsp;&nbsp;';
                    }
                    if ('' == $todo || 'logout' == $todo) {
                        if (1 == $backlink) {
                            echo '<a href="' . $PHP_SELF . '">' . $text[391] . '</a>&nbsp;&nbsp;&nbsp;';
                        }
                    }
                    ?>
                </td>
            </tr>
        </table>
    </td>
</tr>
