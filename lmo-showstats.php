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
    $adds = $PHP_SELF . '?action=stats&amp;file=' . $file . '&amp;stat1=';

    $addr = $PHP_SELF . '?action=results&amp;file=' . $file . '&amp;st='; ?>

    <table class="lmosta" cellspacing="0" cellpadding="0" border="0">
        <tr>
            <td valign="top" align="center">
                <table cellspacing="0" cellpadding="0" border="0">
                    <?php
                    for ($i = 1; $i <= $anzteams; $i++) {
                        echo '<tr><td align="center" ';

                        if ($i != $stat1) {
                            echo 'class="lmost0"><a href="' . $adds . $i . '&amp;stat2=' . $stat2 . '" title="' . $text[57] . ' ' . $teams[$i] . '">' . $teamk[$i] . '</a>';
                        } else {
                            echo 'class="lmost1">' . $teamk[$i];
                        }

                        echo '</td></tr>';
                    } ?>
                </table>
            </td>
            <td valign="top" align="center" class="lmost3">
                <table class="lmostb" cellspacing="0" cellpadding="0" border="0">

                    <?php
                    if (0 == $stat1) {
                        echo '<tr><td align="center" class="lmost5">&nbsp;<br>' . $text[24] . '<br>&nbsp;</td></tr>';
                    } else {
                        $endtab = $anzst;

                        require 'lmo-calctable.php';

                        $platz0 = [''];

                        $platz0 = array_pad($array, $anzteams + 1, '');

                        for ($x = 0; $x < $anzteams; $x++) {
                            $platz0[(int)mb_substr($tab0[$x], 34)] = $x + 1;
                        } ?>
                        <tr>
                            <td valign="top" align="right" class="lmost4"><?php echo $teams[$stat1]; ?></td>
                            <td valign="top" align="center" class="lmost4">&nbsp;</td>
                            <?php if ($stat2 > 0) { ?>
                                <td valign="top" align='left' class="lmost4"><?php echo $teams[$stat2]; ?></td><?php } ?>
                        </tr>
                        <?php if ($stat2 > 0) {
                            $dummy = ' align="center"';
                        } else {
                            $dummy = '';
                        } ?>
                        <?php
                        $serie1 = '&nbsp;';

                        if ($ser1[$stat1] > 0) {
                            $serie1 = $ser1[$stat1] . ' ' . $text[474] . '<br>' . $ser2[$stat1] . ' ' . $text[75];
                        } elseif ($ser3[$stat1] > 0) {
                            $serie1 = $ser3[$stat1] . ' ' . $text[475] . '<br>' . $ser4[$stat1] . ' ' . $text[76];
                        } elseif ($ser2[$stat1] >= $ser4[$stat1]) {
                            $serie1 = $ser2[$stat1] . ' ' . $text[75];
                        } else {
                            $serie1 = $ser4[$stat1] . ' ' . $text[76];
                        }

                        if ($stat2 > 0) {
                            $chg1 = 'k.A.';

                            $chg2 = 'k.A.';

                            if (($spiele[$stat1]) && ($spiele[$stat2])) {
                                $a = (100 * $siege[$stat1] / $spiele[$stat1]) + (100 * $nieder[$stat2] / $spiele[$stat2]);

                                $b = (100 * $siege[$stat2] / $spiele[$stat2]) + (100 * $nieder[$stat1] / $spiele[$stat1]);

                                $c = ($etore[$stat1] / $spiele[$stat1]) + ($atore[$stat2] / $spiele[$stat2]);

                                $d = ($etore[$stat2] / $spiele[$stat2]) + ($atore[$stat1] / $spiele[$stat1]);
                            }

                            $e = $a + $b;

                            $f = $c + $d;

                            if (($e > 0) && ($f > 0)) {
                                $a = round(10000 * $a / $e);

                                $b = round(10000 * $b / $e);

                                $c = round(10000 * $c / $f);

                                $d = round(10000 * $d / $f);

                                $chg1 = number_format((($a + $c) / 200), 2, ',', '.');

                                $chg2 = number_format((($b + $d) / 200), 2, ',', '.');
                            }

                            $serie2 = '&nbsp;';

                            if ($ser1[$stat2] > 0) {
                                $serie2 = $ser1[$stat2] . ' ' . $text[474] . '<br>' . $ser2[$stat2] . ' ' . $text[75];
                            } elseif ($ser3[$stat2] > 0) {
                                $serie2 = $ser3[$stat2] . ' ' . $text[475] . '<br>' . $ser4[$stat2] . ' ' . $text[76];
                            } elseif ($ser2[$stat2] >= $ser4[$stat2]) {
                                $serie2 = $ser2[$stat2] . ' ' . $text[75];
                            } else {
                                $serie2 = $ser4[$stat2] . ' ' . $text[76];
                            } ?>
                            <tr>
                                <td valign="top" align="right" class="lmost5"><?php echo $chg1; ?>%</td>
                                <td valign="top" class="lmost4"<?php echo $dummy; ?>><?php echo $text[60]; ?></td>
                                <td valign="top" align='left' class="lmost5"><?php echo $chg2; ?>%</td>
                            </tr>
                        <?php
                        } ?>
                        <tr>
                            <td valign="top" align="right" class="lmost5"><?php echo $platz0[$stat1]; ?></td>
                            <td valign="top" class="lmost4"<?php echo $dummy; ?>><?php echo $text[61]; ?></td>
                            <?php if ($stat2 > 0) { ?>
                                <td align='left' valign="top" class="lmost5"><?php echo $platz0[$stat2]; ?></td><?php } ?>
                        </tr>
                        <tr>
                            <td valign="top" align="right" class="lmost5"><?php echo $punkte[$stat1];

                        if (2 == $minus) {
                            ':' . $negativ[$stat1];
                        } ?></td>
                            <td valign="top" class="lmost4"<?php echo $dummy; ?>><?php echo $text[37]; ?></td>
                            <?php if ($stat2 > 0) { ?>
                                <td align='left' valign="top" class="lmost5"><?php echo $punkte[$stat2];
                                if (2 == $minus) {
                                    ':' . $negativ[$stat2];
                                } ?></td><?php } ?>
                        </tr>
                        <tr>
                            <td valign="top" align="right" class="lmost5"><?php echo $spiele[$stat1]; ?></td>
                            <td valign="top" class="lmost4"<?php echo $dummy; ?>><?php echo $text[63]; ?></td>
                            <?php if ($stat2 > 0) { ?>
                                <td align='left' valign="top" class="lmost5"><?php echo $spiele[$stat2]; ?></td><?php } ?>
                        </tr>
                        <tr>
                            <td valign="top" align="right" class="lmost5"><?php if ($spiele[$stat1]) {
                                    echo number_format($punkte[$stat1] / $spiele[$stat1], 2, ',', '.');

                                    if (2 == $minus) {
                                        ':' . number_format($negativ[$stat1] / $spiele[$stat1], 2, ',', '.');
                                    }
                                } ?></td>
                            <td valign="top" class="lmost4"<?php echo $dummy; ?>><?php echo $text[37] . $text[64]; ?></td>
                            <?php if ($stat2 > 0) {
                                    if ($spiele[$stat2]) { ?><td align='left' valign="top" class="lmost5"><?php echo number_format($punkte[$stat2] / $spiele[$stat2], 2, ',', '.');
                                    if (2 == $minus) {
                                        ':' . number_format($negativ[$stat2] / $spiele[$stat2], 2, ',', '.');
                                    }
                                } ?></td><?php
                                } ?>
                        </tr>
                        <tr>
                            <td valign="top" align="right" class="lmost5"><?php echo $etore[$stat1] . ':' . $atore[$stat1]; ?></td>
                            <td valign="top" class="lmost4"<?php echo $dummy; ?>><?php echo $text[38]; ?></td>
                            <?php if ($stat2 > 0) { ?>
                                <td align='left' valign="top" class="lmost5"><?php echo $etore[$stat2] . ':' . $atore[$stat2]; ?></td><?php } ?>
                        </tr>
                        <tr>
                            <td valign="top" align="right" class="lmost5"><?php if ($spiele[$stat1]) {
                                    echo number_format($etore[$stat1] / $spiele[$stat1], 2, ',', '.') . ':' . number_format($atore[$stat1] / $spiele[$stat1], 2, ',', '.');
                                } ?></td>
                            <td valign="top" class="lmost4"<?php echo $dummy; ?>><?php echo $text[38] . $text[64]; ?></td>
                            <?php if ($stat2 > 0) { ?>
                                <td align='left' valign="top" class="lmost5"><?php if ($spiele[$stat2]) {
                                    echo number_format($etore[$stat2] / $spiele[$stat2], 2, ',', '.') . ':' . number_format($atore[$stat2] / $spiele[$stat2], 2, ',', '.');
                                } ?></td><?php } ?>
                        </tr>
                        <tr>
                            <td valign="top" align="right" class="lmost5"><?php if ($spiele[$stat1]) {
                                    echo $siege[$stat1] . ' (' . number_format($siege[$stat1] * 100 / $spiele[$stat1], 2, ',', '.') . '%)';
                                } ?></td>
                            <td valign="top" class="lmost4"<?php echo $dummy; ?>><?php echo $text[67]; ?></td>
                            <?php if ($stat2 > 0) { ?>
                                <td align='left' valign="top" class="lmost5"><?php if ($spiele[$stat2]) {
                                    echo $siege[$stat2] . ' (' . number_format($siege[$stat2] * 100 / $spiele[$stat2], 2, ',', '.') . '%)';
                                } ?></td><?php } ?>
                        </tr>
                        <tr>
                            <td valign="top" align="right" class="lmost5"><?php echo $maxs0[$stat1]; ?></td>
                            <td valign="top" class="lmost4"<?php echo $dummy; ?>><?php echo $text[68]; ?></td>
                            <?php if ($stat2 > 0) { ?>
                                <td align='left' valign="top" class="lmost5"><?php echo $maxs0[$stat2]; ?></td><?php } ?>
                        </tr>
                        <tr>
                            <td valign="top" align="right" class="lmost5"><?php if ($spiele[$stat1]) {
                                    echo $nieder[$stat1] . ' (' . number_format($nieder[$stat1] * 100 / $spiele[$stat1], 2, ',', '.') . '%)';
                                } ?></td>
                            <td valign="top" class="lmost4"<?php echo $dummy; ?>><?php echo $text[69]; ?></td>
                            <?php if ($stat2 > 0) { ?>
                                <td align='left' valign="top" class="lmost5"><?php if ($spiele[$stat2]) {
                                    echo $nieder[$stat2] . ' (' . number_format($nieder[$stat2] * 100 / $spiele[$stat2], 2, ',', '.') . '%)';
                                } ?></td><?php } ?>
                        </tr>
                        <tr>
                            <td valign="top" align="right" class="lmost5"><?php echo $maxn0[$stat1]; ?></td>
                            <td valign="top" class="lmost4"<?php echo $dummy; ?>><?php echo $text[70]; ?></td>
                            <?php if ($stat2 > 0) { ?>
                                <td align='left' valign="top" class="lmost5"><?php echo $maxn0[$stat2]; ?></td><?php } ?>
                        </tr>
                        <tr>
                            <td valign="top" align="right" class="lmost5"><?php echo $serie1; ?></td>
                            <td valign="top" class="lmost4"<?php echo $dummy; ?>><?php echo $text[71]; ?></td>
                            <?php if ($stat2 > 0) { ?>
                                <td align='left' valign="top" class="lmost5"><?php echo $serie2; ?></td><?php } ?>
                        </tr>
                        <?php
                    } ?>
                </table>
            </td>
            <td valign="top" align="center">
                <table cellspacing="0" cellpadding="0" border="0">
                    <?php
                    for ($j = 0; $j <= $anzteams; $j++) {
                        $i = $j + 1;

                        if ($i > $anzteams) {
                            $i = 0;
                        }

                        if (0 == $i) {
                            $dummy = $text[59];
                        } else {
                            $dummy = $text[58] . ' ' . $teams[$i];
                        }

                        echo '<tr><td align="center" ';

                        if ($i != $stat2) {
                            echo 'class="lmost0"><a href="' . $adds . $stat1 . '&amp;stat2=' . $i . '" title="' . $dummy . '">' . $teamk[$i] . '</a>';
                        } else {
                            echo 'class="lmost1">' . $teamk[$i];
                        }

                        echo '</td></tr>';
                    } ?>
                </table>
            </td>
        </tr>
    </table>

<?php
} ?>
