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

    $liga0 = mb_substr($dateien[$liganr], 0, -4);

    $lmtype0 = 0;

    if ('.tip' != mb_substr($tippfile, -4)) {
        exit;
    }

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

                    if (0 == $lmtype0) {
                        if ('HideDraw' == $schl) {
                            $hidr0 = $wert;
                        }
                    }

                    if ('DatS' == $schl) {
                        $dats0 = $wert;
                    }

                    if ('DatM' == $schl) {
                        $datm0 = $wert;
                    }

                    if ('favTeam' == $schl) {
                        $favteam = $wert;
                    }
                }

                $daten[] = $sekt . '|' . $schl . '|' . $wert . '|EOL';
            }
        }

        fclose($datei);

        array_shift($daten);

        clearstatcache();

        $tippdaten = [''];

        $sekt = '';

        $jkwert = '';

        $datei = fopen($tippfile, 'rb');

        if (false === $datei) {
            exit;
        }

        while (!feof($datei)) {
            $zeile = fgets($datei, 1000);

            $zeile = rtrim($zeile);

            $zeile = trim($zeile);

            if (('@' == mb_substr($zeile, 0, 1)) && ('@' == mb_substr($zeile, -1))) {
                $jkwert = trim(mb_substr($zeile, 1, -1));
            } elseif (('[' == mb_substr($zeile, 0, 1)) && (']' == mb_substr($zeile, -1))) {
                $sekt = trim(mb_substr($zeile, 1, -1));
            } elseif ((false !== mb_strpos($zeile, '=')) && (';' != mb_substr($zeile, 0, 1))) {
                $schl = trim(mb_substr($zeile, 0, mb_strpos($zeile, '=')));

                $wert = trim(mb_substr($zeile, mb_strpos($zeile, '=') + 1));

                $tippdaten[] = $sekt . '|' . $schl . '|' . $wert . '|' . $jkwert . '|EOL';
            }
        }

        fclose($datei);

        array_shift($tippdaten);

        if (!isset($favteam)) {
            $favteam = 0;
        }

        if (!isset($titel)) {
            $titel = 'No Name';
        }

        if (0 != $lmtype0) {
            if (!isset($anzteams)) {
                $anzteams = 16;
            }
        }

        $anzst0 = mb_strlen(decbin($anzteams - 1));

        if (!isset($dats)) {
            $dats = 1;
        }

        if (!isset($datm)) {
            $datm = 0;
        }

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
                    $rb = $i + 2; // Anfang des st merken

                    $dummy1 = '';

                    if ('' != $dum[2]) {
                        $dummy1 = strtotime(mb_substr($dum[2], 0, 2) . ' ' . $me[(int)mb_substr($dum[2], 3, 2)] . ' ' . mb_substr($dum[2], 6, 4));

                        if (1 == $tippohne && $deftime > 0) {
                            $dummy1 = $dummy1 + mb_substr($deftime, 0, 2) * 60 * 60 + mb_substr($deftime, 3, 2) * 60;
                        }

                        if ($dummy1 > -1) {
                            $dum[2] = strftime('%d.%m.%Y', $dummy1);
                        } else {
                            $dum[2] = '';
                        }
                    }

                    $datum10 = $dum[2];
                } elseif ('D2' == $dum[1]) {
                    $dummy2 = '';

                    if ('' != $dum[2]) {
                        $dummy2 = strtotime(mb_substr($dum[2], 0, 2) . ' ' . $me[(int)mb_substr($dum[2], 3, 2)] . ' ' . mb_substr($dum[2], 6, 4));

                        if (1 == $tippohne && $deftime > 0) {
                            $dummy2 = $dummy2 + mb_substr($deftime, 0, 2) * 60 * 60 + mb_substr($deftime, 3, 2) * 60;
                        }

                        if ($dummy2 > -1) {
                            $dum[2] = strftime('%d.%m.%Y', $dummy2);
                        } else {
                            $dum[2] = '';
                        }
                    }

                    $datum20 = $dum[2];
                } elseif ('MO' == $dum[1] && 0 != $lmtype0) {
                    $modus0 = $dum[2];
                } elseif ('TA' == $op8) {
                    $teama0 = $dum[2];
                } elseif ('TB' == $op8) {
                    $teamb0 = $dum[2];
                } elseif ('GA' == $op8) {
                    $goala0 = $dum[2];
                } elseif ('GB' == $op8) {
                    $goalb0 = $dum[2];
                } elseif ('SP' == $op8) {
                    $mspez0 = $dum[2];
                } elseif ('ET' == $op8 && 0 == $lmtype0 && 3 == $dum[2]) {
                    $msieg0 = 3;
                } elseif ('NT' == $op8) {
                    $mnote0 = addslashes($dum[2]);
                } elseif ('TI' == $op8) {
                    $mtipp0 = $dum[2];
                } elseif ('AT' == $op8 && $teama0 > 0) {
                    $btip = false;

                    if ($dum[2] > 0) {
                        if ($now <= $dum[2] && $then > $dum[2]) {
                            $btip = true;
                        }
                    } elseif ($dummy1 > 0) {
                        if ($now <= $dummy1 && $then > $dummy1) {
                            $btip = true;
                        }
                    } elseif ($dummy2 > 0) {
                        if ($now <= $dummy2 && $then > $dummy2) {
                            $btip = true;
                        }
                    }

                    if (true === $btip) {
                        $spiel0 = mb_substr($dum[1], 2);

                        $mterm0 = $dum[2];

                        if (0 == $lmtype0) {
                            $modus0 = 1;
                        }

                        if (!isset($mspez0)) {
                            $mspez0 = '';
                        }

                        if (!isset($msieg0)) {
                            $msieg0 = 0;
                        }

                        $liga[] = $liga0;

                        $titel[] = $titel0;

                        $lmtype[] = $lmtype0;

                        $anzst[] = $anzst0;

                        $hidr[] = $hidr0;

                        $dats[] = $dats0;

                        $datm[] = $datm0;

                        $spieltag[] = $spieltag0;

                        $modus[] = $modus0;

                        $datum1[] = $datum10;

                        $datum2[] = $datum20;

                        $spiel[] = $spiel0;

                        if ($favteam == $teama0) {
                            $teama0 = '<b>' . $teams[$teama0] . '</b>';
                        } else {
                            $teama0 = $teams[$teama0];
                        }

                        $teama[] = $teama0;

                        if ($favteam == $teamb0) {
                            $teamb0 = '<b>' . $teams[$teamb0] . '</b>';
                        } else {
                            $teamb0 = $teams[$teamb0];
                        }

                        $teamb[] = $teamb0;

                        if ('' == $goala0) {
                            $goala0 = -1;
                        }

                        if ('-1' == $goala0) {
                            $goala0 = '_';
                        }

                        if ('-2' == $goala0) {
                            $msieg0 = 1;

                            $goala0 = 0;
                        }

                        $goala[] = $goala0;

                        if ('' == $goalb0) {
                            $goalb0 = -1;
                        }

                        if ('-1' == $goalb0) {
                            $goalb0 = '_';
                        }

                        if ('-2' == $goalb0) {
                            $msieg0 = 2;

                            $goalb0 = 0;
                        }

                        $goalb[] = $goalb0;

                        if (0 == $mspez0) {
                            $mspez0 = '&nbsp;';
                        }

                        if (2 == $mspez0) {
                            $mspez0 = $text[0];
                        }

                        if (1 == $mspez0) {
                            $mspez0 = $text[1];
                        }

                        $mspez[] = $mspez0;

                        $mspez0 = 0;

                        if (!isset($mtipp0)) {
                            $mtipp0 = 0;
                        }

                        $mtipp[] = $mtipp0;

                        $mnote[] = $mnote0;

                        $msieg[] = $msieg0;

                        $msieg0 = 0;

                        $mterm[] = $mterm0;

                        $tippa[] = '';

                        $tippb[] = '';

                        $jksp[] = '';

                        $jokertippaktiv[] = '0';

                        $anzspiele++;

                        for ($j = 1, $jMax = count($tippdaten); $j <= $jMax; $j++) {
                            $dum1 = preg_split('[|]', $tippdaten[$j - 1]);

                            $op8 = mb_substr($dum1[1], 0, 2);

                            if ('GA' == $op8) {
                                $tippa0 = $dum1[2];
                            } elseif ('GB' == $op8) {
                                $tippb0 = $dum1[2];

                                $spieltag0t = mb_substr($dum1[0], 5);

                                $spiel0t = mb_substr($dum1[1], 2);

                                if ($spieltag0t == $spieltag0 && $spiel0t == $spiel0) {
                                    if ('' == $tippa0) {
                                        $tippa0 = -1;
                                    }

                                    if ('-1' == $tippa0) {
                                        $tippa0 = '_';
                                    }

                                    if ('' == $tippb0) {
                                        $tippb0 = -1;
                                    }

                                    if ('-1' == $tippb0) {
                                        $tippb0 = '_';
                                    }

                                    $tippa[$anzspiele] = $tippa0;

                                    $tippb[$anzspiele] = $tippb0;

                                    if (1 == $jokertipp) {
                                        if ($dum1[3] == $spiel0t) {
                                            $jksp[$anzspiele - 1] = $spiel0t;
                                        } else {
                                            $jksp[$anzspiele - 1] = 0;
                                        }

                                        if ($dum1[3] > 0) {
                                            for ($k = $rb, $kMax = count($daten); $k <= $kMax; $k++) {
                                                $dum2 = preg_split('[|]', $daten[$k - 1]);

                                                $op8 = mb_substr($dum2[1], 0, 2);

                                                if ('AT' == $op8) {
                                                    $spiel0 = mb_substr($dum2[1], 2);

                                                    if ($spiel0 == $dum1[3]) {
                                                        $jokertippaktiv[$anzspiele - 1] = zeit($dum2[2], $datum10, $datum20);

                                                        break;
                                                    }
                                                }
                                            }
                                        }
                                    }

                                    break;
                                }
                            }
                        }
                    }
                }
            }
        }
    }
}
clearstatcache();
