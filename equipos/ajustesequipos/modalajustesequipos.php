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


<!-- estados de equipos ---------------------------------------------------------------------------- -->

<!-- Modal agregar  estado de equipos -->
<div id="modalagregarestadosequipos" class="modal fade" role="dialog" aria-labelledby="modalagregarestadosequipos"
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
                        <div class="form-group col-12 col-md-12">
                            <label for="agregar_estados_estadoequipos">Estados</label>
                            <input type="text" class="form-control" value id="agregar_estados_estadoequipos"
                                name="agregar_estados_estadoequipos" placeholder="Estados de equipo">
                        </div>
                        <!--
                        <div class="form-group col-12 col-md-6">
                            <label for="email">Serial</label>
                            <input type="Text" class="form-control" value="" id="email" name="email" placeholder="Serial">
                        </div> -->
                        <div class="form-group col-12 col-md-12">
                            <label for="agregar_colorestado_estadoequipos">Seleccionar Color</label>
                            <input type="color" class="form-control" id="agregar_colorestado_estadoequipos"
                                name="agregar_colorestado_estadoequipos">
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


<!-- Modal actualizar  estado de equipos -->
<div id="modalactualizarestadosequipos" class="modal fade" role="dialog" aria-labelledby="modalactualizarestadosequipos"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Actualizar estados de
                    equipos </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Form -->
                <div>
                    <div class="form-row">
                        <div class="form-group col-6 col-md-12">
                            <label for="actualizar_ID_estadoequipos">ID del estado</label>
                            <div class="input-group">
                                <input type="text"
                                    class="form-control form-control-onfocus-inherit bg-transparent small text-muted"
                                    id="actualizar_ID_estadoequipos" readonly>
                            </div>
                        </div>
                        <div class="form-group col-12 col-md-12">
                            <label for="actualizar_estados_estadoequipos">Estados</label>
                            <input type="text" class="form-control" value id="actualizar_estados_estadoequipos"
                                name="actualizar_estados_estadoequipos" placeholder="Estados de equipo">
                        </div>
                        <!-- campo colores  -->
                        <div class="form-group col-12 col-md-12">
                            <label for="actualizar_colorestado_estadoequipos">Seleccionar Color</label>
                            <input type="color" class="form-control" id="actualizar_colorestado_estadoequipos"
                                name="actualizar_colorestado_estadoequipos">
                        </div>
                    </div>
                </div>
                <!-- End Form -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" id="btn_actuualizar_estadosequipos" class="btn btn-primary">Actualizar
                    Cambios</button>
            </div>
        </div>
    </div>
</div>
<!-- End Modal -->



<!-- equopos ---------------------------------------- -->
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
$tipos_equipos = $AjustesEquiposOS->tipos_equipos_listar_combo();
if ($tipos_equipos) {
    echo '<option value="">Seleccionar</option>';
    // Itera sobre los resultados y genera las opciones
    foreach ($tipos_equipos as $row) {
        echo '<option value="' . $row->tipo . '"> ' . $row->tipo . ' </option>';
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


<!-- Modal inactivr varios estados de equipos verempleados.php -->
<div id="modalinactivarvariosestadoequipos" class="modal fade" role="dialog"
    aria-labelledby="modalinactivarvariosestadoequipos" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Actualizar varios
                    empleados</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Form -->
                <div>
                    <div class="form-row">
                        <div id="id_estadoequipos_varios">
                        </div>

                        <div class="form-group col-12 col-md-12">
                            <label for="estado_estadoequipos_varios">Estado
                                de
                                Empleado</label>
                            <select id="estado_estadoequipos_varios" name="estado_estadoequipos_varios"
                                class="form-control">
                                <option value>Seleccionar</option>
                                <option value="0">Inactivo</option>
                                <option value="1">Activo</option>
                            </select>
                        </div>

                    </div>
                    <!-- End Form -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" id="btn_inactivar_estadoequipos" class="btn btn-primary">Actualizar <i
                            class="gd-save icon-text"></i></button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Modal -->





<!-- Modal ver mas informacion osea logs de estado de equipos estadoequipo.php -->
<div id="modalverlogsestadoequipos" class="modal fade" role="dialog" aria-labelledby="modalverlogsestadoequipos" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Logs de estado equipos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="max-height: 500px; overflow-y: auto;">
                <!-- Contenedor para la tabla -->
                <div class="table-responsive">
                    <table class="table text-nowrap mb-0">
                        <thead>
                            <tr>
                                <th class="font-weight-semi-bold border-top-0 py-2">#</th>
                                <th class="font-weight-semi-bold border-top-0 py-2">Customer</th>
                                <th class="font-weight-semi-bold border-top-0 py-2">Phone</th>
                                <th class="font-weight-semi-bold border-top-0 py-2">Amount</th>
                                <th class="font-weight-semi-bold border-top-0 py-2">Status</th>
                                <th class="font-weight-semi-bold border-top-0 py-2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="py-3">149531</td>
                                <td class="py-3">
                                    <div>John Doe</div>
                                    <div class="text-muted">Acme Inc.</div>
                                </td>
                                <td class="py-3">(000) 111-1234</td>
                                <td class="py-3">$1,230.00</td>
                                <td class="py-3">
                                    <span class="badge badge-pill badge-warning">Pending</span>
                                </td>
                                <td class="py-3">
                                    <div class="position-relative">
                                        <a id="dropDown16Invoker" class="link-dark d-flex" href="#" aria-controls="dropDown16" aria-haspopup="true" aria-expanded="false" data-unfold-target="#dropDown16" data-unfold-event="click" data-unfold-type="css-animation" data-unfold-duration="300" data-unfold-animation-in="fadeIn" data-unfold-animation-out="fadeOut">
                                            <i class="gd-more-alt icon-text"></i>
                                        </a>
                                        <ul id="dropDown16" class="unfold unfold-light unfold-top unfold-right position-absolute py-3 mt-1 unfold-css-animation unfold-hidden fadeOut" aria-labelledby="dropDown16Invoker" style="min-width: 150px; animation-duration: 300ms; right: 0px;">
                                            <li class="unfold-item">
                                                <a class="unfold-link media align-items-center text-nowrap" href="#">
                                                    <i class="gd-pencil unfold-item-icon mr-3"></i>
                                                    <span class="media-body">Edit</span>
                                                </a>
                                            </li>
                                            <li class="unfold-item">
                                                <a class="unfold-link media align-items-center text-nowrap" href="#">
                                                    <i class="gd-close unfold-item-icon mr-3"></i>
                                                    <span class="media-body">Delete</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            <!-- Más filas aquí -->
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<!-- End Modal -->