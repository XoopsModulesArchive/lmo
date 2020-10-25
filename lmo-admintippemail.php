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
if (!isset($emailart)) {
    $emailart = -1;
}
if (!isset($save)) {
    $save = 0;
}
if (!isset($message)) {
    $message = '';
}
if (!isset($betreff) || '' == $betreff) {
    $betreff = $text[500];
}
if (!isset($betreff1)) {
    $betreff1 = '';
}
if (!isset($textreminder1)) {
    $textreminder1 = '';
}
if (!isset($liganr)) {
    $liganr = -1;
}

if (1 == $save) {
    if (1 == $emailart) {
        if (0 == $liganr) {
            $st = 0;

            $liga = 'viewer';
        } else {
            $st = $st1[$liganr - 1];

            $liga = $liga1[$liganr - 1];
        }
    }

    require 'lmo-tippemail.php';
}

$adda = $PHP_SELF . '?action=admin&amp;todo=tipp';
$addu = $PHP_SELF . '?action=admin&amp;todo=tippuser';
$addo = $PHP_SELF . '?action=admin&amp;todo=tippoptions';
?>
<script language="JavaScript">
    <!--
    -
        function changetextarea(x) {
            if (x == 0) {
                document.getElementById("message").value = "Hallo Tipper,";
                document.getElementById("betreff").value = "Tippspiel-Newsletter";
            }
            if (x == 1) {
                document.getElementById("message").value = document.getElementsByName("textreminder1")[0].value;
                document.getElementById("betreff").value = "Tip-Reminder";
            }
            if (x == 2) {
                document.getElementById("message").value = "Hallo";
                document.getElementById("betreff").value = "Tippspiel";
            }
        }
    // --->
</script>

<table class="lmosta" cellspacing="0" cellpadding="0" border="0">
    <tr>
        <td class="lmost1" align="center"><?php echo $text[665] ?></td>
    </tr>
    <tr>
        <td align="center" class="lmost3">
            <table class="lmostb" cellspacing="0" cellpadding="0" border="0">
                <form name="lmoedit" action="<?php echo $PHP_SELF; ?>" method="post">
                    <input type="hidden" name="action" value="admin">
                    <input type="hidden" name="todo" value="tippemail">
                    <input type="hidden" name="save" value="1">
                    <input type="hidden" name="textreminder1" value="<?php if ('' == $textreminder1) {
    $textreminder1 = $text[674];
}
                    echo $textreminder1; ?>">
                    <tr>
                        <td class="lmost5" width="20">&nbsp;</td>
                        <td class="lmost5" colspan="3"><acronym><input type="radio" name="emailart" value="0" id="0" <?php if (0 == $emailart) {
                        echo 'checked';
                    } ?> onClick="changetextarea(0)"><label for="0"><?php echo $text[666]; ?></label></acronym></td>
                    </tr>
                    <tr>
                        <td class="lmost5" width="20">&nbsp;</td>
                        <td class="lmost5"><acronym><input type="radio" name="emailart" value="2" id="2" <?php if (2 == $emailart) {
                        echo 'checked';
                    } ?> onClick="changetextarea(2)"><label for="2"><?php echo $text[668]; ?></label></acronym></td>
                        <td class="lmost5" colspan="2">
                            <select name="adressat" onChange="emailart[1].checked=true;changetextarea(2);">
                                <?php
                                echo '<option value="" ';
                                echo '>' . $text[551] . '</option>';
                                require 'lmo-tippselectemail.php';
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="lmost5" width="20">&nbsp;</td>
                        <td class="lmost5" valign="top"><acronym><input type="radio" name="emailart" value="1" id="1" <?php if (1 == $emailart) {
                                    echo 'checked';
                                } ?> onClick="changetextarea(1)"><label for="1"><?php echo $text[667]; ?></label></acronym></td>
                        <td class="lmost5" colspan="2">
                            <table cellspacing="0" cellpadding="0" border="0">
                                <?php
                                $ftype = '.l98';
                                $iptype = 'reminder';
                                require 'lmo-tippnewdir.php';
                                if ($i > 0) {
                                    ?>
                                    <tr>
                                        <td class="lmost5" colspan="2">
                                            <input type="radio" name="liganr" value="0" id="-1" <?php if (0 == $liganr) {
                                        echo 'checked';
                                    } ?> onClick="if(emailart[2].checked==false)changetextarea(1);emailart[2].checked=true;">
                                            <label for="-1"><?php echo '<b>' . $text[763] . '</b>'; ?></label></td>
                                    </tr>
                                <?php
                                } ?>
                            </table>
                            <br><?php echo $text[670];
                            if (!isset($tage)) {
                                $tage = 4;
                            } ?>
                            <input class="lmoadminein" type="text" name="tage" size="2" maxlength="2" value="<?php echo $tage; ?>" onFocus="emailart[2].checked=true;changetextarea(1);"><?php echo ' ' . $text[671]; ?>
                            <br>
                            <?php echo $text[664]; //Tipper
                            $start1 = 1;
                            if (1 == $save) {
                                if (isset($start)) {
                                    $start1 = $start;
                                }
                            }
                            ?>
                            <input class="lmoadminein" type="text" name="start" size="2" maxlength="4" value="<?php echo $start1; ?>">
                            <?php echo $text[4]; //bis
                            $ende1 = count($dumma);
                            if (1 == $save) {
                                if (isset($ende)) {
                                    $ende1 = $ende;
                                }
                            }
                            ?>
                            <input class="lmoadminein" type="text" name="ende" size="2" maxlength="4" value="<?php echo $ende1; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td class="lmost5" colspan="4">
                            <hr>
                        </td>
                    </tr>
                    <tr>
                        <td class="lmost5" width="20">&nbsp;</td>
                        <td class="lmost5" colspan="3">
                            <?php
                            echo $text[764] . '<br>' . $text[765];
                            if (1 == $save) {
                                if (isset($betreff)) {
                                    $betreff1 = $betreff;
                                }
                            }
                            ?>
                            <input class="lmoadminein" type="text" name="betreff" id="betreff" size="20" maxlength="40" value="<?php echo $betreff1; ?>">
                            <br>
                            <textarea id="message" name="message" rows="10" cols="60"><?php if (1 == $emailart) {
                                echo $textreminder1;
                            } elseif ('' != $message) {
                                echo $message;
                            } else {
                                echo 'Hallo Tipper,';
                            } ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td class="lmost5" colspan="4" align="right"><input class="lmoadminbut" type="submit" name="best" value="<?php echo $text[669]; ?>">
                        </td>
                    </tr>
                </form>
                <tr>
                    <td class="lmost4" width="20">&nbsp;</td>
                    <td class="lmost4" colspan="1" valign="top" align="right"><?php echo $text[678]; ?></td>
                    <td class="lmost4" colspan="2"><?php echo $text[679]; ?></td>
                    </td>
                </tr>
            </table>
        </td>
    <tr>
        <td>
            <table width="100%" cellspacing="0" cellpadding="0" border="0">
                <tr>
                    <?php
                    echo "<td class=\"lmost2\" align=\"center\"><a href=\"javascript:chklmolink('" . $adda . "');\" title=\"" . $text[563] . '">' . $text[563] . '</a></td>';
                    echo '<td class="lmost1" align="center">' . $text[665] . '</td>';
                    if (2 == $lmouserok) {
                        echo "<td class=\"lmost2\" align=\"center\"><a href=\"javascript:chklmolink('" . $addu . "');\" title=\"" . $text[614] . '">' . $text[614] . '</a></td>';

                        echo "<td class=\"lmost2\" align=\"center\"><a href=\"javascript:chklmolink('" . $addo . "');\" title=\"" . $text[555] . '">' . $text[86] . '</a></td>';
                    }
                    ?>
                </tr>
            </table>
        </td>
    </tr>
</table>
