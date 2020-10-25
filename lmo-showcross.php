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
if (('' != $file) && (1 == $kreuz)) {
    $addc = $PHP_SELF . '?action=cross&amp;file=' . $file . '&amp;croteam=';

    $addr = $PHP_SELF . '?action=results&amp;file=' . $file . '&amp;st='; ?>

    <table class="lmosta" cellspacing="0" cellpadding="0" border="0">

        <?php
        if (!isset($croteam)) {
            $croteam = 0;
        }

    for ($i = 0; $i <= ($anzteams + 1); $i++) {
        for ($j = 0; $j <= ($anzteams + 1); $j++) {
            $dummy = '';

            if ((0 == $i) || ($i == ($anzteams + 1)) || (0 == $j) || ($j == ($anzteams + 1))) {
                $k = 2;

                if ((0 != $croteam) && (($j == $croteam) || ($i == $croteam))) {
                    $k = 1;
                }
            } elseif ($j == $i) {
                $k = 4;
            } else {
                $k = 5;

                if ((0 != $croteam) && (($j == $croteam) || ($i == $croteam))) {
                    $k = 6;
                }
            }

            if (0 == $j) {
                echo '<tr>';
            }

            if (0 == $j) {
                echo '<td align="right" class="lmocross' . $k . '"><nobr>';
            } else {
                echo '<td align="center" class="lmocross' . $k . '"><nobr>';
            }

            if ((0 == $j) && ($i > 0) && ($i <= $anzteams)) {
                if ((0 != $croteam) && (($j == $croteam) || ($i == $croteam))) {
                    echo $teams[$i];
                } else {
                    echo '<a href="' . $addc . $i . '" title="' . $text[26] . '">' . $teams[$i] . '</a>';
                }
            }

            if (($j == ($anzteams + 1)) && ($i > 0) && ($i <= $anzteams)) {
                echo '<acronym title="' . $teams[$i] . '">' . $teamk[$i] . '</acronym>';
            }

            if (((0 == $i) || ($i == ($anzteams + 1))) && (($j > 0) && ($j <= $anzteams))) {
                echo '<acronym title="' . $teams[$j] . '">' . $teamk[$j] . '</acronym>';
            }

            if ($j == $i) {
                echo '&nbsp;';
            }

            if (($i > 0) && ($i <= $anzteams) && ($j > 0) && ($j <= $anzteams) && ($j != $i)) {
                $l = 0;

                for ($b = 0; $b < $anzst; $b++) {
                    for ($a = 0; $a < $anzsp; $a++) {
                        if (($i == $teama[$b][$a]) && ($j == $teamb[$b][$a])) {
                            if (('' != $mnote[$b][$a]) || ($msieg[$b][$a] > 0)) {
                                if (1 == $msieg[$b][$a]) {
                                    $dummy .= '&#10;&#10;' . $text[219] . ':&#10;' . $teams[$teama[$b][$a]] . ' ' . $text[211];
                                }

                                if (2 == $msieg[$b][$a]) {
                                    $dummy .= '&#10;&#10;' . $text[219] . ':&#10;' . $teams[$teamb[$b][$a]] . ' ' . $text[211];
                                }

                                if (3 == $msieg[$b][$a]) {
                                    $dummy .= '&#10;&#10;' . $text[219] . ':&#10;' . $text[212];
                                }

                                if ('' != $mnote[$b][$a]) {
                                    $dummy .= '&#10;&#10;' . $text[22] . ':&#10;' . $mnote[$b][$a];
                                }
                            } else {
                                $dummy = '';
                            }

                            if ($l > 0) {
                                echo '<br>';
                            }

                            if ($mterm[$b][$a] > 0) {
                                $dumd = ', ' . strftime('%a. %d.%m.%Y %H:%M', $mterm[$b][$a]);
                            } else {
                                $dumd = '';
                            }

                            echo '<a href="' . $addr . ($b + 1) . '" title="' . $teams[$i] . ' - ' . $teams[$j] . ' &#10;(' . ($b + 1) . '. ' . $text[2] . $dumd . $dummy . ')">' . $goala[$b][$a] . ':' . $goalb[$b][$a];

                            if (1 == $spez) {
                                echo ' ' . $mspez[$b][$a];
                            }

                            if (('' != $mnote[$b][$a]) || ($msieg[$b][$a] > 0)) {
                                echo ' !';
                            }

                            echo '</a>';

                            $l++;
                        }
                    }
                }
            }

            echo '</nobr></td>';

            if ($j == ($anzteams + 1)) {
                echo '</tr>';
            }
        }
    } ?>

    </table>

<?php
} ?>
