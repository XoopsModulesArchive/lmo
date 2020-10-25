<?php

//
// LigaManager Online 3.02b
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
require_once 'lmo-admintest.php';
if ((2 == $HTTP_SESSION_VARS['lmouserok']) || (1 == $HTTP_SESSION_VARS['lmouserok'])) {
    if ('' != $file) {
        if ('.l98' == mb_substr($file, -4)) {
            if (1 == $einsavehtml) {
                if (file_exists('lmo-savehtml.php')) {
                    include 'lmo-savehtml.php';
                }

                if (file_exists('lmo-savehtml1.php')) {
                    include 'lmo-savehtml1.php';
                }
            }

            if (1 == $einzutore || 1 == $einzutoretab || 1 == $einzustats) {
                if (file_exists('lmo-zustat.php')) {
                    include 'lmo-zustat.php';
                }
            }

            $datei = fopen($file, 'wb');

            if (!$datei) {
                echo '<font color="#ff0000">' . $text[283] . '</font>';

                exit;
            }

            echo '<font color="#008800">' . $text[138] . '</font>';

            flock($datei, 2);

            fwrite($datei, "[Options]\n");

            fwrite($datei, 'Title=' . $text[54] . "\n");

            fwrite($datei, 'Name=' . $titel . "\n");

            fwrite($datei, 'mittore=' . $mittore . "\n");

            fwrite($datei, 'Type=' . $lmtype . "\n");

            fwrite($datei, 'Teams=' . $anzteams . "\n");

            if (0 == $lmtype) {
                fwrite($datei, 'Rounds=' . $anzst . "\n");

                fwrite($datei, 'Matches=' . $anzsp . "\n");
            }

            if ($st > 0) {
                fwrite($datei, 'Actual=' . $st . "\n");
            } else {
                fwrite($datei, 'Actual=' . $stx . "\n");
            }

            if (0 == $lmtype) {
                fwrite($datei, 'Kegel=' . $kegel . "\n");

                fwrite($datei, 'HandS=' . $hands . "\n");

                fwrite($datei, 'PointsForWin=' . $pns . "\n");

                fwrite($datei, 'PointsForDraw=' . $pnu . "\n");

                fwrite($datei, 'PointsForLost=' . $pnn . "\n");

                fwrite($datei, 'Spez=' . $spez . "\n");

                fwrite($datei, 'HideDraw=' . $hidr . "\n");

                fwrite($datei, 'OnRun=' . $onrun . "\n");

                if (1 == $spez) {
                    fwrite($datei, 'XtraS=' . $pxs . "\n");

                    fwrite($datei, 'XtraU=' . $pxu . "\n");

                    fwrite($datei, 'XtraV=' . $pxn . "\n");

                    fwrite($datei, 'SpezS=' . $pps . "\n");

                    fwrite($datei, 'SpezU=' . $ppu . "\n");

                    fwrite($datei, 'SpezV=' . $ppn . "\n");
                }

                fwrite($datei, 'MinusPoints=' . $minus . "\n");

                fwrite($datei, 'Direct=' . $direkt . "\n");

                fwrite($datei, 'Champ=' . $champ . "\n");

                fwrite($datei, 'CL=' . $anzcl . "\n");

                fwrite($datei, 'CK=' . $anzck . "\n");

                fwrite($datei, 'UC=' . $anzuc . "\n");

                fwrite($datei, 'AR=' . $anzar . "\n");

                fwrite($datei, 'AB=' . $anzab . "\n");

                if (isset($namepkt)) {
                    fwrite($datei, 'namePkt=' . $namepkt . "\n");
                }

                if (isset($nametor)) {
                    fwrite($datei, 'nameTor=' . $nametor . "\n");
                }
            } else {
                fwrite($datei, 'KlFin=' . $klfin . "\n");
            }

            fwrite($datei, 'DatC=' . $datc . "\n");

            fwrite($datei, 'DatS=' . $dats . "\n");

            fwrite($datei, 'DatM=' . $datm . "\n");

            fwrite($datei, 'DatF=' . $datf . "\n");

            fwrite($datei, 'urlT=' . $urlt . "\n");

            fwrite($datei, 'urlB=' . $urlb . "\n");

            if (0 == $lmtype) {
                fwrite($datei, 'Graph=' . $kurve . "\n");

                fwrite($datei, 'Kreuz=' . $kreuz . "\n");
            }

            fwrite($datei, 'favTeam=' . $favteam . "\n");

            fwrite($datei, 'selTeam=' . $selteam . "\n");

            if (0 == $lmtype) {
                fwrite($datei, 'kurve1=' . $stat1 . "\n");

                fwrite($datei, 'kurve2=' . $stat2 . "\n");
            }

            fwrite($datei, 'ticker=' . $nticker . "\n");

            if (1 == $nticker) {
                fwrite($datei, "\n[News]\n");

                fwrite($datei, 'NC=' . count($nlines) . "\n");

                for ($i = 0, $iMax = count($nlines); $i < $iMax; $i++) {
                    fwrite($datei, 'N' . $i . '=' . $nlines[$i] . "\n");
                }
            }

            fwrite($datei, "\n[Teams]\n");

            for ($i = 1; $i <= $anzteams; $i++) {
                fwrite($datei, $i . '=' . $teams[$i] . "\n");
            }

            fwrite($datei, "\n[Teamk]\n");

            for ($i = 1; $i <= $anzteams; $i++) {
                fwrite($datei, $i . '=' . $teamk[$i] . "\n");
            }

            for ($i = 1; $i <= $anzteams; $i++) {
                fwrite($datei, "\n[Team" . $i . "]\n");

                if (0 == $lmtype) {
                    fwrite($datei, 'SP=' . $strafp[$i] . "\n");

                    if (2 == $minus) {
                        fwrite($datei, 'SM=' . $strafm[$i] . "\n");
                    }
                }

                fwrite($datei, 'URL=' . $teamu[$i] . "\n");

                fwrite($datei, 'NOT=' . $teamn[$i] . "\n");
            }

            if (0 != $lmtype) {
                $anzsp = $anzteams;
            }

            for ($i = 1; $i <= $anzst; $i++) {
                fwrite($datei, "\n[Round" . $i . "]\n");

                if (1 == $hands) {
                    fwrite($datei, 'HS=' . $handp[$i - 1] . "\n");
                }

                fwrite($datei, 'D1=' . $datum1[$i - 1] . "\n");

                fwrite($datei, 'D2=' . $datum2[$i - 1] . "\n");

                if (0 != $lmtype) {
                    fwrite($datei, 'MO=' . $modus[$i - 1] . "\n");

                    $anzsp /= 2;

                    if ((1 == $klfin) && ($i == $anzst)) {
                        $anzsp += 1;
                    }
                }

                for ($j = 1; $j <= $anzsp; $j++) {
                    if (!isset($msieg[$i - 1][$j - 1])) {
                        $msieg[$i - 1][$j - 1] = 0;
                    }

                    fwrite($datei, 'TA' . $j . '=' . $teama[$i - 1][$j - 1] . "\n");

                    fwrite($datei, 'TB' . $j . '=' . $teamb[$i - 1][$j - 1] . "\n");

                    if (0 == $lmtype) {
                        if ('_' == $goala[$i - 1][$j - 1]) {
                            fwrite($datei, 'GA' . $j . "=-1\n");
                        } elseif (1 == $msieg[$i - 1][$j - 1]) {
                            fwrite($datei, 'GA' . $j . "=-2\n");
                        } else {
                            fwrite($datei, 'GA' . $j . '=' . $goala[$i - 1][$j - 1] . "\n");
                        }

                        if ('_' == $goalb[$i - 1][$j - 1]) {
                            fwrite($datei, 'GB' . $j . "=-1\n");
                        } elseif (2 == $msieg[$i - 1][$j - 1]) {
                            fwrite($datei, 'GB' . $j . "=-2\n");
                        } else {
                            fwrite($datei, 'GB' . $j . '=' . $goalb[$i - 1][$j - 1] . "\n");
                        }

                        if (3 == $msieg[$i - 1][$j - 1]) {
                            fwrite($datei, 'ET' . $j . "=3\n");
                        }

                        if (1 == $spez) {
                            if ('_' == $mspez[$i - 1][$j - 1]) {
                                fwrite($datei, 'SP' . $j . "=0\n");
                            } elseif ($mspez[$i - 1][$j - 1] == $text[0]) {
                                fwrite($datei, 'SP' . $j . "=2\n");
                            } elseif ($mspez[$i - 1][$j - 1] == $text[1]) {
                                fwrite($datei, 'SP' . $j . "=1\n");
                            }
                        }

                        fwrite($datei, 'NT' . $j . '=' . $mnote[$i - 1][$j - 1] . "\n");

                        fwrite($datei, 'BE' . $j . '=' . $mberi[$i - 1][$j - 1] . "\n");

                        fwrite($datei, 'TI' . $j . '=' . $mtipp[$i - 1][$j - 1] . "\n");

                        fwrite($datei, 'AT' . $j . '=' . $mterm[$i - 1][$j - 1] . "\n");
                    } else {
                        for ($n = 1; $n <= $modus[$i - 1]; $n++) {
                            if ('_' == $goala[$i - 1][$j - 1][$n - 1]) {
                                fwrite($datei, 'GA' . $j . $n . "=-1\n");
                            } else {
                                fwrite($datei, 'GA' . $j . $n . '=' . $goala[$i - 1][$j - 1][$n - 1] . "\n");
                            }

                            if ('_' == $goalb[$i - 1][$j - 1][$n - 1]) {
                                fwrite($datei, 'GB' . $j . $n . "=-1\n");
                            } else {
                                fwrite($datei, 'GB' . $j . $n . '=' . $goalb[$i - 1][$j - 1][$n - 1] . "\n");
                            }

                            if ('_' == $mspez[$i - 1][$j - 1][$n - 1]) {
                                fwrite($datei, 'SP' . $j . $n . "=0\n");
                            } elseif ($mspez[$i - 1][$j - 1][$n - 1] == $text[0]) {
                                fwrite($datei, 'SP' . $j . $n . "=2\n");
                            } elseif ($mspez[$i - 1][$j - 1][$n - 1] == $text[1]) {
                                fwrite($datei, 'SP' . $j . $n . "=1\n");
                            }

                            fwrite($datei, 'NT' . $j . $n . '=' . $mnote[$i - 1][$j - 1][$n - 1] . "\n");

                            fwrite($datei, 'BE' . $j . $n . '=' . $mberi[$i - 1][$j - 1][$n - 1] . "\n");

                            fwrite($datei, 'TI' . $j . $n . '=' . $mtipp[$i - 1][$j - 1][$n - 1] . "\n");

                            fwrite($datei, 'AT' . $j . $n . '=' . $mterm[$i - 1][$j - 1][$n - 1] . "\n");
                        }
                    }
                }
            }

            flock($datei, 3);

            fclose($datei);
        }

        clearstatcache();
    }
}
