require(['jquery', 'elgg/popup', 'jquery-ui'], function ($, popup) {

	$(document).on('click', '.elgg-menu-item-has-dropdown > a', function (e) {
		var $trigger = $(this);
		if ($trigger.data('popup_target_el')) {
			var $target = $trigger.data('popup_target_el');
		} else {
			var $target = $trigger.siblings('.elgg-child-menu').eq(0);
			$trigger.data('popup_target_el', $target);
		}
		
		if ($trigger.length && $target.length) {
			$target.addClass('elgg-menu-hover');
			if ($trigger.data('popupClass')) {
				$target.addClass($trigger.data('popupClass'));
			}
			var position = $trigger.data('position') || {};
			position.at = position.at || $trigger.data('at') || 'center bottom';
			position.my = position.my || $trigger.data('my') || 'center top';
			position.collision = position.collision || $trigger.data('collision') || 'fit fit';
			position.of = $trigger;
			popup.open($trigger, $target, position);
			return false;
		}
	});
});