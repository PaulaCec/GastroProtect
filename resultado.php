<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./imagens/logo.png" type="image/x-icon">
    <title>GastroProtect</title>
    <link rel="stylesheet" href="estilo.css">
    <style>
        /* Estilo opcional para ocultar descrições por padrão */
        .descricao {
            display: none;
        }
    </style>
    <script>
        function toggleDescription(id) {
            var descricao = document.getElementById(id);
            var link = document.getElementById('link_' + id);
            if (descricao.style.display === 'none') {
                descricao.style.display = 'block';
                link.innerHTML = 'Mostrar menos'; // Altera o texto do link para Mostrar menos
            } else {
                descricao.style.display = 'none';
                link.innerHTML = 'Saiba mais'; // Altera o texto do link de volta para Saiba mais
            }
        }
    </script>
</head>
<body>
<?php include 'cabecalho.php'; ?>

<div class="content">
<div class="result">
<?php
// Verifica se o formulário foi enviado via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica se pelo menos um dos campos duracao_sintomas, alimento, sintomas ou periodo_incubacao está presente
    if (isset($_POST['duracao_sintomas']) || isset($_POST['alimentos']) || isset($_POST['sintomas']) || isset($_POST['periodos_incubacao'])) {
        $sintomas = isset($_POST['sintomas']) ? $_POST['sintomas'] : [];
        $duracao_sintomas = isset($_POST['duracao_sintomas']) ? $_POST['duracao_sintomas'] : [];
        $alimento = isset($_POST['alimentos']) ? $_POST['alimentos'] : [];
        $periodo_incubacao = isset($_POST['periodos_incubacao']) ? $_POST['periodos_incubacao'] : [];

        // Defina aqui a lógica para determinar os microrganismos com base nos sintomas selecionados
        $microrganismos_por_sintoma = [
            'Campylobacter' => [
                'sintomas' => ['Dor abdominal', 'Diarreia', 'Diarréia líquida com muco', 'Diarreia com sangue', 'Náuseas', 'Dor de cabeça', 'Dor muscular', 'Febre'],
                'alimentos' => ['Frango', 'Carne suína', 'Carne bovina', 'Água não tratada', 'Leite e/ou derivados'],
                'duracao_sintoma' => ['Entre 1 a 2 dias', 'Entre 1 a 2 dias', 'Entre 6 a 7 dias'],
                'periodo_incubacao' => ['Entre 1 e 2 dias','Entre 2 e 3 dias', 'Entre 3 e 4 dias', 'Mais de 4 dias'],
                'descricao' => 'A infecção por Campylobacter depende dos fatores do hospedeiro e do patógeno, sendo considerada uma doença autolimitante com duração de um a sete dias, afetando os intestinos grosso e delgado. O microrganismo é excretado nas fezes durante várias semanas após terem cessado os sintomas. Embora a maioria das pessoas se recupere sem tratamento específico, a infecção pode ser grave para indivíduos com o sistema imunológico comprometido, e cuidados médicos podem ser necessários em casos severos ou persistentes.'
            ],
            'Yersinia enterocolitica' => [
                'sintomas' => ['Dor abdominal', 'Diarreia', 'Sepse (inflamação aguda)'],
                'alimentos' => ['Carne suína', 'Água não tratada', 'Frutos do mar (ostras, camarão, moluscos, lagosta, caranguejos, mariscos, peixes, algas)', 'Vegetais', 'Leite cru'],
                'duracao_sintoma' => ['Entre 1 a 2 dias'],
                'periodo_incubacao' => ['Entre 6 e 12 horas'],
                'descricao' => 'Yersinia enterocolitica é uma bactéria patogênica responsável por causar infecções gastrointestinais, frequentemente associadas a sintomas como diarreia, febre e dor abdominal. Ela é transmitida principalmente por alimentos contaminados, especialmente carnes mal cozidas.'
            ],
            'Clostridium perfringes' => [
                'sintomas' => ['Flatulência', 'Dor abdominal', 'Diarreia', 'Febre', 'Vômito'],
                'alimentos' => ['Carne suína', 'Carne bovina', 'Frango', 'Molhos', 'Ensopados e guisados'],
                'duracao_sintoma' => ['Entre 1 a 2 dias'],
                'periodo_incubacao' => ['Carne suína', 'Carne bovina', 'Frango', 'Molhos', 'Ensopados e guisados'],
                'descricao' => 'Clostridium perfringens é uma bactéria anaeróbia que pode causar intoxicação alimentar e infecções graves, como gangrena gasosa. Ela é comumente encontrada em carnes mal cozidas e alimentos que não foram armazenados corretamente.'
            ],
            'Salmonella' => [
                'sintomas' => ['Diarreia', 'Dor abdominal', 'Febre', 'Calafrios', 'Dor de cabeça'],
                'alimentos' => ['Ovos', 'Água não tratada', 'Frango', 'Carne bovina', 'Carne suina'],
                'duracao_sintoma' => ['Entre 6 a 24 horas'],
                'periodo_incubacao' => ['Entre 12 e 24 horas'],
                'descricao' => 'Salmonella é um gênero de bactérias Gram-negativas, em forma de bastonete, que pode causar infecções alimentares em humanos e animais.  As infecções por Salmonella geralmente ocorrem através do consumo de alimentos ou água contaminados, especialmente carnes cruas ou malcozidas, ovos e laticínios. A infecção pode levar a sintomas como diarreia, febre e dor abdominal. Em alguns casos, pode causar infecções mais graves, como a febre tifoide. Salmonella é uma preocupação significativa na saúde pública e na segurança alimentar.'
            ],
            'Vibrio parahaemolyticus' => [
                'sintomas' => ['Diarreia', 'Cãibras', 'Fraqueza', 'Vômito', 'Calafrios', 'Dor de cabeça'],
                'alimentos' => ['Frutos do mar (ostras, camarão, moluscos, lagosta, caranguejos, mariscos)', 'Peixes', 'Algas'],
                'duracao_sintoma' => ['Entre 1 a 2 dias', 'Entre 3 a 5 dias', 'Entre 6 a 7 dias', 'Entre 8 a 14 dias'],
                'periodo_incubacao' => ['Entre 2 e 4 horas', 'Entre 6 e 12 horas', 'Entre 12 e 24 horas', 'Entre 1 e 2 dias', 'Entre 2 e 3 dias'],
                'descricao' => 'Vibrio parahaemolyticus é uma bactéria Gram-negativa, em forma de bastonete, encontrada predominantemente em ambientes marinhos e estuarinos. É conhecida por causar gastroenterite em humanos, especialmente após o consumo de frutos do mar cru ou malcozidos, como camarões e ostras. Os sintomas da infecção por Vibrio parahaemolyticus incluem diarreia, dor abdominal, náuseas e febre. Esse microorganismo é adaptado a condições salinas e é uma causa comum de surtos de doenças alimentares associadas a frutos do mar.'
            ],
            'Shigella' => [
                'sintomas' => ['Dor abdominal', 'Cólica abdominal', 'Diarreia com sangue', 'Diarréia líquida com muco', 'Diarreia','Febre', 'Vômito', 'Tenesmo (sensação de necessidade constante de evacuar)'],
                'alimentos' => ['Frutas', 'Vegetais', 'Saladas', 'Frutos do mar (ostras, camarão, moluscos, lagosta, caranguejos, mariscos)', 'Peixes', 'Algas', 'Frango', 'Leite e/ou derivados'],
                'duracao_sintoma' => ['Entre 1 a 2 dias', 'Entre 3 a 5 dias', 'Entre 6 a 7 dias'],
                'periodo_incubacao' => ['Entre 1 e 2 dias', 'Entre 2 e 3 dias', 'Entre 3 e 4 dias'],
                'descricao' => 'Todos sorovares da shigella são patogênicos, como Shigella dysenteriae (grupo A) ü Shigella flexneri (grupo B) ü Shigella boydii (grupo C) ü Shigella sonnei (grupo D). Tem aparência de bastonetes, Gram negativos, anaeróbios facultativos e são geneticamente próximos de Escherichia (70 a 100% homologia). A via fecal-oral é a principal forma de transmissão da Shigella entre humanos. No que diz respeito aos alimentos, a contaminação é muitas vezes devido a um manipulador de alimentos contaminado, por falta de higiene pessoal. Moscas carregam o patógeno para os alimentos a partir de latrinas e de disposição inadequada de fezes e esgotos. Alimentos expostos e não refrigerados constituem um meio para sua sobrevivência e multiplicação.'
            ],
            'Bacillus cereu' => [
                'sintomas' => ['Vômito', 'Náuseas', 'Diarreia'],
                'alimentos' => ['Carne bovina', 'Carne suína', 'Leite e/ou derivados', 'Vegetais', 'Frutos do mar (ostras, camarão, moluscos, lagosta, caranguejos, mariscos)', 'Peixes', 'Algas', 'Arroz', 'Batatas', 'Massas', 'Molhos', 'Pudins', 'Ensopados e guisados', 'Assados', 'Saladas'],
                'duracao_sintoma' => ['Entre 6 a 24 horas'],
                'periodo_incubacao' => ['Entre 30 minutos e 2 horas', 'Entre 2 e 4 horas', 'Entre 4 e 6 horas'],
                'descricao' => 'Intoxicação alimentar por Bacillus cereus é conhecida por causar sintomas de diarreia, náusea e vômito. Seu período de incubação é de 30 minutos a 6 horas em casos onde o vômito é predominante, com duração de sintomas inferiores a 24 horas; de 6 a 24 horas onde a diarréia é predominante. Ela pode ser causada através da ingestão de alimentos mantidos em temperatura ambiente por longo tempo, depois de cozidos, o que permite a multiplicação dos organismos. Surtos com vômitos predominantes são mais comumente associados ao arroz cozido que permaneceu em temperatura ambiente. Uma variedade de erros na manipulação de alimentos tem sido apontada como causa de surtos com diarréia. Sendo que uma larga variedade de alimentos tem sido implicada em surtos tais como carnes, leite, vegetais e peixes. Os surtos por vômitos estão mais associados a produtos à base de arroz; entretanto, outros produtos têm sido implicados em surtos como batatas, massas e queijos. Misturas com molhos, pudins, sopas, assados e saladas têm sido implicadas também. B. cereus é um microrganismo gram-positivo, facultativamente aeróbico, um formador de esporos, produtor de dois tipos de toxina - diarréica (termo-lábil) e emética (termo-estável).'
            ],
            'Staphylococcus aureus' => [
                'sintomas' => ['Náuseas', 'Vômito'],
                'alimentos' => ['Produtos de confeitaria', 'Carne bovina', 'Derivados de carne'],
                'duracao_sintoma' => ['Entre 1 a 2 dias'],
                'periodo_incubacao' => ['Entre 30 minutos e 2 horas', 'Entre 2 e 4 horas', 'Entre 4 e 6 horas'],
                'descricao' => 'é a principal causa de intoxicação por enterotixina estafilocócia, após a ingestão de alimentos como carnes e derivados, produtos de confeitaria, leite e derivados os sintomas podem aparecer após 30 min a 6h e podem durar de 1 a 2 dias.'
            ],
            'Listeria monocytogenes' => [
                'sintomas' => ['Dor abdominal', 'Meningite'],
                'alimentos' => ['Leite e/ou derivados'],
                'duracao_sintoma' => ['Entre 6 a 24 horas', 'Entre 1 a 2 dias', 'Entre 3 a 5 dias', 'Entre 6 a 7 dias', 'Entre 8 a 14 dias', 'Há mais de 2 semanas'],
                'periodo_incubacao' => ['Não sei informar'],
                'descricao' => 'é a principal causa pela síndrome Listeriose, sendo essa causada pela ingestão de alimentos como leite cru, queijos moles, carne, frango, frutos do mar, frutas e produtos vegetais. Após a ingestão desse alimentos contaminados, os principais sintomas como dores abdominais, meningite, vômitos e diarreia podem aparecer em torno de uma a várias semanas.'
            ],
            'Vibrio cholerae' => [
                'sintomas' => ['Diarreia', 'Náuseas', 'Vômito', 'Desidratação', 'Cãibras', 'Fraqueza ', 'Calafrios', 'Dor de cabeça'],
                'alimentos' => ['Frutos do mar (ostras, camarão, moluscos, lagosta, caranguejos, mariscos, peixes, algas)', 'Água não tratada'],
                'duracao_sintoma' => ['Não sei informar'],
                'periodo_incubacao' => ['Entre 12 e 24 horas', 'Entre 1 e 2 dias', 'Entre 2 e 3 dias'],
                'descricao' => 'A bactéria Vibrio cholerae, responsável por causar a doença conhecida como cólera, libera toxina que se liga às paredes intestinais, alterando o fluxo normal de sódio e cloreto do organismo. Essa alteração faz com que o corpo secrete grandes quantidades de água, o que provoca diarreia aquosa, desidratação e perda de fluidos e sais minerais importantes para o corpo.'
            ],
            'E. Coli Enterotoxigênica' => [
                'sintomas' => ['Gastroenterite (inflamação do trato gastrointestinal)', 'Diarreia', 'Dor abdominal', 'Febre', 'Náuseas', 'Mal-estar'],
                'alimentos' => ['Frutas', 'Vegetais', 'Frutos do mar (ostras, camarão, moluscos, lagosta, caranguejos, mariscos)', 'Peixes', 'Algas', 'Carne suína', 'Carne bovina', 'Leite e/ou derivados', 'Água não tratada', 'Gelo'],
                'duracao_sintoma' => ['Entre 1 a 2 dias', 'Entre 3 a 5 dias'],
                'periodo_incubacao' => ['Entre 6 e 12 horas', 'Entre 12 e 24 horas'],
                'descricao' => 'A Escherichia coli enterotoxigênica é uma cepa de Escherichia coli que é conhecida como a causa mais comum de diarreia dos viajantes.'
            ],
            'E. Coli Enteropatogênica' => [
                'sintomas' => ['Diarréia', 'Febre', 'Desidratação'],
                'alimentos' => ['Carne bovina', 'Carne suína', 'Frango'],
                'duracao_sintoma' => ['Entre 1 a 2 dias', 'Entre 3 a 5 dias'],
                'periodo_incubacao' => ['Entre 6 e 12 horas'],
                'descricao' => 'A Escherichia coli enteropatogênica foi a primeira cepa de E. coli reconhecida como diarreiogênica e está associada a casos isolados e surtos de diarreia infantil.'
            ],
            'E. Coli Enteroinvasiva' => [
                'sintomas' => ['Diarreia', 'Dor abdominal', 'Vômito', 'Tenesmo (sensação de necessidade constante de evacuar)', 'Calafrios', 'Febre', 'Mal-estar'],
                'alimentos' => ['Frango', 'Carne suína', 'Carne bovina', 'Derivados de carne', 'Ovos', 'Frutos do mar (ostras, camarão, moluscos, lagosta, caranguejos, mariscos)', 'Peixes', 'Algas', 'Frutas', 'Vegetais', 'Saladas', 'Leite e/ou derivados', 'Produtos de confeitaria', 'Água não tratada', 'Gelo', 'Molhos', 'Ensopados e guisados', 'Pudins', 'Sopas', 'Arroz', 'Massas', 'Batatas', 'Assados', 'Alimentos enlatados', 'Não sei informar'],
                'duracao_sintoma' => ['Entre 6 a 24 horas', 'Entre 1 a 2 dias', 'Entre 3 a 5 dias', 'Entre 6 a 7 dias'],
                'periodo_incubacao' => ['Entre 12 e 24 horas', 'Entre 1 e 2 dias', 'Entre 2 e 3 dias'],
                'descricao' => 'Esta é uma cepa da E. Coli que causa uma doença inflamatória na mucosa intestinal e na submucosa.'
            ],
            'E. Coli Enterohemorrágica' => [
                'sintomas' => ['Cólica abdominal', 'Diarreia'],
                'alimentos' => ['Carne bovina', 'Leite e/ou derivados'],
                'duracao_sintoma' => ['Entre 1 a 2 dias', 'Entre 3 a 5 dias', 'Entre 6 a 7 dias', 'Entre 8 a 14 dias'],
                'periodo_incubacao' => ['Entre 12 e 24 horas', 'Entre 1 e 2 dias', 'Entre 2 e 3 dias', 'Entre 3 e 4 dias', 'Mais de 4 dias'],
                'descricao' => 'Escherichia coli enterohemorrágica é uma cepa de bactéria que pode causar infecções intestinais graves em seres humanos.'
            ],
            'E. Coli Enteroagregativa' => [
                'sintomas' => ['Diarreia', 'Febre', 'Desidratação', 'Náuseas', 'Vômito'],
                'alimentos' => ['Carne bovina', 'Frango', 'Leite e/ou derivados', 'Água não tratada'],
                'duracao_sintoma' => ['Entre 1 a 2 dias', 'Entre 3 a 5 dias', 'Entre 6 a 7 dias', 'Entre 8 a 14 dias'],
                'periodo_incubacao' => ['Entre 6 e 12 horas', 'Entre 12 e 24 horas', 'Entre 1 e 2 dias'],
                'descricao' => 'A Escherichia coli enteroagregativa é uma cepa de Escherichia coli que causa diarreia aguda e crônica, também podem causar infecções do trato urinário.'
            ],
            'Clostridium botulinum' => [
                'sintomas' => ['Paralisia facial progressiva', 'Visão dupla', 'Pálpebras caídas', 'Boca seca', 'Dificuldade para engolir ou falar', 'Fraqueza', 'Náuseas', 'Vômito', 'Dor abdominal', 'Diarreia'],
                'alimentos' => ['Alimentos enlatados'],
                'duracao_sintoma' => ['Entre 1 a 2 dias'],
                'periodo_incubacao' => ['Entre 12 e 24 horas', 'Entre 1 e 2 dias'],
                'descricao' => 'Clostridium botulinum é conhecido por causar sintomas neurológicos. Se você suspeita que está com botulismo, deve procurar ajuda médica urgente. O tratamento envolve a administração de antitoxina, que pode ajudar a reduzir a gravidade dos sintomas.'
            ]
        ];

        // Array para armazenar os microrganismos encontrados com detalhes e porcentagens
        $microrganismos_encontrados = [];

        // Itera pelos microrganismos e calcula a porcentagem de possibilidade
        foreach ($microrganismos_por_sintoma as $microrganismo => $detalhes) {
            $match_count = 0; // Contador de correspondências

            // Verifica correspondências nos sintomas
foreach ($sintomas as $sintoma) {
    if (in_array($sintoma, $detalhes['sintomas'])) {
        $match_count++;
    }
}

// Verifica correspondências na duração dos sintomas
foreach ($detalhes['duracao_sintoma'] as $duracao) {
    if (in_array($duracao, $duracao_sintomas)) {
        $match_count++;
        break; // Sai do loop ao encontrar a primeira correspondência
    }
}

// Verifica correspondências no alimento
foreach ($alimento as $item) {
    if (in_array($item, $detalhes['alimentos'])) {
        $match_count++;
        break; // Sai do loop ao encontrar a primeira correspondência
    }
}

// Verifica correspondências no período de incubação
foreach ($detalhes['periodo_incubacao'] as $incubacao) {
    if (in_array($incubacao, $periodo_incubacao)) {
        $match_count++;
        break; // Sai do loop ao encontrar a primeira correspondência
    }
}

            // Calcula a porcentagem de possibilidade com base no número de correspondências
            $total_items = count($sintomas) + count($duracao_sintomas) + count($alimento) + count($periodo_incubacao);
            $porcentagem = $total_items > 0 ? ($match_count / $total_items) * 100 : 0;

            // Adiciona o microrganismo encontrado ao array
            if ($match_count > 0) {
                $microrganismos_encontrados[$microrganismo] = [
                    'sintomas' => $detalhes['sintomas'],
                    'alimentos' => $detalhes['alimentos'],
                    'duracao_sintoma' => $detalhes['duracao_sintoma'],
                    'periodo_incubacao' => $detalhes['periodo_incubacao'],
                    'descricao' => $detalhes['descricao'],
                    'porcentagem' => $porcentagem
                ];
            }
        }

        // Ordena os microrganismos encontrados pela porcentagem em ordem decrescente
        uasort($microrganismos_encontrados, function ($a, $b) {
            return $b['porcentagem'] <=> $a['porcentagem'];
        });

        // Exibindo os resultados ordenados
        if (!empty($microrganismos_encontrados)) {
            echo '<h2>Microrganismos Encontrados com Detalhes</h2>';
            foreach ($microrganismos_encontrados as $microrganismo => $detalhes) {
                echo '<h3>' . htmlspecialchars($microrganismo) . '</h3>';
                echo '<br>';
                echo '<p><strong>Porcentagem de Possibilidade:</strong> ' . round($detalhes['porcentagem'], 2) . '%</p>';
                echo '<br>';
                echo '<p><a href="#" id="link_descricao_' . htmlspecialchars($microrganismo) . '" onclick="toggleDescription(\'descricao_' . htmlspecialchars($microrganismo) . '\'); return false;">Saiba mais</a></p>';
                echo '<br>';
                echo '<p class="descricao" id="descricao_' . htmlspecialchars($microrganismo) . '"><strong>Descrição:</strong> ' . htmlspecialchars($detalhes['descricao']) . '</p>';
                echo '<hr>';
                echo '<br>';
            }
        } else {
            echo '<p>Nenhum microrganismo encontrado com base nos itens selecionados.</p>';
                echo '<br>';
        }
    } else {
        echo '<p>Nenhum item selecionado.</p>';
                echo '<br>';
    }
} else {
    echo '<p>O formulário não foi submetido corretamente.</p>';
                echo '<br>';
}
?>

<button class="butao"><a href="forms.php">Refazer</a></button> 

</div>
</div>

<?php include 'rodape.php'; ?>
</body>
</html>
