<?php
$f = new \App\sts\Models\helper\StsFormat();
?>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-warning">
                        <h4 class="card-title ">
                            <center>RECIBO</center>
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td style="color:#ff9800"><b>DETALHES DA TRANSAÇÃO: </b></td>
                                    </tr>
                                    <tr>
                                        <td>Name: </td>
                                        <td id="name"></td>
                                    </tr>
                                    <tr>
                                        <td>Telefone: </td>
                                        <td id="phone"></td>
                                    </tr>
                                    <tr>
                                        <td>E-mail: </td>
                                        <td id="email"></td>
                                    </tr>
                                    <tr>
                                        <td>Hash da Transação: </td>
                                        <td id="txid_receiver"></td>
                                    </tr>
                                    <tr>
                                        <td>Carteira: </td>
                                        <td id="origin_wallet"></td>
                                    </tr>
                                    <tr>
                                        <td>Valor BRL enviado: </td>
                                        <td id="total_brl"></td>
                                    </tr>
                                    <tr>
                                        <td>Taxa BRL: </td>
                                        <td id="fee_brl"></td>
                                    </tr>
                                    <tr>
                                        <td>Valor BRL Final: </td>
                                        <td id="amount_brl"></td>
                                    </tr>
                                    <tr>
                                        <td>Valor USDT enviado (Já com a taxa descontada): </td>
                                        <td id="send_usd"></td>
                                    </tr>
                                    <tr>
                                        <td>USDT Price (Cotação do dia): </td>
                                        <td id="price_usd"></td>
                                    </tr>
                                    <tr>
                                        <td>Data e Hora da Transação: </td>
                                        <td id="created"></td>
                                    </tr>
                                    <tr>
                                        <td>Status: </td>
                                        <td id="status"></td>
                                    </tr>                            
                                    <tr>
                                        <td style="color:#ff9800"><b>DETALHES DO FORWARD: </b></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>Hash da Transação: </td>
                                        <td id="txid"></td>
                                    </tr>
                                    <tr>
                                        <td>Valor USDT enviado (Já com a taxa descontada): </td>
                                        <td id="amount"></td>
                                    </tr>
                                    <tr>
                                        <td>Carteira de Destino: </td>
                                        <td id="destination_wallet"></td>
                                    </tr>
                                    <tr>
                                        <td>Data e Hora da Transação: </td>
                                        <td id="created_fwd"></td>
                                    </tr>
                                    <tr>
                                        <td>Status: </td>
                                        <td id="status_fwd"></td>
                                    </tr>                                
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<script>
    window.onload = async (event) => {
        const token = await validatyToken()
        listTransaction(1, false)
    }


    async function listTransaction(page, filter = false) {
        var queryString = window.location.search;
        queryString = queryString.slice(1);
        var parametros = queryString.split('&');
        var parametrosObj = {};
        for (var i = 0; i < parametros.length; i++) {
            var param = parametros[i].split('=');
            var chave = decodeURIComponent(param[0]);
            var valor = decodeURIComponent(param[1]);
            parametrosObj[chave] = valor;
        }


        $(".loader").show('slow').fadeIn();
        try {
            const headers = await validatyToken();
            const response = await smartGateway.get(`transactions/receipt?uuid=${parametrosObj.uuid}`, headers);
            if (response.data.error === 0) {
                const name = response.data.res.order.name;
                const phone = response.data.res.order.phone;
                const email = response.data.res.order.email;
                const txIdReceiver = response.data.res.order.txid_receiver;
                const originWallet = response.data.res.forward.origin_wallet;
                const totalBrl = response.data.res.order.total_brl;
                const priceUsd = response.data.res.order.price_usd;
                const feeBrl = response.data.res.order.fee_brl;
                const amountBrl = response.data.res.order.amount_brl;
                const status = response.data.res.order.status;
                const sendUsd = response.data.res.order.send_usd;
                const created = response.data.res.order.created;
                const txid = response.data.res.forward.txid;
                const amount = response.data.res.forward.amount;
                const destination_wallet = response.data.res.forward.destination_wallet;
                const createdFwd = response.data.res.forward.created;
                const statusFwd = response.data.res.forward.status;
                $('#name').html(name);
                $('#phone').html(phone);
                $('#email').html(email);
                $('#txid_receiver').html(txIdReceiver);
                $('#origin_wallet').html(originWallet);
                $('#total_brl').html(`R$: ${FormatMoeda(totalBrl)}`);
                $('#price_usd').html(`R$: ${FormatMoeda(priceUsd)}`);
                $('#fee_brl').html(`R$: ${FormatMoeda(feeBrl)}`);
                $('#amount_brl').html(`R$: ${FormatMoeda(amountBrl)}`);
                $('#status').html(status);
                $('#send_usd').html(sendUsd);
                $('#created').html(brlDate(created, true));
                $('#txid').html(txid);
                $('#amount').html(Number(amount).toFixed(6));
                $('#destination_wallet').html(destination_wallet);
                $('#created_fwd').html(brlDate(createdFwd, true));
                $('#status_fwd').html(statusFwd);             
            }


        } catch (error) {

        } finally {
            $(".loader").hide('slow').fadeOut();

        }

        $("#searchItem").on('keyup', function() {
            var conta = $("#searchItem").val();
            if (conta.length == 0) {
                $("table.table tbody tr").removeAttr('style');
            }
        });

        $('#searchItem').on('keyup', function(e) {
            e.preventDefault();
            var input = document.getElementById("searchItem");
            var conta = $("#searchItem").val();
            if (conta.length >= 3) {
                var filter = input.value.toLowerCase();
                var nodes = $("table.table tbody tr");
                for (i = 0; i < nodes.length; i++) {
                    if (removeAcents(nodes[i].innerText).includes(removeAcents(filter))) {
                        $(nodes[i]).show();
                    } else {
                        $(nodes[i]).hide();
                    }
                }
            }
        });

    }
</script>