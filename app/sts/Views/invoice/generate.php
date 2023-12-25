<?php
$f = new \App\sts\Models\helper\StsFormat();
?>
<style>
.num-key {
    width: 1.0em;
    height: 1.9em;
    margin: 10px;
    font-size: 1.2em;
    text-align: center;
    cursor: pointer;
    align-items: center;
    text-align: center;
    justify-content: center;
    display: flex;
}
</style>
<div class="content">
    <div class="container-fluid">


        <div class="">

            <div class="row">



                <div class="container">
                    <div class="row">
                        <div class="col-12">

                            <div style=" display:flex; justify-content: center">

                                <input type=" text" id="email" class="form-control col-md-3" placeholder="E-mail"
                                    style="margin-top:10px; margin-bottom:10px; color: #FFF">

                            </div>

                            <div style=" display:flex; justify-content: center ">

                                <input type="text" id="document" class="form-control col-md-3"
                                    style="margin-top:10px; margin-bottom:10px ; color: #FFF" placeholder="Document">
                            </div>

                            <div style=" display:flex; justify-content: center ">
                                <input type=" text" id="display" class="form-control col-md-3"
                                    style="height: 50px; display:none" readonly>
                                <input type="text" id="formatValue" class="form-control col-md-3"
                                    style="height: 50px; font-size:28px; padding:20px" readonly>

                            </div>

                            <div class="d-flex" style="justify-content: center;">

                                <div style=" justify-content: space-between">



                                    <div class="col-12" style=" display:flex; justify-content: space-betwen;">
                                        <div class="row" style="justify-content: space-between;">
                                            <div class="num-key btn btn-outline-primary col-md-3"
                                                onclick="appendNumber(7)">
                                                7</div>
                                            <div class="num-key btn btn-outline-primary col-md-3"
                                                onclick="appendNumber(8)">
                                                8</div>
                                            <div class="num-key btn btn-outline-primary col-md-3"
                                                onclick="appendNumber(9)">
                                                9</div>

                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="row" style="justify-content: space-between;">

                                            <div class="num-key btn btn-outline-primary  col-md-3"
                                                onclick="appendNumber(4)">4
                                            </div>
                                            <div class="num-key btn btn-outline-primary  col-md-3"
                                                onclick="appendNumber(5)">5
                                            </div>
                                            <div class="num-key btn btn-outline-primary  col-md-3"
                                                onclick="appendNumber(6)">6
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="row" style="justify-content: space-between;">

                                            <div class="num-key btn btn-outline-primary  col-md-3"
                                                onclick="appendNumber(4)">4
                                            </div>
                                            <div class="num-key btn btn-outline-primary  col-md-3"
                                                onclick="appendNumber(5)">5
                                            </div>
                                            <div class="num-key btn btn-outline-primary  col-md-3"
                                                onclick="appendNumber(6)">6
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-12">
                                        <div class="row" style="justify-content: space-between;">

                                            <div class="num-key btn btn-outline-primary  col-md-3"
                                                onclick="appendNumber(1)">1
                                            </div>

                                            <div class="num-key btn btn-outline-primary  col-md-3"
                                                onclick="appendNumber(2)">2
                                            </div>

                                            <div class="num-key btn btn-outline-primary  col-md-3"
                                                onclick="appendNumber(3)">3
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-12">
                                        <div class="row" style="justify-content: space-between;">
                                            <div class="num-key btn btn-warning  col-md-3"
                                                onclick="deleteLastCharacter()"> <i class="material-icons"
                                                    style="font-size: 1.2em;">backspace</i>

                                            </div>
                                            <div class=" num-key btn btn-outline-primary  col-md-3"
                                                onclick="appendNumber(0)">
                                                0
                                            </div>
                                            <div class="num-key btn btn-danger  col-md-3"
                                                onclick="deleteAllCharacter()">
                                                <i class="material-icons" style="font-size: 1.2em;">clear</i>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="row">
                                            <button type="button" class="btn btn-success col-md-12 btn-pay"
                                                style='height: 2.4em;margin: 12px;font-size: 1.2em;text-align: center;cursor: pointer;align-items: center;display: flex;justify-content: center;'>
                                                PAY
                                        </div>
                                    </div>
                                </div>
                            </div>




                        </div>
                    </div>
                </div>
            </div>




        </div>

    </div>






</div>
</div>

<!-- Sart Modal Success-->
<div class="modal fade modalPage" id="ModalSuccess" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header justify-content-center">
                <button type="button" class="close" onclick="closeModal()" aria-hidden="true">
                    <i class="now-ui-icons ui-1_simple-remove"></i>
                </button>
                <h4 class="title title-up">
                    <center>Efetuado com sucesso!</center>
                </h4>
            </div>
            <center>
                <div class="modal-body">

                    <div class="row">
                        <div class="col-sm-12 col-lg-12">
                            <div class="form-group">
                                <center><img src="<?php echo URL ?>/assets/img/success.png" width="100px"
                                        style="text-align: center; padding: 15px;"></center>
                                <center><img src="<?php echo URL ?>/assets/img/LinhasAtivo1.png" width="200px"
                                        style="text-align: center; padding: 15px;"></center>

                            </div>
                            <center>
                                <h6> Detalhes da transação</h6>
                            </center>

                            <center>
                                <h6> <i class="now-ui-icons tech_watch-time"></i> <small id='recTimer'> </small></h6>
                            </center>



                            <div
                                style="display: flex;flex-direction: column;justify-content: center;align-items: center;">
                                <p> Blockchain Txid: </p>
                                <small id='recTxid'> </small>
                            </div>
                            <div style="display: flex;flex-direction: row;justify-content: space-between; ">
                                <p> Valor: </p>
                                <p id='recValue'> </p>
                            </div>
                            <div style="display: flex;flex-direction: row;justify-content: space-between; ">
                                <p> Cotação: </p>
                                <p id='recCotacao'> </p>
                            </div>
                            <div style="display: flex;flex-direction: row;justify-content: space-between; ">
                                <p> Qtd USDT: </p>
                                <p id='sendUsdt'> </p>
                            </div>

                            <center>
                                <h6> Destinatário:</h6>
                            </center>

                            <div style="display: flex;flex-direction: row;justify-content: space-between; ">
                                <p id='sendFrom'> </p>
                            </div>

                            <center>
                                <h6> Beneficiário:</h6>
                                <p id='sendTo'> </p>

                            </center>

                            <div
                                style="display: flex;flex-direction: column;justify-content: center;align-items: center;">
                                <p> BilletId: </p>
                                <p id='billetId'> </p>
                            </div>

                            <p> Suporte </p>
                            <p> support@smartgateway.io</p>


                        </div>
                    </div>
                </div>
            </center>

        </div>
    </div>
</div>
<!--  End Modal Success-->

<!-- Sart Modal 2 -->
<div class="modal fade modalPage" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header justify-content-center">
                <button type="button" class="close" onclick="closeModal()" aria-hidden="true">
                    <i class="now-ui-icons ui-1_simple-remove"></i>
                </button>
                <h4 class="title title-up">
                    <center>Escaneie o QR Code abaixo para efetuar a transação:</center>
                </h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12 col-lg-12">
                        <center>
                            <h3 class="card-title"><strong>VALOR: </strong>R$<span id="amountBrl"></span></h3>
                        </center>
                    </div>

                    <div class="col-sm-12 col-lg-12">
                        <center>
                            <h3 class="card-title"><strong>QR CODE</strong></h3>
                        </center>
                        <div class="form-group" id="imgpix"
                            style="display: flex; justify-content: center; align-items: center; width: 100%;">
                            <!-- <img class="n-logo" src="<?php echo URL;; ?>assets/img/qrcode.png" style="width:40%;"> -->
                        </div>
                    </div>

                    <div class="col-sm-12 col-lg-12">
                        <center>
                            <h3 class="card-title"><strong>CHAVE PIX</strong></h3>
                        </center>
                        <div class="form-group">
                            <input type="text" id="codpix" value="" class="form-control" disabled />
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary btn-round btn-lg" id="btncopypix">Copiar Chave
                    Pix</button>
            </div>
        </div>
    </div>
</div>
<!--  End Modal 2-->
<script>
function deleteLastCharacter() {
    var display = document.getElementById('display');
    display.value = display.value.slice(0, -1);
    const format = unmountValue(display.value)
    formatValue.value = format
    formatValue.value
}


function deleteAllCharacter() {
    var display = document.getElementById('display');
    display.value = null;
    const format = unmountValue(display.value)
    formatValue.value = format
    formatValue.value
}


function appendNumber(num) {
    var display = document.getElementById('display');
    var formatValue = document.getElementById('formatValue');
    formatValue
    display.value += num;
    const format = unmountValue(display.value)
    console.log(format)
    formatValue.value = format
    formatValue.value

}

function unmountValue(value) {
    console.log(value.length)

    if (value.length >= 3) {
        if (value === '') {
            return '';
        }
        let decimal = value.replace(/\D/g, '').slice(-2);
        let inteValue = value.replace(/\D/g, '').slice(0, -2);
        return `${inteValue}.${decimal}`;
    }
    return value
}

function appendDecimal() {
    var display = document.getElementById('display');
    if (!display.value.includes('.')) {
        display.value += '.';
    }
}




window.onload = async (event) => {

    $('#document').mask('000.000.000-00', {
        reverse: true
    });


    $(" .loader").hide('slow').fadeOut();
    const token = await validatyToken()

    $(".btn-pay").click(async function() {
        // $(".loader").show('slow').fadeIn();
        const value = $('#formatValue').val();
        // const formData = new FormData();
        // formData.append('teste', 'yeye');
        // formData.append('value', value);
        const data = {
            value: value,
            document: $('#document').val(),
            email: $('#email').val()

        }
        try {
            const response = await smartGateway.post(`invoice/create-invoice`, data, token);
            if (response.data.error === 0) {

                $('#amountBrl').html(response.data.dataImg);
                $('#imgpix').html(
                    `<img class="n-logo" src="${response.data.dataImg}" style="width:40%;">`
                );
                $('#codpix').val(response.data.res.emv);

                $('#myModal').modal('hide');
                $('#myModal2').modal('show');

                // intervalStatus = setInterval(async () => {
                //     try {
                //         const response2 = await smartGateway.post(
                //             `page/status-emv/${response.data.res.uuid}`);
                //         if (response2.data.res.status === "failed") {
                //             return;
                //         }
                //         // console.log(response2.data);
                //         clearInterval(intervalStatus);
                //         $('#myModal2').modal('hide');
                //         $('#myModal').modal('hide');
                //         $('#ModalSuccess').modal('show');
                //         $("#recTxid").html(
                //             `<a href='https://polygonscan.com/tx/${response2.data.res.data.txid}'  target='_blank'> ${response2.data.res.data.txid} <a/>`
                //         )
                //         $("#billetId").html(`#${response.data.res.uuid}`);
                //         $("#recValue").html(response2.data.res.data.rate.total_brl);
                //         $("#recCotacao").html(response2.data.res.data.rate
                //             .price_usd);
                //         $("#sendUsdt").html(response2.data.res.data.rate
                //             .send_pxusdt);

                //         $("#recTimer").html(response2.data.timer)

                //         $("#sendFrom").html(userFrom.toUpperCase());
                //         $("#sendTo").html(userTo.toUpperCase());


                //         $('#name').val('');
                //         $('#document').val('');
                //         $('#email').val('');
                //         $('#phone').val('');

                //     } catch (error) {
                //         showToast(`Api Price not found.`, 'alert-danger', 6000);
                //         $('.form-cad').hide();
                //     }
                // }, 6000);
            } else {
                showToast('Login incorrect!', 'alert-danger', 6000);
                return;
            }
        } catch (error) {
            showToast(`${error.response.data}`, 'alert-danger', 6000);
            $('.form-cad').hide();

        } finally {
            $(".loader").hide('slow').fadeOut();
        }

    })

}
</script>