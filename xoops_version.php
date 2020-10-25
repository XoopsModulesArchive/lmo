<?php

$modversion['name'] = _MI_LMO_001;
$modversion['version'] = 2.2;
$modversion['description'] = _MI_LMO_DESC;
$modversion['credits'] = '';
$modversion['author'] = 'Frank Hollwitz<br><br>powered for XOOPS RC3<br>by Hans Marx<br>webmaster@bama-webdesign.de';
$modversion['help'] = 'modules/lmo/help/help.htm';
$modversion['license'] = 'GPL see LICENSE';
$modversion['official'] = 1;
$modversion['image'] = 'images/lmo_slogo.gif';
$modversion['dirname'] = 'lmo';

$modversion['sqlfile']['mysql'] = 'sql/mysql.sql';
$modversion['tables'][0] = 'lmo_conf';
$modversion['tables'][1] = 'lmo_helfer';

// Admin things
$modversion['hasAdmin'] = 1;
$modversion['adminindex'] = 'lmoadmin.php';
$modversion['adminmenu'] = 'admin/menu.php';

// Menu
$modversion['hasMain'] = 1;
$modversion['sub'][1]['name'] = _MI_LMO_SMNAME1;
$modversion['sub'][1]['url'] = 'index.php?action=tipp';
