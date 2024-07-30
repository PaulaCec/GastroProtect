<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./imagens/logo.png" type="image/x-icon">
    <title>GastroProtect</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
<?php include 'cabecalho.php'; ?>

<div id="corpo_forms">
    <h2>Formulário</h2>
<br>
    <p>*Você pode selecionar mais de uma opção.</p>
<br>
    <form action="resultado.php" method="POST">
        <fieldset>
            <legend>Quais sintomas você está sentindo?</legend>
            <?php
            $sintomas = array(
                'Dor abdominal',
                'Cólica abdominal',
                'Diarreia',
                'Diarréia líquida com muco',
                'Diarreia com sangue',
                'Flatulência',
                'Náuseas',
                'Vômito',
                'Calafrios',
                'Febre',
                'Dor de cabeça',
                'Dor muscular',
                'Fraqueza',
                'Tenesmo (sensação de necessidade constante de evacuar)',
                'Mal-estar',
                'Desidratação',
                'Cãibras',
                'Paralisia facial progressiva',
                'Visão dupla',
                'Pálpebras caídas',
                'Boca seca',
                'Dificuldade para engolir ou falar',
                'Sepse (inflamação aguda)',
                'Meningite',
                'Gastroenterite (inflamação do trato gastrointestinal)',
                'Outro'
            );
            foreach ($sintomas as $key => $sintoma) {
                $id = 'sintoma' . ($key + 1);
                echo '<input type="checkbox" id="' . $id . '" name="sintomas[]" value="' . $sintoma . '">';
                echo '<label for="' . $id . '"> ' . $sintoma . '</label><br>';
            }
            ?>
        </fieldset><br>

        <fieldset>
            <legend>Há quanto tempo você está com os sintomas?</legend>
            <?php
            $duracoes_sintomas = array(
                'Entre 6 a 24 horas',
                'Entre 1 a 2 dias',
                'Entre 3 a 5 dias',
                'Entre 6 a 7 dias',
                'Entre 8 a 14 dias',
                'Há mais de 2 semanas',
                'Não sei informar'
            );
            foreach ($duracoes_sintomas as $key => $duracao_sintomas) {
                $id = 'duracao_sintomas' . ($key + 1);
                echo '<input type="checkbox" id="' . $id . '" name="duracao_sintomas[]" value="' . $duracao_sintomas . '">';
                echo '<label for="' . $id . '"> ' . $duracao_sintomas . '</label><br>';
            }
            ?>
        </fieldset><br>

        <fieldset>
            <legend>Quais alimentos você consumiu nos últimos dias?</legend>
            <?php
            $alimentos = array(
                'Frango',
                'Carne suína',
                'Carne bovina',
                'Derivados de carne',
                'Ovos',
                'Peixes',
                'Algas',
                'Frutos do mar (ostras, camarão, moluscos, lagosta, caranguejos, mariscos)',
                'Frutas',
                'Vegetais',
                'Saladas',
                'Leite e/ou derivados',
                'Produtos de confeitaria',
                'Água não tratada',
                'Gelo',
                'Molhos',
                'Ensopados e guisados',
                'Pudins',
                'Sopas',
                'Arroz',
                'Massas',
                'Batatas',
                'Assados',
                'Alimentos enlatados',
                'Não sei informar'
            );
            foreach ($alimentos as $key => $alimento) {
                $id = 'alimento' . ($key + 1);
                echo '<input type="checkbox" id="' . $id . '" name="alimentos[]" value="' . $alimento . '">';
                echo '<label for="' . $id . '"> ' . $alimento . '</label><br>';
            }
            ?>
        </fieldset>

        <fieldset>
            <legend>Quanto tempo após a ingestão do alimento contaminado os sintomas começaram a aparecer?</legend>
            <?php
            $periodos_incubacao = array(
                'Menos de 30 minutos',
                'Entre 30 minutos e 2 horas',
                'Entre 2 e 4 horas',
                'Entre 4 e 6 horas',
                'Entre 6 e 12 horas',
                'Entre 12 e 24 horas',
                'Entre 1 e 2 dias',
                'Entre 2 e 3 dias',
                'Entre 3 e 4 dias',
                'Mais de 4 dias',
                'Não sei informar'
            );
            foreach ($periodos_incubacao as $key => $periodo_incubacao) {
                $id = 'periodo_incubacao' . ($key + 1);
                echo '<input type="checkbox" id="' . $id . '" name="periodos_incubacao[]" value="' . $periodo_incubacao . '">';
                echo '<label for="' . $id . '"> ' . $periodo_incubacao . '</label><br>';
            }
            ?>
        </fieldset><br>


<br>
        <input class="butao" id="butao_forms" type="submit" value="Enviar">
        
    </form>
</div>
<?php include 'rodape.php'; ?>
</body>
</html>
