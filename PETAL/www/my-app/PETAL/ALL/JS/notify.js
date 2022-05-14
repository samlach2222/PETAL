function AlertError(message){
    swal({
        title: message,
        icon: "error",
    })
}

function AlertSuccess(message, isHtml = false){
    swal({
        title: message,
        icon: "success",
    })
    
    if (isHtml) {
        let titleElement = document.getElementsByClassName('swal-title')[0];
        titleElement.innerHTML = message;
    }
}

function AlertWarning(message){
    swal({
        title: message,
        icon: "warning",
    })
}

