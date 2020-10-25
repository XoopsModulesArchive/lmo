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
    $liga0 = mb_substr($dateien[$lnr], 0, -4);

    $lmtype0 = 0;

    if ('.l98' == mb_substr($file, -4)) {
        $daten = [''];

        $sekt = '';

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
                    if ('Name' == $schl) {
                        $titel0 = stripslashes($wert);
                    }

                    if ('Type' == $schl) {
                        $lmtype0 = stripslashes($wert);
                    }

                    if ('Teams' == $schl) {
                        $anzteams = $wert;
                    }
                }

                $daten[] = $sekt . '|' . $schl . '|' . $wert . '|EOL';
            }
        }

        fclose($datei);

        array_shift($daten);

        clearstatcache();

        if (!isset($titel)) {
            $titel = 'No Name';
        }

        if (0 != $lmtype0) {
            if (!isset($anzteams)) {
                $anzteams = 16;
            }
        }

        $anzst0 = mb_strlen(decbin($anzteams - 1));

        for ($i = 1, $iMax = count($daten); $i <= $iMax; $i++) {
            $dum = preg_split('[|]', $daten[$i - 1]);

            if ('Teams' == $dum[0]) {
                $teams[$dum[1]] = stripslashes($dum[2]);
            }

            $op2 = mb_substr($dum[0], 0, 5);

            if ('Round' == $op2) {
                $spieltag0 = mb_substr($dum[0], 5);

                $op8 = mb_substr($dum[1], 0, 2);

                if ('D1' == $dum[1]) {
                    $datum10 = $dum[2];
                } elseif ('D2' == $dum[1]) {
                    $datum20 = $dum[2];
                } elseif ('MO' == $dum[1] && 0 != $lmtype0) {
                    $modus0 = $dum[2];
                } elseif ('TA' == $op8) {
                    $teama0 = $dum[2];
                } elseif ('TB' == $op8) {
                    $teamb0 = $dum[2];
                } elseif ('AT' == $op8) {
                    $zeit0 = zeit($dum[2], $datum10, $datum20);

                    if ($zeit0 > $now && $zeit0 < $then && $teama0 > 0) {
                        $spiel0 = mb_substr($dum[1], 2);

                        if (0 == $lmtype0) {
                            $modus0 = 1;
                        }

                        $liga[] = $liga0;

                        $titel[] = $titel0;

                        $lmtype[] = $lmtype0;

                        $anzst[] = $anzst0;

                        $spieltag[] = $spieltag0;

                        $modus[] = $modus0;

                        $spiel[] = $spiel0;

                        $teama[] = $teams[$teama0];

                        $teamb[] = $teams[$teamb0];

                        $zeit[] = strftime('%A, %d.%m.%Y %R', $zeit0);

                        $anzspiele++;
                    }
                }
            }
        }
    }
}
clearstatcache();
