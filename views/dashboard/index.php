<?php
// Vista del dashboard con canvases para Chart.js
?>
<div class="page-header">
    <h3>Dashboard</h3>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">Matrículas por materia</div>
            <div class="panel-body">
                <canvas id="chartMatriculasMateria" width="400" height="250"></canvas>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">Alumnos por docente</div>
            <div class="panel-body">
                <canvas id="chartAlumnosDocente" width="400" height="250"></canvas>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">Créditos por materia</div>
            <div class="panel-body">
                <canvas id="chartCreditsMateria" width="400" height="250"></canvas>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">Matrículas recientes (últimos 30 días)</div>
            <div class="panel-body">
                <canvas id="chartMatriculasRecent" width="400" height="250"></canvas>
            </div>
        </div>
    </div>
</div>

<!-- script específico para el dashboard -->
<script src="<?php echo rtrim(BASE_URL, '/\\') . '/../escuela_it/assets/js/dashboard-charts.js'; ?>"></script>
