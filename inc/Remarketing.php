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

class Remarketing extends RemarketingBase
{
    public function _setup()
    {
        add_action('wp_footer', array($this, 'tracking'), 101);
    }

    public function tracking()
    {
        if ($this->ignoreUser()) {
            return;
        }

        $id = apply_filters('pmg_remarketing_id', $this->getSetting()->get('conversion_id'));
        $label = apply_filters('pmg_remarketing_label', $this->getSetting()->get('conversion_label'));
        $rm_only = apply_filters('pmg_remarketing_only', ('on' == $this->getSetting()->get('remarketing_only')));

        if (!$id || !$label) {
            return;
        }

        do_action('pmg_remarketing_script_before', $id, $label, $rm_only);
        ?>
        <script type="text/javascript">
        /* <![CDATA[ */
        var google_conversion_id = <?php echo absint($id); ?>;
        var google_conversion_label = "<?php echo esc_js($label); ?>";
        var google_custom_params = window.google_tag_params;
        var google_remarketing_only = <?php if($rm_only): ?>true<?php else: ?>false<?php endif; ?>;
        /* ]]> */
        </script>
        <script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js"></script>
        <noscript><div style="display:inline;">
            <img height="1" width="1" style="border-style:none;" alt="" src="//googleads.g.doubleclick.net/pagead/viewthroughconversion/<?php echo absint($id); ?>/?value=0&amp;label=<?php echo urlencode($label); ?>&amp;guid=ON&amp;script=0"/>
        </div></noscript>
        <?php
        do_action('pmg_remarketing_script_after', $id, $label, $rm_only);
    }
}
