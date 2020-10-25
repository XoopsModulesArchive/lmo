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
require_once 'lmo-admintest.php';
if (('' != $xprogram) && ('none' != $xprogram) && ('random' != $xprogram)) {
    if ('.l98' == mb_substr($xprogram, -4)) {
        $daten = [''];

        $sekt = '';

        $datei = fopen($xprogram, 'rb');

        while (!feof($datei)) {
            $zeile = fgets($datei, 1000);

            $zeile = rtrim($zeile);

            $zeile = trim($zeile);

            if (('[' == mb_substr($zeile, 0, 1)) && (']' == mb_substr($zeile, -1))) {
                $sekt = trim(mb_substr($zeile, 1, -1));
            } elseif ((false !== mb_strpos($zeile, '=')) && (';' != mb_substr($zeile, 0, 1))) {
                $schl = trim(mb_substr($zeile, 0, mb_strpos($zeile, '=')));

                $wert = trim(mb_substr($zeile, mb_strpos($zeile, '=') + 1));

                $daten[] = $sekt . '|' . $schl . '|' . $wert . '|EOL';
            }
        }

        fclose($datei);

        array_shift($daten);

        for ($i = 1, $iMax = count($daten); $i <= $iMax; $i++) {
            $dum = preg_split('[|]', $daten[$i - 1]);

            if (('Round' == mb_substr($dum[0], 0, 5)) && ('TA' == mb_substr($dum[1], 0, 2))) {
                $yteama[mb_substr($dum[0], 5) - 1][mb_substr($dum[1], 2) - 1] = $dum[2];
            }

            if (('Round' == mb_substr($dum[0], 0, 5)) && ('TB' == mb_substr($dum[1], 0, 2))) {
                $yteamb[mb_substr($dum[0], 5) - 1][mb_substr($dum[1], 2) - 1] = $dum[2];
            }
        }
    }
}
