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
if ('tipp' == $action) {
    if ('' != $file) {
        $addm = $PHP_SELF . '?file=' . $file . '&amp;action=';
    }

    if (5 == $HTTP_SESSION_VARS['lmotipperok']) {
        if (('edit' == $todo && 'viewer' != $file) || 'einsicht' == $todo) {
            require 'lmo-openfilest.php';
        } elseif ('tabelle' == $todo) {
            require 'lmo-openfile.php';
        } elseif (('wert' == $todo && 1 != $all) || 'fieber' == $todo) {
            require 'lmo-openfilename.php';
        } elseif ('wert' == $todo && 1 == $all) {
        }
    }

    $me = ['0', 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

    $adda = $PHP_SELF . '?action=tipp&amp;todo=';

    $addx = 'lmo-tippstart.php?file=';

    //if(!isset($st)){$st=$stx;}else{$sty=$st;}

    if (!isset($newpage)) {
        $newpage = 0;
    }

    if (!isset($file)) {
        $file = '';
    }

    if (!isset($tippfile)) {
        $tippfile = '';
    }

    if (!isset($tipptabelle1)) {
        $tipptabelle1 = 1;
    } ?>

    <?php if (1 == $tippmodus && 'edit' == $todo) { ?>
        <script language="JavaScript">
            <!--
            -
            <?php if (1 == $pfeiltipp) { ?>
                img0 = new Image();
            img0.src = "lmo-admin0.gif";
            img1 = new Image();
            img1.src = "lmo-admin1.gif";
            img2 = new Image();
            img2.src = "lmo-admin2.gif";
            img3 = new Image();
            img3.src = "lmo-admin3.gif";

            function lmoimg(x, y) {
                document.getElementsByName("ximg" + x)[0].src = y.src;
            }
            <?php } ?>
            function lmotorclk(x, y, z) {
                if (document.all && !window.opera) {
                    if (z == 38) {
                        lmotorauf(x, y, 1);
                    }
                    if (z == 40) {
                        lmotorauf(x, y, -1);
                    }
                }
            }

            function lmotorauf(x, y, z) {
                if (x == "a") {
                    xx = "b";
                }
                if (x == "b") {
                    xx = "a";
                }
                var a = document.getElementsByName("xtipp" + x + y)[0].value;
                if (a == "") {
                    a = "-1";
                }
                if (a == "_") {
                    a = "-1";
                }
                var aa = document.getElementsByName("xtipp" + xx + y)[0].value;
                if (aa == "") {
                    aa = "-1";
                }
                if (aa == "_") {
                    aa = "-1";
                }
                var ab = aa;
                if (isNaN(a) === true) {
                    a = 0;
                } else {
                    a = parseInt(a);
                }
                if ((z == 1) && (a < 9999)) {
                    a++;
                }
                if ((z == -1) && (a > -1)) {
                    a--;
                }
                if ((a > -1) && (aa < 0)) {
                    aa = 0;
                }
                if ((a < 0) && (aa > -1)) {
                    aa = -1;
                }
                if (a == -1) {
                    a = "";
                }
                document.getElementsByName("xtipp" + x + y)[0].value = a;
                if (ab != aa) {
                    if (aa == -1) {
                        aa = "";
                    }
                    document.getElementsByName("xtipp" + xx + y)[0].value = aa;
                }
            }

            // --->
        </script>
    <?php } ?>

    <table class="lmomaina" cellspacing="0" cellpadding="0" border="0">
        <tr>
            <td class="lmomain0" colspan="3" align="center">
                <nobr><?php echo $text[500] . ' ';

    if (isset($titel)) {
        echo $titel;
    } ?></nobr>
            </td>
        </tr>
        <tr>
            <td class="lmomain1" align="left">
                <nobr>

                    <?php
                    if ('' != $todo) {
                        echo '<a href="' . $PHP_SELF . '?action=tipp&amp;PHPSESSID=' . $PHPSESSID . '" title="' . $text[553] . '">' . $text[552] . '</a>';
                    } else {
                        echo $text[552];
                    }

    echo '&nbsp;&nbsp;';

    if ('viewer' == $file) {
        echo $text[509] . '&nbsp;&nbsp;';
    } elseif ('' != $file) {
        if (-1 != $sttipp) {
            if ('edit' != $todo) {
                echo '<a href="' . $adda . 'edit&amp;file=' . $file . '&amp;st=' . $st . '&amp;PHPSESSID=' . $PHPSESSID . '" title="' . $text[509] . '">' . $text[509] . '</a>';
            } else {
                echo $text[509];
            }

            echo '&nbsp;&nbsp;';
        }

        if (1 == $tippeinsicht) {
            if ('einsicht' != $todo) {
                echo '<a href="' . $adda . 'einsicht&amp;file=' . $file . '&amp;st=' . $st . '&amp;PHPSESSID=' . $PHPSESSID . '" title="' . $text[657] . '">' . $text[657] . '</a>';
            } else {
                echo $text[657];
            }

            echo '&nbsp;&nbsp;';
        }

        if (0 == $lmtype && 1 == $tipptabelle1) {
            if ('tabelle' != $todo) {
                echo '<a href="' . $adda . 'tabelle&amp;file=' . $file . '&amp;PHPSESSID=' . $PHPSESSID . '" title="' . $text[673] . '">' . $text[672] . '</a>';
            } else {
                echo $text[672];
            }

            echo '&nbsp;&nbsp;';
        }

        if (1 == $tippfieber) {
            if ('fieber' != $todo) {
                echo '<a href="' . $adda . 'fieber&amp;file=' . $file . '&amp;PHPSESSID=' . $PHPSESSID . '" title="' . $text[134] . '">' . $text[133] . '</a>';
            } else {
                echo $text[133];
            }

            echo '&nbsp;&nbsp;';
        }

        if ('wert' != $todo || 1 == $all) {
            echo '<a href="' . $adda . 'wert&amp;file=' . $file . '&amp;endtab=' . $endtab . '&amp;wertung=einzel&amp;PHPSESSID=' . $PHPSESSID . '" title="' . $text[554] . '">' . $text[554] . '</a>';
        } else {
            echo $text[554];
        }

        echo '&nbsp;&nbsp;';
    }

    /*
        if($gesamt==1){
          if($todo!="wert" || $all!=1){echo "<a href=\"".$adda."wert&amp;file=".$file."&amp;wertung=einzel&amp;all=1&amp;PHPSESSID=".$PHPSESSID."\" title=\"".$text[556]."\">".$text[556]."</a>";}
          else{echo $text[556];}
          }
        echo "&nbsp;&nbsp;";
    */ ?>
                </nobr>
            </td>
            <td class="lmomain1" width="8">&nbsp;</td>
            <td class="lmomain1" align="right">
                <nobr>
                    <?php
                    if (1 == $regeln) {
                        echo '<a href="' . $regelnlink . '">' . $text[685] . '</a>';

                        echo '&nbsp;&nbsp;';
                    }

    echo '<a href="' . $adda . 'logout">' . $text[88] . '</a>';

    echo '&nbsp;&nbsp;';

    if ('info' != $todo) {
        echo '<a href="' . $adda . 'info&amp;file=' . $file . '" title="' . $text[21] . '">' . $text[20] . '</a>';
    } else {
        echo $text[20];
    }

    echo '&nbsp;'; ?>

                </nobr>
            </td>
        </tr>
        <tr>
            <td class="lmomain1" colspan="3" align="center">

                <?php
                if (5 == $HTTP_SESSION_VARS['lmotipperok']) {
                    if ('' != $file && 'viewer' != $file) {
                        $tippfile = $dirtipp . mb_substr($file, mb_strrpos($file, '/') + 1, -4) . '_' . $lmotippername . '.tip';
                    }

                    if ('viewer' == $file) {
                        require 'lmo-tippviewer.php';
                    } elseif ('edit' == $todo) {
                        require 'lmo-tippedit.php';
                    } elseif ('einsicht' == $todo) {
                        require 'lmo-tippeinsicht.php';
                    } elseif ('tabelle' == $todo) {
                        require 'lmo-tipptabelle.php';
                    } elseif ('fieber' == $todo) {
                        require 'lmo-tippfieber.php';
                    } elseif ('wert' == $todo) {
                        require 'lmo-tippwert.php';
                    } elseif ('daten' == $todo) {
                        require 'lmo-tippdaten.php';
                    } elseif ('newligen' == $todo) {
                        require 'lmo-tippnewligen.php';
                    } elseif ('delligen' == $todo) {
                        require 'lmo-tippdelligen.php';
                    } elseif ('pwchange' == $todo) {
                        require 'lmo-tipppwchange.php';
                    } elseif ('delaccount' == $todo) {
                        require 'lmo-tippdelaccount.php';
                    } elseif ('info' == $todo) {
                        require 'lmo-showinfo.php';
                    } else {
                        require 'lmo-tipppad.php';
                    }
                } ?>
            </td>
        </tr>
        <?php require 'lmo-tippfusszeile.php'; ?>
    </table>

<?php
} ?>
