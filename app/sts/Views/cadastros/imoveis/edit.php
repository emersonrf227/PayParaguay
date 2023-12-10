<?php
// echo "<pre>";
// var_dump($this->Dados[0]);
// "</pre>";
?>


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
                    <li class="breadcrumb-item"><a href="">Editar</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Imóveis</li>
                </ol>
            </nav>
            <section>
                <div class="container py-4">
                    <div class="row">
                        <div class="col-lg-7 mx-auto d-flex justify-content-center flex-column">
                            <h3 class="text-center">Editar Imóveis</h3>
                            <form role="form" id="contact-form" method="post" autocomplete="off">
                                <div class="card-body">
                                    <h3>Dados de Endereço</h3>
                                    <Hr style="height: 2px; color: black; width: 100%; background-color: gray">
                                    <br>
                                    <div class="row">
                                        <div class="col-md-6 ps-2">
                                            <div class="input-group input-group-static  mb-4">
                                                <label class="form-label">Nome Projeto <span style="color:red">*</span>
                                                </label>
                                                <input class="form-control" id='name' value="<?php echo $this->Dados[0]['nft']['title']; ?>" aria-label="project name" type="text">
                                            </div>
                                        </div>
                                        <div class="col-md-6 ps-2">
                                            <div class="input-group input-group-static mb-4">
                                                <label class="form-label">Incorporadora <span style="color:red">*</span></label>
                                                <input type="text" class="form-control" id='incorp' value="<?php echo $this->Dados[0]['nft']['responsible']; ?>" placeholder="" aria-label="Incorporadora">
                                            </div>
                                        </div>


                                        <div class="col-md-6 ps-2">
                                            <div class="input-group input-group-static mb-4">
                                                <label class="form-label">Área m² <span style="color:red">*</span>
                                                </label>
                                                <input type="text" class="form-control" id='area' value="<?php echo $this->Dados[0]['nft']['squareMeter']; ?>" placeholder="" aria-label="m2">
                                            </div>
                                        </div>

                                        <div class="col-md-6 ps-2">
                                            <div class="input-group input-group-static mb-4">
                                                <label class="form-label">Valor Cota <span style="color:red">*</span></label>
                                                <input type="text" class="form-control" onInput="mascaraMoeda(event);" id='vlcota' value="<?php echo $this->Dados[0]['nft']['value']; ?>" placeholder="" aria-label="value">
                                            </div>
                                        </div>

                                        <div class="col-md-6 ps-2">
                                            <div class="input-group input-group-static mb-4">
                                                <label class="form-label">Quantidade de Cotas <span style="color:red">*</span></label>
                                                <input type="text" class="form-control" id='qtdc' value="<?php echo $this->Dados[0]['nft']['title']; ?>" placeholder="" aria-label="Quantidade de Cotas">
                                            </div>
                                        </div>


                                        <div class="col-md-6 ps-2">
                                            <div class="input-group input-group-static mb-4">
                                                <label class="form-label">Endereço NFT <span style="color:red">*</span>
                                                </label>
                                                <input type="text" id='nftAdrress' value="<?php echo $this->Dados[0]['nft']['smartContract']; ?>" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-md-6 ps-2">
                                            <div class="input-group input-group-static mb-4">
                                                <label class="form-label">Percentual de entrega <span style="color:red">*</span></label>
                                                <input type="number" maxlength="3" id='percent' value="<?php echo $this->Dados[0]['nft']['percentual']; ?>" min="0" max="100" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-md-6 ps-2">
                                            <div class="input-group input-group-static mb-4">

                                                <select name="active" id="active" class="form-control">
                                                    <option <?php if ($this->Dados[0]['nft']['active'] == 1) echo "selected"; ?> value="1">Ativo</option>
                                                    <option <?php if ($this->Dados[0]['nft']['active'] == 0)  echo "selected"; ?> value="0">Desativado</option>
                                                </select>
                                            </div>
                                        </div>


                                        <div class="col-md-12 ps-2">

                                            <div class="input-group input-group-static mb-4">
                                                <label>Descrição do Projeto <span style="color:red">*</span> </label>
                                                <textarea name="message" class="form-control" id="description" rows="4"> <?php echo $this->Dados[0]['nft']['description']; ?></textarea>
                                            </div>


                                        </div>

                                    </div>

                                    <h3>Dados de Endereço</h3>

                                    <Hr style="height: 2px; color: black; width: 100%; background-color: gray">
                                    <h5>Endereço </h5>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="input-group input-group-static mb-4 ">
                                                <label class="form-label">Cep <span style="color:red">*</span> </label>
                                                <input class="form-control" id='cep' value="<?php echo $this->Dados[0]['nft']['zip']; ?>" aria-label="cep" type="text">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 ps-2">
                                            <div class="input-group input-group-static mb-4">
                                                <label class="form-label">Endereço: <span style="color:red">*</span></label>
                                                <input class="form-control" id='endereco' value="<?php echo $this->Dados[0]['nft']['address']; ?>" aria-label="endereco" type="text">
                                            </div>
                                        </div>




                                        <div class="col-md-6">
                                            <div class="input-group input-group-static mb-4">
                                                <label class="form-label">N:</label>
                                                <input class="form-control" id='num' value="<?php echo $this->Dados[0]['nft']['number']; ?>" aria-label="num" type="text">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="input-group input-group-static mb-4">
                                                <label class="form-label">Complemento:</label>
                                                <input class="form-control" id='complemento' aria-label="complemento" value="<?php echo $this->Dados[0]['nft']['complem']; ?>" type="text">
                                            </div>
                                        </div>


                                        <div class="col-md-6">
                                            <div class="input-group input-group-static mb-4">
                                                <label class="form-label">Bairro: <span style="color:red">*</span></label>
                                                <input class="form-control" id='bairro' aria-label="Bairro" value="<?php echo $this->Dados[0]['nft']['district']; ?>" type="text">
                                            </div>
                                        </div>


                                        <div class="col-md-6">
                                            <div class="input-group input-group-static mb-4">
                                                <label class="form-label">Cidade: <span style="color:red">*</span></label>
                                                <input class="form-control" id='cidade' value="<?php echo $this->Dados[0]['nft']['city']; ?>" aria-label="Cidade" type="text">
                                            </div>
                                        </div>



                                        <div class="col-md-6">
                                            <div class="input-group input-group-static mb-4">
                                                <select class="form-control" id='estado' aria-label="estado" type="text">
                                                    <option selected value="">Selecione o estado <span style="color:red">*</span></option>
                                                    <option <?php if ($this->Dados[0]['nft']['state'] === 'AC') echo "selected"; ?> value="AC">Acre</option>
                                                    <option <?php if ($this->Dados[0]['nft']['state'] === 'AL') echo "selected"; ?> value="AL">Alagoas</option>
                                                    <option <?php if ($this->Dados[0]['nft']['state'] === 'AP') echo "selected"; ?> value="AP">Amapá</option>
                                                    <option <?php if ($this->Dados[0]['nft']['state'] === 'AM') echo "selected"; ?> value="AM">Amazonas</option>
                                                    <option <?php if ($this->Dados[0]['nft']['state'] === 'BA') echo "selected"; ?> value="BA">Bahia</option>
                                                    <option <?php if ($this->Dados[0]['nft']['state'] === 'CE') echo "selected"; ?> value="CE">Ceará</option>
                                                    <option <?php if ($this->Dados[0]['nft']['state'] === 'DF') echo "selected"; ?> value="DF">Distrito Federal</option>
                                                    <option <?php if ($this->Dados[0]['nft']['state'] === 'ES') echo "selected"; ?> value="ES">Espírito Santo</option>
                                                    <option <?php if ($this->Dados[0]['nft']['state'] === 'GO') echo "selected"; ?> value="GO">Goiás</option>
                                                    <option <?php if ($this->Dados[0]['nft']['state'] === 'MA') echo "selected"; ?> value="MA">Maranhão</option>
                                                    <option <?php if ($this->Dados[0]['nft']['state'] === 'MT') echo "selected"; ?> value="MT">Mato Grosso</option>
                                                    <option <?php if ($this->Dados[0]['nft']['state'] === 'MS') echo "selected"; ?> value="MS">Mato Grosso do Sul</option>
                                                    <option <?php if ($this->Dados[0]['nft']['state'] === 'MG') echo "selected"; ?> value="MG">Minas Gerais</option>
                                                    <option <?php if ($this->Dados[0]['nft']['state'] === 'PA') echo "selected"; ?> value="PA">Pará</option>
                                                    <option <?php if ($this->Dados[0]['nft']['state'] === 'PB') echo "selected"; ?> value="PB">Paraíba</option>
                                                    <option <?php if ($this->Dados[0]['nft']['state'] === 'PR') echo "selected"; ?> value="PR">Paraná</option>
                                                    <option <?php if ($this->Dados[0]['nft']['state'] === 'PE') echo "selected"; ?> value="PE">Pernambuco</option>
                                                    <option <?php if ($this->Dados[0]['nft']['state'] === 'PI') echo "selected"; ?> value="PI">Piauí</option>
                                                    <option <?php if ($this->Dados[0]['nft']['state'] === 'RJ') echo "selected"; ?> value="RJ">Rio de Janeiro</option>
                                                    <option <?php if ($this->Dados[0]['nft']['state'] === 'RN') echo "selected"; ?> value="RN">Rio Grande do Norte</option>
                                                    <option <?php if ($this->Dados[0]['nft']['state'] === 'RS') echo "selected"; ?> value="RS">Rio Grande do Sul</option>
                                                    <option <?php if ($this->Dados[0]['nft']['state'] === 'RO') echo "selected"; ?> value="RO">Rondônia</option>
                                                    <option <?php if ($this->Dados[0]['nft']['state'] === 'RR') echo "selected"; ?> value="RR">Roraima</option>
                                                    <option <?php if ($this->Dados[0]['nft']['state'] === 'SC') echo "selected"; ?> value="SC">Santa Catarina</option>
                                                    <option <?php if ($this->Dados[0]['nft']['state'] === 'SP') echo "selected"; ?> value="SP">São Paulo</option>
                                                    <option <?php if ($this->Dados[0]['nft']['state'] === 'SE') echo "selected"; ?> value="SE">Sergipe</option>
                                                    <option <?php if ($this->Dados[0]['nft']['state'] === 'TO') echo "selected"; ?> value="TO">Tocantins</option>
                                                </select>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="col-md-3">
                                        <button type="button" class="btn bg-gradient-dark w-100 send">Atualizar</button>
                                    </div>

                                    <div class="accordion" id="accordionExample">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingOne">
                                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                    Fotos Cadastradas
                                                </button>
                                            </h2>
                                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <div class="row">

                                                        <?php foreach ($this->Dados[0]['thumb'] as $key => $thumb) {  ?>

                                                            <div class="col-md-3">
                                                                <div class="card">
                                                                    <div class="card-body">
                                                                        <img class="d-block w-100" src="<?php echo URL . $thumb['path']; ?>" alt="<?php echo $key2 ?> slide">
                                                                    </div>
                                                                    <button type="button" style="margin: 10px;" class="btn btn-danger" onclick="removePhoto(`<?php echo $thumb['uuid'] ?>`)"><i class='fa fa-trash text-xs'></i>
                                                                    </button>

                                                                </div>

                                                            </div>
                                                        <?php } ?>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingTwo">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                    Cadastrar novas fotos
                                                </button>
                                            </h2>
                                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <div class="row">
                                                        <div class="col-md-8">
                                                            <div class="input-group input-group-static mb-4">
                                                                <input type="file" id="files" name="files" multiple><br><br>
                                                                <button type="button" class="btn bg-gradient-dark upload" onclick="uploadThumb()">Cadastrar fotos</button>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

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
    const removePhoto = async (uuid) => {
        if (confirm("Deseja deletar essa foto?")) {
            var formData = new FormData();
            formData.append("thumb", uuid);
            const response = await loti.post('cadastros/delete-thumb', formData);
            if (response.data.error === 0) {
                setTimeout(function() {
                    window.location.reload()
                }, 1000)
            }
        }

    }

    const uploadThumb = async () => {
        const data = new FormData;

        const header = {
            headers: {
                'Content-Type': 'multipart/form-data'
            }
        }

        for (let i = 0; i < files.files.length; i++) {
            data.append('files[]', files.files[i]);
        }
        data.append('uuid', "<?php echo $this->Dados[0]["nft"]["uuid"]; ?>");



        const response = await loti.post('/cadastros/put-thumb', data, header);

        if (response.data.error === 0) {
            showToast(response.data.msg, 'alert-success', 3000)
            window.location.reload('');
        } else {
            showToast(response.data.msg, 'alert-danger', 3000)
        }



    }




    window.onload = (event) => {
        load()
        $("#incorp").focus();
        $("#area").focus();
        $("#vlcota").focus();
        $("#qtdc").focus();
        $("#percent").focus();
        $("#nftAdrress").focus();
        $("#description").focus();
        $("#cep").focus();
        $("#endereco").focus();
        $("#num").focus();
        $("#complemento").focus();
        $("#bairro").focus();
        $("#active").focus();
        $("#cidade").focus();
        $("#estado").focus();
        $("#name").focus();


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
            const name = $("#name").val();
            const incorp = $("#incorp").val();
            const area = $("#area").val();
            const vlcota = $("#vlcota").val();
            const qtdc = $("#qtdc").val();
            const percent = $("#percent").val();
            const nftAdrress = $("#nftAdrress").val();
            const description = $("#description").val();
            const cep = $("#cep").val();
            const active = $("#active").val();
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
            data.append('active', active)
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
            data.append('uuid', "<?php echo $this->Dados[0]["nft"]["uuid"]; ?>");


            // for (let i = 0; i < files.files.length; i++) {
            //     data.append('files[]', files.files[i]);
            // }
            const response = await loti.post('/cadastros/update-imoveis', data);
            if (response.data.error === 0) {
                showToast(response.data.msg, 'alert-success', 3000)

                setTimeout(function() {
                    window.location.assign('/Cadastros/imoveis')
                }, 1000)
            }

        })


    }
</script>