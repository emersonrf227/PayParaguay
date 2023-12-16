<?php
$f = new \App\sts\Models\helper\StsFormat();
?>
<!-- End Navbar -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12"
                style="display:flex; flex-direction:row; justify-content:center;">
                <a href=""><i class="material-icons text-warning" onclick="load()">autorenew</i></a>
            </div>
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="card card-stats">
                    <div class="card-header card-header-warning card-header-icon">
                        <div class="card-icon">
                            <i class="material-icons">account_balance_wallet</i>
                        </div>
                        <p class="card-category">Amount

                        <h4 class="card-title" id="balancePlg"></h4>

                        </p>





                    </div>
                    <div class="card-footer">

                    </div>
                </div>
            </div>
        </div>
        <div class="row">

            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-success card-header-icon">
                        <div class="card-icon">
                            <i class="material-icons">attach_money</i>
                        </div>
                        <p class="card-category">Amount Transaction by Moth (R$)</p>
                        <h3 class="card-title" id="totalSumOrders">...</h3>
                    </div>
                    <div class="card-footer">
                        <div class="stats">
                            <i class="material-icons">feedback</i> Total
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-header card-header-warning">
                        <h4 class="card-title">Last Transactions recebidas</h4>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-hover">
                            <thead class="text-warning">
                                <th>#</th>
                                <th>NAME</th>
                                <th>DOCUMENT</th>
                                <th>AMOUNT</th>
                            </thead>
                            <tbody id="listTransactions">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
window.onload = async (event) => {
    load();
}

async function load() {

    debugger
    $(".loader").show('slow').fadeIn();
    try {

        const token = await validatyToken()
        const response = await smartGateway.get('dashboard/get-data', token);
        if (response.data.error === 0) {
            $(".loader").hide('slow').fadeOut();
            const qtyUsers = response.data.res.total_users.length;
            const balancePlg = maskCurrency(response.data.res.balance);
            const totalSumOrders = maskCurrency(response.data.res.total_sum_orders.amount_brl);
            const transactions = response.data.res.transactions;
            $('#listTransactions').html('');
            transactions.map((item, key) => {
                $('#listTransactions').append(`
                    <tr>
                        <td style="color:#ff3b00;">${key + 1}</td>
                        <td>${item.name}</td>
                        <td>${item.document}</td>
                        <td>${maskCurrency(item.total_brl)}</td>
                        <td>${item.addressWallet}</td>
                    </tr>
                `);
            })
            $('#balancePlg').html(balancePlg);
            $('#qtyUsers').html(qtyUsers);
            $('#totalSumOrders').html(totalSumOrders);
        }
    } catch (error) {

        $(".loader").hide('slow').fadeOut();
    }
}
</script>