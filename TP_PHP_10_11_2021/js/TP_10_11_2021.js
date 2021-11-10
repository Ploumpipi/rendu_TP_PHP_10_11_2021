function edit(idEdit, idNote){

    var elt = document.getElementById(idEdit);
    var note = document.getElementById(idNote);
    elt.onchange =(e) => {
        if(elt.checked == true){
            note.disabled = false;
        }else{
            note.disabled = true;
        }
        
    }
}