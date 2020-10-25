<?php

//
// LigaManager Online 3.02
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
/*
    $datei = fopen($cfgfile,"w");
if (!$datei) {
    echo "<font color=\"#ff0000\">".$text[283]."</font>";
    exit;
}else{
    echo "<font color=\"#008800\">".$text[138]."</font>";
}
    flock($datei,2);
    fputs($datei,"LeagueDir=".$dirliga."\n");
    fputs($datei,"PktJustify=".$tabpkt."\n");
    fputs($datei,"TabOnResults=".$tabonres."\n");
    fputs($datei,"BackLink=".$backlink."\n");
    fputs($datei,"CalcTime=".$calctime."\n");
    fputs($datei,"DefaultTime=".$deftime."\n");
    fputs($datei,"AdminMail=".$aadr."\n");
    flock($datei,3);
    fclose($datei);
*/
//	global $xoopsConfig;
$db = XoopsDatabaseFactory::getDatabaseConnection();
$sql = 'SELECT * FROM ' . $db->prefix('lmo_conf') . '';
$result = $db->query($sql);
if (!$result = $GLOBALS['xoopsDB']->queryF($sql)) {
    echo _LMO_NOTLIGAUPDATE;

    CloseTable();

    xoops_cp_footer();

    exit();
}
    $sql = 'UPDATE ' . $db->prefix('lmo_conf') . " SET LeagueDir='$dirliga', PktJustify='$tabpkt', TabOnResults='$tabonres', TippMitReg='$tippmitreg', BackLink='$backlink', CalcTime='$calctime', DefaultTime='$deftime', AdminMail='$aadr' WHERE conf_id='1'";

//	echo $sql;
//	break;
if (!$result = $db->queryF($sql)) {
    echo "<p><font size='3'><b>" . _LMO_NOTWORK . '</b></font></p>';

    CloseTable();

    xoops_cp_footer();

    break;
}
    //		clearstatcache();
    //		CloseTable();
    //        xoops_cp_footer();
    header('Location:lmoadmin.php');
    break;
