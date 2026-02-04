$("#idABFandomTag").tagsinput({
    maxTags: 1
})

function cargarImagen(event, elementId) {
    const selectedImage = document.getElementById(elementId);
    const fileInput = event.target;

    if (fileInput.files && fileInput.files[0]) {
        const reader = new FileReader();

        reader.onload = function(e) {
            selectedImage.src = e.target.result;
        };
        reader.readAsDataURL(fileInput.files[0]);
    }
}

function cargarVideo(){
    var input = document.getElementById("video");
    var freader = new FileReader();
    freader.readAsDataURL(input.files[0]);
    freader.onload = function(){
        document.getElementById("vidProducto1").src=freader.result;
    }
}