<?php
require_once(__DIR__ . '/../Classes/Configuracoes.class.php');

$config = Configuracoes::carregar();
$tema = $config['tema'];

$background = $tema === 'escuro' ? 'var(--background-escuro)' : 'var(--background-claro)';
$textColor = $tema === 'escuro' ? 'var(--text-color-escuro)' : 'var(--text-color-claro)';
$cardBg = $tema === 'escuro' ? 'var(--card-background-escuro)' : 'var(--card-background-claro)';
