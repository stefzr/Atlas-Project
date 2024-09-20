function toggleAnswer(event, id){
    let headerElement = document.getElementById(id);
    let icons = headerElement.getElementsByTagName('i');
    for(icon of icons){
        if(icon.classList.contains('d-none')){
            icon.classList.remove('d-none');
        }else{
            icon.classList.add('d-none');
        }
    }
    let spanElement = headerElement.nextElementSibling;
    if(spanElement.classList.contains('d-none')){
        spanElement.classList.remove('d-none');
    }else{
        spanElement.classList.add('d-none');
    }
}