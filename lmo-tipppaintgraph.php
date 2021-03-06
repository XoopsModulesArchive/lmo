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
if ($max < 1) {
    $max = 10;

    $min = 1;
} else {
    $min = $max;
}

if ($kmodus < 4) {
    $linie = preg_split('[,]', $pgplatz1);

    for ($i = 0; $i < count($linie) - 1; $i++) {
        if (mb_strlen($linie[$i]) > 0) {
            if ($linie[$i] < $min) {
                $min = $linie[$i];
            }
        }
    }

    if (2 == $pganz) {
        $lini2 = preg_split('[,]', $pgplatz2);

        for ($i = 0; $i < count($lini2) - 1; $i++) {
            if (mb_strlen($lini2[$i]) > 0) {
                if ($lini2[$i] < $min) {
                    $min = $lini2[$i];
                }
            }
        }
    }
}
if ($kmodus > 2) {
    $liniea = preg_split('[,]', $pgplatz1a);

    for ($i = 0; $i < count($liniea) - 1; $i++) {
        if (mb_strlen($liniea[$i]) > 0) {
            if ($liniea[$i] < $min) {
                $min = $liniea[$i];
            }
        }
    }

    if (2 == $pganz) {
        $lini2a = preg_split('[,]', $pgplatz2a);

        for ($i = 0; $i < count($lini2a) - 1; $i++) {
            if (mb_strlen($lini2a[$i]) > 0) {
                if ($lini2a[$i] < $min) {
                    $min = $lini2a[$i];
                }
            }
        }
    }
}

if ($kmodus < 4) {
    for ($i = 0; $i < count($linie) - 1; $i++) {
        if (mb_strlen($linie[$i]) > 0) {
            if (1 == $kmodus) {
                $linie[$i] = $max - $linie[$i];
            } else {
                $linie[$i] -= $min;
            }
        }
    }

    if (2 == $pganz) {
        for ($i = 0; $i < count($lini2) - 1; $i++) {
            if (mb_strlen($lini2[$i]) > 0) {
                if (1 == $kmodus) {
                    $lini2[$i] = $max - $lini2[$i];
                } else {
                    $lini2[$i] -= $min;
                }
            }
        }
    }
}
if ($kmodus > 2) {
    for ($i = 0; $i < count($liniea) - 1; $i++) {
        if (mb_strlen($liniea[$i]) > 0) {
            $liniea[$i] -= $min;
        }
    }

    if (2 == $pganz) {
        for ($i = 0; $i < count($lini2a) - 1; $i++) {
            if (mb_strlen($lini2a[$i]) > 0) {
                $lini2a[$i] -= $min;
            }
        }
    }
}

if (($max - $min) > 0) {
    $khoch = round(240 / ($max - $min));
} else {
    $khoch = 12;
}

if ($khoch > 12) {
    $khoch = 12;
}
if ($khoch < 1) {
    $khoch = 1;
} elseif (($max - $min) < 21) {
    $khoch = 12;
}

$hoch = (($max - $min + 1) * $khoch + 12) + 47;
$breit = (($pgst + 1) * 12) + 35;
$image = imagecreate($breit, $hoch);
imageinterlace($image, 1);
$farbe_body = imagecolorallocate($image, 255, 255, 255);
$farbe_a = imagecolorallocate($image, 0, 0, 0);
$farbe_b = imagecolorallocate($image, 192, 192, 192);
$farbe_c = imagecolorallocate($image, 0, 0, 255); // blau
$farbe_c1 = imagecolorallocate($image, 0, 0, 128);
$farbe_d = imagecolorallocate($image, 255, 0, 0); // rot
$farbe_d1 = imagecolorallocate($image, 128, 0, 0);
if ($kmodus > 1) {
    $farbe_e = imagecolorallocate($image, 234, 237, 13);  //Gold
    $farbe_f = imagecolorallocate($image, 223, 215, 215); //Silber
    $farbe_g = imagecolorallocate($image, 218, 173, 66);  //Bronze
}
imagestring($image, 2, 28, 28 + (($max - $min + 1) * $khoch + 12), $pgtext1, $farbe_a);
imagestringup($image, 2, 4, $hoch - 28, $pgtext2, $farbe_a);
for ($i = $min; $i <= $max; $i++) {
    $j = (string)$i;

    if (1 == $kmodus) {
        $j = $max - $j + $min;
    }

    if ($j < 10) {
        $j = '0' . $j;
    }

    if (0 == ($i - $min) % (13 - $khoch)) {
        imagestring($image, 1, 18, 24 + ($khoch / 2) + (($i - $min) * $khoch), $j, $farbe_a);

        imagestring($image, 1, 20 + (($pgst + 1) * 12), 24 + ($khoch / 2) + (($i - $min) * $khoch), $j, $farbe_a);
    }
}

for ($i = 1; $i <= $pgst; $i++) {
    $j = (string)$i;

    if ($i < 10) {
        $j = '0' . $j;
    }

    imagestring($image, 1, 19 + ($i * 12), 18, $j, $farbe_a);

    imagestring($image, 1, 19 + ($i * 12), 18 + (($max - $min + 1) * $khoch + 12), $j, $farbe_a);
}
for ($i = $min; $i <= $max; $i++) {
    imagerectangle($image, 29, 28 + (($i - $min) * $khoch), 17 + (($pgst + 1) * 12), 28 + $khoch + (($i - $min) * $khoch), $farbe_b);
}
for ($i = 0; $i < $pgst; $i++) {
    imagerectangle($image, 29 + ($i * 12), 28, 41 + ($i * 12), 16 + (($max - $min + 1) * $khoch + 12), $farbe_b);
}
$j = 1;
if ($kmodus > 1 && $khoch > 1) {
    for ($i = $min; $i <= $max; $i++) {
        if (1 == $i) {
            for ($k = 1; $k <= $pgst; $k++) {
                imagefill($image, 20 + ($k * 12), 29 + (($i - $min) * $khoch), $farbe_e);
            }
        }

        if (2 == $i) {
            for ($k = 1; $k <= $pgst; $k++) {
                imagefill($image, 20 + ($k * 12), 29 + (($i - $min) * $khoch), $farbe_f);
            }
        }

        if (3 == $i) {
            for ($k = 1; $k <= $pgst; $k++) {
                imagefill($image, 20 + ($k * 12), 29 + (($i - $min) * $khoch), $farbe_g);
            }
        }
    }
}
imagestring($image, 3, 3, 1, stripslashes($pgteam1), $farbe_c);
if (2 == $pganz) {
    imagestring($image, 3, $breit - imagefontwidth(3) * mb_strlen(stripslashes($pgteam2)) - 2, 1, stripslashes($pgteam2), $farbe_d);
}
for ($i = 1; $i < $pgst; $i++) {
    if ($kmodus < 4) {
        if (mb_strlen($linie[$i]) > 0 && mb_strlen($linie[$i - 1]) > 0) {
            imageline($image, 24 + ($i * 12), 28 + $khoch / 2 + ($linie[$i - 1] * $khoch), 24 + (($i + 1) * 12), 28 + $khoch / 2 + ($linie[$i] * $khoch), $farbe_c);

            imageline($image, 23 + ($i * 12), 28 + $khoch / 2 + ($linie[$i - 1] * $khoch), 23 + (($i + 1) * 12), 28 + $khoch / 2 + ($linie[$i] * $khoch), $farbe_c);

            imageline($image, 24 + ($i * 12), 29 + $khoch / 2 + ($linie[$i - 1] * $khoch), 24 + (($i + 1) * 12), 29 + $khoch / 2 + ($linie[$i] * $khoch), $farbe_c);

            imageline($image, 23 + ($i * 12), 29 + $khoch / 2 + ($linie[$i - 1] * $khoch), 23 + (($i + 1) * 12), 29 + $khoch / 2 + ($linie[$i] * $khoch), $farbe_c);
        }
    }

    if ($kmodus > 2) {
        if (mb_strlen($liniea[$i]) > 0 && mb_strlen($liniea[$i - 1]) > 0) {
            imageline($image, 24 + ($i * 12), 28 + $khoch / 2 + ($liniea[$i - 1] * $khoch), 24 + (($i + 1) * 12), 28 + $khoch / 2 + ($liniea[$i] * $khoch), $farbe_c1);

            imageline($image, 23 + ($i * 12), 28 + $khoch / 2 + ($liniea[$i - 1] * $khoch), 23 + (($i + 1) * 12), 28 + $khoch / 2 + ($liniea[$i] * $khoch), $farbe_c1);

            imageline($image, 24 + ($i * 12), 29 + $khoch / 2 + ($liniea[$i - 1] * $khoch), 24 + (($i + 1) * 12), 29 + $khoch / 2 + ($liniea[$i] * $khoch), $farbe_c1);

            imageline($image, 23 + ($i * 12), 29 + $khoch / 2 + ($liniea[$i - 1] * $khoch), 23 + (($i + 1) * 12), 29 + $khoch / 2 + ($liniea[$i] * $khoch), $farbe_c1);
        }
    }

    if (2 == $pganz) {
        if ($kmodus < 4) {
            if (mb_strlen($lini2[$i]) > 0 && mb_strlen($lini2[$i - 1]) > 0) {
                imageline($image, 24 + ($i * 12), 28 + $khoch / 2 + ($lini2[$i - 1] * $khoch), 24 + (($i + 1) * 12), 28 + $khoch / 2 + ($lini2[$i] * $khoch), $farbe_d);

                imageline($image, 23 + ($i * 12), 28 + $khoch / 2 + ($lini2[$i - 1] * $khoch), 23 + (($i + 1) * 12), 28 + $khoch / 2 + ($lini2[$i] * $khoch), $farbe_d);

                imageline($image, 24 + ($i * 12), 29 + $khoch / 2 + ($lini2[$i - 1] * $khoch), 24 + (($i + 1) * 12), 29 + $khoch / 2 + ($lini2[$i] * $khoch), $farbe_d);

                imageline($image, 23 + ($i * 12), 29 + $khoch / 2 + ($lini2[$i - 1] * $khoch), 23 + (($i + 1) * 12), 29 + $khoch / 2 + ($lini2[$i] * $khoch), $farbe_d);
            }
        }

        if ($kmodus > 2) {
            if (mb_strlen($lini2a[$i]) > 0 && mb_strlen($lini2a[$i - 1]) > 0) {
                imageline($image, 24 + ($i * 12), 28 + $khoch / 2 + ($lini2a[$i - 1] * $khoch), 24 + (($i + 1) * 12), 28 + $khoch / 2 + ($lini2a[$i] * $khoch), $farbe_d1);

                imageline($image, 23 + ($i * 12), 28 + $khoch / 2 + ($lini2a[$i - 1] * $khoch), 23 + (($i + 1) * 12), 28 + $khoch / 2 + ($lini2a[$i] * $khoch), $farbe_d1);

                imageline($image, 24 + ($i * 12), 29 + $khoch / 2 + ($lini2a[$i - 1] * $khoch), 24 + (($i + 1) * 12), 29 + $khoch / 2 + ($lini2a[$i] * $khoch), $farbe_d1);

                imageline($image, 23 + ($i * 12), 29 + $khoch / 2 + ($lini2a[$i - 1] * $khoch), 23 + (($i + 1) * 12), 29 + $khoch / 2 + ($lini2a[$i] * $khoch), $farbe_d1);
            }
        }
    }
}
header('Content-Type: image/png');
imagepng($image);
