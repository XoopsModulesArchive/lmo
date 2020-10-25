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
$auswertfile = $dirtipp . 'auswert/' . mb_substr($file, mb_strrpos($file, '/') + 1, -4) . '.aus';
if (!file_exists($auswertfile)) {
    echo $text[517] . '<br>';
} else {
    $datei = fopen($auswertfile, 'rb');

    $anztipper = 0;

    if (false !== $datei) {
        $tippdaten = [''];

        $sekt = '';

        while (!feof($datei)) {
            $zeile = fgets($datei, 1000);

            $zeile = rtrim($zeile);

            $zeile = trim($zeile);

            if (('[' == mb_substr($zeile, 0, 1)) && (']' == mb_substr($zeile, -1))) {
                $sekt = trim(mb_substr($zeile, 1, -1));

                $anztipper++;
            } elseif ((false !== mb_strpos($zeile, '=')) && (';' != mb_substr($zeile, 0, 1))) {
                $schl = trim(mb_substr($zeile, 0, mb_strpos($zeile, '=')));

                $wert = trim(mb_substr($zeile, mb_strpos($zeile, '=') + 1));

                $tippdaten[] = $sekt . '|' . $schl . '|' . $wert . '|EOL';
            }
        }

        fclose($datei);
    }

    array_shift($tippdaten);

    $tippernick = array_pad($array, $anztipper + 1, '');

    $tipppunkte = array_pad($array, $anztipper + 1, '');

    $spielegetippt = array_pad($array, $anztipper + 1, '');

    if (1 == $showzus) {
        $punkte1 = array_pad($array, $anztipper + 1, '');

        $punkte2 = array_pad($array, $anztipper + 1, '');

        $punkte3 = array_pad($array, $anztipper + 1, '');

        $punkte6 = array_pad($array, $anztipper + 1, '');
    }

    if (2 == $kurvenmodus || 3 == $kurvenmodus) {
        $platz = array_pad($array, $anztipper + 1, '');
    }

    if ($kurvenmodus > 2) {
        $platz1 = array_pad($array, $anztipper + 1, '');

        $tipppunktegesamt = array_pad($array, $anztipper + 1, '');

        $spielegetipptgesamt = array_pad($array, $anztipper + 1, '');

        if (1 == $showzus) {
            $punkte1gesamt = array_pad($array, $anztipper + 1, '');

            $punkte2gesamt = array_pad($array, $anztipper + 1, '');

            $punkte3gesamt = array_pad($array, $anztipper + 1, '');

            $punkte6gesamt = array_pad($array, $anztipper + 1, '');
        }
    }

    for ($i = 0; $i < $anztipper; $i++) {
        $tipppunkte[$i] = array_pad([''], $anzst + 1, '');

        $spielegetippt[$i] = array_pad([''], $anzst + 1, '');

        if (1 == $showzus) {
            $punkte1[$i] = array_pad([''], $anzst + 1, '');

            $punkte2[$i] = array_pad([''], $anzst + 1, '');

            $punkte3[$i] = array_pad([''], $anzst + 1, '');

            $punkte6[$i] = array_pad([''], $anzst + 1, '');
        }

        if (2 == $kurvenmodus || 3 == $kurvenmodus) {
            $platz[$i] = array_pad([''], $anzst + 1, '');
        }

        if ($kurvenmodus > 2) {
            $platz1[$i] = array_pad([''], $anzst + 1, '');

            $tipppunktegesamt[$i] = array_pad([''], $anzst + 1, '');

            $spielegetipptgesamt[$i] = array_pad([''], $anzst + 1, '');

            if (1 == $showzus) {
                $punkte1gesamt[$i] = array_pad([''], $anzst + 1, '');

                $punkte2gesamt[$i] = array_pad([''], $anzst + 1, '');

                $punkte3gesamt[$i] = array_pad([''], $anzst + 1, '');

                $punkte6gesamt[$i] = array_pad([''], $anzst + 1, '');
            }
        }
    }

    if (2 == $kurvenmodus || 3 == $kurvenmodus) {
        $taba = array_pad($array, $anzst + 1, '');
    }

    if ($kurvenmodus > 2) {
        $tabb = array_pad($array, $anzst + 1, '');
    }

    if ($kurvenmodus > 1) {
        for ($i = 0; $i < $anzst; $i++) {
            if (2 == $kurvenmodus || 3 == $kurvenmodus) {
                $taba[$i] = [''];
            }

            if ($kurvenmodus > 2) {
                $tabb[$i] = [''];
            }
        }
    }

    $t = 0;

    if ($endtab < 1) {
        $endtab = $anzst;
    }

    for ($i = 1, $iMax = count($tippdaten); $i <= $iMax; $i++) {
        $dum = preg_split('[|]', $tippdaten[$i - 1]);

        $op1 = $dum[0];               // Nick
        $op3 = mb_substr($dum[1], 2) - 1;   // Spieltagsnummer
        $op4 = mb_substr($dum[1], 0, 2);   // TP
        if ($tippernick[$t] != $op1) {
            if ('' != $tippernick[$t]) {
                $t++;
            }

            $tippernick[$t] = $op1;

            if (-1 == $stat1 && $lmotippername == $tippernick[$t]) {
                $stat1 = $t;
            }
        }

        if ('TP' == $op4) {
            $tipppunkte[$t][$op3] = $dum[2];

            if ($kurvenmodus > 2) {
                $tipppunktegesamt[$t][$op3] = $dum[2];
            }
        } elseif ('SG' == $op4) {
            $spielegetippt[$t][$op3] = $dum[2];

            if ($kurvenmodus > 2) {
                $spielegetipptgesamt[$t][$op3] = $dum[2];
            }
        } elseif (1 == $showzus) {
            if ('P1' == $op4) {
                $punkte1[$t][$op3] = $dum[2];

                if ($kurvenmodus > 2) {
                    $punkte1gesamt[$t][$op3] = $dum[2];
                }
            } elseif ('P2' == $op4) {
                $punkte2[$t][$op3] = $dum[2];

                if ($kurvenmodus > 2) {
                    $punkte2gesamt[$t][$op3] = $dum[2];
                }
            } elseif ('P3' == $op4) {
                $punkte3[$t][$op3] = $dum[2];

                if ($kurvenmodus > 2) {
                    $punkte3gesamt[$t][$op3] = $dum[2];
                }
            } elseif ('P6' == $op4) {
                $punkte6[$t][$op3] = $dum[2];

                if ($kurvenmodus > 2) {
                    $punkte6gesamt[$t][$op3] = $dum[2];
                }
            }
        }
    }

    if ($kurvenmodus > 1 && 1 == $showstsiege && (6 == $krit1 || 6 == $krit2 || 6 == $krit3)) { // Spieltagssieger ermitteln
        $stsiege = array_pad($array, $anztipper + 1, '');

        if ($kurvenmodus > 2) {
            $stsiegegesamt = array_pad($array, $anztipper + 1, '');
        }

        for ($a = 0; $a < $anztipper; $a++) {
            $stsiege[$a] = array_pad([''], $anzst + 1, '');

            if ($kurvenmodus > 2) {
                $stsiegegesamt[$a] = array_pad([''], $anzst + 1, '');
            }
        }

        $tab = array_pad($array, $endtab, '');

        for ($i = 0; $i < $anzst; $i++) {
            $tab[$i] = [''];

            for ($a = 0; $a < $anztipper; $a++) {
                $tt = 50000000 + $tipppunkte[$a][$i];

                for ($k = 1; $k <= 3; $k++) {
                    if (1 == $k) {
                        $krit = $krit1;
                    } elseif (2 == $k) {
                        $krit = $krit2;
                    } elseif (3 == $k) {
                        $krit = $krit3;
                    }

                    if (-1 == $krit) {
                        $tt .= 50000000;
                    } elseif (0 == $krit) {
                        $tt .= (50000000 - $spielegetippt[$a][$i]);
                    } elseif (1 == $krit) {
                        $tt .= (50000000 + $spielegetippt[$a][$i]);
                    } elseif (1 == $showzus) {
                        if (2 == $krit) {
                            $tt .= (50000000 + $punkte1[$a][$i]);
                        } elseif (3 == $krit) {
                            $tt .= (50000000 + $punkte2[$a][$i]);
                        } elseif (4 == $krit) {
                            $tt .= (50000000 + $punkte3[$a][$i]);
                        } elseif (5 == $krit) {
                            $tt .= (50000000 + $punkte6[$a][$i]);
                        }
                    }
                }

                $tt .= (50000000 + $a);

                $tab[$i][] = $tt;
            }

            array_shift($tab[$i]);

            rsort($tab[$i], SORT_STRING);

            if ($anztipper > 0) {
                $laeng = mb_strlen($tab[$i][0]);
            }

            for ($a = 0; $a < $anztipper; $a++) {
                $x = (int)mb_substr($tab[$i][$a], -7);

                if ($tipppunkte[$x][$i] <= 0) {
                    break;
                }

                $stsiege[$x][$i]++;

                $poswechs = 1;

                for ($k = 0; $k <= $laeng - 24; $k += 8) {
                    if ((int)mb_substr($tab[$i][$a], $k + 1, 7) != (int)mb_substr($tab[$i][$a + 1], $k + 1, 7)) {
                        break;
                    }

                    if ($k == $laeng - 24) {
                        $poswechs = 0;
                    }
                }

                if (1 == $poswechs) {
                    break;
                }
            }
        }
    }

    if ($kurvenmodus > 1 && $anztipper > 0) {
        for ($jyz = 0; $jyz < $anzst; $jyz++) {
            for ($a = 0; $a < $anztipper; $a++) {
                if ($kurvenmodus < 4) {
                    $tt = 50000000 + $tipppunkte[$a][$jyz];

                    for ($k = 1; $k <= 3; $k++) {
                        if (1 == $k) {
                            $krit = $krit1;
                        } elseif (2 == $k) {
                            $krit = $krit2;
                        } elseif (3 == $k) {
                            $krit = $krit3;
                        }

                        if (-1 == $krit) {
                            $tt .= 50000000;
                        } elseif (0 == $krit) {
                            $tt .= (50000000 - $spielegetippt[$a][$jyz]);
                        } elseif (1 == $krit) {
                            $tt .= (50000000 + $spielegetippt[$a][$jyz]);
                        } elseif (6 == $krit) {
                            if (1 == $showstsiege) {
                                $tt .= (50000000 + $stsiege[$a][$jyz]);
                            }
                        } elseif (1 == $showzus) {
                            if (2 == $krit) {
                                $tt .= (50000000 + $punkte1[$a][$jyz]);
                            } elseif (3 == $krit) {
                                $tt .= (50000000 + $punkte2[$a][$jyz]);
                            } elseif (4 == $krit) {
                                $tt .= (50000000 + $punkte3[$a][$jyz]);
                            } elseif (5 == $krit) {
                                $tt .= (50000000 + $punkte6[$a][$jyz]);
                            }
                        }
                    }

                    $tt .= (50000000 + $a);

                    $taba[$jyz][] = $tt;
                }

                if ($kurvenmodus > 2) {
                    if ($jyz > 0) {
                        $tipppunktegesamt[$a][$jyz] += $tipppunktegesamt[$a][$jyz - 1];

                        if (1 == $showzus) {
                            $punkte1gesamt[$a][$jyz] += $punkte1gesamt[$a][$jyz - 1];

                            $punkte2gesamt[$a][$jyz] += $punkte2gesamt[$a][$jyz - 1];

                            $punkte3gesamt[$a][$jyz] += $punkte3gesamt[$a][$jyz - 1];

                            $punkte6gesamt[$a][$jyz] += $punkte6gesamt[$a][$jyz - 1];
                        }

                        if ($kurvenmodus > 1 && 1 == $showstsiege && (6 == $krit1 || 6 == $krit2 || 6 == $krit3)) {
                            $stsiegegesamt[$a][$jyz] += $stsiegegesamt[$a][$jyz - 1];
                        }

                        $spielegetipptgesamt[$a][$jyz] += $spielegetipptgesamt[$a][$jyz - 1];
                    }

                    $tt = 50000000 + $tipppunktegesamt[$a][$jyz];

                    for ($k = 1; $k <= 3; $k++) {
                        if (1 == $k) {
                            $krit = $krit1;
                        } elseif (2 == $k) {
                            $krit = $krit2;
                        } elseif (3 == $k) {
                            $krit = $krit3;
                        }

                        if (-1 == $krit) {
                            $tt .= 50000000;
                        } elseif (0 == $krit) {
                            $tt .= (50000000 - $spielegetipptgesamt[$a][$jyz]);
                        } elseif (1 == $krit) {
                            $tt .= (50000000 + $spielegetipptgesamt[$a][$jyz]);
                        } elseif (6 == $krit) {
                            if (1 == $showstsiege) {
                                $tt .= (50000000 + $stsiegegesamt[$a][$jyz]);
                            }
                        } elseif (1 == $showzus) {
                            if (2 == $krit) {
                                $tt .= (50000000 + $punkte1gesamt[$a][$jyz]);
                            } elseif (3 == $krit) {
                                $tt .= (50000000 + $punkte2gesamt[$a][$jyz]);
                            } elseif (4 == $krit) {
                                $tt .= (50000000 + $punkte3gesamt[$a][$jyz]);
                            } elseif (5 == $krit) {
                                $tt .= (50000000 + $punkte6gesamt[$a][$jyz]);
                            }
                        }
                    }

                    $tt .= (50000000 + $a);

                    $tabb[$jyz][] = $tt;
                }
            }

            if ($kurvenmodus < 4) {
                array_shift($taba[$jyz]);

                rsort($taba[$jyz], SORT_STRING);

                $laeng1 = mb_strlen($taba[$jyz][0]);
            }

            if ($kurvenmodus > 2) {
                array_shift($tabb[$jyz]);

                rsort($tabb[$jyz], SORT_STRING);

                $laeng2 = mb_strlen($tabb[$jyz][0]);
            }

            for ($x = 0; $x < $anztipper; $x++) {
                if ($kurvenmodus < 4) {
                    $x3 = (int)mb_substr($taba[$jyz][$x], -7);

                    $y = $x;

                    if ($spielegetippt[$x3][$jyz] > 0) {
                        for (; $y > 0; $y--) {
                            $poswechs = 1;

                            for ($k = 0; $k <= $laeng1 - 24; $k += 8) {
                                if ((int)mb_substr($taba[$jyz][$y], $k + 1, 7) != (int)mb_substr($taba[$jyz][$y - 1], $k + 1, 7)) {
                                    break;
                                }

                                if ($k == $laeng1 - 24) {
                                    $poswechs = 0;
                                }
                            }

                            if (1 == $poswechs) {
                                break;
                            }
                        }

                        $platz[$x3][$jyz] = $y + 1;
                    }
                }

                if ($kurvenmodus > 2) {
                    $x3 = (int)mb_substr($tabb[$jyz][$x], -7);

                    $y = $x;

                    if ($spielegetippt[$x3][$jyz] > 0) {
                        for (; $y > 0; $y--) {
                            $poswechs = 1;

                            for ($k = 0; $k <= $laeng2 - 24; $k += 8) {
                                if ((int)mb_substr($tabb[$jyz][$y], $k + 1, 7) != (int)mb_substr($tabb[$jyz][$y - 1], $k + 1, 7)) {
                                    break;
                                }

                                if ($k == $laeng2 - 24) {
                                    $poswechs = 0;
                                }
                            }

                            if (1 == $poswechs) {
                                break;
                            }
                        }

                        $platz1[$x3][$jyz] = $y + 1;
                    }
                }
            }
        }
    }
}
