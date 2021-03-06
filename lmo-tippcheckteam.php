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
$dumma = [''];
$team = [''];
$pswfile = $tippauthtxt;
$datei = fopen($pswfile, 'rb');
while (!feof($datei)) {
    $zeile = fgets($datei, 1000);

    $zeile = rtrim($zeile);

    if ('' != $zeile) {
        $dumma[] = $zeile;
    }
}
fclose($datei);
$v = 0; // Teamnummer
array_shift($dumma);

$tipperteam = array_pad($array, count($dumma) + 1, '');

for ($i = 0, $iMax = count($dumma); $i < $iMax; $i++) {
    $dummb1 = preg_split('[|]', $dumma[$i]);

    if ('' != $dummb1[5]) {
        $gef = 0;

        for ($j = 0; $j < $v && 0 == $gef; $j++) {
            if ($team[$j] == $dummb1[5]) { // Team schonmal gefunden
                $tipperteam[$j]++;

                $gef = 1;
            }
        }

        if (0 == $gef) {
            $team[$v] = $dummb1[5];

            $tipperteam[$v]++;

            $v++;
        }
    }
}

$gef = 0;
for ($j = 0; $j < $v && 0 == $gef; $j++) {
    if (1 == $xtippervereinradio) {
        if ($xtippervereinalt == $team[$j]) {
            $gef = 1;

            if ($tipperteam[$j] >= $tipperimteam && 0 != $tipperimteam) { // max. Tipperanzahl schon erreicht
                $newpage = 0;

                echo '<font color=red>' . $text[642] . '</font><br>';
            }
        }
    }

    if (2 == $xtippervereinradio) {
        if ($xtippervereinneu == $team[$j]) { // Team existiert bereits
            $gef = 1;

            $newpage = 0;

            echo '<font color=red>' . $text[643] . '</font><br>';
        }
    }
}
