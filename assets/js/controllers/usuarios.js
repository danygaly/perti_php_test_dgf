
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
var v = new Vue({
    el:'#app',
    data:{
        addModal: false,
        editModal:false,
        deleteModal:false,
        users:[],
        search: {text: ''},
        emptyResult:false,
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
    },
    methods:{
        showAll(){ axios.get(constants.URL_BASE + "user/showAll").then(function(response){
            if(response.data.users == null){
                v.noResult()
            }else{
                v.getData(response.data.users);
            }
        })},
        updateUser(){
            var formData = v.formData(v.chooseUser); 
            axios.post(constants.URL_BASE + "user/updateUser", formData).then(function(response){
                if(response.data.error){
                    v.formValidate = response.data.msg;
                }else{
                    v.successMSG = response.data.success;
                    v.clearAll();
                    v.clearMSG();
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
        getData(users){
            v.emptyResult = false; // se vuelve falso si tiene un registro
            v.totalUsers = users.length // obtiene un total de usuarios
            v.users = users.slice(v.currentPage * v.rowCountPage, (v.currentPage * v.rowCountPage) + v.rowCountPage); //slice the result for pagination
            //si el registro está vacío, retrocede una página
            console.log(v.users);
            if(v.users.length == 0 && v.currentPage > 0){ 
                v.pageUpdate(v.currentPage - 1)
                v.clearAll();  
            }
        },
        selectUser(user){
            v.chooseUser = user; 
        },
        clearMSG(){
            setTimeout(function(){
            v.successMSG=''
            },3000); // desapareciendo el mensaje exitoso en 2 segundos
        },
        clearAll(){
            v.newUser = { 
            firstname:'',
            lastname:'',
            gender:'',
            birthday:'',
            email:'',
            contact:'',
            address:''};
            v.formValidate = false;
            v.addModal= false;
            v.editModal=false;
            v.deleteModal=false;
            v.refresh()
        },
        noResult(){
            v.emptyResult = true;  // se convierte en verdadero si el registro está vacío, imprime 'No Record Found'
            v.users = null 
            v.totalUsers = 0 // eliminar la página actual si está vacía
        },
        pageUpdate(pageNumber){
            v.currentPage = pageNumber; // recibir el número de la página actual provino de la plantilla de paginación
            v.refresh()  
        },
        refresh(){
            v.search.text ? v.searchUser() : v.showAll(); // para prevenir
        }
    }
})