function editEl(id){
    var x =  prompt("Enter new value:");
    if(x==null){ return;}
        document.getElementById(id).innerHTML = x;
        document.getElementById("hid"+id.substring(3)).value = x;

}

function verDelete(){
    let x = confirm("Are you sure you want to delete this?");

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

var i = 0;
var time = 3000;

function changeImg(){

    const elements = document.querySelectorAll(`[id^="imj"]`);

    for (let j = 0; j < elements.length; j++) {
        document.getElementById(elements[j].id).src = 'slides/' + elements[j].id.slice(3, -4) + '/' + i.toString() + '.png';
    }

    if(i < elements.length - 1){
        i++;
    } else {
        i = 0;
    }

    setTimeout("changeImg()", time);
}

window.onload=changeImg;

