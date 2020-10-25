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
$addi = $PHP_SELF . '?file=';
if ('' != $ftype) {
    $verz = opendir(mb_substr($dirliga, 0, -1));

    $dummy = [''];

    while ($files = readdir($verz)) {
        if (mb_strtolower(mb_substr($files, -4)) == $ftype) {
            $dummy[] = $files;
        }
    }

    closedir($verz);

    array_shift($dummy);

    sort($dummy);

    $i = 0;

    $j = 0;

    //  echo"<ul>";

    echo '<br>';

    for ($k = 0, $kMax = count($dummy); $k < $kMax; $k++) {
        $files = $dummy[$k];

        $sekt = '';

        $t0 = '';

        $t1 = '';

        $t4 = '';

        $t2 = $text[2];

        $datei = fopen($dirliga . $files, 'rb');

        while (!feof($datei)) {
            $zeile = fgets($datei, 1000);

            $zeile = rtrim($zeile);

            $zeile = trim($zeile);

            if (('[' == mb_substr($zeile, 0, 1)) && (']' == mb_substr($zeile, -1))) {
                $sekt = mb_substr($zeile, 1, -1);
            } elseif ((false !== mb_strpos($zeile, '=')) && (';' != mb_substr($zeile, 0, 1)) && ('Options' == $sekt)) {
                $schl = mb_substr($zeile, 0, mb_strpos($zeile, '='));

                $wert = mb_substr($zeile, mb_strpos($zeile, '=') + 1);

                if ('Name' == $schl) {
                    $t0 = $wert;
                }

                if ('Actual' == $schl) {
                    $t1 = $wert;
                }

                if ('Teams' == $schl) {
                    $t4 = $wert;
                }

                if ('Type' == $schl) {
                    if ('1' == $wert) {
                        $t2 = $text[370];
                    }
                }

                if (('' != $t0) && ('' != $t1) && ('' != $t4)) {
                    break;
                }
            }
        }

        fclose($datei);

        $i++;

        if ('' == $t0) {
            $j++;

            $t0 = 'Unbenannte Liga ' . $j;
        }

        if ('' != $t1) {
            if ($t2 == $text[2]) {
                $t3 = ' / ' . $t1 . '. ' . $t2;
            } else {
                $t5 = mb_strlen(decbin($t4 - 1));

                if ($t1 == $t5 - 1) {
                    $t3 = ' / ' . $text[373];
                } elseif ($t1 == $t5 - 2) {
                    $t3 = ' / ' . $text[372];
                } elseif ($t1 == $t5 - 3) {
                    $t3 = ' / ' . $text[371];
                } elseif ($t1 == $t5 - 4) {
                    $t3 = ' / ' . $text[370];
                } else {
                    $t3 = ' / ' . $t1 . '. ' . $t2;
                }
            }
        } else {
            $t3 = '';
        }

        //    echo "<li><a href=\"".$addi.$dirliga.$files."\">".$t0."<br><small>".date("d.m.Y H:i",filectime($dirliga.$files)).$t3."</small></a></li>";

        echo '<a href="' . $addi . $dirliga . $files . '">' . $t0 . '</a><br><small>' . date('d.m.Y H:i', filectime($dirliga . $files)) . $t3 . '</small><br><br>';
    }

    if (0 == $i) {
        echo '<li>[' . $text[223] . ']</li>';
    }

    //  echo"</ul>";

    echo '<br>';
}
