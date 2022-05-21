<login v-if="login">
    <div class="dashboard-wrapper">
        <div class="container-fluid dashboard-content">
            <div class="row">
                <div class="col-xl-3 col-lg-1 col-md-1 col-sm-1 col-1"></div>
                <div class="col-xl-6 col-lg-10 col-md-10 col-sm-10 col-10">
                    <div class="row">
                        <div class="col-xl-1 col-lg-12 col-md-12 col-sm-12 col-12"></div>
                        <div class="col-xl-10 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="card login">
                                <div class="card-body">
                                    <form>
                                        <p class="title-card-text">
                                            Iniciar Sesión
                                        </p>
                                        <div class="form-group">
                                            <input id="usuario" type="email" class="form-control" placeholder="Correo electrónico:" v-model="loginUser.correo">
                                        </div>
                                        <div class="form-group">
                                            <input id="password" type="password" class="form-control" placeholder="Contraseña:" v-model="loginUser.password">
                                        </div>
                                        <div class="privacy-body">
                                            <a style="text-decoration: revert; color: #004a92;font-weight: 500;" @click="show_registrar" >Registrar usuario</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-1 col-lg-12 col-md-12 col-sm-12 col-12"></div>
                    </div>
                    <div class="row">
                        <div class="col-xl-4 col-lg-4 col-md-2 col-sm-2 col-2"></div>
                        <div class="col-xl-4 col-lg-4 col-md-8 col-sm-8 col-8">
                            <button class="btn btn-green" @click="logUser">INICIAR SESIÓN</button>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-2 col-sm-2 col-2"></div>
                    </div>
                    <!-- ============================================================== -->
                    <!-- end basic form  -->
                </div>
                <div class="col-xl-3 col-lg-1 col-md-1 col-sm-1 col-1"></div>
            </div>
        </div>
    </div>
</login>