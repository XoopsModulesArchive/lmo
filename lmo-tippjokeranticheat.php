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
$jkspanti = '';
$jkspanticheat = false;
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
for ($ia = 1, $iaMax = count($tippdaten); $ia <= $iaMax; $ia++) {
    $dum = preg_split('[|]', $tippdaten[$ia - 1]);

    $op3 = mb_substr($dum[0], 5) - 1;

    if ($op3 == $st - 1) {
        $jkspanti = $dum[3];

        if ($jksp == $jkspanti) {
            $jkspanticheat = false;
        } elseif ($jkspanti > 0) {
            if (0 == $lmtype) {
                $btip = tippaenderbar($mterm[$st - 1][$jkspanti - 1], $datum1[$st - 1], $datum2[$st - 1]);
            } else {
                $jkspanti1 = mb_substr($jkspanti, 0, -1);

                $n1 = mb_substr($jkspanti, -1);

                $btip = tippaenderbar($mterm[$st - 1][$jkspanti1 - 1][$n1 - 1], $datum1[$st - 1], $datum2[$st - 1]);
            }

            if (false === $btip) {
                $jksp = $jkspanti;

                $jkspanticheat = true;

                break;
            }
        }
    }
}
clearstatcache();
