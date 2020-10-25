<?php

// Copyright (C) 2002 by Hans Marx
// webmaster@bama-webdesign.de / http://www.bama-webdesign.de

function getHelferList()
{
    global $xoopsConfig, $db, $myts;

    $sql = 'SELECT * FROM ' . $db->prefix('ranks') . " WHERE rank_title = 'Redakteur'";

    if (!$result = $GLOBALS['xoopsDB']->queryF($sql)) {
        CloseTable();

        CloseTable();

        echo '<br><br><br>';

        echo '<b>' . _LMO_NOTLIGAUPDATE . '</b>';

        CloseTable();

        xoops_cp_footer();

        exit();
    } elseif (!$myrow = $db->fetch_array($result)) {
        CloseTable();

        CloseTable();

        echo '<br><br><br>';

        echo '<b>' . _LMO_NOTLIGAUPDATE . '</b>';

        echo '<br><br><br>';

        echo "<form action='" . XOOPS_URL . "/modules/system/admin.php' method='POST'>";

        echo "<input type='hidden' name='rank_title' value='Redakteur'>
			<input type='hidden' name='rank_min' value='-1'>
			<input type='hidden' name='rank_max' value='-1'>
			<input type='hidden' name='rank_image' value=''>
			<input type='hidden' name='rank_special' value='1'>
			<input type='hidden' name='op' value='RankForumAdd'>
    		<input type='hidden' name='fct' value='userrank'>";

        echo "<input type=submit value='" . _LMO_ADMINNEWRANK . "'></form>";

        CloseTable();

        xoops_cp_footer();

        exit();
    }

    $result = $db->query($sql);

    $rankid = $myrow['rank_id'];

    $ret = [];

    $sql = 'SELECT * FROM ' . $db->prefix('users') . " WHERE rank = $rankid";

    $result = $db->query($sql);

    if (!$result = $db->query($sql)) {
        CloseTable();

        CloseTable();

        echo '<br><br><br>';

        echo _LMO_NOTUSERUPDATE;

        CloseTable();

        xoops_cp_footer();

        exit();
    } elseif (!$myrow = $db->fetch_array($result)) {
        CloseTable();

        CloseTable();

        echo '<br><br><br>';

        echo _LMO_NOTUSERUPDATE;

        echo '<br><br><br>';

        echo "<form action='" . XOOPS_URL . "/modules/system/admin.php?fct=users' method='POST'>";

        echo "<input type=submit value='" . _LMO_USEREDIT . "'></form>";

        CloseTable();

        xoops_cp_footer();

        exit();
    }

    $result = $db->query($sql);

    while (false !== ($myrow = $db->fetch_array($result))) {
        $ret[$myrow['uid']] = htmlspecialchars($myrow['uname'], ENT_QUOTES | ENT_HTML5);
    }

    return $ret;
}

function getLigenListAsArray($dirliga, $ftype = '.l98')
{
    global $xoopsConfig, $db, $myts;

    $filelist = [];

    if ('' != $ftype) {
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

        $i = 0;

        $j = 0;

        for ($k = 0, $kMax = count($dummy); $k < $kMax; $k++) {
            $files = $dummy[$k];

            $sekt = '';

            $t0 = '';

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
                }
            }

            fclose($datei);

            $i++;

            if ('' == $t0) {
                $j++;

                $t0 = 'Unbenannte Liga ' . $j;
            }

            $filelist[$i]['bez'] = $t0;

            $filelist[$i]['files'] = mb_substr($files, 0, -4);
        }
    }

    return $filelist;
}

function myButTextForm($url, $value, $option = '')
{
    return "<form action='$url' method='post'><input type='submit' value='$value'>" . $option . "</form>\n";
}
