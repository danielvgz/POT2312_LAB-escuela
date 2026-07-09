<?php if (!empty($canManage)): ?>
    <button class="btn btn-success" data-toggle="modal" data-target="#massEnrollModal">Inscribir varios</button>
<?php endif; ?>

<div class="table-responsive">
    <table class="table table-bordered table-striped table-hover">
        <thead>
        <tr>
            <th>ID</th>
            <th>Alumno</th>
            <th>Materia</th>
            <th>Docente</th>
            <th>Obj1</th>
            <th>Obj2</th>
            <th>Obj3</th>
            <th>Obj4</th>
            <?php if ($canManage): ?><th>Acciones</th><?php endif; ?>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($rows as $r): ?>
            <tr>
                <td><?php echo (int) $r['id']; ?></td>
                <td><?php echo htmlspecialchars($r['alumno_nombre'] . ' ' . $r['alumno_apellido']); ?></td>
                <td><?php echo htmlspecialchars($r['materia_nombre']); ?></td>
                <td><?php echo htmlspecialchars($r['docente_nombre'] . ' ' . $r['docente_apellido']); ?></td>
                <td><?php echo htmlspecialchars($r['obj1']); ?></td>
                <td><?php echo htmlspecialchars($r['obj2']); ?></td>
                <td><?php echo htmlspecialchars($r['obj3']); ?></td>
                <td><?php echo htmlspecialchars($r['obj4']); ?></td>
                <?php if ($canManage): ?>
                <td>
                    <div class="btn-group btn-group-xs" role="group">
                        <a class="btn btn-primary" href="index.php?controller=matriculas&action=form&id=<?php echo (int) $r['id']; ?>" title="Editar"><span class="glyphicon glyphicon-pencil"></span></a>
                        <a class="btn btn-danger" href="index.php?controller=matriculas&action=delete&id=<?php echo (int) $r['id']; ?>" onclick="return confirm('¿Eliminar registro?');" title="Eliminar"><span class="glyphicon glyphicon-trash"></span></a>
                    </div>
                </td>
                <?php endif; ?>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- Modal para inscripción múltiple -->
<div class="modal fade" id="massEnrollModal" tabindex="-1" role="dialog" aria-labelledby="massEnrollLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <form method="post" action="index.php?controller=matriculas&action=massEnroll">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" id="massEnrollLabel">Inscribir varios alumnos</h4>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="materia_id_select">Materia</label>
            <select id="materia_id_select" name="materia_id" class="form-control" required>
              <option value="">-- Seleccione --</option>
              <?php foreach ($materias as $m): ?>
                <option value="<?php echo (int)$m['id']; ?>"><?php echo htmlspecialchars($m['nombre']); ?> (Cred: <?php echo (int)$m['creditos']; ?>)</option>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="form-group">
            <label>Alumnos</label>
            <div style="max-height:300px; overflow:auto; border:1px solid #eee; padding:10px;">
              <?php foreach ($alumnos as $a): ?>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="alumno_ids[]" value="<?php echo (int)$a['id']; ?>">
                    <?php echo htmlspecialchars($a['nombre'] . ' ' . $a['apellido'] . (isset($a['correo']) ? ' (' . $a['correo'] . ')' : '')); ?>
                  </label>
                </div>
              <?php endforeach; ?>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary">Inscribir seleccionados</button>
        </div>
      </form>
    </div>
  </div>
</div>
