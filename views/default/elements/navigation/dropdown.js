require(['jquery', 'elgg/popup', 'jquery-ui'], function ($, popup) {
	$(document).on('click', '.elgg-menu-item-has-dropdown > a', function (e) {
		var $trigger = $(this);
		var $target = $trigger.siblings('.elgg-child-menu').eq(0);
		if ($trigger.length && $target.length) {
			$target.addClass('elgg-menu-hover');
			var position = $trigger.data('position') || {};
			position.at = position.at || $trigger.data('at');
			position.my = position.my || $trigger.data('my');
			position.collision = position.collision || $trigger.data('collision');
			position.of = $target.parent();
			popup.open($trigger, $target, position);
			return false;
		}
	});
});