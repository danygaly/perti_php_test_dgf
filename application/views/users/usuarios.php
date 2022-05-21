<div id="app">
    <div class="container">
        <div class="row">
            <div class="col-xl-12 col-md-12 col-12"></div>
            <div class="col-xl-12 col-md-12 col-12 container">
                <table class="table is-bordered is-hoverable">
                    <thead class="text-white bg-dark">
                        <th class="col text-white">Nombre</th>
                        <th class="col text-white">Telefono</th>
                        <th class="col text-white">Correo</th>
                        <th class="col text-white">RFC</th>
                        <th class="col text-white">Notas</th>
                        <th colspan="2" class="col text-center text-white">Acción</th>
                    </thead>
                    <tbody class="table-light">
                        <tr v-for="user in users" class="table-default">
                            <td scope="row">{{user.nombre}}</td>
                            <td scope="row">{{user.telefono}}</td>
                            <td scope="row">{{user.correo}}</td>
                            <td scope="row">{{user.rfc}}</td>
                            <td scope="row">{{user.notas}}</td>
                            <td scope="row"><button class="btn btn-info fa fa-edit" @click="editModal = true; selectUser(user)"></button></td>
                        </tr>
                        <tr v-if="emptyResult">
                            <td colspan="6" rowspan="4" class="text-center h1">Sin Registro</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-xl-12 col-md-12 col-12"></div>
        </div>
        <pagination :current_page="currentPage" :row_count_page="rowCountPage" @page-update="pageUpdate" :total_users="totalUsers" :page_range="pageRange"></pagination>
        <br>
        <transition enter-active-class="animated fadeInLeft" leave-active-class="animated fadeOutRight">
            <div class="notification is-success text-center px-5 top-middle" v-if="successMSG" @click="successMSG = false">{{successMSG}}</div>
        </transition>
    </div>


    
    <!--agregar modal-->
    <modal v-if="addModal" @close="clearAll()">
        <h3 slot="head" >Agregar usuario</h3>
        <div slot="body" class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Nombre</label>
                    <input type="text" class="form-control" :class="{'is-invalid': formValidate.firstname}" name="firstname" v-model="newUser.firstname">            
                    <div class="has-text-danger" v-html="formValidate.firstname"></div>
                </div>
                <div class="form-group"> 
                    <label>Apellido</label>
                    <input type="text" class="form-control" :class="{'is-invalid': formValidate.lastname}" name="lastname" v-model="newUser.lastname">
                    
                    <div class="has-text-danger" v-html="formValidate.lastname"> </div>
                </div>
                <div class="form-group">
                    <label for="">Sexo</label><br>
                    <div class="btn-group">
                        <button class="btn btn-outline-dark fa fa-mars" :class="{'active':(newUser.gender == 'boy')}" @click.prevent="pickGender('boy')"> Masculino</button>
                        <button class="btn btn-outline-dark fa fa-venus" :class="{'active': (newUser.gender == 'girl')}" @click.prevent="pickGender('girl')"> Femenino</button>
                    </div>
                    <div class="has-text-danger"v-html="formValidate.gender"></div>
                </div>
                <div class="form-group">
                    <label>Cumpleaños</label>
                    <input type="date" class="form-control" :class="{'is-invalid': formValidate.birthday}" name="birthday" v-model="newUser.birthday">
                    <div class="has-text-danger" v-html="formValidate.birthday"> </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                <label>Email</label>
                    <input type="text" class="form-control" :class="{'is-invalid': formValidate.email}" name="email" v-model="newUser.email">
                        <div class="has-text-danger" v-html="formValidate.email"></div>
                </div>
                <div class="form-group">
                <label>Contacto</label>
                    <input type="text" class="form-control":class="{'is-invalid': formValidate.contact}" name="contact" v-model="newUser.contact">
                    <div class="has-text-danger" v-html="formValidate.contact"> </div>
                </div>
                <div class="form-group">
                    <label>Dirección</label>
                    <textarea cols="35" rows="5" :class="{'is-invalid': formValidate.address}" name="address" v-model="newUser.address" class="form-control"></textarea>
                    <div class="has-text-danger" v-html="formValidate.address"> </div>
                </div>
            </div>
        </div>
        <div slot="foot">
            <button class="btn btn-dark" @click="addUser">Agregar</button>
        </div>
    </modal>
    <!--actualizar modal  HERE-->
    <modal v-if="editModal" @close="clearAll()">
        <h3 slot="head" >Editando Usuario</h3>
        <div slot="body" class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Nombre</label>
                    <input type="text" class="form-control" :class="{'is-invalid': formValidate.nombre}" name="nombre" v-model="chooseUser.nombre">                
                    <div class="has-text-danger" v-html="formValidate.nombre_escuela"> </div>
                </div>
                <div class="form-group">
                    <label>Telefono</label>
                    <input type="text" class="form-control" :class="{'is-invalid': formValidate.telefono}" name=.telefono" v-model="chooseUser.telefono">                
                    <div class="has-text-danger" v-html="formValidate.telefono"> </div>
                </div>
                <div class="form-group">
                    <label for="">Correo</label><br>
                    <input type="text" class="form-control":class="{'is-invalid': formValidate.correo}" name="correo" v-model="chooseUser.correo">
                    <div class="has-text-danger" v-html="formValidate.correo"> </div>
                </div>
                <div class="form-group">
                    <label>RFC</label>
                    <input type="email" class="form-control" :class="{'is-invalid': formValidate.rfc}" name="rfc" v-model="chooseUser.rfc">
                    <div class="has-text-danger" v-html="formValidate.rfc"> </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label> Password</label>
                    <input type="password" class="form-control" :class="{'is-invalid': formValidate.password}" name="password" v-model="chooseUser.password">
                    <div class="has-text-danger" v-html="formValidate.password"></div>
                </div>
            </div>
        </div>
        <div slot="foot">
            <button class="btn btn-dark" @click="updateUser">Actualizar</button>
        </div>
    </modal>
    <!--eliminar modal-->
    <modal v-if="deleteModal" @close="clearAll()">
        <h3 slot="head">Elimimar</h3>
        <div slot="body" class="text-center">¿Estas seguro de eliminar este usuario?</div>
        <div slot="foot">
            <button class="btn btn-dark" @click="deleteModal = false; deleteUser()" >Eliminar</button>
            <button class="btn" @click="deleteModal = false">Cancelar</button>
        </div>
    </modal>
</div>
<script src="<?php print base_url();?>assets/js/controllers/usuarios.js"></script>

