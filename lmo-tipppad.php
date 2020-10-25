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
require_once 'lmo-tipptest.php';
if (('tipp' == $action) && ('' == $todo)) {
    $adda = $PHP_SELF . '?action=tipp&amp;todo=';

    $addw = $PHP_SELF . '?action=tipp&amp;todo=wert&amp;file='; ?>
    <table class="lmosta" width="100%" cellspacing="0" cellpadding="0" border="0">
        <tr>
            <td align="center" class="lmost1">
                <font color=black><?php echo $lmotippername;

    if ('' != $lmotipperverein) {
        echo ' - ' . $lmotipperverein;
    } ?></font><br>
                <?php echo $text[737]; ?>
            </td>
        </tr>
        <tr>
            <td align="center" class="lmost3">
                <table class="lmostb" cellspacing="0" cellpadding="0" border="0">

                    <tr>
                        <td class="lmost4">
                            <nobr><?php echo $text[503]; ?>:</nobr>
                        </td>
                    </tr>

                    <tr>
                        <td class="lmost5">
                            <nobr><?php $ftype = '.tip';

    require 'lmo-tippdir.php'; ?></td>
                    </tr>

                    <tr>
                        <td class="lmost4">
                            <nobr><?php echo $text[504]; ?></nobr>
                        </td>
                    </tr>

                    <tr>
                        <td class="lmost5">
                            <nobr>
                                <center>
                                    <?php
                                    $dummy = preg_split('[|]', $tt1);

    $ftest2 = preg_split('[|]', $tt0);

    if (isset($dummy) && isset($ftest2)) {
        for ($u = 0, $uMax = count($dummy); $u < $uMax; $u++) {
            if ('' != $dummy[$u] && '' != $ftest2[$u]) {
                $dummy[$u] = mb_substr($dummy[$u], 0, -4);

                $auswertfile = $dirtipp . 'auswert/' . $dummy[$u] . '.aus'; ?>
                                                <li class="lmoadminli"><a href="<?php echo $addw . $dirliga . $dummy[$u] . '.l98&amp;PHPSESSID=' . $PHPSESSID; ?>"><?php echo $ftest2[$u];

                if (file_exists($auswertfile)) {
                    echo '<br><small>' . $text[583] . ': ' . date('d.m.Y H:i', filectime($auswertfile)) . '</small>';
                }

                echo '</a>'; ?></li>
                                                <?php
            }
        }
    }

    if (1 == $gesamt && $u > 2) {
        $auswertfile = $dirtipp . 'auswert/gesamt.aus'; ?>
                                        <li class="lmoadminli"><a href="<?php echo $addw . '&amp;all=1&amp;PHPSESSID=' . $PHPSESSID; ?>"><strong><?php echo $text[525];

        if (file_exists($auswertfile)) {
            echo '<br><small>' . $text[583] . ': ' . date('d.m.Y H:i', filectime($auswertfile)) . '</small>';
        } ?> <strong></a></li>
                                    <?php
    }

    $auswertfile = ''; ?>
                                </center>
                        </td>
                    </tr>
                    <tr>
                        <td class="lmost4">
                            <nobr><?php echo $text[645]; ?>:</nobr>
                        </td>
                    </tr>
                    <tr>
                        <td class="lmost5">
                            <nobr>
                                <center>
                                    <li class="lmoadminli"><?php echo '<a href="' . $adda . 'newligen&amp;PHPSESSID=' . $PHPSESSID . '">' . $text[505] . '</a>'; ?></li>
                                    <li class="lmoadminli"><?php echo '<a href="' . $adda . 'delligen&amp;PHPSESSID=' . $PHPSESSID . '">' . $text[766] . '</a>'; ?></li>
                                    <li class="lmoadminli"><?php echo '<a href="' . $adda . 'daten&amp;PHPSESSID=' . $PHPSESSID . '">' . $text[606];

    if ($tipperimteam >= 0) {
        echo ' / ' . $text[502];
    }

    echo '</a>'; ?></li>
                                    <li class="lmoadminli"><?php echo '<a href="' . $adda . 'pwchange&amp;PHPSESSID=' . $PHPSESSID . '">' . $text[607] . '</a>'; ?></li>
                                    <li class="lmoadminli"><?php echo '<a href="' . $adda . 'delaccount&amp;PHPSESSID=' . $PHPSESSID . '">' . $text[506] . '</a>'; ?></li>
                                    <li class="lmoadminli"><?php echo '<a href="' . $adda . 'logout&amp;PHPSESSID=' . $PHPSESSID . '">' . $text[507] . '</a>'; ?></li>
                                </center>
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
