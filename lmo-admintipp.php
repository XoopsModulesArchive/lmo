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

if (!isset($save)) {
    $save = 0;
}

if (2 == $save) {
    require 'lmo-tippsavewert.php';
}
if (4 == $save) {
    require 'lmo-tippsavewertgesamt.php';
}
if (3 == $save) {
    require 'lmo-tippsaveeinsicht.php';
}

$addu = $PHP_SELF . '?action=admin&amp;todo=tippuser';
$adde = $PHP_SELF . '?action=admin&amp;todo=tippemail';
$addo = $PHP_SELF . '?action=admin&amp;todo=tippoptions';
?>

<table class="lmosta" cellspacing="0" cellpadding="0" border="0">
    <tr>
        <td class="lmost1" align="center"><?php echo $text[563] ?></td>
    </tr>
    <tr>
        <td align="center" class="lmost3">
            <table class="lmostb" cellspacing="0" cellpadding="0" border="0">
                <tr>
                    <td class="lmost4" colspan="3">
                        <nobr><?php echo $text[564]; ?></nobr>
                    </td>
                </tr>
                <?php $ftype = '.l98';
                $iptype = 'auswert';
                require 'lmo-tippnewdir.php'; ?>
                <?php if (1 == $gesamt) { ?>
                    <tr>
                        <td class="lmost5" width="20">&nbsp;</td>
                        <td class="lmost5"><strong><?php echo $text[556]; ?></strong></td>
                        <td class="lmost5" align="right">
                            <form name="lmoedit" action="<?php echo $PHP_SELF; ?>" method="post">
                                <input type="hidden" name="action" value="admin">
                                <input type="hidden" name="todo" value="tipp">
                                <input type="hidden" name="save" value="4">
                                <input class="lmoadminbut" type="submit" name="best" value="<?php echo $text[736]; ?>">
                            </form>
                        </td>
                    </tr>
                <?php } ?>

                <tr>
                    <td class="lmost4" colspan="3">
                        <nobr><?php echo $text[655]; ?></nobr>
                    </td>
                </tr>
                <?php $ftype = '.l98';
                $iptype = 'einsicht';
                require 'lmo-tippnewdir.php'; ?>
            </table>
        </td>
    <tr>
        <td>
            <table width="100%" cellspacing="0" cellpadding="0" border="0">
                <tr>
                    <?php
                    echo '<td class="lmost1" align="center">' . $text[563] . '</td>';
                    if (2 == $lmouserok) {
                        echo "<td class=\"lmost2\" align=\"center\"><a href=\"javascript:chklmolink('" . $adde . "');\" title=\"" . $text[665] . '">' . $text[665] . '</a></td>';

                        echo "<td class=\"lmost2\" align=\"center\"><a href=\"javascript:chklmolink('" . $addu . "');\" title=\"" . $text[614] . '">' . $text[614] . '</a></td>';

                        echo "<td class=\"lmost2\" align=\"center\"><a href=\"javascript:chklmolink('" . $addo . "');\" title=\"" . $text[555] . '">' . $text[86] . '</a></td>';
                    }
                    ?>
                </tr>
            </table>
        </td>
    </tr>
</table>
