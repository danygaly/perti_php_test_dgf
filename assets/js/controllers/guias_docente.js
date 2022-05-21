
/*Vue.component('mensaje',{ //modal
    template:`<br>Hola`
})*/

var paginador = new Vue({
    el:'#paginador',
    data:{ 
        activo: 1,
        primera_pagina : 1,
        ultima_pagina : 6
    },
    mounted(){
        this.activo = this.primera_pagina;
        this.pintar_activo();
    },
    methods:{
        pintar_activo(){   
            this.despintar_activo();
            var pagina_activa = this.activo;
            var paginador_items = document.getElementsByClassName('page-link');

            paginador_items[pagina_activa].classList.add("activate");
        },
        despintar_activo(){
            var paginador_items = document.getElementsByClassName('page-link');

            for(var aux = 0; aux < paginador_items.length; aux++){
                paginador_items[aux].classList.remove("activate");
            }
        },
        clic_previo(){
            this.activo = this.activo - 1;
            if(this.activo < this.primera_pagina){
                this.activo = this.ultima_pagina;
            }
            this.pintar_activo();
        },
        clic_siguiente(){
            this.activo = this.activo + 1;
            if(this.activo > this.ultima_pagina){
                this.activo = this.primera_pagina;
            }
            this.pintar_activo();
        }
    }
})
