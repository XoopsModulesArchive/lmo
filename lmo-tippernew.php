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

if (!isset($newpage)) {
    $newpage = 0;
}
if (!isset($xtippernick)) {
    $xtippernick = '';
}
if (!isset($xtippervorname)) {
    $xtippervorname = '';
}
if (!isset($xtippernachname)) {
    $xtippernachname = '';
}
if (!isset($xtipperemail)) {
    $xtipperemail = '';
}
if (!isset($xtipperstrasse)) {
    $xtipperstrasse = '';
}
if (!isset($xtipperplz)) {
    $xtipperplz = '';
}
if (!isset($xtipperort)) {
    $xtipperort = '';
}
if (!isset($xtippervereinradio)) {
    $xtippervereinradio = 0;
}
if (!isset($xtippervereinalt)) {
    $xtippervereinalt = '';
}
if (!isset($xtippervereinneu)) {
    $xtippervereinneu = '';
}
if (!isset($xtipperpass)) {
    $xtipperpass = '';
}
if (!isset($xtipperpassw)) {
    $xtipperpassw = '';
}
if (!isset($xtipperligen)) {
    $xtipperligen = '';
}

if (1 == $newpage) {
    $users = [''];

    $userf = [''];

    $pswfile = $tippauthtxt;

    $datei = fopen($pswfile, 'rb');

    while (!feof($datei)) {
        $zeile = fgets($datei, 1000);

        $zeile = trim(rtrim($zeile));

        if ('' != $zeile) {
            if ('' != $zeile) {
                $users[] = $zeile;
            }

            $dummb1 = preg_split('[|]', $zeile);

            if (mb_strtolower($dummb1[0]) == mb_strtolower($xtippernick)) {
                $newpage = 0;   // Nick schon vorhanden

                echo '<font color=red>' . $text[524] . '</font><br>';
            }

            if (mb_strtolower($dummb1[4]) == mb_strtolower($xtipperemail)) {
                $newpage = 0;   // Email schon vorhanden

                echo '<font color=red>' . $text[701] . '</font><br>';
            }
        }
    }

    fclose($datei);
}

if (1 == $newpage) {
    $xtippernick = trim($xtippernick);

    if ('' == $xtippernick) {
        $newpage = 0;

        echo '<font color=red>' . $text[612] . '</font><br>';
    }

    if (mb_strpos($xtippernick, '-') > -1 || mb_strpos($xtippernick, '_') > -1 || mb_strpos($xtippernick, '/') > -1 || mb_strpos($xtippernick, '.') > -1 || mb_strpos($xtippernick, ',') > -1 || mb_strpos($xtippernick, '\\') > -1) {
        $newpage = 0;

        echo '<font color=red>' . $text[609] . '</font><br>';
    }

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

    if (mb_strpos($xtippernick, ' ') > -1) {
        $newpage = 0;

        echo '<font color=red>' . $text[609] . '</font><br>';
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

    $xtipperpass = trim($xtipperpass);

    if ('' == $xtipperpass) {
        $newpage = 0;

        echo '<font color=red>' . $text[569] . '</font><br>';
    } elseif (mb_strlen($xtipperpass) < 3) {
        $newpage = 0;

        echo '<font color=red>' . $text[573] . '</font><br>';
    }

    $xtipperpassw = trim($xtipperpassw);

    if ($xtipperpassw != $xtipperpass) {
        $newpage = 0;

        echo '<font color=red>' . $text[570] . '</font><br>';
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
    $userf1 = '';

    if (1 == $xtippervereinradio) {
        $lmotipperverein = $xtippervereinalt;
    } elseif (2 == $xtippervereinradio) {
        $lmotipperverein = $xtippervereinneu;
    } else {
        $lmotipperverein = '';
    }

    $zeile = $xtippernick . '|' . $xtipperpass . '|';

    if (0 == $freischaltung) {
        $zeile .= '5|';
    } else {
        $zeile .= '|';
    }

    if (-1 != $realname) {
        $zeile .= $xtippervorname . ' ' . $xtippernachname;
    }

    $zeile .= '|' . $xtipperemail . '|' . $lmotipperverein;

    if (1 == $adresse) {
        $zeile .= "|$xtipperstrasse|$xtipperplz|$xtipperort";
    } else {
        $zeile .= '|||';
    }

    $zeile .= '|1|1|EOL';

    $users[] = $zeile;

    if ('' != $xtipperligen) {
        foreach ($xtipperligen as $key => $value) {
            $tippfile = $dirtipp . $value . '_' . $xtippernick . '.tip';

            $st = -1; // keine Tipps schreiben
            require 'lmo-tippsavefile.php'; // Tipp-Datei erstellen
            $auswertdatei = fopen($dirtipp . 'auswert/' . $value . '.aus', 'ab');

            flock($auswertdatei, 2);

            fwrite($auswertdatei, "\n[" . $xtippernick . "]\n");

            fwrite($auswertdatei, 'Team=' . $lmotipperverein . "\n");

            fwrite($auswertdatei, 'Name=' . $xtippervorname . ' ' . $xtippernachname . "\n");

            flock($auswertdatei, 3);

            fclose($auswertdatei);
        }
    }

    $save = -1;

    require 'lmo-tippsaveauth.php';

    $auswertdatei = fopen($dirtipp . 'auswert/gesamt.aus', 'ab');

    flock($auswertdatei, 2);

    fwrite($auswertdatei, "\n[" . $xtippernick . "]\n");

    fwrite($auswertdatei, 'Team=' . $lmotipperverein . "\n");

    fwrite($auswertdatei, 'Name=' . $xtippervorname . ' ' . $xtippernachname . "\n");

    flock($auswertdatei, 3);

    fclose($auswertdatei);
} // end ($newpage==1)
?>
<table class="lmomaina" cellspacing="0" cellpadding="0" border="0">
    <tr>
        <td class="lmomain0" colspan="3" align="center">
            <nobr>
                <?php echo $text[500]; ?>
            </nobr>
        </td>
    </tr>

    <?php if (1 != $newpage) { ?>
    <tr>
        <td class="lmomain1" colspan="3" align="center">
            <form name="lmotippedit" action="<?php echo $PHP_SELF; ?>" method="post">

                <input type="hidden" name="action" value="tipp">
                <input type="hidden" name="todo" value="newtipper">
                <input type="hidden" name="newpage" value="<?php echo(1); ?>">
                <table class="lmosta" width="100%" cellspacing="0" cellpadding="0" border="0">
                    <tr>
                        <td align="center" class="lmost1">
                            <?php echo $text[513]; ?>
                        </td>
                    </tr>
                    <tr>
                        <td align="center" class="lmost3">
                            <table width="100%" class="lmostb" cellspacing="0" cellpadding="0" border="0">
                                <tr>
                                    <td class="lmost5" width="20">&nbsp;</td>
                                    <td class="lmost5" align="right"><acronym><?php echo ' ' . $text[523]; ?></acronym></td>
                                    <td class="lmost5"><acronym><input class="lmoadminein" type="text" name="xtippernick" size="25" maxlength="32" value="<?php echo $xtippernick; ?>"></acronym></td>
                                </tr>
                                <?php if (-1 != $realname) { ?>
                                    <tr>
                                        <td class="lmost5" width="20">&nbsp;</td>
                                        <td class="lmost5" align="right"><acronym><?php echo ' ' . $text[514]; ?></acronym></td>
                                        <td class="lmost5"><acronym><input class="lmoadminein" type="text" name="xtippervorname" size="25" maxlength="32" value="<?php echo $xtippervorname; ?>"></acronym></td>
                                    </tr>
                                    <tr>
                                        <td class="lmost5" width="20">&nbsp;</td>
                                        <td class="lmost5" align="right"><acronym><?php echo ' ' . $text[515]; ?></acronym></td>
                                        <td class="lmost5"><acronym><input class="lmoadminein" type="text" name="xtippernachname" size="25" maxlength="32" value="<?php echo $xtippernachname; ?>"></acronym></td>
                                    </tr>
                                <?php } ?>
                                <?php if (1 == $adresse) { ?>
                                    <tr>
                                        <td class="lmost5" width="20">&nbsp;</td>
                                        <td class="lmost5" align="right"><acronym><?php echo ' ' . $text[626]; ?></acronym></td>
                                        <td class="lmost5"><acronym><input class="lmoadminein" type="text" name="xtipperstrasse" size="25" maxlength="32" value="<?php echo $xtipperstrasse; ?>"></acronym></td>
                                    </tr>
                                    <tr>
                                        <td class="lmost5" width="20">&nbsp;</td>
                                        <td class="lmost5" align="right"><acronym><?php echo ' ' . $text[627]; ?></acronym></td>
                                        <td class="lmost5"><acronym><input class="lmoadminein" type="text" name="xtipperplz" size="7" maxlength="5" value="<?php echo $xtipperplz; ?>"></acronym></td>
                                    </tr>
                                    <tr>
                                        <td class="lmost5" width="20">&nbsp;</td>
                                        <td class="lmost5" align="right"><acronym><?php echo ' ' . $text[628]; ?></acronym></td>
                                        <td class="lmost5"><acronym><input class="lmoadminein" type="text" name="xtipperort" size="25" maxlength="32" value="<?php echo $xtipperort; ?>"></acronym></td>
                                    </tr>
                                <?php } ?>
                                <tr>
                                    <td class="lmost5" width="20">&nbsp;</td>
                                    <td class="lmost5" align="right"><acronym><?php echo ' ' . $text[516]; ?></acronym></td>
                                    <td class="lmost5"><acronym><input class="lmoadminein" type="text" name="xtipperemail" size="25" maxlength="64" value="<?php echo $xtipperemail; ?>"></acronym></td>
                                </tr>
                                <tr>
                                    <td class="lmost5" width="20">&nbsp;</td>
                                    <td class="lmost5" align="right"><acronym><?php echo ' ' . $text[308]; ?></acronym></td>
                                    <td class="lmost5"><acronym><input class="lmoadminein" type="password" name="xtipperpass" size="25" maxlength="32" value="<?php echo $xtipperpass; ?>"></acronym></td>
                                </tr>
                                <tr>
                                    <td class="lmost5" width="20">&nbsp;</td>
                                    <td class="lmost5" align="right"><acronym><?php echo ' ' . $text[308] . ' ' . $text[519]; ?></acronym></td>
                                    <td class="lmost5"><acronym><input class="lmoadminein" type="password" name="xtipperpassw" size="25" maxlength="32" value="<?php echo $xtipperpassw; ?>"></acronym></td>
                                </tr>
                                <?php if ($tipperimteam >= 0) { ?>
                                    <tr>
                                        <td class="lmost4" align="left" colspan="3"><?php echo $text[547]; ?></td>
                                    </tr>
                                    <tr>
                                        <td class="lmost5" width="20">&nbsp;</td>
                                        <td class="lmost5" align="left" colspan="2"><acronym><input type="radio" name="xtippervereinradio" value="0" id="0" <?php if (0 == $xtippervereinradio) {
    echo 'checked';
} ?>><label for="0"><?php echo $text[550]; ?></label></acronym></td>
                                    </tr>
                                    <tr>
                                        <td class="lmost5" width="20">&nbsp;</td>
                                        <td class="lmost5" align="left"><acronym><input type="radio" name="xtippervereinradio" value="1" id="1" <?php if (1 == $xtippervereinradio) {
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
                                        <td class="lmost5" align="left"><acronym><input type="radio" name="xtippervereinradio" value="2" id="2" <?php if (2 == $xtippervereinradio) {
                                                        echo 'checked';
                                                    } ?>><label for="2"><?php echo $text[549]; ?></label></acronym></td>
                                        <td class="lmost5"><acronym><input class="lmoadminein" type="text" name="xtippervereinneu" size="25" maxlength="32" value="<?php echo $xtippervereinneu; ?>" onFocus="xtippervereinradio[2].checked=true"></acronym></td>
                                    </tr>
                                <?php } ?>
                                <tr>
                                    <td class="lmost4" align="left" colspan="3"><?php echo $text[518]; ?></td>
                                </tr>
                                <tr>
                                    <td class="lmost5" width="20">&nbsp;</td>
                                    <td class="lmost5" colspan="2">
                                        <?php $ftype = '.l98';
                                        require 'lmo-tippnewdir.php'; ?></td>
                                </tr>
                                <tr>
                                    <td class="lmost4" align="left" colspan="2"><a href="<?php echo $PHP_SELF . '?action=tipp'; ?>" title="<?php echo $text[610]; ?>"><?php echo '&lt;&lt; ' . $text[610]; ?></a></td>
                                    <td class="lmost4"><acronym><input class="lmoadminbut" type="submit" name="xtippersub" value="<?php echo $text[511]; ?>"></acronym></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </form>
            <?php
            $HTTP_SESSION_VARS['lmotipperok'] = 0;
            }
            ?>
            <?php if (1 == $newpage) { // Anmeldung erfolgreich
                $lmotippername = $xtippernick;

                $HTTP_SESSION_VARS['lmotipperpass'] = '';

                $HTTP_SESSION_VARS['lmotipperok'] = 5; ?>
    <tr>
        <td class="lmomain1" colspan="3" align="center">

            <table class="lmosta" width="100%" cellspacing="0" cellpadding="0" border="0">
                <tr>
                    <td align="center" class="lmost1">
                        <?php echo $text[513]; ?>
                    </td>
                </tr>
                <tr>
                    <td align="center" class="lmost3">
                        <table width="100%" class="lmostb" cellspacing="0" cellpadding="0" border="0">
                            <tr>
                                <td class="lmost5" align="center">  <?php echo $text[520]; ?></td>
                                </td></tr>
                            <tr>
                                <td class="lmost4" align="right"><a href="<?php echo $PHP_SELF; ?>?action=tipp&amp;todo=logout&amp;">=> <?php echo $text[521]; ?></a></td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
            <?php
            }
            clearstatcache();
            ?>
</table>

