<registro v-if="registro">
    <div class="dashboard-wrapper">
        <div class="container-fluid dashboard-content">
            <div class="row">
                <div class="col-xl-3 col-lg-1 col-md-1 col-sm-1 col-1"></div>
                <div class="col-xl-6 col-lg-10 col-md-10 col-sm-10 col-10">
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="login-block" id="basicform">
                                <h3 class="login-title">REGISTRO</h3>
                            </div>
                            <div class="card registro-login">
                                <div class="card-body">
                                    <form>
                                        <p class="title-registro-text">
                                            Datos de registro
                                        </p>
                                        <div class="form-group">
                                            <input id="nombre" type="text" class="form-control form-registro" placeholder="Nombre:" v-model="newUser.nombre">
                                        </div>
                                        <div class="form-group">
                                            <input id="clave-loqueleo" type="password" class="form-control form-registro" placeholder="Contraseña:" v-model="newUser.password">
                                        </div>
                                        <div class="form-group">
                                            <input class="form-control form-registro" type="tel" id="telefono" placeholder="55-5555-5555" pattern="[0-9]{2}-[0-9]{4}-[0-9]{4}" v-model="newUser.telefono">
                                        </div>
                                        <div class="form-group">
                                            <input id="correo" type="email" class="form-control form-registro" placeholder="Correo:" v-model="newUser.correo">
                                        </div>
                                        <div class="form-group">
                                            <input id="confirmar-correo" type="email" class="form-control form-registro" placeholder="Confirmar Correo:" v-model="newUser.confirma_correo">
                                        </div>
                                        <div class="form-group">
                                            <input id="rfc" type="text" class="form-control form-registro" placeholder="RFC:" v-model="newUser.rfc">
                                        </div>
                                        <div class="form-group">
                                            <input id="notas" type="text" placeholder="Notas" class="form-control form-registro"  v-model="newUser.notas">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" id="btn-registro-login">
                        <div class="col-xl-3 col-lg-3 col-md-2 col-sm-2 col-2"></div>
                        <div class="col-xl-6 col-lg-6 col-md-8 col-sm-8 col-8">
                            <button id="btnRegistro" class="btn btn-green" @click="addUser">REGISTRAR</button>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-2 col-sm-2 col-2"></div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-1 col-md-1 col-sm-1 col-1"></div>
            </div>
        </div>
    </div>
</registro>