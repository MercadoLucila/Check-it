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


function editarRam(){
    let nota_regular = document.getElementById("nota_regular").value
    let nota_promocion = document.getElementById("nota_promocion").value
    let porcentaje_regular = document.getElementById("porcentaje_regular").value
    let porcentaje_promocion = document.getElementById("porcentaje_promocion").value

    if(nota_regular !== "" && nota_promocion !== "" && porcentaje_regular !=="" && porcentaje_promocion !==""){
        console.log("aaaa")
        document.getElementById("formulario").submit()
    }else{
        Swal.fire({
            icon: "error",
            title: "complete el formulario",
          });
    }

}