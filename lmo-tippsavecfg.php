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
$datei = fopen($tippcfgfile, 'wb');
if (!$datei) {
    echo '<font color="#ff0000">' . $text[283] . '</font>';

    exit;
} elseif ('tippemail' != $todo) {
    echo '<font color="#008800">' . $text[138] . '</font>';
}
flock($datei, 2);
fwrite($datei, 'TippDir=' . $dirtipp . "\n");

fwrite($datei, 'ShowNick=' . $shownick . "\n");
fwrite($datei, 'ShowName=' . $showname . "\n");
fwrite($datei, 'ShowEmail=' . $showemail . "\n");

fwrite($datei, 'Tippspiel=' . $tippspiel . "\n");
fwrite($datei, 'Regeln=' . $regeln . "\n");
fwrite($datei, 'RegelnLink=' . $regelnlink . "\n");
fwrite($datei, 'Adresse=' . $adresse . "\n");
fwrite($datei, 'RealName=' . $realname . "\n");
fwrite($datei, 'Gesamt=' . $gesamt . "\n");
fwrite($datei, 'Freischaltung=' . $freischaltung . "\n");
fwrite($datei, 'EntscheidungnV=' . $entscheidungnv . "\n");
fwrite($datei, 'EntscheidungiE=' . $entscheidungie . "\n");
fwrite($datei, 'EinsichtenErstNachSchluss=' . $einsichterst . "\n");
fwrite($datei, 'WertVerein=' . $wertverein . "\n");
fwrite($datei, 'AktAuswert=' . $aktauswert . "\n");
fwrite($datei, 'AktAuswertGes=' . $aktauswertges . "\n");
fwrite($datei, 'AktEinsicht=' . $akteinsicht . "\n");
fwrite($datei, 'TippTabelle=' . $tipptabelle . "\n");
fwrite($datei, 'TippTabelle1=' . $tipptabelle1 . "\n");
fwrite($datei, 'TippEinsicht=' . $tippeinsicht . "\n");
fwrite($datei, 'TippFieber=' . $tippfieber . "\n");
fwrite($datei, 'TippBis=' . $tippbis . "\n");
fwrite($datei, 'TippOhne=' . $tippohne . "\n");
fwrite($datei, 'TipperTeam=' . $tipperimteam . "\n");
fwrite($datei, 'imVorraus=' . $imvorraus . "\n");
fwrite($datei, 'PfeilTipp=' . $pfeiltipp . "\n");
fwrite($datei, 'StTipp=' . $sttipp . "\n");
fwrite($datei, 'ViewerTipp=' . $viewertipp . "\n");
fwrite($datei, 'ViewerTage=' . $viewertage . "\n");
fwrite($datei, 'TippModus=' . $tippmodus . "\n");
fwrite($datei, 'rErgebnis=' . $rergebnis . "\n");
fwrite($datei, 'rTendenzDiff=' . $rtendenzdiff . "\n");
fwrite($datei, 'rTendenz=' . $rtendenz . "\n");
fwrite($datei, 'rTor=' . $rtor . "\n");
fwrite($datei, 'rTendenzTor=' . $rtendenztor . "\n");
fwrite($datei, 'rTendenzRemis=' . $rtendenzremis . "\n");
fwrite($datei, 'rRemis=' . $rremis . "\n");
fwrite($datei, 'AnzahlSeite=' . $anzseite . "\n");
fwrite($datei, 'AnzahlSeite1=' . $anzseite1 . "\n");
fwrite($datei, 'GTPunkte=' . $gtpunkte . "\n");
fwrite($datei, 'ImmerAlle=' . $immeralle . "\n");
fwrite($datei, 'LigenZuTippen=' . $ligenzutippen . "\n");
fwrite($datei, 'TextReminder1=' . $textreminder1 . "\n");
fwrite($datei, 'ShowTendenzAbsolut=' . $showtendenzabs . "\n");
fwrite($datei, 'ShowTendenzProzent=' . $showtendenzpro . "\n");
fwrite($datei, 'ShowDurchnittstipp=' . $showdurchschntipp . "\n");
fwrite($datei, 'ShowZusammensetzung=' . $showzus . "\n");
fwrite($datei, 'ShowStSiege=' . $showstsiege . "\n");
fwrite($datei, 'Krit1=' . $krit1 . "\n");
fwrite($datei, 'Krit2=' . $krit2 . "\n");
fwrite($datei, 'Krit3=' . $krit3 . "\n");
fwrite($datei, 'JokerTipp=' . $jokertipp . "\n");
fwrite($datei, 'JokerTippMulti=' . $jokertippmulti . "\n");

flock($datei, 3);
fclose($datei);

clearstatcache();
