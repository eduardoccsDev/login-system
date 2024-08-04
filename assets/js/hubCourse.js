document.addEventListener('DOMContentLoaded', function () {
    const popup = document.getElementById('coursePopup');
    const overlay = document.querySelector('.overlay');
    const closeButton = popup.querySelector('.close-btn');
    const courseTableBody = document.querySelector('#courseTable tbody');

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
    document.querySelectorAll('button[data-hub-id]').forEach(button => {
        button.addEventListener('click', function () {
            const hubId = this.getAttribute('data-hub-id');

            // Requisita os cursos para o hub selecionado
            fetch(`index.php?router=hub&action=getCourses&hubId=${hubId}`)
                .then(response => response.json())
                .then(data => {
                    // Limpa a tabela antes de adicionar os novos dados
                    courseTableBody.innerHTML = '';

                    // Verifica se o array de cursos está vazio
                    if (data.length === 0) {
                        // Se não houver cursos, exibe uma mensagem informando
                        const messageRow = document.createElement('tr');
                        messageRow.innerHTML = `
                            <td colspan="4" style="text-align: center;">No courses available at this hub.</td>
                        `;
                        courseTableBody.appendChild(messageRow);
                    } else {
                        // Adiciona os cursos à tabela
                        data.forEach(course => {
                            const row = document.createElement('tr');
                            row.innerHTML = `
                                <td>${course.courseId}</td>
                                <td>${course.courseName}</td>
                                <td>${course.courseDescription}</td>
                                <td>${course.courseType}</td>
                            `;
                            courseTableBody.appendChild(row);
                        });
                    }

                    // Exibe o popup
                    popup.style.display = 'block';
                    overlay.style.display = 'block';
                    document.body.classList.add('no-scroll');
                })
                .catch(error => {
                    console.error('Erro ao buscar cursos:', error);
                });
        });
    });
});
