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
// Jocker-Hack 001
// Copyright (C) 2002 by Ufuk Altinkaynak
// ufuk.a@arcor.de
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
if ('edit' != $todo) {
    $file = $dirliga . $liga . '.l98';
}
require_once 'lmo-tippcalcpkt.php';
$dummd = [''];
$dumme = [''];
$pswfile = $tippauthtxt;

$datei = fopen($pswfile, 'rb');
while (!feof($datei)) {
    $zeile2 = fgets($datei, 1000);

    $zeile2 = rtrim($zeile2);

    if ('' != $zeile2) {
        $dummd[] = $zeile2;
    }
}
fclose($datei);
array_shift($dummd);

$auswertfile = $dirtipp . 'auswert/' . $liga . '.aus';
$datenalt = [''];
$nick = '';

if ($st >= 0 && file_exists($auswertfile)) {
    $datei = fopen($auswertfile, 'rb');

    while (!feof($datei)) {
        $zeile = fgets($datei, 1000);

        $zeile = trim(rtrim($zeile));

        if ('' != $zeile) {
            if (('[' == mb_substr($zeile, 0, 1)) && (']' == mb_substr($zeile, -1))) {
                $nick = mb_substr($zeile, 1, -1);

                if (!file_exists($dirtipp . $liga . '_' . $nick . '.tip')) {
                    $nick = '';
                }
            }

            if ('' != $nick) {
                $datenalt[] = $zeile;
            }
        }
    }

    fclose($datei);
}

$auswertdatei = fopen($auswertfile, 'wb');
if (!$auswertdatei) {
    echo '<font color="#ff0000">' . $text[529] . ' ' . $auswertdatei . $text[283] . '</font>';

    exit;
}
flock($auswertdatei, 2);
if (file_exists($file)) {
    $addw = 'lmo-start.php?action=tipp&amp;todo=wert&amp;file=' . $file;

    echo '<font color="#008800">' . $text[529] . ' <a target="_blank" href="' . $addw . '">' . $liga . '</a> ' . $text[565] . '<br></font>';

    if ('edit' != $todo) {
        if (0 == $st) {
            require 'lmo-openfile.php';
        } else {
            require 'lmo-openfilest.php';
        }
    }

    $verz = opendir($dirtipp);

    $dummy = [''];

    while ($files = readdir($verz)) {
        if (mb_strtolower(mb_substr($files, 0, mb_strrpos($files, '_'))) == mb_strtolower($liga) && '.tip' == mb_strtolower(mb_substr($files, -4))) {
            $dummy[] = $files;
        }
    }

    closedir($verz);

    array_shift($dummy);

    $anztipperliga = count($dummy);

    if (!isset($start)) {
        $start = 1;
    }

    if (!isset($ende)) {
        $ende = $anztipperliga;
    }

    if (0 != $lmtype) {
        $wertverein = 0;
    }

    if (1 == $wertverein) {
        $vpunkte = array_pad($array, $anzteams + 1, '');

        $vspiele = array_pad($array, $anzteams + 1, '');

        for ($i = 1; $i <= $anzteams; $i++) {
            $vpunkte[$i] = array_pad(['0'], $anzst + 1, '0');

            $vspiele[$i] = array_pad(['0'], $anzst + 1, '0');
        }
    }

    for ($l = 0; $l < $anztipperliga; $l++) {  // durchlaufe alle Tipper
        $tippernick1 = mb_substr($dummy[$l], mb_strrpos($dummy[$l], '_') + 1, -4);

        if ($l >= $start - 1 && $l <= $ende - 1) {
            $tippfile = $dirtipp . $dummy[$l];

            if (file_exists($tippfile)) {
                $gef = 0;

                for ($g = 0; $g < count($dummd) && 0 == $gef; $g++) { //Tipper tippt diese Liga
                    $dumme = preg_split('[|]', $dummd[$g]);

                    if ($tippernick1 == $dumme[0]) {
                        fwrite($auswertdatei, "\n[" . $dumme[0] . "]\n");

                        fwrite($auswertdatei, 'Team=' . $dumme[5] . "\n");

                        if (1 == $showname) {
                            fwrite($auswertdatei, 'Name=' . $dumme[3] . "\n");
                        }

                        if (1 == $showemail) {
                            fwrite($auswertdatei, 'Email=' . $dumme[4] . "\n");
                        }

                        $gef = 1;
                    }
                }

                if (1 == $gef) {
                    if (0 == $st) {
                        require 'lmo-tippopenfileall.php';
                    } else {
                        require 'lmo-tippopenfile.php';
                    }

                    $st1 = $st;

                    for ($st0 = 0; $st0 < $anzst; $st0++) {
                        if ($st > 0) {
                            $st0 = $anzst;
                        } else {
                            $st1 = $st0 + 1;
                        }

                        $spielegetippt = 0;

                        $tp = 0;

                        if (1 == $showzus) {
                            if (1 == $tippmodus) {
                                $punkte1 = 0;

                                $punkte2 = 0;

                                $punkte3 = 0;

                                $punkte4 = 0;
                            }

                            $punkte5 = 0;

                            $punkte6 = 0;
                        }

                        for ($i = 0; $i < $anzsp; $i++) {
                            if (0 == $lmtype) {
                                if (1 == $jokertipp && ((0 == $st && $jksp[$st0] == $i + 1) || $jksp == $i + 1)) {
                                    $jkspfaktor = $jokertippmulti;
                                } else {
                                    $jkspfaktor = 1;
                                }

                                $punktespiel = -1;

                                if (0 == $st) {
                                    if ('_' != $goaltippa[$st0][$i] && '_' != $goala[$st0][$i]) {
                                        $punktespiel = tipppunkte($goaltippa[$st0][$i], $goaltippb[$st0][$i], $goala[$st0][$i], $goalb[$st0][$i], $msieg[$st0][$i], $mspez[$st0][$i], $text[0], $text[1], $jkspfaktor, $mtipp[$st0][$i]);
                                    }
                                } elseif ('_' != $goaltippa[$i] && '_' != $goala[$st - 1][$i] && $goala[$st - 1][$i] > -1) {
                                    $punktespiel = tipppunkte($goaltippa[$i], $goaltippb[$i], $goala[$st - 1][$i], $goalb[$st - 1][$i], $msieg[$st - 1][$i], $mspez[$st - 1][$i], $text[0], $text[1], $jkspfaktor, $mtipp[$st - 1][$i]);
                                }

                                if ($punktespiel > -1) {
                                    $spielegetippt++;
                                }

                                if ($punktespiel > 0) {
                                    $tp += $punktespiel;
                                }

                                if (1 == $wertverein) {
                                    if ($punktespiel > 0) {
                                        $vpunkte[$teama[$st1 - 1][$i]][$st1] += $punktespiel;

                                        $vpunkte[$teamb[$st1 - 1][$i]][$st1] += $punktespiel;
                                    }

                                    if ($punktespiel > -1) {
                                        $vspiele[$teama[$st1 - 1][$i]][$st1]++;

                                        $vspiele[$teamb[$st1 - 1][$i]][$st1]++;
                                    }
                                }
                            } else {
                                for ($n = 0; $n < $modus[$st - 1]; $n++) {
                                    if (1 == $jokertipp && ((0 == $st && $jksp[$st0] == ($i + 1) . ($n + 1)) || $jksp == ($i + 1) . ($n + 1))) {
                                        $jkspfaktor = $jokertippmulti;
                                    } else {
                                        $jkspfaktor = 1;
                                    }

                                    $punktespiel = -1;

                                    if (0 == $st) {
                                        if ('_' != $goaltippa[$st0][$i][$n] && '_' != $goala[$st0][$i][$n]) {
                                            $punktespiel = tipppunkte($goaltippa[$st0][$i][$n], $goaltippb[$st0][$i][$n], $goala[$st0][$i][$n], $goalb[$st0][$i][$n], 0, $mspez[$st0][$i][$n], $text[0], $text[1], $jkspfaktor, $mtipp[$st0][$i][$n]);
                                        }
                                    } elseif ('_' != $goaltippa[$i][$n] && '_' != $goala[$st - 1][$i][$n] && $goala[$st - 1][$i][$n] > -1) {
                                        $punktespiel = tipppunkte($goaltippa[$i][$n], $goaltippb[$i][$n], $goala[$st - 1][$i][$n], $goalb[$st - 1][$i][$n], 0, $mspez[$st - 1][$i][$n], $text[0], $text[1], $jkspfaktor, $mtipp[$st - 1][$i][$n]);
                                    }

                                    if ($punktespiel > -1) {
                                        $spielegetippt++;
                                    }

                                    if ($punktespiel > 0) {
                                        $tp += $punktespiel;
                                    }
                                }
                            } // ende else
                        } // ende for($i=1;$j<=$anzsp;$i++)
                        if ($spielegetippt > 0) {
                            fwrite($auswertdatei, 'SG' . $st1 . '=' . $spielegetippt . "\n");
                        }

                        if (1 == $showzus) {
                            if (1 == $tippmodus) {
                                if ($punkte1 > 0) {
                                    fwrite($auswertdatei, 'P1' . $st1 . '=' . $punkte1 . "\n");
                                }

                                if ($punkte2 > 0) {
                                    fwrite($auswertdatei, 'P2' . $st1 . '=' . $punkte2 . "\n");
                                }

                                if ($punkte3 > 0) {
                                    fwrite($auswertdatei, 'P3' . $st1 . '=' . $punkte3 . "\n");
                                }

                                if ($punkte4 > 0) {
                                    fwrite($auswertdatei, 'P4' . $st1 . '=' . $punkte4 . "\n");
                                }
                            }

                            if ($punkte5 > 0) {
                                fwrite($auswertdatei, 'P5' . $st1 . '=' . $punkte5 . "\n");
                            }

                            if ($punkte6 > 0) {
                                fwrite($auswertdatei, 'P6' . $st1 . '=' . $punkte6 . "\n");
                            }
                        }

                        if ($tp > 0) {
                            fwrite($auswertdatei, 'TP' . $st1 . '=' . $tp . "\n");
                        }
                    } // ende for($st0=1;$st0<$anzst;$st0++)

                    //if(!isset($dat)){$dat=0;}

                    //if($dat>=count($datenalt)){$dat=0;}

                    if ($st > 0) {
                        $dat = 0;

                        while ($tippernick1 != mb_substr($datenalt[$dat], 1, -1) && $dat < (count($datenalt) - 1)) {
                            $dat++;
                        }

                        $nick = mb_substr($datenalt[$dat], 1, -1);

                        if ($nick == $tippernick1) {
                            $dat++;

                            while ($dat < count($datenalt) && $nick == $tippernick1) {//////////// nur die unveränderten Spieltage werden zurückgeschrieben
                                if (('[' == mb_substr($datenalt[$dat], 0, 1)) && (']' == mb_substr($datenalt[$dat], -1))) {
                                    $nick = mb_substr($datenalt[$dat], 1, -1);
                                } else {
                                    if (mb_substr($datenalt[$dat], 2, mb_strpos($datenalt[$dat], '=') - 2) != $st && 'Team' != mb_substr($datenalt[$dat], 0, 4) && 'Name' != mb_substr($datenalt[$dat], 0, 4) && 'Email' != mb_substr($datenalt[$dat], 0, 5)) {
                                        fwrite($auswertdatei, $datenalt[$dat] . "\n");
                                    }

                                    $dat++;
                                }
                            }
                        }
                    } // ende if($st>0)

                    if (1 == $wertverein) {
                        $wertvereinfile = $dirtipp . 'auswert/vereine/' . $liga . '_' . $tippernick1 . '.ver';

                        $datenalt1 = [''];

                        $verein = '';

                        if ($st > 0 && file_exists($wertvereinfile)) {
                            $datei = fopen($wertvereinfile, 'rb');

                            while (!feof($datei)) {
                                $zeile = fgets($datei, 1000);

                                $zeile = trim(rtrim($zeile));

                                if ('' != $zeile) {
                                    if (('[' == mb_substr($zeile, 0, 1)) && (']' == mb_substr($zeile, -1))) {
                                        $verein = mb_substr($zeile, 1, -1);
                                    }

                                    if ('' != $verein) {
                                        $datenalt1[] = $zeile;
                                    }
                                }
                            }

                            fclose($datei);
                        }

                        $wertvereindatei = fopen($wertvereinfile, 'wb');

                        flock($wertvereindatei, 2);

                        for ($i = 1; $i <= $anzteams; $i++) {
                            fwrite($wertvereindatei, '[' . $i . ']' . "\n");

                            $anzst1 = $anzst;

                            for ($j = 1; $j <= $anzst1; $j++) {
                                if ($st > 0) {
                                    $j = $st;

                                    $anzst1 = $st;

                                    $dat = 0;

                                    //if(!isset($dat)){$dat=0;}

                                    //if($dat>=count($datenalt1)){$dat=0;}

                                    while ($datenalt1[$dat] != '[' . $i . ']' && $dat < (count($datenalt1) - 1)) {
                                        $dat++;
                                    }

                                    $verein = mb_substr($datenalt1[$dat], 1, -1);

                                    if ($verein == $i) {
                                        $dat++;

                                        while ($dat < count($datenalt1) && $verein == $i) {
                                            if (('[' == mb_substr($datenalt1[$dat], 0, 1)) && (']' == mb_substr($datenalt1[$dat], -1))) {
                                                $verein = mb_substr($datenalt1[$dat], 1, -1);
                                            } else {
                                                if (mb_substr($datenalt1[$dat], 2, mb_strpos($datenalt1[$dat], '=') - 2) != $st) {
                                                    fwrite($wertvereindatei, $datenalt1[$dat] . "\n");
                                                }

                                                $dat++;
                                            }
                                        }
                                    }
                                }

                                if ($vpunkte[$i][$j] > 0) {
                                    fwrite($wertvereindatei, 'TP' . $j . '=' . $vpunkte[$i][$j] . "\n");

                                    $vpunkte[$i][$j] = 0;
                                }

                                if ($vspiele[$i][$j] > 0) {
                                    fwrite($wertvereindatei, 'SG' . $j . '=' . $vspiele[$i][$j] . "\n");

                                    $vspiele[$i][$j] = 0;
                                }
                            }
                        }

                        flock($wertvereindatei, 3);

                        fclose($wertvereindatei);
                    }
                } // ende if($gef==1)
            } // ende if(file_exists($tippfile))
        } // ende if($l>=$start-1 && $l<=$ende-1)
        else { // nicht ausgewertete Tipper zurück schreiben
            $nick = '';

            for ($i = 0, $iMax = count($datenalt); $i < $iMax; $i++) {
                $zeile = $datenalt[$i];

                if ('' != $zeile) {
                    if (('[' == mb_substr($zeile, 0, 1)) && (']' == mb_substr($zeile, -1))) {
                        $nick = mb_substr($zeile, 1, -1);
                    }

                    if ($nick == $tippernick1) {
                        fwrite($auswertdatei, $datenalt[$i] . "\n");
                    }
                }
            } // ende for($i=0;$i<count($datenalt);$i++)
        } // ende else
    } // ende for($l=0;$l<$anztipperliga;$l++)
    flock($auswertdatei, 3);

    fclose($auswertdatei);
} // ende if(file_exists($file))

clearstatcache();
if ('edit' != $todo) {
    $file = '';
}
