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
    $me = ['0', 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

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

                        if ('Matches' == $schl) {
                            $anzsp = $wert;
                        }
                    }

                    if (!isset($st) || ('' == $st && ('edit' == $todo || 'einsicht' == $todo))) {
                        if ('Actual' == $schl) {
                            $st = $wert;
                        }
                    }

                    if ('Actual' == $schl) {
                        $stx = $wert;
                    }

                    if (0 == $lmtype) {
                        if ('Spez' == $schl) {
                            $spez = $wert;
                        }

                        if ('HideDraw' == $schl) {
                            $hidr = $wert;
                        }

                        if ('namePkt' == $schl) {
                            $namepkt = $wert;
                        }

                        if ('nameTor' == $schl) {
                            $nametor = $wert;
                        }
                    } else {
                        if ('KlFin' == $schl) {
                            $klfin = $wert;
                        }
                    }

                    if ('DatC' == $schl) {
                        $datc = $wert;
                    }

                    if ('DatS' == $schl) {
                        $dats = $wert;
                    }

                    if ('DatM' == $schl) {
                        $datm = $wert;
                    }

                    if ('DatF' == $schl) {
                        $datf = $wert;
                    }

                    if ('urlT' == $schl) {
                        $urlt = $wert;
                    }

                    if ('urlB' == $schl) {
                        $urlb = $wert;
                    }

                    if ('favTeam' == $schl) {
                        $favteam = $wert;
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

        if (!isset($favteam)) {
            $favteam = 0;
        }

        array_shift($daten);

        if (!isset($lmvers)) {
            $lmvers = 'k.A.';
        }

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

            $spez = 1;
        }

        if (0 == $lmtype) {
            if (!isset($hidr)) {
                $hidr = 0;
            }

            if (!isset($namepkt)) {
                $namepkt = '';
            }

            if (!isset($nametor)) {
                $nametor = '';
            }

            if ('' != $namepkt) {
                $text[37] = $namepkt;
            } else {
                $namepkt = $text[37];
            }

            if ('' != $nametor) {
                $text[38] = $nametor;
            } else {
                $nametor = $text[38];
            }
        } else {
            if (!isset($klfin)) {
                $klfin = 0;
            }
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

        if (!isset($datf)) {
            $datf = '%d.%m. %H:%M';
        }

        if (!isset($urlt)) {
            $urlt = 1;
        }

        if (!isset($urlb)) {
            $urlb = 0;
        }

        $teams = array_pad($array, $anzteams + 2, '');

        $teamk = array_pad($array, $anzteams + 2, '');

        $teamu = array_pad($array, $anzteams + 2, '');

        $teamn = array_pad($array, $anzteams + 2, '');

        if (0 == $lmtype) {
            $datum1 = array_pad($array, 116, '');

            $datum2 = array_pad($array, 116, '');

            $teama = array_pad($array, 116, '');

            $teamb = array_pad($array, 116, '');

            $goala = array_pad($array, 116, '');

            $goalb = array_pad($array, 116, '');

            $mspez = array_pad($array, 116, '');

            $mberi = array_pad($array, 116, '');

            $mtipp = array_pad($array, 116, '');

            $mnote = array_pad($array, 116, '');

            $msieg = array_pad($array, 116, '');

            $mterm = array_pad($array, 116, '');

            for ($i = 0; $i < 116; $i++) {
                $teama[$i] = array_pad(['0'], 40, '0');

                $teamb[$i] = array_pad(['0'], 40, '0');

                $goala[$i] = array_pad(['_'], 40, '_');

                $goalb[$i] = array_pad(['_'], 40, '_');

                $mspez[$i] = array_pad($array, 40, '');

                $mnote[$i] = array_pad($array, 40, '');

                $mberi[$i] = array_pad($array, 40, '');

                $mtipp[$i] = array_pad($array, 40, '');

                $msieg[$i] = array_pad(['0'], 40, '0');

                $mterm[$i] = array_pad(['0'], 40, '0');
            }
        } else {
            $datum1 = array_pad($array, 7, '');

            $datum2 = array_pad($array, 7, '');

            $modus = array_pad(['1'], 7, '1');

            $teama = array_pad($array, 7, '');

            $teamb = array_pad($array, 7, '');

            $goala = array_pad($array, 7, '');

            $goalb = array_pad($array, 7, '');

            $mspez = array_pad($array, 7, '');

            $mberi = array_pad($array, 7, '');

            $mtipp = array_pad($array, 7, '');

            $mnote = array_pad($array, 7, '');

            $mterm = array_pad($array, 7, '');

            for ($i = 0; $i < 7; $i++) {
                $teama[$i] = array_pad(['0'], 64, '0');

                $teamb[$i] = array_pad(['0'], 64, '0');

                $goala[$i] = array_pad($array, 64, '');

                $goalb[$i] = array_pad($array, 64, '');

                $mspez[$i] = array_pad($array, 64, '');

                $mnote[$i] = array_pad($array, 64, '');

                $mberi[$i] = array_pad($array, 64, '');

                $mtipp[$i] = array_pad($array, 64, '');

                $mterm[$i] = array_pad($array, 64, '');

                for ($j = 0; $j < 64; $j++) {
                    $goala[$i][$j] = array_pad(['_'], 7, '_');

                    $goalb[$i][$j] = array_pad(['_'], 7, '_');

                    $mspez[$i][$j] = array_pad($array, 7, '');

                    $mnote[$i][$j] = array_pad($array, 7, '');

                    $mberi[$i][$j] = array_pad($array, 7, '');

                    $mtipp[$i][$j] = array_pad($array, 7, '');

                    $mterm[$i][$j] = array_pad(['0'], 7, '0');
                }
            }
        }

        $teams[0] = '___';

        $teamk[0] = '___';

        for ($i = 1, $iMax = count($daten); $i <= $iMax; $i++) {
            $dum = preg_split('[|]', $daten[$i - 1]);

            if ('Teams' == $dum[0]) {
                $teams[$dum[1]] = stripslashes($dum[2]);
            }

            if ('Teamk' == $dum[0]) {
                $teamk[$dum[1]] = stripslashes($dum[2]);
            }

            $op1 = mb_substr($dum[0], 0, 4);

            $op2 = mb_substr($dum[0], 0, 5);

            $op3 = mb_substr($dum[0], 5) - 1;

            $op4 = mb_substr($dum[1], 2) - 1;

            $op5 = mb_substr($dum[0], 4);

            $op6 = mb_substr($dum[1], 2, -1) - 1;

            $op7 = mb_substr($dum[1], -1) - 1;

            $op8 = mb_substr($dum[1], 0, 2);

            for ($j = 0; $j < $anzteams; $j++) {
                if ('' == $teamk[$j]) {
                    $teamk[$j] = mb_substr($teams[$j], 0, 5);
                }
            }

            if (('Team' == $op1) && ('Teams' != $dum[0]) && ('Teamk' != $dum[0]) && ('URL' == $dum[1])) {
                $teamu[$op5] = $dum[2];
            }

            if (('Team' == $op1) && ('Teams' != $dum[0]) && ('Teamk' != $dum[0]) && ('NOT' == $dum[1])) {
                $teamn[$op5] = $dum[2];
            }

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

                if (0 != $lmtype) {
                    if (('Round' == $op2) && ('MO' == $dum[1])) {
                        $modus[$op3] = $dum[2];
                    }
                }

                if (('Round' == $op2) && ('TA' == $op8)) {
                    $teama[$op3][$op4] = $dum[2];
                }

                if (('Round' == $op2) && ('TB' == $op8)) {
                    $teamb[$op3][$op4] = $dum[2];
                }

                if (0 == $lmtype) {
                    if (('Round' == $op2) && ('GA' == $op8)) {
                        $goala[$op3][$op4] = $dum[2];

                        if ('' == $goala[$op3][$op4]) {
                            $goala[$op3][$op4] = -1;
                        }

                        if ('-1' == $goala[$op3][$op4]) {
                            $goala[$op3][$op4] = '_';
                        }

                        if ('-2' == $goala[$op3][$op4]) {
                            $msieg[$op3][$op4] = 1;

                            $goala[$op3][$op4] = '0';
                        }
                    }

                    if (('Round' == $op2) && ('GB' == $op8)) {
                        $goalb[$op3][$op4] = $dum[2];

                        if ('' == $goalb[$op3][$op4]) {
                            $goalb[$op3][$op4] = -1;
                        }

                        if ('-1' == $goalb[$op3][$op4]) {
                            $goalb[$op3][$op4] = '_';
                        }

                        if ('-2' == $goalb[$op3][$op4]) {
                            $msieg[$op3][$op4] = 2;

                            $goalb[$op3][$op4] = '0';
                        }
                    }

                    if (1 == $spez) {
                        if (('Round' == $op2) && ('SP' == $op8)) {
                            $mspez[$op3][$op4] = $dum[2];

                            if (0 == $mspez[$op3][$op4]) {
                                $mspez[$op3][$op4] = '&nbsp;';
                            }

                            if (2 == $mspez[$op3][$op4]) {
                                $mspez[$op3][$op4] = $text[0];
                            }

                            if (1 == $mspez[$op3][$op4]) {
                                $mspez[$op3][$op4] = $text[1];
                            }
                        }
                    }

                    if (('Round' == $op2) && ('ET' == $op8) && (3 == $dum[2])) {
                        $msieg[$op3][$op4] = 3;
                    }

                    if (('Round' == $op2) && ('NT' == $op8)) {
                        $mnote[$op3][$op4] = addslashes($dum[2]);
                    }

                    if (('Round' == $op2) && ('BE' == $op8)) {
                        $mberi[$op3][$op4] = $dum[2];
                    }

                    if (('Round' == $op2) && ('TI' == $op8)) {
                        $mtipp[$op3][$op4] = $dum[2];
                    }

                    if (('Round' == $op2) && ('AT' == $op8)) {
                        $mterm[$op3][$op4] = $dum[2];
                    }
                } else {
                    if (('Round' == $op2) && ('GA' == $op8)) {
                        $goala[$op3][$op6][$op7] = $dum[2];

                        if ('' == $goala[$op3][$op6][$op7]) {
                            $goala[$op3][$op6][$op7] = -1;
                        }

                        if ('-1' == $goala[$op3][$op6][$op7]) {
                            $goala[$op3][$op6][$op7] = '_';
                        }
                    }

                    if (('Round' == $op2) && ('GB' == $op8)) {
                        $goalb[$op3][$op6][$op7] = $dum[2];

                        if ('' == $goalb[$op3][$op6][$op7]) {
                            $goalb[$op3][$op6][$op7] = -1;
                        }

                        if ('-1' == $goalb[$op3][$op6][$op7]) {
                            $goalb[$op3][$op6][$op7] = '_';
                        }
                    }

                    if (('Round' == $op2) && ('SP' == $op8)) {
                        $mspez[$op3][$op6][$op7] = $dum[2];

                        if (0 == $mspez[$op3][$op6][$op7]) {
                            $mspez[$op3][$op6][$op7] = '&nbsp;';
                        }

                        if (2 == $mspez[$op3][$op6][$op7]) {
                            $mspez[$op3][$op6][$op7] = $text[0];
                        }

                        if (1 == $mspez[$op3][$op6][$op7]) {
                            $mspez[$op3][$op6][$op7] = $text[1];
                        }
                    }

                    if (('Round' == $op2) && ('NT' == $op8)) {
                        $mnote[$op3][$op6][$op7] = addslashes($dum[2]);
                    }

                    if (('Round' == $op2) && ('BE' == $op8)) {
                        $mberi[$op3][$op6][$op7] = $dum[2];
                    }

                    if (('Round' == $op2) && ('TI' == $op8)) {
                        $mtipp[$op3][$op6][$op7] = $dum[2];
                    }

                    if (('Round' == $op2) && ('AT' == $op8)) {
                        $mterm[$op3][$op6][$op7] = $dum[2];
                    }
                }
            }
        }
    }
}
