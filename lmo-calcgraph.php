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
if ('' != $file) {
    $spiele = array_pad($array, $anzteams + 1, '0');

    $siege = array_pad($array, $anzteams + 1, '0');

    $unent = array_pad($array, $anzteams + 1, '0');

    $nieder = array_pad($array, $anzteams + 1, '0');

    $punkte = array_pad($array, $anzteams + 1, '0');

    $negativ = array_pad($array, $anzteams + 1, '0');

    $etore = array_pad($array, $anzteams + 1, '0');

    $atore = array_pad($array, $anzteams + 1, '0');

    $dtore = array_pad($array, $anzteams + 1, '0');

    $taba = array_pad($array, $anzst + 1, '');

    for ($i = 0; $i < $anzst; $i++) {
        $taba[$i] = [''];
    }

    $platz = array_pad($array, $anzteams + 1, '');

    for ($i = 0; $i < $anzteams; $i++) {
        $platz[$i] = [''];

        $platz[$i] = array_pad($array, $anzst + 1, '');
    }

    for ($jyz = 0; $jyz < $anzst; $jyz++) {
        $sttest = false;

        $endtab = $jyz + 1;

        for ($a = 1; $a <= $anzteams; $a++) {
            for ($i = 0; $i < $anzsp; $i++) {
                if (('_' != $goala[$jyz][$i]) && ('_' != $goalb[$jyz][$i]) && (((0 == $tabtype) && (($a == $teama[$jyz][$i]) || ($a == $teamb[$jyz][$i]))) || ((1 == $tabtype) && ($a == $teama[$jyz][$i])) || ((2 == $tabtype) && ($a == $teamb[$jyz][$i])))) {
                    $sttest = true;

                    $p0s = $pns;

                    $p0u = $pnu;

                    $p0n = $pnn;

                    if (1 == $spez) {
                        if ($mspez[$jyz][$i] == $text[0]) {
                            $p0s = $pxs;

                            $p0u = $pxu;

                            $p0n = $pxn;
                        }

                        if ($mspez[$jyz][$i] == $text[1]) {
                            $p0s = $pps;

                            $p0u = $ppu;

                            $p0n = $ppn;
                        }
                    }

                    $spiele[$a] += 1;

                    if (($a == $teama[$jyz][$i]) || (($a == $teamb[$jyz][$i]) && (3 == $msieg[$jyz][$i]))) {
                        $etore[$a] += $goala[$jyz][$i];

                        $atore[$a] += $goalb[$jyz][$i];

                        if (1 == $msieg[$jyz][$i]) {
                            $siege[$a] += 1;

                            $punkte[$a] += $p0s;

                            if (2 == $minus) {
                                $negativ[$a] += $p0n;
                            }
                        } elseif (2 == $msieg[$jyz][$i]) {
                            $nieder[$a] += 1;

                            $punkte[$a] += $p0n;

                            if (2 == $minus) {
                                $negativ[$a] += $p0s;
                            }
                        } else {
                            if ($goala[$jyz][$i] > $goalb[$jyz][$i]) {
                                $siege[$a] += 1;

                                $punkte[$a] += $p0s;

                                if (2 == $minus) {
                                    $negativ[$a] += $p0n;
                                }
                            } elseif ($goala[$jyz][$i] < $goalb[$jyz][$i]) {
                                $nieder[$a] += 1;

                                $punkte[$a] += $p0n;

                                if (2 == $minus) {
                                    $negativ[$a] += $p0s;
                                }
                            } elseif ($goala[$jyz][$i] == $goalb[$jyz][$i]) {
                                $unent[$a] += 1;

                                $punkte[$a] += $p0u;

                                if (2 == $minus) {
                                    $negativ[$a] += $p0u;
                                }
                            }
                        }
                    }

                    if (($a == $teamb[$jyz][$i]) && (3 != $msieg[$jyz][$i])) {
                        $etore[$a] += $goalb[$jyz][$i];

                        $atore[$a] += $goala[$jyz][$i];

                        if (2 == $msieg[$jyz][$i]) {
                            $siege[$a] += 1;

                            $punkte[$a] += $p0s;

                            if (2 == $minus) {
                                $negativ[$a] += $p0n;
                            }
                        } elseif (1 == $msieg[$jyz][$i]) {
                            $nieder[$a] += 1;

                            $punkte[$a] += $p0n;

                            if (2 == $minus) {
                                $negativ[$a] += $p0s;
                            }
                        } elseif (0 == $msieg[$jyz][$i]) {
                            if ($goala[$jyz][$i] < $goalb[$jyz][$i]) {
                                $siege[$a] += 1;

                                $punkte[$a] += $p0s;

                                if (2 == $minus) {
                                    $negativ[$a] += $p0n;
                                }
                            } elseif ($goala[$jyz][$i] > $goalb[$jyz][$i]) {
                                $nieder[$a] += 1;

                                $punkte[$a] += $p0n;

                                if (2 == $minus) {
                                    $negativ[$a] += $p0s;
                                }
                            } elseif ($goala[$jyz][$i] == $goalb[$jyz][$i]) {
                                $unent[$a] += 1;

                                $punkte[$a] += $p0u;

                                if (2 == $minus) {
                                    $negativ[$a] += $p0u;
                                }
                            }
                        }
                    }
                }
            }
        }

        for ($a = 1; $a <= $anzteams; $a++) {
            $dtore[$a] = $etore[$a] - $atore[$a];

            $punkte[$a] -= $strafp[$a];

            if (2 == $minus) {
                $negativ[$a] -= $strafm[$a];
            }

            if (0 == $kegel) {
                $taba[$jyz][] = (50000000 + $punkte[$a]) . (50000000 - $negativ[$a]) . (50000000 + $dtore[$a]) . (50000000 + $etore[$a]) . (50000000 + $a);
            } else {
                $taba[$jyz][] = (50000000 + $punkte[$a]) . (50000000 - $negativ[$a]) . (50000000 + $etore[$a]) . (50000000 + $dtore[$a]) . (50000000 + $a);
            }

            $punkte[$a] += $strafp[$a];

            if (2 == $minus) {
                $negativ[$a] += $strafm[$a];
            }
        }

        array_shift($taba[$jyz]);

        rsort($taba[$jyz], SORT_STRING);

        if (1 == $direkt) {
            $cba = 1;

            for ($abc = 1; $abc < $anzteams; $abc++) {
                $x1 = mb_substr($taba[$jyz][$abc - 1], 7, 9);

                $x2 = mb_substr($taba[$jyz][$abc], 7, 9);

                if ($x1 == $x2) {
                    $cba++;
                }

                if (($x1 != $x2) || (($abc == $anzteams - 1) && ($x1 == $x2))) {
                    if ($cba > 1) {
                        $def = 0;

                        $subteams = '';

                        for ($b = 1; $b <= $cba; $b++) {
                            $x3 = (int)mb_substr($taba[$jyz][$abc - $b + 1], 34);

                            $x4 = (int)mb_substr($taba[$jyz][$abc - $b], 34);

                            if ($b > 1) {
                                $subteams .= '.';
                            }

                            if (($abc == $anzteams - 1) && ($x1 == $x2)) {
                                $subteams .= $x3;

                                if (($x3 == $stat1) || ($x3 == $stat2)) {
                                    $def++;
                                }
                            } else {
                                $subteams .= $x4;

                                if (($x4 == $stat1) || ($x4 == $stat2)) {
                                    $def++;
                                }
                            }
                        }

                        $anzcnt = 0;

                        if ($def > 0) {
                            require 'lmo-calctable1.php';

                            if ($anzcnt > 0) {
                                for ($b = 1, $bMax = count($tab1); $b <= $bMax; $b++) {
                                    for ($f = 0, $fMax = count($taba[$jyz]); $f < $fMax; $f++) {
                                        $x3 = (int)mb_substr($taba[$jyz][$f], 34);

                                        $x4 = (int)mb_substr($tab1[$b - 1], 34);

                                        if ($x3 == $x4) {
                                            $taba[$jyz][$f] = mb_substr($taba[$jyz][$f], 0, 17 - mb_strlen($b)) . $b . mb_substr($taba[$jyz][$f], 17);
                                        }
                                    }
                                }
                            }
                        }
                    }

                    $cba = 1;
                }
            }

            rsort($taba[$jyz], SORT_STRING);
        }

        if (1 == $hands) {
            if (0 != $handp[$endtab - 1]) {
                for ($ih = 0; $ih < $anzteams; $ih++) {
                    $handd = (int)mb_substr($handp[$endtab - 1], $ih * 2, 2);

                    if ($handd < 10) {
                        $handd = '0' . $handd;
                    }

                    $taba[$jyz][$ih] = $handd . mb_substr($taba[$jyz][$ih], 2);
                }

                sort($taba[$jyz], SORT_STRING);
            }
        }

        if (true === $sttest) {
            for ($x = 0; $x < $anzteams; $x++) {
                $x3 = (int)mb_substr($taba[$jyz][$x], 34);

                $platz[$x3][$jyz] = $x + 1;
            }
        } else {
            for ($x = 0; $x < $anzteams; $x++) {
                $x3 = (int)mb_substr($taba[$jyz][$x], 34);

                $platz[$x3][$jyz] = 0;
            }
        }
    }
}
