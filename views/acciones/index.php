<div class="page-header"><h3>Acciones registradas</h3></div>
<table class="table table-bordered table-striped">
    <thead><tr><th>ID</th><th>Usuario</th><th>Rol</th><th>Acción</th><th>Entidad</th><th>Detalle</th><th>Fecha</th><th>Acciones</th></tr></thead>
    <tbody>
    <?php foreach ($rows as $r): ?>
        <tr>
            <td><?php echo (int) $r['id']; ?></td>
            <td><?php echo htmlspecialchars($r['user_correo'] ?? '-'); ?></td>
            <td><?php echo htmlspecialchars($r['rol']); ?></td>
            <td><?php echo htmlspecialchars($r['accion']); ?></td>
            <td><?php echo htmlspecialchars($r['entidad']); ?></td>
            <td><?php echo htmlspecialchars($r['detalle']); ?></td>
            <td><?php echo htmlspecialchars($r['created_at']); ?></td>
            <td>
                <button class="btn btn-info btn-xs" data-toggle="modal" data-target="#viewModal" onclick="viewRecord(<?php echo (int) $r['id']; ?>, '<?php echo htmlspecialchars($r['user_correo'] ?? '-'); ?>', '<?php echo htmlspecialchars($r['rol']); ?>', '<?php echo htmlspecialchars($r['accion']); ?>', '<?php echo htmlspecialchars($r['entidad']); ?>', '<?php echo htmlspecialchars($r['detalle']); ?>', '<?php echo htmlspecialchars($r['created_at']); ?>')">
                    <span class="glyphicon glyphicon-eye-open"></span>
                </button>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<?php if (!empty($pages) && $pages > 1): ?>
    <nav>
        <ul class="pagination">
            <li class="<?php echo $page <= 1 ? 'disabled' : ''; ?>"><a href="index.php?controller=acciones&action=index&page=<?php echo max(1, $page - 1); ?>">«</a></li>
            <?php for ($i = 1; $i <= $pages; $i++): ?>
                <li class="<?php echo $i === (int) $page ? 'active' : ''; ?>"><a href="index.php?controller=acciones&action=index&page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
            <?php endfor; ?>
            <li class="<?php echo $page >= $pages ? 'disabled' : ''; ?>"><a href="index.php?controller=acciones&action=index&page=<?php echo min($pages, $page + 1); ?>">»</a></li>
        </ul>
    </nav>
<?php endif; ?>

<!-- Modal para Ver Detalles -->
<div class="modal fade" id="viewModal" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><span class="glyphicon glyphicon-info-sign"></span> Detalles de la Acción</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label><strong>ID:</strong></label>
                            <p id="viewId"></p>
                        </div>
                        <div class="form-group">
                            <label><strong>Usuario:</strong></label>
                            <p id="viewUsuario"></p>
                        </div>
                        <div class="form-group">
                            <label><strong>Rol:</strong></label>
                            <p id="viewRol"></p>
                        </div>
                        <div class="form-group">
                            <label><strong>Acción:</strong></label>
                            <p id="viewAccion"></p>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label><strong>Entidad:</strong></label>
                            <p id="viewEntidad"></p>
                        </div>
                        <div class="form-group">
                            <label><strong>Detalle:</strong></label>
                            <p id="viewDetalle"></p>
                        </div>
                        <div class="form-group">
                            <label><strong>Fecha:</strong></label>
                            <p id="viewFecha"></p>
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
function viewRecord(id, usuario, rol, accion, entidad, detalle, fecha) {
    document.getElementById('viewId').textContent = id;
    document.getElementById('viewUsuario').textContent = usuario;
    document.getElementById('viewRol').textContent = rol;
    document.getElementById('viewAccion').textContent = accion;
    document.getElementById('viewEntidad').textContent = entidad;
    document.getElementById('viewDetalle').textContent = detalle;
    document.getElementById('viewFecha').textContent = fecha;
}
</script>
