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
        $onboardingSteps = [
            new Onboarding\Settings\OnboardingStart(),
            new Onboarding\Settings\OnboardingEnd(),
        ];

        // start-index must be 1, not 0
        array_unshift($onboardingSteps, 'whatever');
        unset($onboardingSteps[0]);

        if (isset($_REQUEST['step']) && $_REQUEST['step'] > 0 && $_REQUEST['step'] < 3) {
            $current_step = (int) $_REQUEST['step'];
        }
        else 
        {
            $current_step = 1;
        }
        ?>
        <div class="wrap bootstrap">
        <?php
            $onboardingSteps[$current_step]->template();
        ?>
        </div>
        <?php
    }
}
