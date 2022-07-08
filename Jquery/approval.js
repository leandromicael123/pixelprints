let aprrov = function (nivel) {
  const approv = this;
  this.definitions = function (html) {
    html[2] === null ? html.splice(2, 1) : html.splice(3, 1);
    html.pop();
    html.pop();

    html.splice(4, 4, html[5], html[6], html[7], html[4]);
  };
  this.indexclickfunction = function (index) {
    let selectedindex = index;
    const link = `codfolha=${selectedindex[0]}`;
    var currentURL =
      window.location.protocol +
      "//" +
      window.location.host +
      window.location.pathname +
      `?metodo=aprovar&${link}`;
    window.history.pushState(
      {
        path: currentURL,
      },
      "",
      currentURL
    );
    $(".label-row").text(selectedindex[0]);
    $(".txtobra").eq(0).val(selectedindex[3]);
    var x = 0;
    $(".txtobra").eq(1).val(selectedindex[7]);
    for (var i = 4; i <= 6; i++) {
      $(".parts_obra:eq(2) input").eq(x).val(selectedindex[i]);
      x++;
    }
    $(".editbtn").off();
    $(".editbtn").removeClass("cross").text("Editar");
    $(".editbtn").click(function () {
      if ($(this).hasClass("cross") == false) {
        $(
          ".parts_obra:not(.parts_obra:eq(4)):not(.parts_obra:eq(0)) .txtobra,.parts_obra:not(.parts_obra:eq(4)):not(.parts_obra:eq(0)) input"
        )
          .prop("readonly", false)
          .css("color", "white");
        $(this).addClass("cross").html("<span></span><span></span>");
      } else {
        $(
          ".parts_obra:not(.parts_obra:eq(4)):not(.parts_obra:eq(0)) .txtobra,.parts_obra:not(.parts_obra:eq(4)):not(.parts_obra:eq(0)) input"
        )
          .prop("readonly", true)
          .css("color", "#ffffffad");
        $(this).removeClass("cross").text("Editar");
        $(".label-row").text(selectedindex[0]);
        $(".txtobra").eq(0).val(selectedindex[3]);
        var x = 0;
        $(".txtobra").eq(1).val(selectedindex[7]);
        for (var i = 4; i <= 6; i++) {
          $(".parts_obra:eq(2) input").eq(x).val(selectedindex[i]);
          x++;
        }
      }
    });

    $(".flex_total").css("display", "block");
    $(".btnaprovar").off();
    approvar(2, selectedindex[0]);
    $(".btnaprovar").click(function () {
      approvar(1, selectedindex[0]);
    });
    $.ajax({
      type: "POST",
      url: "folhadeobra/do_folhadetrabalho.php",
      dataType: "json",
      data: {
        request: "getnivelfolha",
        codid: selectedindex[0],
      },
      success: function (html) {
        $(".nivel").html("");
        $(html).each(function () {
          $(".nivel").append(
            JSON.stringify(
              "<option value='" +
                JSON.stringify(this[1]).replace(/\"/g, "") +
                "'>" +
                JSON.stringify(this[1]).replace(/\"/g, "") +
                "</option>"
            )
          );
        });
      },
    });
    $.ajax({
      type: "POST",
      url: "folhadeobra/do_folhadetrabalho.php",
      dataType: "json",
      data: {
        request: "folhaobraabs",
        codid: selectedindex[2],
        field: selectedindex[1],
      },
      success: function (html) {
        const link = `result=true&usercode=${html[0]}&type=${html[1]}`;

        $(".userdata_bg input").each(function (index) {
          $(this).val(html[index]);
        });
        $(".userdata_bg input:eq(0)").click(function () {
          var currentURL =
            window.location.protocol +
            "//" +
            window.location.host +
            window.location.pathname +
            `?metodo=aprovar&${link}`;
          window.history.pushState(
            {
              path: currentURL,
            },
            "",
            currentURL
          );
          getparameter(GetURLParameter("metodo"));
        });
      },
    });
    $(".submitobra").off();
    $(".submitobra").click(function () {
      mudarestado($(".nivel option:selected").text(), selectedindex[0]);
    });
  };
  this.folhas = function () {
    $.ajax({
      type: "POST",
      url: "folhadeobra/do_folhadetrabalho.php",
      dataType: "json",
      data: {
        request: "getfolhanivel",
        text: $(".input_appeareance:eq(1)").val(),
        select:
          $(".searchbox.user").length === 1
            ? [
                "user",
                $(
                  ".searchbox.user>.category.input_appeareance option:checked"
                ).index(),
              ]
            : [
                "folha",
                $(".category.input_appeareance option:checked").index(),
              ],
        intr: $("input[name='same']:checked").val(),
      },
      success: function (html) {
        $("tbody").html("");
        $(html).each(function (index) {
          $("tbody").append("<tr></tr>");
          approv.definitions(this);
          this.map(function (obj, index) {
            $("tbody>tr:last-child").append(
              "<td class='border-right-bottom-top'>" + obj + "</td>"
            );
          });
          var current = this;
          $("tbody>tr:last-child").click(function () {
            approv.indexclickfunction(current);
          });
        });
      },
    });
  };
  function mudarestado(value, selectedindex) {
    array = [];
    $(
      ".parts_obra:not(.parts_obra:eq(4)):not(.parts_obra:eq(0)) .txtobra,.parts_obra:not(.parts_obra:eq(4)):not(.parts_obra:eq(0)) input"
    ).each(function () {
      array.push($(this).val());
    });

    $.ajax({
      type: "POST",
      url: "folhadeobra/do_folhadetrabalho.php",
      //  dataType: "json",
      data: {
        request: "updatestatus",
        codid: selectedindex,
        nivel: value,
        edit_quest: $(".editbtn").hasClass("cross") == true ? 1 : 2,
        edit: array,
        comentario: $(".txtobra:eq(2)").val(),
      },
      success: function (html) {
        if (html == 1) {
          $("input[type='text'], textarea").val("");
          $(".label-row").text("");
          method.folhas();
          selectedindex = [];
          $(this).off();
          $(".btnaprovar").off();
          $(".flex_total").css("display", "none");
          alert("Enviado");
        } else {
          event.stopImmediatePropagation();
          alert("erro a enviar");
          event.preventDefault();
        }
      },
    });
  }
  function approvar(type, codfolha) {
    if (type == 0) {
      $.ajax({
        type: "POST",
        url: "folhadeobra/do_folhadetrabalho.php",
        //     dataType: "json",
        data: {
          codid: codfolha,
          request: "approvfolha",
          req: 0,
        },
        success: function (html) {
          if (html == -1) {
            $(".btnaprovar").text("Não aprovado");
            $(".btnaprovar").css("background", "red");
          }
          if (html == 1 || html == 2) {
            $(".btnaprovar").text("Aprovado");
            $(".btnaprovar").css("background", "green");
          }
          if (html == 2) {
            mudarestado("faturacao", codfolha);
          }
        },
        error: function (xhr, ajaxOptions, thrownError) {
          alert(xhr.status);
          alert(thrownError);
        },
      });
    } else {
      if (type == 1) {
        const logo = $.ajax({
          type: "POST",
          url: "folhadeobra/do_folhadetrabalho.php",
          data: {
            codid: codfolha,
            request: "approvfolha",
            req: 1,
          },
          success: function (html) {
            if (html == 0) {
              if (
                confirm("Tem a certeza que quer aprovar a folha de obra?") ==
                true
              ) {
                approvar(0, codfolha);
              }
            } else {
              if (html == 1) {
                if (
                  confirm(
                    "Tem a certeza que quer reprovar(remover a aprovação) da folha de obra?"
                  ) == true
                ) {
                  approvar(0, codfolha);
                }
              }
            }
          },
        });
      } else if (type == 2) {
        $.ajax({
          type: "POST",
          url: "folhadeobra/do_folhadetrabalho.php",
          //     dataType: "json",
          data: {
            codid: codfolha,
            request: "approvfolha",
            req: 1,
          },
          success: function (html) {
            if (html == 1) {
              $(".btnaprovar").text("Aprovado");
              $(".btnaprovar").css("background", "green");
            } else {
              $(".btnaprovar").text("Não aprovado");
              $(".btnaprovar").css("background", "red");
            }
          },
          error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status);
            alert(thrownError);
          },
        });
      }
    }
  }
  this.getid = function () {
    if (
      GetURLParameter("codfolha") != "" &&
      typeof GetURLParameter("codfolha") !== "undefined"
    ) {
      $.ajax({
        type: "POST",
        url: "folhadeobra/do_folhadetrabalho.php",
        dataType: "json",
        data: {
          request: "getfolhanivel",
          text: GetURLParameter("codfolha"),
          gotic: 1,
        },
        success: function (html) {
          const index = html;
          approv.definitions(index[0]);
          approv.indexclickfunction(index[0]);
        },
      });
    }
  };
  this.options = function () {
    const option = [
      "codfolha",
      "Informação do utilizador",
      "descricão",
      "localização de ficheiros",
      "Budget montagem",
      "Custo montagem",
      "Pessoa_Montagem",
    ];
    option.map(function (obj, index) {
      $(".category.input_appeareance").append(
        "<option value='" + obj + "'>" + obj + "</option>"
      );
      if (obj === "Informação do utilizador") {
        $(".category.input_appeareance").append(
          "<option style='display:none'></option>"
        );
      }
    });
  };
  this.user = function (value) {
    var end = "";
    const options = [
      "Cod_id",
      "Nome",
      "Email",
      "NIF",
      "Contacto",
      "Pessoa-contacto",
    ];
    value1 = options.map(function (obj) {
      end += "<option value='" + obj + "'>" + obj + "</option>";
    });
    value === "Informação do utilizador" && $(".searchbox.user").length === 0
      ? $(".searchbox")
          .after(
            "<div class='searchbox user'><select onchange='method.folhas()'class='category input_appeareance'></select><div><div style='text-align:center'>Introduzido por:</div><div style=' display: flex;align-items: center;justify-content: center;gap: 1rem;'>Ambos<input type='radio' name='same' onchange='method.folhas();'checked='checked' value='0'>administrador<input type='radio' onchange='method.folhas()' name='same' value='1'>Utilizador<input type='radio' name='same' onchange='method.folhas()' value='2'></div></div>"
          )
          .siblings(".searchbox.user")
          .children(".category.input_appeareance")
          .append(end)
      : $(".searchbox.user").remove();
    $("input:radio[name=same]:checked").change(function () {
      method.folhas();
    });
    $(".searchbox.user").change(function () {
      method.folhas();
    });
  };
};

let method = new aprrov();
method.getid();
method.options();
method.folhas();
$("select.category.input_appeareance:eq(0)").change(function () {
  method.user(this.value);
  method.folhas();
});
$(".input_pld").on("input", function () {
  method.folhas();
});

const intervalds = setInterval(() => {
  method.folhas();
}, 5000);
