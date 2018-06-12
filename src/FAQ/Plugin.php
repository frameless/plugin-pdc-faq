<?php

namespace OWC\PDC\FAQ;

use OWC\PDC\FAQ\Plugin\BasePlugin;
use OWC\PDC\FAQ\Admin\Admin;

class Plugin extends BasePlugin
{

    /**
     * Name of the plugin.
     *
     * @var string
     */
    const NAME = 'pdc-faq';

    /**
     * Version of the plugin.
     * Used for setting versions of enqueue scripts and styles.
     *
     * @var string
     */
    const VERSION = '1.1';

    /**
     * Boot the plugin.
     * Called on plugins_loaded event
     */
    public function boot()
    {
	    $this->config->setProtectedNodes(['core']);
	    $this->config->boot();

	    $this->bootServiceProviders();

	    if ( is_admin() ) {
		    $admin = new Admin($this);
		    $admin->boot();
	    }

	    $this->loader->addAction('init', $this, 'filterPlugin', 9);
	    $this->loader->register();
    }

	public function filterPlugin()
	{
		do_action('owc/'.self::NAME.'/plugin', $this );
	}
}