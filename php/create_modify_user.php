<body>
    <div class="folha_de_obra">
        <div class="Titulo_obra">Inserir e modificar dados dos clientes</div>
        <div class="parts_obra">
            <div class="subtitulo_obra" style="margin-bottom: none;">Inserir</div>
            <div class="userdata" id="1" style="display: flex;position:relative">
                <div class="errorscreen">⚠ Erro:</div>
                <div class="flex_userdata_group">
                    <div class="userdata_group"><label for="">Nome</label><input type="text" name="nome">
                    </div>
                    <div class="userdata_group"><label for="">NIF</label> <input type="text" name="nif"></div>
                </div>
                <div class="flex_userdata_group">
                    <div class="userdata_group"><label for="">Email</label><input type="text" name="Email"></div>
                    <div class="userdata_group"><label for="">Contacto</label><input type="text" name="Contacto"></div>
                </div>
                <div class="flex_userdata_group">
                    <div class="userdata_group"><label for="">Pessoa contacto</label><input type="text" name="pescont">
                    </div>
                    <div style="    width: 16rem;height: 1.5rem;"></div>
                </div> <button class='btn-criar'>Criar</button>
            </div>
            <div class="subtitulo_obra" style="margin-bottom: none;">Modificar</div>
            <div class="userdata" style="display: flex;position:relative">
                <div class="searchbox ">
                    <select class="category input_appeareance">
                        <option value="Cod_id">Cod_id</option>
                        <option value="Nome">Nome</option>
                        <option value="Email">Email</option>
                        <option value="NIF">NIF</option>
                        <option value="Contacto">Contacto</option>
                        <option value="Pessoa-contacto">Pessoa-contacto</option>
                    </select>
                    <input type="text" class="input_appeareance input_pld" name="search" placeholder="Pesquisa aqui">
                </div>

                <div class="table-data">
                    <table style="border-collapse:collapse;">
                        <thead>
                            <tr>
                                <th>Código de utilizador</th>
                                <th>Nome</th>
                                <th>Email</th>
                                <th>NIF</th>
                                <th>Contacto</th>
                                <th>Pessoa-contacto</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="userdata_bg" style="gap: 1rem;">

                <div class="flex_userdata_group">
                    <div class="userdata_group"><label for="">Codigo de utilizador</label> <input type="text"
                            name="nome" readonly=""></div>
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
                <div class='flex' style="gap:1rem">
                    <div class="editbtn salvar" style='display:none'>Salvar </div>
                    <div class="editbtn edit">Editar <span></span><span></span></div>
                    <div class="editbtn remover" style="background:red;">Remover</div>
                </div>
            </div>
</body>

</html>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.0/jquery.mask.js"></script>
<script>
$(".parts_obra:not(.parts_obra:eq(0)) input,textarea").prop("readonly", true);
$(".userdata_bg input").css("text-align", "center")
</script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.0/jquery.mask.js"></script>
</script>

</html>
<script>
let users = function() {
    const users_log = this;
    this.erros = function() {
        let errors = [];
        $(".userdata input:eq(0)").val() == "" ? errors.push("O nome tem de ser preenchido") : "";
        if ($(".userdata input:eq(1)").val() != "") {
            if (dados.validarnif($(".userdata input:eq(1)").val()) == false) {
                errors.push("NIF incorreto");
            }
        }
        if (errors.length == 0) {
            var array = [];

            $(".userdata#1 input").each(function() {
                array.push($(this).val());
            });
            dados.criardados(array);
            return;
        }
        const defaults = "⚠ Erro:";
        $(".errorscreen").text(defaults);
        var erros = "";
        errors.map(function(obj, index) {
            erros += ` ${obj},`;
        });
        erros = erros.slice(0, -1) + '.';
        $(".errorscreen").css("background", "#f1ac1d");
        $(".errorscreen").append(erros);
        $(".errorscreen").
        fadeIn().css("display", "flex");
        $(".userdata#1 input").off();
        $(".userdata#1 input").on("input", function() {
            $(".errorscreen").fadeOut();
        });
    }

    this.criardados = function(array) {
        $.ajax({
            type: "POST",
            url: "folhadeobra/do_folhadetrabalho.php",
            //     dataType: "json",
            data: {
                request: "criar dados",
                dados: array,
            },
            success: function(html) {

                if (html == 1) {
                    $(".userdata#1 input").val("");
                    $(".errorscreen").css("background", "green");
                    $(".errorscreen").
                    fadeIn().css("display", "flex");
                    $(".errorscreen").text("Sucesso: dados inseridos");
                    $(".userdata#1 input").off();
                    $(".userdata#1 input").on("input", function() {
                        $(".errorscreen").fadeOut();
                    });
                }

            }
        })

    }
    this.selectedindex = [];
    this.validarnif = function(value) {
        const nif = typeof value === "string" ? value : value.toString();
        const validationSets = {
            one: ["1", "2", "3", "5", "6", "8"],
            two: [
                "45",
                "70",
                "71",
                "72",
                "74",
                "75",
                "77",
                "79",
                "90",
                "91",
                "98",
                "99",
            ],
        };
        if (nif.length !== 9) return false;
        if (
            !validationSets.one.includes(nif.substr(0, 1)) &&
            !validationSets.two.includes(nif.substr(0, 2))
        )
            return false;
        const total =
            nif[0] * 9 +
            nif[1] * 8 +
            nif[2] * 7 +
            nif[3] * 6 +
            nif[4] * 5 +
            nif[5] * 4 +
            nif[6] * 3 +
            nif[7] * 2;
        const modulo11 = Number(total) % 11;
        const checkDigit = modulo11 < 2 ? 0 : 11 - modulo11;
        return checkDigit === Number(nif[8]);
    }
    this.indexclickfunction = function(index) {
        users_log.selectedindex = index;
        const link = `codid=${users_log.selectedindex[0]}`;
        var currentURL =
            window.location.protocol +
            "//" +
            window.location.host +
            window.location.pathname +
            `?metodo=user&${link}`;
        window.history.pushState({
                path: currentURL,
            },
            "",
            currentURL
        );
        users_log.selectedindex.map(function(obj, index) {
            $(".userdata_bg input").eq(index).val(obj)
        });
        $(".flex").css("display", "flex");
        $(".editbtn.remover").off();
        $(".editbtn.remover").click(function() {
            $.ajax({
                type: "POST",
                url: "folhadeobra/do_folhadetrabalho.php",
                //     dataType: "json",
                data: {
                    request: "updatenonlog",
                    selectedindex: users_log.selectedindex,
                    tipo_conta: 0,
                    tarefa: "delete"
                },
                success: function(html) {
                    if (html == 1) {
                        users_log.removdefin();
                    }
                }
            });
        });
        $(".editbtn.edit").off();
        $(".editbtn.edit").click(function() {

            if ($(".editbtn.edit").hasClass("cross") == true) {
                users_log.selectedindex.map(function(obj, index) {
                    $(".userdata_bg input").eq(index).val(obj)
                });
                $(".userdata_bg input:not(input:eq(0))").prop("readonly", true);
                $(".editbtn.edit")
                    .removeClass(
                        "cross").html("Editar");
                $(".editbtn.salvar")
                    .css("display", "none");
            } else {
                $(".editbtn.edit").html("<span></span><span></span>")
                    .addClass("cross");
                $(".editbtn.salvar")
                    .css("display", "flex");

                $(".userdata_bg input:not(input:eq(0))").prop("readonly", false);
                $(".editbtn.salvar").off();
                $(".editbtn.salvar").click(function() {
                    $.ajax({
                        type: "POST",
                        url: "folhadeobra/do_folhadetrabalho.php",
                        //     dataType: "json",
                        data: {
                            request: "updatenonlog",
                            selectedindex: users_log.selectedindex,
                            tipo_conta: 0,
                            tarefa: "update"
                        },
                        success: function(html) {
                            console.log(html);
                            if (html == 1) {
                                users_log.removdefin();
                            }
                        }
                    });
                });
            }
        });
    }
    this.removdefin = function() {
        users_log.selectedindex = [];
        $(".userdata_bg input").val("");
        users_log.search();
        console.log(users_log.selectedindex);
        $(".editbtn.salvar").off();
        $(".editbtn.edit").html("<span></span><span></span>")
            .addClass("cross");
        $(".editbtn.edit").off();
        $(".editbtn.remover")
        $(".flex").css("display", "none");
    }
    this.search = function() {
        $.ajax({
            type: "POST",
            url: "folhadeobra/do_folhadetrabalho.php",
            dataType: "json",
            data: {
                request: "getuserespifico",
                text: $(".input_appeareance:eq(1)").val(),
                select: $(".category.input_appeareance").val(),
                tb: 1,
            },
            success: function(html) {

                $("tbody").html("");
                $(html).each(function(index) {
                    $("tbody").append("<tr></tr>");

                    this.map(function(obj, index) {
                        $("tbody>tr:last-child").append(
                            "<td class='border-right-bottom-top'>" + obj +
                            "</td>"
                        );
                    });
                    var current = this;
                    $("tbody>tr:last-child").click(function() {
                        dados.indexclickfunction(current);
                    });
                });
            },
        });
    };
}

const dados = new users();
dados.search();

$(window).on("load", function() {
    dados.search();
    clickerros()
    $(".userdata input:eq(3)").mask("000 000 000");
    $(".userdata input:eq(4)").mask("000 000 000");
    $(".userdata input:eq(1)").mask("000000000");
});
$(".userdata input:eq(3)").mask("000 000 000");
$(".userdata input:eq(4)").mask("000 000 000");
$(".userdata input:eq(1)").mask("000000000");
$(".category.input_appeareance").on("change", function() {
    dados.search();
})
$(".input_appeareance.input_pld").on("input", function() {
    dados.search();
})
setInterval(() => {
    dados.search()

}, 15000);
$(".btn-criar").off();
clickerros()

function clickerros() {
    $(".btn-criar").off();
    $(".btn-criar").click(function() {
        dados.erros();
    });
    $('.userdata:eq(0) input').off();
    $('.userdata:eq(0) input').on("keypress", function() {
        if (e.which == 13) {
            dados.erros();
        }
    });
}
</script>