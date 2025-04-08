<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/principal.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.2/css/bulma.min.css">
  </head>
    <?php include 'menu.php'; ?>
</head>
<body>
    <div class="carousel-container" id="carousel">
        <div class="carousel">
            <h2 id="tituloInicial">Conheça nossa clínica!</h2>
            <?php
            $slides = [
                ["image" => "img/fisio.jpg", "text" => "O nosso atendimento de fisioterapia oferece tratamentos personalizados para promover a saúde e o bem-estar. Nossa equipe experiente trata reabilitação ortopédica, fisioterapia neurológica, terapia manual, fisioterapia pediátrica e dor crônica, com a missão de recuperar a funcionalidade, aliviar a dor e melhorar a qualidade de vida dos pacientes. Agende sua consulta e comece a viver melhor."],
                ["image" => "img/dentista.jpeg", "text" => "Conheça nossos tratamentos personalizados para promover sua saúde bucal e o seu bem-estar. Nossos dentistas experientes proporcionam cuidados em diversas áreas, incluindo limpeza dental, restaurações, ortodontia, periodontia e estética dental, com a missão de manter e restaurar a saúde dos dentes e gengivas, proporcionando sorrisos mais bonitos e saudáveis. Agende sua consulta e descubra como podemos ajudar você a alcançar uma saúde bucal impecável."],
                ["image" => "img/pediatra.jpg", "text" => "O Dr. João Silva é um pediatra dedicado a oferecer cuidados médicos especializados e personalizados para crianças. Com vasta experiência, ele realiza consultas de rotina, acompanha o desenvolvimento infantil, administra vacinas e trata doenças comuns na infância. Seu compromisso é promover a saúde e o bem-estar dos pequenos pacientes, garantindo um crescimento saudável. Agende uma consulta e veja como o Dr. João Silva pode cuidar do seu filho com atenção e carinho."]
            ];

            foreach ($slides as $index => $slide) {
                echo '
                <div class="carousel-item ' . ($index === 0 ? 'active' : '') . '">
                    <div class="carousel-text">
                        <p>' . $slide["text"] . '</p>
                        <button class="btn">Agendar Consulta</button>
                    </div>
                    <div class="carousel-image">
                        <img src="' . $slide["image"] . '" alt="Imagem do Carrossel">
                    </div>
                </div>';
            }
            ?>
        </div>
        <button class="prev" onclick="moveSlide(-1)">&#10094;</button>
        <button class="next" onclick="moveSlide(1)">&#10095;</button>
    </div>
    <script src="js/principal.js"></script>
</body>
</html>