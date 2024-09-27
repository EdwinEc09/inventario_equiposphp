<div class="card mb-3 mb-md-4">

    <div class="card-body">
        <div id="alerta_agregar_asignacionhtml">

        </div>
        <!-- Breadcrumb -->
        <nav class="d-none d-md-block" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="#">Asignacion</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Crear Asignacion</li>
            </ol>
        </nav>
        <!-- End Breadcrumb -->

        <div class="mb-3 mb-md-4 d-flex justify-content-between">
            <div class="h3 mb-0">Agregar nueva Asignacion</div>
        </div>


        <!-- Form -->
        <div>

            <div class="form-row">
                <div class="form-group col-12 col-md-6">
                    <label for="empleado_asignacion">Empleado</label>

                    <select id="empleado_asignacion" name="empleado_asignacion" class="form-control">
                        <?php
                            // Llamamos a la función para obtener los estados
                            $empleados_asignar = $OS->empleados_listar_combo();
                            if ($empleados_asignar) {
                                echo '<option value="">Seleccionar</option>';
                                // Itera sobre los resultados y genera las opciones
                                foreach ($empleados_asignar as $row) {
                                    echo '<option value="' . $row->ID . '">' . $row->nombres . ' -  - ' . $row->cargo . '</option>';
                                }
                            } else {
                                echo '<option value="">No Hay empleados</option>';
                            }
                            ?>
                    </select>
                </div>
                <div class="form-group col-12 col-md-6">
                    <label for="equipo_asignacion">Equipos</label>

                    <select id="equipo_asignacion" name="equipo_asignacion" class="form-control">
                        <?php
                            // Llamamos a la función para obtener los estados
                            $equipos_asignar = $OS->equipos_listar_combo();
                            if ($equipos_asignar) {
                                echo '<option value="">Seleccionar</option>';
                                // Itera sobre los resultados y genera las opciones
                                foreach ($equipos_asignar as $row) {
                                    echo '<option value="' . $row->ID . '">T:  ' . $row->tipo . '  - M:  '. $row->marca .'  - SN:  ' . $row->serial . '</option>';
                                }
                            } else {
                                echo '<option value="">No Hay equipos</option>';
                            }
                            ?>
                    </select>
                </div>
                <div class="form-group col-12 col-md-6">
                    <label for="fecha_asignacion_asignaciones">Fecha de asignacion</label>
                    <input type="date" class="form-control" id="fecha_asignacion_asignaciones"
                        name="fecha_asignacion_asignaciones">
                </div>
                <div class="form-group col-12 col-md-6">
                    <label for="acta_firmada_asignacion">ACTA FIRMADA</label>

                    <select id="acta_firmada_asignacion" name="acta_firmada_asignacion" class="form-control">
                        <option value="">Seleccionar</option>
                        <option value="0">SI</option>
                        <option value="1">NO</option>
                    </select>
                </div>
                <!-- 
                <div class="form-group col-12 col-md-6">
                    <label for="email">Serial</label>
                    <input type="Text" class="form-control" value="" id="email" name="email" placeholder="Serial">
                </div> -->
            </div>

            <button type="submit" id="btn_agregar_asignacion" class="btn btn-primary float-right">Asignar</button>

        </div>
        <!-- End Form -->
    </div>
</div>