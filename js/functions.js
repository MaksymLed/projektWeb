function editEl(id){
    var x =  prompt("Enter new value:");
    if(x==null){ return;}
        document.getElementById(id).innerHTML = x;
        document.getElementById("hid"+id.substring(3)).value = x;

}

function verDelete(){
    let x = confirm("Are you sure you want to delete this movie ?");

    if(x) {

    }else{
        return false;
    }
}

function searchBar() {
    var input, filter, container, col, elMovie, elCat, i, txtValueMovie, txtValueCat;
    input = document.getElementById("searchInput");
    filter = input.value.toUpperCase();
    container = document.getElementById("container");
    col = container.getElementsByClassName("col-md-6 col-lg-4 mb-5");
    for (i = 0; i < col.length; i++) {
        elMovie = col[i].getElementsByClassName("portfolio-item-caption-content text-center text-white")[0];
        elCat = col[i].getElementsByClassName("portfolio-item-caption-content cat text-center text-white")[0];
        txtValueMovie = elMovie.textContent || elMovie.innerText;
        txtValueCat = elCat.textContent || elCat.innerText;
        if (txtValueMovie.toUpperCase().indexOf(filter) > -1 || txtValueCat.toUpperCase().indexOf(filter) > -1) {
            col[i].style.display = "";
        } else {
            col[i].style.display = "none";
        }
    }
}

var i = 0; 			// Start Point
var images = [];	// Images Array
var time = 3000;	// Time Between Switch

// Image List

images[0] = 'photos/spectre.png';
images[1] = 'photos/thor.png';
images[2] = 'photos/tlo.png';

// Change Image
function changeImg(){
    document.getElementById("slide").src = images[i];

    // Check If Index Is Under Max
    if(i < images.length - 1){
        // Add 1 to Index
        i++;
    } else {
        // Reset Back To O
        i = 0;
    }

    // Run function every x seconds
    setTimeout("changeImg()", time);
}

// Run function when page loads
window.onload=changeImg;
