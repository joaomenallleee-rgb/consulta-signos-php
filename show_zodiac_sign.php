<?php 
include('layouts/header.php'); 

// Recebe a data de nascimento do formulário (POST)
$data_nascimento = $_POST['data_nascimento'] ?? '';

if (empty($data_nascimento)) {
    echo '<div class="container mt-5"><div class="alert alert-danger">Nenhuma data informada. <a href="index.php">Voltar</a></div></div>';
    exit;
}

// Extrai o mês e dia da data inserida
$nasc_timestamp = strtotime($data_nascimento);
$dia_nasc = date('d', $nasc_timestamp);
$mes_nasc = date('m', $nasc_timestamp);
$aniversario = "$mes_nasc-$dia_nasc";

// Carrega o arquivo XML contendo as informações dos signos
$signos = simplexml_load_file("signos.xml");
$signo_encontrado = null;

// Percorre a lista de signos para encontrar a correspondência
foreach ($signos->signo as $signo) {
    list($dia_inicio, $mes_inicio) = explode('/', (string)$signo->dataInicio);
    $inicio = "$mes_inicio-$dia_inicio";

    list($dia_fim, $mes_fim) = explode('/', (string)$signo->dataFim);
    $fim = "$mes_fim-$dia_fim";

    // Trata Capricórnio (vira o ano: de Dezembro para Janeiro)
    if ($inicio > $fim) {
        if (($aniversario >= $inicio && $aniversario <= '12-31') || 
            ($aniversario >= '01-01' && $aniversario <= $fim)) {
            $signo_encontrado = $signo;
            break;
        }
    } else {
        if ($aniversario >= $inicio && $aniversario <= $fim) {
            $signo_encontrado = $signo;
            break;
        }
    }
}
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header bg-success text-white text-center">
                    <h4 class="mb-0">Resultado da Consulta</h4>
                </div>
                <div class="card-body text-center">
                    <?php if ($signo_encontrado): ?>
                        <h2 class="text-primary mb-3"><?= $signo_encontrado->signoNome; ?></h2>
                        <p class="text-muted">Período: <?= $signo_encontrado->dataInicio; ?> até <?= $signo_encontrado->dataFim; ?></p>
                        <p class="lead mt-3"><?= $signo_encontrado->descricao; ?></p>
                    <?php else: ?>
                        <div class="alert alert-warning">Não foi possível determinar o signo para a data informada.</div>
                    <?php endif; ?>
                    
                    <a href="index.php" class="btn btn-secondary mt-4">Voltar</a>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>