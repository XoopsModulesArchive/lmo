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
if ('' != $_POST['liga'] && '' != $_POST['st']) {
    $verz = opendir($dirtipp);

    $dummy = [''];

    while ($files = readdir($verz)) {
        if ('.tip' == mb_strtolower(mb_substr($files, -4)) && mb_strtolower(mb_substr($files, 0, mb_strlen($liga))) == mb_strtolower($liga)) {
            $dummy[] = $files;
        }
    }

    array_shift($dummy);

    $anztipper = count($dummy);

    $einsichtfile = $dirtipp . 'einsicht/' . $liga . '_' . $st . '.ein';

    $datenalt = [''];

    $nick = '';

    if ($st > 0 && file_exists($einsichtfile)) {
        $datei = fopen($einsichtfile, 'rb');

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

    $file = $dirliga . $liga . '.l98';

    if (file_exists($file)) {
        $einsichtdatei = fopen($einsichtfile, 'wb');

        if (!$einsichtdatei) {
            echo '<font color="#ff0000">' . $text[657] . ' ' . $einsichtfile . $text[283] . '</font>';

            exit;
        }

        flock($einsichtdatei, 2);

        $addw = 'lmo-start.php?action=tipp&amp;todo=einsicht&amp;file=' . $file . '&amp;st=' . $st;

        echo '<font color="#008800">' . $text[657] . ' <a target="_blank" href="' . $addw . '">' . $liga . '</a> ' . $text[565] . '<br></font>';

        for ($k = 0; $k < $anztipper; $k++) {// durchlaufe alle Tipper
            $tippernick = mb_substr($dummy[$k], mb_strrpos($dummy[$k], '_') + 1, -4);

            if ($k >= $start - 1 && $k <= $ende - 1) {
                $tippfile = $dirtipp . $dummy[$k];

                fwrite($einsichtdatei, "\n[" . $tippernick . "]\n");

                if (!file_exists($tippfile)) {
                    echo $text[517] . '<br>';
                } else {
                    $datei = fopen($tippfile, 'rb');

                    if (false !== $datei) {
                        $tippdaten = [''];

                        $sekt = '';

                        $jkwert = '';

                        while (!feof($datei)) {
                            $zeile = fgets($datei, 1000);

                            $zeile = rtrim($zeile);

                            $zeile = trim($zeile);

                            if (('@' == mb_substr($zeile, 0, 1)) && ('@' == mb_substr($zeile, -1))) {
                                $jkwert = trim(mb_substr($zeile, 1, -1));
                            } elseif (('[' == mb_substr($zeile, 0, 1)) && (']' == mb_substr($zeile, -1))) {
                                $sekt = trim(mb_substr($zeile, 1, -1));
                            } elseif ((false !== mb_strpos($zeile, '=')) && (';' != mb_substr($zeile, 0, 1))) {
                                $schl = trim(mb_substr($zeile, 0, mb_strpos($zeile, '=')));

                                $wert = trim(mb_substr($zeile, mb_strpos($zeile, '=') + 1));

                                $tippdaten[] = $sekt . '|' . $schl . '|' . $wert . '|' . $jkwert . '|EOL';
                            }
                        }

                        fclose($datei);
                    }

                    array_shift($tippdaten);

                    $jkspgrpw = '';

                    for ($i = 1, $iMax = count($tippdaten); $i <= $iMax; $i++) {
                        $dum = preg_split('[|]', $tippdaten[$i - 1]);

                        $op2 = mb_substr($dum[0], 0, 5);  // Round
                        $op3 = mb_substr($dum[0], 5) - 1;  // Spieltagsnummer
                        $op8 = mb_substr($dum[1], 0, 2);

                        $jksp = $dum[3];

                        if ($st == $op3 + 1) {
                            if (1 == $jokertipp && $jkspgrpw != $op3) {
                                fwrite($einsichtdatei, '@' . $jksp . "@\n");

                                $jkspgrpw = $op3;
                            }

                            if (('Round' == $op2) && ('GB' == $op8 || 'GA' == $op8)) {
                                fwrite($einsichtdatei, $dum[1] . '=' . $dum[2] . "\n");
                            }
                        }
                    }
                }
            } // ende if($k>=$start-1 && $k<=$ende-1)

            else {
                $nick = '';

                for ($i = 0, $iMax = count($datenalt); $i < $iMax; $i++) {
                    $zeile = $datenalt[$i];

                    if ('' != $zeile) {
                        if (('[' == mb_substr($zeile, 0, 1)) && (']' == mb_substr($zeile, -1))) {
                            $nick = mb_substr($zeile, 1, -1);
                        }

                        if ($nick == $tippernick) {
                            fwrite($einsichtdatei, $datenalt[$i] . "\n");
                        }
                    }
                } // ende for($i=0;$i<count($datenalt);$i++)
            } // ende else
        } // ende for($k=0;$k<$anztipper;$k++)
        flock($einsichtdatei, 3);

        fclose($einsichtdatei);
    } // ende if(file_exists($file))

    closedir($verz);
}
clearstatcache();
$file = '';
