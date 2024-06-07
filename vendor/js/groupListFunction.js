const search_group_form = document.getElementById('search_group_form');
search_group_form.addEventListener('submit', function (e) {
    e.preventDefault();
    const groupSelect = document.getElementById('groupSelect');
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
                    <td class="text-white">${user.U_name}</td>
                    <td class="text-white">${user.U_mail}</td>
                    <td class="text-white">${user.U_phone}</td>
                    <td class="text-white">${user.U_enrollment}</td>
                `;
                tbody.appendChild(row);
            });

            if (data.length > 0) {
                table.classList.remove('hidden');
            }
        })
        .catch(error => console.error('Error:', error));
});