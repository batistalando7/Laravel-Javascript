<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Cadastrar Pessoa</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
    <h1>Cadastro de Pessoa</h1>

    <form id="formPessoa">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required>
        <button type="submit">Cadastrar</button>
    </form>

    <button id="btnListar">Listar Pessoas</button>

    <div id="mensagem" style="margin-top: 20px; color: green;"></div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $('#formPessoa').on('submit', function(e) {
            e.preventDefault();

            const nome = $('#nome').val();
            const token = $('meta[name="csrf-token"]').attr('content');

            fetch('/pessoas/store', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token
                    },
                    body: JSON.stringify({
                        nome: nome
                    })
                })
                .then(response => response.json())
                .then(data => {
                    document.getElementById('mensagem').textContent = data.message;
                    document.getElementById('formPessoa').reset();
                })
                .catch(error => {
                    console.error('Erro:', error);
                });
        });

        $('#btnListar').on('click', function() {
            fetch('/pessoas/show')
                .then(response => response.json())
                .then(data => {
                    const lista = $('<ul></ul>');

                    data.forEach(pessoa => {
                        const item = $('<li></li>').text(pessoa.nome); // aqui acessa corretamente
                        lista.append(item);
                    });

                    $('#mensagem').empty().append(lista);
                })
                .catch(error => {
                    console.error('Erro:', error);
                });
        });
    </script>
</body>

</html>
