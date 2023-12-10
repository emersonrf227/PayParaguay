<!-- Start Modal kyc -->
<div class="modal fade modalPage" id="myModalkyc" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header justify-content-center">
                <button type="button" class="close" onclick="closeModal()" aria-hidden="true">
                    <i class="now-ui-icons ui-1_simple-remove"></i>
                </button>
                <h4 class="title title-up">
                    <center>Olá! Notamos que<br> você é novo por aqui.</center>
                </h4>
            </div>
            <div class="modal-body">
                <p align="justify">Para continuarmos, gostaríamos de informar que será necessário realizar o processo de
                    (KYC).<br>
                    Não se preocupe, pois este é um procedimento bastante simples e rápido. Vamos começar?<br>
                    <b>É importante ressaltar que o KYC é um processo que você só precisará completar uma única vez</b>
                </p>
            </div>
            <div class="modal-footer" id="kycfooter">

            </div>
        </div>
    </div>
</div>
<!--  End Modal kyc-->

<!-- Sart Modal -->
<div class="modal fade modalPage" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header justify-content-center">
                <button type="button" class="close" onclick="closeModal()" aria-hidden="true">
                    <i class="now-ui-icons ui-1_simple-remove"></i>
                </button>
                <h4 class="title title-up">
                    <center>Qual o valor<br>que você deseja enviar em R$:</center>
                </h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12 col-lg-12">
                        <div class="form-group">
                            <input type="text" id="vlrpix" placeholder="Digite o valor em real (R$):" class="form-control" onkeyup="valMoeda(this);" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary btn-round btn-lg" id="btnpixgenerate">
                    Prosseguir
                </button>
            </div>
        </div>
    </div>
</div>
<!--  End Modal -->

<!-- Sart Modal 2 -->
<div class="modal fade modalPage" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                        <div class="form-group" id="imgpix" style="display: flex; justify-content: center; align-items: center; width: 100%;">
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

<!-- Sart Modal Success-->
<div class="modal fade modalPage" id="ModalSuccess" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                                <center><img src="<?php echo URL ?>/assets/img/success.png" width="100px" style="text-align: center; padding: 15px;"></center>
                                <center><img src="<?php echo URL ?>/assets/img/LinhasAtivo1.png" width="200px" style="text-align: center; padding: 15px;"></center>

                            </div>
                            <center>
                                <h6> Detalhes da transação</h6>
                            </center>

                            <center>
                                <h6> <i class="now-ui-icons tech_watch-time"></i> <small id='recTimer'> </small></h6>
                            </center>



                            <div style="display: flex;flex-direction: column;justify-content: center;align-items: center;">
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

                            <div style="display: flex;flex-direction: column;justify-content: center;align-items: center;">
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

<footer class="footer" data-background-color="black">
    <div class=" container ">
        <nav>
            <?php
            if ($this->changeRdp){
            echo "
            <ul>
                <li>SMART GATEWAY</li>
                <br>
                <li> SUPORTE: support@smartgateway.io</li>
            </ul>";
            }
            ?>
        </nav>

    </div>
</footer>
<div class="alert text-white font-weight-bold" id='alert' role="alert" style="z-index: 100000; position:fixed; top:0; width:100%; display:none">
</div>

<!--   Core JS Files   -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
</script>
<script src="<?php echo URL; ?>assets/js/core/jquery.min.js" type="text/javascript"></script>
<script src="<?php echo URL; ?>assets/js/core/popper.min.js" type="text/javascript"></script>
<script src="<?php echo URL; ?>assets/js/core/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo URL; ?>assets/js/plugins/bootstrap-switch.js"></script>
<script src="<?php echo URL; ?>assets/js/plugins/nouislider.min.js" type="text/javascript"></script>
<script src="<?php echo URL; ?>assets/js/plugins/bootstrap-datepicker.js" type="text/javascript"></script>
<script src="<?php echo URL; ?>assets/js/now-ui-kit.js?v=1.3.0" type="text/javascript"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.0/jquery.mask.js"></script>

<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="<?php echo URL;; ?>assets/js/axios.js" type="text/javascript"></script>
<script src="<?php echo URL;; ?>assets/js/index.js" type="text/javascript"></script>

<script>
    async function signout() {
        localStorage.removeItem("access_token");
        localStorage.removeItem("limit");
        localStorage.removeItem("username");
        window.location.assign(
            "/login/acesso",
        );
    }

    async function validatyToken() {
        const access_token = localStorage.getItem("access_token");
        const limit = localStorage.getItem("limit");
        if (access_token) {
            const timestamp = new Date().getTime().toString().slice(0, 10);
            // console.log(timestamp, limit)

            if (!limit) {
                showToast('Session Expired!', 'alert-danger', 6000);
                window.location.assign(
                    "/login/acesso",
                );
                return;
            }
            if (timestamp > limit) {
                showToast('Session Expired!', 'alert-danger', 6000);
                window.location.assign(
                    "/login/acesso",
                );
                return;
            }
            const headers = {
                headers: {
                    'Content-Type': 'application/json',
                    Authorization: `Bearer ${access_token}`,
                },
            };
            return headers
        }
        window.location.assign(
            "/login/acesso",
        );

    }
</script>
</body>

</html>