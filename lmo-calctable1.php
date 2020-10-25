<?php

//
// LigaManager Online 3.02b
// Copyright (C) 1997-2002 by Frank Hollwitz
// webmaster@hollwitz.de / http://php.hollwitz.de
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
if (('' != $file) && ('' != $subteams)) {
    $subteam = preg_split('[.]', $subteams);

    $spiele1 = array_pad($array, $anzteams + 1, '');

    $siege1 = array_pad($array, $anzteams + 1, '');

    $unent1 = array_pad($array, $anzteams + 1, '');

    $nieder1 = array_pad($array, $anzteams + 1, '');

    $punkte1 = array_pad($array, $anzteams + 1, '');

    $negativ1 = array_pad($array, $anzteams + 1, '');

    $etore1 = array_pad($array, $anzteams + 1, '');

    $atore1 = array_pad($array, $anzteams + 1, '');

    $dtore1 = array_pad($array, $anzteams + 1, '');

    $mcalc = array_pad($array, 116, '');

    for ($i = 0; $i < 116; $i++) {
        $mcalc[$i] = array_pad($array, 40, '0');
    }

    $tab1 = [''];

    for ($a = 1; $a <= $anzteams; $a++) {
        for ($j = 0; $j < $endtab; $j++) {
            for ($i = 0; $i < $anzsp; $i++) {
                $b = 0;

                for ($c = 0, $cMax = count($subteam); $c < $cMax; $c++) {
                    if ($subteam[$c] == $teama[$j][$i]) {
                        $b++;
                    } elseif ($subteam[$c] == $teamb[$j][$i]) {
                        $b++;
                    }
                }

                if ((2 == $b) && ($mcalc[$j][$i] < 2) && ('_' != $goala[$j][$i]) && ('_' != $goalb[$j][$i]) && (((0 == $tabtype) && (($a == $teama[$j][$i]) || ($a == $teamb[$j][$i]))) || ((1 == $tabtype) && ($a == $teama[$j][$i])) || ((2 == $tabtype) && ($a == $teamb[$j][$i])))) {
                    $mcalc[$j][$i] += 1;

                    $anzcnt++;

                    $p0s = $pns;

                    $p0u = $pnu;

                    $p0n = $pnn;

                    if (1 == $spez) {
                        if ($mspez[$j][$i] == $text[0]) {
                            $p0s = $pxs;

                            $p0u = $pxu;

                            $p0n = $pxn;
                        }

                        if ($mspez[$j][$i] == $text[1]) {
                            $p0s = $pps;

                            $p0u = $ppu;

                            $p0n = $ppn;
                        }
                    }

                    $spiele1[$a] += 1;

                    if (($a == $teama[$j][$i]) || (($a == $teamb[$j][$i]) && (3 == $msieg[$j][$i]))) {
                        $etore1[$a] += $goala[$j][$i];

                        $atore1[$a] += $goalb[$j][$i];

                        if (1 == $msieg[$j][$i]) {
                            $siege1[$a] += 1;

                            $punkte1[$a] += $p0s;

                            if (2 == $minus) {
                                $negativ1[$a] += $p0n;
                            }
                        } elseif (2 == $msieg[$j][$i]) {
                            $nieder1[$a] += 1;

                            $punkte1[$a] += $p0n;

                            if (2 == $minus) {
                                $negativ1[$a] += $p0s;
                            }
                        } else {
                            if ($goala[$j][$i] > $goalb[$j][$i]) {
                                $siege1[$a] += 1;

                                $punkte1[$a] += $p0s;

                                if (2 == $minus) {
                                    $negativ1[$a] += $p0n;
                                }
                            } elseif ($goala[$j][$i] < $goalb[$j][$i]) {
                                $nieder1[$a] += 1;

                                $punkte1[$a] += $p0n;

                                if (2 == $minus) {
                                    $negativ1[$a] += $p0s;
                                }
                            } elseif ($goala[$j][$i] == $goalb[$j][$i]) {
                                $unent1[$a] += 1;

                                $punkte1[$a] += $p0u;

                                if (2 == $minus) {
                                    $negativ1[$a] += $p0u;
                                }
                            }
                        }
                    }

                    if (($a == $teamb[$j][$i]) && (3 != $msieg[$j][$i])) {
                        $etore1[$a] += $goalb[$j][$i];

                        $atore1[$a] += $goala[$j][$i];

                        if (2 == $msieg[$j][$i]) {
                            $siege1[$a] += 1;

                            $punkte1[$a] += $p0s;

                            if (2 == $minus) {
                                $negativ1[$a] += $p0n;
                            }
                        } elseif (1 == $msieg[$j][$i]) {
                            $nieder1[$a] += 1;

                            $punkte1[$a] += $p0n;

                            if (2 == $minus) {
                                $negativ1[$a] += $p0s;
                            }
                        } elseif (0 == $msieg[$j][$i]) {
                            if ($goala[$j][$i] < $goalb[$j][$i]) {
                                $siege1[$a] += 1;

                                $punkte1[$a] += $p0s;

                                if (2 == $minus) {
                                    $negativ1[$a] += $p0n;
                                }
                            } elseif ($goala[$j][$i] > $goalb[$j][$i]) {
                                $nieder1[$a] += 1;

                                $punkte1[$a] += $p0n;

                                if (2 == $minus) {
                                    $negativ1[$a] += $p0s;
                                }
                            } elseif ($goala[$j][$i] == $goalb[$j][$i]) {
                                $unent1[$a] += 1;

                                $punkte1[$a] += $p0u;

                                if (2 == $minus) {
                                    $negativ1[$a] += $p0u;
                                }
                            }
                        }
                    }
                }
            }
        }

        $dtore1[$a] = $etore1[$a] - $atore1[$a];

        for ($c = 0, $cMax = count($subteam); $c < $cMax; $c++) {
            if ($subteam[$c] == $a) {
                if (0 == $kegel) {
                    $tab1[] = (50000000 + $punkte1[$a]) . (50000000 - $negativ1[$a]) . (50000000 + $dtore1[$a]) . (50000000 + $etore1[$a]) . (50000000 + $a);
                } else {
                    $tab1[] = (50000000 + $punkte1[$a]) . (50000000 - $negativ1[$a]) . (50000000 + $etore1[$a]) . (50000000 + $dtore1[$a]) . (50000000 + $a);
                }
            }
        }
    }

    array_shift($tab1);

    sort($tab1, SORT_STRING);
}
