var formulario = document.getElementById('formulario');
var respuesta = document.getElementById('respuesta');

formulario.addEventListener('submit', function(e){
    e.preventDefault();
    var datos= new FormData(formulario);
    console.log(datos.get('email'));

    fetch('../../main.php',{
        method:'POST',
        body: datos
    })
    .then(response=>{
        if(response.redirected){
            window.location.href = response.url;
        }else{
            return response.json();
        }
    })  
    .then(data=>{
        respuesta.innerHTML=`<p>${data}</p>`
    })
});