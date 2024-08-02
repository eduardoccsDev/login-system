document.addEventListener('DOMContentLoaded', function () {
    const popup = document.getElementById('disciplinePopup');
    const overlay = document.querySelector('.overlay');
    const closeButton = popup.querySelector('.close-btn');
    const disciplineTableBody = document.querySelector('#disciplineTable tbody');

    if (!popup) {
        console.error('O elemento popup não foi encontrado!');
        return;
    }

    closeButton.addEventListener('click', function () {
        popup.style.display = 'none';
        overlay.style.display = 'none';
        document.body.classList.remove('no-scroll');
    });

    window.addEventListener('click', function (event) {
        if (event.target == popup) {
            popup.style.display = 'none';
        }
    });

    // Adiciona o listener de clique a todos os botões de disciplinas
    document.querySelectorAll('button[data-course-id]').forEach(button => {
        button.addEventListener('click', function () {
            const courseId = this.getAttribute('data-course-id');

            // Requisita as disciplinas para o curso selecionado
            fetch(`index.php?router=course&action=getDisciplines&courseId=${courseId}`)
                .then(response => response.json())
                .then(data => {
                    // Limpa a tabela antes de adicionar os novos dados
                    disciplineTableBody.innerHTML = '';

                    // Adiciona as disciplinas à tabela
                    data.forEach(discipline => {
                        const row = document.createElement('tr');
                        row.innerHTML = `
                            <td>${discipline.disciplineId}</td>
                            <td>${discipline.disciplineName}</td>
                            <td>${discipline.disciplineDescription}</td>
                        `;
                        disciplineTableBody.appendChild(row);
                    });

                    // Exibe o popup
                    popup.style.display = 'block';
                    overlay.style.display = 'block';
                    document.body.classList.add('no-scroll');
                })
                .catch(error => {
                    console.error('Erro ao buscar disciplinas:', error);
                });
        });
    });
});
