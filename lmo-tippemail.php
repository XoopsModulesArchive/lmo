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
require_once 'lmo-tippaenderbar.php';
if ('' != $message) {
    $dumma = [''];

    $pswfile = $tippauthtxt;

    $datei = fopen($pswfile, 'rb');

    while (!feof($datei)) {
        $zeile = fgets($datei, 1000);

        $zeile = rtrim($zeile);

        if ('' != $zeile) {
            $dumma[] = $zeile;
        }
    }

    fclose($datei);

    array_shift($dumma);

    $subject = $_POST['betreff'];

    $header = "From:$aadr\n";

    $para5 = "-f $aadr";

    $anzemail = 0;

    $anztipper = count($dumma);

    if (!isset($start)) {
        $start = 1;
    }

    if (!isset($ende)) {
        $ende = $anztipper;
    }

    if (0 == $emailart) {
        for ($tippernr = $start - 1; $tippernr < $ende; $tippernr++) {
            $dummb = preg_split('[|]', $dumma[$tippernr]);

            if (-1 != $dummb[9]) {
                $textmessage = $message;

                $textmessage = str_replace('[nick]', $dummb[0], $textmessage);

                $textmessage = str_replace('[pass]', $dummb[1], $textmessage);

                $textmessage = str_replace('[name]', $dummb[3], $textmessage);

                if (mail($dummb[4], $subject, $textmessage, $header, $para5)) {
                    $anzemail++;
                } else {
                    echo $text[676];
                }
            }
        }

        echo $anzemail . ' ' . $text[675] . '<br>';
    } elseif (1 == $emailart) {
        $textreminder1 = str_replace("\n", '&#10;', $message);

        require 'lmo-tippsavecfg.php';

        $now = strtotime('now');

        $then = strtotime('+' . $tage . ' day');

        if ('viewer' == $liga) {
            $verz = opendir(mb_substr($dirliga, 0, -1));

            $dateien = [''];

            while ($files = readdir($verz)) {
                $ftest = 1;

                if (1 != $immeralle) {
                    $ftest = 0;

                    $ftest1 = '';

                    $ftest1 = preg_split('[,]', $ligenzutippen);

                    if (isset($ftest1)) {
                        for ($u = 0, $uMax = count($ftest1); $u < $uMax; $u++) {
                            if ($ftest1[$u] == mb_substr($files, 0, -4)) {
                                $ftest = 1;
                            }
                        }
                    }
                }

                if (1 == $ftest) {
                    $dateien[] = $files;
                }
            }

            closedir($verz);

            array_shift($dateien);

            sort($dateien);

            $anzligen = count($dateien);

            $teams = array_pad($array, 65, '');

            $teams[0] = '___';

            $liga = [''];

            $titel = [''];

            $lmtype = [''];

            $anzst = [''];

            $spieltag = [''];

            $modus = [''];

            $spiel = [''];

            $teama = [''];

            $teamb = [''];

            $zeit = [''];

            $anzspiele = 0;

            for ($lnr = 0; $lnr < $anzligen; $lnr++) {
                $file = $dirliga . $dateien[$lnr];

                require 'lmo-tippemailviewer.php';
            }

            $goaltipp = array_pad(['_'], $anzspiele + 1, '_');

            array_shift($liga);

            array_shift($titel);

            array_shift($lmtype);

            array_shift($anzst);

            array_shift($spieltag);

            array_shift($modus);

            array_shift($spiel);

            array_shift($teama);

            array_shift($teamb);

            array_shift($zeit);

            for ($tippernr = $start - 1; $tippernr < $ende; $tippernr++) {
                $dummb = preg_split('[|]', $dumma[$tippernr]);

                if (-1 != $dummb[10] && '' != $dummb[4]) {
                    for ($i = 0; $i < $anzspiele; $i++) {
                        $goaltipp[$i] = '_';
                    }

                    $textmessage = $message;

                    $lliga = '';

                    $lspieltag = '';

                    $spiele = '';

                    for ($i = 0; $i < $anzspiele; $i++) {
                        if (0 == $i || $liga[$i] != $liga[$i - 1]) {
                            $tippfile = $dirtipp . $liga[$i] . '_' . $dummb[0] . '.tip';

                            if (file_exists($tippfile)) {
                                require 'lmo-tippemailviewer1.php';

                                $ktipp = 1;
                            } else {
                                $ktipp = 0;
                            }
                        }

                        if (1 == $ktipp) {
                            if ('_' == $goaltipp[$i]) {
                                if ($lspieltag != $spieltag[$i] && $lliga != $liga[$i]) {
                                    $spiele .= "\n" . $titel[$i] . ":\n";
                                }

                                if ($lspieltag != $spieltag[$i]) {
                                    if (0 == $lmtype[$i]) {
                                        $spiele .= $spieltag[$i] . '.' . $text[2] . ":\n";
                                    } else {
                                        if ($spieltag[$i] == $anzst[$i]) {
                                            $j = $text[374];
                                        } elseif ($anzst[$i] - 1 == $spieltag[$i]) {
                                            $j = $text[373];
                                        } elseif ($anzst[$i] - 2 == $spieltag[$i]) {
                                            $j = $text[372];
                                        } elseif ($anzst[$i] - 3 == $spieltag[$i]) {
                                            $j = $text[371];
                                        } else {
                                            $j = $spieltag[$i] . '. ' . $text[370];
                                        }

                                        $spiele .= $j . ":\n";
                                    }
                                }

                                $spiele .= $text[587] . ' ' . $zeit[$i] . ': ' . $teama[$i] . ' - ' . $teamb[$i] . "\n";

                                $lliga = $liga[$i];

                                $lspieltag = $spieltag[$i];
                            }
                        }
                    }

                    if ('' != $spiele) {
                        $textmessage = str_replace('[nick]', $dummb[0], $textmessage);

                        $textmessage = str_replace('[pass]', $dummb[1], $textmessage);

                        $textmessage = str_replace('[name]', $dummb[3], $textmessage);

                        $textmessage = str_replace('[spiele]', $spiele, $textmessage);

                        if (mail($dummb[4], $subject, $textmessage, $header, $para5)) {
                            $anzemail++;
                        } else {
                            echo $text[676];
                        }
                    }
                }
            }
        } elseif ('' != $liga && $tage > 0 && $st >= 0) {
            $file = $dirliga . $liga;

            if ($st > 0) {
                require 'lmo-openfiledat.php';
            } elseif (0 == $st) {
                require 'lmo-openfile.php';
            }

            for ($tippernr = $start - 1; $tippernr < $ende; $tippernr++) {
                $dummb = preg_split('[|]', $dumma[$tippernr]);

                if (-1 != $dummb[10] && '' != $dummb[4]) {
                    $textmessage = $message;

                    $tippfile = $dirtipp . mb_substr($file, mb_strrpos($file, '/') + 1, -4) . '_' . $dummb[0] . '.tip';

                    $spiele = '';

                    if (file_exists($tippfile)) {
                        if ($st > 0) {
                            require 'lmo-tippopenfile.php';

                            $st0 = $st - 1;

                            $anzst1 = $st;
                        } elseif (0 == $st) {
                            require 'lmo-tippopenfileall.php';

                            $st0 = 0;

                            $anzst1 = $anzst;
                        }

                        for (; $st0 <= $anzst1; $st0++) {
                            if ($imvorraus < 0 || $st0 <= ($stx + $imvorraus)) {
                                if (0 == $lmtype) {
                                    for ($dd = 0; $dd < $anzsp; $dd++) {
                                        $zeit = zeit($mterm[$st0][$dd], $datum1[$st0], $datum2[$st0]);

                                        if ($now < $zeit && $then > $zeit) {
                                            if (((0 == $st && '_' == $goaltippa[$st0][$dd]) || ($st > 0 && '_' == $goaltippa[$dd])) && $teama[$st0][$dd] > 0) {
                                                $spiele .= $teams[$teama[$st0][$dd]] . ' - ' . $teams[$teamb[$st0][$dd]] . ' (' . $text[587] . ' ' . strftime('%A, %d.%m.%Y %R', $zeit) . ")\n";
                                            }
                                        }
                                    }
                                } elseif (0 != $lmtype) {
                                    for ($dd = 0; $dd < $anzsp; $dd++) {
                                        for ($ddd = 0; $ddd < $modus[$st0]; $ddd++) {
                                            $zeit = zeit($mterm[$st0][$dd][$ddd], $datum1[$st0], $datum2[$st0]);

                                            if ($now < $zeit && $then > $zeit) {
                                                if (((0 == $st && '_' == $goaltippa[$st0][$dd][$ddd]) || ($st > 0 && '_' == $goaltippa[$dd][$ddd])) && $teama[$st0][$dd] > 0) {
                                                    $spiele .= $teams[$teama[$st0][$dd]] . ' - ' . $teams[$teamb[$st0][$dd]] . ' (' . $text[587] . ' ' . strftime('%A, %d.%m.%Y %R', $zeit) . ")\n";
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        } // ende for($spieltag=1;$spieltag<=$anzst;$spieltag++)

                        if ('' != $spiele) {
                            $textmessage = str_replace('[nick]', $dummb[0], $textmessage);

                            $textmessage = str_replace('[pass]', $dummb[1], $textmessage);

                            $textmessage = str_replace('[name]', $dummb[3], $textmessage);

                            $textmessage = str_replace('[spiele]', $spiele, $textmessage);

                            if (mail($dummb[4], $subject, $textmessage, $header, $para5)) {
                                $anzemail++;
                            } else {
                                echo $text[676];
                            }
                        }
                    }
                } // ende if($dummb[10]!=-1)
            } // ende for($tippernr=0;$tippernr<$anztipper;$tippernr++)
        }

        echo $anzemail . ' ' . $text[675] . '<br>';
    } // ende if($emailart==1)

    elseif (2 == $emailart && '' != $adressat) {
        $dummb = preg_split('[|]', $dumma[0]);

        for ($i = 0; $i < $anztipper && $adressat != $dummb[0]; $i++) {
            $dummb = preg_split('[|]', $dumma[$i]);
        }

        $message = str_replace('[nick]', $dummb[0], $message);

        $message = str_replace('[pass]', $dummb[1], $message);

        $message = str_replace('[name]', $dummb[3], $message);

        if (mail($dummb[4], $subject, $message, $header, $para5)) {
            echo '1 ' . $text[675] . '<br>';
        } else {
            echo $text[676];
        }
    }
}
