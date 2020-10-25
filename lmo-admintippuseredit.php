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
if ('admin' == $action && 'tippuseredit' == $todo && '' != $nick) {
    if (!isset($xtippervereinalt)) {
        $xtippervereinalt = '';
    }

    if (!isset($xtippervereinneu)) {
        $xtippervereinneu = '';
    }

    if (!isset($xtipperligen)) {
        $xtipperligen = '';
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

        if ($nick == $dummb[0]) { // Nick gefunden
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
        $dummb[0] = $nick;

        $dummb[1] = trim($xtipperpass);

        $xtippervorname = trim($xtippervorname);

        $xtippernachname = trim($xtippernachname);

        if (false !== mb_strpos($xtippernachname, ' ') || mb_strpos($xtippervorname, ' ') > -1) {
            $newpage = 0;

            echo '<font color=red>' . $text[609] . '</font><br>';
        }

        $dummb[3] = $xtippervorname . ' ' . $xtippernachname;

        $dummb[4] = trim($xtipperemail);

        $dummb[6] = trim($xtipperstrasse);

        $dummb[7] = (int)trim($xtipperplz);

        $dummb[8] = trim($xtipperort);

        if (1 == $xtippervereinradio) {
            $xtippervereinalt = trim($xtippervereinalt);

            if ('' == $xtippervereinalt) {
                $newpage = 0;

                echo '<font color=red>' . $text[571] . '</font><br>';
            } else {
                require 'lmo-tippcheckteam.php';
            }
        }

        if (2 == $xtippervereinradio) {
            $xtippervereinneu = trim($xtippervereinneu);

            if ('' == $xtippervereinneu) {
                $newpage = 0;

                echo '<font color=red>' . $text[572] . '</font><br>';
            } else {
                require 'lmo-tippcheckteam.php';
            }
        }
    }

    if (1 == $newpage) {
        if (1 == $xtippervereinradio) {
            $team = $xtippervereinalt;
        } elseif (2 == $xtippervereinradio) {
            $team = $xtippervereinneu;
        } else {
            $team = '';
        }

        if ($xtippervereinradio > 0) {
            $xtippervereinradio = 1;

            $xtippervereinalt = $team;

            $xtippervereinneu = '';
        }

        if (isset($xfrei) && 1 == $xfrei) {
            $dummb[2] = '5';
        } else {
            $dummb[2] = '';
        }

        $users[$save] = $dummb[0] . '|' . $dummb[1] . '|' . $dummb[2] . '|' . $dummb[3] . '|' . $dummb[4] . '|';

        $users[$save] .= $team . '|' . $dummb[6] . '|' . $dummb[7] . '|' . $dummb[8] . '|';

        if (isset($xnews) && 1 == $xnews) {
            $dummb[9] = '1';
        } else {
            $dummb[9] = '-1';
        }

        if (isset($xremind) && 1 == $xremind) {
            $dummb[10] = '1';
        } else {
            $dummb[10] = '-1';
        }

        $users[$save] .= '|' . $dummb[9] . '|' . $dummb[10] . '|EOL';

        require 'lmo-tippsaveauth.php';

        $verz = opendir($dirtipp);

        while ($files = readdir($verz)) {
            if (mb_substr($files, mb_strrpos($files, '_') + 1, -4) == $nick && '.tip' == mb_strtolower(mb_substr($files, -4))) {
                $delete = 1;

                if ('' != $xtipperligen) {
                    foreach ($xtipperligen as $key => $value) {
                        $tippfile = $value . '_' . $nick . '.tip';

                        if ($tippfile == $files) {
                            $delete = 0;
                        }
                    }
                }

                if (1 == $delete) {
                    @unlink($dirtipp . $files);
                } // Abonnement beenden
            }
        }

        closedir($verz);

        if ('' != $xtipperligen) {
            foreach ($xtipperligen as $key => $value) {
                $verz = opendir($dirtipp);

                while ($files = readdir($verz)) {
                    $create = 1;

                    if (mb_substr($files, mb_strrpos($files, '_') + 1, -4) == $nick && mb_substr($files, 0, mb_strrpos($files, '_')) == $value && '.tip' == mb_strtolower(mb_substr($files, -4))) {
                        $create = 0; // bereits abonniert

                        break;
                    }
                }

                closedir($verz);

                if (1 == $create) {
                    $tippfile = $dirtipp . $value . '_' . $nick . '.tip';

                    $st = -1;

                    require 'lmo-tippsavefile.php'; // Tipp-Datei erstellen

                    $auswertdatei = fopen($dirtipp . 'auswert/' . $value . '.aus', 'ab');

                    flock($auswertdatei, 2);

                    fwrite($auswertdatei, "\n[" . $nick . "]\n");

                    fwrite($auswertdatei, 'Team=' . $dummb[5] . "\n");

                    fwrite($auswertdatei, 'Name=' . $dummb[3] . "\n");

                    flock($auswertdatei, 3);

                    fclose($auswertdatei);
                }
            }
        }
    } // end ($newpage==1)?>
    <table class="lmosta" width="100%" cellspacing="0" cellpadding="0" border="0">
        <tr>
            <td align="center" class="lmost1"><?php echo $text[606]; ?></td>
        </tr>
        <tr>
            <td align="center" class="lmost3">
                <table class="lmostb" cellspacing="0" cellpadding="0" border="0">
                    <form name="lmotippedit" action="<?php echo $PHP_SELF; ?>" method="post">

                        <input type="hidden" name="action" value="admin">
                        <input type="hidden" name="todo" value="tippuseredit">
                        <input type="hidden" name="nick" value="<?php echo $nick; ?>">
                        <input type="hidden" name="newpage" value="1">
                        <tr>
                            <td class="lmost5" width="20">&nbsp;</td>
                            <td class="lmost5" align="right"><?php echo ' ' . $text[523]; ?></td>
                            <td class="lmost5"><?php echo '<b>' . $dummb[0] . '</b>'; ?></td>
                        </tr>
                        <tr>
                            <td class="lmost5" width="20">&nbsp;</td>
                            <td class="lmost5" align="right"><?php echo ' ' . $text[323]; ?></td>
                            <td class="lmost5"><input class="lmoadminein" type="text" name="xtipperpass" size="25" maxlength="100" value="<?php echo $dummb[1]; ?>"></td>
                        </tr>
                        <tr>
                            <td class="lmost5" width="20">&nbsp;</td>
                            <td class="lmost5" align="right"><?php echo ' ' . $text[514]; ?></td>
                            <td class="lmost5"><input class="lmoadminein" type="text" name="xtippervorname" size="25" maxlength="32" value="<?php echo mb_substr($dummb[3], 0, mb_strpos($dummb[3], ' ')); ?>"></td>
                        </tr>
                        <tr>
                            <td class="lmost5" width="20">&nbsp;</td>
                            <td class="lmost5" align="right"><?php echo ' ' . $text[515]; ?></td>
                            <td class="lmost5"><input class="lmoadminein" type="text" name="xtippernachname" size="25" maxlength="32" value="<?php echo mb_substr($dummb[3], mb_strpos($dummb[3], ' ') + 1); ?>"></td>
                        </tr>
                        <tr>
                            <td class="lmost5" width="20">&nbsp;</td>
                            <td class="lmost5" align="right"><?php echo ' ' . $text[626]; ?></td>
                            <td class="lmost5"><input class="lmoadminein" type="text" name="xtipperstrasse" size="25" maxlength="32" value="<?php echo $dummb[6]; ?>"></td>
                        </tr>
                        <tr>
                            <td class="lmost5" width="20">&nbsp;</td>
                            <td class="lmost5" align="right"><?php echo ' ' . $text[627]; ?></td>
                            <td class="lmost5"><input class="lmoadminein" type="text" name="xtipperplz" size="7" maxlength="5" value="<?php echo $dummb[7]; ?>"></td>
                        </tr>
                        <tr>
                            <td class="lmost5" width="20">&nbsp;</td>
                            <td class="lmost5" align="right"><?php echo ' ' . $text[628]; ?></td>
                            <td class="lmost5"><input class="lmoadminein" type="text" name="xtipperort" size="25" maxlength="32" value="<?php echo $dummb[8]; ?>"></td>
                        </tr>
                        <tr>
                            <td class="lmost5" width="20">&nbsp;</td>
                            <td class="lmost5" align="right"><?php echo ' ' . $text[516]; ?></td>
                            <td class="lmost5"><input class="lmoadminein" type="text" name="xtipperemail" size="25" maxlength="64" value="<?php echo $dummb[4]; ?>"></td>
                        </tr>
                        <tr>
                            <td class="lmost5" colspan="2">&nbsp;</td>
                            <td class="lmost5"><input type="checkbox" name="xfrei" value="1" <?php if (5 == $dummb[2]) {
        echo 'checked';
    } ?>><?php echo $text[647] ?></td>
                        </tr>
                        <tr>
                            <td class="lmost4" align="left" colspan="3"><?php echo $text[665]; ?></td>
                        </tr>
                        <tr>
                            <td class="lmost5" width="20">&nbsp;</td>
                            <td class="lmost5">&nbsp;</td>
                            <td class="lmost5">
                                <input type="checkbox" name="xnews" value="1" <?php if (-1 != $dummb[9]) {
        echo 'checked';
    } ?>><?php echo $text[706] ?><br>
                                <input type="checkbox" name="xremind" value="1" <?php if (-1 != $dummb[10]) {
        echo 'checked';
    } ?>><?php echo $text[667] ?>
                            </td>
                        </tr>
                        <?php if ($tipperimteam >= 0) { ?>
                            <tr>
                                <td class="lmost4" align="left" colspan="3"><?php echo $text[527]; ?></td>
                            </tr>
                            <tr>
                                <td class="lmost5" width="20">&nbsp;</td>
                                <td class="lmost5" colspan="2"><input type="radio" name="xtippervereinradio" value="0" id="0" <?php if (0 == $xtippervereinradio) {
        echo 'checked';
    } ?>><label for="0"><?php echo $text[550]; ?></label></td>
                            </tr>
                            <tr>
                                <td class="lmost5" width="20">&nbsp;</td>
                                <td class="lmost5"><input type="radio" name="xtippervereinradio" value="1" id="1" <?php if (1 == $xtippervereinradio) {
        echo 'checked';
    } ?>><label for="1"><?php echo $text[548]; ?></label></td>
                                <td class="lmost5"><select name="xtippervereinalt" onChange="xtippervereinradio[1].checked=true">
                                        <?php
                                        echo '<option value="" ';
                                        if ('' == $xtippervereinalt) {
                                            echo 'selected';
                                        }
                                        echo '>' . $text[551] . '</option>';
                                        require 'lmo-tippnewteams.php';
                                        ?>
                                    </select></td>
                            </tr>
                            <tr>
                                <td class="lmost5" width="20">&nbsp;</td>
                                <td class="lmost5"><input type="radio" name="xtippervereinradio" value="2" id="2" <?php if (2 == $xtippervereinradio) {
                                            echo 'checked';
                                        } ?>><label for="2"><?php echo $text[549]; ?></label></td>
                                <td class="lmost5"><input class="lmoadminein" type="text" name="xtippervereinneu" size="25" maxlength="32" value="<?php echo $xtippervereinneu; ?>" onFocus="xtippervereinradio[2].checked=true"></td>
                            </tr>
                        <?php } ?>
                        <tr>
                            <td class="lmost4" align="left" colspan="3"><?php echo $text[773]; ?></td>
                        </tr>
                        <tr>
                            <td class="lmost5" width="20">&nbsp;</td>
                            <td class="lmost5" colspan="2">
                                <?php $ftype = '.l98';

    require 'lmo-tippnewdir.php'; ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="lmost4" colspan="3" align="right">
                                <input class="lmoadminbut" type="submit" name="xtippersub" value="<?php echo $text[329]; ?>">
                            </td>
                        </tr>
                        <tr>
                            <td class="lmost5" colspan="3" align="right"><?php echo '<strong>' . $text[582] . '</strong> ' . $text[637]; ?>
                            </td>
                        </tr>
                    </form>

                </table>
            </td>
        </tr>
        <tr>
            <td>
                <table width="100%" cellspacing="0" cellpadding="0" border="0">
                    <tr>
                        <?php
                        $adda = $PHP_SELF . '?action=admin&amp;todo=tipp';

    $addo = $PHP_SELF . '?action=admin&amp;todo=tippoptions';

    $addu = $PHP_SELF . '?action=admin&amp;todo=tippuser';

    $adde = $PHP_SELF . '?action=admin&amp;todo=tippemail';

    echo "<td class=\"lmost2\" align=\"center\"><a href=\"javascript:chklmolink('" . $adda . "');\" title=\"" . $text[563] . '">' . $text[563] . '</a></td>';

    echo "<td class=\"lmost2\" align=\"center\"><a href=\"javascript:chklmolink('" . $adde . "');\" title=\"" . $text[665] . '">' . $text[665] . '</a></td>';

    echo "<td class=\"lmost2\" align=\"center\"><a href=\"javascript:chklmolink('" . $addu . "');\" title=\"" . $text[614] . '">' . $text[614] . '</a></td>';

    echo "<td class=\"lmost2\" align=\"center\"><a href=\"javascript:chklmolink('" . $addo . "');\" title=\"" . $text[555] . '">' . $text[86] . '</a></td>'; ?>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

<?php
}
$file = ''; ?>
