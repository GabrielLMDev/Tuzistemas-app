const search_group_form = document.getElementById('search_group_form');
search_group_form.addEventListener('submit', function (e) {
    e.preventDefault();
    const groupSelect = document.getElementById('groupSelection');
    let group = groupSelect.value;
    const url = '../../vendor/php/getGroup.php';
    const data = {
        group: group,
    };
    const params = new URLSearchParams(data);
    const fullURL = `${url}?${params}`;

    fetch(fullURL)
        .then(response => response.json())
        .then(data => {

            const table = document.getElementById('usuariosTable');
            const tbody = table.querySelector('tbody');
            tbody.innerHTML = '';
            data.forEach(user => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td class="fw-normal text-white mb-1">${user.U_name}</td>
                    <td class="fw-normal text-white mb-1">${user.U_mail}</td>
                    <td class="fw-normal text-white mb-1">${user.U_phone}</td>
                    <td class="fw-normal text-white mb-1">${user.U_enrollment}</td>
                `;
                tbody.appendChild(row);
            });

            if (data.length > 0) {
                table.classList.remove('hidden');
            }
        })
        .catch(error => console.error('Error:', error));

    const urlTeacher = '../../vendor/php/getteacherGroup.php';
    const paramT = new URLSearchParams(data);
    const URLT = `${urlTeacher}?${paramT}`;
    fetch(URLT)
        .then(response => response.json())
        .then(data => {
            if (data.length > 0) {
                const table = document.getElementById('docentesTable');
                const tbody = table.querySelector('tbody');
                tbody.innerHTML = '';
                data.forEach(docente => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                    <td class="fw-normal text-white mb-1">${docente.profesores}</td>
                `;
                    tbody.appendChild(row);
                });
                table.classList.remove('hidden');
            } else if (data == 0) {
                const table = document.getElementById('docentesTable');
                const tbody = table.querySelector('tbody');
                tbody.innerHTML = '';
                const row = document.createElement('tr');
                row.innerHTML = `
                <td class="fw-normal text-white mb-1">Sin Docente</td>
            `;
                tbody.appendChild(row);
                table.classList.remove('hidden');
            }
        })
        .catch(error => console.error('Error:', error));
});