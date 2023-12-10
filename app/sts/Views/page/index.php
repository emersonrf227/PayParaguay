<?php
$f = new \App\sts\Models\helper\StsFormat();
?>


<div class="wrapper">
    <div class="page-header clear-filter" filter-color="orange">
        <div class="page-header-image" data-parallax="true" style="background-image:url('./assets/img/bck.jpg');">
        </div>
        <div class="container">
            <div class="content-center brand">
                <img class="n-logo" src="./assets/img/LinhasAtivo3.png" alt=""><br><br>
                <h1 class="h1-seo">RÁPIDO, SIMPLES E PRÁTICO!</h1><br>
                <h3>Para iniciarmos, por favor identifique-se:</h3>
                <center>
                    <div class="col-sm-6 col-lg-6">
                        <div class="form-group">

                            <input type="text" id="username"
                                placeholder="Digite o nome do usuário que recebera a transação." class="form-control"
                                style="background-color:white;" />

                        </div>
                    </div>
                </center>
                <br>
                <button class="btn btn-primary btn-round btn-lg btn-username" type="button">
                    Enviar
                </button>
            </div>
        </div>
    </div>
    <div class="main">
        <div class="section section-nucleo-icons">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-12">
                        <h2 class="title">Converta PIX em USDT!</h2>
                        <h5 class="description">
                            A Smart Gateway foi fundada por uma equipe de profissionais com ampla experiência em
                            tecnologia e finanças. Reconhecemos a crescente necessidade de soluções que permitam a
                            conversão instantânea de PIX, o popular meio de pagamento brasileiro, em USDT, uma
                            criptomoeda amplamente aceita. Nossa empresa foi criada para oferecer uma solução segura e
                            eficiente que atenda às demandas do mercado moderno.
                        </h5>
                        <!-- <div class="nucleo-container">
				            <img src="assets/img/nucleo.svg" alt="">
			            </div> -->
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <div class="icons-container">
                            <i class="now-ui-icons business_money-coins"></i>
                            <i class="now-ui-icons ui-2_like"></i>
                            <i class="now-ui-icons objects_spaceship"></i>
                            <i class="now-ui-icons business_money-coins"></i>
                            <i class="now-ui-icons ui-2_like"></i>
                            <i class="now-ui-icons emoticons_satisfied"></i>
                            <i class="now-ui-icons objects_spaceship"></i>
                            <i class="now-ui-icons business_money-coins"></i>
                            <i class="now-ui-icons ui-2_like"></i>
                            <i class="now-ui-icons business_money-coins"></i>
                            <i class="now-ui-icons ui-2_like"></i>
                            <i class="now-ui-icons objects_spaceship"></i>
                            <i class="now-ui-icons objects_spaceship"></i>
                            <i class="now-ui-icons ui-2_like"></i>
                            <i class="now-ui-icons objects_spaceship"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="section section-nucleo-icons form-cad" style="display:none;">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-12">
                        <h2 class="title">Formulário de envio</h2>
                        <p class="category" style="color:#ff0302"><text style="color:black">Cotação:</text> 1 USDT <text
                                style="color:black">@</text>
                            <spam id="dolarprice">
                        </p>
                        <div id="inputs">
                            <p class="category">Preencha os dados corretamente</p>
                            <div class="row">

                                <div class="col-sm-6 col-lg-12">
                                    <div class="form-group">
                                        <input type="text" value="" id='document' placeholder="CPF"
                                            class="form-control" />
                                    </div>
                                </div>


                                <div class="col-sm-6 col-lg-12">
                                    <div class="form-group">
                                        <input type="text" value="" id='name' placeholder="Nome completo"
                                            class="form-control" />
                                    </div>
                                </div>

                                <div class="col-sm-6 col-lg-12">
                                    <div class="form-group">
                                        <input type="text" value="" id='email' placeholder="E-mail"
                                            class="form-control" />
                                    </div>
                                </div>
                                <div class="col-sm-6 col-lg-12">
                                    <div class="form-group">
                                        <input type="text" value="" id='phone' placeholder="Celular"
                                            class="form-control" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="nucleo-container">
				            <img src="assets/img/nucleo.svg" alt="">
			            </div> -->
                        <button class="btn btn-primary btn-round btn-lg" id="validator">
                            Prosseguir
                        </button>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <div class="icons-container"
                            style="display: flex; justify-content: center; align-items: center; width: 100%; height: 300px;">
                            <img class="n-logo" src="./assets/img/LinhasAtivo1.png" style="width: 100%; height: 150px;"
                                alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <script>
        let intervalKyc = null;
        let intervalStatus = null;
        let uuid = null;
        let userFrom = null;
        let userTo = null;





        window.onload = (event) => {




            $("#btncopypix").click(function() {
                // Get the text field
                var copyText = document.getElementById("codpix");
                copyText.select();
                copyText.setSelectionRange(0, 99999); // For mobile devices
                // Copy the text inside the text field
                navigator.clipboard.writeText(copyText.value);
                showToast("Chave copiada: " + copyText.value, 'alert-success', 6000)

            })

            $(".valueSend").keypress(async function() {
                try {

                    const len = $(".valueSend").val();

                    if (len.length > 4) {
                        const valueSend = valMoeda($(".valueSend").val());
                    } else {
                        const valueSend = valMoeda($(".valueSend").val());

                        // $(".qtdtt").val("");
                    }

                } catch (error) {}
            })


            $('#document').mask('000.000.000-00', {
                reverse: true
            });

            $(".loader").hide('slow').fadeOut();

            $('.btn-username').click(async function() {
                $(".loader").show('slow').fadeIn();

                const username = $('#username').val();

                try {
                    const response = await xbetterworld.get(`isvalid?q=${username}`);

                    if (response.status !== 200) {
                        showToast('Api indisponível!', 'alert-danger', 6000);
                        return;
                    }


                    showToast(`Você está realizando uma transação para o usuário - ${username}!`,
                        'alert-success', 6000);

                    userTo = username;
                    if (response.data) {
                        await getPrice()
                        $('.form-cad').show();
                        $("html, body").animate({
                            scrollTop: $('.form-cad').offset().top
                        }, 1000);
                        return;
                    }
                    showToast('Usuário não localizado!', 'alert-danger', 6000);
                    $('.form-cad').hide();
                } catch (error) {
                    showToast(`${error.response.data}`, 'alert-danger', 6000);
                    $('.form-cad').hide();

                } finally {
                    $(".loader").hide('slow').fadeOut();
                }
            })

            $('#btnpixgenerate').click(async function() {
                const vlrpix = converteMoedaFloat($('#vlrpix').val());
                const data = new FormData();
                data.append('uuid', uuid);
                data.append('brlAmount', vlrpix);
                $(".loader").show('slow').fadeIn();
                try {
                    const response = await smartGateway.post('page/generate-emv', data);
                    if (response.data.error === 0) {
                        $('#amountBrl').html($('#vlrpix').val());
                        $('#imgpix').html(
                            `<img class="n-logo" src="${response.data.res.qrcode}" style="width:40%;">`
                        );
                        $('#codpix').val(response.data.res.emv);

                        $('#myModal').modal('hide');
                        $('#myModal2').modal('show');

                        intervalStatus = setInterval(async () => {
                            try {
                                const response2 = await smartGateway.post(
                                    `page/status-emv/${response.data.res.uuid}`);
                                if (response2.data.res.status === "failed") {
                                    return;
                                }
                                // console.log(response2.data);
                                clearInterval(intervalStatus);
                                $('#myModal2').modal('hide');
                                $('#myModal').modal('hide');
                                $('#ModalSuccess').modal('show');
                                $("#recTxid").html(
                                    `<a href='https://polygonscan.com/tx/${response2.data.res.data.txid}'  target='_blank'> ${response2.data.res.data.txid} <a/>`
                                )
                                $("#billetId").html(`#${response.data.res.uuid}`);
                                $("#recValue").html(response2.data.res.data.rate.total_brl);
                                $("#recCotacao").html(response2.data.res.data.rate
                                    .price_usd);
                                $("#sendUsdt").html(response2.data.res.data.rate
                                    .send_pxusdt);

                                $("#recTimer").html(response2.data.timer)

                                $("#sendFrom").html(userFrom.toUpperCase());
                                $("#sendTo").html(userTo.toUpperCase());


                                $('#name').val('');
                                $('#document').val('');
                                $('#email').val('');
                                $('#phone').val('');

                            } catch (error) {
                                showToast(`Api Price not found.`, 'alert-danger', 6000);
                                $('.form-cad').hide();
                            }
                        }, 6000);
                    }
                } catch (error) {
                    console.log(error);
                } finally {
                    $(".loader").hide('slow').fadeOut();
                }
            })


            $('#document').blur(async function() {
                const document = $('#document').val();
                const data = new FormData();
                data.append('document', document);
                $(".loader").show('slow').fadeIn();
                try {
                    const response = await smartGateway.post('page/check-document', data);
                    if (response.data.error === 0) {
                        const wallet = response.data.res.wallet;
                        const document = response.data.res.document;
                        userFrom = response.data.res.name;
                        $('#name').val(response.data.res.name).prop("disabled", true);
                        $('#email').val(response.data.res.email).prop("disabled", true);
                        $('#phone').val(response.data.res.phone).prop("disabled", true);





                        uuid = response.data.res.uuid;
                        if (response.data.res.kyc.isvalidated) {

                            $('#myModal').modal('show');
                        } else {
                            clearInterval(intervalKyc);
                            $('#kycfooter').html(
                                `<a href="https://kyc.smartpay.com.vc/?partner=extracto&action=regpix&chain=polygon&address=${wallet}&taxid=${document}" class="btn btn-primary btn-round btn-lg" target="_blank">Continuar</a>`
                            );
                            $('#myModalkyc').modal('show');

                            intervalKyc = setInterval(async () => {
                                try {
                                    const data = new FormData();
                                    data.append('document', document);
                                    data.append('wallet', wallet);
                                    const rec = await smartGateway.post(`page/confirm-kyc`,
                                        data);
                                    if (rec.data.isvalidated) {
                                        $('#myModalkyc').modal('hide');
                                        $('#myModal').modal('show');
                                        clearInterval(intervalKyc);
                                    }
                                } catch (error) {
                                    showToast(`Api Price not found.`, 'alert-danger', 6000);
                                    $('.form-cad').hide();
                                }
                            }, 6000);

                        }
                        return
                    }
                    $('#name').val('').prop("disabled", false);
                    $('#email').val('').prop("disabled", false);
                    $('#phone').val('').prop("disabled", false);

                } catch (error) {

                } finally {
                    $(".loader").hide('slow').fadeOut();
                }

            })





            $('#validator').click(async function() {
                const name = $('#name').val();
                const document = $('#document').val();
                const email = $('#email').val();
                const phone = $('#phone').val();

                if (name === '') {
                    showToast('O campo NOME é obrigatório', 'alert-danger', 6000);
                    return;
                }

                if (document === '') {
                    showToast('O campo CPF é obrigatório', 'alert-danger', 6000);
                    return;
                }

                if (email === '') {
                    showToast('O campo E-MAIL é obrigatório', 'alert-danger', 6000);
                    return;
                }

                if (phone === '') {
                    showToast('O campo CELULAR é obrigatório', 'alert-danger', 6000);
                    return;
                }

                const data = new FormData();
                data.append('name', name);
                data.append('document', document);
                data.append('email', email);
                data.append('phone', phone);
                $(".loader").show('slow').fadeIn();
                try {
                    const response = await smartGateway.post('page/check-register', data);
                    if (response.data.error === 0) {
                        const wallet = response.data.res.wallet;
                        const document = response.data.res.document;
                        userFrom = response.data.res.name;
                        uuid = response.data.res.uuid;
                        if (response.data.res.kyc.isvalidated) {

                            $('#myModal').modal('show');
                        } else {
                            clearInterval(intervalKyc);
                            $('#kycfooter').html(
                                `<a href="https://kyc.smartpay.com.vc/?partner=extracto&action=regpix&chain=polygon&address=${wallet}&taxid=${document}" class="btn btn-primary btn-round btn-lg" target="_blank">Continuar</a>`
                            );
                            $('#myModalkyc').modal('show');

                            intervalKyc = setInterval(async () => {
                                try {
                                    const data = new FormData();
                                    data.append('document', document);
                                    data.append('wallet', wallet);
                                    const rec = await smartGateway.post(`page/confirm-kyc`,
                                        data);
                                    if (rec.data.isvalidated) {
                                        $('#myModalkyc').modal('hide');
                                        $('#myModal').modal('show');
                                        clearInterval(intervalKyc);
                                    }
                                } catch (error) {
                                    showToast(`Api Price not found.`, 'alert-danger', 6000);
                                    $('.form-cad').hide();
                                }
                            }, 6000);

                        }
                    }
                } catch (error) {

                } finally {
                    $(".loader").hide('slow').fadeOut();
                }

            })
        }

        function closeModal() {
            $('.modalPage').modal('hide');
        }

        function formatReal() {
            $(".valueSend").val(FormatMoeda($(".qtdtt").val()));
        }

        async function getPrice() {

            try {
                const rec = await priceSmartpay.get(
                    `swapix/swapquote?currency=brl&type=sell&profile=transfer&target=amount&conv=pxusdt&amount=1`
                );

                $('#dolarprice').html(maskCurrency(rec.data.data.price_usd));
                setInterval(async () => {
                    try {
                        const rec = await priceSmartpay.get(
                            `swapix/swapquote?currency=brl&type=sell&profile=transfer&target=amount&conv=pxusdt&amount=1`
                        );
                        $('#dolarprice').html(maskCurrency(rec.data.data.price_usd));
                    } catch (error) {
                        showToast(`Api Price not found.`, 'alert-danger', 6000);
                        $('.form-cad').hide();
                    }
                }, 10000);
            } catch (error) {
                showToast(`Api Price not found.`, 'alert-danger', 6000);

            }

        }

        function scrollToDownload() {

            if ($('.section-download').length != 0) {
                $("html, body").animate({
                    scrollTop: $('.section-download').offset().top
                }, 1000);
            }
        }
        </script>