<?php
/**
 * Responsible for hooking into the WordPress hook system.
 */

namespace OWC\PDC\FAQ\Foundation;

/**
 * Responsible for hooking into the WordPress hook system.
 */
class Hooks
{

    /**
     * Helper to activate a plugin on another site without causing a fatal error by
     * including the plugin file a second time. Based on activate_plugin() in
     * wp-admin/includes/plugin.php
     *
     * $buffer option is used for All in One SEO Pack, which sends output otherwise
     *
     * @param          $plugin
     * @param  boolean $buffer
     */
    private function activateCurrentPlugin($plugin, $buffer = false)
    {
        $current = get_option('active_plugins', []);
        if (!in_array($plugin, $current)) {
            if ($buffer) {
                ob_start();
            }
            include_once WP_PLUGIN_DIR . '/' . $plugin;
            do_action('activate_plugin', $plugin);
            do_action('activate_' . $plugin);
            $current[] = $plugin;
            sort($current);
            update_option('active_plugins', $current);
            do_action('activated_plugin', $plugin);
            if ($buffer) {
                ob_end_clean();
            }
        }
    }
}
