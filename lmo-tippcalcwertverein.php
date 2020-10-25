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
if (!file_exists($auswertfile)) {
    echo $text[517] . '<br>';
} else {
    $datei = fopen($auswertfile, 'rb');

    $anzteams = 0;

    if (false !== $datei) {
        $tippdaten = [''];

        $sekt = '';

        while (!feof($datei)) {
            $zeile = fgets($datei, 1000);

            $zeile = rtrim($zeile);

            $zeile = trim($zeile);

            if (('[' == mb_substr($zeile, 0, 1)) && (']' == mb_substr($zeile, -1))) {
                $sekt = trim(mb_substr($zeile, 1, -1));

                $tippdaten[] = $sekt . '|||EOL';

                $anzteams++;
            } elseif ((false !== mb_strpos($zeile, '=')) && (';' != mb_substr($zeile, 0, 1))) {
                $schl = trim(mb_substr($zeile, 0, mb_strpos($zeile, '=')));

                $wert = trim(mb_substr($zeile, mb_strpos($zeile, '=') + 1));

                $tippdaten[] = $sekt . '|' . $schl . '|' . $wert . '|EOL';
            }
        }

        fclose($datei);
    }

    array_shift($tippdaten);

    if (0 == $m) {
        $team = array_pad($array, $anzteams + 1, '0');

        $spielegetippt = array_pad($array, $anzteams + 1, '0');

        $tipppunktegesamt = array_pad($array, $anzteams + 1, '0');

        for ($i = 1; $i <= $anzteams; $i++) {
            $team[$i] = $i;
        }

        if ($endtab < 1) {
            $endtab = $anzst;
        }
    }

    for ($i = 1, $iMax = count($tippdaten); $i <= $iMax; $i++) {
        $dum = preg_split('[|]', $tippdaten[$i - 1]);

        $op1 = $dum[0];               // Nick
        $op3 = mb_substr($dum[1], 2) - 1;   // Spieltagsnummer
        $op4 = mb_substr($dum[1], 0, 2);   // TP
        if ($op3 < $endtab) {
            if ('SG' == $op4) {
                $spielegetippt[$op1] += $dum[2];
            } elseif ('TP' == $op4) {
                $tipppunktegesamt[$op1] += $dum[2];
            }
        }
    }

    if ($m == ($anztipper - 1)) {
        $tab0 = [''];

        for ($a = 1; $a <= $anzteams; $a++) {
            if ('' == $tipppunktegesamt[$a]) {
                $tipppunktegesamt[$a] = 0;
            }

            if ('' == $spielegetippt[$a]) {
                $spielegetippt[$a] = 0;
            }

            $quote = 0;

            if (0 != $spielegetippt[$a]) {
                if (1 == $tippmodus) {
                    $quote = number_format($tipppunktegesamt[$a] / $spielegetippt[$a], 2, '.', ',');
                }

                if (0 == $tippmodus) {
                    $quote = number_format($tipppunktegesamt[$a] / $spielegetippt[$a] * 100, 2, '.', ',');
                }

                $quote *= 100;
            }

            $tab0[] = (50000000 + $quote) . (50000000 + $tipppunktegesamt[$a]) . (50000000 - $a) . (50000000 + $a);
        }

        array_shift($tab0);

        rsort($tab0, SORT_STRING);
    }
}
