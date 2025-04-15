<!DOCTYPE html>
<?php 
include "menu.php";
?>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário de Contato</title>
    <link rel="stylesheet" href="css/contato.css">
</head>
<body>
        <div class="mensagem-contato">
        <h1>Ainda não encontrou o que precisava?</h1>
        <p>Mande uma mensagem através do formulário abaixo e te responderemos o mais breve possível:</p>
        </div>

        <div class="formulario">
        <form id="formulario-contato" action="" method="post">
            <div class="campo dupla">
                <div>
                    <label for="nome" class="obrigatorio">Nome</label>
                    <input type="text" id="nome" name="nome" required>
                    <span class="erro" id="erro-nome"></span>
                </div>
                <div>
                    <label for="sobrenome" class="obrigatorio">Sobrenome</label>
                    <input type="text" id="sobrenome" name="sobrenome" required>
                    <span class="erro" id="erro-sobrenome"></span>
                </div>
            </div>

            <div class="campo">
                <label for="whatsapp" class="obrigatorio">WhatsApp</label>
                <input type="tel" id="whatsapp" name="whatsapp" placeholder="Ex.: (XX) XXXXX-XXXX" required>
                <span class="erro" id="erro-whatsapp"></span>
            </div>

            <div class="campo">
                <label for="email" class="obrigatorio">E-mail</label>
                <input type="email" id="email" name="email" required>
                <span class="erro" id="erro-email"></span>
            </div>

            <div class="campo">
                <label for="mensagem" class="obrigatorio">Mensagem</label>
                <textarea id="mensagem" name="mensagem" required></textarea>
                <span class="erro" id="erro-mensagem"></span>
            </div>

            <button type="submit">ENVIAR CONTATO</button>
        </form>
    </div>

    <script src="javascript/contato.js"></script>
</body>
</html>