<div class="page-header"><h3>Materias</h3></div>
<div class="row">
    <div class="col-xs-12">
        <a class="btn btn-success" href="index.php?controller=materias&action=form"><span class="glyphicon glyphicon-plus"></span> Nueva materia</a>
    </div>
</div>
<br>
<div class="table-responsive">
    <table class="table table-bordered table-striped table-hover">
        <thead><tr><th>ID</th><th>Nombre</th><th>Descripción</th><th>Créditos</th><th>Docente</th><th>Acciones</th></tr></thead>
        <tbody>
        <?php foreach ($rows as $r): ?>
            <tr>
                <td><?php echo (int) $r['id']; ?></td>
                <td><?php echo htmlspecialchars($r['nombre']); ?></td>
                <td><?php echo htmlspecialchars($r['descripcion']); ?></td>
                <td><?php echo htmlspecialchars($r['creditos']); ?></td>
                <td><?php echo htmlspecialchars(($r['docente_nombre'] ?? '') . ' ' . ($r['docente_apellido'] ?? '')); ?></td>
                <td>
                    <div class="btn-group btn-group-xs" role="group">
                        <button class="btn btn-info" data-toggle="modal" data-target="#viewModal" onclick="viewRecord(<?php echo (int) $r['id']; ?>, '<?php echo htmlspecialchars($r['nombre']); ?>', '<?php echo htmlspecialchars($r['descripcion']); ?>', '<?php echo htmlspecialchars($r['creditos']); ?>', '<?php echo htmlspecialchars(($r['docente_nombre'] ?? '') . ' ' . ($r['docente_apellido'] ?? '')); ?>', '<?php echo htmlspecialchars($r['estado'] ?? 'Activo'); ?>', '<?php echo htmlspecialchars($r['fecha_creacion'] ?? ''); ?>')" title="Ver detalles">
                            <span class="glyphicon glyphicon-eye-open"></span>
                        </button>
                        <a class="btn btn-primary" href="index.php?controller=materias&action=form&id=<?php echo (int) $r['id']; ?>" title="Editar">
                            <span class="glyphicon glyphicon-pencil"></span>
                        </a>
                        <a class="btn btn-danger" href="index.php?controller=materias&action=delete&id=<?php echo (int) $r['id']; ?>" onclick="return confirm('¿Eliminar registro?');" title="Eliminar">
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
            <li class="<?php echo $page <= 1 ? 'disabled' : ''; ?>"><a href="index.php?controller=materias&action=index&page=<?php echo max(1, $page - 1); ?>">«</a></li>
            <?php for ($i = 1; $i <= $pages; $i++): ?>
                <li class="<?php echo $i === (int) $page ? 'active' : ''; ?>"><a href="index.php?controller=materias&action=index&page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
            <?php endfor; ?>
            <li class="<?php echo $page >= $pages ? 'disabled' : ''; ?>"><a href="index.php?controller=materias&action=index&page=<?php echo min($pages, $page + 1); ?>">»</a></li>
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
                <h4 class="modal-title"><span class="glyphicon glyphicon-info-sign"></span> Detalles de la Materia</h4>
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
                            <td><strong>Descripción:</strong></td>
                            <td id="viewDescripcion"></td>
                        </tr>
                        <tr>
                            <td><strong>Créditos:</strong></td>
                            <td id="viewCreditos"></td>
                        </tr>
                        <tr>
                            <td><strong>Docente:</strong></td>
                            <td id="viewDocente"></td>
                        </tr>
                        <tr>
                            <td><strong>Estado:</strong></td>
                            <td id="viewEstado"></td>
                        </tr>
                        <tr>
                            <td><strong>Fecha Creación:</strong></td>
                            <td id="viewFechaCreacion"></td>
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
function viewRecord(id, nombre, descripcion, creditos, docente, estado, fechaCreacion) {
    document.getElementById('viewId').textContent = id;
    document.getElementById('viewNombre').textContent = nombre;
    document.getElementById('viewDescripcion').textContent = descripcion;
    document.getElementById('viewCreditos').textContent = creditos;
    document.getElementById('viewDocente').textContent = docente;
    document.getElementById('viewEstado').textContent = estado;
    document.getElementById('viewFechaCreacion').textContent = fechaCreacion;
}
</script>