<?php
$f = new \App\sts\Models\helper\StsFormat();
extract($this->Dados['recibo']['recibos'][0]);
$timer = explode(" ", $created);
$date = date('d/m/Y', strtotime($timer[0]));

?>

<header class="bg-gradient-dark">
    <div class="page-header min-vh-70" style="background-image: url('<?php echo URL ?>assets/img/bg2.png');" loading="lazy">
        <span class="mask bg-gradient-dark opacity-6"></span>
        <div class="container">
            <div class="row justify-content-center">

            </div>
        </div>
    </div>
</header>

<div class="card card-body blur shadow-blur mx-12 mx-md-4 mt-n3">
    <div class="container-fluid">
        <div class="row">

            <div class="col-xl-12 ms-auto mt-xl-0 mt-12">
                <div class="card h-100">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1">
                            <div class="container">
                                <div class="row">
                                    <div class="col-12 my-auto">
                                        <div class="numbers">
                                            <h5 class="text-white font-weight-bolder mb-0">
                                                <center> Recibo </center>
                                            </h5>
                                        </div>
                                    </div>
                                    <div class="col-4 text-end">
                                        <h5 class="mb-0 text-white text-end me-3"></h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-3">
                        <div class="card-body">
                            <h4 class="card-title"><text style="color:#00162E;">Dados principais da transação:</text></h4>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class=" text-primary">
                                        <th style="color:#fff;">
                                            Nome
                                        </th>
                                        <th style="color:#fff;">
                                            CPF
                                        </th>
                                        <th style="color:#fff;">
                                            Valor
                                        </th>
                                        <th style="color:#fff;">
                                            Data
                                        </th>
                                        <th style="color:#fff;" class="text-right">
                                            Status
                                        </th>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <?php echo $name; ?>
                                            </td>
                                            <td>
                                                <?php echo $document; ?>
                                            </td>
                                            <td>
                                                <?php echo $f->moedaReal($valueDeposit); ?>
                                            </td>
                                            <td>
                                                <?php echo $date; ?>
                                            </td>
                                            <td class="text-right">
                                                <?php echo $status; ?>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <p class="card-description">
                                <br>
                            <h4 class="card-title"><text style="color:#00162E;">Detalhes:</text></h4>
                            <div class="table-responsive">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td width="25%">Telefone:</td>
                                            <td width="75%"><?php echo $phone; ?></td>
                                        </tr>
                                        <tr>
                                            <td>E-mail:</td>
                                            <td><?php echo $email; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Hora:</td>
                                            <td><?php echo $timer[1]; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Hash da Carteira:</td>
                                            <td><?php echo $addressWallet; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Valor BRL:</td>
                                            <td><?php echo $f->moedaReal($total_brl); ?></td>
                                        </tr>

                                        <tr>
                                            <td>USDT Price:</td>
                                            <td><?php echo $f->moedaReal($price_usd); ?></td>
                                        </tr>



                                        <tr>
                                            <td>Hash da Transação:</td>
                                            <td><?php echo $txid; ?></td>
                                        </tr>


                                        <tr>
                                            <td>Error:</td>
                                            <td><?php echo $error_messasger; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Send:</td>
                                            <td>

                                                <div class='tm-status-circle moving'></div><?php echo $status; ?>
                                            </td>
                                        </tr>

                                        <?php
                                        if ($status == 'error') {
                                            echo
                                            "
                                                        <tr>
                                                           <td>
                                                                <button type='button' onclick='resendOrdem()' class='btn btn-primary btn-block text-uppercase col-md-3'>
                                                                    Reprocessar
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    ";
                                        }
                                        ?>
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

<div class="container">
    <div class="row">
        <div class="col">
            <p class="text-white mt-5 mb-5">Detalhes da transação de compra:</p>
        </div>
    </div>
    <div class="" id="home">
        <div class="row tm-content-row">
            <div class="col-12 tm-block-col">
                <div class="tm-bg-primary-dark tm-block tm-block-h-auto">
                    <div class="card card-testimonial">

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    async function resendOrdem() {
        var formData = new FormData();
        formData.append('hash', `<?php echo $hash ?>`);
        $(".loader").show('slow').fadeIn();

        try {
            const response = await api.post('buy/resend', formData);
            if (response.data.error === 0) {
                $(".loader").hide('slow').fadeOut();
                document.location.reload(true);

            }

        } catch (error) {

            $(".loader").hide('slow').fadeOut();

        }

    }
</script>