<?php
/**
 *　                  oooooooooooo
 *
 *                  ooooooooooooooooo
 *                       o
 *                      o
 *                     o        o
 *                    oooooooooooo
 *
 *         ～～         ～～         　　～～
 *       ~~　　　　　~~　　　　　　　　~~
 * ~~～~~～~~　　　~~~～~~～~~～　　　~~~～~~～~~～
 * ·······              ~~XYHCMS~~            ·······
 * ·······  闲看庭前花开花落 漫随天外云卷云舒 ·······
 * ·············     www.xyhcms.com     ·············
 * ··················································
 * ··················································
 *
 * 公共模型内容验证控制器CommonContentController
 * @Author: gosea <gosea199@gmail.com>
 * @Date:   2014-06-21 10:00:00
 * @Last Modified by:   gosea
 * @Last Modified time: 2016-06-21 12:32:34
 */

namespace Manage\Controller;

use Think\Controller;

class CommonContentController extends Controller
{

    //_initialize自动运行方法，在每个方法前，系统会首先运动这个方法
    public function _initialize()
    {

        if (!isset($_SESSION[C('USER_AUTH_KEY')])) {
            $this->redirect(MODULE_NAME . '/Login/index');
        }
        C(get_cfg_value()); //添加配置

        $adminFlag = isset($_SESSION[C('ADMIN_AUTH_KEY')]) ? $_SESSION[C('ADMIN_AUTH_KEY')] : 0;
        $adminRole = $_SESSION['yang_adm_roleid'];

        if (!$adminFlag) {
            $pid = I('pid', 0, 'intval');
            if (empty($pid)) {
                $pid = I('get.pid', 0, 'intval');
            }

            check_category_access($pid, ACTION_NAME, $adminRole) || $this->error('没有权限');

        }

    }
}
