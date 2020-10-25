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
if ('' != $ftype) {
    if (!isset($iptype)) {
        $iptype = '';
    }

    if (!isset($lmotipperok)) {
        $lmotipperok = 0;
    }

    if (!isset($liga)) {
        $liga = '';
    }

    $verz = opendir(mb_substr($dirliga, 0, -1));

    $dummy = [''];

    while ($files = readdir($verz)) {
        if (mb_strtolower(mb_substr($files, -4)) == $ftype) {
            $dummy[] = $files;
        }
    }

    closedir($verz);

    array_shift($dummy);

    sort($dummy);

    $tt0 = '';

    $tt1 = '';

    $i = 0;

    $j = 0;

    if (!isset($lmouserok)) {
        $lmouserok = 0;
    }

    for ($k = 0, $kMax = count($dummy); $k < $kMax; $k++) {
        $files = $dummy[$k];

        if (1 != $lmouserok) {
            $ftest = 1;
        } elseif (1 == $lmouserok) {
            $ftest = 0;

            $ftest1 = preg_split('[,]', $lmouserfile);

            if (isset($ftest1)) {
                for ($u = 0, $uMax = count($ftest1); $u < $uMax; $u++) {
                    if ($ftest1[$u] . '.l98' == $files) {
                        $ftest = 1;
                    }
                }
            }
        }

        if (1 == $ftest) {
            $sekt = '';

            $t0 = '';

            $t1 = '';

            $t4 = '';

            $t2 = $text[2];

            $datei = fopen($dirliga . $files, 'rb');

            while (!feof($datei)) {
                $zeile = fgets($datei, 1000);

                $zeile = rtrim($zeile);

                $zeile = trim($zeile);

                if (('[' == mb_substr($zeile, 0, 1)) && (']' == mb_substr($zeile, -1))) {
                    $sekt = mb_substr($zeile, 1, -1);
                } elseif ((false !== mb_strpos($zeile, '=')) && (';' != mb_substr($zeile, 0, 1)) && ('Options' == $sekt)) {
                    $schl = mb_substr($zeile, 0, mb_strpos($zeile, '='));

                    $wert = mb_substr($zeile, mb_strpos($zeile, '=') + 1);

                    if ('Name' == $schl) {
                        $t0 = $wert;
                    }

                    if ('Actual' == $schl) {
                        $t1 = $wert;
                    }

                    if ('Teams' == $schl) {
                        $t4 = $wert;
                    }

                    if ('Rounds' == $schl) {
                        $anzst = $wert;
                    }

                    if ('Type' == $schl) {
                        if ('1' == $wert) {
                            $t2 = $text[370];
                        }
                    }

                    if (('' != $t0) && ('' != $t1) && ('' != $t4)) {
                        break;
                    }
                }
            }

            fclose($datei);

            if ('' == $t0) {
                $j++;

                $t0 = 'Unbenannte Liga ' . $j;
            }

            if ($t2 == $text[370]) {
                $anzst = mb_strlen(decbin($t4 - 1));
            }

            $ftest = 0;

            $ftest1 = '';

            $ftest1 = preg_split('[,]', $ligenzutippen);

            if (isset($ftest1)) {
                for ($u = 0, $uMax = count($ftest1); $u < $uMax; $u++) {
                    if ($ftest1[$u] == mb_substr($files, 0, -4)) {
                        $ftest = 1;
                    }
                }
            }

            if (('tipp' != $action && 'tipp' != $todo) || 1 == $ftest || 1 == $immeralle) {
                if ('delligen' != $todo || ((1 == $ftest || 1 == $immeralle) && true === file_exists($dirtipp . mb_substr($files, 0, -4) . '_' . $lmotippername . '.tip'))) {
                    if ('newligen' != $todo || ((1 == $ftest || 1 == $immeralle) && false === file_exists($dirtipp . mb_substr($files, 0, -4) . '_' . $lmotippername . '.tip'))) {
                        if ('newtipper' != $todo || 1 == $ftest || 1 == $immeralle) {
                            if ('tippemail' != $todo || 1 == $ftest || 1 == $immeralle) {
                                if ('tippuseredit' != $todo || 1 == $ftest || 1 == $immeralle) {
                                    $i++;

                                    if ($lmotipperok > 0 || 'admin' == $action || 'newtipper' == $todo) {
                                        if ('reminder' == $iptype) { ?>
                                            <tr>
                                                <td class="lmost5">
                                                    <input type="radio" name="liganr" value="<?php echo $i; ?>" id="<?php echo $i + 3; ?>" <?php if (('' == $liga && 1 == $i) || $liga == $files) {
                                            echo 'checked';
                                        } ?> onClick="if(emailart[2].checked==false)changetextarea(1);emailart[2].checked=true;">
                                                    <label for="<?php echo $i + 3; ?>"><?php echo $t0; ?></label></td>
                                                <input type="hidden" name="liga1[]" value="<?php echo $files; ?>">
                                                <td class="lmost5">
                                                    <select class="lmoadminein" name="st1[]" onChange="if(emailart[2].checked==false)changetextarea(1);emailart[2].checked=true;liganr[<?php echo $i - 1; ?>].checked=true;">
                                                        <?php
                                                        if ($liga == $files) {
                                                            if ($st > 0) {
                                                                $t1 = $st;
                                                            }
                                                        }
                                                        echo '<option value="0"';
                                                        if (0 == $t1) {
                                                            echo ' selected';
                                                        }
                                                        echo '>'; // alle Spieltage
                                                        if ($t2 == $text[2]) {
                                                            echo $text[728];
                                                        } else {
                                                            echo $text[729];
                                                        }
                                                        echo '</option>';

                                                        for ($y = 1; $y <= $anzst; $y++) {
                                                            echo '<option value="' . $y . '"';

                                                            if ($y == $t1) {
                                                                echo ' selected';
                                                            }

                                                            echo '>';

                                                            if ($t2 == $text[2]) {
                                                                echo $y . '. ' . $text[2];
                                                            } else {
                                                                $t5 = mb_strlen(decbin($t4 - 1));

                                                                if ($y == $t5) {
                                                                    echo $text[374];
                                                                } elseif ($y == $t5 - 1) {
                                                                    echo $text[373];
                                                                } elseif ($y == $t5 - 2) {
                                                                    echo $text[372];
                                                                } elseif ($y == $t5 - 3) {
                                                                    echo $text[371];
                                                                } elseif ($y == $t5 - 4) {
                                                                    echo $text[370];
                                                                } else {
                                                                    echo $y . '. ' . $t2;
                                                                }
                                                            }

                                                            echo '</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                </td>
                                            </tr>
                                        <?php }

                                        if ('einsicht' == $iptype || 'auswert' == $iptype) {
                                            ?>
                                            <tr>
                                                <td class="lmost5" width="20">&nbsp;</td>
                                                <td class="lmost5">
                                                    <?php echo $t0; ?>
                                                </td>
                                                <td class="lmost5" align="right">
                                                    <form name="lmoedit" action="<?php echo $PHP_SELF; ?>" method="post">
                                                        <input type="hidden" name="action" value="admin">
                                                        <input type="hidden" name="todo" value="tipp">
                                                        <input type="hidden" name="save" value="<?php if ('einsicht' == $iptype) {
                                                echo '3';
                                            } else {
                                                echo '2';
                                            } ?>">
                                                        <input type="hidden" name="liga" value="<?php echo mb_substr($files, 0, -4); ?>">
                                                        <select class="lmoadminein" name="st">
                                                            <?php
                                                            if ($liga == mb_substr($files, 0, -4) && ((2 == $save && 'auswert' == $iptype) || (3 == $save && 'einsicht' == $iptype))) {
                                                                if ($st >= 0) {
                                                                    $t1 = $st;
                                                                }
                                                            }

                                            if ('auswert' == $iptype) {
                                                echo '<option value="0"';

                                                if (0 == $t1) {
                                                    echo ' selected';
                                                }

                                                echo '>'; // alle Spieltage

                                                if ($t2 == $text[2]) {
                                                    echo $text[728];
                                                } else {
                                                    echo $text[729];
                                                }

                                                echo '</option>';
                                            }

                                            for ($y = 1; $y <= $anzst; $y++) {
                                                echo '<option value="' . $y . '"';

                                                if ($y == $t1) {
                                                    echo ' selected';
                                                }

                                                echo '>';

                                                if ($t2 == $text[2]) { // Spieltage
                                                    echo $y . '. ' . $text[2];
                                                } else { // Runden
                                                    $t5 = mb_strlen(decbin($t4 - 1));

                                                    if ($y == $t5) {
                                                        echo $text[374];
                                                    } elseif ($y == $t5 - 1) {
                                                        echo $text[373];
                                                    } elseif ($y == $t5 - 2) {
                                                        echo $text[372];
                                                    } elseif ($y == $t5 - 3) {
                                                        echo $text[371];
                                                    } elseif ($y == $t5 - 4) {
                                                        echo $text[370];
                                                    } else {
                                                        echo $y . '. ' . $t2;
                                                    }
                                                }

                                                echo '</option>';
                                            } ?>
                                                        </select>
                                                        <?php echo $text[664]; //Tipper

                                            $start1 = 1;

                                            if ($liga == mb_substr($files, 0, -4) && ((2 == $save && 'auswert' == $iptype) || (3 == $save && 'einsicht' == $iptype))) {
                                                if (isset($start)) {
                                                    $start1 = $start;
                                                }
                                            } ?>
                                                        <input class="lmoadminein" type="text" name="start" size="2" maxlength="4" value="<?php echo $start1; ?>">
                                                        <?php echo $text[4]; //bis

                                            $verz1 = opendir($dirtipp);

                                            $dummy1 = [''];

                                            while ($tipfiles = readdir($verz1)) {
                                                if (mb_strtolower(mb_substr($tipfiles, 0, mb_strlen(mb_substr($files, 0, -4)))) == mb_strtolower(mb_substr($files, 0, -4)) && '.tip' == mb_strtolower(mb_substr($tipfiles, -4))) {
                                                    $dummy1[] = $tipfiles;
                                                }
                                            }

                                            closedir($verz1);

                                            array_shift($dummy1);

                                            $ende1 = count($dummy1);

                                            if ($liga == mb_substr($files, 0, -4) && ((2 == $save && 'auswert' == $iptype) || (3 == $save && 'einsicht' == $iptype))) {
                                                if (isset($ende)) {
                                                    $ende1 = $ende;
                                                }
                                            } ?>
                                                        <input class="lmoadminein" type="text" name="ende" size="2" maxlength="4" value="<?php echo $ende1; ?>">
                                                        <input class="lmoadminbut" type="submit" name="best" value="<?php if ('einsicht' == $iptype) {
                                                echo $text[656];
                                            } else {
                                                echo $text[558];
                                            } ?>">
                                                    </form>
                                                </td>
                                            </tr>
                                            <?php
                                        } elseif ('reminder' != $iptype) {
                                            $checked = 0;

                                            if (('newtipper' == $todo || 'tippuseredit' == $todo) && '' != $xtipperligen) {
                                                $checked = 0;

                                                foreach ($xtipperligen as $key => $value) {
                                                    if (mb_substr($files, 0, -4) == $value) {
                                                        $checked = 1;
                                                    }
                                                }
                                            } elseif ('newtipper' == $todo) {
                                                $checked = 1;
                                            } ?>
                                            <input type="checkbox" name="xtipperligen[]" value="<?php echo mb_substr($files, 0, -4) ?>"
                                                <?php
                                                if (('newtipper' == $todo || 'tippuseredit' == $todo) && 1 == $checked) {
                                                    echo 'checked';
                                                } elseif ('tippuseredit' == $todo && true === file_exists($dirtipp . mb_substr($files, 0, -4) . '_' . $nick . '.tip')) {
                                                    echo 'checked';
                                                }

                                            if ('tippoptions' == $todo && (1 == $ftest || 1 == $immeralle)) {
                                                echo 'checked';
                                            }

                                            if ('tippoptions' == $todo) {
                                                echo ' onClick="dolmoedit()"';
                                            }

                                            if ('tippoptions' == $todo && 1 == $immeralle) {
                                                echo ' disabled';
                                            } ?>>
                                            <?php echo $t0 ?><br>

                                            <?php
                                        }
                                    }

                                    $tt1 .= $dummy[$k] . '|';

                                    $tt0 .= $t0 . '|';
                                }
                            }
                        }
                    }
                }
            }
        }
    }

    if (0 == $i) {
        echo '<li>[' . $text[223] . ']</li>';
    }
}
?>
