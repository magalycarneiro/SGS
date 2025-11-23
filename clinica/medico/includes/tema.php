<?php
require_once(__DIR__ . '/../Classes/Configuracoes.class.php');

$config = Configuracoes::carregar();
$tema = $config['tema'] ?? 'claro';

if ($tema === 'escuro') {
    echo '<style>
        :root {
            --primary-dark: #C2AAE3;
            --primary: #A56ACB;
            --primary-light: #B579DC;
            --accent: #D1B3FF;
            --background: #1E1E1E;
            --text-color: #FFFFFF;
            --card-background: #2C2C2C;
        }
        body {
            background-color: var(--background);
            color: var(--text-color);
        }
    </style>';
} else {
    echo '<style>
        :root {
            --primary-dark: #693E7F;
            --primary: #935CC4;
            --primary-light: #A56ACB;
            --accent: #B579DC;
            --background: #f5f5f5;
            --text-color: #333333;
            --card-background: #FFFFFF;
        }
        body {
            background-color: var(--background);
            color: var(--text-color);
        }
    </style>';
}
?>
