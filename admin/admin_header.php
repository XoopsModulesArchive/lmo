<?php

include '../../../mainfile.php';
require_once XOOPS_ROOT_PATH . '/class/xoopsmodule.php';

if ($xoopsUser) {
    $xoopsModule = XoopsModule::getByDirname('lmo');

    if ($xoopsUser->isAdmin($xoopsModule->mid())) {
        require XOOPS_ROOT_PATH . '/include/cp_functions.php';
    } else {
        $sql = 'SELECT * FROM ' . $db->prefix('lmo_helfer') . ' WHERE uid_lmo = ' . $xoopsUser->uid() . '';

        $result = $db->query($sql);

        while (false !== ($val = $db->fetch_array($result))) {
            if ($val[uid_lmo] != $xoopsUser->uid()) {
                redirect_header(XOOPS_URL, 3, _NOPERM);

                exit();
            }
        }

        require XOOPS_ROOT_PATH . '/modules/' . $xoopsModule->dirname() . '/include/cp_functions.php';

        require XOOPS_ROOT_PATH . '/modules/lmo/include/cp_functions.php';
    }
} else {
    redirect_header(XOOPS_URL . '/', 3, _NOPERM);

    exit();
}

xoops_cp_header();
if (file_exists(XOOPS_ROOT_PATH . '/modules/' . $xoopsModule->dirname() . '/language/' . $xoopsConfig['language'] . '/admin.php')) {
    require XOOPS_ROOT_PATH . '/modules/' . $xoopsModule->dirname() . '/language/' . $xoopsConfig['language'] . '/admin.php';
} else {
    require XOOPS_ROOT_PATH . '/modules/' . $xoopsModule->dirname() . '/language/german/admin.php';
}
