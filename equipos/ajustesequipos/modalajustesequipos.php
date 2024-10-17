<!-- Modal agregar tipo de equipos  -->
<div id="modaltiposequipos" class="modal fade" role="dialog" aria-labelledby="modaltiposequipos" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agrega Tipos de
                    equipos </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <!-- Form -->
                <div>
                    <div class="form-row">

                        <div class="form-group col-12 col-md-12">
                            <label for="tipos_equipos_tiposequipos">Tipo de
                                equipo</label>
                            <input type="text" class="form-control" value id="tipos_equipos_tiposequipos"
                                name="tipos_equipos_tiposequipos" placeholder="Tipo de equipo">
                        </div>
                        <!-- 
                        <div class="form-group col-12 col-md-6">
                            <label for="email">Serial</label>
                            <input type="Text" class="form-control" value="" id="email" name="email" placeholder="Serial">
                        </div> -->
                    </div>

                </div>
                <!-- End Form -->

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" id="btn_agregar_tiposequipos" class="btn btn-primary">Guardar Cambios</button>
            </div>
        </div>
    </div>
</div>
<!-- End Modal -->

<!-- Modal agregar  estado de equipos -->
<div id="modalestadosequipos" class="modal fade" role="dialog" aria-labelledby="modalestadosequipos" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">estados de
                    equipos </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Form -->
                <div>
                    <div class="form-row">
                        <div class="form-group col-12 col-md-12">
                            <label for="estados_equipos_tiposequipos">Estados</label>
                            <input type="text" class="form-control" value id="estados_equipos_tiposequipos"
                                name="estados_equipos_tiposequipos" placeholder="Estados de equipo">
                        </div>
                        <!-- 
                        <div class="form-group col-12 col-md-6">
                            <label for="email">Serial</label>
                            <input type="Text" class="form-control" value="" id="email" name="email" placeholder="Serial">
                        </div> -->
                        <div class="form-group col-12 col-md-12">
                            <label for="colorestado_equipos_tiposequipos">Seleccionar Color</label>
                            <input type="color" class="form-control" id="colorestado_equipos_tiposequipos" name="colorestado_equipos_tiposequipos">
                        </div>
                    </div>
                </div>
                <!-- End Form -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" id="btn_agregar_estadosequipos" class="btn btn-primary">Guardar Cambios</button>
            </div>
        </div>
    </div>
</div>
<!-- End Modal -->

<!-- Modal actualizar equipos verequipos.php -->
<div id="modalactualizarequipos" class="modal fade" role="dialog" aria-labelledby="modalactualizarequipos"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">estados de
                    equipos </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Form -->
                <div>
                    <div class="form-row">
                        <div id="id_equipo_actualizar">
                            <!-- <div id="id_equipos_actualizar" class="form-group col-12 col-md-6"> -->
                            <!-- <label for="id_equipos_actualizar">ID</label> -->
                            <!-- <input type="text" class="form-control" value
                                id="id_equipos_actualizar"
                                name="<id_equipos_actualizar>"
                                placeholder="Nombre del equipos"> -->
                        </div>
                        <div class="form-group col-12 col-md-6">
                            <label for="tipo_equipo_actualizar">Tipo de equipo</label>

                            <select id="tipo_equipo_actualizar" name="tipo_equipo_actualizar" class="form-control">
                                <?php
                                    // Llamamos a la función para obtener los estados
                                    $tipos_equipos = $EquiposOS->tipos_equipos_listar_combo();
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
                            <label for="marca_equipo_actualizar">marca del equipo</label>
                            <input type="text" class="form-control" value="" id="marca_equipo_actualizar"
                                name="marca_equipo_actualizar" placeholder="Nombre de equipo">
                        </div>
                        <div class="form-group col-12 col-md-6">
                            <label for="serial_equipo_actualizar">Serial</label>
                            <input type="text" class="form-control" value="" id="serial_equipo_actualizar"
                                name="serial_equipo_actualizar" placeholder="Serial del equipo">
                        </div>

                        <div class="form-group col-12 col-md-6">
                            <label for="dire_mac_wifi_equipo_actualizar">Direccion mac Wifi</label>
                            <input type="text" class="form-control" value="" id="dire_mac_wifi_equipo_actualizar"
                                name="dire_mac_wifi_equipo_actualizar" placeholder="MAC Wifi">
                        </div>


                        <div class="form-group col-12 col-md-6">
                            <label for="dire_mac_ethernet_equipo_actualizar">Direccion mac Ethernet </label>
                            <input type="text" class="form-control" value="" id="dire_mac_ethernet_equipo_actualizar"
                                name="dire_mac_ethernet_equipo_actualizar" placeholder="MAC Ethernet">
                        </div>

                        <div class="form-group col-12 col-md-6">
                            <label for="imei1_equipo_actualizar">Numero de Imei 1 </label>
                            <input type="text" class="form-control" value="" id="imei1_equipo_actualizar"
                                name="imei1_equipo_actualizar" placeholder="Imei 1">
                        </div>

                        <div class="form-group col-12 col-md-6">
                            <label for="imei2_equipo_actualizar">Numero de Imei 2 </label>
                            <input type="text" class="form-control" value="" id="imei2_equipo_actualizar"
                                name="imei2_equipo_actualizar" placeholder="Imei 2">
                        </div>

                        <div class="form-group col-12 col-md-6">
                            <label for="estado_equipo_actualizar">Estado del equipo</label>
                            <!-- <select class="form-control" id="estado_equipo_actualizar">
                                <option value="">Seleccionar</option>
                                <option value="1">Disponible</option>
                                <option value="2">Asignado</option>
                                <option value="3">Averiado</option>
                                <option value="4">Robado</option>
                                <option value="5">Otros</option>
                            </select> -->
                            <select id="estado_equipo_actualizar" name="estado_equipo_actualizar" class="form-control">
                                <?php
                                    // Llamamos a la función para obtener los estados
                                    $estados_equipos = $EquiposOS->estados_equipos_listar_combo();
                                    if ($estados_equipos) {
                                        echo '<option value="">Seleccionar</option>';
                                        // Itera sobre los resultados y genera las opciones
                                        foreach ($estados_equipos as $row) {
                                            echo '<option value="' . $row->estado . '">' . $row->estado . '</option>';
                                        }
                                    } else {
                                        echo '<option value="">No hay estados disponibles</option>';
                                    }
                                    ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="observacion_equipo_actualizar">Obsercacion de el equipo</label>
                        <textarea class="form-control" id="observacion_equipo_actualizar" rows="3"></textarea>
                    </div>
                </div>
                <!-- End Form -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" id="btn_actualizar_equipos" class="btn btn-primary">Actualizar <i
                        class="gd-save icon-text"></i></button>
            </div>
        </div>
    </div>
</div>
<!-- End Modal -->