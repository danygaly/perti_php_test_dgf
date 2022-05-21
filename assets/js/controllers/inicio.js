var inicio = new Vue({
    el:'#panel-login',
    data:{ 
        login : true,
        registro : false,
        newUser:{
            nombre:'',
            telefono:'',
            correo:'',
            confirma_correo:'',
            rfc:'',
            notas:'',
            password: ''
        },
        loginUser:{
            correo:'',
            password:''
        }
    },
    methods:{
        show_registrar(){   
            document.getElementById("footer-login").style.position = "static";
            document.getElementById("html-login").style.height = "auto";
            inicio.login = false;
            inicio.registro = true;
        },
        show_login(){
            inicio.registro = false;
            inicio.login = true;
        },
        addUser(){   
            var formData = inicio.formData(inicio.newUser);
            axios
            .post(
                constants.URL_BASE + "/acceso/addUser", formData
            )
            .then(
                function(response){
                    console.log(response);
                    if(response.data.error){
                        document.getElementById('login-mensaje').innerHTML = response.data.msg;
                        $('#modalLogin').modal('show');

                    }else{
                        window.location.href = response.data.url;
                    }
                }
            )
        },
        logUser(){   
            var formData = inicio.formData(inicio.loginUser);
            axios
            .post(
                constants.URL_BASE + "/acceso/logUser", formData
            )
            .then(
                function(response){
                    if(response.data.error){
                        document.getElementById('login-mensaje').innerHTML = response.data.msg;
                        $('#modalLogin').modal('show');
                    }else{
                        window.location.href = response.data.url;
                    }
                }
            )
        },
        formData(obj){
			var formData = new FormData();
		      for ( var key in obj ) {
		          formData.append(key, obj[key]);
		      } 
		      return formData;
		},
        refresh(){
            registro.search.text ? registro.searchUser() : registro.showAll(); // para prevenir
        }
    }
})
