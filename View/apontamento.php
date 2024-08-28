<style>
    #placarLinha {
        font-size: 500%;
        font-family: sans-serif;
        font-weight: bolder;
        font-style: italic;
    }
</style>
<div class="container">
    <div class="row">
        <div class="col">
            <div class="container justify-content-center">

                <div class="row m-1 p-2" id="linhas">

                </div>

                <div class="row m-1 p-2">
                    <div class="input-group">
                        <span class="input-group-text">
                            Etiqueta
                        </span>
                        <input type="text" id="etiqueta" class="form-control" required minlength="8" maxlength="18" autofocus>
                        <input type="hidden" value="Linha01" id="linha">
                    </div>
                </div>

                <div class="row m-1 p-2 text-center">
                    <div class="bg-dark text-bg-dark d-flex align-items-center justify-content-center" style="min-height: 200px;">
                        <h1 id="placarLinha"></h1>
                    </div>
                </div>

            </div>
        </div>
        <div class="col" id="resultados">
            <!-- coluna vai os resultados -->
            <div class="row text-center">
                <div class="bg-dark text-bg-dark m-2 p-2">
                    <h5>Total</h5>
                    <h3 id="totalAp"></h3>
                </div>
            </div>
            <div class="row p-2">
                <table class="table table-dark table-striped table-bordered" style="font-size:smaller;">
                    <thead class="text-center">
                        <tr>
                            <th>Codigo</th>
                            <th>Modelo</th>
                            <th>Descrição</th>
                            <th>Quantidade</th>
                        </tr>
                    </thead>
                    <tbody id="produtos">

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    document.getElementById('etiqueta').addEventListener('keypress', async function(event) {
        if (event.key === 'Enter') {
            event.preventDefault(); // Evita o comportamento padrão do Enter, como a submissão de um formulário.

            const cetiqueta = document.getElementById('etiqueta');
            const value_linha = '<?php echo addslashes($_SESSION['ice']['linha']); ?>'; // Garantir que a variável PHP seja convertida corretamente
            const etiqueta = cetiqueta.value;
            cetiqueta.value = ''; // Limpa o campo de entrada

            try {
                // Faz a requisição POST
                await posta(etiqueta, value_linha);

                // Faz a requisição GET para atualizar o placar
                const total = await atualiza(value_linha);
               await verProdutos(value_linha);

                const vtotal = await totais()

            } catch (error) {
                console.error('Erro:', error);
            }
        }
    });



    async function posta(etiqueta, linha) {
        linha = linha.replace(' ', '0', linha)
        const url = `http://localhost/apicold/postEtiqueta/${etiqueta}/${linha}`;
        await fetch(url);
    }

    async function atualiza(linha) {
        linha = linha.replace(' ', '0', linha)
        const url = `http://localhost/apicold/valorLinha/${linha}`;
        const response = await fetch(url);
        const data = await response.json();
        document.getElementById('placarLinha').textContent = data.total;
        return data.total; // Supondo que o JSON retornado tenha um campo 'total'
    }

    async function linhas() {
        const url = `http://localhost/apicold/linhas/`;

        const response = await fetch(url);
        const data = await response.json();
        const d = document.getElementById('linhas')
        d.textContent = '';
        data.forEach((item) => {
            const b = document.createElement('a')
            b.href = 'Control/linhas.php?linha=' + item['linha']
            b.className = 'btn btn-sm btn-secondary m-1 p-2'
            b.style.width = 'fit-content'
            b.innerText = item['linha']
            d.appendChild(b);

        })



    }

    async function totais() {
        const url = `http://localhost/apicold/valorTotal/`;
        const response = await fetch(url);
        const data = await response.json();
        const d = document.getElementById('totalAp')
        d.textContent = data.total;

    }

    async function verProdutos(linha) {
    linha = linha.replace(' ', '0');  // Corrigir o uso de replace
    const url = `http://localhost/apicold/produzidosLinhaDia/${linha}`;
    const response = await fetch(url);
    const data = await response.json(); // Converte a resposta para JSON
    
    const d = document.getElementById("produtos");
    d.innerHTML = '';  // Limpar o conteúdo anterior

    data.forEach((item) => {
        const l = document.createElement('tr'); // Cria uma nova linha para cada item
        const cc = document.createElement('td');
        const cm = document.createElement('td');
        const cd = document.createElement('td');
        const cq = document.createElement('td');
        cq.className = 'text-end'
        
        cc.innerText = item['codigo'];
        cm.innerText = item['modelo'];
        cd.innerText = item['descricao'];
        cq.innerText = item['total'];

        l.appendChild(cc);
        l.appendChild(cm);
        l.appendChild(cd);
        l.appendChild(cq);
        d.appendChild(l);
    });
}

    atualiza('<?php echo addslashes($_SESSION['ice']['linha']); ?>')
    verProdutos('<?php echo addslashes($_SESSION['ice']['linha']); ?>')
    linhas()
    totais()
</script>