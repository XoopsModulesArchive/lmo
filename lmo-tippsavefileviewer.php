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
require_once 'lmo-tipptest.php';
if ('' != $tippfile) {
    //if(decoct(fileperms($tippfile))!=100777){chmod ($tippfile, 0777);}

    if ('.tip' == mb_substr($tippfile, -4)) {
        $daten = [''];

        if (file_exists($tippfile)) {
            $datei = fopen($tippfile, 'rb');

            while (!feof($datei)) {
                $zeile = fgets($datei, 1000);

                $zeile = trim(rtrim($zeile));

                if ('' != $zeile) {
                    $daten[] = $zeile;
                }
            }

            fclose($datei);
        }

        $datei = fopen($tippfile, 'wb');

        if (!$datei) {
            echo '<font color="#ff0000">' . $text[283] . '</font>';

            exit;
        } elseif (0 == $start1) {
            echo '<font color="#008800">' . $text[541] . '<br></font>';
        }

        flock($datei, 2);

        $stsave = array_pad($array, 116, '0');

        $round = 0;

        for ($l = 0, $lMax = count($daten); $l < $lMax; $l++) {
            if ('[Round' == mb_substr($daten[$l], 0, 6)) {
                fwrite($datei, $daten[$l] . "\n");

                $round = mb_substr($daten[$l], 6, -1);

                $jksave = 0;

                $stsave[$round] = 1;

                for ($k = $start1; $k <= $i; $k++) {
                    if ($round == $spieltag[$k]) { // getippte dazu schreiben
                        if (0 == $jksave) {
                            if ($jksp[$k] > 0) {
                                fwrite($datei, '@' . $jksp[$k] . "@\n");

                                $jksave = 1;
                            } elseif ('@' == mb_substr($daten[$l + 1], 0, 1)) {
                                $l++;

                                fwrite($datei, $daten[$l] . "\n");

                                $jksave = 1;
                            }
                        }

                        if ('_' == $tippa[$k]) {
                            fwrite($datei, 'GA' . $spiel[$k] . "=-1\n");
                        } elseif ('' == $tippa[$k]) {
                            fwrite($datei, 'GA' . $spiel[$k] . "=-1\n");
                        } else {
                            fwrite($datei, 'GA' . $spiel[$k] . '=' . $tippa[$k] . "\n");
                        }

                        if ('_' == $tippb[$k]) {
                            fwrite($datei, 'GB' . $spiel[$k] . "=-1\n");
                        } elseif ('' == $tippb[$k]) {
                            fwrite($datei, 'GB' . $spiel[$k] . "=-1\n");
                        } else {
                            fwrite($datei, 'GB' . $spiel[$k] . '=' . $tippb[$k] . "\n");
                        }
                    }
                }

                if ($k == ($i + 1) && 0 == $jksave && '@' == mb_substr($daten[$l + 1], 0, 1)) { // Joker von nicht getippten Spieltag zurückschreiben
                    $l++;

                    fwrite($datei, $daten[$l] . "\n");

                    $jksave = 1;
                }
            } elseif ('' != $daten[$l] && '@' != mb_substr($daten[$l], 0, 1)) {
                for ($k = $start1; $k <= $i; $k++) {
                    $sp = mb_substr($daten[$l], 2, mb_strpos($daten[$l], '=') - 2);

                    if ($sp == $spiel[$k] && $round == $spieltag[$k]) {
                        break; // nicht zurückschreiben
                    }
                }

                if ($k == ($i + 1)) {
                    fwrite($datei, $daten[$l] . "\n");
                }
            }
        }

        for ($k = $start1; $k <= $i; $k++) {
            if ($spieltag[$k] > 0 && 0 == $stsave[$spieltag[$k]]) { // vorher nicht getippte st dazu schreiben
                if ($k == $start1 || $spieltag[$k] != $spieltag[$k - 1]) {
                    fwrite($datei, '[Round' . $spieltag[$k] . "]\n");

                    if ($jksp[$k] > 0) {
                        fwrite($datei, '@' . $jksp[$k] . "@\n");
                    }
                }

                if ('_' == $tippa[$k]) {
                    fwrite($datei, 'GA' . $spiel[$k] . "=-1\n");
                } elseif ('' == $tippa[$k]) {
                    fwrite($datei, 'GA' . $spiel[$k] . "=-1\n");
                } else {
                    fwrite($datei, 'GA' . $spiel[$k] . '=' . $tippa[$k] . "\n");
                }

                if ('_' == $tippb[$k]) {
                    fwrite($datei, 'GB' . $spiel[$k] . "=-1\n");
                } elseif ('' == $tippb[$k]) {
                    fwrite($datei, 'GB' . $spiel[$k] . "=-1\n");
                } else {
                    fwrite($datei, 'GB' . $spiel[$k] . '=' . $tippb[$k] . "\n");
                }
            }
        }

        flock($datei, 3);

        fclose($datei);
    }

    clearstatcache();
}
