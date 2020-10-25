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
require_once 'lmo-tipptest.php';
if ('' != $file && $st > 0 && '' != $lmotippername) {
    $einsichtfile = $dirtipp . 'einsicht/' . mb_substr($file, mb_strrpos($file, '/') + 1, -4) . '_' . $st . '.ein';

    //if(decoct(fileperms($einsichtfile))!=100777){chmod ($einsichtfile, 0777);}

    if ('.ein' == mb_substr($einsichtfile, -4)) {
        $daten = [''];

        if (file_exists($einsichtfile)) {
            $datei = fopen($einsichtfile, 'rb');

            while (!feof($datei)) {
                $zeile = fgets($datei, 1000);

                $zeile = trim(rtrim($zeile));

                if ('' != $zeile) {
                    $daten[] = $zeile;
                }
            }

            fclose($datei);
        }

        $datei = fopen($einsichtfile, 'wb');

        if (!$datei) {
            echo '<font color="#ff0000">' . $text[283] . '</font>';

            exit;
        }

        //echo "<font color=\"#008800\">".$text[541]."<br></font>";

        flock($datei, 2);

        $nick = '';

        for ($i = 0, $iMax = count($daten); $i < $iMax; $i++) {
            if (('[' == mb_substr($daten[$i], 0, 1)) && (']' == mb_substr($daten[$i], -1))) {
                $nick = mb_substr($daten[$i], 1, -1);
            }

            if ($nick != $lmotippername) { //////////// nur die unveränderten Tipps werden zurückgeschrieben
                fwrite($datei, $daten[$i] . "\n");
            }
        }

        fwrite($datei, "\n[" . $lmotippername . "]\n"); // am Ende getippte dazu schreiben

        if (1 == $jokertipp) {
            fwrite($datei, '@' . $jksp . "@\n");
        }

        if (0 != $lmtype) {
            $anzsp = $anzteams;

            for ($i = 0; $i < $st; $i++) {
                $anzsp /= 2;
            }

            if ((1 == $klfin) && ($st == $anzst)) {
                $anzsp += 1;
            }
        }

        for ($j = 1; $j <= $anzsp; $j++) {
            if (0 == $lmtype) {
                if ('_' == $goaltippa[$j - 1]) {
                    fwrite($datei, 'GA' . $j . "=-1\n");
                } elseif ('' == $goaltippa[$j - 1]) {
                    fwrite($datei, 'GA' . $j . "=-1\n");
                } else {
                    fwrite($datei, 'GA' . $j . '=' . $goaltippa[$j - 1] . "\n");
                }

                if ('_' == $goaltippb[$j - 1]) {
                    fwrite($datei, 'GB' . $j . "=-1\n");
                } elseif ('' == $goaltippb[$j - 1]) {
                    fwrite($datei, 'GB' . $j . "=-1\n");
                } else {
                    fwrite($datei, 'GB' . $j . '=' . $goaltippb[$j - 1] . "\n");
                }
            } else {
                for ($n = 1; $n <= $modus[$st - 1]; $n++) {
                    if ('_' == $goaltippa[$j - 1][$n - 1]) {
                        fwrite($datei, 'GA' . $j . $n . "=-1\n");
                    } elseif ('' == $goaltippa[$j - 1][$n - 1]) {
                        fwrite($datei, 'GA' . $j . $n . "=-1\n");
                    } else {
                        fwrite($datei, 'GA' . $j . $n . '=' . $goaltippa[$j - 1][$n - 1] . "\n");
                    }

                    if ('_' == $goaltippb[$j - 1][$n - 1]) {
                        fwrite($datei, 'GB' . $j . $n . "=-1\n");
                    } elseif ('' == $goaltippb[$j - 1][$n - 1]) {
                        fwrite($datei, 'GB' . $j . $n . "=-1\n");
                    } else {
                        fwrite($datei, 'GB' . $j . $n . '=' . $goaltippb[$j - 1][$n - 1] . "\n");
                    }
                }
            }
        }

        flock($datei, 3);

        fclose($datei);
    }

    clearstatcache();
}
