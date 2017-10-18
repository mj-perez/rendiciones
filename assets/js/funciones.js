
function login(){
	var login=document.getElementById("login"),
	usuario=document.getElementById("txt_usuario"),
	clave=document.getElementById("txt_contra");
	if((usuario.value=="" && clave=="") || (usuario=="" || clave=="")){
		alert('Los campos no pueden estar vacíos, ingrese usuario y contraseña');
	} else {
		login.action="menu";
 		login.submit(); 
	}
 	
 }


 function calendar(txt){
 	var fecha=new JsDatePick({		
			useMode:2,
			target: txt,
			dateFormat:"%d-%m-%Y",
			yearsRange: [new Date().getFullYear()-1,new Date().getFullYear()+2],
			cellColorScheme: "aqua",
			imgPath:"../assets/css/img/"
		});
 }