<?php

//
// LigaManager Online 3.02b
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
require_once 'lmo-admintest.php';
if (('admin' == $action) && ('delete' == $todo) && (2 == $HTTP_SESSION_VARS['lmouserok'])) {
    $adda = $PHP_SELF . '?action=admin&amp;todo=';

    if (!isset($del)) {
        $del = 0;
    }

    if (1 == $del) {
        if (@unlink($dfile)) {
            echo '<font color="#008800">' . $dfile . ' ' . $text[297] . '</font>';
        } else {
            echo '<font color="#ff0000">' . $dfile . ' ' . $text[298] . '</font>';
        }
    } ?>
    <table class="lmosta" width="100%" cellspacing="0" cellpadding="0" border="0">
        <tr>
            <td align="center" class="lmost1">
                <?php echo $text[295]; ?>
            </td>
        </tr>
        <tr>
            <td align="center" class="lmost3">
                <table class="lmostb" cellspacing="0" cellpadding="0" border="0">
                    <tr>
                        <td class="lmost5">
                            <nobr>
                                <?php $ftype = '.l98';

    require 'lmo-admindeldir.php'; ?>
                            </nobr>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <?php
}
?>