<div class="page-header">
    <h3>Docentes</h3>
</div>
<div class="row">
    <div class="col-xs-12">
        <a class="btn btn-success" href="index.php?controller=docentes&action=form"><span class="glyphicon glyphicon-plus"></span> Nuevo docente</a>
    </div>
</div>
<br>
<div class="table-responsive">
    <table class="table table-bordered table-striped table-hover">
        <thead>
        <tr>
            <th>ID</th><th>Nombre</th><th>Apellido</th><th>Correo</th><th>Acciones</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($rows as $r): ?>
            <tr>
                <td><?php echo (int) $r['id']; ?></td>
                <td><?php echo htmlspecialchars($r['nombre']); ?></td>
                <td><?php echo htmlspecialchars($r['apellido']); ?></td>
                <td><?php echo htmlspecialchars($r['correo']); ?></td>
                <td>
                    <div class="btn-group btn-group-xs" role="group">
                        <button class="btn btn-info" data-toggle="modal" data-target="#viewModal" onclick="viewRecord(<?php echo (int) $r['id']; ?>, '<?php echo htmlspecialchars($r['nombre']); ?>', '<?php echo htmlspecialchars($r['apellido']); ?>', '<?php echo htmlspecialchars($r['correo']); ?>', '<?php echo htmlspecialchars($r['sexo']); ?>', '<?php echo htmlspecialchars($r['fecha_nacimiento']); ?>', '<?php echo htmlspecialchars($r['fecha_registro']); ?>', '<?php echo htmlspecialchars($r['foto']); ?>')" title="Ver detalles">
                            <span class="glyphicon glyphicon-eye-open"></span>
                        </button>
                        <a class="btn btn-primary" href="index.php?controller=docentes&action=form&id=<?php echo (int) $r['id']; ?>" title="Editar">
                            <span class="glyphicon glyphicon-pencil"></span>
                        </a>
                        <a class="btn btn-danger" href="index.php?controller=docentes&action=delete&id=<?php echo (int) $r['id']; ?>" onclick="return confirm('¿Eliminar registro?');" title="Eliminar">
                            <span class="glyphicon glyphicon-trash"></span>
                        </a>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php if (!empty($pages) && $pages > 1): ?>
    <nav>
        <ul class="pagination">
            <li class="<?php echo $page <= 1 ? 'disabled' : ''; ?>"><a href="index.php?controller=docentes&action=index&page=<?php echo max(1, $page - 1); ?>">«</a></li>
            <?php for ($i = 1; $i <= $pages; $i++): ?>
                <li class="<?php echo $i === (int) $page ? 'active' : ''; ?>"><a href="index.php?controller=docentes&action=index&page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
            <?php endfor; ?>
            <li class="<?php echo $page >= $pages ? 'disabled' : ''; ?>"><a href="index.php?controller=docentes&action=index&page=<?php echo min($pages, $page + 1); ?>">»</a></li>
        </ul>
    </nav>
<?php endif; ?>

<!-- Modal para Ver Detalles -->
<div class="modal fade" id="viewModal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><span class="glyphicon glyphicon-info-sign"></span> Detalles del Docente</h4>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-condensed">
                        <tr>
                            <td><strong>ID:</strong></td>
                            <td id="viewId"></td>
                        </tr>
                        <tr>
                            <td><strong>Nombre:</strong></td>
                            <td id="viewNombre"></td>
                        </tr>
                        <tr>
                            <td><strong>Apellido:</strong></td>
                            <td id="viewApellido"></td>
                        </tr>
                        <tr>
                            <td><strong>Correo:</strong></td>
                            <td id="viewCorreo"></td>
                        </tr>
                        <tr>
                            <td><strong>Sexo:</strong></td>
                            <td id="viewSexo"></td>
                        </tr>
                        <tr>
                            <td><strong>Fecha Nacimiento:</strong></td>
                            <td id="viewFechaNacimiento"></td>
                        </tr>
                        <tr>
                            <td><strong>Fecha Registro:</strong></td>
                            <td id="viewFechaRegistro"></td>
                        </tr>
                        <tr>
                            <td><strong>Foto:</strong></td>
                            <td id="viewFoto"></td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<script>
function viewRecord(id, nombre, apellido, correo, sexo, fechaNacimiento, fechaRegistro, foto) {
    document.getElementById('viewId').textContent = id;
    document.getElementById('viewNombre').textContent = nombre;
    document.getElementById('viewApellido').textContent = apellido;
    document.getElementById('viewCorreo').textContent = correo;
    document.getElementById('viewSexo').textContent = sexo === '1' ? 'Masculino' : 'Femenino';
    document.getElementById('viewFechaNacimiento').textContent = fechaNacimiento;
    document.getElementById('viewFechaRegistro').textContent = fechaRegistro;
    document.getElementById('viewFoto').textContent = foto ? foto : '-';
}
</script>
