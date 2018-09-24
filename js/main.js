(function(){
    
    "use strict";
    document.addEventListener('DOMContentLoaded', function(){
       
        
        
        
        
         let dataList = document.querySelector('#productos'),
                    input = document.querySelector('#producto');
        
         let xmlhttp = new XMLHttpRequest();
	        xmlhttp.onreadystatechange = function () {
	            if (this.readyState == 4 && this.status == 200) {
	                info = JSON.parse(this.responseText);
	                if(info !== null){
	                	info.foreach(function(e){
                            let option = document.createElement('option');
                            option.value = e['id']+" "+e['descripcion']+" "+e['precio'];
                            dataList.appendChild(option);
                        })
	                }
	                else{
	                
					    

	                }
	            }
	        };
	        xmlhttp.open("GET", "getProduct.php?", true);
	        xmlhttp.send();
        
            

            
            
    });
    
})();