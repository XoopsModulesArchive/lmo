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
if ('' != $file) {
    require 'lmo-openfile.php';

    if (!isset($save)) {
        $save = 0;
    }

    if (1 == $save) {
        if (2 == $HTTP_SESSION_VARS['lmouserok']) {
            $titel = trim($_POST['xtitel']);

            if ('' == $titel) {
                $titel = 'No Name';
            }
        }

        $favteam = trim($_POST['xfavteam']);

        $selteam = trim($_POST['xselteam']);

        if (0 == $lmtype) {
            $stat1 = trim($_POST['xstat1']);

            $stat2 = trim($_POST['xstat2']);
        }

        if (2 == $lmouserok) {
            if (0 == $lmtype) {
                $minus = trim($_POST['xminus']);

                $spez = trim($_POST['xspez']);

                $hidr = trim($_POST['xhidr']);

                $onrun = trim($_POST['xonrun']);

                $direkt = trim($_POST['xdirekt']);

                $kegel = trim($_POST['xkegel']);

                $hands = trim($_POST['xhands']);

                $pns = trim($_POST['xpns']);

                $pnu = trim($_POST['xpnu']);

                $pnn = trim($_POST['xpnn']);

                $pxs = trim($_POST['xpxs']);

                $pxu = trim($_POST['xpxu']);

                $pxn = trim($_POST['xpxn']);

                $pps = trim($_POST['xpps']);

                $ppu = trim($_POST['xppu']);

                $ppn = trim($_POST['xppn']);

                $champ = trim($_POST['xchamp']);

                $anzcl = trim($_POST['xanzcl']);

                $anzck = trim($_POST['xanzck']);

                $anzuc = trim($_POST['xanzuc']);

                $anzar = trim($_POST['xanzar']);

                $anzab = trim($_POST['xanzab']);

                $namepkt = trim($_POST['xnamepkt']);

                if ($namepkt == $orgpkt) {
                    $namepkt = '';
                }

                $nametor = trim($_POST['xnametor']);

                if ($nametor == $orgtor) {
                    $nametor = '';
                }

                $kurve = trim($_POST['xkurve']);

                $kreuz = trim($_POST['xkreuz']);
            } else {
                $klfin = trim($_POST['xklfin']);
            }

            $dats = trim($_POST['xdats']);

            $datm = trim($_POST['xdatm']);

            $datf = trim($_POST['xdatf']);

            $datc = trim($_POST['xdatc']);

            if ((0 == $dats) && (0 == $datm)) {
                $datc = 0;
            }

            $urlt = trim($_POST['xurlt']);
        }

        $urlb = trim($_POST['xurlb']);

        require 'lmo-savefile.php';
    }

    $addr = $PHP_SELF . '?action=admin&amp;todo=edit&amp;file=' . $file . '&amp;st=';

    $addb = $PHP_SELF . '?action=admin&amp;todo=tabs&amp;file=' . $file . '&amp;st='; ?>

    <table class="lmosta" cellspacing="0" cellpadding="0" border="0">
        <tr>
            <td align="center">
                <table cellspacing="0" cellpadding="0" border="0">
                    <tr>
                        <?php
                        for ($i = 1; $i <= $anzst; $i++) {
                            echo '<td align="right" ';

                            if ($i != $st) {
                                echo "class=\"lmost0\"><a href=\"javascript:chklmolink('" . $addr . $i . "');\" title=\"" . $text[9] . '">' . $i . '</a>';
                            } else {
                                echo 'class="lmost1">' . $i;
                            }

                            echo '&nbsp;</td>';

                            if (($anzst > 49) && (0 == ($anzst % 4))) {
                                if (($i == $anzst / 4) || ($i == $anzst / 2) || ($i == $anzst / 4 * 3)) {
                                    echo '</tr><tr>';
                                }
                            } elseif (($anzst > 38) && (0 == ($anzst % 3))) {
                                if (($i == $anzst / 3) || ($i == $anzst / 3 * 2)) {
                                    echo '</tr><tr>';
                                }
                            } elseif (($anzst > 29) && (0 == ($anzst % 2))) {
                                if ($i == $anzst / 2) {
                                    echo '</tr><tr>';
                                }
                            }
                        } ?>
                    <tr>
                </table>
            </td>
        </tr>
        <tr>
            <td align="center" class="lmost3">
                <table class="lmostb" cellspacing="0" cellpadding="0" border="0">

                    <form name="lmoedit" action="<?php echo $PHP_SELF; ?>" method="post" onSubmit="return chklmopass()">

                        <input type="hidden" name="action" value="admin">
                        <input type="hidden" name="todo" value="edit">
                        <input type="hidden" name="save" value="1">
                        <input type="hidden" name="file" value="<?php echo $file; ?>">
                        <input type="hidden" name="st" value="<?php echo $st; ?>">
                        <?php if (2 == $lmouserok) { ?>
                            <tr>
                                <td class="lmost4" colspan="3">
                                    <nobr><?php echo $text[183]; ?></nobr>
                                </td>
                            </tr>
                            <tr>
                                <td class="lmost5" width="20">&nbsp;</td>
                                <td class="lmost5" align="right">
                                    <nobr><acronym title="<?php echo $text[118] ?>"><?php echo $text[113]; ?></acronym></nobr>
                                </td>
                                <td class="lmost5"><acronym title="<?php echo $text[118] ?>"><input class="lmoadminein" type="text" name="xtitel" size="40" maxlength="60" value="<?php echo $titel; ?>" onChange="dolmoedit()"></acronym></td>
                            </tr>
                        <?php } ?>
                        <tr>
                            <td class="lmost4" colspan="3">
                                <nobr><?php echo $text[264]; ?></nobr>
                            </td>
                        </tr>
                        <?php if (2 == $lmouserok) { ?>
                            <tr>
                                <td class="lmost5" width="20">&nbsp;</td>
                                <td class="lmost5" align="right">
                                    <nobr><acronym title="<?php echo $text[268] ?>"><?php echo $text[267]; ?></acronym></nobr>
                                </td>
                                <td class="lmost5"><acronym title="<?php echo $text[268] ?>">
                                        <select class="lmoadminein" name="xurlt" onChange="dolmoedit()">
                                            <?php
                                            echo '<option value="1"';
                                            if (1 == $urlt) {
                                                echo ' selected';
                                            }
                                            echo '>' . $text[181] . '</option>';
                                            echo '<option value="0"';
                                            if (0 == $urlt) {
                                                echo ' selected';
                                            }
                                            echo '>' . $text[182] . '</option>';
                                            ?>
                                        </select>
                                    </acronym></td>
                            </tr>
                        <?php } ?>
                        <tr>
                            <td class="lmost5" width="20">&nbsp;</td>
                            <td class="lmost5" align="right">
                                <nobr><acronym title="<?php echo $text[266] ?>"><?php echo $text[265]; ?></acronym></nobr>
                            </td>
                            <td class="lmost5"><acronym title="<?php echo $text[266] ?>">
                                    <select class="lmoadminein" name="xurlb" onChange="dolmoedit()">
                                        <?php
                                        echo '<option value="1"';

    if (1 == $urlb) {
        echo ' selected';
    }

    echo '>' . $text[181] . '</option>';

    echo '<option value="0"';

    if (0 == $urlb) {
        echo ' selected';
    }

    echo '>' . $text[182] . '</option>'; ?>
                                    </select>
                                </acronym></td>
                        </tr>
                        <?php if (2 == $lmouserok) { ?>
                            <tr>
                                <td class="lmost4" colspan="3">
                                    <nobr><?php echo $text[250]; ?></nobr>
                                </td>
                            </tr>
                            <?php if (1 == $lmtype) { ?>
                                <tr>
                                    <td class="lmost5" width="20">&nbsp;</td>
                                    <td class="lmost5" align="right">
                                        <nobr><acronym title="<?php echo $text[418] ?>"><?php echo $text[417]; ?></acronym></nobr>
                                    </td>
                                    <td class="lmost5"><acronym title="<?php echo $text[418] ?>">
                                            <select class="lmoadminein" name="xklfin" onChange="dolmoedit()">
                                                <?php
                                                echo '<option value="1"';
                                                if (1 == $klfin) {
                                                    echo ' selected';
                                                }
                                                echo '>' . $text[181] . '</option>';
                                                echo '<option value="0"';
                                                if (0 == $klfin) {
                                                    echo ' selected';
                                                }
                                                echo '>' . $text[182] . '</option>';
                                                ?>
                                            </select>
                                        </acronym></td>
                                </tr>
                            <?php } ?>
                            <?php if (0 == $lmtype) { ?>
                                <tr>
                                    <td class="lmost5" width="20">&nbsp;</td>
                                    <td class="lmost5" align="right">
                                        <nobr><acronym title="<?php echo $text[400] ?>"><?php echo $text[399]; ?></acronym></nobr>
                                    </td>
                                    <td class="lmost5"><acronym title="<?php echo $text[400] ?>">
                                            <select class="lmoadminein" name="xonrun" onChange="dolmoedit()">
                                                <?php
                                                echo '<option value="0"';
                                                if (0 == $onrun) {
                                                    echo ' selected';
                                                }
                                                echo '>' . $text[10] . '</option>';
                                                echo '<option value="1"';
                                                if (1 == $onrun) {
                                                    echo ' selected';
                                                }
                                                echo '>' . $text[16] . '</option>';
                                                ?>
                                            </select>
                                        </acronym></td>
                                </tr>
                            <?php } ?>
                            <tr>
                                <td class="lmost5" width="20">&nbsp;</td>
                                <td class="lmost5" align="right">
                                    <nobr><acronym title="<?php echo $text[252] ?>"><?php echo $text[251]; ?></acronym></nobr>
                                </td>
                                <td class="lmost5"><acronym title="<?php echo $text[252] ?>">
                                        <select class="lmoadminein" name="xdats" onChange="dolmoedit()">
                                            <?php
                                            echo '<option value="1"';
                                            if (1 == $dats) {
                                                echo ' selected';
                                            }
                                            echo '>' . $text[181] . '</option>';
                                            echo '<option value="0"';
                                            if (0 == $dats) {
                                                echo ' selected';
                                            }
                                            echo '>' . $text[182] . '</option>';
                                            ?>
                                        </select>
                                    </acronym></td>
                            </tr>
                            <tr>
                                <td class="lmost5" width="20">&nbsp;</td>
                                <td class="lmost5" align="right">
                                    <nobr><acronym title="<?php echo $text[254] ?>"><?php echo $text[253]; ?></acronym></nobr>
                                </td>
                                <td class="lmost5"><acronym title="<?php echo $text[254] ?>">
                                        <select class="lmoadminein" name="xdatm" onChange="dolmoedit()">
                                            <?php
                                            echo '<option value="1"';
                                            if (1 == $datm) {
                                                echo ' selected';
                                            }
                                            echo '>' . $text[181] . '</option>';
                                            echo '<option value="0"';
                                            if (0 == $datm) {
                                                echo ' selected';
                                            }
                                            echo '>' . $text[182] . '</option>';
                                            ?>
                                        </select>
                                    </acronym></td>
                            </tr>
                            <tr>
                                <td class="lmost5" width="20">&nbsp;</td>
                                <td class="lmost5" align="right">
                                    <nobr><acronym title="<?php echo $text[256] ?>"><?php echo $text[257]; ?></acronym></nobr>
                                </td>
                                <td class="lmost5"><acronym title="<?php echo $text[258] ?>">
                                        <select class="lmoadminein" name="xdatf" onChange="dolmoedit()">
                                            <?php
                                            $dummf = ['%d.%m. %H:%M', '%d.%m.%Y %H:%M', '%a.%d.%m. %H:%M', '%A, %d.%m. %H:%M', '%a.%d.%m.%Y %H:%M', '%A, %d.%m.%Y %H:%M'];
                                            for ($y = 0, $yMax = count($dummf); $y < $yMax; $y++) {
                                                echo "<option value=\"$dummf[$y]\"";

                                                if ($datf == $dummf[$y]) {
                                                    echo ' selected';
                                                }

                                                echo '>' . strftime($dummf[$y]) . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </acronym></td>
                            </tr>
                            <tr>
                                <td class="lmost5" width="20">&nbsp;</td>
                                <td class="lmost5" align="right">
                                    <nobr><acronym title="<?php echo $text[256] ?>"><?php echo $text[255]; ?></acronym></nobr>
                                </td>
                                <td class="lmost5"><acronym title="<?php echo $text[256] ?>">
                                        <select class="lmoadminein" name="xdatc" onChange="dolmoedit()">
                                            <?php
                                            echo '<option value="1"';
                                            if (1 == $datc) {
                                                echo ' selected';
                                            }
                                            echo '>' . $text[181] . '</option>';
                                            echo '<option value="0"';
                                            if (0 == $datc) {
                                                echo ' selected';
                                            }
                                            echo '>' . $text[182] . '</option>';
                                            ?>
                                        </select>
                                    </acronym></td>
                            </tr>
                            <?php if (0 == $lmtype) { ?>
                                <tr>
                                    <td class="lmost5" width="20">&nbsp;</td>
                                    <td class="lmost5" align="right">
                                        <nobr><acronym title="<?php echo $text[468] ?>"><?php echo $text[467]; ?></acronym></nobr>
                                    </td>
                                    <td class="lmost5"><acronym title="<?php echo $text[468] ?>">
                                            <select class="lmoadminein" name="xkreuz" onChange="dolmoedit()">
                                                <?php
                                                echo '<option value="1"';
                                                if (1 == $kreuz) {
                                                    echo ' selected';
                                                }
                                                echo '>' . $text[181] . '</option>';
                                                echo '<option value="0"';
                                                if (0 == $kreuz) {
                                                    echo ' selected';
                                                }
                                                echo '>' . $text[182] . '</option>';
                                                ?>
                                            </select>
                                        </acronym></td>
                                </tr>
                                <tr>
                                    <td class="lmost5" width="20">&nbsp;</td>
                                    <td class="lmost5" align="right">
                                        <nobr><acronym title="<?php echo $text[238] ?>"><?php echo $text[237]; ?></acronym></nobr>
                                    </td>
                                    <td class="lmost5"><acronym title="<?php echo $text[238] ?>">
                                            <select class="lmoadminein" name="xkurve" onChange="dolmoedit()">
                                                <?php
                                                echo '<option value="1"';
                                                if (1 == $kurve) {
                                                    echo ' selected';
                                                }
                                                echo '>' . $text[181] . '</option>';
                                                echo '<option value="0"';
                                                if (0 == $kurve) {
                                                    echo ' selected';
                                                }
                                                echo '>' . $text[182] . '</option>';
                                                ?>
                                            </select>
                                        </acronym></td>
                                </tr>
                            <?php } ?>
                        <?php } ?>
                        <tr>
                            <td class="lmost4" colspan="3">
                                <nobr><?php echo $text[193]; ?></nobr>
                            </td>
                        </tr>
                        <tr>
                            <td class="lmost5" width="20">&nbsp;</td>
                            <td class="lmost5" align="right">
                                <nobr><acronym title="<?php echo $text[190] ?>"><?php echo $text[189]; ?></acronym></nobr>
                            </td>
                            <td class="lmost5"><acronym title="<?php echo $text[190] ?>">
                                    <select class="lmoadminein" name="xfavteam" onChange="dolmoedit()">
                                        <?php
                                        for ($y = 0; $y <= $anzteams; $y++) {
                                            echo '<option value="' . $y . '"';

                                            if ($y == $favteam) {
                                                echo ' selected';
                                            }

                                            echo '>' . $teams[$y] . '</option>';
                                        } ?>
                                    </select>
                                </acronym></td>
                        </tr>
                        <tr>
                            <td class="lmost5" width="20">&nbsp;</td>
                            <td class="lmost5" align="right">
                                <nobr><acronym title="<?php echo $text[195] ?>"><?php echo $text[194]; ?></acronym></nobr>
                            </td>
                            <td class="lmost5"><acronym title="<?php echo $text[195] ?>">
                                    <select class="lmoadminein" name="xselteam" onChange="dolmoedit()">
                                        <?php
                                        for ($y = 0; $y <= $anzteams; $y++) {
                                            echo '<option value="' . $y . '"';

                                            if ($y == $selteam) {
                                                echo ' selected';
                                            }

                                            echo '>' . $teams[$y] . '</option>';
                                        } ?>
                                    </select>
                                </acronym></td>
                        </tr>
                        <?php if (0 == $lmtype) { ?>
                            <tr>
                                <td class="lmost5" width="20">&nbsp;</td>
                                <td class="lmost5" align="right">
                                    <nobr><acronym title="<?php echo $text[197] ?>"><?php echo $text[196]; ?></acronym></nobr>
                                </td>
                                <td class="lmost5">
                                    <nobr><acronym title="<?php echo $text[197] ?>">
                                            <select class="lmoadminein" name="xstat1" onChange="dolmoedit()">
                                                <?php
                                                for ($y = 0; $y <= $anzteams; $y++) {
                                                    echo '<option value="' . $y . '"';

                                                    if ($y == $stat1) {
                                                        echo ' selected';
                                                    }

                                                    echo '>' . $teams[$y] . '</option>';
                                                }
                                                ?>
                                            </select>
                                            <select class="lmoadminein" name="xstat2" onChange="dolmoedit()">
                                                <?php
                                                for ($y = 0; $y <= $anzteams; $y++) {
                                                    echo '<option value="' . $y . '"';

                                                    if ($y == $stat2) {
                                                        echo ' selected';
                                                    }

                                                    echo '>' . $teams[$y] . '</option>';
                                                }
                                                ?>
                                            </select>
                                        </acronym></nobr>
                                </td>
                            </tr>
                            <?php if (2 == $lmouserok) { ?>
                                <tr>
                                    <td class="lmost4" colspan="3">
                                        <nobr><?php echo $text[62]; ?></nobr>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="lmost5" width="20">&nbsp;</td>
                                    <td class="lmost5" align="right">
                                        <nobr><acronym title="<?php echo $text[66] ?>"><?php echo $text[65] . ' ' . $text[37]; ?></acronym></nobr>
                                    </td>
                                    <td class="lmost5"><acronym title="<?php echo $text[66] ?>"><input class="lmoadminein" type="text" name="xnamepkt" size="40" maxlength="60" value="<?php if ('' == $namepkt) {
                                                    echo $text[37];
                                                } else {
                                                    echo $namepkt;
                                                } ?>" onChange="dolmoedit()"></acronym></td>
                                </tr>
                                <tr>
                                    <td class="lmost5" width="20">&nbsp;</td>
                                    <td class="lmost5" align="right">
                                        <nobr><acronym title="<?php echo $text[66] ?>"><?php echo $text[65] . ' ' . $text[38]; ?></acronym></nobr>
                                    </td>
                                    <td class="lmost5"><acronym title="<?php echo $text[66] ?>"><input class="lmoadminein" type="text" name="xnametor" size="40" maxlength="60" value="<?php if ('' == $nametor) {
                                                    echo $text[38];
                                                } else {
                                                    echo $nametor;
                                                } ?>" onChange="dolmoedit()"></acronym></td>
                                </tr>
                                <tr>
                                    <td class="lmost4" colspan="3">
                                        <nobr><?php echo $text[178]; ?></nobr>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="lmost5" width="20">&nbsp;</td>
                                    <td class="lmost5" align="right">
                                        <nobr><acronym title="<?php echo $text[180] ?>"><?php echo $text[179]; ?></acronym></nobr>
                                    </td>
                                    <td class="lmost5"><acronym title="<?php echo $text[180] ?>">
                                            <select class="lmoadminein" name="xminus" onChange="dolmoedit()">
                                                <?php
                                                echo '<option value="2"';
                                                if (2 == $minus) {
                                                    echo ' selected';
                                                }
                                                echo '>' . $text[181] . '</option>';
                                                echo '<option value="1"';
                                                if (1 == $minus) {
                                                    echo ' selected';
                                                }
                                                echo '>' . $text[182] . '</option>';
                                                ?>
                                            </select>
                                        </acronym></td>
                                </tr>
                                <tr>
                                    <td class="lmost5" width="20">&nbsp;</td>
                                    <td class="lmost5" align="right">
                                        <nobr><acronym title="<?php echo $text[185] ?>"><?php echo $text[184]; ?></acronym></nobr>
                                    </td>
                                    <td class="lmost5"><acronym title="<?php echo $text[185] ?>">
                                            <select class="lmoadminein" name="xspez" onChange="dolmoedit()">
                                                <?php
                                                echo '<option value="1"';
                                                if (1 == $spez) {
                                                    echo ' selected';
                                                }
                                                echo '>' . $text[181] . '</option>';
                                                echo '<option value="0"';
                                                if (0 == $spez) {
                                                    echo ' selected';
                                                }
                                                echo '>' . $text[182] . '</option>';
                                                ?>
                                            </select>
                                        </acronym></td>
                                </tr>
                                <tr>
                                    <td class="lmost5" width="20">&nbsp;</td>
                                    <td class="lmost5" align="right">
                                        <nobr><acronym title="<?php echo $text[242] ?>"><?php echo $text[241]; ?></acronym></nobr>
                                    </td>
                                    <td class="lmost5"><acronym title="<?php echo $text[242] ?>">
                                            <select class="lmoadminein" name="xhidr" onChange="dolmoedit()">
                                                <?php
                                                echo '<option value="1"';
                                                if (1 == $hidr) {
                                                    echo ' selected';
                                                }
                                                echo '>' . $text[181] . '</option>';
                                                echo '<option value="0"';
                                                if (0 == $hidr) {
                                                    echo ' selected';
                                                }
                                                echo '>' . $text[182] . '</option>';
                                                ?>
                                            </select>
                                        </acronym></td>
                                </tr>
                                <tr>
                                    <td class="lmost5" width="20">&nbsp;</td>
                                    <td class="lmost5" align="right">
                                        <nobr><acronym title="<?php echo $text[187] ?>"><?php echo $text[186]; ?></acronym></nobr>
                                    </td>
                                    <td class="lmost5"><acronym title="<?php echo $text[187] ?>">
                                            <select class="lmoadminein" name="xdirekt" onChange="dolmoedit()">
                                                <?php
                                                echo '<option value="1"';
                                                if (1 == $direkt) {
                                                    echo ' selected';
                                                }
                                                echo '>' . $text[181] . '</option>';
                                                echo '<option value="0"';
                                                if (0 == $direkt) {
                                                    echo ' selected';
                                                }
                                                echo '>' . $text[182] . '</option>';
                                                ?>
                                            </select>
                                        </acronym></td>
                                </tr>
                                <tr>
                                    <td class="lmost5" width="20">&nbsp;</td>
                                    <td class="lmost5" align="right">
                                        <nobr><acronym title="<?php echo $text[396] ?>"><?php echo $text[395]; ?></acronym></nobr>
                                    </td>
                                    <td class="lmost5"><acronym title="<?php echo $text[396] ?>">
                                            <select class="lmoadminein" name="xkegel" onChange="dolmoedit()">
                                                <?php
                                                echo '<option value="1"';
                                                if (1 == $kegel) {
                                                    echo ' selected';
                                                }
                                                echo '>' . $text[181] . '</option>';
                                                echo '<option value="0"';
                                                if (0 == $kegel) {
                                                    echo ' selected';
                                                }
                                                echo '>' . $text[182] . '</option>';
                                                ?>
                                            </select>
                                        </acronym></td>
                                </tr>
                                <tr>
                                    <td class="lmost5" width="20">&nbsp;</td>
                                    <td class="lmost5" align="right">
                                        <nobr><acronym title="<?php echo $text[408] ?>"><?php echo $text[407]; ?></acronym></nobr>
                                    </td>
                                    <td class="lmost5"><acronym title="<?php echo $text[408] ?>">
                                            <select class="lmoadminein" name="xhands" onChange="dolmoedit()">
                                                <?php
                                                echo '<option value="1"';
                                                if (1 == $hands) {
                                                    echo ' selected';
                                                }
                                                echo '>' . $text[181] . '</option>';
                                                echo '<option value="0"';
                                                if (0 == $hands) {
                                                    echo ' selected';
                                                }
                                                echo '>' . $text[182] . '</option>';
                                                ?>
                                            </select>
                                        </acronym></td>
                                </tr>
                                <tr>
                                    <td class="lmost4" colspan="3">
                                        <nobr><?php echo $text[378]; ?></nobr>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="lmost5" width="20">&nbsp;</td>
                                    <td class="lmost5" align="right">
                                        <nobr><acronym title="<?php echo $text[380] ?>"><?php echo $text[379]; ?></acronym></nobr>
                                    </td>
                                    <td class="lmost5"><acronym title="<?php echo $text[380] ?>">
                                            <select class="lmoadminein" name="xchamp" onChange="dolmoedit()">
                                                <?php
                                                echo '<option value="1"';
                                                if (1 == $champ) {
                                                    echo ' selected';
                                                }
                                                echo '>' . $text[181] . '</option>';
                                                echo '<option value="0"';
                                                if (0 == $champ) {
                                                    echo ' selected';
                                                }
                                                echo '>' . $text[182] . '</option>';
                                                ?>
                                            </select>
                                        </acronym></td>
                                </tr>
                                <tr>
                                    <td class="lmost5" width="20">&nbsp;</td>
                                    <td class="lmost5" align="right">
                                        <nobr><acronym title="<?php echo $text[382] ?>"><?php echo $text[381]; ?></acronym></nobr>
                                    </td>
                                    <td class="lmost5"><acronym title="<?php echo $text[382] ?>">
                                            <select class="lmoadminein" name="xanzcl" onChange="dolmoedit()">
                                                <?php
                                                for ($i = 0; $i < 5; $i++) {
                                                    echo '<option value="' . $i . '"';

                                                    if ($anzcl == $i) {
                                                        echo ' selected';
                                                    }

                                                    echo '>' . $i . '</option>';
                                                }
                                                ?>
                                            </select>
                                        </acronym></td>
                                </tr>
                                <tr>
                                    <td class="lmost5" width="20">&nbsp;</td>
                                    <td class="lmost5" align="right">
                                        <nobr><acronym title="<?php echo $text[384] ?>"><?php echo $text[383]; ?></acronym></nobr>
                                    </td>
                                    <td class="lmost5"><acronym title="<?php echo $text[384] ?>">
                                            <select class="lmoadminein" name="xanzck" onChange="dolmoedit()">
                                                <?php
                                                for ($i = 0; $i < 5; $i++) {
                                                    echo '<option value="' . $i . '"';

                                                    if ($anzck == $i) {
                                                        echo ' selected';
                                                    }

                                                    echo '>' . $i . '</option>';
                                                }
                                                ?>
                                            </select>
                                        </acronym></td>
                                </tr>
                                <tr>
                                    <td class="lmost5" width="20">&nbsp;</td>
                                    <td class="lmost5" align="right">
                                        <nobr><acronym title="<?php echo $text[386] ?>"><?php echo $text[385]; ?></acronym></nobr>
                                    </td>
                                    <td class="lmost5"><acronym title="<?php echo $text[386] ?>">
                                            <select class="lmoadminein" name="xanzuc" onChange="dolmoedit()">
                                                <?php
                                                for ($i = 0; $i <= $anzteams; $i++) {
                                                    echo '<option value="' . $i . '"';

                                                    if ($anzuc == $i) {
                                                        echo ' selected';
                                                    }

                                                    echo '>' . $i . '</option>';
                                                }
                                                ?>
                                            </select>
                                        </acronym></td>
                                </tr>
                                <tr>
                                    <td class="lmost5" width="20">&nbsp;</td>
                                    <td class="lmost5" align="right">
                                        <nobr><acronym title="<?php echo $text[394] ?>"><?php echo $text[393]; ?></acronym></nobr>
                                    </td>
                                    <td class="lmost5"><acronym title="<?php echo $text[394] ?>">
                                            <select class="lmoadminein" name="xanzar" onChange="dolmoedit()">
                                                <?php
                                                for ($i = 0; $i <= $anzteams; $i++) {
                                                    echo '<option value="' . $i . '"';

                                                    if ($anzar == $i) {
                                                        echo ' selected';
                                                    }

                                                    echo '>' . $i . '</option>';
                                                }
                                                ?>
                                            </select>
                                        </acronym></td>
                                </tr>
                                <tr>
                                    <td class="lmost5" width="20">&nbsp;</td>
                                    <td class="lmost5" align="right">
                                        <nobr><acronym title="<?php echo $text[388] ?>"><?php echo $text[387]; ?></acronym></nobr>
                                    </td>
                                    <td class="lmost5"><acronym title="<?php echo $text[388] ?>">
                                            <select class="lmoadminein" name="xanzab" onChange="dolmoedit()">
                                                <?php
                                                for ($i = 0; $i <= $anzteams; $i++) {
                                                    echo '<option value="' . $i . '"';

                                                    if ($anzab == $i) {
                                                        echo ' selected';
                                                    }

                                                    echo '>' . $i . '</option>';
                                                }
                                                ?>
                                            </select>
                                        </acronym></td>
                                </tr>
                                <tr>
                                    <td class="lmost4" colspan="3">
                                        <nobr><?php echo $text[198]; ?></nobr>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="lmost5" width="20">&nbsp;</td>
                                    <td class="lmost5" colspan="2"><acronym title="<?php echo $text[205] ?>">
                                            <table cellspacing="0" cellpadding="0" border="0">
                                                <tr>
                                                    <td class="lmost5">&nbsp;</td>
                                                    <td class="lmost5" align="center">
                                                        <nobr><?php echo $text[199]; ?></nobr>
                                                    </td>
                                                    <td class="lmost5" align="center">
                                                        <nobr><?php echo $text[200]; ?></nobr>
                                                    </td>
                                                    <td class="lmost5" align="center">
                                                        <nobr><?php echo $text[201]; ?></nobr>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="lmost5" align="right">
                                                        <nobr><?php echo $text[202]; ?></nobr>
                                                    </td>
                                                    <td class="lmost5" align="center"><select class="lmoadminein" name="xpns" onChange="dolmoedit()"><?php for ($y = 3; $y >= 0; $y--) {
                                                    echo '<option';

                                                    if ($y == $pns) {
                                                        echo ' selected';
                                                    }

                                                    echo '>' . $y . '</option>';
                                                } ?></select></td>
                                                    <td class="lmost5" align="center"><select class="lmoadminein" name="xpnu" onChange="dolmoedit()"><?php for ($y = 3; $y >= 0; $y--) {
                                                    echo '<option';

                                                    if ($y == $pnu) {
                                                        echo ' selected';
                                                    }

                                                    echo '>' . $y . '</option>';
                                                } ?></select></td>
                                                    <td class="lmost5" align="center"><select class="lmoadminein" name="xpnn" onChange="dolmoedit()"><?php for ($y = 3; $y >= 0; $y--) {
                                                    echo '<option';

                                                    if ($y == $pnn) {
                                                        echo ' selected';
                                                    }

                                                    echo '>' . $y . '</option>';
                                                } ?></select></td>
                                                </tr>
                                                <tr>
                                                    <td class="lmost5" align="right">
                                                        <nobr><?php echo $text[203]; ?></nobr>
                                                    </td>
                                                    <td class="lmost5" align="center"><select class="lmoadminein" name="xpxs" onChange="dolmoedit()"><?php for ($y = 3; $y >= 0; $y--) {
                                                    echo '<option';

                                                    if ($y == $pxs) {
                                                        echo ' selected';
                                                    }

                                                    echo '>' . $y . '</option>';
                                                } ?></select></td>
                                                    <td class="lmost5" align="center"><select class="lmoadminein" name="xpxu" onChange="dolmoedit()"><?php for ($y = 3; $y >= 0; $y--) {
                                                    echo '<option';

                                                    if ($y == $pxu) {
                                                        echo ' selected';
                                                    }

                                                    echo '>' . $y . '</option>';
                                                } ?></select></td>
                                                    <td class="lmost5" align="center"><select class="lmoadminein" name="xpxn" onChange="dolmoedit()"><?php for ($y = 3; $y >= 0; $y--) {
                                                    echo '<option';

                                                    if ($y == $pxn) {
                                                        echo ' selected';
                                                    }

                                                    echo '>' . $y . '</option>';
                                                } ?></select></td>
                                                </tr>
                                                <tr>
                                                    <td class="lmost5" align="right">
                                                        <nobr><?php echo $text[204]; ?></nobr>
                                                    </td>
                                                    <td class="lmost5" align="center"><select class="lmoadminein" name="xpps" onChange="dolmoedit()"><?php for ($y = 3; $y >= 0; $y--) {
                                                    echo '<option';

                                                    if ($y == $pps) {
                                                        echo ' selected';
                                                    }

                                                    echo '>' . $y . '</option>';
                                                } ?></select></td>
                                                    <td class="lmost5" align="center"><select class="lmoadminein" name="xppu" onChange="dolmoedit()"><?php for ($y = 3; $y >= 0; $y--) {
                                                    echo '<option';

                                                    if ($y == $ppu) {
                                                        echo ' selected';
                                                    }

                                                    echo '>' . $y . '</option>';
                                                } ?></select></td>
                                                    <td class="lmost5" align="center"><select class="lmoadminein" name="xppn" onChange="dolmoedit()"><?php for ($y = 3; $y >= 0; $y--) {
                                                    echo '<option';

                                                    if ($y == $ppn) {
                                                        echo ' selected';
                                                    }

                                                    echo '>' . $y . '</option>';
                                                } ?></select></td>
                                                </tr>
                                            </table>
                                        </acronym></td>
                                </tr>
                            <?php }
                        } ?>
                        <tr>
                            <td class="lmost4" colspan="2">
                                <?php if ((2 == $lmouserok) && (0 == $lmtype)) {
                            echo "<a href=\"javascript:chklmolink('" . $addr . "-3');\" title=\"" . $text[339] . '">' . $text[338] . '</a>';
                        } else {
                            echo '&nbsp;';
                        } ?>
                            </td>
                            <td class="lmost4" align="right">
                                <acronym title="<?php echo $text[114] ?>"><input class="lmoadminbut" type="submit" name="best" value="<?php echo $text[188]; ?>"></acronym>
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
                        if (-1 != $st) {
                            echo "<td class=\"lmost2\" align=\"center\"><a href=\"javascript:chklmolink('" . $addr . "-1');\" title=\"" . $text[100] . '">' . $text[99] . '</a></td>';
                        } else {
                            echo '<td class="lmost1" align="center">' . $text[99] . '</td>';
                        }

    if (1 == $hands) {
        if ('tabs' != $todo) {
            echo "<td class=\"lmost2\" align=\"center\"><a href=\"javascript:chklmolink('" . $addb . $stx . "');\" title=\"" . $text[409] . '">' . $text[410] . '</a></td>';
        } else {
            echo '<td class="lmost1" align="center">' . $text[410] . '</td>';
        }
    }

    if (2 == $lmouserok) {
        if (-2 != $st) {
            echo "<td class=\"lmost2\" align=\"center\"><a href=\"javascript:chklmolink('" . $addr . "-2');\" title=\"" . $text[102] . '">' . $text[101] . '</a></td>';
        } else {
            echo '<td class="lmost1" align="center">' . $text[101] . '</td>';
        }
    } ?>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

<?php
} ?>
