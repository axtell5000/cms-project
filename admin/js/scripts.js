
$(document).ready(function(){

	// initializing ck editor
	ClassicEditor
	.create( document.querySelector( '#body' ) )
	.catch( error => {
			console.error( error );
	} );

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

});

