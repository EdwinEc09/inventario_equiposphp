<div class="card mb-3 mb-md-4">

    <div class="card-body">

        <div id="alerta_agregar_equiposhtml">

        </div>
        <!-- Breadcrumb -->
        <nav class="d-none d-md-block" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="#">Equipos</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Crear equipos</li>
            </ol>
        </nav>
        <!-- End Breadcrumb -->

        <div class="mb-3 mb-md-4 d-flex justify-content-between">
            <div class="h3 mb-0">Agregar nuevo equipo</div>
        </div>
 

        <!-- Form -->
        <div>


            <div class="form-row">
                <div class="form-group col-12 col-md-6">
                    <label for="tipo_equipo">Tipo de equipo</label>

                    <select id="tipo_equipo" name="tipo_equipo" class="form-control">
                        <?php
                            // Llamamos a la función para obtener los estados
                            $tipos_equipos = $AjustesEquiposOS->tipos_equipos_listar_combo();
                            if ($tipos_equipos) {
                                echo '<option value="">Seleccionar</option>';
                                // Itera sobre los resultados y genera las opciones
                                foreach ($tipos_equipos as $row) {
                                    echo '<option value="'.$row->tipo.'"> '.$row->tipo.' </option>';
                                }
                            } else {
                                echo '<option value="">No hay Tipos disponibles</option>';
                            }
                            ?>
                    </select>
                </div>

                <div class="form-group col-12 col-md-6">
                    <label for="marca_equipo">marca del equipo</label>
                    <input type="text" class="form-control" value="" id="marca_equipo" name="marca_equipo"
                        placeholder="Nombre de equipo">
                </div>
                <div class="form-group col-12 col-md-6">
                    <label for="serial_equipo">Serial</label>
                    <input type="text" class="form-control" value="" id="serial_equipo" name="serial_equipo"
                        placeholder="Serial del equipo">
                </div>

                <div class="form-group col-12 col-md-6">
                    <label for="dire_mac_wifi_equipo">Direccion mac Wifi</label>
                    <input type="text" class="form-control" value="" id="dire_mac_wifi_equipo"
                        name="dire_mac_wifi_equipo" placeholder="MAC Wifi">
                </div>


                <div class="form-group col-12 col-md-6">
                    <label for="dire_mac_ethernet_equipo">Direccion mac Ethernet </label>
                    <input type="text" class="form-control" value="" id="dire_mac_ethernet_equipo"
                        name="dire_mac_ethernet_equipo" placeholder="MAC Ethernet">
                </div>

                <div class="form-group col-12 col-md-6">
                    <label for="imei1_equipo">Numero de Imei 1 </label>
                    <input type="text" class="form-control" value="" id="imei1_equipo" name="imei1_equipo"
                        placeholder="Imei 1">
                </div>

                <div class="form-group col-12 col-md-6">
                    <label for="imei2_equipo">Numero de Imei 2 </label>
                    <input type="text" class="form-control" value="" id="imei2_equipo" name="imei2_equipo"
                        placeholder="Imei 2">
                </div>

                <div class="form-group col-12 col-md-6">
                    <label for="estado_equipo">Estado del equipo</label>
                    <!-- <select class="form-control" id="estado_equipo">
                        <option value="">Seleccionar</option>
                        <option value="1">Disponible</option>
                        <option value="2">Asignado</option>
                        <option value="3">Averiado</option>
                        <option value="4">Robado</option>
                        <option value="5">Otros</option>
                    </select> -->
                    <select id="estado_equipo" name="estado_equipo" class="form-control">
                        <?php
                            // Llamamos a la función para obtener los estados
                            $estados_equipos = $AjustesEquiposOS->estados_equipos_listar_combo();
                            if ($estados_equipos) {
                                echo '<option value="">Seleccionar</option>';
                                // Itera sobre los resultados y genera las opciones
                                foreach ($estados_equipos as $row) {
                                    echo '<option value="' . $row->ID . '">' . $row->nombre_estado . '</option>';
                                }
                            } else {
                                echo '<option value="">No hay estados disponibles</option>';
                            }
                            ?>
                    </select>
                </div>
            </div>
            <!-- tex area de observacion de equipos -->
            <div class="form-group">
                <label for="observacion_equipo">Obsercacion de el equipo</label>
                <textarea class="form-control" id="observacion_equipo" rows="3"></textarea>
            </div>
            <button type="submit" id="btn_agregar_equipos" class="btn btn-primary float-right">Guardar Equipos</button>

        </div>
        <!-- End Form -->
    </div>
</div>