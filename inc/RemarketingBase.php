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

use PMG\Core\Project;

abstract class RemarketingBase
{
    const TD = 'pmg-remarketing';
    const CAP = 'edit_posts';

    private static $reg = array();

    private $proj;

    public static function instance()
    {
        $cls = get_called_class();

        if (!isset(self::$reg[$cls])) {
            self::$reg[$cls] = new $cls(pmgcore('pmg_remarketing'));
        }

        return self::$reg[$cls];
    }

    public static function init()
    {
        add_action('pmgcore_loaded', array(static::instance(), '_setup'));
    }

    abstract public function _setup();

    final public function __construct(Project $p)
    {
        $this->proj = $p;
    }

    final public function getProject()
    {
        return $this->proj;
    }

    final public function getSetting()
    {
        return $this->getProject()->setting('options');
    }

    public function ignoreUser()
    {
        $ignore = ('on' === $this->getSetting()->get('ignore_loggedin', 'off'));

        return current_user_can(static::CAP) && $ignore;
    }
}
