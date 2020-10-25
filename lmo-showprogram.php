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

    $addr = $PHP_SELF . '?action=results&amp;file=' . $file . '&amp;st='; ?>

    <table class="lmosta" cellspacing="0" cellpadding="0" border="0">
        <tr>
            <td valign="top" align="center">
                <table cellspacing="0" cellpadding="0" border="0">
                    <?php
                    for ($i = 1; $i <= $anzteams; $i++) {
                        echo '<tr><td align="center" ';

                        if ($i != $selteam) {
                            echo 'class="lmost0"><a href="' . $addp . $i . '" title="' . $text[23] . ' ' . $teams[$i] . '">' . $teamk[$i] . '</a>';
                        } else {
                            echo 'class="lmost1">' . $teamk[$i];

                            $druck_mann = $teams[$i];
                        }

                        echo '</td></tr>';
                    }

    // bama (15.07.2003)

    if (0 != $selteam) {
        echo '<tr><td align="center"><br>';

        echo "<a href='" . $progurl . '/lmo_spielplan.php?file=' . $file . '&mann=' . $selteam . "' target='_blank' ><img src='" . $modimages . "/print.gif' width='15' height='11' alt='" . _LMO_SP_DRUCK2 . $druck_mann . "' border='0'></a>";

        echo '</td></tr>';
    }

    // bama (15.07.2003)?>
                </table>
            </td>
            <td valign="top" align="center" class="lmost3">
                <table class="lmostb" cellspacing="0" cellpadding="0" border="0">

                    <?php
                    if (0 == $selteam) {
                        echo '<tr><td align="center" class="lmost5">&nbsp;<br>' . $text[24] . '<br><br>';

                        // bama (15.07.2003)

                        echo "<a href='" . $progurl . '/lmo_spielplan.php?file=' . $file . '&mann=' . $selteam . "' target='_blank' ><img src='" . $modimages . "/print.gif' width='15' height='11' alt='" . _LMO_SP_DRUCK1 . "' border='0'></a>";

                        // bama (15.07.2003)

                        echo '<br>&nbsp;</td></tr>';
                    } else {
                        for ($j = 0; $j < $anzst; $j++) {
                            for ($i = 0; $i < $anzsp; $i++) {
                                if (($selteam == $teama[$j][$i]) || ($selteam == $teamb[$j][$i])) {
                                    ?>

                                    <tr>
                                        <td class="lmost5" align="right">&nbsp;<a href="<?php echo $addr . ($j + 1); ?>" title="<?php echo $text[25]; ?>"><?php echo $j + 1; ?></a>&nbsp;</td>
                                        <?php if (1 == $datm) {
                                        if ($mterm[$j][$i] > 0) {
                                            $dum1 = strftime($datf, $mterm[$j][$i]);
                                        } else {
                                            $dum1 = '';
                                        } ?>
                                            <td class="lmost5" width="2">&nbsp;</td>
                                            <td class="lmost5">
                                                <nobr><?php echo $dum1; ?></nobr>
                                            </td>
                                        <?php
                                    } ?>
                                        <td class="lmost5" width="2">&nbsp;</td>
                                        <td class="lmost5" align="right">
                                            <nobr>

                                                <?php
                                                if ($selteam == $teama[$j][$i]) {
                                                    echo '<b>';
                                                }

                                    echo $teams[$teama[$j][$i]];

                                    if ($selteam == $teama[$j][$i]) {
                                        echo '</b>';
                                    } ?>

                                            </nobr>
                                        </td>
                                        <td class="lmost5" align="center" width="10">-</td>
                                        <td class="lmost5" align='left'>
                                            <nobr>

                                                <?php
                                                if ($selteam == $teamb[$j][$i]) {
                                                    echo '<b>';
                                                }

                                    echo $teams[$teamb[$j][$i]];

                                    if ($selteam == $teamb[$j][$i]) {
                                        echo '</b>';
                                    } ?>

                                            </nobr>
                                        </td>
                                        <td class="lmost5" width="2">&nbsp;</td>
                                        <td class="lmost5" align="right"><?php echo $goala[$j][$i]; ?></td>
                                        <td class="lmost5" align="center" width="8">:</td>
                                        <td class="lmost5" align='left'><?php echo $goalb[$j][$i]; ?></td>
                                        <?php if (1 == $spez) { ?>
                                            <td class="lmost5" width="2">&nbsp;</td>
                                            <td class="lmost5"><?php echo $mspez[$j][$i]; ?></td>
                                        <?php } ?>
                                        <td class="lmost5" width="2">&nbsp;</td>
                                        <td class="lmost5">

                                            <?php
                                            if (1 == $urlb) {
                                                if ('' != $mberi[$j][$i]) {
                                                    echo '<a href="' . $mberi[$j][$i] . '" target="_blank" title="' . $text[270] . '"><img src="lmo-st1.gif" width="16" height="16" border="0"></a>';
                                                } else {
                                                    echo '&nbsp;';
                                                }
                                            }

                                    if (('' != $mnote[$j][$i]) || ($msieg[$j][$i] > 0)) {
                                        $dummy = addslashes($teams[$teama[$j][$i]] . ' - ' . $teams[$teamb[$j][$i]] . ' ' . $goala[$j][$i] . ':' . $goalb[$j][$i]);

                                        if (3 == $msieg[$j][$i]) {
                                            $dummy .= ' / ' . $goalb[$j][$i] . ':' . $goala[$j][$i];
                                        }

                                        if (1 == $spez) {
                                            $dummy .= ' ' . $mspez[$j][$i];
                                        }

                                        if (1 == $msieg[$j][$i]) {
                                            $dummy .= '\\n\\n' . $text[219] . ':\\n' . addslashes($teams[$teama[$j][$i]] . ' ' . $text[211]);
                                        }

                                        if (2 == $msieg[$j][$i]) {
                                            $dummy .= '\\n\\n' . $text[219] . ':\\n' . addslashes($teams[$teamb[$j][$i]] . ' ' . $text[211]);
                                        }

                                        if (3 == $msieg[$j][$i]) {
                                            $dummy .= '\\n\\n' . $text[219] . ':\\n' . addslashes($text[212]);
                                        }

                                        if ('' != $mnote[$j][$i]) {
                                            $dummy .= '\\n\\n' . $text[22] . ':\\n' . $mnote[$j][$i];
                                        }

                                        echo "<a href=\"javascript:alert('" . $dummy . "');\" title=\"" . str_replace('\\n', '&#10;', $dummy) . '"><img src="lmo-st2.gif" width="16" height="16" border="0"></a>';
                                    } else {
                                        echo '&nbsp;';
                                    } ?>

                                        </td>
                                    </tr>
                                <?php
                                }
                            }
                        }
                    } ?>

                </table>
            </td>
        </tr>
    </table>

<?php
} ?>
