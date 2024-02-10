
function actualizar() {
    var form = document.getElementById("form");
    var data = new FormData(form);
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var respuesta = JSON.parse(xhr.responseText);
            alert(respuesta.value);
        }
    };
    xhr.open("POST", "actualizar.php", true);
    xhr.send(data);
}
