<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./imagens/logo.png" type="image/x-icon">
    <title>GastroProtect</title>
    <link rel="stylesheet" href="estilo.css"> <!-- Referência ao arquivo CSS -->
</head>
<body>

<?php include('cabecalho.php');?>

<div class="content">

    <div class="slideshow-container">
        <div class="slide fade">
            <img src="./imagens/um.png" alt="Slide 1">
        </div>
        <div class="slide fade">
            <img src="./imagens/tres.png" alt="Slide 2">
            <div class="caption"><a href="blog.php" style="color: white; text-decoration: none;">Saiba Mais</a></div>
        </div>
        <div class="slide fade">
            <img src="./imagens/dois.png" alt="Slide 3">
        </div>

        <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
        <a class="next" onclick="plusSlides(1)">&#10095;</a>
    </div>

    <script>
        let slideIndex = 1;
        showSlides(slideIndex);

        function plusSlides(n) {
            showSlides(slideIndex += n);
        }

        function showSlides(n) {
            let i;
            let slides = document.getElementsByClassName("slide");
            
            if (n > slides.length) {slideIndex = 1}
            if (n < 1) {slideIndex = slides.length}
            
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";  
            }
            
            slides[slideIndex - 1].style.display = "block";  
        }

        setInterval(() => {
            plusSlides(1);
        }, 20000);

        function showPopup() {
            document.getElementById('popup').style.display = 'block';
        }

        function closePopup() {
            document.getElementById('popup').style.display = 'none';
        }

        function continueToForm() {
            window.location.href = 'forms.php';
        }
    </script>

<br>
    <div class="corpo">
        <h2>Bem-vindo ao GastroProtect!</h2>
        <br>
        <p>Você já se perguntou o que pode estar por trás dos sintomas de uma intoxicação alimentar? Aqui, nossa missão é ajudar você a identificar e entender as causas de doenças relacionadas aos alimentos, oferecendo informações claras e ferramentas práticas. Descubra as possíveis causas de seus sintomas com nossos formulários diagnósticos. Com base nos dados que você fornece, nosso sistema ajuda a identificar as bactérias ou patógenos mais prováveis, oferecendo um primeiro passo para uma ação adequada.</p>
        <br>
        <p>Não deixe que a intoxicação alimentar interrompa sua vida. Clique no botão abaixo para começar a identificar a possível causa dos seus sintomas e tomar as medidas necessárias para sua recuperação.</p>
        <br>
        <button class="butao" onclick="showPopup()">Começar agora</button>
    </div>
</div>

<!-- Pop-up HTML -->
<div id="popup" class="overlay">
    <div class="popup">
        <h2>Atenção!</h2>
        <p>Os formulários e informações fornecidos na GastroProtect são destinados a oferecer orientação e esclarecimentos sobre possíveis causas de intoxicação e infecção alimentar. No entanto, eles não substituem uma consulta médica profissional.</p>
        <p>Se você está enfrentando sintomas graves ou persistentes, é essencial procurar atendimento médico imediato. Somente um profissional de saúde qualificado pode realizar diagnósticos precisos e recomendar tratamentos adequados. Use as informações aqui como um complemento ao aconselhamento médico, e não como um substituto.</p>
        <button class="close-btn" onclick="closePopup()">Fechar</button>
        <button class="confirm-btn" onclick="continueToForm()">Continuar</button>
    </div>
</div>

<?php include('rodape.php');?>

</body>
</html>
