<?php

namespace Podlove\Settings\Onboarding\Settings;

class OnboardingStart
{
    public $title = 'Onboarding Start';

    public static function get_page_link($step)
    {
        return sprintf('?page=%s&step=%s', 'podlove_onboarding_handle', $step);
    }

    public function template()
    {
        ?>
        <div class="row-fluid">
			<div class="span3">
                <h3>Select a install type</h3>
				</p>
			</div>
        </div>
        <div class="row-fluid">
			<div class="span3">
				<a href="<?php echo self::get_page_link(2); ?>" class="btn btn-primary btn-large btn-block">
					<?php echo __('Next', 'podlove-podcasting-plugin-for-wordpress'); ?>
				</a>
			</div>
		</div>
		<?php
    }
}