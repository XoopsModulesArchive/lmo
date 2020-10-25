<?php

//
// LigaManager Online 3.02b
// Copyright (C) 1997-2002 by Frank Hollwitz
// webmaster@hollwitz.de / http://php.hollwitz.de
//
// überarbeitet für XOOPS von
// Hans Marx, webmaster@bama-webdesign.de / http://www.bama-webdesign.de
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
//$db = XoopsDatabaseFactory::getDatabaseConnection();
$sql = 'SELECT * FROM ' . $xoopsDB->prefix('lmo_conf') . '';
$result = $$xoopsDB->query($sql);
while (false !== ($myrow = $$xoopsDB->fetchArray($result))) {
    $dirliga = $myrow['LeagueDir'];

    $tabpkt = $myrow['PktJustify'];

    $tabonres = $myrow['TabOnResults'];

    $tippmitreg = $myrow['TippMitReg'];

    $backlink = $myrow['BackLink'];

    $calctime = $myrow['CalcTime'];

    $deftime = $myrow['DefaultTime'];

    $aadr = $myrow['AdminMail'];
}
