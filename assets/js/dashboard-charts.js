document.addEventListener('DOMContentLoaded', function () {
    function fetchJSON(url) {
        return fetch(url, {credentials: 'same-origin'}).then(function (res) {
            if (!res.ok) throw new Error('Network response was not ok');
            return res.json();
        });
    }

    function createBar(ctx, labels, data, title) {
        return new Chart(ctx, {
            type: 'bar',
            data: { labels: labels, datasets: [{ label: title, data: data, backgroundColor: 'rgba(54, 162, 235, 0.6)'}] },
            options: { responsive: true, maintainAspectRatio: false }
        });
    }

    function createPie(ctx, labels, data, title) {
        return new Chart(ctx, {
            type: 'pie',
            data: { labels: labels, datasets: [{ data: data, backgroundColor: labels.map(function(_,i){ return 'hsl(' + ((i*40)%360) + ',70%,50%)'; }) }] },
            options: { responsive: true, maintainAspectRatio: false }
        });
    }

    function createLine(ctx, labels, data, title) {
        return new Chart(ctx, {
            type: 'line',
            data: { labels: labels, datasets: [{ label: title, data: data, fill: false, borderColor: 'rgba(75,192,192,1)'}] },
            options: { responsive: true, maintainAspectRatio: false }
        });
    }

    // endpoints
    var base = 'index.php?controller=dashboard&action=';

    var c1 = document.getElementById('chartMatriculasMateria');
    var c2 = document.getElementById('chartAlumnosDocente');
    var c3 = document.getElementById('chartCreditsMateria');
    var c4 = document.getElementById('chartMatriculasRecent');

    if (c1) {
        fetchJSON(base + 'matriculasByMateria').then(function (d) {
            createBar(c1.getContext('2d'), d.labels, d.data, 'Matrículas');
        }).catch(function (err) { console.error(err); });
    }

    if (c2) {
        fetchJSON(base + 'alumnosByDocente').then(function (d) {
            createPie(c2.getContext('2d'), d.labels, d.data, 'Alumnos por docente');
        }).catch(function (err) { console.error(err); });
    }

    if (c3) {
        fetchJSON(base + 'creditsByMateria').then(function (d) {
            createBar(c3.getContext('2d'), d.labels, d.data, 'Créditos');
        }).catch(function (err) { console.error(err); });
    }

    if (c4) {
        fetchJSON(base + 'matriculasRecent').then(function (d) {
            createLine(c4.getContext('2d'), d.labels, d.data, 'Matrículas recientes');
        }).catch(function (err) { console.error(err); });
    }
});
