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
require_once 'lmo-admintest.php';
$addi = $PHP_SELF . '?action=admin&amp;todo=edit&amp;file=';
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

    for ($k = 0, $kMax = count($dummy); $k < $kMax; $k++) {
        $files = $dummy[$k];

        $sekt = '';

        $t0 = '';

        $t1 = '';

        $t2 = '';

        $t3 = '';

        $t4 = '0';

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

                if ('Teams' == $schl) {
                    $t1 = $wert;
                }

                if ('Rounds' == $schl) {
                    $t2 = $wert;
                }

                if ('Matches' == $schl) {
                    $t3 = $wert;
                }

                if ('Type' == $schl) {
                    $t4 = $wert;
                }
            }
        }

        fclose($datei);

        if (($t1 == $xteams) && ($t2 == $xanzst) && ($t3 == $xanzsp) && ($t4 == $xtype)) {
            $i++;

            if ('' == $t0) {
                $j++;

                $t0 = 'Unbenante Liga ' . $j;
            }

            echo '<input type="radio" name="xprogram" value="' . $dirliga . $files . '"';

            if ($xprogram == $dirliga . $files) {
                echo ' checked';
            }

            echo ' onChange="dolmoedit()">' . $t0 . '<br>';
        }
    }

    if (0 == $i) {
        echo '[' . $text[224] . ']<br>';
    }
}
