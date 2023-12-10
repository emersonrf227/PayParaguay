<?php
$f = new \App\sts\Models\helper\StsFormat();
?>
<div class="content">
    <div class="container-fluid">

        <form class="">
            <div class="">

                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group bmd-form-group">
                            <div style='display: flex; flex-direction: column'>
                                <label class="">Pesquisar por nome</label>
                                <input type="text" value="" id="name" class="form-control ">
                            </div>
                        </div>
                    </div>


                    <div class="col-md-3">
                        <div class="form-group bmd-form-group">
                            <div style='display: flex; flex-direction: column'>
                                <label class="">Status</label>
                                <select class="form-control" id="statusFil" aria-label="Default select example">
                                    <option value="">Selecione um status</option>
                                    <option value=1 selected>Ativo</option>
                                    <option value=0>Inativo</option>
                                    <option value="T">Todos</option>
                                </select>
                            </div>
                        </div>
                    </div>


                </div>
                <div class="col-md-3">

                    <button type="button" class="btn btn-warning btnFilter" onclick="listTransaction(1, true)"> <span
                            class="material-icons">
                            filter_alt
                        </span>Filtrar<div class="ripple-container">
                    </button>
                </div>

            </div>

        </form>

        <form class="navbar-form">
            <div class="input-group no-border">
                <button type="submit" class="btn btn-default btn-round btn-just-icon">
                    <i class="material-icons">search</i>
                    <div class="ripple-container"></div>
                </button>
                &nbsp;
                <input type="text" value="" id='searchItem' class="form-control" placeholder=" Pesquisar...">
            </div>
        </form>


        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-header card-header-warning">
                        <h4 class="card-title">Consulta de Transações</h4>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-hover">
                            <thead class="text-warning">
                                <th>ID</th>
                                <th>NOME</th>
                                <th>CPF</th>
                                <th>E-MAIL</th>
                                <th>PHONE</th>
                                <th>CARTEIRA</th>
                                <th>DATA CADASTRO</th>
                                <th>STATUS</th>
                            </thead>
                            <tbody id='list'>

                            </tbody>
                        </table>
                    </div>
                    <br>
                    <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-center">

                        </ul>
                    </nav>
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
    $(".loader").show('slow').fadeIn();
    let variables = '';
    if (filter) {
        const name = $("#name").val();
        const statusFil = $("#statusFil").val();
        variables = `&name=${name}&statusFil=${statusFil}`;
    }

    try {
        $('#list').html('');
        $('.pagination').html('');
        const headers = await validatyToken();
        const response = await smartGateway.get(`users/list?page=${page}${variables}`, headers);
        if (response.data.error === 0) {

            const paginationList = document.querySelector('.pagination');
            const totalPages = response.data.pagination.total_pagination;
            const currentPage = response.data.pagination.actual_page;
            const pages = Array.from({
                length: totalPages
            }, (_, index) => index + 1);
            const pageItems = pages.map(pageNumber => {
                const li = document.createElement('li');
                li.classList.add('page-item');
                li.style.color = 'white'

                if (pageNumber === page) {
                    li.classList.add('active');

                }
                const a = document.createElement('a');
                a.classList.add('page-link');
                a.onclick = () => {
                    listTransaction(pageNumber);
                };
                a.textContent = pageNumber;

                li.appendChild(a);
                return li;
            })
            pageItems.forEach(item => {
                paginationList.appendChild(item);
            });

            response.data.res.map((item, key) => {
                let colorBadge = null
                let display = null

                switch (item.active) {
                    case '1':
                        colorBadge = `success`;
                        display = 'ATIVO';
                        break;
                    case '0':
                        colorBadge = `danger`
                        display = 'INATIVO';

                        break;
                }
                // 
                $('#list').append(
                    `<tr><td style = "color:#ff3b00;" > ${item.id} </td> <td> ${item.name} </td> <td> ${item.document} </td> <td> ${item.email} </td> <td> ${item.phone} </td> <td> ${item.wallet} </td>  <td> ${ brlDate(item.createdAt)} </td> <td> <button style='width: 100px' class="btn btn-${colorBadge} btn-sm" > ${display} </button> </td>  </tr>`
                )
            })



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