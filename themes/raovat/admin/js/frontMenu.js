var newItemCount = 0;

$(document).ready(function () {
	setupItemControlBehavior();
	$('#LevelMenuJson').val(JSON.stringify($('.dd').nestable('serialize')));
		$('#LevelMenuJson').val(JSON.stringify($('.dd').nestable('serialize')));
	$('#menuForm').submit(function () {
		// $('#LevelMenuJson').val(JSON.stringify($('.dd').nestable('serialize')));
		// $('#LevelMenuJson').val(JSON.stringify($('.dd').nestable('serialize')));
	});
});

function addMenuItem() {
    newItemCount++;;
    $.post(
        window.menuItemUrl,
        { newId: 'new-' + newItemCount }
    ).done(function (data) {
        $('#mainlist').append(data);
		setupItemControlBehavior();
    });
}

function setupItemControlBehavior() {
	$('.remove-menu').unbind('click').click(function (event) {
		event.preventDefault();
		var r = confirm("Do you want to remove this menu? \nNoted: All submenus of this menu will be removed to");
		if (r) $(this).parent().remove();
	});

	$('.typeSel').unbind('change').change(function () {
		var itemTag = $(this).closest('.menuItem');
		var itemId = itemTag.attr('id').replace('menu-', '');

		$.get(
			window.menuInputUrl,
			{ type: this.value, menuItemId: itemId }
		).done(function (data) {
			itemTag.find('.linkInput:first').html(data);
		});
	});
}