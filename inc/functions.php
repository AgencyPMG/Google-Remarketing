<?php
/**
 * PMG Google Remarketing
 *
 * @category    WordPress
 * @package     GoogleRemarketing
 * @author      Christopher Davis <chris@pmg.co>
 * @copyright   2013 Performance Media Group
 * @license     http://opensource.org/licenses/GPL-2.0 GPL-2.0+
 */

!defined('ABSPATH') && exit;

use PMG\GoogleRemarketing\RemarketingAdmin;
use PMG\GoogleRemarketing\Remarketing;

function ml_remarketing_load()
{
    require_once __DIR__ . '/RemarketingBase.php';

    if (is_admin()) {
        require_once __DIR__ . '/RemarketingAdmin.php';
        RemarketingAdmin::init();
    } else {
        require_once __DIR__ . '/Remarketing.php';
        Remarketing::init();
    }
}

function ml_remarketing_activate()
{
    add_option('pmg_remarketing_options', array(
        'conversion_id'     => '',
        'conversion_label'  => '',
        'remarketing_only'  => 'on',
        'ignore_loggedin'   => 'on',
    ));
}
