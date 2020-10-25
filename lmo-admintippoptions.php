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
// Jocker-Hack 001
// Copyright (C) 2002 by Ufuk Altinkaynak
// ufuk.a@arcor.de
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

if (!isset($save)) {
    $save = 0;
}
if (1 == $save) {
    if (!isset($_POST['xshownick'])) {
        $_POST['xshownick'] = '';
    }

    if (!isset($_POST['xshowname'])) {
        $_POST['xshowname'] = '';
    }

    if (!isset($_POST['xshowemail'])) {
        $_POST['xshowemail'] = '';
    }

    if (!isset($_POST['xshowtendenzabs'])) {
        $_POST['xshowtendenzabs'] = '';
    }

    if (!isset($_POST['xshowtendenzpro'])) {
        $_POST['xshowtendenzpro'] = '';
    }

    if (!isset($_POST['xshowdurchschntipp'])) {
        $_POST['xshowdurchschntipp'] = '';
    }

    $tippmodus = trim($_POST['xtippmodus']);

    if (1 == $tippmodus) {
        $rergebnis = trim($_POST['xrergebnis']);

        if ('' == $rergebnis) {
            $rergebnis = 0;
        } else {
            $rergebnis = (int)trim($rergebnis);

            if ('' == $rergebnis || $rergebnis < 0) {
                $rergebnis = '0';
            }
        }

        $rtendenzdiff = trim($_POST['xrtendenzdiff']);

        if ('' == $rtendenzdiff) {
            $rtendenzdiff = 0;
        } else {
            $rtendenzdiff = (int)trim($rtendenzdiff);

            if ('' == $rtendenzdiff || $rtendenzdiff < 0) {
                $rtendenzdiff = '0';
            }
        }

        if ($rergebnis < $rtendenzdiff) {
            $rergebnis = $rtendenzdiff;
        }

        $rtendenz = trim($_POST['xrtendenz']);

        if ('' == $rtendenz) {
            $rtendenz = 0;
        } else {
            $rtendenz = (int)trim($rtendenz);

            if ('' == $rtendenz || $rtendenz < 0) {
                $rtendenz = 0;
            }
        }

        if ($rtendenzdiff < $rtendenz) {
            $rtendenzdiff = $rtendenz;
        }

        $rtor = trim($_POST['xrtor']);

        if ('' == $rtor) {
            $rtor = 0;
        } else {
            $rtor = (int)trim($rtor);

            if ('' == $rtor || $rtor < 0) {
                $rtor = 0;
            }
        }

        $rtendenztor = trim($_POST['xrtendenztor']);

        $rtendenzremis = trim($_POST['xrtendenzremis']);

        $pfeiltipp = trim($_POST['xpfeiltipp']);

        $sttipp = trim($_POST['xsttipp']);

        $viewertipp = trim($_POST['xviewertipp']);

        if (1 == $viewertipp) {
            $viewertage = trim($_POST['xviewertage']);

            if ('' == $viewertage) {
                $viewertage = 8;
            } else {
                $viewertage = (int)trim($viewertage);

                if ('' == $viewertage || $viewertage < 0) {
                    $viewertage = 8;
                }
            }
        }

        $showdurchschntipp = trim($_POST['xshowdurchschntipp']);

        if (1 != $showdurchschntipp) {
            $showdurchschntipp = 0;
        }
    }

    $tipptabelle1 = trim($_POST['xtipptabelle1']);

    $tipptabelle = trim($_POST['xtipptabelle']);

    $showzus = trim($_POST['xshowzus']);

    $showstsiege = trim($_POST['xshowstsiege']);

    $krit1 = trim($_POST['xkrit1']);

    $krit2 = trim($_POST['xkrit2']);

    $krit3 = trim($_POST['xkrit3']);

    $dirtipp = trim($_POST['xdirtipp']);

    if ('' == $dirtipp) {
        $dirtipp = 'tipps/';
    }

    $dummy = $dirtipp;

    $dirtipp = str_replace('\\', '/', $dummy);

    if ('/' != mb_substr($dirtipp, -1)) {
        $dirtipp .= '/';
    }

    if ('/' == $dirtipp) {
        $dirtipp = 'tipps/';
    }

    $shownick = trim($_POST['xshownick']);

    if (1 != $shownick) {
        $shownick = 0;
    }

    $showname = trim($_POST['xshowname']);

    if (1 != $showname) {
        $showname = 0;
    }

    $showemail = trim($_POST['xshowemail']);

    if (1 != $showemail) {
        $showemail = 0;
    }

    if (0 == $showname && 0 == $showemail) {
        $shownick = 1;
    }

    $showtendenzabs = trim($_POST['xshowtendenzabs']);

    if (1 != $showtendenzabs) {
        $showtendenzabs = 0;
    }

    $showtendenzpro = trim($_POST['xshowtendenzpro']);

    if (1 != $showtendenzpro) {
        $showtendenzpro = 0;
    }

    $tippspiel = trim($_POST['xtippspiel']);

    $regeln = trim($_POST['xregeln']);

    if (1 == $regeln) {
        $regelnlink = trim($_POST['xregelnlink']);
    }

    $freischaltung = trim($_POST['xfreischaltung']);

    $entscheidungnv = trim($_POST['xentscheidungnv']);

    $entscheidungie = trim($_POST['xentscheidungie']);

    $einsichterst = trim($_POST['xeinsichterst']);

    $rremis = trim($_POST['xrremis']);

    if ('' == $rremis) {
        $rremis = 0;
    } else {
        $rremis = (int)trim($rremis);

        if ('' == $rremis || $rremis < 0) {
            $rremis = 0;
        }
    }

    $gtpunkte = trim($_POST['xgtpunkte']);

    $anzseite = trim($_POST['xanzseite']);

    if ('' == $anzseite) {
        $anzseite = 0;
    } else {
        $anzseite = (int)trim($anzseite);

        if ('' == $anzseite || $anzseite < 0) {
            $anzseite = 0;
        }
    }

    $anzseite1 = trim($_POST['xanzseite1']);

    if ('' == $anzseite1) {
        $anzseite1 = 0;
    } else {
        $anzseite1 = (int)trim($anzseite1);

        if ('' == $anzseite1 || $anzseite1 < 0) {
            $anzseite1 = 0;
        }
    }

    $tippeinsicht = trim($_POST['xtippeinsicht']);

    $tippfieber = trim($_POST['xtippfieber']);

    $wertverein = trim($_POST['xwertverein']);

    $aktauswert = trim($_POST['xaktauswert']);

    $aktauswertges = trim($_POST['xaktauswertges']);

    $akteinsicht = trim($_POST['xakteinsicht']);

    if (1 == $showtendenzabs || 1 == $showtendenzpro || (1 == $showdurchschntipp && 1 == $tippmodus)) {
        $akteinsicht = 1;
    }

    $adresse = trim($_POST['xadresse']);

    $realname = trim($_POST['xrealname']);

    $gesamt = trim($_POST['xgesamt']);

    $tippohne = trim($_POST['xtippohne']);

    $tippbis = trim($_POST['xtippbis']);

    if ('' == $tippbis) {
        $tippbis = 0;
    } else {
        $tippbis = (int)trim($tippbis);

        if ('' == $tippbis) {
            $tippbis = 0;
        }
    }

    $tipperimteam = trim($_POST['xtipperteam']);

    $imvorraus = trim($_POST['ximvorraus']);

    $jokertipp = trim($_POST['xjokertipp']);

    if (1 == $jokertipp) {
        $jokertippmulti = trim($_POST['xjokertippmulti']);
    }

    $immeralle = trim($_POST['ximmeralle']);

    $ligenzutippen = '';

    if (1 != $immeralle) {
        $immeralle = 0;

        if ('' != $_POST['xtipperligen']) {
            foreach ($_POST['xtipperligen'] as $key => $value) {
                $ligenzutippen .= $value . ',';
            }
        }

        $ligenzutippen = trim(mb_substr($ligenzutippen, 0, -1));
    }

    require 'lmo-tippsavecfg.php';
}
$adda = $PHP_SELF . '?action=admin&amp;todo=tipp';
$addu = $PHP_SELF . '?action=admin&amp;todo=tippuser';
$adde = $PHP_SELF . '?action=admin&amp;todo=tippemail';
?>
<script language="JavaScript">
    <!--
    -
        function immerallechange() {
            lmotest = false;
            for (i = 0; i < document.getElementsByName("xtipperligen[]").length; i++) {
                if (document.getElementsByName("ximmeralle")[0].value == 0) {
                    document.getElementsByName("xtipperligen[]")[i].disabled = false;
                } else {
                    document.getElementsByName("xtipperligen[]")[i].disabled = true;
                }
            }
        }

    function moduschange() {
        lmotest = false;
        if (document.getElementsByName("xtippmodus")[0].value == 1) {
            document.getElementsByName("xrergebnis")[0].disabled = false;
            document.getElementsByName("xrtendenzdiff")[0].disabled = false;
            document.getElementsByName("xrtendenz")[0].disabled = false;
            document.getElementsByName("xrtor")[0].disabled = false;
            document.getElementsByName("xrtendenztor")[0].disabled = false;
            document.getElementsByName("xrtendenzremis")[0].disabled = false;
            document.getElementsByName("xshowdurchschntipp")[0].disabled = false;
            document.getElementsByName("xpfeiltipp")[0].disabled = false;
        } else {
            document.getElementsByName("xrergebnis")[0].disabled = true;
            document.getElementsByName("xrtendenzdiff")[0].disabled = true;
            document.getElementsByName("xrtendenz")[0].disabled = true;
            document.getElementsByName("xrtor")[0].disabled = true;
            document.getElementsByName("xrtendenztor")[0].disabled = true;
            document.getElementsByName("xrtendenzremis")[0].disabled = true;
            document.getElementsByName("xshowdurchschntipp")[0].disabled = true;
            document.getElementsByName("xpfeiltipp")[0].disabled = true;
        }
    }

    function regelnchange() {
        lmotest = false;
        if (document.getElementsByName("xregeln")[0].value == 1) {
            document.getElementsByName("xregelnlink")[0].disabled = false;
        } else {
            document.getElementsByName("xregelnlink")[0].disabled = true;
        }
    }

    function jokerchange() {
        lmotest = false;
        if (document.getElementsByName("xjokertipp")[0].value == 1) {
            document.getElementsByName("xjokertippmulti")[0].disabled = false;
        } else {
            document.getElementsByName("xjokertippmulti")[0].disabled = true;
        }
    }

    function viewerchange() {
        lmotest = false;
        if (document.getElementsByName("xviewertipp")[0].value == 1) {
            document.getElementsByName("xviewertage")[0].disabled = false;
        } else {
            document.getElementsByName("xviewertage")[0].disabled = true;
        }
    }

    // --->
</script>

<table class="lmosta" cellspacing="0" cellpadding="0" border="0">
    <tr>
        <td class="lmost1" align="center"><?php echo $text[533] ?></td>
    </tr>
    <tr>
        <td align="center" class="lmost3">
            <table class="lmostb" cellspacing="0" cellpadding="0" border="0">
                <form name="lmoedit" action="<?php echo $PHP_SELF; ?>" method="post" onSubmit="return chklmopass()">
                    <input type="hidden" name="action" value="admin">
                    <input type="hidden" name="todo" value="tippoptions">
                    <input type="hidden" name="save" value="1">
                    <tr>
                        <td class="lmost4" colspan="3">
                            <nobr><?php echo $text[591]; ?></nobr>
                        </td>
                    </tr>
                    <tr>
                        <td class="lmost5" width="20">&nbsp;</td>
                        <td class="lmost5" align="right">
                            <nobr><?php echo $text[591]; ?></nobr>
                        </td>
                        <td class="lmost5">
                            <select name="xtippmodus" onChange="moduschange()">
                                <?php
                                echo '<option value="1"';
                                if (1 == $tippmodus) {
                                    echo ' selected';
                                }
                                echo '>' . $text[592] . '</option>';
                                echo '<option value="0"';
                                if (0 == $tippmodus) {
                                    echo ' selected';
                                }
                                echo '>' . $text[593] . '</option>';
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="lmost4" colspan="3">
                            <nobr><?php echo $text[532]; ?></nobr>
                        </td>
                    </tr>
                    <tr>
                        <td class="lmost5" width="20">&nbsp;</td>
                        <td class="lmost5" align="right">
                            <nobr><?php echo $text[534]; ?></nobr>
                        </td>
                        <td class="lmost5"><input class="lmoadminein" type="text" name="xrergebnis" size="10" maxlength="5" value="<?php echo $rergebnis; ?>" onChange="dolmoedit()"<?php if (0 == $tippmodus) {
                                    echo ' disabled';
                                } ?>>&nbsp;<?php echo $text[538]; ?></td>
                    </tr>
                    <tr>
                        <td class="lmost5" width="20">&nbsp;</td>
                        <td class="lmost5" align="right">
                            <nobr><?php echo $text[535]; ?></nobr>
                        </td>
                        <td class="lmost5"><input class="lmoadminein" type="text" name="xrtendenzdiff" size="10" maxlength="5" value="<?php echo $rtendenzdiff; ?>" onChange="dolmoedit()"<?php if (0 == $tippmodus) {
                                    echo ' disabled';
                                } ?>>&nbsp;<?php echo $text[538]; ?></td>
                    </tr>
                    <tr>
                        <td class="lmost5" width="20">&nbsp;</td>
                        <td class="lmost5" align="right">
                            <nobr><?php echo $text[536]; ?></nobr>
                        </td>
                        <td class="lmost5"><input class="lmoadminein" type="text" name="xrtendenz" size="10" maxlength="5" value="<?php echo $rtendenz; ?>" onChange="dolmoedit()"<?php if (0 == $tippmodus) {
                                    echo ' disabled';
                                } ?>>&nbsp;<?php echo $text[538]; ?></td>
                    </tr>
                    <tr>
                        <td class="lmost5" width="20">&nbsp;</td>
                        <td class="lmost5" align="right">
                            <nobr><?php echo $text[537]; ?></nobr>
                        </td>
                        <td class="lmost5"><input class="lmoadminein" type="text" name="xrtor" size="10" maxlength="5" value="<?php echo $rtor; ?>" onChange="dolmoedit()"<?php if (0 == $tippmodus) {
                                    echo ' disabled';
                                } ?>>&nbsp;<?php echo $text[538]; ?></td>
                    </tr>
                    <tr>
                        <td class="lmost5" width="20">&nbsp;</td>
                        <td class="lmost5" align="right">
                            <nobr><?php echo $text[689]; ?></nobr>
                        </td>
                        <td class="lmost5">
                            <select name="xrtendenztor" onChange="dolmoedit()"<?php if (0 == $tippmodus) {
                                    echo ' disabled';
                                } ?>>
                                <?php
                                echo '<option value="1"';
                                if (1 == $rtendenztor) {
                                    echo ' selected';
                                }
                                echo '>' . $text[690] . '</option>';
                                echo '<option value="0"';
                                if (0 == $rtendenztor) {
                                    echo ' selected';
                                }
                                echo '>' . $text[691] . '</option>';
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="lmost5" width="20">&nbsp;</td>
                        <td class="lmost5" align="right">
                            <nobr><?php echo $text[693]; ?></nobr>
                        </td>
                        <td class="lmost5">
                            <select name="xrtendenzremis" onChange="dolmoedit()"<?php if (0 == $tippmodus) {
                                    echo ' disabled';
                                } ?>>
                                <?php
                                echo '<option value="1"';
                                if (1 == $rtendenzremis) {
                                    echo ' selected';
                                }
                                echo '>' . $text[694] . '</option>';
                                echo '<option value="0"';
                                if (0 == $rtendenzremis) {
                                    echo ' selected';
                                }
                                echo '>' . $text[695] . '</option>';
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="lmost5" width="20">&nbsp;</td>
                        <td class="lmost5" align="right">
                            <nobr><?php echo $text[692]; ?></nobr>
                        </td>
                        <td class="lmost5"><input class="lmoadminein" type="text" name="xrremis" size="10" maxlength="5" value="<?php echo $rremis; ?>" onChange="dolmoedit()">&nbsp;<?php echo $text[538]; ?></td>
                    </tr>
                    <tr>
                        <td class="lmost4" colspan="3">
                            <nobr><?php echo $text[740]; ?></nobr>
                        </td>
                    </tr>
                    <tr>
                        <td class="lmost5" width="20">&nbsp;</td>
                        <td class="lmost5" align="right">
                            <nobr><?php echo $text[657]; ?></nobr>
                        </td>
                        <td class="lmost5">
                            <select name="xtippeinsicht" onChange="dolmoedit()">
                                <?php
                                echo '<option value="1"';
                                if (1 == $tippeinsicht) {
                                    echo ' selected';
                                }
                                echo '>' . $text[181] . '</option>';
                                echo '<option value="0"';
                                if (0 == $tippeinsicht) {
                                    echo ' selected';
                                }
                                echo '>' . $text[182] . '</option>';
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="lmost5" width="20">&nbsp;</td>
                        <td class="lmost5" align="right">
                            <nobr><?php echo $text[672]; ?></nobr>
                        </td>
                        <td class="lmost5">
                            <select name="xtipptabelle1" onChange="dolmoedit()">
                                <?php
                                echo '<option value="1"';
                                if (1 == $tipptabelle1) {
                                    echo ' selected';
                                }
                                echo '>' . $text[181] . '</option>';
                                echo '<option value="0"';
                                if (0 == $tipptabelle1) {
                                    echo ' selected';
                                }
                                echo '>' . $text[182] . '</option>';
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="lmost5" width="20">&nbsp;</td>
                        <td class="lmost5" align="right">
                            <nobr><?php echo $text[133]; ?></nobr>
                        </td>
                        <td class="lmost5">
                            <select name="xtippfieber" onChange="dolmoedit()">
                                <?php
                                echo '<option value="1"';
                                if (1 == $tippfieber) {
                                    echo ' selected';
                                }
                                echo '>' . $text[181] . '</option>';
                                echo '<option value="0"';
                                if (0 == $tippfieber) {
                                    echo ' selected';
                                }
                                echo '>' . $text[182] . '</option>';
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="lmost5" width="20">&nbsp;</td>
                        <td class="lmost5" align="right">
                            <nobr><?php echo $text[556]; ?></nobr>
                        </td>
                        <td class="lmost5">
                            <select name="xgesamt" onChange="dolmoedit()">
                                <?php
                                echo '<option value="1"';
                                if (1 == $gesamt) {
                                    echo ' selected';
                                }
                                echo '>' . $text[181] . '</option>';
                                echo '<option value="0"';
                                if (0 == $gesamt) {
                                    echo ' selected';
                                }
                                echo '>' . $text[182] . '</option>';
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="lmost4" colspan="3">
                            <nobr><?php echo $text[714]; ?></nobr>
                        </td>
                    </tr>
                    <tr>
                        <td class="lmost5" width="20">&nbsp;</td>
                        <td class="lmost5" align="right">
                            <nobr><?php echo $text[587]; ?></nobr>
                        </td>
                        <td class="lmost5"><input class="lmoadminein" type="text" name="xtippbis" size="10" maxlength="5" value="<?php echo $tippbis; ?>" onChange="dolmoedit()">
                            <nobr><?php echo ' ' . $text[588]; ?></nobr>
                        </td>
                    </tr>
                    <tr>
                        <td class="lmost5" width="20">&nbsp;</td>
                        <td class="lmost5" align="right">
                            <nobr><?php echo $text[748]; ?></nobr>
                        </td>
                        <td class="lmost5">
                            <select name="xtippohne" onChange="dolmoedit()">
                                <?php
                                echo '<option value="1"';
                                if (1 == $tippohne) {
                                    echo ' selected';
                                }
                                echo '>' . $text[749] . '</option>';
                                echo '<option value="0"';
                                if (0 == $tippohne) {
                                    echo ' selected';
                                }
                                echo '>' . $text[750] . '</option>';
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="lmost5" width="20">&nbsp;</td>
                        <td class="lmost5" align="right">
                            <nobr><?php echo $text[600]; ?></nobr>
                        </td>
                        <td class="lmost5">
                            <select name="xtipperteam" onChange="dolmoedit()">
                                <?php
                                echo '<option value="-1"';
                                if (-1 == $tipperimteam) {
                                    echo ' selected';
                                }
                                echo '>' . $text[601] . '</option>';
                                echo '<option value="2"';
                                if (2 == $tipperimteam) {
                                    echo ' selected';
                                }
                                echo '>2</option>';
                                echo '<option value="3"';
                                if (3 == $tipperimteam) {
                                    echo ' selected';
                                }
                                echo '>3</option>';
                                echo '<option value="5"';
                                if (5 == $tipperimteam) {
                                    echo ' selected';
                                }
                                echo '>5</option>';
                                echo '<option value="10"';
                                if (10 == $tipperimteam) {
                                    echo ' selected';
                                }
                                echo '>10</option>';
                                echo '<option value="20"';
                                if (20 == $tipperimteam) {
                                    echo ' selected';
                                }
                                echo '>20</option>';
                                echo '<option value="30"';
                                if (30 == $tipperimteam) {
                                    echo ' selected';
                                }
                                echo '>30</option>';
                                echo '<option value="50"';
                                if (50 == $tipperimteam) {
                                    echo ' selected';
                                }
                                echo '>50</option>';
                                echo '<option value="100"';
                                if (100 == $tipperimteam) {
                                    echo ' selected';
                                }
                                echo '>100</option>';
                                echo '<option value="0"';
                                if (0 == $tipperimteam) {
                                    echo ' selected';
                                }
                                echo '>' . $text[602] . '</option>';
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="lmost5" width="20">&nbsp;</td>
                        <td class="lmost5" align="right">
                            <nobr><?php echo $text[654]; ?></nobr>
                        </td>
                        <td class="lmost5">
                            <select name="ximvorraus" onChange="dolmoedit()">
                                <?php
                                echo '<option value="0"';
                                if (0 == $imvorraus) {
                                    echo ' selected';
                                }
                                echo '>0</option>';
                                echo '<option value="1"';
                                if (1 == $imvorraus) {
                                    echo ' selected';
                                }
                                echo '>1</option>';
                                echo '<option value="2"';
                                if (2 == $imvorraus) {
                                    echo ' selected';
                                }
                                echo '>2</option>';
                                echo '<option value="3"';
                                if (3 == $imvorraus) {
                                    echo ' selected';
                                }
                                echo '>3</option>';
                                echo '<option value="4"';
                                if (4 == $imvorraus) {
                                    echo ' selected';
                                }
                                echo '>4</option>';
                                echo '<option value="5"';
                                if (5 == $imvorraus) {
                                    echo ' selected';
                                }
                                echo '>5</option>';
                                echo '<option value="-1"';
                                if (-1 == $imvorraus) {
                                    echo ' selected';
                                }
                                echo '>' . $text[602] . '</option>';
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="lmost5" width="20">&nbsp;</td>
                        <td class="lmost5" align="right">
                            <nobr><?php echo $text[652]; ?></nobr>
                        </td>
                        <td class="lmost5">
                            <select name="xentscheidungnv" onChange="dolmoedit()">
                                <?php
                                echo '<option value="1"';
                                if (1 == $entscheidungnv) {
                                    echo ' selected';
                                }
                                echo '>' . $text[181] . '</option>';
                                echo '<option value="0"';
                                if (0 == $entscheidungnv) {
                                    echo ' selected';
                                }
                                echo '>' . $text[182] . '</option>';
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="lmost5" width="20">&nbsp;</td>
                        <td class="lmost5" align="right">
                            <nobr><?php echo $text[653]; ?></nobr>
                        </td>
                        <td class="lmost5">
                            <select name="xentscheidungie" onChange="dolmoedit()">
                                <?php
                                echo '<option value="1"';
                                if (1 == $entscheidungie) {
                                    echo ' selected';
                                }
                                echo '>' . $text[181] . '</option>';
                                echo '<option value="0"';
                                if (0 == $entscheidungie) {
                                    echo ' selected';
                                }
                                echo '>' . $text[182] . '</option>';
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="lmost5" width="20">&nbsp;</td>
                        <td class="lmost5" align="right">
                            <nobr><?php echo $text[696]; ?></nobr>
                        </td>
                        <td class="lmost5">
                            <select name="xgtpunkte" onChange="dolmoedit()">
                                <?php
                                echo '<option value="0"';
                                if (0 == $gtpunkte) {
                                    echo ' selected';
                                }
                                echo '>' . $text[697] . '</option>';
                                echo '<option value="1"';
                                if (1 == $gtpunkte) {
                                    echo ' selected';
                                }
                                echo '>' . $text[698] . '</option>';
                                echo '<option value="2"';
                                if (2 == $gtpunkte) {
                                    echo ' selected';
                                }
                                echo '>' . $text[699] . '</option>';
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="lmost4" colspan="3">
                            <nobr><?php echo $text[902]; ?></nobr>
                        </td>
                    </tr>
                    <tr>
                        <td class="lmost5" width="20">&nbsp;</td>
                        <td class="lmost5" align="right">
                            <nobr><?php echo $text[901]; ?></nobr>
                        </td>
                        <td class="lmost5">
                            <select name="xjokertipp" onChange="jokerchange()">
                                <?php
                                echo '<option value="1"';
                                if (1 == $jokertipp) {
                                    echo ' selected';
                                }
                                echo '>' . $text[181] . '</option>';
                                echo '<option value="0"';
                                if (0 == $jokertipp) {
                                    echo ' selected';
                                }
                                echo '>' . $text[182] . '</option>';
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="lmost5" width="20">&nbsp;</td>
                        <td class="lmost5" align="right">
                            <nobr><?php echo $text[904]; ?></nobr>
                        </td>
                        <td class="lmost5">
                            <select name="xjokertippmulti" onChange="dolmoedit()"<?php if (0 == $jokertipp) {
                                    echo ' disabled';
                                } ?>>
                                <?php
                                echo '<option value="1.5"';
                                if ('1.5' == $jokertippmulti) {
                                    echo ' selected';
                                }
                                echo '>1.5</option>';
                                echo '<option value="2"';
                                if ('2' == $jokertippmulti) {
                                    echo ' selected';
                                }
                                echo '>2</option>';
                                echo '<option value="2.5"';
                                if ('2.5' == $jokertippmulti) {
                                    echo ' selected';
                                }
                                echo '>2.5</option>';
                                echo '<option value="3"';
                                if ('3' == $jokertippmulti) {
                                    echo ' selected';
                                }
                                echo '>3</option>';
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="lmost4" colspan="3">
                            <nobr><?php echo $text[220]; ?></nobr>
                        </td>
                    </tr>
                    <tr>
                        <td class="lmost5" width="20">&nbsp;</td>
                        <td class="lmost5" align="right">
                            <nobr><?php echo $text[539]; ?></nobr>
                        </td>
                        <td class="lmost5"><input class="lmoadminein" type="text" name="xdirtipp" size="40" maxlength="80" value="<?php echo $dirtipp; ?>" onChange="dolmoedit()"></td>
                    </tr>
                    <tr>
                        <td class="lmost4" colspan="3">
                            <nobr><?php echo $text[738]; ?></nobr>
                        </td>
                    </tr>
                    <tr>
                        <td class="lmost5" width="20">&nbsp;</td>
                        <td class="lmost5" align="right">
                            <nobr><?php echo $text[540]; ?></nobr>
                        </td>
                        <td class="lmost5">
                            <select name="xtippspiel" onChange="dolmoedit()">
                                <?php
                                echo '<option value="1"';
                                if (1 == $tippspiel) {
                                    echo ' selected';
                                }
                                echo '>' . $text[181] . '</option>';
                                echo '<option value="0"';
                                if (0 == $tippspiel) {
                                    echo ' selected';
                                }
                                echo '>' . $text[182] . '</option>';
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="lmost5" width="20">&nbsp;</td>
                        <td class="lmost5" align="right">
                            <nobr><?php echo $text[687]; ?></nobr>
                        </td>
                        <td class="lmost5">
                            <select name="xregeln" onChange="regelnchange()">
                                <?php
                                echo '<option value="1"';
                                if (1 == $regeln) {
                                    echo ' selected';
                                }
                                echo '>' . $text[181] . '</option>';
                                echo '<option value="0"';
                                if (0 == $regeln) {
                                    echo ' selected';
                                }
                                echo '>' . $text[182] . '</option>';
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="lmost5" width="20">&nbsp;</td>
                        <td class="lmost5" align="right">
                            <nobr><?php echo $text[686]; ?></nobr>
                        </td>
                        <td class="lmost5"><input class="lmoadminein" type="text" name="xregelnlink" size="30" maxlength="256" value="<?php echo $regelnlink; ?>" onChange="dolmoedit()"<?php if (0 == $regeln) {
                                    echo ' disabled';
                                } ?>></td>
                    </tr>
                    <tr>
                        <td class="lmost4" colspan="3">
                            <nobr><?php echo $text[739]; ?></nobr>
                        </td>
                    </tr>
                    <tr>
                        <td class="lmost5" width="20">&nbsp;</td>
                        <td class="lmost5" align="right">
                            <nobr><?php echo $text[632]; ?></nobr>
                        </td>
                        <td class="lmost5">
                            <select name="xadresse" onChange="dolmoedit()">
                                <?php
                                echo '<option value="1"';
                                if (1 == $adresse) {
                                    echo ' selected';
                                }
                                echo '>' . $text[181] . '</option>';
                                echo '<option value="0"';
                                if (0 == $adresse) {
                                    echo ' selected';
                                }
                                echo '>' . $text[182] . '</option>';
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="lmost5" width="20">&nbsp;</td>
                        <td class="lmost5" align="right">
                            <nobr><?php echo $text[786]; ?></nobr>
                        </td>
                        <td class="lmost5">
                            <select name="xrealname" onChange="dolmoedit()">
                                <?php
                                echo '<option value="1"';
                                if (-1 != $realname) {
                                    echo ' selected';
                                }
                                echo '>' . $text[181] . '</option>';
                                echo '<option value="-1"';
                                if (-1 == $realname) {
                                    echo ' selected';
                                }
                                echo '>' . $text[182] . '</option>';
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="lmost5" width="20">&nbsp;</td>
                        <td class="lmost5" align="right">
                            <nobr><?php echo $text[646]; ?></nobr>
                        </td>
                        <td class="lmost5">
                            <select name="xfreischaltung" onChange="dolmoedit()">
                                <?php
                                echo '<option value="1"';
                                if (1 == $freischaltung) {
                                    echo ' selected';
                                }
                                echo '>' . $text[181] . '</option>';
                                echo '<option value="0"';
                                if (0 == $freischaltung) {
                                    echo ' selected';
                                }
                                echo '>' . $text[182] . '</option>';
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="lmost4" colspan="3">
                            <nobr><?php echo $text[746]; ?></nobr>
                        </td>
                    </tr>
                    <tr>
                        <td class="lmost5" width="20">&nbsp;</td>
                        <td class="lmost5" align="right">
                            <nobr><?php echo $text[745]; ?></nobr>
                        </td>
                        <td class="lmost5">
                            <select name="xpfeiltipp" onChange="dolmoedit()"<?php if (0 == $tippmodus) {
                                    echo ' disabled';
                                } ?>>
                                <?php
                                echo '<option value="1"';
                                if (1 == $pfeiltipp) {
                                    echo ' selected';
                                }
                                echo '>' . $text[181] . '</option>';
                                echo '<option value="0"';
                                if (0 == $pfeiltipp) {
                                    echo ' selected';
                                }
                                echo '>' . $text[182] . '</option>';
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="lmost5" width="20">&nbsp;</td>
                        <td class="lmost5" align="right">
                            <nobr><?php echo $text[759]; ?></nobr>
                        </td>
                        <td class="lmost5">
                            <select name="xsttipp" onChange="dolmoedit()">
                                <?php
                                echo '<option value="1"';
                                if (-1 != $sttipp) {
                                    echo ' selected';
                                }
                                echo '>' . $text[181] . '</option>';
                                echo '<option value="-1"';
                                if (-1 == $sttipp) {
                                    echo ' selected';
                                }
                                echo '>' . $text[182] . '</option>';
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="lmost5" width="20">&nbsp;</td>
                        <td class="lmost5" align="right">
                            <nobr><?php echo $text[753]; ?></nobr>
                        </td>
                        <td class="lmost5">
                            <select name="xviewertipp" onChange="viewerchange()">
                                <?php
                                echo '<option value="1"';
                                if (1 == $viewertipp) {
                                    echo ' selected';
                                }
                                echo '>' . $text[181] . '</option>';
                                echo '<option value="0"';
                                if (0 == $viewertipp) {
                                    echo ' selected';
                                }
                                echo '>' . $text[182] . '</option>';
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="lmost5" width="20">&nbsp;</td>
                        <td class="lmost5" align="right">
                            <nobr><?php echo $text[754]; ?></nobr>
                        </td>
                        <td class="lmost5"><input class="lmoadminein" type="text" name="xviewertage" size="5" maxlength="2" value="<?php echo $viewertage; ?>" onChange="dolmoedit()"<?php if (0 == $viewertipp) {
                                    echo ' disabled';
                                } ?>>&nbsp;<?php echo $text[671]; ?></td>
                    </tr>
                    <tr>
                        <td class="lmost5" width="20">&nbsp;</td>
                        <td class="lmost5" align="right">
                            <nobr><?php echo $text[661]; ?></nobr>
                        </td>
                        <td class="lmost5">
                            <select name="xakteinsicht" onChange="dolmoedit()">
                                <?php
                                echo '<option value="1"';
                                if (1 == $akteinsicht) {
                                    echo ' selected';
                                }
                                echo '>' . $text[181] . '</option>';
                                echo '<option value="0"';
                                if (0 == $akteinsicht) {
                                    echo ' selected';
                                }
                                echo '>' . $text[182] . '</option>';
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="lmost4" colspan="3">
                            <nobr><?php echo $text[710]; ?></nobr>
                        </td>
                    </tr>
                    <tr>
                        <td class="lmost5" width="20">&nbsp;</td>
                        <td class="lmost5" colspan="2">
                            <nobr>
                                <input type="checkbox" name="xshowtendenzabs" value="1" <?php if (1 == $showtendenzabs) {
                                    echo 'checked';
                                } ?> onClick="dolmoedit()"><?php echo $text[688] . ' ' . $text[712]; ?>
                                <input type="checkbox" name="xshowtendenzpro" value="1" <?php if (1 == $showtendenzpro) {
                                    echo 'checked';
                                } ?> onClick="dolmoedit()"><?php echo $text[688] . ' ' . $text[711]; ?>
                                <input type="checkbox" name="xshowdurchschntipp" value="1" <?php if (1 == $showdurchschntipp) {
                                    echo 'checked';
                                } ?> onClick="dolmoedit()"<?php if (0 == $tippmodus) {
                                    echo ' disabled';
                                } ?>><?php echo $text[713]; ?>
                            </nobr>
                        </td>
                    </tr>
                    <tr>
                        <td class="lmost4" colspan="3">
                            <nobr><?php echo $text[657]; ?></nobr>
                        </td>
                    </tr>
                    <tr>
                        <td class="lmost5" width="20">&nbsp;</td>
                        <td class="lmost5" align="right">
                            <nobr><?php echo $text[660]; ?></nobr>
                        </td>
                        <td class="lmost5">
                            <select name="xeinsichterst" onChange="dolmoedit()">
                                <?php
                                echo '<option value="0"';
                                if (0 == $einsichterst) {
                                    echo ' selected';
                                }
                                echo '>' . $text[715] . '</option>';
                                echo '<option value="1"';
                                if (1 == $einsichterst) {
                                    echo ' selected';
                                }
                                echo '>' . $text[716] . '</option>';
                                echo '<option value="2"';
                                if (2 == $einsichterst) {
                                    echo ' selected';
                                }
                                echo '>' . $text[717] . '</option>';
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="lmost5" width="20">&nbsp;</td>
                        <td class="lmost5" align="right">
                            <nobr><?php echo $text[704]; ?></nobr>
                        </td>
                        <td class="lmost5"><input class="lmoadminein" type="text" name="xanzseite" size="10" maxlength="5" value="<?php echo $anzseite; ?>" onChange="dolmoedit()"></td>
                    </tr>
                    <tr>
                        <td class="lmost4" colspan="3">
                            <nobr><?php echo $text[672]; ?></nobr>
                        </td>
                    </tr>
                    <tr>
                        <td class="lmost5" width="20">&nbsp;</td>
                        <td class="lmost5" align="right">
                            <nobr><?php echo $text[683]; ?></nobr>
                        </td>
                        <td class="lmost5">
                            <select name="xtipptabelle" onChange="dolmoedit()">
                                <?php
                                echo '<option value="1"';
                                if (1 == $tipptabelle) {
                                    echo ' selected';
                                }
                                echo '>' . $text[181] . '</option>';
                                echo '<option value="0"';
                                if (0 == $tipptabelle) {
                                    echo ' selected';
                                }
                                echo '>' . $text[182] . '</option>';
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="lmost5" width="20">&nbsp;</td>
                        <td class="lmost5" align="right">
                            <nobr><?php echo $text[760]; ?></nobr>
                        </td>
                        <td class="lmost5">
                            <select name="xwertverein" onChange="dolmoedit()">
                                <?php
                                echo '<option value="1"';
                                if (1 == $wertverein) {
                                    echo ' selected';
                                }
                                echo '>' . $text[181] . '</option>';
                                echo '<option value="0"';
                                if (0 == $wertverein) {
                                    echo ' selected';
                                }
                                echo '>' . $text[182] . '</option>';
                                ?>
                            </select><?php echo $text[782]; ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="lmost4" colspan="3">
                            <nobr><?php echo $text[747]; ?></nobr>
                        </td>
                    </tr>
                    <tr>
                        <td class="lmost5" width="20">&nbsp;</td>
                        <td class="lmost5" align="right">
                            <nobr><?php echo $text[700]; ?></nobr>
                        </td>
                        <td class="lmost5">
                            <nobr>
                                <input type="checkbox" name="xshownick" value="1" <?php if (1 == $shownick) {
                                    echo 'checked';
                                } ?> onClick="dolmoedit()"><?php echo $text[523]; ?>
                                <input type="checkbox" name="xshowname" value="1" <?php if (1 == $showname) {
                                    echo 'checked';
                                } ?> onClick="dolmoedit()"><?php echo $text[634]; ?>
                                <input type="checkbox" name="xshowemail" value="1" <?php if (1 == $showemail) {
                                    echo 'checked';
                                } ?> onClick="dolmoedit()"><?php echo 'E-mail'; ?>
                            </nobr>
                        </td>
                    </tr>
                    <tr>
                        <td class="lmost5" width="20">&nbsp;</td>
                        <td class="lmost5" align="right">
                            <nobr><?php echo $text[704]; ?></nobr>
                        </td>
                        <td class="lmost5"><input class="lmoadminein" type="text" name="xanzseite1" size="10" maxlength="5" value="<?php echo $anzseite1; ?>" onChange="dolmoedit()"></td>
                    </tr>
                    <tr>
                        <td class="lmost5" width="20">&nbsp;</td>
                        <td class="lmost5" align="right">
                            <nobr><?php echo $text[751]; ?></nobr>
                        </td>
                        <td class="lmost5">
                            <select name="xshowzus" onChange="dolmoedit()">
                                <?php
                                echo '<option value="1"';
                                if (1 == $showzus) {
                                    echo ' selected';
                                }
                                echo '>' . $text[181] . '</option>';
                                echo '<option value="0"';
                                if (0 == $showzus) {
                                    echo ' selected';
                                }
                                echo '>' . $text[182] . '</option>';
                                ?>
                            </select><?php echo $text[782]; ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="lmost5" width="20">&nbsp;</td>
                        <td class="lmost5" align="right">
                            <nobr><?php echo $text[772]; ?></nobr>
                        </td>
                        <td class="lmost5">
                            <select name="xshowstsiege" onChange="dolmoedit()">
                                <?php
                                echo '<option value="1"';
                                if (1 == $showstsiege) {
                                    echo ' selected';
                                }
                                echo '>' . $text[181] . '</option>';
                                echo '<option value="0"';
                                if (0 == $showstsiege) {
                                    echo ' selected';
                                }
                                echo '>' . $text[182] . '</option>';
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="lmost4" colspan="3">
                            <nobr><?php echo $text[774]; ?></nobr>
                        </td>
                    </tr>
                    <tr>
                        <td class="lmost5" width="20">&nbsp;</td>
                        <td class="lmost5" align="right">
                            <nobr><?php echo $text[775] . ' 1'; ?></nobr>
                        </td>
                        <td class="lmost5">
                            <select name="xkrit1" onChange="dolmoedit()">
                                <?php
                                echo '<option value="-1"';
                                if (-1 == $krit1) {
                                    echo ' selected';
                                }
                                echo '>' . $text[781] . '</option>';
                                echo '<option value="0"';
                                if (0 == $krit1) {
                                    echo ' selected';
                                }
                                echo '>' . $text[776] . '</option>';
                                echo '<option value="1"';
                                if (1 == $krit1) {
                                    echo ' selected';
                                }
                                echo '>' . $text[777] . '</option>';
                                echo '<option value="2"';
                                if (2 == $krit1) {
                                    echo ' selected';
                                }
                                echo '>' . $text[778] . '</option>';
                                echo '<option value="3"';
                                if (3 == $krit1) {
                                    echo ' selected';
                                }
                                echo '>' . $text[779] . '</option>';
                                echo '<option value="4"';
                                if (4 == $krit1) {
                                    echo ' selected';
                                }
                                echo '>' . $text[780] . '</option>';
                                echo '<option value="5"';
                                if (5 == $krit1) {
                                    echo ' selected';
                                }
                                echo '>' . $text[727] . '</option>';
                                echo '<option value="6"';
                                if (6 == $krit1) {
                                    echo ' selected';
                                }
                                echo '>' . $text[771] . '</option>';
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="lmost5" width="20">&nbsp;</td>
                        <td class="lmost5" align="right">
                            <nobr><?php echo $text[775] . ' 2'; ?></nobr>
                        </td>
                        <td class="lmost5">
                            <select name="xkrit2" onChange="dolmoedit()">
                                <?php
                                echo '<option value="-1"';
                                if (-1 == $krit2) {
                                    echo ' selected';
                                }
                                echo '>' . $text[781] . '</option>';
                                echo '<option value="0"';
                                if (0 == $krit2) {
                                    echo ' selected';
                                }
                                echo '>' . $text[776] . '</option>';
                                echo '<option value="1"';
                                if (1 == $krit2) {
                                    echo ' selected';
                                }
                                echo '>' . $text[777] . '</option>';
                                echo '<option value="2"';
                                if (2 == $krit2) {
                                    echo ' selected';
                                }
                                echo '>' . $text[778] . '</option>';
                                echo '<option value="3"';
                                if (3 == $krit2) {
                                    echo ' selected';
                                }
                                echo '>' . $text[779] . '</option>';
                                echo '<option value="4"';
                                if (4 == $krit2) {
                                    echo ' selected';
                                }
                                echo '>' . $text[780] . '</option>';
                                echo '<option value="5"';
                                if (5 == $krit2) {
                                    echo ' selected';
                                }
                                echo '>' . $text[727] . '</option>';
                                echo '<option value="6"';
                                if (6 == $krit2) {
                                    echo ' selected';
                                }
                                echo '>' . $text[771] . '</option>';
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="lmost5" width="20">&nbsp;</td>
                        <td class="lmost5" align="right">
                            <nobr><?php echo $text[775] . ' 3'; ?></nobr>
                        </td>
                        <td class="lmost5">
                            <select name="xkrit3" onChange="dolmoedit()">
                                <?php
                                echo '<option value="-1"';
                                if (-1 == $krit3) {
                                    echo ' selected';
                                }
                                echo '>' . $text[781] . '</option>';
                                echo '<option value="0"';
                                if (0 == $krit3) {
                                    echo ' selected';
                                }
                                echo '>' . $text[776] . '</option>';
                                echo '<option value="1"';
                                if (1 == $krit3) {
                                    echo ' selected';
                                }
                                echo '>' . $text[777] . '</option>';
                                echo '<option value="2"';
                                if (2 == $krit3) {
                                    echo ' selected';
                                }
                                echo '>' . $text[778] . '</option>';
                                echo '<option value="3"';
                                if (3 == $krit3) {
                                    echo ' selected';
                                }
                                echo '>' . $text[779] . '</option>';
                                echo '<option value="4"';
                                if (4 == $krit3) {
                                    echo ' selected';
                                }
                                echo '>' . $text[780] . '</option>';
                                echo '<option value="5"';
                                if (5 == $krit3) {
                                    echo ' selected';
                                }
                                echo '>' . $text[727] . '</option>';
                                echo '<option value="6"';
                                if (6 == $krit3) {
                                    echo ' selected';
                                }
                                echo '>' . $text[771] . '</option>';
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="lmost4" colspan="3">
                            <nobr><?php echo $text[663]; ?></nobr>
                        </td>
                    </tr>
                    <tr>
                        <td class="lmost5" width="20">&nbsp;</td>
                        <td class="lmost5" align="right">
                            <nobr><?php echo $text[581]; ?></nobr>
                        </td>
                        <td class="lmost5">
                            <select name="xaktauswert" onChange="dolmoedit()">
                                <?php
                                echo '<option value="1"';
                                if (1 == $aktauswert) {
                                    echo ' selected';
                                }
                                echo '>' . $text[181] . '</option>';
                                echo '<option value="0"';
                                if (0 == $aktauswert) {
                                    echo ' selected';
                                }
                                echo '>' . $text[182] . '</option>';
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="lmost5" width="20">&nbsp;</td>
                        <td class="lmost5" align="right">
                            <nobr><?php echo $text[680]; ?></nobr>
                        </td>
                        <td class="lmost5">
                            <select name="xaktauswertges" onChange="dolmoedit()">
                                <?php
                                echo '<option value="1"';
                                if (1 == $aktauswertges) {
                                    echo ' selected';
                                }
                                echo '>' . $text[181] . '</option>';
                                echo '<option value="0"';
                                if (0 == $aktauswertges) {
                                    echo ' selected';
                                }
                                echo '>' . $text[182] . '</option>';
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="lmost4" colspan="3">
                            <nobr><?php echo $text[603]; ?></nobr>
                        </td>
                    </tr>
                    <tr>
                        <td class="lmost5" width="20">&nbsp;</td>
                        <td class="lmost5" align="right">
                            <nobr><?php echo $text[604]; ?></nobr>
                        </td>
                        <td class="lmost5">
                            <select name="ximmeralle" onChange="immerallechange()">
                                <?php
                                echo '<option value="1"';
                                if (1 == $immeralle) {
                                    echo ' selected';
                                }
                                echo '>' . $text[181] . '</option>';
                                echo '<option value="0"';
                                if (0 == $immeralle) {
                                    echo ' selected';
                                }
                                echo '>' . $text[182] . '</option>';
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                    <tr>
                        <td class="lmost5" width="20">&nbsp;</td>
                        <td class="lmost5" align="left" colspan="2">
                            <?php
                            echo $text[605] . '<br>';
                            $ftype = '.l98';
                            require 'lmo-tippnewdir.php';
                            ?></td>
                    </tr>
                    <tr>
                        <td class="lmost4" colspan="3" align="right">
                            <input class="lmoadminbut" type="submit" name="best" value="<?php echo $text[188]; ?>">
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
                    echo "<td class=\"lmost2\" align=\"center\"><a href=\"javascript:chklmolink('" . $adda . "');\" title=\"" . $text[563] . '">' . $text[563] . '</a></td>';
                    echo "<td class=\"lmost2\" align=\"center\"><a href=\"javascript:chklmolink('" . $adde . "');\" title=\"" . $text[665] . '">' . $text[665] . '</a></td>';
                    echo "<td class=\"lmost2\" align=\"center\"><a href=\"javascript:chklmolink('" . $addu . "');\" title=\"" . $text[614] . '">' . $text[614] . '</a></td>';
                    echo '<td class="lmost1" align="center">' . $text[86] . '</td>';
                    ?>
                </tr>
            </table>
        </td>
    </tr>
</table>
