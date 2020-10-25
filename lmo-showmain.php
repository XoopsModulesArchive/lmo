<?php

//
// LigaManager Online 3.02b
// Copyright (C) 1997-2002 by Frank Hollwitz
// webmaster@hollwitz.de / http://php.hollwitz.de
//
// Tippspiel-AddOn 1.20
// Copyright (C) 2002 by Frank Albrecht
// fkalbrecht@web.de
//
// überarbeitet für XOOPS RC3 von
// Hans Marx, webmaster@bama-webdesign.de / http://www.bama-webdesign.de
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
function getmicrotime()
{
    [$usec, $sec] = explode(' ', microtime());

    return ((float)$usec + (float)$sec);
}

$startzeit = getmicrotime();
if (('' != $file) && ('' != $action)) {
    $addm = $PHP_SELF . '?file=' . $file . '&amp;action=';

    if (!isset($endtab)) {
        $endtab = $anzst;

        $ste = $st;

        $tabdat = '';
    } else {
        $tabdat = $endtab . '. ' . $text[2];

        $ste = $endtab;
    } ?>

    <table class="lmomaina" cellspacing="0" cellpadding="0" border="0">
        <tr>
            <td class="lmomain0" colspan="3" align="center">
                <nobr><?php echo $titel; ?></nobr>
            </td>
        </tr>

        <?php if ((1 == $nticker) && ('' != $file)) { ?>
            <script language="JavaScript">
                <!--
                var msg1 = "";
                <?php
                for ($i = 0,$iMax = count($nlines); $i < $iMax; $i++) {
                    ?>
                msg1 = msg1 + "<?php echo $nlines[$i]; ?> +++ ";
                <?php
                } ?>
                var laenge = msg1.length;
                var timerID = null;
                var timerRunning = false;
                var id, pause = 0, position = 0;

                function marquee() {
                    var i, k, msg = msg1;
                    k = (52 / msg.length) + 1;
                    for (i = 0; i <= k; i++) msg += "" + msg;
                    document.marqueeform.marquee.value = msg.substring(position, position + 120);
                    if (position++ == laenge) position = 0;
                    id = setTimeout("marquee()", 1000 / 10);
                }

                function action() {
                    if (!pause) {
                        clearTimeout(id);
                        pause = 1;
                    } else {
                        marquee();
                        pause = 0;
                    }
                }

                document.write("<tr><td class=\"lmomain1\" colspan=\"3\" align=\"center\"><nobr><FORM NAME=\"marqueeform\"><INPUT class=\"lmotickerein\" TYPE=\"TEXT\" NAME=\"marquee\" SIZE=\"52\" readonly></FORM></nobr></td></tr>");
                document.close();
                marquee();
                -->
            </script>
        <?php } ?>

        <tr>
            <td class="lmomain1">
                <nobr>

                    <?php
                    include 'lmo-zustat-config.php';

    if (1 == $einspieler) {
        if (!isset($mittore)) {
            $mittore = 0;
        }
    }

    if (0 == $lmtype) {
        if (1 == $datc) {
            if ('cal' != $action) {
                echo '<a href="' . $addm . 'cal&amp;st=' . $st . '" title="' . $text[141] . '">' . $text[140] . '</a>';
            } else {
                echo $text[140];
            }

            echo '&nbsp;&nbsp;';
        }

        if (0 == $tabonres) {
            if ('results' != $action) {
                echo '<a href="' . $addm . 'results&amp;st=' . $ste . '" title="' . $text[11] . '">' . $text[10] . '</a>';
            } else {
                echo $text[10];
            }

            echo '&nbsp;&nbsp;';

            if ('table' != $action) {
                echo '<a href="' . $addm . 'table" title="' . $text[17] . '">' . $text[16] . '</a>';
            } else {
                echo $text[16];
            }
        } else {
            if ('results' != $action) {
                echo '<a href="' . $addm . 'results" title="' . $text[104] . '">' . $text[10] . '/' . $text[16] . '</a>';
            } else {
                echo $text[10] . '/' . $text[16];
            }
        }

        echo '&nbsp;&nbsp;';

        if (1 == $kreuz) {
            if ('cross' != $action) {
                echo '<a href="' . $addm . 'cross" title="' . $text[15] . '">' . $text[14] . '</a>';
            } else {
                echo $text[14];
            }

            echo '&nbsp;&nbsp;';
        }

        if ('program' != $action) {
            echo '<a href="' . $addm . 'program" title="' . $text[13] . '">' . $text[12] . '</a>';
        } else {
            echo $text[12];
        }

        echo '&nbsp;&nbsp;';

        if (1 == $kurve) {
            if ('graph' != $action) {
                echo '<a href="' . $addm . 'graph&amp;stat1=' . $stat1 . '&amp;stat2=' . $stat2 . '" title="' . $text[134] . '">' . $text[133] . '</a>';
            } else {
                echo $text[133];
            }

            echo '&nbsp;&nbsp;';
        }

        if ('stats' != $action) {
            echo '<a href="' . $addm . 'stats&amp;stat1=' . $stat1 . '&amp;stat2=' . $stat2 . '" title="' . $text[19] . '">' . $text[18] . '</a>';
        } else {
            echo $text[18];
        }

        if (1 == $einspieler) {
            include 'lmo-statloadconfig.php';

            echo '&nbsp;&nbsp;';

            if ('spieler' != $action && 1 == $mittore) {
                echo '<a href="' . $addm . 'spieler" title="' . $text[812] . '">' . $ligalink . '</a> ';
            } else {
                if (1 == $mittore) {
                    echo $ligalink . ' ';
                }
            }
        }
    } else {
        if (1 == $datc) {
            if ('cal' != $action) {
                echo '<a href="' . $addm . 'cal&amp;st=' . $st . '" title="' . $text[141] . '">' . $text[140] . '</a>';
            } else {
                echo $text[140];
            }

            echo '&nbsp;&nbsp;';
        }

        if ('results' != $action) {
            echo '<a href="' . $addm . 'results" title="' . $text[367] . '">' . $text[10] . '</a>';
        } else {
            echo $text[10];
        }

        echo '&nbsp;&nbsp;';

        if ('program' != $action) {
            echo '<a href="' . $addm . 'program" title="' . $text[13] . '">' . $text[12] . '</a>';
        } else {
            echo $text[12];
        }
    } ?>

                </nobr>
            </td>
            <td class="lmomain1" width="8">&nbsp;</td>
            <td class="lmomain1" align="right">
                <nobr>

                    <?php
                    if ('info' != $action) {
                        echo '<a href="' . $addm . 'info" title="' . $text[21] . '">' . $text[20] . '</a>';
                    } else {
                        echo $text[20];
                    } ?>

                </nobr>
            </td>
        </tr>
        <tr>
            <td class="lmomain1" colspan="3" align="center">

                <?php
                if (0 == $lmtype) {
                    if ('cal' == $action) {
                        if (1 == $datc) {
                            require 'lmo-showcal.php';
                        }
                    }

                    if (0 == $tabonres) {
                        if ('results' == $action) {
                            require 'lmo-showresults.php';

                            if (file_exists('lmo-savehtml.php')) {
                                $druck = 1;
                            }
                        }

                        if ('table' == $action) {
                            require 'lmo-showtable.php';
                        }
                    } else {
                        if ('results' == $action) {
                            require 'lmo-showrestab.php';
                        }
                    }

                    if (1 == $kreuz) {
                        if ('cross' == $action) {
                            require 'lmo-showcross.php';
                        }
                    }

                    if ('program' == $action) {
                        require 'lmo-showprogram.php';
                    }

                    if (1 == $kurve) {
                        if ('graph' == $action) {
                            require 'lmo-showgraph.php';
                        }
                    }

                    if ('stats' == $action) {
                        require 'lmo-showstats.php';
                    }

                    if (1 == $einspieler) {
                        if ('spieler' == $action && 1 == $mittore) {
                            require 'lmo-statshow.php';
                        }
                    }
                } else {
                    if ('cal' == $action) {
                        if (1 == $datc) {
                            require 'lmo-showkocal.php';
                        }
                    }

                    if ('results' == $action) {
                        require 'lmo-showkoresults.php';
                    }

                    if ('program' == $action) {
                        require 'lmo-showkoprogram.php';
                    }

                    if (1 == $einspieler) {
                        if ('spieler' == $action && 1 == $mittore) {
                            require 'lmo-statshow.php';
                        }
                    }
                }

    if ('info' == $action) {
        require 'lmo-showinfo.php';
    } ?>

            </td>
        </tr>
        <tr>
            <td class="lmomain2" colspan="3" align="center">
                <?php if (1 == $einsavehtml) { ?>
                    <table width="100%" cellspacing="0" cellpadding="0" border="0">
                        <tr>
                            <?php if (0 == $lmtype and 1 == $druck) {
        include 'lmo-savehtml.php';
    } ?>
                            <td class="lmomain1" align="center"><?php if (0 == $lmtype and 1 == $druck) {
        echo '<a href="' . $wmldir . basename($file) . '-st.html' . '" target="_blank" title="' . $text[477] . '">' . $text[478] . '</a>&nbsp;';
    } ?></td>
                            <td class="lmomain1" align="center"><?php if (0 == $lmtype and 1 == $druck) {
        echo '<a href="' . $wmldir . basename($file) . '-sp.html' . '" target="_blank" title="' . $text[479] . '">' . $text[480] . '</a>&nbsp;';
    } ?></td>
                        </tr>
                    </table>
                <?php } ?>
            </td>
        </tr>
        <tr>
            <td class="lmomain2" colspan="3" align="right">
                <table width="100%" cellspacing="0" cellpadding="0" border="1">
                    <tr>
                        <td class="lmomain1" valign="bottom" align="left">
                            <?php
                            if (1 == $eintippspiel) {
                                if (1 == $tippspiel && (1 == $immeralle || mb_strpos($ligenzutippen, mb_substr($file, mb_strrpos($file, '//') + 1, -4)) > -1)) {
                                    echo '<a href="' . $PHP_SELF . '?action=tipp&amp;file=' . $file . '&amp;todo=edit">' . $text[594] . '</a>&nbsp;&nbsp;&nbsp;<br>';
                                }
                            } else {
                                echo '&nbsp;<br>';
                            }

    if (1 == $backlink) {
        echo '<a href="' . $PHP_SELF . '" title="' . $text[392] . '">' . _LMO_LIGARETUR . '</a>&nbsp;&nbsp;&nbsp;';
    } else {
        echo '&nbsp;';
    } ?>
                        </td>
                        <td class="lmomain2" align="right">
                            <nobr><?php echo $text[406] . ': ' . $stand; ?><br><?php if (1 == $calctime) {
        echo $text[471] . ': ' . number_format((getmicrotime() - $startzeit), 4, '.', ',') . ' sek.<br>';
    } ?><?php echo $text[54]; ?> - <?php echo $text[55];

    echo '<br>' . $text[1505]; ?></nobr>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

<?php
} ?>


