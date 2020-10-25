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
if (('tipp' == $action) && ('newligen' == $todo)) {
    if (1 == $newpage) {
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
            }
        }

        if (0 == $gef) {
            exit;
        }

        if ('' != $xtipperligen) {
            foreach ($xtipperligen as $key => $value) {
                $tippfile = $dirtipp . $value . '_' . $lmotippername . '.tip';

                $st = -1;

                require 'lmo-tippsavefile.php'; // Tipp-Datei erstellen

                $auswertdatei = fopen($dirtipp . 'auswert/' . $value . '.aus', 'ab');

                flock($auswertdatei, 2);

                fwrite($auswertdatei, "\n[" . $lmotippername . "]\n");

                fwrite($auswertdatei, 'Team=' . $dummb[5] . "\n");

                fwrite($auswertdatei, 'Name=' . $dummb[3] . "\n");

                flock($auswertdatei, 3);

                fclose($auswertdatei);
            }
        }
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
            <td align="center" class="lmost1"><?php echo $text[635]; ?></td>
        </tr>
        <tr>
            <td align="center" class="lmost3">
                <table class="lmostb" cellspacing="0" cellpadding="0" border="0">
                    <tr>
                        <td class="lmost5">
                            <nobr>
                                <?php if (1 != $newpage) { ?>
                                <form name="lmotippedit" action="<?php echo $PHP_SELF; ?>" method="post">

                                    <input type="hidden" name="action" value="tipp">
                                    <input type="hidden" name="todo" value="newligen">
                                    <input type="hidden" name="newpage" value="1">
                                    <?php $ftype = '.l98';
                                    require 'lmo-tippnewdir.php'; ?>
                            </nobr>
                        </td>
                    </tr>
                    <tr>
                        <td class="lmost4" colspan="3" align="right">
                            <?php if (0 != $i) { ?>
                                <acronym><input class="lmoadminbut" type="submit" name="xtippersub" value="<?php echo $text[511]; ?>"></acronym>
                            <?php } ?>
                        </td>
                    </tr>
                    </form>
                    <?php } ?>
                    <?php if (1 == $newpage) { // Anmeldung erfolgreich?>
                        <tr>
                            <td class="lmost5" align="center">  <?php echo $text[520]; ?></td>
                        </tr>
                    <?php } ?>
                    <?php if (1 == $newpage || 0 == $i) { // zurück zur Übersicht?>
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
