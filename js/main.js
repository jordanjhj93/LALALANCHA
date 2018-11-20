const formularioCliente = document.querySelector('#cliente');


 eventListeners();

 function eventListeners() {
      // Cuando el formulario de crear o editar se ejecuta
      formularioCliente.addEventListener('submit', leerFormulario);

 }


 function leerFormulario(e){
    
     e.preventDefault();
    
     const cedula = document.querySelector('#id').value,
           nombre = document.querySelector('#name').value,
           apellido = document.querySelector('#lastname').value,
           telefono = document.querySelector('#phone').value,
           email = document.querySelector('#email').value,
           address = document.querySelector('#address').value,
           accion = document.querySelector('#accion').value;
    
    //  var   mtotal, msubtotal, mtaxes;
        //    articulos = Array();

        //    mtotal = total; 
        //    msubtotal = subtotal;
        //    mtaxes = taxes;

        //    $('#tablita tr').each(function(){
        //        articulos.push($(this).find('td:eq(0)').text());
        //    });


           

           console.log(total);
           console.log(subtotal);
           console.log(taxes);
           console.log(arrayarticulos);
    
     if(nombre === '' || apellido === '' || telefono === '' || cedula === '' || email === '' || address === '' || total === '' || subtotal === '' || taxes === '') {
           // 2 parametros: texto y clase
           console.log('Todos los Campos son Obligatorios', 'error');
     }else{
        
         const infoCliente = new FormData();
           infoCliente.append('nombre', nombre);
           infoCliente.append('apellido', apellido);
           infoCliente.append('telefono', telefono);
           infoCliente.append('cedula', cedula);
           infoCliente.append('email', email);
           infoCliente.append('address', address);
           infoCliente.append('mtotal',total);
           infoCliente.append('msubtotal',subtotal);
           infoCliente.append('mtaxes',taxes);
           infoCliente.append('articulos',JSON.stringify(arrayarticulos));
            
            
           
           infoCliente.append('accion',accion);

           console.log(...infoCliente);

        
         if(accion === 'crear'){
             insertBD(infoCliente);
         }else{
            
         }
     }
    
 }

function insertBD(infoCliente){
   
    const xhr = new XMLHttpRequest();
    
    xhr.open('POST', 'inc/modelos/modelo-clientes.php', true);
    // xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    
    xhr.onload = function() {
        
        if(this.status === 200){

            console.log(xhr.responseText); 
               // leemos la respuesta de PHP
            const respuesta = xhr.responseText;

            document.querySelector('form').reset();

        }
        
    }
    
    xhr.send(infoCliente)
    
}





