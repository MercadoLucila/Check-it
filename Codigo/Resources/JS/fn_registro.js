function verificar_datos(){
        clave=document.getElementById("clave").value;
        clave2=document.getElementById("clave2").value;

    if(clave==clave2){
        document.getElementById("registro").submit();
    }else{
        Swal.fire({
            title: "Las contraseñas no coinciden!",
            text: "Inténtalo nuevamente.",
            confirmButtonColor: '#5e9e60',
            /* imageUrl: "",
            imageWidth: 400,
            imageHeight: 200,
            imageAlt: "Custom image" */
        
          });
    }
}