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
// Spielerstatistik-AddOn 1.03
// Copyright (C) 2002 by Rene Marth
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
//Hier alle *lang.txt-Dateien eintragen
$dumdat = ['lmo-lang.txt', 'lmo-tipplang.txt', 'lmo-statlang.txt', 'lmo-zustatlang.txt'];

//if($action=="tipp" || $action=="admin"){array_push($dumdat,"lmo-tipplang.txt");}

$dumma = [''];
$text = [''];
for ($i = 0, $iMax = count($dumdat); $i < $iMax; $i++) {
    if ($datei = @fopen($dumdat[$i], 'rb')) {
        while (!feof($datei)) {
            $zeile = fgets($datei, 1000);

            $zeile = rtrim($zeile);

            if ('' != $zeile) {
                $dumma[] = $zeile;
            }
        }

        fclose($datei);

        array_shift($dumma);

        for ($j = 0, $jMax = count($dumma); $j < $jMax; $j++) {
            $schl = (int)trim(mb_substr($dumma[$j], 0, mb_strpos($dumma[$j], '=')));

            $wert = trim(mb_substr($dumma[$j], mb_strpos($dumma[$j], '=') + 1));

            $text[$schl] = $wert;
        }
    }

    clearstatcache();
}
$orgpkt = $text[37];
$orgtor = $text[38];
