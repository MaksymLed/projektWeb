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