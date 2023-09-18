<h1>Hola desde ventas</h1>

<h1 class="text-center">Formulario de ingreso de Ventas</h1>
        <div class="row justify-content-center">
            <form class="col-lg-8 border bg-light p-3">
            <input type="hidden" name="venta_id" id="venta_id">

            <!-- //!Nombre del Cliente -->
            <div class="row mb-3">
                    <div class="col-lg-12">
                        <label for="venta_cliente">Clientes</label>
                        <select class="form-control" name="venta_cliente" id="venta_cliente">
                            <option value="">Seleccione un Cliente...</option>
                                <?php foreach ($clientes as $key => $cliente) : ?>
                                        <option value="<?= $cliente['cliente_id'] ?>"> <?= $cliente['cliente_nombre'] ?></option>
                                <?php endforeach ?>
                        </select>
                    </div>
                </div>

                <!-- //!Fecha de la venta -->
                <div class="row mb-3">
                    <div class="col">
                    <label for="venta_fecha">fecha de la venta</label>
                        <input type="date" name="venta_fecha" id="venta_fecha" class="form-control">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-lg-2">
                        <button type="submit" id="btnGuardar" class="btn btn-primary w-100">Guardar</button>
                    </div>
                    <div class="col-lg-2">
                        <button type="button" id="btnModificar" class="btn btn-warning w-100">Modificar</button>
                    </div>
                    <div class="col-lg-2">
                        <button type="button" id="btnBuscar" class="btn btn-info w-100">Buscar</button>
                    </div>
                    <div class="col-lg-2">
                        <button type="button" id="btnCancelar" class="btn btn-danger w-100">Cancelar</button>
                    </div>

                </div>
            </form>
        </div>
        <div class="row justify-content-center" id="divTabla">
            <div class="col-lg-8">
                <h2>Listado de Ventas</h2>
                <table class="table table-bordered table-hover" id="tablaVenta">
                    <thead class="table-dark">
                        <tr>
                            <th>NO. </th>
                            <th>NOMBRE DEL CLIENTE</th>
                            <th>FECHA DE LA VENTA</th>
                            <th>MODIFICAR</th>
                            <th>ELIMINAR</th>
                        </tr>
                    </thead>
                        <tbody>
                        </tbody>
                </table>
            </div>
        </div>
        </div>
<script src="<?= asset('./build/js/ventas/index.js') ?>"></script>