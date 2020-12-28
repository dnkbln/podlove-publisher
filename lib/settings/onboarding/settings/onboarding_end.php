<?php

namespace Podlove\Settings\Onboarding\Settings;

class OnboardingEnd
{
    public $title = 'Onboarding Finish';

    public static function get_page_link($step)
    {
        return sprintf('?page=%s&step=%s', 'podlove_onboarding_handle', $step);
    }

    public function template()
    {
        ?>
        <div class="row-fluid">
			<div class="span3">
				<h3>Finish</h3>
				<p>
				</p>
			</div>
        </div>
        <div class="row-fluid">
			<div class="span3">
				<a href="<?php echo self::get_page_link(1); ?>" class="btn btn-primary btn-large btn-block">
					<?php echo __('Back', 'podlove-podcasting-plugin-for-wordpress'); ?>
				</a>
			</div>
		</div>
		<?php
    }
}