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
$stylestr = '';
$dumdat = 'lmo-style.css';
$datei = fopen($dumdat, 'rb');
while (!feof($datei)) {
    $zeile = fgets($datei, 1000);

    $zeile = rtrim($zeile);

    $zeile = trim($zeile);

    if ('' != $zeile) {
        $stylestr .= $zeile;
    }
}
fclose($datei);
$ebene1 = preg_split('[}]', $stylestr);
if (count($ebene1) > 0) {
    $stylearr = [''];

    for ($i = 0, $iMax = count($ebene1); $i < $iMax; $i++) {
        $ebene2 = preg_split('[{]', $ebene1[$i]);

        $ebene2[0] = trim($ebene2[0]);

        if ('.' != mb_substr($ebene2[0], 0, 1)) {
            $etitel = $ebene2[0];
        } else {
            $ebene2[0] = $etitel . $ebene2[0];
        }

        $stylearr = array_merge($stylearr, [(string)$ebene2[0] => '']);

        if (isset($ebene2[1])) {
            $ebene2[1] = trim($ebene2[1]);

            $ebene3 = preg_split('[;]', $ebene2[1]);

            if (count($ebene3) > 0) {
                $stylearr[$ebene2[0]] = [''];

                for ($j = 0, $jMax = count($ebene3); $j < $jMax; $j++) {
                    $ebene3[$j] = trim($ebene3[$j]);

                    if ('' != $ebene3[$j]) {
                        $ebene4 = preg_split('[:]', $ebene3[$j]);

                        $ebene4[0] = trim($ebene4[0]);

                        $ebene4[1] = trim($ebene4[1]);

                        $stylearr[$ebene2[0]] = array_merge($stylearr[$ebene2[0]], [(string)$ebene4[0] => (string)$ebene4[1]]);
                    }
                }
            }
        }
    }
}
