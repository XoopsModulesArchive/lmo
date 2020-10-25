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
    if (0 == $m) {
        if (!isset($tabtype)) {
            $tabtype = 0;
        }

        $spiele = array_pad($array, $anzteams + 1, '0');

        $siege = array_pad($array, $anzteams + 1, '0');

        $unent = array_pad($array, $anzteams + 1, '0');

        $nieder = array_pad($array, $anzteams + 1, '0');

        $punkte = array_pad($array, $anzteams + 1, '0');

        $negativ = array_pad($array, $anzteams + 1, '0');

        $etore = array_pad($array, $anzteams + 1, '0');

        $atore = array_pad($array, $anzteams + 1, '0');

        $dtore = array_pad($array, $anzteams + 1, '0');

        $quote = array_pad($array, $anzteams + 1, '0');

        $tab0 = [''];

        $btip = array_pad($array, $anzst + 1, '');

        for ($i = 0; $i < $anzst; $i++) {
            $btip[$i] = array_pad(['false'], $anzsp + 1, 'false');
        }
    }

    $stt = 0;

    $hoy = 0;

    for ($a = 1; $a <= $anzteams; $a++) {
        if (3 == $tabtype) {
            $hoy = ($anzst / 2);
        }

        if (4 == $tabtype) {
            $endtab = ($anzst / 2);
        }

        for ($j = $hoy; $j < $endtab; $j++) {
            for ($i = 0; $i < $anzsp; $i++) {
                if (0 == $m && 1 == $a) { // nur beim ersten Tipper berechnen, ob das Spiel in die Tipp-Tabelle einfließen darf
                    if (1 == $einsichterst) {
                        $plus = 0;

                        $btip[$j][$i] = tippaenderbar($mterm[$j][$i], $datum1[$j], $datum2[$j]);
                    } elseif (2 == $einsichterst) {
                        if ('_' != $goala[$j][$i] && '_' != $goalb[$j][$i]) {
                            $btip[$j][$i] = false;
                        } else {
                            $btip[$j][$i] = true;
                        }
                    } else { // Tipps immer anzeigen
                        $btip[$j][$i] = false;
                    }

                    if (1 == $mtipp[$j][$i]) { // nicht in der Wertung
                        $btip[$j][$i] = true;
                    }
                }

                if (false === $btip[$j][$i]) {
                    if (3 == $tabtype) {
                        $hoy = ($anzst / 2);
                    }

                    if (4 == $tabtype) {
                        $endtab = ($anzst / 2);
                    }

                    if (('_' != $goaltippa[$j][$i]) && ('_' != $goaltippb[$j][$i]) && (((0 == $tabtype or 3 == $tabtype or 4 == $tabtype) && (($a == $teama[$j][$i]) || ($a == $teamb[$j][$i]))) || ((1 == $tabtype) && ($a == $teama[$j][$i])) || ((2 == $tabtype) && ($a == $teamb[$j][$i])))) {
                        if ($stt < $j + 1) {
                            $stt = $j + 1;
                        }

                        $p0s = $pns;

                        $p0u = $pnu;

                        $p0n = $pnn;

                        $spiele[$a] += 1;

                        if ($a == $teama[$j][$i]) {
                            $etore[$a] += $goaltippa[$j][$i];

                            $atore[$a] += $goaltippb[$j][$i];

                            if ($goaltippa[$j][$i] > $goaltippb[$j][$i]) {
                                $siege[$a] += 1;

                                $punkte[$a] += $p0s;

                                if (2 == $minus) {
                                    $negativ[$a] += $p0n;
                                }
                            } elseif ($goaltippa[$j][$i] < $goaltippb[$j][$i]) {
                                $nieder[$a] += 1;

                                $punkte[$a] += $p0n;

                                if (2 == $minus) {
                                    $negativ[$a] += $p0s;
                                }
                            } elseif ($goaltippa[$j][$i] == $goaltippb[$j][$i]) {
                                $unent[$a] += 1;

                                $punkte[$a] += $p0u;

                                if (2 == $minus) {
                                    $negativ[$a] += $p0u;
                                }
                            }
                        }

                        if ($a == $teamb[$j][$i]) {
                            $etore[$a] += $goaltippb[$j][$i];

                            $atore[$a] += $goaltippa[$j][$i];

                            if ($goaltippa[$j][$i] < $goaltippb[$j][$i]) {
                                $siege[$a] += 1;

                                $punkte[$a] += $p0s;

                                if (2 == $minus) {
                                    $negativ[$a] += $p0n;
                                }
                            } elseif ($goaltippa[$j][$i] > $goaltippb[$j][$i]) {
                                $nieder[$a] += 1;

                                $punkte[$a] += $p0n;

                                if (2 == $minus) {
                                    $negativ[$a] += $p0s;
                                }
                            } elseif ($goaltippa[$j][$i] == $goaltippb[$j][$i]) {
                                $unent[$a] += 1;

                                $punkte[$a] += $p0u;

                                if (2 == $minus) {
                                    $negativ[$a] += $p0u;
                                }
                            }
                        }
                    } // ende if(($goaltippa[$j][$i]!="_") && ($goaltippb[$j][$i]!="_") &&
                } // ende if($btip[$j][$i]==false)
            } // ende for($i=0;$i<$anzsp;$i++)
        } // ende for($j=$hoy;$j<$endtab;$j++)
        if (0 == $tabtype or 3 == $tabtype or 4 == $tabtype) {
            $punkte[$a] -= $strafp[$a];

            if (2 == $minus) {
                $negativ[$a] -= $strafm[$a];
            }
        }

        if ($m == ($anztipper - 1)) {
            $dtore[$a] = $etore[$a] - $atore[$a];

            $quote[$a] = 0;

            if (0 != $spiele[$a]) {
                $quote[$a] = number_format($punkte[$a] / $spiele[$a], 2, '.', ',');
            }

            $quote[$a] *= 100;

            if (0 == $kegel) {
                $tab0[] = (50000000 + $quote[$a]) . (50000000 + $punkte[$a]) . (50000000 - $negativ[$a]) . (50000000 + $dtore[$a]) . (50000000 + $etore[$a]) . (50000000 + $a);
            } else {
                $tab0[] = (50000000 + $quote[$a]) . (50000000 + $punkte[$a]) . (50000000 - $negativ[$a]) . (50000000 + $etore[$a]) . (50000000 + $dtore[$a]) . (50000000 + $a);
            }
        }
    }  // ende for($a=1;$a<=$anzteams;$a++)

    if ($m == ($anztipper - 1)) {
        array_shift($tab0);

        rsort($tab0, SORT_STRING);

        if (1 == $direkt) {
            $cba = 1;

            for ($abc = 1; $abc < $anzteams; $abc++) {
                $x1 = mb_substr($tab0[$abc - 1], 7, 9);

                $x2 = mb_substr($tab0[$abc], 7, 9);

                if ($x1 == $x2) {
                    $cba++;
                }

                if (($x1 != $x2) || (($abc == $anzteams - 1) && ($x1 == $x2))) {
                    if ($cba > 1) {
                        $subteams = '';

                        for ($b = 1; $b <= $cba; $b++) {
                            if ($b > 1) {
                                $subteams .= '.';
                            }

                            if (($abc == $anzteams - 1) && ($x1 == $x2)) {
                                $subteams .= (int)mb_substr($tab0[$abc - $b + 1], 42);
                            } else {
                                $subteams .= (int)mb_substr($tab0[$abc - $b], 42);
                            }
                        }

                        $anzcnt = 0;

                        require 'lmo-tippcalctable1.php';

                        if ($anzcnt > 0) {
                            for ($b = 1, $bMax = count($tab1); $b <= $bMax; $b++) {
                                for ($f = 0, $fMax = count($tab0); $f < $fMax; $f++) {
                                    if ((int)mb_substr($tab0[$f], 42) == (int)mb_substr($tab1[$b - 1], 42)) {
                                        $tab0[$f] = mb_substr($tab0[$f], 0, 17 - mb_strlen($b)) . $b . mb_substr($tab0[$f], 17);
                                    }
                                }
                            }
                        }
                    }

                    $cba = 1;
                }
            }

            rsort($tab0, SORT_STRING);
        } // ende if($direkt==1)
    } // ende if($m==($anztipper-1))
} // ende if($file!="")
