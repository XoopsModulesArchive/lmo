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
if ('tipp' == $action) {
    session_start();
}
?>
<SCRIPT Language="JavaScript">
    <!--
    NS4 = (document.layers);
    if (NS4) {
        document.write('<link rel="stylesheet" href="nc.css" type="text/css">');
    } else {
        document.write('<link rel="stylesheet" href="lmo-style.css" type="text/css">');
    }
    //-->
</script>
<noscript>
    <link rel="stylesheet" href="lmo-style.css" type="text/css">
</noscript>

<?php
ob_start();
setlocale(LC_TIME, 'de_DE');
if (!isset($action)) {
    $action = '';
}
if (!isset($file)) {
    $file = '';
}
if ('admin' == $action) {
    $action = '';
}
$array = [''];

require 'lmo-cfgload.php';
require 'lmo-tippcfgload.php';
require 'lmo-langload.php';

if ('tipp' == $action) {
    define('LMO_TIPPAUTH', 1);

    require 'lmo-tippstart.php';
} elseif ('' == $action) {
    if ('' == $file) {
        require 'lmo-showdir.php';
    } else {
        require 'lmo-openfile.php';

        if (0 == $onrun) {
            $action = 'results';
        } else {
            $action = 'table';
        }

        require 'lmo-showmain.php';
    }
} else {
    if ('' == $file) {
        require 'lmo-showdir.php';
    } else {
        require 'lmo-openfile.php';

        require 'lmo-showmain.php';
    }
}
ob_end_flush();
?>
