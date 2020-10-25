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

        $stand = gmdate('d.m.Y H:i', filectime($file));

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

                        if ('Matches' == $schl) {
                            $anzsp = $wert;
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

                    if (0 == $lmtype) {
                    } else {
                        if ('KlFin' == $schl) {
                            $klfin = $wert;
                        }
                    }
                }

                $daten[] = $sekt . '|' . $schl . '|' . $wert . '|EOL';
            }
        }

        fclose($datei);

        array_shift($daten);

        if (!isset($titel)) {
            $titel = 'No Name';
        }

        if (0 == $lmtype) {
            if (!isset($anzteams)) {
                $anzteams = 18;
            }

            if (!isset($anzsp)) {
                $anzsp = floor($anzteams / 2);
            }

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

        if (!isset($dats)) {
            $dats = 1;
        }

        if (!isset($datm)) {
            $datm = 0;
        }

        if (!isset($datc)) {
            if ((isset($dats)) || (isset($datm))) {
                $datc = 1;
            } else {
                $datc = 0;
            }
        }

        if ((!isset($dats)) || (!isset($datm))) {
            $datc = 0;
        }

        $teams = array_pad($array, $anzteams + 2, '');

        if (0 == $lmtype) {
            $datum1 = array_pad($array, 116, '');

            $datum2 = array_pad($array, 116, '');

            $teama = array_pad($array, 116, '');

            $teamb = array_pad($array, 116, '');

            $mterm = array_pad($array, 116, '');

            for ($i = 0; $i < 116; $i++) {
                $teama[$i] = array_pad(['0'], 40, '0');

                $teamb[$i] = array_pad(['0'], 40, '0');

                $mterm[$i] = array_pad(['0'], 40, '0');
            }
        } else {
            $datum1 = array_pad($array, 7, '');

            $datum2 = array_pad($array, 7, '');

            $modus = array_pad(['1'], 7, '1');

            $teama = array_pad($array, 7, '');

            $teamb = array_pad($array, 7, '');

            $mterm = array_pad($array, 7, '');

            for ($i = 0; $i < 7; $i++) {
                $teama[$i] = array_pad(['0'], 64, '0');

                $teamb[$i] = array_pad(['0'], 64, '0');

                $mterm[$i] = array_pad($array, 64, '');

                for ($j = 0; $j < 64; $j++) {
                    $mterm[$i][$j] = array_pad(['0'], 7, '0');
                }
            }
        }

        $teams[0] = '___';

        for ($i = 1, $iMax = count($daten); $i <= $iMax; $i++) {
            $dum = preg_split('[|]', $daten[$i - 1]);

            if ('Teams' == $dum[0]) {
                $teams[$dum[1]] = stripslashes($dum[2]);
            }

            $op1 = mb_substr($dum[0], 0, 4);

            $op2 = mb_substr($dum[0], 0, 5);

            $op3 = mb_substr($dum[0], 5) - 1;

            $op4 = mb_substr($dum[1], 2) - 1;

            $op5 = mb_substr($dum[0], 4);

            $op6 = mb_substr($dum[1], 2, -1) - 1;

            $op7 = mb_substr($dum[1], -1) - 1;

            $op8 = mb_substr($dum[1], 0, 2);

            if ($op3 == $st - 1) { ////////////////////////////////////////////////// nur der benötigte Spieltag wird eingelesen
                if (('Round' == $op2) && ('D1' == $dum[1])) {
                    $datum1[$op3] = $dum[2];
                }

                if (isset($datum1[$op3])) {
                    if ('' != $datum1[$op3]) {
                        $dummy = strtotime(mb_substr($datum1[$op3], 0, 2) . ' ' . $me[(int)mb_substr($datum1[$op3], 3, 2)] . ' ' . mb_substr($datum1[$op3], 6, 4));

                        if ($dummy > -1) {
                            $datum1[$op3] = strftime('%d.%m.%Y', $dummy);
                        } else {
                            $datum1[$op3] = '';
                        }
                    }
                }

                if (('Round' == $op2) && ('D2' == $dum[1])) {
                    $datum2[$op3] = $dum[2];
                }

                if (isset($datum2[$op3])) {
                    if ('' != $datum2[$op3]) {
                        $dummy = strtotime(mb_substr($datum2[$op3], 0, 2) . ' ' . $me[(int)mb_substr($datum2[$op3], 3, 2)] . ' ' . mb_substr($datum2[$op3], 6, 4));

                        if ($dummy > -1) {
                            $datum2[$op3] = strftime('%d.%m.%Y', $dummy);
                        } else {
                            $datum2[$op3] = '';
                        }
                    }
                }

                if (('Round' == $op2) && ('TA' == $op8)) {
                    $teama[$op3][$op4] = $dum[2];
                }

                if (('Round' == $op2) && ('TB' == $op8)) {
                    $teamb[$op3][$op4] = $dum[2];
                }

                if (0 == $lmtype) {
                    if (('Round' == $op2) && ('AT' == $op8)) {
                        $mterm[$op3][$op4] = $dum[2];
                    }
                } else {
                    if (('Round' == $op2) && ('MO' == $dum[1])) {
                        $modus[$op3] = $dum[2];
                    }

                    if (('Round' == $op2) && ('AT' == $op8)) {
                        $mterm[$op3][$op6][$op7] = $dum[2];
                    }
                }
            }
        }
    }
}
