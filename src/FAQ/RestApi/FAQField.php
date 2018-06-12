<?php

namespace OWC\PDC\FAQ\RestApi;

use OWC\PDC\Base\Support\CreatesFields;
use WP_Post;

class FAQField extends CreatesFields
{

    /**
     * Create an additional field on an array.
     *
     * @param WP_Post $post
     *
     * @return array
     */
    public function create(WP_Post $post): array
    {
        return array_map(function ($faq) {
            return [
                'question' => $faq['pdc_faq_question'],
                'answer'   => $faq['pdc_faq_answer']
            ];
        }, get_post_meta($post->ID, '_owc_pdc_faq_group', true));
    }

}