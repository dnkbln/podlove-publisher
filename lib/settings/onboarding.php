<?php

namespace Podlove\Settings;

class Onboarding
{
    use \Podlove\HasPageDocumentationTrait;

    public static $pagehook;

    public function __construct($handle)
    {
        Onboarding::$pagehook = add_submenu_page(
            // $parent_slug
            $handle,
            // $page_title
            __('Onboarding', 'podlove-podcasting-plugin-for-wordpress'),
            // $menu_title
            __('Onboarding', 'podlove-podcasting-plugin-for-wordpress'),
            // $capability
            'administrator',
            // $menu_slug
            'podlove_onboarding_handle',
            // $function
            [$this, 'page']
        );

        $this->init_page_documentation(self::$pagehook);
    }

    public function page()
    {
        ?>
		<div class="wrap">
            <h2><Onboarding</h2>
            <p> Hier entsteht ein Onboarding Wizard </p>
		</div>	
		<?php

        do_action('podlove_support_page_footer');
    }
}
