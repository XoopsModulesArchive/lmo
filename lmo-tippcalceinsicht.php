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
// Jocker-Hack 001
// Copyright (C) 2002 by Ufuk Altinkaynak
// ufuk.a@arcor.de
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
if (0 != $lmtype) {
    $anzsp = $anzteams;

    for ($i = 0; $i < $st; $i++) {
        $anzsp /= 2;
    }

    if ((1 == $klfin) && ($st == $anzst)) {
        $anzsp += 1;
    }
}
$einsichtfile = $dirtipp . 'einsicht/' . mb_substr($file, mb_strrpos($file, '/') + 1, -4) . '_' . $st . '.ein';
if (!file_exists($einsichtfile)) {
    echo $text[517] . '<br>';
} else {
    $datei = fopen($einsichtfile, 'rb');

    $anztipper = 0;

    if (false !== $datei) {
        $tippdaten = [''];

        $sekt = '';

        while (!feof($datei)) {
            $zeile = fgets($datei, 1000);

            $zeile = rtrim($zeile);

            $zeile = trim($zeile);

            if (('@' == mb_substr($zeile, 0, 1)) && ('@' == mb_substr($zeile, -1))) {
                $jkwert = trim(mb_substr($zeile, 1, -1));
            } elseif (('[' == mb_substr($zeile, 0, 1)) && (']' == mb_substr($zeile, -1))) {
                $sekt = trim(mb_substr($zeile, 1, -1));

                $jkwert = -1;

                if ('[Options]' != $zeile) {
                    $tippdaten[] = $sekt . '|||EOL';

                    $anztipper++;
                }
            } elseif ((false !== mb_strpos($zeile, '=')) && (';' != mb_substr($zeile, 0, 1))) {
                $schl = trim(mb_substr($zeile, 0, mb_strpos($zeile, '=')));

                $wert = trim(mb_substr($zeile, mb_strpos($zeile, '=') + 1));

                if (!isset($jkwert)) {
                    $jkwert = -1;
                }

                $tippdaten[] = $sekt . '|' . $schl . '|' . $wert . '|' . $jkwert . '|EOL';
            }
        }

        fclose($datei);
    }

    array_shift($tippdaten);

    $tippernick = array_pad($array, $anztipper + 1, '');

    $jksp2 = array_pad($array, $anztipper + 1, '');

    $tippa = array_pad($array, $anztipper + 1, '');

    $tippb = array_pad($array, $anztipper + 1, '');

    for ($i = 0; $i < $anztipper; $i++) {
        if (0 != $lmtype) {
            $tippa[$i] = array_pad($array, $anzsp + 1, '');

            $tippb[$i] = array_pad($array, $anzsp + 1, '');

            for ($n = 0; $n < $anzsp; $n++) {
                $tippa[$i][$n] = array_pad(['_'], 7, '_');

                $tippb[$i][$n] = array_pad(['_'], 7, '_');
            }
        } else {
            $tippa[$i] = array_pad(['_'], $anzsp + 1, '_');

            $tippb[$i] = array_pad(['_'], $anzsp + 1, '_');
        }
    }

    if (0 == $lmtype) {
        $tendenz1 = array_pad(['0'], $anzsp + 1, '0');

        $tendenz0 = array_pad(['0'], $anzsp + 1, '0');

        $tendenz2 = array_pad(['0'], $anzsp + 1, '0');

        $toregesa = array_pad(['0'], $anzsp + 1, '0');

        $toregesb = array_pad(['0'], $anzsp + 1, '0');

        $anzgetippt = array_pad(['0'], $anzsp + 1, '0');

        $btip = array_pad(['false'], $anzsp + 1, '0');
    } else {
        $tendenz1 = array_pad($array, $anzsp + 1, '');

        $tendenz0 = array_pad($array, $anzsp + 1, '');

        $tendenz2 = array_pad($array, $anzsp + 1, '');

        $toregesa = array_pad($array, $anzsp + 1, '');

        $toregesb = array_pad($array, $anzsp + 1, '');

        $anzgetippt = array_pad($array, $anzsp + 1, '');

        $btip = array_pad($array, $anzsp + 1, '');

        for ($i = 0; $i < $anzsp; $i++) {
            $tendenz1[$i] = array_pad(['0'], $modus[$st - 1] + 1, '0');

            $tendenz0[$i] = array_pad(['0'], $modus[$st - 1] + 1, '0');

            $tendenz2[$i] = array_pad(['0'], $modus[$st - 1] + 1, '0');

            $toregesa[$i] = array_pad(['0'], $modus[$st - 1] + 1, '0');

            $toregesb[$i] = array_pad(['0'], $modus[$st - 1] + 1, '0');

            $anzgetippt[$i] = array_pad(['0'], $modus[$st - 1] + 1, '0');

            $btip[$i] = array_pad(['false'], $modus[$st - 1] + 1, 'false');
        }
    }

    $t = 0;

    if ($endtab < 1) {
        $endtab = $anzst;
    }

    for ($i = 1, $iMax = count($tippdaten); $i <= $iMax; $i++) {
        $dum = preg_split('[|]', $tippdaten[$i - 1]);

        $op1 = $dum[0];               // Nick
        $op3 = mb_substr($dum[1], 2) - 1;   // Spieltagsnummer
        $op4 = mb_substr($dum[1], 0, 2);   // TP
        $op6 = mb_substr($dum[1], 2, -1) - 1;

        $op7 = mb_substr($dum[1], -1) - 1;

        $op8 = $dum[3];

        if ($tippernick[$t] != $op1) {
            if ('' != $tippernick[$t]) {
                $t++;
            }

            $tippernick[$t] = $op1;
        }

        $jksp2[$t] = $op8;

        if ('GA' == $op4) {
            if (0 != $lmtype) {
                $tippa[$t][$op6][$op7] = $dum[2];

                if ($dum[2] > 0) {
                    $toregesa[$op6][$op7] += $dum[2];
                }
            } else {
                $tippa[$t][$op3] = $dum[2];

                if ($dum[2] > 0) {
                    $toregesa[$op3] += $dum[2];
                }
            }
        }

        if ('GB' == $op4) {
            if (0 != $lmtype) {
                $tippb[$t][$op6][$op7] = $dum[2];

                if ($dum[2] >= 0) {
                    $toregesb[$op6][$op7] += $dum[2];

                    $anzgetippt[$op6][$op7]++;
                }

                if ($tippb[$t][$op6][$op7] < $tippa[$t][$op6][$op7]) {
                    $tendenz1[$op6][$op7]++;
                } elseif ($tippb[$t][$op6][$op7] > $tippa[$t][$op6][$op7]) {
                    $tendenz2[$op6][$op7]++;
                } elseif ($tippa[$t][$op6][$op7] >= 0 && $tippb[$t][$op6][$op7] >= 0) {
                    $tendenz0[$op6][$op7]++;
                }
            } else {
                $tippb[$t][$op3] = $dum[2];

                if ($dum[2] >= 0) {
                    $toregesb[$op3] += $dum[2];

                    $anzgetippt[$op3]++;
                }

                if ($tippb[$t][$op3] < $tippa[$t][$op3]) {
                    $tendenz1[$op3]++;
                } elseif ($tippb[$t][$op3] > $tippa[$t][$op3]) {
                    $tendenz2[$op3]++;
                } elseif ($tippa[$t][$op3] >= 0 && $tippb[$t][$op3] >= 0) {
                    $tendenz0[$op3]++;
                }
            }
        }
    }

    if ($todo = 'einsicht') {
        $tab0 = [''];

        for ($a = 0; $a < $anztipper; $a++) {
            $tab0[] = mb_strtolower($tippernick[$a]) . (50000000 + $a);
        }

        array_shift($tab0);

        sort($tab0, SORT_STRING);
    }

    clearstatcache();
}
