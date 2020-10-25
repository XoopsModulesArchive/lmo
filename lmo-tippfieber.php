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
if ('' != $file && 1 == $tippfieber) {
    if (!isset($save)) {
        $save = 0;
    }

    if (1 == $save) {
        $stat1 = trim($_POST['xstat1']);

        $stat2 = trim($_POST['xstat2']);

        $kurvenmodus = trim($_POST['xkurvenmodus']);
    }

    if (!isset($eigpos)) {
        $eigpos = 0;
    }

    if (!isset($stat1)) {
        $stat1 = -1;
    }

    if (!isset($stat2)) {
        $stat2 = -1;
    }

    if ($stat1 == $stat2) {
        $stat2 = -1;
    }

    if (!isset($kurvenmodus)) {
        $kurvenmodus = 1;
    }

    $addg = $PHP_SELF . '?action=tipp&amp;todo=fieber&amp;file=' . $file . '&amp;stat1=';

    require 'lmo-tippcalcgraph.php'; ?>

    <table class="lmosta" cellspacing="0" cellpadding="0" border="0">
        <form name="lmoedit" action="<?php echo $PHP_SELF; ?>" method="post">
            <input type="hidden" name="action" value="tipp">
            <input type="hidden" name="todo" value="fieber">
            <input type="hidden" name="file" value="<?php echo $file; ?>">
            <input type="hidden" name="save" value="1">
            <tr>
                <td class="lmost1"><?php echo $text[664] . ' 1'; ?></td>
                <td class="lmost1"><?php echo $text[664] . ' 2'; ?></td>
                <td class="lmost1"><?php echo $text[783]; ?></td>
                <td></td>
            </tr>
            <tr>
                <td>
                    <select name="xstat1">
                        <?php
                        $tab = [''];

    for ($i = 0; $i < $anztipper; $i++) {
        $tab[] = mb_strtolower($tippernick[$i]) . (50000000 + $i);
    }

    array_shift($tab);

    sort($tab, SORT_STRING);

    echo '<option value="-1"';

    if (-1 == $stat1) {
        echo ' selected';
    }

    echo '>___</option>';

    for ($i = 0; $i < $anztipper; $i++) {
        $j = (int)mb_substr($tab[$i], -7);

        echo "<option value=\"$j\"";

        if ($stat1 == $j) {
            echo ' selected';
        }

        echo ">$tippernick[$j]</option>";
    } ?>
                    </select>
                </td>
                <td>
                    <select name="xstat2">
                        <?php
                        echo '<option value="-1"';

    if (-1 == $stat2) {
        echo ' selected';
    }

    echo '>___</option>';

    for ($i = 0; $i < $anztipper; $i++) {
        $j = (int)mb_substr($tab[$i], -7);

        echo "<option value=\"$j\"";

        if ($stat2 == $j) {
            echo ' selected';
        }

        echo ">$tippernick[$j]</option>";
    } ?>
                    </select>
                </td>
                <td>
                    <select name="xkurvenmodus">
                        <?php
                        echo '<option value="1"';

    if (1 == $kurvenmodus) {
        echo ' selected';
    }

    echo ">$text[735]</option>";

    echo '<option value="2"';

    if (2 == $kurvenmodus) {
        echo ' selected';
    }

    echo ">$text[732]</option>";

    echo '<option value="3"';

    if (3 == $kurvenmodus) {
        echo ' selected';
    }

    echo ">$text[734]</option>";

    echo '<option value="4"';

    if (4 == $kurvenmodus) {
        echo ' selected';
    }

    echo ">$text[733]</option>"; ?>
                    </select>
                </td>
                <td>
                    <input type="submit" name="best" value="<?php echo $text[736]; ?>">
                </td>
            </tr>
        </form>
        <tr>
            <td colspan="4" align="center" class="lmost3">
                <table class="lmostb" cellspacing="0" cellpadding="0" border="0">

                    <?php
                    if ($stat1 < 0 && $stat2 >= 0) {
                        $stat1 = $stat2;

                        $stat2 = -1;
                    }

    if ($stat1 < 0) {
        echo '<tr><td align="center" class="lmost5">&nbsp;<br>' . $text[784] . '<br>&nbsp;</td></tr>';
    } else {
        $dummy = 'lmo-tipppaintgraph.php?pganz=';

        if ($stat2 >= 0) {
            $dummy .= '2';
        } else {
            $dummy .= '1';
        }

        $dummy .= '&amp;pgteam1=' . htmlentities($tippernick[$stat1], ENT_QUOTES | ENT_HTML5);

        if ($stat2 >= 0) {
            $dummy .= '&amp;pgteam2=' . htmlentities($tippernick[$stat2], ENT_QUOTES | ENT_HTML5);
        }

        if (1 == $kurvenmodus) {
            if ($stat2 >= 0) {
                $max = max(max($tipppunkte[$stat1]), max($tipppunkte[$stat2]));
            } else {
                $max = max($tipppunkte[$stat1]);
            }
        } elseif (2 == $kurvenmodus) {
            if ($stat2 >= 0) {
                $max = max(max($platz[$stat1]), max($platz[$stat2]));
            } else {
                $max = max($platz[$stat1]);
            }
        } elseif (3 == $kurvenmodus) {
            if ($stat2 >= 0) {
                $max = max(max($platz[$stat1]), max($platz[$stat2]), max($platz1[$stat1]), max($platz1[$stat2]));
            } else {
                $max = max(max($platz[$stat1]), max($platz1[$stat1]));
            }
        } elseif (4 == $kurvenmodus) {
            if ($stat2 >= 0) {
                $max = max(max($platz1[$stat1]), max($platz1[$stat2]));
            } else {
                $max = max($platz1[$stat1]);
            }
        }

        $dummy .= '&amp;max=' . $max;

        $dummy .= '&amp;pgst=' . $anzst;

        if ($kurvenmodus < 4) {
            $dummy .= '&amp;pgplatz1=';

            if (1 == $kurvenmodus) {
                for ($j = 0; $j < $anzst; $j++) {
                    $dummy .= $tipppunkte[$stat1][$j] . ',';
                }
            } else {
                for ($j = 0; $j < $anzst; $j++) {
                    $dummy .= $platz[$stat1][$j] . ',';
                }
            }

            $dummy .= '0';
        }

        if ($kurvenmodus > 2) {
            $dummy .= '&amp;pgplatz1a=';

            for ($j = 0; $j < $anzst; $j++) {
                $dummy .= $platz1[$stat1][$j] . ',';
            }

            $dummy .= '0';
        }

        if ($stat2 >= 0) {
            if ($kurvenmodus < 4) {
                $dummy .= '&amp;pgplatz2=';

                if (1 == $kurvenmodus) {
                    for ($j = 0; $j < $anzst; $j++) {
                        $dummy .= $tipppunkte[$stat2][$j] . ',';
                    }
                } else {
                    for ($j = 0; $j < $anzst; $j++) {
                        $dummy .= $platz[$stat2][$j] . ',';
                    }
                }

                $dummy .= '0';
            }

            if ($kurvenmodus > 2) {
                $dummy .= '&amp;pgplatz2a=';

                for ($j = 0; $j < $anzst; $j++) {
                    $dummy .= $platz1[$stat2][$j] . ',';
                }

                $dummy .= '0';
            }
        }

        $dummy .= '&amp;kmodus=' . $kurvenmodus;

        $dummy .= '&amp;pgtext1=' . $text[135]; //SPIELTAGE

        if (1 == $kurvenmodus) {
            $dummy .= '&amp;pgtext2=' . mb_strtoupper($text[538]);
        } // PUNKTE

        else {
            $dummy .= '&amp;pgtext2=' . $text[136];
        } //PLATZIERUNG?>
                        <tr>
                            <td class="lmost5" colspan="3"><img src="<?php echo $dummy; ?>" border="0"></td>
                        </tr>
                    <?php
    } ?>

                </table>
            </td>
        </tr>
    </table>

<?php
} ?>
