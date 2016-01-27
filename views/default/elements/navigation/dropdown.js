require(['jquery', 'elgg/popup', 'jquery-ui'], function ($, popup) {

	$(document).on('click', '.elgg-menu-item-has-dropdown > a', function (e) {
		var $trigger = $(this);
		var $target = $trigger.siblings('.elgg-child-menu').eq(0);
		if ($trigger.length && $target.length) {
			$target.addClass('elgg-menu-hover');
			popup.open($trigger, $target);
			return false;
		}
	});

});