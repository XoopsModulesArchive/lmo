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

    $maxs0 = array_pad($array, $anzteams + 1, '&nbsp;');

    $maxs1 = array_pad($array, $anzteams + 1, '0');

    $maxs2 = array_pad($array, $anzteams + 1, '0');

    $maxn0 = array_pad($array, $anzteams + 1, '&nbsp;');

    $maxn1 = array_pad($array, $anzteams + 1, '0');

    $maxn2 = array_pad($array, $anzteams + 1, '0');

    $ser1 = array_pad($array, $anzteams + 1, '0');

    $ser2 = array_pad($array, $anzteams + 1, '0');

    $ser3 = array_pad($array, $anzteams + 1, '0');

    $ser4 = array_pad($array, $anzteams + 1, '0');

    $tab0 = [''];

    $stt = 0;

    for ($a = 1; $a <= $anzteams; $a++) {
        for ($j = 0; $j < $endtab; $j++) {
            for ($i = 0; $i < $anzsp; $i++) {
                if (('_' != $goala[$j][$i]) && ('_' != $goalb[$j][$i]) && (((0 == $tabtype) && (($a == $teama[$j][$i]) || ($a == $teamb[$j][$i]))) || ((1 == $tabtype) && ($a == $teama[$j][$i])) || ((2 == $tabtype) && ($a == $teamb[$j][$i])))) {
                    if ($stt < $j + 1) {
                        $stt = $j + 1;
                    }

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

                    $spiele[$a] += 1;

                    if (($a == $teama[$j][$i]) || (($a == $teamb[$j][$i]) && (3 == $msieg[$j][$i]))) {
                        $etore[$a] += $goala[$j][$i];

                        $atore[$a] += $goalb[$j][$i];

                        if (1 == $msieg[$j][$i]) {
                            $siege[$a] += 1;

                            $punkte[$a] += $p0s;

                            if (2 == $minus) {
                                $negativ[$a] += $p0n;
                            }

                            $ser1[$a]++;

                            $ser2[$a]++;

                            $ser3[$a] = 0;

                            $ser4[$a] = 0;

                            if (($goala[$j][$i] - $goalb[$j][$i]) > ($maxs1[$a] - $maxs2[$a]) || ((($maxs1[$a] - $maxs2[$a]) == ($goala[$j][$i] - $goalb[$j][$i])) && ($goala[$j][$i] > $maxs1[$a]))) {
                                $maxs1[$a] = $goala[$j][$i];

                                $maxs2[$a] = $goalb[$j][$i];

                                $maxs0[$a] = $goala[$j][$i] . ':' . $goalb[$j][$i] . ' ' . $text[72] . ' ' . $teams[$teamb[$j][$i]] . ' ' . $text[73];
                            } elseif ((($maxs1[$a] - $maxs2[$a]) == ($goala[$j][$i] - $goalb[$j][$i])) && ($goala[$j][$i] == $maxs1[$a])) {
                                $maxs0[$a] .= '<br>' . $goala[$j][$i] . ':' . $goalb[$j][$i] . ' ' . $text[72] . ' ' . $teams[$teamb[$j][$i]] . ' ' . $text[73];
                            }
                        } elseif (2 == $msieg[$j][$i]) {
                            $nieder[$a] += 1;

                            $punkte[$a] += $p0n;

                            if (2 == $minus) {
                                $negativ[$a] += $p0s;
                            }

                            $ser3[$a]++;

                            $ser4[$a]++;

                            $ser1[$a] = 0;

                            $ser2[$a] = 0;

                            if (($goala[$j][$i] - $goalb[$j][$i]) < ($maxn1[$a] - $maxn2[$a]) || ((($maxn1[$a] - $maxn2[$a]) == ($goala[$j][$i] - $goalb[$j][$i])) && ($goala[$j][$i] < $maxn1[$a]))) {
                                $maxn1[$a] = $goala[$j][$i];

                                $maxn2[$a] = $goalb[$j][$i];

                                $maxn0[$a] = $goala[$j][$i] . ':' . $goalb[$j][$i] . ' ' . $text[72] . ' ' . $teams[$teamb[$j][$i]] . ' ' . $text[73];
                            } elseif ((($maxn1[$a] - $maxn2[$a]) == ($goala[$j][$i] - $goalb[$j][$i])) && ($goala[$j][$i] == $maxn1[$a])) {
                                $maxn0[$a] .= '<br>' . $goala[$j][$i] . ':' . $goalb[$j][$i] . ' ' . $text[72] . ' ' . $teams[$teamb[$j][$i]] . ' ' . $text[73];
                            }
                        } else {
                            if ($goala[$j][$i] > $goalb[$j][$i]) {
                                $siege[$a] += 1;

                                $punkte[$a] += $p0s;

                                if (2 == $minus) {
                                    $negativ[$a] += $p0n;
                                }

                                $ser1[$a]++;

                                $ser2[$a]++;

                                $ser3[$a] = 0;

                                $ser4[$a] = 0;

                                if (($goala[$j][$i] - $goalb[$j][$i]) > ($maxs1[$a] - $maxs2[$a]) || ((($maxs1[$a] - $maxs2[$a]) == ($goala[$j][$i] - $goalb[$j][$i])) && ($goala[$j][$i] > $maxs1[$a]))) {
                                    $maxs1[$a] = $goala[$j][$i];

                                    $maxs2[$a] = $goalb[$j][$i];

                                    $maxs0[$a] = $goala[$j][$i] . ':' . $goalb[$j][$i] . ' ' . $text[72] . ' ' . $teams[$teamb[$j][$i]] . ' ' . $text[73];
                                } elseif ((($maxs1[$a] - $maxs2[$a]) == ($goala[$j][$i] - $goalb[$j][$i])) && ($goala[$j][$i] == $maxs1[$a])) {
                                    $maxs0[$a] .= '<br>' . $goala[$j][$i] . ':' . $goalb[$j][$i] . ' ' . $text[72] . ' ' . $teams[$teamb[$j][$i]] . ' ' . $text[73];
                                }
                            } elseif ($goala[$j][$i] < $goalb[$j][$i]) {
                                $nieder[$a] += 1;

                                $punkte[$a] += $p0n;

                                if (2 == $minus) {
                                    $negativ[$a] += $p0s;
                                }

                                $ser3[$a]++;

                                $ser4[$a]++;

                                $ser1[$a] = 0;

                                $ser2[$a] = 0;

                                if (($goala[$j][$i] - $goalb[$j][$i]) < ($maxn1[$a] - $maxn2[$a]) || ((($maxn1[$a] - $maxn2[$a]) == ($goala[$j][$i] - $goalb[$j][$i])) && ($goala[$j][$i] < $maxn1[$a]))) {
                                    $maxn1[$a] = $goala[$j][$i];

                                    $maxn2[$a] = $goalb[$j][$i];

                                    $maxn0[$a] = $goala[$j][$i] . ':' . $goalb[$j][$i] . ' ' . $text[72] . ' ' . $teams[$teamb[$j][$i]] . ' ' . $text[73];
                                } elseif ((($maxn1[$a] - $maxn2[$a]) == ($goala[$j][$i] - $goalb[$j][$i])) && ($goala[$j][$i] == $maxn1[$a])) {
                                    $maxn0[$a] .= '<br>' . $goala[$j][$i] . ':' . $goalb[$j][$i] . ' ' . $text[72] . ' ' . $teams[$teamb[$j][$i]] . ' ' . $text[73];
                                }
                            } elseif ($goala[$j][$i] == $goalb[$j][$i]) {
                                $unent[$a] += 1;

                                $punkte[$a] += $p0u;

                                if (2 == $minus) {
                                    $negativ[$a] += $p0u;
                                }

                                $ser1[$a] = 0;

                                $ser2[$a]++;

                                $ser3[$a] = 0;

                                $ser4[$a]++;
                            }
                        }
                    }

                    if (($a == $teamb[$j][$i]) && (3 != $msieg[$j][$i])) {
                        $etore[$a] += $goalb[$j][$i];

                        $atore[$a] += $goala[$j][$i];

                        if (2 == $msieg[$j][$i]) {
                            $siege[$a] += 1;

                            $punkte[$a] += $p0s;

                            if (2 == $minus) {
                                $negativ[$a] += $p0n;
                            }

                            $ser1[$a]++;

                            $ser2[$a]++;

                            $ser3[$a] = 0;

                            $ser4[$a] = 0;

                            if (($goalb[$j][$i] - $goala[$j][$i]) > ($maxs1[$a] - $maxs2[$a]) || ((($maxs1[$a] - $maxs2[$a]) == ($goalb[$j][$i] - $goala[$j][$i])) && ($goalb[$j][$i] > $maxs1[$a]))) {
                                $maxs1[$a] = $goalb[$j][$i];

                                $maxs2[$a] = $goala[$j][$i];

                                $maxs0[$a] = $goalb[$j][$i] . ':' . $goala[$j][$i] . ' ' . $text[72] . ' ' . $teams[$teama[$j][$i]] . ' ' . $text[74];
                            } elseif ((($maxs1[$a] - $maxs2[$a]) == ($goalb[$j][$i] - $goala[$j][$i])) && ($goalb[$j][$i] == $maxs1[$a])) {
                                $maxs0[$a] .= '<br>' . $goalb[$j][$i] . ':' . $goala[$j][$i] . ' ' . $text[72] . ' ' . $teams[$teama[$j][$i]] . ' ' . $text[74];
                            }
                        } elseif (1 == $msieg[$j][$i]) {
                            $nieder[$a] += 1;

                            $punkte[$a] += $p0n;

                            if (2 == $minus) {
                                $negativ[$a] += $p0s;
                            }

                            $ser3[$a]++;

                            $ser4[$a]++;

                            $ser1[$a] = 0;

                            $ser2[$a] = 0;

                            if (($goalb[$j][$i] - $goala[$j][$i]) < ($maxn1[$a] - $maxn2[$a]) || ((($maxn1[$a] - $maxn2[$a]) == ($goalb[$j][$i] - $goala[$j][$i])) && ($goalb[$j][$i] < $maxn1[$a]))) {
                                $maxn1[$a] = $goalb[$j][$i];

                                $maxn2[$a] = $goala[$j][$i];

                                $maxn0[$a] = $goalb[$j][$i] . ':' . $goala[$j][$i] . ' ' . $text[72] . ' ' . $teams[$teama[$j][$i]] . ' ' . $text[74];
                            } elseif ((($maxn1[$a] - $maxn2[$a]) == ($goalb[$j][$i] - $goala[$j][$i])) && ($goalb[$j][$i] == $maxn1[$a])) {
                                $maxn0[$a] .= '<br>' . $goalb[$j][$i] . ':' . $goala[$j][$i] . ' ' . $text[72] . ' ' . $teams[$teama[$j][$i]] . ' ' . $text[74];
                            }
                        } elseif (0 == $msieg[$j][$i]) {
                            if ($goala[$j][$i] < $goalb[$j][$i]) {
                                $siege[$a] += 1;

                                $punkte[$a] += $p0s;

                                if (2 == $minus) {
                                    $negativ[$a] += $p0n;
                                }

                                $ser1[$a]++;

                                $ser2[$a]++;

                                $ser3[$a] = 0;

                                $ser4[$a] = 0;

                                if (($goalb[$j][$i] - $goala[$j][$i]) > ($maxs1[$a] - $maxs2[$a]) || ((($maxs1[$a] - $maxs2[$a]) == ($goalb[$j][$i] - $goala[$j][$i])) && ($goalb[$j][$i] > $maxs1[$a]))) {
                                    $maxs1[$a] = $goalb[$j][$i];

                                    $maxs2[$a] = $goala[$j][$i];

                                    $maxs0[$a] = $goalb[$j][$i] . ':' . $goala[$j][$i] . ' ' . $text[72] . ' ' . $teams[$teama[$j][$i]] . ' ' . $text[74];
                                } elseif ((($maxs1[$a] - $maxs2[$a]) == ($goalb[$j][$i] - $goala[$j][$i])) && ($goalb[$j][$i] == $maxs1[$a])) {
                                    $maxs0[$a] .= '<br>' . $goalb[$j][$i] . ':' . $goala[$j][$i] . ' ' . $text[72] . ' ' . $teams[$teama[$j][$i]] . ' ' . $text[74];
                                }
                            } elseif ($goala[$j][$i] > $goalb[$j][$i]) {
                                $nieder[$a] += 1;

                                $punkte[$a] += $p0n;

                                if (2 == $minus) {
                                    $negativ[$a] += $p0s;
                                }

                                $ser3[$a]++;

                                $ser4[$a]++;

                                $ser1[$a] = 0;

                                $ser2[$a] = 0;

                                if (($goalb[$j][$i] - $goala[$j][$i]) < ($maxn1[$a] - $maxn2[$a]) || ((($maxn1[$a] - $maxn2[$a]) == ($goalb[$j][$i] - $goala[$j][$i])) && ($goalb[$j][$i] < $maxn1[$a]))) {
                                    $maxn1[$a] = $goalb[$j][$i];

                                    $maxn2[$a] = $goala[$j][$i];

                                    $maxn0[$a] = $goalb[$j][$i] . ':' . $goala[$j][$i] . ' ' . $text[72] . ' ' . $teams[$teama[$j][$i]] . ' ' . $text[74];
                                } elseif ((($maxn1[$a] - $maxn2[$a]) == ($goalb[$j][$i] - $goala[$j][$i])) && ($goalb[$j][$i] == $maxn1[$a])) {
                                    $maxn0[$a] .= '<br>' . $goalb[$j][$i] . ':' . $goala[$j][$i] . ' ' . $text[72] . ' ' . $teams[$teama[$j][$i]] . ' ' . $text[74];
                                }
                            } elseif ($goala[$j][$i] == $goalb[$j][$i]) {
                                $unent[$a] += 1;

                                $punkte[$a] += $p0u;

                                if (2 == $minus) {
                                    $negativ[$a] += $p0u;
                                }

                                $ser1[$a] = 0;

                                $ser2[$a]++;

                                $ser3[$a] = 0;

                                $ser4[$a]++;
                            }
                        }
                    }
                }
            }
        }

        $dtore[$a] = $etore[$a] - $atore[$a];

        if (0 == $tabtype) {
            $punkte[$a] -= $strafp[$a];

            if (2 == $minus) {
                $negativ[$a] -= $strafm[$a];
            }
        }

        if (0 == $kegel) {
            $tab0[] = (50000000 + $punkte[$a]) . (50000000 - $negativ[$a]) . (50000000 + $dtore[$a]) . (50000000 + $etore[$a]) . (50000000 + $a);
        } else {
            $tab0[] = (50000000 + $punkte[$a]) . (50000000 - $negativ[$a]) . (50000000 + $etore[$a]) . (50000000 + $dtore[$a]) . (50000000 + $a);
        }
    }

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
                            $subteams .= (int)mb_substr($tab0[$abc - $b + 1], 34);
                        } else {
                            $subteams .= (int)mb_substr($tab0[$abc - $b], 34);
                        }
                    }

                    $anzcnt = 0;

                    require 'lmo-calctable1.php';

                    if ($anzcnt > 0) {
                        for ($b = 1, $bMax = count($tab1); $b <= $bMax; $b++) {
                            for ($f = 0, $fMax = count($tab0); $f < $fMax; $f++) {
                                if ((int)mb_substr($tab0[$f], 34) == (int)mb_substr($tab1[$b - 1], 34)) {
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
    }

    if ($action = 'admin') {
        $tab2 = $tab0;
    }

    if (1 == $hands) {
        if (('' == $tabdat) || ('admin' == $action)) {
            $handb = $stt - 1;
        } else {
            $handb = $endtab - 1;
        }

        if (0 != $handp[$handb]) {
            for ($ih = 0; $ih < $anzteams; $ih++) {
                $handd = (int)mb_substr($handp[$handb], $ih * 2, 2);

                if ($handd < 10) {
                    $handd = '0' . $handd;
                }

                $tab0[$ih] = $handd . mb_substr($tab0[$ih], 2);
            }

            sort($tab0, SORT_STRING);
        }
    }
}
