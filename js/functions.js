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
    var input, filter, container, col, a, a1, i, txtValue, txtValue1;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    container = document.getElementById("container");
    col = container.getElementsByClassName("col-md-6 col-lg-4 mb-5");
    for (i = 0; i < col.length; i++) {
        a = col[i].getElementsByClassName("portfolio-item-caption-content text-center text-white")[0];
        a1 = col[i].getElementsByClassName("portfolio-item-caption-content text-center text-black")[0];
        txtValue = a.textContent || a.innerText;
        txtValue1 = a1.textContent || a1.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1 || txtValue1.toUpperCase().indexOf(filter) > -1) {
            col[i].style.display = "";
        } else {
            col[i].style.display = "none";
        }
    }
}