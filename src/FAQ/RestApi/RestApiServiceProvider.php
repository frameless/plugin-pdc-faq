<?php

namespace OWC\PDC\FAQ\RestApi;

use OWC\PDC\Base\Models\Item;
use OWC\PDC\Base\Foundation\ServiceProvider;

class RestApiServiceProvider extends ServiceProvider
{

    public function register()
    {
        Item::addGlobalField('faq', new FAQField($this->plugin));
    }

}