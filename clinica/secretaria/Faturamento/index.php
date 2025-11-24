<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Faturamento da Clínica</title>

    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f5f4fa;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            color: #693E7F;
            margin-top: 30px;
        }

        .container {
            max-width: 1100px;
            margin: 30px auto;
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0px 3px 10px rgba(0, 0, 0, 0.1);
        }

        .title-box {
            background: #C2AAE3;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 25px;
        }

        .title-box h2 {
            margin: 0;
            color: #4B2C73;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        table th {
            background-color: #693E7F;
            color: white;
            padding: 12px;
            font-size: 15px;
            text-align: left;
        }

        table td {
            padding: 10px;
            border-bottom: 1px solid #eee;
            font-size: 14px;
        }

        .status-pago {
            background: #c8f7c5;
            padding: 6px 10px;
            border-radius: 6px;
            color: #2d8a2d;
            font-weight: bold;
        }

        .status-pendente {
            background: #f7c5c5;
            padding: 6px 10px;
            border-radius: 6px;
            color: #b64242;
            font-weight: bold;
        }

        .total-box {
            margin-top: 30px;
            background: #EEE6FA;
            padding: 20px;
            border-radius: 10px;
        }

        .total-box h3 {
            margin: 0 0 10px 0;
            color: #4B2C73;
        }

        .total-item {
            font-size: 16px;
            margin-bottom: 8px;
        }

        .total-price {
            font-weight: bold;
            color: #693E7F;
        }
    </style>
</head>

<body>

<h1>Faturamento da Clínica</h1>

<div class="container">

    <div class="title-box">
        <h2>Lista de Contas da Clínica</h2>
    </div>

    <table>
        <thead>
            <tr>
                <th>Descrição</th>
                <th>Valor (R$)</th>
                <th>Data</th>
                <th>Status</th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <td>Pagamento de Energia</td>
                <td>450,00</td>
                <td>10/11/2025</td>
                <td><span class="status-pago">Pago</span></td>
            </tr>
            <tr>
                <td>Internet da Clínica</td>
                <td>199,90</td>
                <td>12/11/2025</td>
                <td><span class="status-pendente">Pendente</span></td>
            </tr>
            <tr>
                <td>Compra de Materiais</td>
                <td>839,75</td>
                <td>03/11/2025</td>
                <td><span class="status-pago">Pago</span></td>
            </tr>
            <tr>
                <td>Salário do(a) Secretário(a)</td>
                <td>2.300,00</td>
                <td>30/10/2025</td>
                <td><span class="status-pago">Pago</span></td>
            </tr>
            <tr>
                <td>Serviço de Limpeza</td>
                <td>350,00</td>
                <td>08/11/2025</td>
                <td><span class="status-pendente">Pendente</span></td>
            </tr>
        </tbody>
    </table>

    <div class="total-box">
        <h3>Resumo Financeiro</h3>

        <p class="total-item">Total Pago: <span id="total-pago" class="total-price">R$ 0,00</span></p>
        <p class="total-item">Total Pendente: <span id="total-pendente" class="total-price">R$ 0,00</span></p>
        <p class="total-item">Total Geral: <span id="total-geral" class="total-price">R$ 0,00</span></p>
    </div>

</div>

<script>
    function atualizarTotais() {
        let totalPago = 0;
        let totalPendente = 0;

        document.querySelectorAll("tbody tr").forEach(row => {
            let valorTexto = row.querySelector("td:nth-child(2)").textContent.trim();
            let status = row.querySelector("td:nth-child(4) span");

            let valor = parseFloat(valorTexto.replace(".", "").replace(",", "."));

            if (status.classList.contains("status-pago")) {
                totalPago += valor;
            } else {
                totalPendente += valor;
            }
        });

        document.querySelector("#total-pago").textContent =
            "R$ " + totalPago.toFixed(2).replace(".", ",");
        
        document.querySelector("#total-pendente").textContent =
            "R$ " + totalPendente.toFixed(2).replace(".", ",");

        let totalGeral = totalPago + totalPendente;

        document.querySelector("#total-geral").textContent =
            "R$ " + totalGeral.toFixed(2).replace(".", ",");
    }

    document.querySelectorAll("td span").forEach(element => {
        element.style.cursor = "pointer";

        element.addEventListener("click", () => {
            if (element.classList.contains("status-pago")) {
                element.classList.remove("status-pago");
                element.classList.add("status-pendente");
                element.textContent = "Pendente";
            } else {
                element.classList.remove("status-pendente");
                element.classList.add("status-pago");
                element.textContent = "Pago";
            }

            atualizarTotais();
        });
    });

    atualizarTotais();
</script>

</body>
</html>
