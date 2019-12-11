
$(document).ready(function(){


	// checking checkboxes
	$('#selectAllBoxes').click(function (event) {
		if (this.checked) {
			$('.checkBoxes').each((function() {
				this.checked = true;
			}));
		} else {
			$('.checkBoxes').each((function() {
				this.checked = false;
			}));
		}
	});

	// for loader
	var div_box = "<div id='load-screen'><div id='loading'></div></div>";
	$("body").prepend(div_box);
	$('#load-screen').delay(700).fadeOut(600, function(){		
		this.remove();
	});

	// For modal pop up
	$('.delete-link').on('click', function() {
		var id = $(this).attr('rel');
		var delete_url = "posts.php?delete=" + id;
		$('.modal-delete-link').attr('href', delete_url);
		$('#myModal').modal('show');
	});
	
});

