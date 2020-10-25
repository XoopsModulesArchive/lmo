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
function getmicrotime()
{
    [$usec, $sec] = explode(' ', microtime());

    return ((float)$usec + (float)$sec);
}

$startzeit = getmicrotime();
$array = [''];
if ('' == $file) {
    ?>

    <table class="lmomaina" cellspacing="0" cellpadding="0" border="0">
        <tr>
            <td class="lmomain0" align="center" colspan="2">
                <nobr>
                    <?php echo $text[52]; ?>
                </nobr>
            </td>
        </tr>
        <tr>
            <td class="lmomain1" colspan="2">
                <table class="lmosta" width="100%" cellspacing="0" cellpadding="0" border="0">
                    <tr>
                        <td align="center" class="lmost1">
                            <?php echo $text[53]; ?>
                        </td>
                    </tr>
                    <tr>
                        <td align="center" class="lmost3">
                            <table class="lmostb" width="100%" cellspacing="0" cellpadding="0" border="0">
                                <tr>
                                    <td class="lmost5" align="center">
                                        <?php $ftype = '.l98';

    require 'lmo-dirlist.php'; ?>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td class="lmomain1" align="left">
                <nobr>&nbsp;
                    <?php
                    if (1 == $tippspiel) {
                        echo '<a href=' . $PHP_SELF . '?action=tipp>' . $text[594] . '</a><br>';

                        //		echo myButTextForm($progurl."/index.php", $text[594], "<input type='hidden' name='action' value='tipp'>");
                    } ?></nobr>
            </td>
            <td class="lmomain2" align="right">
                <nobr><?php if (1 == $calctime) {
                        echo $text[471] . ': ' . number_format((getmicrotime() - $startzeit), 4, '.', ',') . ' sek.<br>';
                    } ?><?php echo $text[54]; ?> - <?php echo $text[55]; ?></nobr>
            </td>
        </tr>
    </table>

    <?php
}
?>
