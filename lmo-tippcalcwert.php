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
if (!isset($all)) {
    $all = 0;
}
if ('yes' == $all && 0 != $all) {
    $all = 1;
}
if (1 == $all) {
    $auswertfile = $dirtipp . 'auswert/gesamt.aus';
} else {
    $auswertfile = $dirtipp . 'auswert/' . mb_substr($file, mb_strrpos($file, '/') + 1, -4) . '.aus';
}
if (!file_exists($auswertfile)) {
    echo $text[517] . '<br>';
} else {
    $datei = fopen($auswertfile, 'rb');

    $anztipper = 0;

    $eigpos = -1;

    $anzst1 = $anzst;

    if (false !== $datei) {
        $tippdaten = [''];

        $sekt = '';

        while (!feof($datei)) {
            $zeile = fgets($datei, 1000);

            $zeile = rtrim($zeile);

            $zeile = trim($zeile);

            if (('[' == mb_substr($zeile, 0, 1)) && (']' == mb_substr($zeile, -1))) {
                $sekt = trim(mb_substr($zeile, 1, -1));

                if ('[Options]' != $zeile) {
                    $tippdaten[] = $sekt . '|||EOL';

                    $anztipper++;
                }
            } elseif ((false !== mb_strpos($zeile, '=')) && (';' != mb_substr($zeile, 0, 1))) {
                $schl = trim(mb_substr($zeile, 0, mb_strpos($zeile, '=')));

                $wert = trim(mb_substr($zeile, mb_strpos($zeile, '=') + 1));

                if ('AnzLigen' == $schl) {
                    $endtab = $wert;

                    $anzst1 = $wert;
                } // nur fuer die Gesamtwertung

                elseif ('Options' != $sekt) {
                    $tippdaten[] = $sekt . '|' . $schl . '|' . $wert . '|EOL';
                }
            }
        }

        fclose($datei);
    }

    array_shift($tippdaten);

    $tippernick = array_pad($array, $anztipper + 1, '');

    $tippername = array_pad($array, $anztipper + 1, '');

    $tipperemail = array_pad($array, $anztipper + 1, '');

    $tipperteam = array_pad($array, $anztipper + 1, '');

    if (1 == $showstsiege) {
        $stsiege = array_pad($array, $anztipper + 1, '');
    }

    $spielegetipptgesamt = array_pad($array, $anztipper + 1, '0');

    $quotegesamt = array_pad($array, $anztipper + 1, '0');

    $tipppunktegesamt = array_pad($array, $anztipper + 1, '0');

    if (1 == $showzus) {
        $punkte1gesamt = array_pad($array, $anztipper + 1, '');

        $punkte2gesamt = array_pad($array, $anztipper + 1, '');

        $punkte3gesamt = array_pad($array, $anztipper + 1, '');

        $punkte4gesamt = array_pad($array, $anztipper + 1, '');

        $punkte5gesamt = array_pad($array, $anztipper + 1, '');

        $punkte6gesamt = array_pad($array, $anztipper + 1, '');
    }

    $spielegetippt = array_pad($array, $anztipper + 1, '0');

    $tipppunkte = array_pad($array, $anztipper + 1, '');

    if (1 == $showzus) {
        $punkte1 = array_pad($array, $anztipper + 1, '');

        $punkte2 = array_pad($array, $anztipper + 1, '');

        $punkte3 = array_pad($array, $anztipper + 1, '');

        $punkte4 = array_pad($array, $anztipper + 1, '');

        $punkte5 = array_pad($array, $anztipper + 1, '');

        $punkte6 = array_pad($array, $anztipper + 1, '');
    }

    for ($i = 0; $i < $anztipper; $i++) {
        $spielegetippt[$i] = array_pad(['0'], $anzst1 + 1, '0');

        $tipppunkte[$i] = array_pad(['0'], $anzst1 + 1, '0');

        if (1 == $showzus) {
            $punkte1[$i] = array_pad([''], $anzst1 + 1, '');

            $punkte2[$i] = array_pad([''], $anzst1 + 1, '');

            $punkte3[$i] = array_pad([''], $anzst1 + 1, '');

            $punkte4[$i] = array_pad([''], $anzst1 + 1, '');

            $punkte5[$i] = array_pad([''], $anzst1 + 1, '');

            $punkte6[$i] = array_pad([''], $anzst1 + 1, '');
        }
    }

    $t = 0;

    if ($endtab < 1) {
        $endtab = $anzst1;
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

            if ($op1 == $lmotippername && '' != $op1) {
                $eigpos = $t;
            }
        }

        if ('Team' == $dum[1]) {
            $tipperteam[$t] = $dum[2];
        } elseif ('Name' == $dum[1]) {
            $tippername[$t] = $dum[2];
        } elseif ('Email' == $dum[1]) {
            $tipperemail[$t] = $dum[2];
        } elseif (('nur' == $stwertmodus && ('' == $tabdat || $op3 == $endtab - 1)) || ('bis' == $stwertmodus && $op3 < $endtab)) {
            if ('SG' == $op4) {
                $spielegetippt[$t][$op3] = $dum[2];
            } elseif ('TP' == $op4) {
                $tipppunkte[$t][$op3] = $dum[2];
            } elseif (1 == $showzus) {
                if ('P1' == $op4) {
                    $punkte1[$t][$op3] = $dum[2];
                } elseif ('P2' == $op4) {
                    $punkte2[$t][$op3] = $dum[2];
                } elseif ('P3' == $op4) {
                    $punkte3[$t][$op3] = $dum[2];
                } elseif ('P4' == $op4) {
                    $punkte4[$t][$op3] = $dum[2];
                } elseif ('P5' == $op4) {
                    $punkte5[$t][$op3] = $dum[2];
                } elseif ('P6' == $op4) {
                    $punkte6[$t][$op3] = $dum[2];
                }
            }
        }
    }

    if (1 == $showstsiege && $anztipper > 0) { // Spieltagssieger ermitteln
        $tab = array_pad($array, $endtab, '');

        $a = 0;

        for ($i = 0; $i < $endtab && isset($tipppunkte[$a][$i]); $i++) {
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

            $laeng = mb_strlen($tab[$i][0]);

            for ($a = 0; $a < $anztipper; $a++) {
                $x = (int)mb_substr($tab[$i][$a], -7);

                if ($tipppunkte[$x][$i] <= 0) {
                    break;
                }

                $stsiege[$x]++;

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

    $tab0 = [''];

    for ($a = 0; $a < $anztipper; $a++) {
        $spielegetipptgesamt[$a] = array_sum($spielegetippt[$a]);

        $tipppunktegesamt[$a] = array_sum($tipppunkte[$a]);

        if (1 == $showzus) {
            $punkte1gesamt[$a] = array_sum($punkte1[$a]);

            $punkte2gesamt[$a] = array_sum($punkte2[$a]);

            $punkte3gesamt[$a] = array_sum($punkte3[$a]);

            $punkte4gesamt[$a] = array_sum($punkte4[$a]);

            $punkte5gesamt[$a] = array_sum($punkte5[$a]);

            $punkte6gesamt[$a] = array_sum($punkte6[$a]);
        }

        if ('' == $tipppunktegesamt[$a]) {
            $tipppunktegesamt[$a] = 0;
        }

        if ('' == $spielegetipptgesamt[$a]) {
            $spielegetipptgesamt[$a] = 0;
        }

        if ('' == $quotegesamt[$a]) {
            $quotegesamt[$a] = 0;
        }

        if (0 != $spielegetipptgesamt[$a]) {
            if (1 == $tippmodus) {
                $quotegesamt[$a] = number_format($tipppunktegesamt[$a] / $spielegetipptgesamt[$a], 2, '.', ',');
            }

            if (0 == $tippmodus) {
                $quotegesamt[$a] = number_format($tipppunktegesamt[$a] / $spielegetipptgesamt[$a] * 100, 2, '.', ',');
            }

            $quotegesamt[$a] *= 100;
        }

        $tt = '';

        if ('relativ' == $gewicht) {
            $tt .= (50000000 + $quotegesamt[$a]);
        } elseif ('spiele' == $gewicht) {
            $tt .= (50000000 + $spielegetipptgesamt[$a]);
        }

        $tt .= (50000000 + $tipppunktegesamt[$a]);

        for ($k = 1; $k <= 3; $k++) {
            if (1 == $k) {
                $krit = $krit1;
            } elseif (2 == $k) {
                $krit = $krit2;
            } elseif (3 == $k) {
                $krit = $krit3;
            }

            if (0 == $krit) {
                $tt .= (50000000 + $quotegesamt[$a]);
            } elseif (1 == $krit) {
                $tt .= (50000000 + $spielegetipptgesamt[$a]);
            } elseif (6 == $krit) {
                if (1 == $showstsiege) {
                    $tt .= (50000000 + $stsiege[$a]);
                }
            } elseif (1 == $showzus) {
                if (2 == $krit) {
                    $tt .= (50000000 + $punkte1gesamt[$a]);
                } elseif (3 == $krit) {
                    $tt .= (50000000 + $punkte2gesamt[$a]);
                } elseif (4 == $krit) {
                    $tt .= (50000000 + $punkte3gesamt[$a]);
                } elseif (5 == $krit) {
                    $tt .= (50000000 + $punkte6gesamt[$a]);
                }
            }
        }

        $tt .= ((50000000 - $a) . (50000000 + $a));

        $tab0[] = $tt;
    }

    array_shift($tab0);

    rsort($tab0, SORT_STRING);
}
