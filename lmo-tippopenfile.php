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
if ('' == $tippfile) {
    exit;
}
if ('.tip' != mb_substr($tippfile, -4)) {
    exit;
}
$tippdaten = [''];
$sekt = '';
$jkwert = '';
$jksp = '';
$datei = fopen($tippfile, 'rb');
if (false === $datei) {
    exit;
}
while (!feof($datei)) {
    $zeile = fgets($datei, 1000);

    $zeile = rtrim($zeile);

    $zeile = trim($zeile);

    if (('@' == mb_substr($zeile, 0, 1)) && ('@' == mb_substr($zeile, -1))) {
        $jkwert = trim(mb_substr($zeile, 1, -1));
    } elseif (('[' == mb_substr($zeile, 0, 1)) && (']' == mb_substr($zeile, -1))) {
        $sekt = trim(mb_substr($zeile, 1, -1));
    } elseif ((false !== mb_strpos($zeile, '=')) && (';' != mb_substr($zeile, 0, 1))) {
        $schl = trim(mb_substr($zeile, 0, mb_strpos($zeile, '=')));

        $wert = trim(mb_substr($zeile, mb_strpos($zeile, '=') + 1));

        $tippdaten[] = $sekt . '|' . $schl . '|' . $wert . '|' . $jkwert . '|EOL';
    }
}
fclose($datei);
array_shift($tippdaten);
if (0 == $lmtype) {
    $goaltippa = array_pad(['_'], $anzsp + 1, '_');

    $goaltippb = array_pad(['_'], $anzsp + 1, '_');
} else {
    $anzsp = $anzteams;

    for ($i = 0; $i < $st; $i++) {
        $anzsp /= 2;
    }

    if ((1 == $klfin) && ($st == $anzst)) {
        $anzsp += 1;
    }

    $goaltippa = array_pad($array, $anzsp + 1, '');

    $goaltippb = array_pad($array, $anzsp + 1, '');

    for ($i = 0; $i < $anzsp; $i++) {
        $goaltippa[$i] = array_pad(['_'], $modus[$st - 1] + 1, '_');

        $goaltippb[$i] = array_pad(['_'], $modus[$st - 1] + 1, '_');
    }
}
for ($i = 1, $iMax = count($tippdaten); $i <= $iMax; $i++) {
    $dum = preg_split('[|]', $tippdaten[$i - 1]);

    $op2 = mb_substr($dum[0], 0, 5);

    $op3 = mb_substr($dum[0], 5) - 1;

    if ($op3 == $st - 1) { ////////////////////////////////////////////////// nur der benötigte Spieltag wird eingelesen
        $jksp = $dum[3];

        $op4 = mb_substr($dum[1], 2) - 1;

        $op6 = mb_substr($dum[1], 2, -1) - 1;

        $op7 = mb_substr($dum[1], -1) - 1;

        $op8 = mb_substr($dum[1], 0, 2);

        if (0 == $lmtype) {
            if (('Round' == $op2) && ('GA' == $op8)) {
                $goaltippa[$op4] = $dum[2];

                if ('' == $goaltippa[$op4]) {
                    $goaltippa[$op4] = -1;
                }

                if ('-1' == $goaltippa[$op4]) {
                    $goaltippa[$op4] = '_';
                }

                if ('-2' == $goaltippa[$op4]) {
                    $msieg[$op3][$op4] = 1;

                    $goaltippa[$op4] = '0';
                }
            }

            if (('Round' == $op2) && ('GB' == $op8)) {
                $goaltippb[$op4] = $dum[2];

                if ('' == $goaltippb[$op4]) {
                    $goaltippb[$op4] = -1;
                }

                if ('-1' == $goaltippb[$op4]) {
                    $goaltippb[$op4] = '_';
                }

                if ('-2' == $goaltippb[$op4]) {
                    $msieg[$op3][$op4] = 2;

                    $goaltippb[$op4] = '0';
                }
            }
        } else {
            if (('Round' == $op2) && ('GA' == $op8)) {
                $goaltippa[$op6][$op7] = $dum[2];

                if ('' == $goaltippa[$op6][$op7]) {
                    $goaltippa[$op6][$op7] = -1;
                }

                if ('-1' == $goaltippa[$op6][$op7]) {
                    $goaltippa[$op6][$op7] = '_';
                }
            }

            if (('Round' == $op2) && ('GB' == $op8)) {
                $goaltippb[$op6][$op7] = $dum[2];

                if ('' == $goaltippb[$op6][$op7]) {
                    $goaltippb[$op6][$op7] = -1;
                }

                if ('-1' == $goaltippb[$op6][$op7]) {
                    $goaltippb[$op6][$op7] = '_';
                }
            }
        } // ende else
    } // ende nur benötigter st
} // ende for($i=1;$i<=count($tippdaten);$i++)
clearstatcache();
