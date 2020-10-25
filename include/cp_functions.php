<?php

// ------------------------------------------------------------------------- //
//      Author of the file: Marx Hans ( http://www.bama-webdesign.de)        //
// ------------------------------------------------------------------------- //
//  This program is free software; you can redistribute it and/or modify     //
//  it under the terms of the GNU General Public License as published by     //
//  the Free Software Foundation; either version 2 of the License, or        //
//  (at your option) any later version.                                      //
//                                                                           //
//  This program is distributed in the hope that it will be useful,          //
//  but WITHOUT ANY WARRANTY; without even the implied warranty of           //
//  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the            //
//  GNU General Public License for more details.                             //
//                                                                           //
//  You should have received a copy of the GNU General Public License        //
//  along with this program; if not, write to the Free Software              //
//  Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307 USA //
// ------------------------------------------------------------------------- //
if (!defined('BAMA_CPFUNCTIONS_INCLUDED')) {
    define('BAMA_CPFUNCTIONS_INCLUDED', 1);

    function bama_cp_header()
    {
        global $xoopsConfig, $xoopsUser;

        xoops_header();

        echo "</head><body topmargin='0' leftmargin='0' marginheight='0' marginwidth='0'>";

        echo "<table border='0' width='100%' cellspacing='0' cellpadding='0'><tr class='bg3'><td align='left' width='30%'>&nbsp;<a href='" . XOOPS_URL . "/admin.php'>" . _AD_MA_XMENUE . '</a></td>';

        echo "<td align='center' width='40%'><b>Liga-Manger Admin - Menü</b></td>";

        echo "<td align='right' width='30%'><a href='" . XOOPS_URL . "/'>" . _YOURHOME . "</a> &nbsp;|&nbsp; <a href='' target='_blank'>" . _MANUAL . '</a>&nbsp;&nbsp;</td></tr></table>';

        echo "<table border='0' cellpadding='0' cellspacing='5' width='100%'><tr>";

        echo "<td valign='top' width='100%'>\n";
    }

    function bama_cp_footer()
    {
        echo "</td></tr><tr><td align='right' colspan='2'>Powered by&nbsp;<a href='http://www.bama-webdesign.de/' target='_blank'>Günter Bauer Webdesign</a> &copy; 2002-2003<br></td></tr></table>
		</body></html>";
    }

    function OpenTable()
    {
        echo "<table width='100%' border='0' cellspacing='1' cellpadding='0'><tr class='bg2'><td valign='top'>\n";

        echo "<table width='100%' border='0' cellspacing='1' cellpadding='8'><tr class='bg3'><td valign='top'>\n";
    }

    function CloseTable()
    {
        echo "</td></tr></table></td></tr></table>\n";
    }
}
