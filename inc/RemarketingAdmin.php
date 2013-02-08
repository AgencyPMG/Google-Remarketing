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

namespace PMG\GoogleRemarketing;

!defined('ABSPATH') && exit;

class RemarketingAdmin extends RemarketingBase
{
    public function _setup()
    {
        $f = $this->getSetting();

        $f->add_section('tracking', array(
            'title'     => __('Tracking Options', static::TD),
        ));

        $f->add_field('conversion_id', array(
            'label'     => __('Conversion ID', static::TD),
            'class'     => 'regular-text',
            'section'   => 'tracking',
            'cleaners'  => array('absint'),
        ));

        $f->add_field('conversion_label', array(
            'label'     => __('Conversion Label', static::TD),
            'class'     => 'regular-text',
            'section'   => 'tracking',
        ));

        $f->add_field('remarketing_only', array(
            'label'     => __('Remarketing Only', static::TD),
            'class'     => 'regular',
            'section'   => 'tracking',
            'type'      => 'checkbox',
        ));

        $f->add_field('ignore_loggedin', array(
            'label'     => __('Ignore Logged in Users', static::TD),
            'class'     => 'regular',
            'section'   => 'tracking',
            'type'      => 'checkbox',
        ));

        $this->getProject()->admin_page('options', $f, array(
            'title'     => __('Google Remarketing Options', static::TD),
            'menu_name' => __('Remarketing', static::TD),
            'parent'    => 'options-general.php',
            'slug'      => 'pmg-google-remarketing',
        ));
    }
}
