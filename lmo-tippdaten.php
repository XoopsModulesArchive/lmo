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
if (('tipp' == $action) && ('daten' == $todo)) {
    if (!isset($xtippervereinalt)) {
        $xtippervereinalt = '';
    }

    if (!isset($xtippervereinneu)) {
        $xtippervereinneu = '';
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
        if (-1 != $realname) {
            $xtippervorname = trim($xtippervorname);

            if ('' == $xtippervorname) {
                $newpage = 0;

                echo '<font color=red>' . $text[566] . '</font><br>';
            }

            $xtippernachname = trim($xtippernachname);

            if ('' == $xtippernachname) {
                $newpage = 0;

                echo '<font color=red>' . $text[567] . '</font><br>';
            }

            if (false !== mb_strpos($xtippernachname, ' ') || mb_strpos($xtippervorname, ' ') > -1) {
                $newpage = 0;

                echo '<font color=red>' . $text[609] . '</font><br>';
            }
        }

        if (1 == $adresse) {
            $xtipperstrasse = trim($xtipperstrasse);

            if ('' == $xtipperstrasse) {
                $newpage = 0;

                echo '<font color=red>' . $text[629] . '</font><br>';
            }

            $xtipperplz = (int)trim($xtipperplz);

            if ('' == $xtipperplz) {
                $newpage = 0;

                echo '<font color=red>' . $text[630] . '</font><br>';
            }

            $xtipperort = trim($xtipperort);

            if ('' == $xtipperort) {
                $newpage = 0;

                echo '<font color=red>' . $text[631] . '</font><br>';
            }
        }

        $xtipperemail = trim($xtipperemail);

        if ('' == $xtipperemail || mb_strpos($xtipperemail, ' ') > -1 || mb_strpos($xtipperemail, '@') < 1) {
            $newpage = 0;

            echo '<font color=red>' . $text[568] . '</font><br>';
        }

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
            $lmotipperverein = $xtippervereinalt;
        } elseif (2 == $xtippervereinradio) {
            $lmotipperverein = $xtippervereinneu;
        } else {
            $lmotipperverein = '';
        }

        $users[$save] = $dummb[0] . '|' . $dummb[1] . '|' . $dummb[2] . '|';

        if (-1 != $realname) {
            $users[$save] .= $xtippervorname . ' ' . $xtippernachname;
        }

        $users[$save] .= '|' . $xtipperemail . '|' . $lmotipperverein;

        if (1 == $adresse) {
            $users[$save] .= '|' . $xtipperstrasse . '|' . $xtipperplz . '|' . $xtipperort;
        } else {
            $users[$save] .= '|' . $dummb[6] . '|' . $dummb[7] . '|' . $dummb[8];
        }

        $users[$save] .= '|';

        if (1 == trim($_POST['xnews'])) {
            $users[$save] .= '1';
        } else {
            $users[$save] .= '-1';
        }

        $users[$save] .= '|';

        if (1 == trim($_POST['xremind'])) {
            $users[$save] .= '1';
        } else {
            $users[$save] .= '-1';
        }

        $users[$save] .= '|EOL';

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
            <td align="center" class="lmost1"><?php echo $text[606];

    if ($tipperimteam >= 0) {
        echo ' / ' . $text[502];
    } ?></td>
        </tr>
        <tr>
            <td align="center" class="lmost3">
                <table class="lmostb" cellspacing="0" cellpadding="0" border="0">
                    <?php if (1 != $newpage) { ?>
                        <form name="lmotippedit" action="<?php echo $PHP_SELF; ?>" method="post">

                            <input type="hidden" name="action" value="tipp">
                            <input type="hidden" name="todo" value="daten">
                            <input type="hidden" name="newpage" value="1">
                            <?php if (-1 != $realname) { ?>
                                <tr>
                                    <td class="lmost5" width="20">&nbsp;</td>
                                    <td class="lmost5" align="right"><acronym><?php echo ' ' . $text[514]; ?></acronym></td>
                                    <td class="lmost5"><acronym><input class="lmoadminein" type="text" name="xtippervorname" size="25" maxlength="32" value="<?php echo mb_substr($dummb[3], 0, mb_strpos($dummb[3], ' ')); ?>"></acronym></td>
                                </tr>
                                <tr>
                                    <td class="lmost5" width="20">&nbsp;</td>
                                    <td class="lmost5" align="right"><acronym><?php echo ' ' . $text[515]; ?></acronym></td>
                                    <td class="lmost5"><acronym><input class="lmoadminein" type="text" name="xtippernachname" size="25" maxlength="32" value="<?php echo mb_substr($dummb[3], mb_strpos($dummb[3], ' ') + 1); ?>"></acronym></td>
                                </tr>
                            <?php } ?>
                            <?php if (1 == $adresse) { ?>
                                <tr>
                                    <td class="lmost5" width="20">&nbsp;</td>
                                    <td class="lmost5" align="right"><acronym><?php echo ' ' . $text[626]; ?></acronym></td>
                                    <td class="lmost5"><acronym><input class="lmoadminein" type="text" name="xtipperstrasse" size="25" maxlength="32" value="<?php echo $dummb[6]; ?>"></acronym></td>
                                </tr>
                                <tr>
                                    <td class="lmost5" width="20">&nbsp;</td>
                                    <td class="lmost5" align="right"><acronym><?php echo ' ' . $text[627]; ?></acronym></td>
                                    <td class="lmost5"><acronym><input class="lmoadminein" type="text" name="xtipperplz" size="7" maxlength="5" value="<?php echo $dummb[7]; ?>"></acronym></td>
                                </tr>
                                <tr>
                                    <td class="lmost5" width="20">&nbsp;</td>
                                    <td class="lmost5" align="right"><acronym><?php echo ' ' . $text[628]; ?></acronym></td>
                                    <td class="lmost5"><acronym><input class="lmoadminein" type="text" name="xtipperort" size="25" maxlength="32" value="<?php echo $dummb[8]; ?>"></acronym></td>
                                </tr>
                            <?php } ?>
                            <tr>
                                <td class="lmost5" width="20">&nbsp;</td>
                                <td class="lmost5" align="right"><acronym><?php echo ' ' . $text[516]; ?></acronym></td>
                                <td class="lmost5"><acronym><input class="lmoadminein" type="text" name="xtipperemail" size="25" maxlength="64" value="<?php echo $dummb[4]; ?>"></acronym></td>
                            </tr>
                            <tr>
                                <td class="lmost4" align="left" colspan="3"><?php echo $text[707]; ?></td>
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
                                    <td class="lmost4" align="left" colspan="3"><?php echo $text[547]; ?></td>
                                </tr>
                                <tr>
                                    <td class="lmost5" width="20">&nbsp;</td>
                                    <td class="lmost5" colspan="2"><acronym><input type="radio" name="xtippervereinradio" value="0" id="0" <?php if (0 == $xtippervereinradio) {
        echo 'checked';
    } ?>><label for="0"><?php echo $text[550]; ?></label></acronym></td>
                                </tr>
                                <tr>
                                    <td class="lmost5" width="20">&nbsp;</td>
                                    <td class="lmost5"><acronym><input type="radio" name="xtippervereinradio" value="1" id="1" <?php if (1 == $xtippervereinradio) {
        echo 'checked';
    } ?>><label for="1"><?php echo $text[548]; ?></label></acronym></td>
                                    <td class="lmost5"><acronym><select name="xtippervereinalt" onChange="xtippervereinradio[1].checked=true">
                                                <?php
                                                echo '<option value="" ';
                                                if ('' == $xtippervereinalt) {
                                                    echo 'selected';
                                                }
                                                echo '>' . $text[551] . '</option>';
                                                require 'lmo-tippnewteams.php';
                                                ?>
                                            </select></acronym></td>
                                </tr>
                                <tr>
                                    <td class="lmost5" width="20">&nbsp;</td>
                                    <td class="lmost5"><acronym><input type="radio" name="xtippervereinradio" value="2" id="2" <?php if (2 == $xtippervereinradio) {
                                                    echo 'checked';
                                                } ?>><label for="2"><?php echo $text[549]; ?></label></acronym></td>
                                    <td class="lmost5"><acronym><input class="lmoadminein" type="text" name="xtippervereinneu" size="25" maxlength="32" value="<?php echo $xtippervereinneu; ?>" onFocus="xtippervereinradio[2].checked=true"></acronym></td>
                                </tr>
                            <?php } ?>
                            <?php if (0 != $i) { ?>
                                <tr>
                                    <td class="lmost4" colspan="3" align="right">
                                        <acronym><input class="lmoadminbut" type="submit" name="xtippersub" value="<?php echo $text[329]; ?>"></acronym>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="lmost5" colspan="3" align="right"><?php echo '<strong>' . $text[582] . '</strong> ' . $text[637]; ?>
                                    </td>
                                </tr>
                            <?php } ?>
                        </form>
                    <?php } ?>
                    <?php if (1 == $newpage) { // Anmeldung erfolgreich?>
                        <tr>
                            <td class="lmost5" align="center">  <?php echo $text[621]; ?></td>
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
