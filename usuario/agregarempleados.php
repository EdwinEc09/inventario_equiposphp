<div class="card mb-3 mb-md-4">

    <div class="card-body">

        <div id="alerta_agregar_empleadoshtml">

        </div>
        <!-- Breadcrumb -->
        <nav class="d-none d-md-block" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="user-edit">Empleados</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Agregar Empleados</li>
            </ol>
        </nav>
        <!-- End Breadcrumb -->

        <div class="mb-3 mb-md-4 d-flex justify-content-between">
            <div class="h3 mb-0">Agregar Empleados</div>
        </div>

        <!-- Form -->
        <div>
            <!-- <form> -->
            <div class="form-row">
                <div class="form-group col-12 col-md-6">
                    <label for="nombre_empleado">Nombre</label>
                    <input type="text" class="form-control" value="" id="nombre_empleado" name="nombre_empleado"
                        placeholder="Nombre del empleado">
                </div>
                <div class="form-group col-12 col-md-6">
                    <label for="correo_empleado">Correo</label>
                    <input type="email" class="form-control" value="" id="correo_empleado" name="correo_empleado"
                        placeholder="correo@dominio.com" required>
                </div>

                <!-- <div class="form-group col-12 col-md-6">
                        <label for="name">Empleado</label>
                        <input type="text" class="form-control" value="" id="Empleado" name="Empleado"
                            placeholder="empleado actual?">
                    </div> -->
                <div class="form-group col-12 col-md-6">
                    <label for="cede_empleado">Cede</label>
                    <input type="text" class="form-control" value="" id="cede_empleado" name="cede_empleado"
                        placeholder="Cede del empleado">
                </div>
                <div class="form-group col-12 col-md-6">
                    <label for="Fecha_ingreso_empleado">Fecha de ingreso</label>
                    <input type="date" class="form-control" id="Fecha_ingreso_empleado" name="Fecha_ingreso_empleado">
                </div>
                <div class="form-group col-12 col-md-6">
                        <label for="cargo_empleado">Cargo</label>
                        <input type="text" class="form-control" value="" id="cargo_empleado" name="cargo_empleado"
                            placeholder="cargo de usuario">
                    </div>
                <div class="form-group col-12 col-md-6">
                        <label for="area_empleado">Area</label>
                        <input type="text" class="form-control" value="" id="area_empleado" name="area_empleado"
                            placeholder="area de usuario">
                    </div>

            </div>
            <!-- <div class="form-row">
                    <div class="form-group col-12 col-md-6">
                        <label for="password">Contraseña</label>
                        <input type="password" class="form-control" value="" id="password" name="password"
                            placeholder="Nueva contraseña">
                    </div>
                    <div class="form-group col-12 col-md-6">Confirmar contraseña</label>
                        <input type="password" class="form-control" value="" id="password_confirm"
                            name="password_confirm" placeholder="Confirmar contraseña">
                    </div>
                </div>
                <div class="custom-control custom-switch mb-2">
                    <input type="checkbox" class="custom-control-input" id="randomPassword">
                    <label class="custom-control-label" for="randomPassword">Crear contraseña aleatoria</label>
                </div> -->

            <button id="btn_agregar_empleados" type="submit" class="btn btn-primary float-right">Crear</button>
            <!-- <input  id="obtener_datos_usuarios" type="submit"  value="hoa"> -->
            <!-- </form> -->
        </div>
        <!-- End Form -->
    </div>
</div>