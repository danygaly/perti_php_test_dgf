Vue.component('modal',{ //modal
    template:`
        <transition enter-active-class="animated bounceInDown" leave-active-class="animated bounceOutUp">
            <div class="modal is-active">
                <div class="modal-card border border border-secondary">
                    <div class="modal-card-head text-center bg-dark">
                        <div class="modal-card-title text-white">
                            <slot name="head"></slot>
                        </div>
                        <button class="delete" @click="$emit('close')"></button>
                    </div>
                    <div class="modal-card-body">
                        <slot name="body"></slot>
                    </div>
                    <div class="modal-card-foot" >
                        <slot name="foot"></slot>
                    </div>
                </div>
            </div>
        </transition>`
    })
var m = new Vue({
    el:'#panel-metricas',
    data:{
        datos:[],
        descargas:[],
        search: {text: ''},
        emptyResult:false,
        newUser:{
            firstname:'',
            lastname:'',
            gender:'',
            birthday:'',
            email:'',
            contact:'',
            address:''
        },
        chooseUser:{},
        formValidate:[],
        successMSG:'',
        //pagination
        currentPage: 0,
        rowCountPage:5,
        totalUsers:0,
        pageRange:2
    },
    created(){
        this.showAll(); 
        this.showDescargas();
    },
    methods:{
        showAll(){ axios.get(constants.URL_BASE + "metricas/datos_general").then(function(response){
            if(response.data.datos == null){
                console.log(response.data.datos);
            }else{
                m.getData(response.data.datos);

            }
        })},
        showDescargas(){ axios.get(constants.URL_BASE + "metricas/datos_descargas").then(function(response){
            if(response.data.descargas == null){
                console.log(response.data.descargas);
            }else{
                //m.getData(response.data.descargas);
                //console.log(response.data.descargas);
                m.getDescargas(response.data.descargas);

            }
        })},
        getDescargas(descargas){
            m.descargas = descargas;
            console.log(m.descargas);
        },
        searchUser(){
            var formData = m.formData(m.search);
            axios.post(this.url+"user/searchUser", formData).then(function(response){
                if(response.data.users == null){
                    m.noResult()
                }else{
                    m.getData(response.data.users);                        
                }  
        })},
        addUser(){   
            var formData = m.formData(m.newUser);
            axios.post(this.url+"user/addUser", formData).then(function(response){
                if(response.data.error){
                    m.formValidate = response.data.msg;
                }else{
                    m.successMSG = response.data.msg;
                    m.clearAll();
                    m.clearMSG();
                }
            })
        },
        updateUser(){
            var formData = m.formData(m.chooseUser); 
            axios.post(this.url+"user/updateUser", formData).then(function(response){
                if(response.data.error){
                    m.formValidate = response.data.msg;
                }else{
                    m.successMSG = response.data.success;
                    m.clearAll();
                    m.clearMSG();
                }
            })
        },
        deleteUser(){
            var formData = m.formData(m.chooseUser);
            axios.post(this.url+"user/deleteUser", formData).then(function(response){
                if(!response.data.error){
                    m.successMSG = response.data.success;
                    m.clearAll();
                    m.clearMSG();
                }
            })
        },
        formData(obj){
            var formData = new FormData();
            for ( var key in obj ) {
                formData.append(key, obj[key]);
            } 
            return formData;
        },
        getData(datos){
            m.emptyResult = false; // se vuelve falso si tiene un registro
            m.totalUsers = datos.length // obtiene un total de usuarios
            m.datos = datos;
            console.log(m.datos);
            if(m.datos.length == 0){ 
                m.clearAll();  
            }
        },
        selectUser(user){
            m.chooseUser = user; 
        },
        clearMSG(){
            setTimeout(function(){
            m.successMSG=''
            },3000); // desapareciendo el mensaje exitoso en 2 segundos
        },
        clearAll(){
            m.newUser = { 
            firstname:'',
            lastname:'',
            gender:'',
            birthday:'',
            email:'',
            contact:'',
            address:''};
            m.formValidate = false;
            m.addModal= false;
            m.editModal=false;
            m.deleteModal=false;
            m.refresh()
        },
        noResult(){
            m.emptyResult = true;  // se convierte en verdadero si el registro está vacío, imprime 'No Record Found'
            m.users = null 
            m.totalUsers = 0 // eliminar la página actual si está vacía
        },
        pickGender(gender){
            return m.newUser.gender = gender // agregar nuevo usuario con la selección de género
        },
        changeGender(perfil){
            return m.chooseUser.perfil = perfil // actualizar el género
        },
        imgGender(value){
            return m.url+'assets/img/gender_'+value+'.png' // para el signo de género de imagen en la tabla
        },
        pageUpdate(pageNumber){
            m.currentPage = pageNumber; // recibir el número de la página actual provino de la plantilla de paginación
            m.refresh()  
        },
        refresh(){
            m.search.text ? m.searchUser() : m.showAll(); // para prevenir
        }
    }
})