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
$tipperteam = [''];
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
for ($i = 0, $iMax = count($dumma); $i < $iMax; $i++) {
    $dummb = preg_split('[|]', $dumma[$i]);

    if ('' != $dummb[5]) {
        $gef = 0;

        for ($j = 0; $j < $v && 0 == $gef; $j++) {
            if ($team[$j] == $dummb[5]) { // Team schonmal gefunden
                $tipperteam[$j]++;

                $gef = 1;
            }
        }

        if (0 == $gef) {
            $team[$v] = $dummb[5];

            $tipperteam[$v]++;

            $v++;
        }
    }
}

$tab = [''];
for ($i = 0; $i < $v; $i++) {
    $tab[] = mb_strtolower($team[$i]) . (50000000 + $i);
}
array_shift($tab);
sort($tab, SORT_STRING);

for ($i = 0; $i < $v; $i++) {
    $j = (int)mb_substr($tab[$i], -7);

    echo '<option value="' . $team[$j] . '" ';

    if ($xtippervereinalt == $team[$j]) {
        echo 'selected';
    }

    echo '>' . $team[$j] . ' [' . $tipperteam[$j] . ']</option>';
}
