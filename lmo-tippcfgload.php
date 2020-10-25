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
$tippcfgfile = 'lmo-tippcfg.txt';
$tippauthtxt = 'lmo-tippauth.txt';
$datei = fopen($tippcfgfile, 'rb');
while (!feof($datei)) {
    $zeile = fgets($datei, 1000);

    $zeile = rtrim($zeile);

    if ('' != $zeile) {
        $schl = trim(mb_substr($zeile, 0, mb_strpos($zeile, '=')));

        $wert = trim(mb_substr($zeile, mb_strpos($zeile, '=') + 1));

        if ('TippDir' == $schl) {
            $dirtipp = $wert;
        } elseif ('ShowNick' == $schl) {
            $shownick = $wert;
        } elseif ('ShowName' == $schl) {
            $showname = $wert;
        } elseif ('ShowEmail' == $schl) {
            $showemail = $wert;
        } elseif ('Tippspiel' == $schl) {
            $tippspiel = $wert;
        } elseif ('Regeln' == $schl) {
            $regeln = $wert;
        } elseif ('RegelnLink' == $schl) {
            $regelnlink = $wert;
        } elseif ('Freischaltung' == $schl) {
            $freischaltung = $wert;
        } elseif ('EntscheidungnV' == $schl) {
            $entscheidungnv = $wert;
        } elseif ('EntscheidungiE' == $schl) {
            $entscheidungie = $wert;
        } elseif ('EinsichtenErstNachSchluss' == $schl) {
            $einsichterst = $wert;
        } elseif ('WertVerein' == $schl) {
            $wertverein = $wert;
        } elseif ('AktAuswert' == $schl) {
            $aktauswert = $wert;
        } elseif ('AktAuswertGes' == $schl) {
            $aktauswertges = $wert;
        } elseif ('AktEinsicht' == $schl) {
            $akteinsicht = $wert;
        } elseif ('TippTabelle' == $schl) {
            $tipptabelle = $wert;
        } elseif ('TippTabelle1' == $schl) {
            $tipptabelle1 = $wert;
        } elseif ('TippEinsicht' == $schl) {
            $tippeinsicht = $wert;
        } elseif ('TippFieber' == $schl) {
            $tippfieber = $wert;
        } elseif ('Adresse' == $schl) {
            $adresse = $wert;
        } elseif ('RealName' == $schl) {
            $realname = $wert;
        } elseif ('Gesamt' == $schl) {
            $gesamt = $wert;
        } elseif ('TippBis' == $schl) {
            $tippbis = $wert;
        } elseif ('TippOhne' == $schl) {
            $tippohne = $wert;
        } elseif ('TipperTeam' == $schl) {
            $tipperimteam = $wert;
        } elseif ('imVorraus' == $schl) {
            $imvorraus = $wert;
        } elseif ('PfeilTipp' == $schl) {
            $pfeiltipp = $wert;
        } elseif ('StTipp' == $schl) {
            $sttipp = $wert;
        } elseif ('ViewerTipp' == $schl) {
            $viewertipp = $wert;
        } elseif ('ViewerTage' == $schl) {
            $viewertage = $wert;
        } elseif ('TippModus' == $schl) {
            $tippmodus = $wert;
        } elseif ('rErgebnis' == $schl) {
            $rergebnis = $wert;
        } elseif ('rTendenzDiff' == $schl) {
            $rtendenzdiff = $wert;
        } elseif ('rTendenz' == $schl) {
            $rtendenz = $wert;
        } elseif ('rTor' == $schl) {
            $rtor = $wert;
        } elseif ('rRemis' == $schl) {
            $rremis = $wert;
        } elseif ('rTendenzTor' == $schl) {
            $rtendenztor = $wert;
        } elseif ('rTendenzRemis' == $schl) {
            $rtendenzremis = $wert;
        } elseif ('AnzahlSeite' == $schl) {
            $anzseite = $wert;
        } elseif ('AnzahlSeite1' == $schl) {
            $anzseite1 = $wert;
        } elseif ('GTPunkte' == $schl) {
            $gtpunkte = $wert;
        } elseif ('ImmerAlle' == $schl) {
            $immeralle = $wert;
        } elseif ('LigenZuTippen' == $schl) {
            $ligenzutippen = $wert;
        } elseif ('TextReminder1' == $schl) {
            $textreminder1 = $wert;
        } elseif ('ShowTendenzAbsolut' == $schl) {
            $showtendenzabs = $wert;
        } elseif ('ShowTendenzProzent' == $schl) {
            $showtendenzpro = $wert;
        } elseif ('ShowDurchnittstipp' == $schl) {
            $showdurchschntipp = $wert;
        } elseif ('ShowZusammensetzung' == $schl) {
            $showzus = $wert;
        } elseif ('ShowStSiege' == $schl) {
            $showstsiege = $wert;
        } elseif ('Krit1' == $schl) {
            $krit1 = $wert;
        } elseif ('Krit2' == $schl) {
            $krit2 = $wert;
        } elseif ('Krit3' == $schl) {
            $krit3 = $wert;
        } elseif ('JokerTipp' == $schl) {
            $jokertipp = $wert;
        } elseif ('JokerTippMulti' == $schl) {
            $jokertippmulti = $wert;
        }
    }
}
fclose($datei);
clearstatcache();
