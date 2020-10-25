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
if ('' != $file) {
    if ('.l98' == mb_substr($file, -4)) {
        $daten = [''];

        $sekt = '';

        $stand = date('d.m.Y H:i', filectime($file));

        $datei = fopen($file, 'rb');

        while (!feof($datei)) {
            $zeile = fgets($datei, 1000);

            $zeile = rtrim($zeile);

            $zeile = trim($zeile);

            if (('[' == mb_substr($zeile, 0, 1)) && (']' == mb_substr($zeile, -1))) {
                $sekt = trim(mb_substr($zeile, 1, -1));
            } elseif ((false !== mb_strpos($zeile, '=')) && (';' != mb_substr($zeile, 0, 1))) {
                $schl = trim(mb_substr($zeile, 0, mb_strpos($zeile, '=')));

                $wert = trim(mb_substr($zeile, mb_strpos($zeile, '=') + 1));

                if ('Options' == $sekt) {
                    if ('Title' == $schl) {
                        $lmvers = $wert;
                    }

                    if ('Name' == $schl) {
                        $titel = stripslashes($wert);
                    }

                    if ('Type' == $schl) {
                        $lmtype = stripslashes($wert);
                    }

                    if (!isset($lmtype)) {
                        $lmtype = 0;
                    }

                    if ('Teams' == $schl) {
                        $anzteams = $wert;
                    }

                    if (0 == $lmtype) {
                        if ('Rounds' == $schl) {
                            $anzst = $wert;
                        }
                    }

                    if (!isset($st)) {
                        if ('Actual' == $schl) {
                            $st = $wert;
                        }
                    }

                    if ('Actual' == $schl) {
                        $stx = $wert;
                    }
                }

                $daten[] = $sekt . '|' . $schl . '|' . $wert . '|EOL';
            }
        }

        fclose($datei);

        if (!isset($st)) {
            $st = 1;
        }

        if (!isset($stx)) {
            $stx = 1;
        }

        array_shift($daten);

        if (!isset($lmvers)) {
            $lmvers = 'k.A.';
        }

        if (!isset($titel)) {
            $titel = 'No Name';
        }

        if (0 == $lmtype) {
            if (!isset($anzst)) {
                $anzst = floor($anzteams * ($anzteams - 1) / $anzsp);
            }
        } else {
            if (!isset($anzteams)) {
                $anzteams = 16;
            }

            $anzsp = floor($anzteams / 2);

            $anzst = mb_strlen(decbin($anzteams - 1));
        }
    }
}
