<body>
    <div class="folha_de_obra">
        <div class="Titulo_obra">Aprovar folha de obra</div>
        <div class="parts_obra">
            <div class="subtitulo_obra" style="margin-bottom: none;">Folhas de obras</div>
            <div class="userdata" style="display: flex;">
                <div class="searchbox ">
                    <select class="category input_appeareance">

                    </select>
                    <input type="text" class="input_appeareance input_pld" name="search" placeholder="Pesquisa aqui">
                </div>
                <div class="table-data">
                    <table style="border-collapse:collapse;">
                        <thead>
                            <tr>
                                <th>Codigo de folha</th>
                                <th>Tipo de utilizador associado</th>
                                <th>Código de utilizador</th>
                                <th>Descrição</th>
                                <th>Budget montagem</th>
                                <th>Custo montagem</th>
                                <th>Pessoa_Montagem</th>
                                <th>localização de ficheiros</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
            <div class="userdata_bg" style="gap: 1rem;">
                <div class="subtitulo_obra">N.º folhas de obra</div>
                <div class="label-row"></div>
                <div class="subtitulo_obra">Dados dos clientes</div>
                <div class="flex_userdata_group">
                    <div class="userdata_group"><label for="">Codigo de utilizador</label> <input type="text"
                            name="nome" style="    text-align: center;
    background: red;
    cursor: pointer;" readonly=""></div>
                </div>
                <div class="flex_userdata_group">
                    <div class="userdata_group"><label for="">Tipo de data</label> <input type="text" name="Codigo"
                            readonly=""></div>
                    <div class="userdata_group"> <label for="">Nome</label> <input type="text" name="nome" readonly="">
                    </div>

                </div>
                <div class="flex_userdata_group">
                    <div class="userdata_group"> <label for="">Email</label> <input type="text" name="Email"
                            readonly="">
                    </div>
                    <div class="userdata_group"> <label for="">NIF</label> <input type="text" name="Contacto"
                            readonly=""></div>
                </div>
                <div class="flex_userdata_group">
                    <div class="userdata_group"> <label for="">Contactos</label> <input type="text" name="Email"
                            readonly="">
                    </div>
                    <div class="userdata_group"> <label for="">Pessoa-contacto</label> <input type="text"
                            name="Contacto" readonly=""></div>
                </div>
            </div>
        </div>
        <div class="parts_obra">

            <div class="subtitulo_obra">Descrição</div>
            <textarea name="" cols="30" class='txtobra' placeholder="Escrever aqui" rows="10"></textarea>
        </div>
        <div class="parts_obra">
            <div class="subtitulo_obra">Montagem</div>
            <div class="flex-mont">
                <div class='text-center subtitulo_obra' style="font-size: 1rem;
    display: flex;
    justify-content: center;
    align-items: center;
    align-content: center;">Budget Montagem</div>
                <div class='text-center subtitulo_obra' style="font-size: 1rem;
    display: flex;
    justify-content: center;
    align-items: center;
    align-content: center;">Custo Montagem</div>
                <div class='text-center subtitulo_obra' style="font-size: 1rem;
    display: flex;
    justify-content: center;
    align-items: center;
    align-content: center;">Pessoa Montagem</div>
                <input type="text" placeholder="Budget Montagem"
                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
                    pattern="[0-9]+"></input>
                <input type="text" placeholder="Custo Montagem"
                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
                    pattern="[0-9]+">
                <input type="text" placeholder="Pessoa Montagem">
            </div>
        </div>
        <div class="parts_obra">
            <div class="subtitulo_obra">Localização de ficheiros</div>
            <textarea name="" cols="10" class='txtobra' placeholder="Escrever aqui" rows="10"></textarea>
        </div>

        <div class="flex_total" style="display:none">
            <div class="flex" style='align-items: center;
    justify-content: center;'>

                <div class="editbtn">
                    Editar
                    <span></span>
                    <span></span>
                </div>
            </div>
            <div class="flex"><label for="">Enviar para</label>
                <select name="" id="" class="nivel"></select>
            </div>
            <div class="flex" style='align-items: center;'> <button class="btnaprovar">Não aprovado</button>
                <textarea name="" cols="10" class="txtobra" placeholder="Escrever aqui" rows="10"></textarea>
                <div class="subtitulo_obra">Comentário</div>
                <input type="submit" class="submitobra">
            </div>
        </div>
    </div>
</body>

</html>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.0/jquery.mask.js"></script>
<script>
$(".parts_obra:not(.parts_obra:eq(0)) input,textarea").prop("readonly", true).css("color", "#ffffffad");
$(".userdata_bg input").css("text-align", "center")
</script>
<script src="../Jquery/approval.js"></script>

</html>