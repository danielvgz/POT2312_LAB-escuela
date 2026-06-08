<div class="page-header">
    <h3>Alumnos</h3>
</div>
<a class="btn btn-success" href="index.php?controller=alumnos&action=form"><span class="glyphicon glyphicon-plus"></span> Nuevo alumno</a>
<br><br>
<table class="table table-bordered table-striped">
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
                <button class="btn btn-info btn-xs" data-toggle="modal" data-target="#viewModal" onclick="viewRecord(<?php echo (int) $r['id']; ?>, '<?php echo htmlspecialchars($r['nombre']); ?>', '<?php echo htmlspecialchars($r['apellido']); ?>', '<?php echo htmlspecialchars($r['correo']); ?>', '<?php echo htmlspecialchars($r['sexo']); ?>', '<?php echo htmlspecialchars($r['fecha_nacimiento']); ?>', '<?php echo htmlspecialchars($r['fecha_registro']); ?>', '<?php echo htmlspecialchars($r['foto']); ?>')">
                    <span class="glyphicon glyphicon-eye-open"></span> Ver
                </button>
                <a class="btn btn-primary btn-xs" href="index.php?controller=alumnos&action=form&id=<?php echo (int) $r['id']; ?>">
                    <span class="glyphicon glyphicon-pencil"></span> Editar
                </a>
                <a class="btn btn-danger btn-xs" href="index.php?controller=alumnos&action=delete&id=<?php echo (int) $r['id']; ?>" onclick="return confirm('¿Eliminar registro?');">
                    <span class="glyphicon glyphicon-trash"></span> Eliminar
                </a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<?php if (!empty($pages) && $pages > 1): ?>
    <nav>
        <ul class="pagination">
            <li class="<?php echo $page <= 1 ? 'disabled' : ''; ?>"><a href="index.php?controller=alumnos&action=index&page=<?php echo max(1, $page - 1); ?>">«</a></li>
            <?php for ($i = 1; $i <= $pages; $i++): ?>
                <li class="<?php echo $i === (int) $page ? 'active' : ''; ?>"><a href="index.php?controller=alumnos&action=index&page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
            <?php endfor; ?>
            <li class="<?php echo $page >= $pages ? 'disabled' : ''; ?>"><a href="index.php?controller=alumnos&action=index&page=<?php echo min($pages, $page + 1); ?>">»</a></li>
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
                <h4 class="modal-title"><span class="glyphicon glyphicon-info-sign"></span> Detalles del Alumno</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label><strong>ID:</strong></label>
                            <p id="viewId"></p>
                        </div>
                        <div class="form-group">
                            <label><strong>Nombre:</strong></label>
                            <p id="viewNombre"></p>
                        </div>
                        <div class="form-group">
                            <label><strong>Apellido:</strong></label>
                            <p id="viewApellido"></p>
                        </div>
                        <div class="form-group">
                            <label><strong>Correo:</strong></label>
                            <p id="viewCorreo"></p>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label><strong>Sexo:</strong></label>
                            <p id="viewSexo"></p>
                        </div>
                        <div class="form-group">
                            <label><strong>Fecha Nacimiento:</strong></label>
                            <p id="viewFechaNacimiento"></p>
                        </div>
                        <div class="form-group">
                            <label><strong>Fecha Registro:</strong></label>
                            <p id="viewFechaRegistro"></p>
                        </div>
                        <div class="form-group">
                            <label><strong>Foto:</strong></label>
                            <p id="viewFoto"></p>
                        </div>
                    </div>
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
