$(document).ready(function () {
	var counter = 0;
	var mouseX = 0;
	var mouseY = 0;

	$("#imgtag img").click(function (e) {
		var imgtag = $(this).parent();
		mouseX = e.pageX - $(imgtag).offset().left;
		mouseY = e.pageY - $(imgtag).offset().top;
		$('#tagit').remove();
		$(imgtag).append(
			'<div id="tagit">' +
				'<div class="box"></div>' +
			'</div>');
		$('#tagit').css({ top: mouseY, left: mouseX });

		$('#exampleModalCenter').modal('show');
		$('#tagPositionX').val(mouseX);
		$('#tagPositionY').val(mouseY);
	});

});