<div class="card mb-3 mb-md-4">

    <div class="card-body">
        <!-- Breadcrumb -->
        <nav class="d-none d-md-block" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="empleados">Empleados</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Todos los Empleados</li>
            </ol>
        </nav>
        <!-- End Breadcrumb -->
         <!-- boton para enviar correo desde emailjs  -->
        <button id="btn-enviar-correo" type="submit" class="btn btn-primary float-right" disabled>Enviar correo</button>
        <!--  -->
        <div class="mb-3 mb-md-4 d-flex justify-content-between">
            <div class="h3 mb-0">Empleados</div>
        </div>


        <!-- empleados -->
        <div class="table-responsive-xl" style="max-height: 400px; overflow-y: auto;">
            <table class="table text-nowrap mb-0" >
                <thead>
                    <tr>
                        <th class="font-weight-semi-bold border-top-0 py-2"><button type="button" id="seleccionarTodos">#</button></th>
                        <th class="font-weight-semi-bold border-top-0 py-2">Nombre</th>
                        <th class="font-weight-semi-bold border-top-0 py-2">Correo</th>
                        <th class="font-weight-semi-bold border-top-0 py-2">cede</th>
                        <th class="font-weight-semi-bold border-top-0 py-2">Fecha de creacion</th>
                        <th class="font-weight-semi-bold border-top-0 py-2">Fecha de ingreso</th>
                        <th class="font-weight-semi-bold border-top-0 py-2">Cargo</th>
                        <th class="font-weight-semi-bold border-top-0 py-2">Area</th>
                        <th class="font-weight-semi-bold border-top-0 py-2">Estado</th>
                        <th class="font-weight-semi-bold border-top-0 py-2">Acción</th>
                    </tr>
                </thead>
                <tbody id="tabla_usuarios">
                    <!-- Las filas se generarán aquí con AJAX -->
                </tbody>
            </table>
            <!-- esto es estatico osea evho a mano -->
            <div class="card-footer d-block d-md-flex align-items-center d-print-none">
                <div class="d-flex mb-2 mb-md-0">Showing 1 to 8 of 24 Entries</div>

                <nav class="d-flex ml-md-auto d-print-none" aria-label="Pagination">
                    <ul class="pagination justify-content-end font-weight-semi-bold mb-0">
                        <li class="page-item"> <a id="datatablePaginationPrev" class="page-link" href="#!"
                                aria-label="Previous"><i
                                    class="gd-angle-left icon-text icon-text-xs d-inline-block"></i></a>
                        </li>
                        <li class="page-item d-none d-md-block"><a id="datatablePaginationPage0"
                                class="page-link active" href="#!" data-dt-page-to="0">1</a></li>
                        <li class="page-item d-none d-md-block"><a id="datatablePagination1" class="page-link" href="#!"
                                data-dt-page-to="1">2</a></li>
                        <li class="page-item d-none d-md-block"><a id="datatablePagination2" class="page-link" href="#!"
                                data-dt-page-to="2">3</a></li>
                        <li class="page-item"> <a id="datatablePaginationNext" class="page-link" href="#!"
                                aria-label="Next"><i
                                    class="gd-angle-right icon-text icon-text-xs d-inline-block"></i></a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        <!-- End empleados -->
    </div>
</div>