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
require_once 'lmo-admintest.php';
$dummb = [''];
$dummd = [''];
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
$anztipper = count($dummd);

$auswertfile = $dirtipp . 'auswert/gesamt.aus';
$auswertdatei = fopen($auswertfile, 'wb');
if (!$auswertdatei) {
    echo '<font color="#ff0000">' . $text[529] . ' ' . $auswertdatei . $text[283] . '</font>';

    exit;
}
flock($auswertdatei, 2);
$addw = 'lmo-start.php?action=tipp&amp;todo=wert&amp;all=1';
echo '<font color="#008800">' . $text[529] . ' <a target="_blank" href="' . $addw . '">Gesamt</a> ' . $text[565] . '<br></font>';
$tippernick = array_pad($array, $anztipper + 1, '');
if (1 == $showname) {
    $tippername = array_pad($array, $anztipper + 1, '');
}
if (1 == $showemail) {
    $tipperemail = array_pad($array, $anztipper + 1, '');
}
$tipperteam = array_pad($array, $anztipper + 1, '');

for ($i = 0; $i < $anztipper; $i++) {
    $dummb = preg_split('[|]', $dummd[$i]);

    $tippernick[$i] = $dummb[0];

    if (1 == $showname) {
        $tippername[$i] = $dummb[3];
    }

    if (1 == $showemail) {
        $tipperemail[$i] = $dummb[4];
    }

    $tipperteam[$i] = $dummb[5];
}
$verz = opendir($dirtipp . 'auswert');
$dummy = [''];
while ($files = readdir($verz)) {
    if ('.aus' == mb_strtolower(mb_substr($files, -4)) && 'gesamt.aus' != mb_strtolower(mb_substr($files, -10))) {
        $dummy[] = $files;
    }
}
closedir($verz);
array_shift($dummy);

$anzligen = count($dummy);
$anzligenaus = 0;
$liganame = array_pad($array, $anzligen + 1, '');
if (1 == $showzus) {
    $punkte = array_pad($array, $anztipper + 1, '');
}
$tipppunkte = array_pad($array, $anztipper + 1, '');
$spielegetipptges = array_pad($array, $anztipper + 1, '');
for ($i = 0; $i < $anztipper; $i++) {
    if (1 == $showzus) {
        $punkte[$i] = array_pad($array, $anzligen + 1, '');

        for ($p = 0; $p < $anzligen; $p++) {
            $punkte[$i][$p] = array_pad([''], 7, '');
        }
    }

    $tipppunkte[$i] = array_pad(['0'], $anzligen + 1, '0');

    $spielegetipptges[$i] = array_pad(['0'], $anzligen + 1, '0');
}

for ($k = 0; $k < $anzligen; $k++) {
    $ftest = 0;

    $ftest1 = '';

    $ftest1 = preg_split('[,]', $ligenzutippen);

    if (isset($ftest1)) {
        for ($u = 0, $uMax = count($ftest1); $u < $uMax; $u++) {
            if ($ftest1[$u] == mb_substr($dummy[$k], 0, -4)) {
                $ftest = 1;
            }
        }
    }

    $auswertfile1 = $dirtipp . 'auswert/' . $dummy[$k];

    if (0 == $ftest && 0 == $immeralle) { // Liga darf nicht in Gesamtwertung einfliessen
    } elseif (!file_exists($auswertfile1)) {
        echo $text[517] . '<br>';
    } else {
        $liganame[$anzligenaus] = $dummy[$k];

        $datei = fopen($auswertfile1, 'rb');

        if (false !== $datei) {
            $tippdaten = [''];

            $sekt = '';

            while (!feof($datei)) {
                $zeile = fgets($datei, 1000);

                $zeile = rtrim($zeile);

                $zeile = trim($zeile);

                if (('[' == mb_substr($zeile, 0, 1)) && (']' == mb_substr($zeile, -1))) {
                    $sekt = trim(mb_substr($zeile, 1, -1));
                } elseif ((false !== mb_strpos($zeile, '=')) && (';' != mb_substr($zeile, 0, 1))) {
                    $schl = trim(mb_substr($zeile, 0, mb_strpos($zeile, '=')));

                    $wert = trim(mb_substr($zeile, mb_strpos($zeile, '=') + 1));

                    $tippdaten[] = $sekt . '|' . $schl . '|' . $wert . '|EOL';
                }
            }

            fclose($datei);
        }

        array_shift($tippdaten);

        for ($i = 1, $iMax = count($tippdaten); $i <= $iMax; $i++) {
            $dum = preg_split('[|]', $tippdaten[$i - 1]);

            $op1 = $dum[0];  // Nick
            $op3 = mb_substr($dum[1], 2) - 1;   // Spieltagsnummer
            $op4 = mb_substr($dum[1], 0, 2);   // PP
            if ('TP' == $op4) {
                $gef = 0;

                for ($j = 0; $j < $anztipper && 0 == $gef; $j++) {
                    if ($tippernick[$j] == $op1) {
                        $tipppunkte[$j][$anzligenaus] += $dum[2];

                        $gef = 1;
                    }
                }
            } elseif ('SG' == $op4) {
                $gef = 0;

                for ($j = 0; $j < $anztipper && 0 == $gef; $j++) {
                    if ($tippernick[$j] == $op1) {
                        $spielegetipptges[$j][$anzligenaus] += $dum[2];

                        $gef = 1;
                    }
                }
            } elseif ('P' == mb_substr($op4, 0, 1) && 1 == $showzus) {
                $artpkt = mb_substr($op4, 1, 1);

                $gef = 0;

                for ($j = 0; $j < $anztipper && 0 == $gef; $j++) {
                    if ($tippernick[$j] == $op1) {
                        $punkte[$j][$anzligenaus][$artpkt] += $dum[2];

                        $gef = 1;
                    }
                }
            }
        }

        $anzligenaus++;
    }
} // ende for($k=0;$k<$anzligen;$k++)

fwrite($auswertdatei, "[Options]\n");
fwrite($auswertdatei, 'AnzLigen=' . $anzligenaus . "\n");
for ($k = 1; $k <= $anzligenaus; $k++) {
    fwrite($auswertdatei, 'TT' . $k . '=' . $liganame[$k - 1] . "\n");
}
for ($j = 0; $j < $anztipper; $j++) {
    fwrite($auswertdatei, "\n[" . $tippernick[$j] . "]\n");

    fwrite($auswertdatei, 'Team=' . $tipperteam[$j] . "\n");

    if (1 == $showname) {
        fwrite($auswertdatei, 'Name=' . $tippername[$j] . "\n");
    }

    if (1 == $showemail) {
        fwrite($auswertdatei, 'Email=' . $tipperemail[$j] . "\n");
    }

    for ($k = 1; $k <= $anzligenaus; $k++) {
        if ('' == $tipppunkte[$j][$k - 1]) {
            $tipppunkte[$j][$k - 1] = 0;
        }

        fwrite($auswertdatei, 'TP' . $k . '=' . $tipppunkte[$j][$k - 1] . "\n");

        fwrite($auswertdatei, 'SG' . $k . '=' . $spielegetipptges[$j][$k - 1] . "\n");

        if (1 == $showzus) {
            for ($p = 1; $p < 7; $p++) {
                if ($punkte[$j][$k - 1][$p] > 0) {
                    fwrite($auswertdatei, 'P' . $p . $k . '=' . $punkte[$j][$k - 1][$p] . "\n");
                }
            }
        }
    }
}
flock($auswertdatei, 3);
fclose($auswertdatei);

clearstatcache();
if ('edit' != $todo) {
    $file = '';
}
