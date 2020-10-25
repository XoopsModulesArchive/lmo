<?php

//
// LMO-Spielplan
//
// Copyright etc. spare ich mir.
// Bitte eMehl an mich, wer's einsetzt.
// Für Verbesserungsvorschläge immer offen, Script ist noch nicht perfekt.
//
// LMO_SPIELPLAN.PHH
// *********
// Funktion:
// *********
// Anzeige des kompletten Spielplans
// Liga-Manager Online von Frank Hollwitz
// http://www.hollwitz.de
// by: Peter Scherb, 11/2002
// Anschauen: www.peterscherb.de/svj
// bearbeitet für e-xoops und xoops
// by: Hans Marx, 07/2003
// webmaster@service.bama-webdesign.de
//  http://www.service.bama-webdesign.de
// webmaster@bama-webdesign.de
//  http://www.bama-webdesign.de
// *************
// Beschreibung:
// *************
// Anzeige und Ausdruck des kompletten Spielplans mit Einstellmöglichkeiten
// (siehe Einstellungsbereich)
//
// ***********************************************************************************
// Aufruf:
// -----------------------------------------------------------------------------------
// lmo_spielplan.php
// Sucht im ligen-Verzeichnis nach vorhandenen Ligen
//
// oder
//
// lmo_spielplan.php?file=[Pfad_zur_Liga/Liga_File][Mannschaften](optional)
// Bsp.: lmo_spielplan.php?file=../ligen/testliga.l98
// Bsp.: lmo_spielplan.php?file=../ligen/testliga.l98&mann=9;1
//
// ******************************************************
// Wen's interessiert, hier der Aufbau des Ergebnis-Array
// ******************************************************
//  [0] : Name der Liga
//  [1] : Anzahl Mannschaften
//  [2] : Anzahl Spieltage
//  [3] : Spiele / Spieltag
//  [4] : Nr. des Favoriten
//  [5] bis [5]+[1]-1: Mannschaften
//  [5] + [1]    : Beginn Spieltag     $spStart
//  [5] + [1] + 1: Nr. Spieltag
//  [5] + [1] + 2: Datum1
//  [5] + [1] + 3: Datum2
//  [5] + [1] + 4: Heimmannschaft   --
//  [5] + [1] + 5: Gastmannschaft     |
//  [5] + [1] + 6: Heimtore           |
//  [5] + [1] + 7: Gasttore           |-- Multiplizert mit [3], $spAnzDaten
//  [5] + [1] + 8: Notiz              |
//  [5] + [1] + 9: Anstoßzeit       --
//
// Daraus ergibt sich die Formel für die Berechnung eines beliebigen Spieltags:
// 5 + [1] + (NrSpTag - 1) * (3 + (6 * [3])) : Beginn des nächsten Spieltages
// |         |                |    |
// |         |                |    Heim-, Gastmannsch., Heim-, Gasttore, Notiz, Anstoßzeit
// |         |                Nr, Datum1, Datum2
// |         Nr. des Spieltags
// Anfang 1. Spieltag
//
// Bsp: [1] : Anzahl Mannschaften  =  9
//      [2] : Anzahl Spieltage     = 18
//      [3] : Spiele / Spieltag    =  4
// 5 + 9 +  (2 - 1) * (3 + (6 *4)) =  41 : Beginn des 2. Spieltages
// 5 + 9 + (18 - 1) * (3 + (6 *4)) = 473 : Beginn des 18. Spieltages

// -------------------------------------------------------------------------------------------------
// Einstellungsbereich
$pfadLiga = '../lmo/ligen/';      // Pfad zu den Ligen (MIT / am Ende)! ...
// ... relativ zum Script der dies aufruft
$anzNotiz = 1;              // Notiz-Anzeige: 0=nein, 1=ja
$anzKeineTore = '-';            // Zeichen für keine Tore
$anzFavorit = 1;              // Favorit-Anzeige: 0=nein, 1=ja
$anzVerlSpiele = 1;              // Hervorhebung der verlegten Spiele
$anzSpielfrei = 1;              // Anzeige der spielfreien Mannschaften: 0=nein, 1=ja
$colorVerlSp = '#0000FF';      // Farbe für Hervorhebung der verlegten Spiele
$fontSizeNum = 10;             // Schriftgröße der Anzeige
$spTagBackColor = '#D7D7D7';      // Hintergrundfarbe für Spieltagshervorhebung,
// #FFFFFF wenn nicht gewünscht
// Ende Einstellungsbereich
// -------------------------------------------------------------------------------------------------

// ----------------------------------------------------------------------------
// Allgemeine Variablen
$designFile = $PfadLMO . 'lmo-style.css';
$design = '<link rel=stylesheet type="text/css" href="' . $designFile . '">';
$pedSP = '0.87a';
$tabBreite = 8 + $anzNotiz;
$fontSize = $fontSizeNum . 'pt';
$fontSizeHeader = ($fontSizeNum + 2) . 'pt';
$fontSizeCopy = ($fontSizeNum > 10 ? 10 : $fontSizeNum - 1) . 'pt';
$arrWeekDay = ['Sonntag', 'Montag', 'Dienstag', 'Mittwoch', 'Donnerstag', 'Freitag', 'Samstag'];
// Ende allgemeine Variablen
// ----------------------------------------------------------------------------
if ('' == $file) {
    $verz = opendir(mb_substr($pfadLiga, 0, -1));

    $arrLiga = [''];

    while ($files = readdir($verz)) {
        if ('.l98' == mb_strtolower(mb_substr($files, -4))) {
            $arrLiga[] = $files;
        }
    }

    closedir($verz);

    array_shift($arrLiga);

    sort($arrLiga);

    // Ausgabe

    echo $design;

    echo "<body topmargin='0' leftmargin='0'><div align='center'><center>";

    echo '<table>';

    echo '<tr>';

    echo '<th colspan=' . $tabBreite . ' class=lmomain0>';

    echo 'Vorhandene Spielpläne';

    echo '</th>';

    echo '</tr>';

    $noLiga = 0;

    for ($i = 0, $iMax = count($arrLiga); $i < $iMax; $i++) {
        $files = $arrLiga[$i];

        $sekt = '';

        $ligaName = '';

        $actual = '';

        $datei = fopen($pfadLiga . $files, 'rb');

        while (!feof($datei)) {
            $zeile = fgets($datei, 1000);

            $zeile = trim(rtrim($zeile));

            if (('[' == mb_substr($zeile, 0, 1)) && (']' == mb_substr($zeile, -1))) {
                $sekt = mb_substr($zeile, 1, -1);
            } elseif ((false !== mb_strpos($zeile, '=')) && (';' != mb_substr($zeile, 0, 1)) && ('Options' == $sekt)) {
                $schl = mb_substr($zeile, 0, mb_strpos($zeile, '='));

                $wert = mb_substr($zeile, mb_strpos($zeile, '=') + 1);

                if ('Name' == $schl) {
                    $ligaName = $wert;
                }

                if ('Actual' == $schl) {
                    $actual = $wert;
                }

                if ('Type' == $schl) {
                    $type = $wert;
                }

                if (('' != $ligaName) && ('' != $actual)) {
                    break;
                }
            }
        }

        fclose($datei);

        if ('' == $ligaName) {
            $noLiga++;

            $ligaName = 'Unbenannte Liga ' . $noLiga;
        }

        if ('' != $actual) {
            $ausgabe = ' / ' . $actual . '. Spieltag';
        } else {
            $ausgabe = '';
        }

        // Ausgabe

        echo '<tr>';

        echo '<td  colspan=' . $tabBreite . ' class=lmost4>';

        echo '<ul>';

        echo '<li><a href="lmo_spielplan.php?file=' . $pfadLiga . $files . '&mann=0' . '">' . $ligaName . '<br><small>' . date('d.m.Y H:i', filectime($pfadLiga . $files)) . $ausgabe . '</small></a></li>';

        echo '</td>';

        echo '</ul>';

        echo '</tr>';
    }

    // Fußzeile

    echo '<tr>';

    echo "<td class=lmomain2 colspan='8' align=center>";

    echo "<style='font-size:2px'>";

    echo "<a href='http://www.peterscherb.de/svj' target='_blank'>";

    echo 'Peter Scherb V ' . $pedSP;

    echo '</a> &copy; ' . date('m') . '/' . date('Y') . " <a href='mailto:Peter.Scherb@PeterScherb.de'>";

    echo 'eMehl an Pedä</a>';

    echo '</td>';

    echo '</tr>';

    echo '</table>';
} else {
    $arrSP = GetSPData($file);

    // Variablen
    $spStart = 5 + $arrSP[1];    // Ende Header
    $spAnzDaten = 6;                // Erklärung siehe oben
    $spOffset = (3 + ($spAnzDaten * $arrSP[3]));

    // Erklärung siehe oben

    $verlegt = 0;

    $designFile = $PfadLMO . 'lmo-style.css';

    $design = '<link rel=stylesheet type="text/css" href="' . $designFile . '">';

    $arrMann = explode(';', $mann);

    // Ausgabe

    echo "<p align='center' style='font-family:Verdana,arial,helvetica;font-size:$fontSizeHeader'>";

    //            echo "<strong>";

    echo $arrSP[0];

    echo '</strong><br>';

    //        echo "</p>";

    //        echo "<p align='center' style='font-family:Verdana,arial,helvetica;font-size:10pt'>";

    echo "<p align='center' style='font-family:Verdana;font-size:10pt'>";

    echo "<table border= '0' cellspacing='0' align='center'>";

    // Hauptschleife

    for ($i = $spStart, $iMax = count($arrSP); $i < $iMax; $i += $spOffset) {
        echo "<td colspan=$tabBreite style='font-size=$fontSize;background-color=$spTagBackColor;border-top-style:solid;border-bottom-style:solid;border-width:1px;border-color:#000000';>";

        //                    echo "<strong>";

        echo $arrSP[$i] . '. Spieltag - ' . $arrWeekDay[(int)date('w', DateSPToUnix($arrSP[$i + 1]))] . ', ' . $arrSP[$i + 1];

        // 2. Datum

        if ('' != rtrim($arrSP[$i + 2])) {
            echo ' bis ' . $arrWeekDay[(int)date('w', DateSPToUnix($arrSP[$i + 2]))] . ', ' . $arrSP[$i + 2];
        }  // Ende if ... ( 2. Datum)

        //                    echo "</strong>";

        echo '</td>';

        // Spielfrei-Template vorbelegen

        for ($k = 1; $k <= $arrSP[1]; $k++) {
            $arrFreiTemplate[$k] = 1;
        } // Ende for ... (Spielfrei-Template vorbelegen)

        // Spieltagdurchlauf

        for ($j = 0; $j < $arrSP[3]; $j++) {
            $index = $i + 2 + ($j * $spAnzDaten);

            $arrFreiTemplate[(int)$arrSP[$index + 1]] = 0;

            $arrFreiTemplate[(int)$arrSP[$index + 2]] = 0;

            $flHeim = array_seek($arrSP[$index + 1], $arrMann);

            $flGast = array_seek($arrSP[$index + 2], $arrMann);

            $flVorbei = 0 != $mann && -1 != $arrSP[$index + 3];

            $kennVorbei = '&radic;';

            // Anzeige alle ($mann == "0")

            if ('0' == $mann || -1 != $flHeim || -1 != $flGast) {
                echo '<tr>';

                // Anstoßzeit

                echo "<td style='font-size=$fontSize;'>";

                $dummy = rtrim((string)date('d.m.Y', $arrSP[$index + 6])) != rtrim((string)$arrSP[$i + 1]) && 1 == $anzVerlSpiele && -1 == $arrSP[$index + 3] && -1 == $arrSP[$index + 4] && isVerlegtSP($arrSP[$i + 1], $arrSP[$index + 6]);

                if ($dummy) {
                    echo "<font color=$colorVerlSp>";

                    $verlegt = 1;
                }

                // Anstoßzeit nicht leer

                if ('' != rtrim($arrSP[$index + 6])) {
                    //                                            if ($flVorbei) { echo "<$kennVorbei>"; }

                    echo date('d.m.Y H:i', $arrSP[$index + 6]);

                //                                            if ($flVorbei) { echo "</$kennVorbei>"; }
                } else {
                    echo 'nicht bekannt';
                }

                if ($dummy) {
                    echo '*</font>';
                } // Ende if ... (Anstoßzeit nicht leer)

                echo '</td>';

                // Heimmannschaft

                echo "<td style='font-size=$fontSize;'>";

                if ($anzFavorit && (int)$arrSP[$index + 1] == (int)$arrSP[4]) {
                    echo '<b>';
                }

                //                                        if ($flVorbei) { echo "<$kennVorbei>"; }

                echo $arrSP[4 + $arrSP[$index + 1]];

                //                                        if ($flVorbei) { echo "</$kennVorbei>"; }

                if ($anzFavorit && (int)$arrSP[$index + 1] == (int)$arrSP[4]) {
                    echo '</b>';
                }

                echo '</td>';

                // -

                echo "<td style='font-size=$fontSize;'>";

                echo '-';

                echo '</td>';

                // Gastmannschaft

                echo "<td style='font-size=$fontSize;'>";

                if ($anzFavorit && (int)$arrSP[$index + 2] == (int)$arrSP[4]) {
                    echo '<b>';
                }

                //                                        if ($flVorbei) { echo "<$kennVorbei>"; }

                echo $arrSP[4 + $arrSP[$index + 2]];

                //                                        if ($flVorbei) { echo "</$kennVorbei>"; }

                if ($anzFavorit && (int)$arrSP[$index + 2] == (int)$arrSP[4]) {
                    echo '</b>';
                }

                echo '</td>';

                if (0 == $mann || 1 == $ergeb) {
                    // Heimtore

                    echo "<td align='right' style='font-size=$fontSize;'>";

                    if (-1 != $arrSP[$index + 3]) {
                        echo $arrSP[$index + 3];
                    } else {
                        echo $anzKeineTore;
                    }

                    echo '</td>';

                    // :

                    echo "<td style='font-size=$fontSize;'>";

                    echo ':';

                    echo '</td>';

                    // Gasttore

                    echo "<td align='left' style='font-size=$fontSize;'>";

                    if (-1 != $arrSP[$index + 4]) {
                        echo $arrSP[$index + 4];
                    } else {
                        echo $anzKeineTore;
                    }

                    echo '</td>';

                    // Notiz

                    if (1 == $anzNotiz) {
                        echo "<td style='font-size=$fontSize;'>";

                        echo $arrSP[$index + 5];

                        echo '</td>';
                    } // Ende if ... (Notiz)
                } else {
                    if ($flVorbei) {
                        echo '<td>';

                        echo '&radic;';

                        echo '</td>';
                    }
                }

                echo '</tr>';
            } // Ende if ... (Anzeige alle ($mann == "0"))
        } // Ende for ... (Spieltagdurchlauf)

        // Anzeige spielfreier Mannschaften

        if (1 == $anzSpielfrei || '0' != $mann) {
            // Spielfrei - Schleife

            for ($k = 1; $k <= $arrSP[1]; $k++) {
                if (1 == $arrFreiTemplate[$k] && ('0' == $mann ? 1 : -1 != array_seek((string)$k, $arrMann))) {
                    echo '<tr>';

                    echo "<td colspan='4' style='font-size=$fontSize;'>";

                    echo 'Spielfrei: ';

                    if ($k == (int)$arrSP[4]) {
                        echo '<b>';
                    }

                    //                                            if ($flVorbei) { echo "<$kennVorbei>"; }

                    echo $arrSP[4 + $k];

                    //                                            if ($flVorbei) { echo "</$kennVorbei>"; }

                    if ($k == (int)$arrSP[4]) {
                        echo '</b>';
                    }

                    if ($flVorbei) {
                        echo '<td>';

                        echo '&radic;';

                        echo '</td>';
                    }

                    echo '</td>';

                    echo '</tr>';

                    //   break;
                }
            } // Ende for ... (Spielfrei - Schleife)
        } // Ende if ... (Anzeige spielfreier Mannschaften)
        // Leerzeile
        echo '<tr>';

        echo "<td style='font-size=$fontSize;'>";

        //echo "&nbsp;";

        echo '</td>';

        echo '</tr>';
    }  // Ende for ... (Hauptschleife)

    // Anzeige verlegter Spiele ?

    if (1 == $anzVerlSpiele && 1 == $verlegt) {
        echo '<tr>';

        echo "<td style='font-size=$fontSize;'>";

        echo "<font color=$colorVerlSp>";

        echo '* verlegte Spiele';

        echo '</font>';

        echo '</td>';

        echo '</tr>';
    } // Ende if ... (Anzeige verlegter Spiele ?)

    echo '</table>';

    // Copyrights

    echo '<br>';

    echo "<p align='center' style='font-family:Verdana,arial,helvetica;font-size:$fontSizeCopy'>";

    echo "<a href='http://www.peterscherb.de/svj' target='_blank'>";

    echo 'LMO-Spielplan V ' . $pedSP;

    echo '</a> &copy; ' . date('m') . '/' . date('Y') . " <a href='mailto:Peter.Scherb@PeterScherb.de'>";

    echo 'eMehl an Pedä</a>';

    echo '<br>';

    echo 'www.peterscherb.de/svj';

    echo '<br>';

    echo "powered for e-xoops and xoops by <a href='http://service.bama-webdesign.de' target='_blank'>bama-webdesign.de</a> &copy; Hans Marx 07/2003";

    echo '</p>';

    echo '</p>';
}

// ------------------------------------------------------------------------------------------------
function GetSPData($LigaFile)
{
    // Datei komplett einlesen

    $arrFile = file($LigaFile);

    $sizeOfArrFile = count($arrFile);

    $spCounter = 5;                    // laufender Zähler des Ergebnis-Arrays
    $SpielTag = 1;                    // laufender Zähler der Spieltage
    $arrSP = ['', 0, 0, 0, 0];

    // Vorbelegung des Ergebnis-Arrays

    // "Header" einlesen

    for ($i = 0; $i < $sizeOfArrFile; $i++) {
        $arrFile[$i] = rtrim($arrFile[$i]);

        // Name der Liga merken

        if ('Name' == GetSPKey($arrFile[$i])) {
            $arrSP[0] = GetSPValue($arrFile[$i]);
        } // Ende if ... (Name der Liga merken)

        // Art der Liga merken: 0 = Liag, 1 = KO-Turnier

        if ('Type' == GetSPKey($arrFile[$i])) {
            $flType = GetSPValue($arrFile[$i]);

            if (1 == $flType) {
                $arrSP[$spCounter - 1] .= ' (Turnier)';
            }
        } // Ende if ... (Name der Liga merken)

        // Anzahl der Mannschaften

        if ('Teams' == GetSPKey($arrFile[$i])) {
            $arrSP[1] = GetSPValue($arrFile[$i]);
        } // Ende if ... (Anzahl der Mannschaften)

        // Anzahl der Spieltage

        if ('Rounds' == GetSPKey($arrFile[$i])) {
            $arrSP[2] = GetSPValue($arrFile[$i]);
        }

        // Ende if ... (Anzahl der Spieltage)

        // Anzahl der Begegnungen / Spieltage

        if ('Matches' == GetSPKey($arrFile[$i])) {
            $arrSP[3] = GetSPValue($arrFile[$i]);
        }

        // Ende if ... (Anzahl Begegnungen / Spieltage)

        // favTeam merken

        if ('favTeam' == GetSPKey($arrFile[$i])) {
            $arrSP[4] = GetSPValue($arrFile[$i]);
        } // Ende if ... (favTeam merken)

        // Teams einlesen

        if ('[Teams]' == $arrFile[$i]) {
            $i++;

            for ($j = 1; $j <= $arrSP[1]; $j++) {
                $arrSP[$spCounter++] = GetSPValue($arrFile[$i++]);
            }
        } // Ende if ... (Teams einlesen)

        // hat die Spieltag-Sektion erreicht -> raus

        if ('[Round1]' == $arrFile[$i]) {
            break;
        } // Ende if ... (hat die Spieltag-Sektion erreicht -> raus)
    } // Ende for ... ("Header" einlesen)

    $counAT = 1;            // Anzahl der Spiele/Spieltag bei Turnieren

    $flLeer = false;

    // Schleife Spieltage

    for ($spTag = $i; $spTag < $sizeOfArrFile; $spTag++) {
        // Nächste Runde erreicht ?

        if ('[Round' == mb_substr($arrFile[$spTag], 0, 6)) {
            // Nur bei Turnieren

            if (1 == $flType) {
                if ($countAT > $arSP[3]) {
                    $arrSP[3] = $countAT;
                }

                $counAT = 1;            // Anzahl der Spiele/Spieltag bei Turnieren
            } // Ende if ... (Nur bei Turnieren)

            // Ist das Datum leer -> nicht eintragen

            $value = mb_substr($arrFile[$spTag + 1], mb_strpos($arrFile[$spTag + 1], '=') + 1);

            if ('' != rtrim($value)) {
                $flLeer = false;

                $arrSP[$spCounter++] = $SpielTag++;

                $spTag++;
            } else {
                $flLeer = true;
            }
        } // Ende if ... (Nächste Runde erreicht ?)

        // Schlüßel

        $key = mb_substr($arrFile[$spTag], 0, 2);

        // Wert

        $value = mb_substr($arrFile[$spTag], mb_strpos($arrFile[$spTag], '=') + 1);

        // Keys, die übersprungen werden

        if (!(0 == mb_strpos($arrFile[$spTag], '=') || 'HS' == $key || 'MO' == $key || 'ET' == $key || 'SP' == $key || 'BE' == $key || 'TI' == $key)) {
            if (!$flLeer) {
                $arrSP[$spCounter++] = rtrim($value);

                // Nur bei Turnieren

                if (1 == $flType) {
                    // $countAT bei $key="AT" hochzählen

                    if ('AT' == $key) {
                        $countAT++;
                    } // Ende if ... ($countAT bei $key="AT" hochzählen)
                } // Ende if ... (Nur bei Turnieren)
            } // Ende if ... (Leere Spieltage überspringen)
        } // Ende if ... (Keys, die übersprungen werden)
    } // Ende for ... (Schleife Spieltage)

    return $arrSP;
}

function GetSPKey($xVar)
{
    return (mb_substr($xVar, 0, mb_strpos($xVar, '=')));
}

function GetSPValue($xVar)
{
    return (mb_substr($xVar, mb_strpos($xVar, '=') + 1));
}

function DateSPToUnix($dateString)
{
    $arr = explode('.', $dateString);

    return mktime(0, 0, 0, $arr[1], $arr[0], $arr[2]);
}

// Checkt, ob Spielverlegt wurde, Algorithmus aus lmo_spieleverlegung.php
function isVerlegtSP($dateString, $anStZeit)
{
    // $dateString zerlegen und umwandeln

    $arrDate = explode('.', rtrim($dateString));

    $arrGetDate = getdate(mktime(0, 0, 0, $arrDate[1], $arrDate[0], $arrDate[2]));

    // Kalenderwoche von $dateString

    $week1 = strftime('%W', mktime(0, 0, 0, $arrDate[1], $arrDate[0], $arrDate[2]));

    // Wochentag von $dateString

    $weekDay1 = $arrGetDate[wday];

    // Woche des AT-Datums

    $week2 = strftime('%W', $anStZeit);

    // Wochentag des AT-Datums

    $weekDay2 = date('w', $anStZeit);

    $flVerlegt = false;

    if (rtrim($dateString) != (string)rtrim(date('d.m.Y', $anStZeit))) {
        if ($week1 != $week2) {
            $flVerlegt = true;
        } elseif ($week1 == $week2) {
            if (($weekDay1 >= 5 || 0 == $weekDay1) && $weekDay2 < 5 && 0 != $weekDay2) {
                $flVerlegt = true;
            } elseif ($weekDay1 < 5 && 0 != $weekDay1) {
                $flVerlegt = true;
            }
        }
    }

    return $flVerlegt;
}

function array_seek($item, $arr)
{
    for ($i = 0, $iMax = count($arr); $i < $iMax; $i++) {
        if ($item == $arr[$i]) {
            return $i;
        }
    }

    return -1;
}
