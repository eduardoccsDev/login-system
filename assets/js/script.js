document.addEventListener('DOMContentLoaded', function() {
    document.querySelector('#addNew').addEventListener('click', function() {
        // Cria o overlay
        var overlay = document.createElement('div');
        overlay.className = 'overlay';
        overlay.id = 'overlay';

        // Cria o popup
        var popup = document.createElement('div');
        popup.className = 'popup';
        popup.id = 'popup';

        // Cria o conteúdo do popup
        var popupContent = document.createElement('div');
        popupContent.innerHTML = '<p>Este é o conteúdo do popup</p>';

        // Cria o botão de fechar
        var closeButton = document.createElement('button');
        closeButton.className = 'close-btn';
        closeButton.id = 'closePopup';
        closeButton.textContent = 'Close';

        // Adiciona o conteúdo e o botão ao popup
        popup.appendChild(popupContent);
        popup.appendChild(closeButton);

        // Adiciona o overlay e o popup ao body
        document.body.appendChild(overlay);
        document.body.appendChild(popup);

        // Travar o scroll da tela
        document.body.classList.add('no-scroll');

        // Adiciona evento ao botão de fechar
        document.getElementById('closePopup').addEventListener('click', function() {
            // Remove o popup e o overlay
            document.body.removeChild(popup);
            document.body.removeChild(overlay);

            // Destravar o scroll da tela
            document.body.classList.remove('no-scroll');
        });
    });
});
