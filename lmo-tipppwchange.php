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
if (('tipp' == $action) && ('pwchange' == $todo)) {
    if (!isset($xtipperpass)) {
        $xtipperpass = '';
    }

    if (!isset($xtipperpassneu)) {
        $xtipperpassneu = '';
    }

    if (!isset($xtipperpassneuw)) {
        $xtipperpassneuw = '';
    }

    $users = [''];

    $pswfile = $tippauthtxt;

    $datei = fopen($pswfile, 'rb');

    while (!feof($datei)) {
        $zeile = fgets($datei, 1000);

        $zeile = trim(rtrim($zeile));

        if ('' != $zeile) {
            if ('' != $zeile) {
                $users[] = $zeile;
            }
        }
    }

    fclose($datei);

    $gef = 0;

    for ($i = 1; $i < count($users) && 0 == $gef; $i++) {
        $dummb = preg_split('[|]', $users[$i]);

        if ($lmotippername == $dummb[0]) { // Nick gefunden
            $gef = 1;

            $save = $i;
        }
    }

    if (0 == $gef) {
        exit;
    }

    if (1 != $newpage) {
        if ('' == $dummb[5]) {
            $xtippervereinradio = 0;
        } else {
            $xtippervereinradio = 1;

            $xtippervereinalt = $dummb[5];
        }
    }

    if (1 == $newpage) {
        $xtipperpass = trim($xtipperpass);

        if ($xtipperpass != $dummb[1]) {
            $newpage = 0;

            echo '<font color=red>' . $text[542] . '</font><br>';
        }
    }

    if (1 == $newpage) {
        $xtipperpassneu = trim($xtipperpassneu);

        if ('' == $xtipperpassneu) {
            $newpage = 0;

            echo '<font color=red>' . $text[569] . '</font><br>';
        } elseif (mb_strlen($xtipperpassneu) < 3) {
            $newpage = 0;

            echo '<font color=red>' . $text[573] . '</font><br>';
        }

        $xtipperpassneuw = trim($xtipperpassneuw);

        if ($xtipperpassneuw != $xtipperpassneu) {
            $newpage = 0;

            echo '<font color=red>' . $text[570] . '</font><br>';
        }
    }

    if (1 == $newpage) {
        $users[$save] = $dummb[0] . '|' . $xtipperpassneu . '|' . $dummb[2] . '|' . $dummb[3] . '|' . $dummb[4] . '|' . $dummb[5] . '|' . $dummb[6] . '|' . $dummb[7] . '|' . $dummb[8] . '|' . $dummb[9] . '|' . $dummb[10] . '|EOL';

        require 'lmo-tippsaveauth.php';
    } // end ($newpage==1)?>
    <table class="lmosta" width="100%" cellspacing="0" cellpadding="0" border="0">
        <tr>
            <td align="center" class="lmost1">
                <font color=black><?php echo $lmotippername;

    if ('' != $lmotipperverein) {
        echo ' - ' . $lmotipperverein;
    } ?></font>
            </td>
        </tr>
        <tr>
            <td align="center" class="lmost1"><?php echo $text[607]; ?></td>
        </tr>
        <tr>
            <td align="center" class="lmost3">
                <table class="lmostb" cellspacing="0" cellpadding="0" border="0">
                    <?php if (1 != $newpage) { ?>
                        <form name="lmotippedit" action="<?php echo $PHP_SELF; ?>" method="post">

                            <input type="hidden" name="action" value="tipp">
                            <input type="hidden" name="todo" value="pwchange">
                            <input type="hidden" name="newpage" value="1">
                            <tr>
                                <td class="lmost5" width="20">&nbsp;</td>
                                <td class="lmost5" align="right"><acronym><?php echo ' ' . $text[640]; ?></acronym></td>
                                <td class="lmost5"><acronym><input class="lmoadminein" type="password" name="xtipperpass" size="16" maxlength="32" value="<?php echo $xtipperpass; ?>"></acronym></td>
                            </tr>
                            <tr>
                                <td class="lmost5" width="20">&nbsp;</td>
                                <td class="lmost5" align="right"><acronym><?php echo ' ' . $text[639]; ?></acronym></td>
                                <td class="lmost5"><acronym><input class="lmoadminein" type="password" name="xtipperpassneu" size="16" maxlength="32" value="<?php echo $xtipperpassneu; ?>"></acronym></td>
                            </tr>
                            <tr>
                                <td class="lmost5" width="20">&nbsp;</td>
                                <td class="lmost5" align="right"><acronym><?php echo ' ' . $text[639] . ' ' . $text[519]; ?></acronym></td>
                                <td class="lmost5"><acronym><input class="lmoadminein" type="password" name="xtipperpassneuw" size="16" maxlength="32" value="<?php echo $xtipperpassneuw; ?>"></acronym></td>
                            </tr>
                            <tr>
                                <td class="lmost4" colspan="3" align="right">
                                    <acronym><input class="lmoadminbut" type="submit" name="xtippersub" value="<?php echo $text[329]; ?>"></acronym>
                                </td>
                            </tr>
                        </form>
                    <?php } ?>
                    <?php if (1 == $newpage) { // erfolgreich?>
                        <tr>
                            <td class="lmost5" align="center"><?php echo $text[621]; ?></td>
                        </tr>
                        <tr>
                            <td class="lmost4" align="right"><a href="<?php echo $PHP_SELF . '?action=tipp&amp;todo=&amp;PHPSESSID=' . $PHPSESSID ?>"><?php echo $text[5] . ' ' . $text[501]; ?></a></td>
                        </tr>
                    <?php } ?>

                </table>
            </td>
        </tr>
    </table>

<?php
}
$file = ''; ?>
