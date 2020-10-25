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
    } ?>

    <table class="lmosta" cellspacing="0" cellpadding="0" border="0">
        <tr>
            <td align="center">
                <table cellspacing="0" cellpadding="0" border="0">
                    <tr>
                        <?php
                        for ($i = 1; $i <= $anzst; $i++) {
                            echo '<td align="right" ';

                            if ($i != $st) {
                                echo 'class="lmost0"><a href="' . $addr . $i . '" title="' . $text[9] . '">' . $i . '</a>';
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
                    <tr>
                        <td class="lmost4" colspan="<?php echo $breite; ?>"><?php echo $st; ?>. <?php echo $text[2]; ?>
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

                    <?php for ($i = 0; $i < $anzsp; $i++) {
                            if (($teama[$st - 1][$i] > 0) && ($teamb[$st - 1][$i] > 0)) { ?>
                            <tr>

                                <?php if (1 == $datm) {
                                if ($mterm[$st - 1][$i] > 0) {
                                    $dum1 = strftime($datf, $mterm[$st - 1][$i]);
                                } else {
                                    $dum1 = '';
                                } ?>
                                    <td class="lmost5" align="left">
                                        <nobr><?php echo $dum1; ?></nobr>
                                    </td>
                                <?php
                            } ?>

                                <td class="lmost5" width="2">&nbsp;</td>
                                <td class="lmost5" align="right">
                                    <nobr>

                                        <?php
                                        echo '<a href="' . $addp . $teama[$st - 1][$i] . '" title="' . $text[269] . '">';
                                        if (($favteam > 0) && ($favteam == $teama[$st - 1][$i])) {
                                            echo '<b>';
                                        }
                                        echo $teams[$teama[$st - 1][$i]];
                                        if (($favteam > 0) && ($favteam == $teama[$st - 1][$i])) {
                                            echo '</b>';
                                        }
                                        echo '</a>';
                                        ?>

                                    </nobr>
                                </td>
                                <td class="lmost5" align="center" width="10">-</td>
                                <td class="lmost5" align="left">
                                    <nobr>

                                        <?php
                                        echo '<a href="' . $addp . $teamb[$st - 1][$i] . '" title="' . $text[269] . '">';
                                        if (($favteam > 0) && ($favteam == $teamb[$st - 1][$i])) {
                                            echo '<b>';
                                        }
                                        echo $teams[$teamb[$st - 1][$i]];
                                        if (($favteam > 0) && ($favteam == $teamb[$st - 1][$i])) {
                                            echo '</b>';
                                        }
                                        echo '</a>';
                                        ?>

                                    </nobr>
                                </td>
                                <td class="lmost5" width="2">&nbsp;</td>
                                <td class="lmost5" align="right"><?php echo $goala[$st - 1][$i]; ?></td>
                                <td class="lmost5" align="center" width="8">:</td>
                                <td class="lmost5" align="left"><?php echo $goalb[$st - 1][$i]; ?></td>
                                <?php if (1 == $spez) { ?>
                                    <td class="lmost5" width="2">&nbsp;</td>
                                    <td class="lmost5"><?php echo $mspez[$st - 1][$i]; ?></td>
                                <?php } ?>
                                <td class="lmost5" width="2">&nbsp;</td>
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
                                    }
                                    ?>

                                </td>
                            </tr>
                        <?php }
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
        //		echo "<td align=\"left\" class=\"lmost2\"><a href=\"".$addr.$st0."\" title=\"".$text[6]."\">".$text[5]."</a></td>";

        echo '<td align="left" class="lmost2">&nbsp;<a href="' . $addr . $st0 . '" title="' . $text[6] . "\"><img src=\"./images/left.gif\" width='9' height='9' border=\"0\"></a></td>";
    } ?>
                        <?php $st0 = $st + 1;

    if ($st < $anzst) {
        echo '<td align="right" class="lmost2"><a href="' . $addr . $st0 . '" title="' . $text[8] . "\"><img src=\"./images/right.gif\" width='9' height='9' border=\"0\"></a>&nbsp;</td>";
    } ?>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

<?php
} ?>
