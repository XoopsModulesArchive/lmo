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
function tipppunkte($gta0, $gtb0, $ga0, $gb0, $msieg, $msp, $text0, $text1, $jkspfaktor0, $mtipp)
{// wieviel Punkte gibts für den Tipp
    global $tippmodus;

    global $entscheidungnv;

    global $entscheidungie;

    global $rergebnis;

    global $rtendenzdiff;

    global $rtendenz;

    global $rtor;

    global $rtendenztor;

    global $rtendenzremis;

    global $rremis;

    global $gtpunkte;

    global $showzus;

    if (1 == $showzus) {
        if (1 == $tippmodus) {
            global $punkte1;

            global $punkte2;

            global $punkte3;

            global $punkte4;
        }

        global $punkte5;

        global $punkte6;
    }

    if (1 == $mtipp) {
        $punktespiel = -2;
    } // Spiel nicht werten
    elseif (1 == $tippmodus) { // Ergebnis-Tippmodus
        if (0 == $msieg) {
            if ($msp == $text0 && 1 == $entscheidungnv) {
                if ($gtb0 == $gta0) {
                    if (1 == $rtendenzremis) {
                        $punktespiel = $rtendenz;

                        if (1 == $showzus) {
                            $punkte3++;
                        }
                    } else {
                        $punktespiel = $rtendenzdiff;

                        if (1 == $showzus) {
                            $punkte2++;
                        }
                    }
                } else {
                    $punktespiel = 0;
                }
            } elseif ($msp == $text1 && 1 == $entscheidungie) {
                if ($gtb0 == $gta0) {
                    if (1 == $rtendenzremis) {
                        $punktespiel = $rtendenz;

                        if (1 == $showzus) {
                            $punkte3++;
                        }
                    } else {
                        $punktespiel = $rtendenzdiff;

                        if (1 == $showzus) {
                            $punkte2++;
                        }
                    }
                } else {
                    $punktespiel = 0;
                }
            } elseif ($gta0 == $ga0 && $gtb0 == $gb0) {
                $punktespiel = $rergebnis;

                if (1 == $showzus) {
                    $punkte1++;
                }
            } elseif ($ga0 == $gb0 && $gta0 == $gtb0 && 1 == $rtendenzremis) { // richtiger 0-Tipp
                $punktespiel = $rtendenz;

                if (1 == $showzus) {
                    $punkte3++;
                }
            } elseif ($gtb0 - $gta0 == $gb0 - $ga0) {
                $punktespiel = $rtendenzdiff;

                if (1 == $showzus) {
                    $punkte2++;
                }
            } // richtige Tendenz und Tordiff

            elseif (($gtb0 > $gta0 && $gb0 > $ga0) || ($gtb0 < $gta0 && $gb0 < $ga0)) {
                $punktespiel = $rtendenz;

                if (1 == $showzus) {
                    $punkte3++;
                }

                if (1 == $rtendenztor && ($gta0 == $ga0 || $gtb0 == $gb0)) {
                    $punktespiel += $rtor;

                    if (1 == $showzus) {
                        $punkte4++;
                    }
                }
            } elseif ($gta0 == $ga0 || $gtb0 == $gb0) {
                $punktespiel = $rtor;

                if (1 == $showzus) {
                    $punkte4++;
                }
            } else {
                $punktespiel = 0;
            }
        } elseif (2 == $gtpunkte && (1 == $msieg || 2 == $msieg || 3 == $msieg)) { // GT-Entscheidung nicht werten
            $punktespiel = -1;
        } elseif (1 == $msieg) { // GT-Entscheidung
            if ($gtb0 - $gta0 < 0) {
                if (1 == $gtpunkte) {
                    $punktespiel = $rtendenz;

                    if (1 == $showzus) {
                        $punkte3++;
                    }
                } else {
                    $punktespiel = $rtendenzdiff;

                    if (1 == $showzus) {
                        $punkte2++;
                    }
                }
            } else {
                $punktespiel = 0;
            }
        } elseif (2 == $msieg) { // GT-Entscheidung
            if ($gtb0 - $gta0 > 0) {
                if (1 == $gtpunkte) {
                    $punktespiel = $rtendenz;

                    if (1 == $showzus) {
                        $punkte3++;
                    }
                } else {
                    $punktespiel = $rtendenzdiff;

                    if (1 == $showzus) {
                        $punkte2++;
                    }
                }
            } else {
                $punktespiel = 0;
            }
        } elseif (3 == $msieg) { // GT-Entscheidung beidseitiges Erg.
            if (0 == $gtb0 - $gta0) {
                if (1 == $gtpunkte) {
                    $punktespiel = $rtendenz;

                    if (1 == $showzus) {
                        $punkte3++;
                    }
                } else {
                    $punktespiel = $rtendenzdiff;

                    if (1 == $showzus) {
                        $punkte2++;
                    }
                }
            } else {
                $punktespiel = 0;
            }
        } else {
            $punktespiel = -1;
        } // Ergebnis noch nicht eingetragen
    } elseif (0 == $tippmodus) { // Tendenz-Tippmodus
        if (0 == $msieg) {
            if ($msp == $text0 && 1 == $entscheidungnv) {
                if ($gtb0 == $gta0) {
                    $punktespiel = 1;
                } else {
                    $punktespiel = 0;
                }
            } elseif ($msp == $text1 && 1 == $entscheidungie) {
                if ($gtb0 == $gta0) {
                    $punktespiel = 1;
                } else {
                    $punktespiel = 0;
                }
            } elseif (($gtb0 > $gta0 && $gb0 > $ga0) || ($gtb0 < $gta0 && $gb0 < $ga0) || ($gtb0 == $gta0 && $gb0 == $ga0)) {
                $punktespiel = 1;
            } else {
                $punktespiel = 0;
            }
        } elseif (2 == $gtpunkte && (1 == $msieg || 2 == $msieg || 3 == $msieg)) { // GT-Entscheidung nicht werten
            $punktespiel = -1;
        } elseif (1 == $msieg) { // GT-Entscheidung
            if ($gtb0 - $gta0 < 0) {
                $punktespiel = 1;
            } else {
                $punktespiel = 0;
            }
        } elseif (2 == $msieg) { // GT-Entscheidung
            if ($gtb0 - $gta0 > 0) {
                $punktespiel = 1;
            } else {
                $punktespiel = 0;
            }
        } elseif (3 == $msieg) { // GT-Entscheidung beidseitiges Erg.
            if (0 == $gtb0 - $gta0) {
                $punktespiel = 1;
            } else {
                $punktespiel = 0;
            }
        } else {
            $punktespiel = -1;
        }
    }

    if ($rremis > 0 && $punktespiel > 0 && $gtb0 == $gta0 && $gb0 == $ga0) {
        $punktespiel += $rremis;

        if (1 == $showzus) {
            $punkte5++;
        }
    }

    if ($jkspfaktor0 > 1 && $punktespiel > 0) {
        if (1 == $showzus) {
            $punkte6 += $punktespiel * $jkspfaktor0 - $punktespiel;
        }

        $punktespiel *= $jkspfaktor0;
    }

    //  echo $gta0.$gtb0.$ga0.$gb0."->".$punktespiel."<br>";

    return $punktespiel;
}
