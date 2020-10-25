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
$addi = $PHP_SELF . '?action=admin&amp;todo=delete&amp;del=1&amp;dfile=';
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

    echo '<ul>';

    for ($k = 0, $kMax = count($dummy); $k < $kMax; $k++) {
        $files = $dummy[$k];

        $sekt = '';

        $t0 = '';

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

                    break;
                }
            }
        }

        fclose($datei);

        $i++;

        if ('' == $t0) {
            $j++;

            $t0 = 'Unbenante Liga ' . $j;
        }

        echo "<li><a href=\"javascript:dellmolink('" . $addi . $dirliga . $files . "','" . $t0 . "');\">" . $t0 . '</a></li>';
    }

    if (0 == $i) {
        echo '<li>[' . $text[223] . ']</li>';
    }

    echo '</ul>';
}
