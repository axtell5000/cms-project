
// initializing ck editor
ClassicEditor
.create( document.querySelector( '#body' ) )
.catch( error => {
    console.error( error );
} );