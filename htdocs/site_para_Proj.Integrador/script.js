document.addEventListener('DOMContentLoaded', function () {
    const formAgendar = document.getElementById('form-agendar');
    const formCancelar = document.getElementById('form-cancelar');
    const coletaobtercoletaList = document.getElementById('coleta-list');

    formAgendar.addEventListener('submit', function (event) {
        event.preventDefault();
        agendarcoleta();
    });

    formCancelar.addEventListener('submit', function (event) {
        event.preventDefault();
        cancelarcoleta();
    });

    obtercoleta();

    function obtercoleta() {
        fetch('/coleta')
            .then(response => response.json())
            .then(coleta => {
                mostrarcoletaobtercoleta(coleta);
            })
            .catch(error => console.error('Erro ao obter coleta:', error));
    }

    function mostrarcoletaobtercoleta(coleta) {
        const listaHTML = coleta.map(coleta => {
            return `<div>ID: ${coleta.id}, Nome: ${coleta.nome}, Data: ${coleta.data}, Hora: ${coleta.hora}, Local: ${coleta.local}, Telefone: ${coleta.telefone}</div>`;
        }).join('');
        coletaobtercoletaList.innerHTML = listaHTML;
    }

    function agendarcoleta() {
        const nome = document.getElementById('nome').value;
        const email = document.getElementById("email").value;
        const data = document.getElementById('data').value;
        const hora = document.getElementById('hora').value;
        const local = document.getElementById('local').value;
        const telefone = document.getElementById('telefone').value;

        fetch('/agendar', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ nome,email, data, hora, local, telefone })
        })
            .then(response => response.json())
            .then(response => {
                console.log(response.message);
                obtercoleta();
            })
            .catch(error => console.error('Erro ao agendar coleta:', error));
    }

    function cancelarcoleta() {
        const idCancelar = document.getElementById('idCancelar').value;

        fetch('/cancelar', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ id: idCancelar })
        })
            .then(response => response.json())
            .then(response => {
                console.log(response.message);
                obtercoleta();
            })
            .catch(error => console.error('Erro ao cancelar coleta:', error));
    }
});
