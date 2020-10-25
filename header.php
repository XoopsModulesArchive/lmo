<?php

include '../../mainfile.php';

if (file_exists(XOOPS_ROOT_PATH . '/modules/' . $xoopsModule->dirname() . '/language/' . $xoopsConfig['language'] . '/main.php')) {
    require XOOPS_ROOT_PATH . '/modules/' . $xoopsModule->dirname() . '/language/' . $xoopsConfig['language'] . '/main.php';
} else {
    require XOOPS_ROOT_PATH . '/modules/' . $xoopsModule->dirname() . '/language/german/main.php';
}
