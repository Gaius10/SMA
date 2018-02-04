<li onclick="verDados(1)">
    <div class="aluno">
        <label title="Caio Corrêa Chaves">Caio Corrêa Chaves</label>
        <label title="Turma">3B</label>
        <label title="Dados" class="only-mob"><i id="c1" class="fa fa-caret-down"></i></label>
    </div>

    <div class="dados" id="dados_aluno1">
        <label title="Repetições">
            <span class="only-mob"><i class="fa fa-refresh"></i></span>
            0000
        </label>
        <label title="Ocorrências">
            <span class="only-mob"><i class="fa fa-close"></i></span>
            0000
        </label>
        <button class="btnOcorrencia" onclick="novaOcorrencia(1, 'Caio Corrêa Chaves')">
            <i class="fa fa-plus" style="color: red;"></i>
            Ocorrência
        </button>
    </div>
    <script>if (screen.width < 1024) { document.getElementById('dados_aluno1').style.display = "none"; }</script>
</li>
<li>
    <div class="aluno">
        <label title="Melissa Corrêa Chaves">Melissa Corrêa Chaves</label>
        <label title="Turma">2E</label>
    </div>
    <div class="dados modal" id="dados_aluno2">
        <label title="Repetições">0000</label>
        <label title="Ocorrências">0000</label>
    </div>
</li>
<li>
    <div class="aluno">
        <label title="Camila da Silva Rocha Vitorino">Camila da Silva Rocha Vitorino</label>
        <label title="Turma">4B</label>
    </div>
    <div class="dados modal" id="dados_aluno3">
        <label title="Repetições">0000</label>
        <label title="Ocorrências">0000</label>
    </div>
</li>
<li>
    <div class="aluno">
        <label title="Izabela Ferreira Reis">Izabela Ferreira Reis</label>
        <label title="Turma">3B</label>
    </div>
    <div class="dados modal" id="dados_aluno3">
        <label title="Repetições">0000</label>
        <label title="Ocorrências">0000</label>
    </div>
</li>
<li>
    <div class="aluno">
        <label title="Vitor Brancalião">Vitor Brancalião</label>
        <label title="Turma">3B</label>
    </div>
    <div class="dados modal" id="dados_aluno3">
        <label title="Repetições">0000</label>
        <label title="Ocorrências">0000</label>
    </div>
</li>
