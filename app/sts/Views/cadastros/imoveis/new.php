<header class="bg-gradient-dark">
    <div class="page-header min-vh-70" style="background-image: url('/assets/img/bg2.png');" loading="lazy">
        <span class="mask bg-gradient-dark opacity-6"></span>
        <div class="container">

        </div>
    </div>
</header>

<div class="card card-body blur shadow-blur mx-3 mx-md-4 mt-n6">
    <div class="container-fluid">
        <div class="row">

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="">Cadastros</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Imóveis</li>
                </ol>
            </nav>
            <section>
                <div class="container py-4">
                    <div class="row">
                        <div class="col-lg-7 mx-auto d-flex justify-content-center flex-column">
                            <h3 class="text-center">Cadastrar Imóveis</h3>
                            <form role="form" id="contact-form" method="post" autocomplete="off">
                                <div class="card-body">
                                    <h5>Dados do Projeto </h5>

                                    <div class="row">
                                        <div class="col-md-6 ps-2">
                                            <div class="input-group input-group-static  mb-4">
                                                <label class="form-label">Nome Projeto <span style="color:red">*</span> </label>
                                                <input class="form-control" id='name' aria-label="project name" type="text">
                                            </div>
                                        </div>
                                        <div class="col-md-6 ps-2">
                                            <div class="input-group input-group-static mb-4">
                                                <label class="form-label">Incorporadora <span style="color:red">*</span></label>
                                                <input type="text" class="form-control" id='incorp' placeholder="" aria-label="Incorporadora">
                                            </div>
                                        </div>


                                        <div class="col-md-6 ps-2">
                                            <div class="input-group input-group-static mb-4">
                                                <label class="form-label">Área m² <span style="color:red">*</span> </label>
                                                <input type="text" class="form-control" id='area' placeholder="" aria-label="Incorporadora">
                                            </div>
                                        </div>

                                        <div class="col-md-6 ps-2">
                                            <div class="input-group input-group-static mb-4">
                                                <label class="form-label">Valor Cota <span style="color:red">*</span></label>
                                                <input type="text" class="form-control" onInput="mascaraMoeda(event);" id='vlcota' placeholder="" aria-label="Incorporadora">
                                            </div>
                                        </div>

                                        <div class="col-md-6 ps-2">
                                            <div class="input-group input-group-static mb-4">
                                                <label class="form-label">Quantidade de Cotas <span style="color:red">*</span></label>
                                                <input type="text" class="form-control" id='qtdc' placeholder="" aria-label="Quantidade de Cotas">
                                            </div>
                                        </div>


                                        <div class="col-md-6 ps-2">
                                            <div class="input-group input-group-static mb-4">
                                                <label class="form-label">Endereço NFT <span style="color:red">*</span> </label>
                                                <input type="text" id='nftAdrress' class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-md-6 ps-2">
                                            <div class="input-group input-group-static mb-4">
                                                <label class="form-label">Percentual de entrega <span style="color:red">*</span></label>
                                                <input type="number" maxlength="3" id='percent' min="0" max="100" class="form-control">
                                            </div>
                                        </div>


                                        <div class="col-md-12 ps-2">

                                            <div class="input-group input-group-static mb-4">
                                                <label>Descrição do Projeto <span style="color:red">*</span> </label>
                                                <textarea name="message" class="form-control" id="description" rows="4"></textarea>
                                            </div>


                                        </div>

                                    </div>


                                    <Hr style="height: 2px; color: black; width: 100%; background-color: gray">
                                    <h5>Endereço </h5>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="input-group input-group-static mb-4 ">
                                                <label class="form-label">Cep <span style="color:red">*</span> </label>
                                                <input class="form-control" id='cep' aria-label="cep" type="text">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 ps-2">
                                            <div class="input-group input-group-static mb-4">
                                                <label class="form-label">Endereço: <span style="color:red">*</span></label>
                                                <input class="form-control" id='endereco' aria-label="endereco" type="text">
                                            </div>
                                        </div>




                                        <div class="col-md-6">
                                            <div class="input-group input-group-static mb-4">
                                                <label class="form-label">N:</label>
                                                <input class="form-control" id='num' aria-label="num" type="text">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="input-group input-group-static mb-4">
                                                <label class="form-label">Complemento:</label>
                                                <input class="form-control" id='complemento' aria-label="complemento" type="text">
                                            </div>
                                        </div>


                                        <div class="col-md-6">
                                            <div class="input-group input-group-static mb-4">
                                                <label class="form-label">Bairro: <span style="color:red">*</span></label>
                                                <input class="form-control" id='bairro' aria-label="Bairro" type="text">
                                            </div>
                                        </div>


                                        <div class="col-md-6">
                                            <div class="input-group input-group-static mb-4">
                                                <label class="form-label">Cidade: <span style="color:red">*</span></label>
                                                <input class="form-control" id='cidade' aria-label="Cidade" type="text">
                                            </div>
                                        </div>



                                        <div class="col-md-6">
                                            <div class="input-group input-group-static mb-4">
                                                <select class="form-control" id='estado' aria-label="estado" type="text">
                                                    <option selected value="">Selecione o estado <span style="color:red">*</span></option>
                                                    <option value="AC">Acre</option>
                                                    <option value="AL">Alagoas</option>
                                                    <option value="AP">Amapá</option>
                                                    <option value="AM">Amazonas</option>
                                                    <option value="BA">Bahia</option>
                                                    <option value="CE">Ceará</option>
                                                    <option value="DF">Distrito Federal</option>
                                                    <option value="ES">Espírito Santo</option>
                                                    <option value="GO">Goiás</option>
                                                    <option value="MA">Maranhão</option>
                                                    <option value="MT">Mato Grosso</option>
                                                    <option value="MS">Mato Grosso do Sul</option>
                                                    <option value="MG">Minas Gerais</option>
                                                    <option value="PA">Pará</option>
                                                    <option value="PB">Paraíba</option>
                                                    <option value="PR">Paraná</option>
                                                    <option value="PE">Pernambuco</option>
                                                    <option value="PI">Piauí</option>
                                                    <option value="RJ">Rio de Janeiro</option>
                                                    <option value="RN">Rio Grande do Norte</option>
                                                    <option value="RS">Rio Grande do Sul</option>
                                                    <option value="RO">Rondônia</option>
                                                    <option value="RR">Roraima</option>
                                                    <option value="SC">Santa Catarina</option>
                                                    <option value="SP">São Paulo</option>
                                                    <option value="SE">Sergipe</option>
                                                    <option value="TO">Tocantins</option>
                                                    <option value="EX">Estrangeiro</option>
                                                </select>
                                            </div>
                                        </div>

                                    </div>


                                    <Hr style="height: 2px; color: black; width: 100%; background-color: gray">
                                    <h5>Upload <span style="color:red">*</span> </h5>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="input-group input-group-static mb-4">
                                                <input type="file" id="files" name="files" multiple><br><br>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-md-12">
                                        <button type="button" class="btn bg-gradient-dark w-100 send">Cadastrar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>






        </div>
    </div>
</div>

<script>
    window.onload = (event) => {
        load()
        $('#cep').mask('00000-000');
        $("#cep").keyup(async function(e) {

            const cep = String(e.target.value);

            if (cep.length === 9) {
                const response = await viacep.get(`/ws/${cep}/json/`)
                $("#endereco").focus()
                $("#endereco").val(response.data.logradouro)
                $("#bairro").focus()
                $("#bairro").val(response.data.bairro)
                $("#cidade").focus()
                $("#cidade").val(response.data.localidade)
                $("#estado").focus()
                // $("#uf").val(response.data.uf)
                $("#estado option").filter(function() {
                    return this.value == response.data.uf;

                }).attr('selected', true);
                $("#estado").focusout()
                // showToast('Realizado com sucesso', 'alert-success', 6000)
            }
        })

        $(".send").click(async function() {

            const header = {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            }

            debugger
            const name = $("#name").val();
            const incorp = $("#incorp").val();
            const area = $("#area").val();
            const vlcota = $("#vlcota").val();
            const qtdc = $("#qtdc").val();
            const percent = $("#percent").val();
            const nftAdrress = $("#nftAdrress").val();
            const description = $("#description").val();
            const cep = $("#cep").val();
            const endereco = $("#endereco").val();
            const num = $("#num").val();
            const complemento = $("#complemento").val();
            const bairro = $("#bairro").val();
            const cidade = $("#cidade").val();
            const estado = $("#estado").val();
            const files = document.querySelector('#files');

            if (name == '') {
                showToast('Preencher todos os campos obrigatórios.', 'alert-danger', 6000)
                return
            }
            if (incorp == '') {
                showToast('Preencher todos os campos obrigatórios.', 'alert-danger', 6000)
                return
            }
            if (area == '') {
                showToast('Preencher todos os campos obrigatórios.', 'alert-danger', 6000)
                return
            }
            if (vlcota == '') {
                showToast('Preencher todos os campos obrigatórios.', 'alert-danger', 6000)
                return
            }

            if (qtdc == '') {
                showToast('Preencher todos os campos obrigatórios.', 'alert-danger', 6000)
                return
            }
            if (nftAdrress == '') {
                showToast('Preencher todos os campos obrigatórios.', 'alert-danger', 6000)
                return
            }
            if (description == '') {
                showToast('Preencher todos os campos obrigatórios.', 'alert-danger', 6000)
                return
            }
            if (cep == '') {
                showToast('Preencher todos os campos obrigatórios.', 'alert-danger', 6000)
                return
            }
            if (endereco == '') {
                showToast('Preencher todos os campos obrigatórios.', 'alert-danger', 6000)
                return
            }
            if (bairro == '') {
                showToast('Preencher todos os campos obrigatórios.', 'alert-danger', 6000)
                return
            }
            if (cidade == '') {
                showToast('Preencher todos os campos obrigatórios.', 'alert-danger', 6000)
                return
            }
            if (estado == '') {
                showToast('Preencher todos os campos obrigatórios.', 'alert-danger', 6000)
                return
            }
            if (files == '') {
                showToast('Preencher todos os campos obrigatórios.', 'alert-danger', 6000)
                return
            }


            // incorp == '' || area == '' || vlcota == '' || nftAdrress == '' || description == '' || cep == '' || endereco == '' || bairro == '' || cidade == '' || estado == '' || files)
            const data = new FormData;
            data.append('name', name)
            data.append('incorp', incorp)
            data.append('area', area)
            data.append('vlcota', vlcota)
            data.append('qtdc', qtdc)

            data.append('percent', percent)
            data.append('nftAdrress', nftAdrress)
            data.append('description', description)
            data.append('cep', cep)
            data.append('endereco', endereco)
            data.append('num', num)
            data.append('complemento', complemento)
            data.append('bairro', bairro)
            data.append('cidade', cidade)
            data.append('estado', estado)
            for (let i = 0; i < files.files.length; i++) {
                data.append('files[]', files.files[i]);
            }
            const response = await loti.post('/cadastros/put-imoveis', data, header);
            if (response.data.error === 0) {
                showToast(response.data.msg, 'alert-success', 3000)

                setTimeout(function() {
                    window.location.assign('/Cadastros/imoveis')
                }, 1000)
            }

        })


    }
</script>