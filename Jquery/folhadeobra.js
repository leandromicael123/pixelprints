let requesttype = "nivel";
$.ajax({
  type: "POST",

  url: "folhadeobra/do_folhadetrabalho.php",
  dataType: "json",
  data: {
    request: requesttype,
  },
  success: function (html) {
    console.log(html);
    $(html).each(function () {
      $(".aprovalref").append(
        ' <div class="flex-approv"><div class="text-appro">' +
          JSON.stringify(this).replace(/\"/g, "") +
          '</div><div class="cross obra"><span></span><span></span> </div></div>'
      );
    });
    $(".flex-approv").click(function () {
      const text_ = $(this).children(".text-appro").text();
      if ($(this).hasClass("selected")) {
        $(".nivel option")
          .filter(function () {
            return $(this).text() === text_;
          })
          .remove();

        $(this).removeClass("selected");
      } else {
        $(this).addClass("selected");
        $("select.nivel").append(
          "<option value='" +
            $(this).children(".text-appro").text() +
            "'>" +
            $(this).children(".text-appro").text() +
            "</option>"
        );
      }
    });
  },
});
$(".aprovalref.cross").off();

$(".radio_data").click(function () {
  selecteduser = [];
  $(".userdata").remove();
  if ($(this).val() == 0) {
    $(".radio_flex").after(
      '<div class="userdata" id="1" ><div class="flex_userdata_group"><div class="userdata_group"><label for="">Nome</label><input type="text" name="nome"></div><div class="userdata_group"><label for="">NIF</label> <input type="text" name="nif"></div></div><div class="flex_userdata_group"><div class="userdata_group"><label for="">Email</label><input type="text" name="Email"></div><div class="userdata_group"><label for="">Contacto</label><input type="text" name="Contacto"></div></div><div class="flex_userdata_group"><div class="userdata_group"><label for="">Pessoa contacto</label><input type="text" name="pescont"></div> <div style="    width: 16rem;height: 1.5rem;" ></div></div>'
    );
    $(".userdata input:eq(4)").mask("000 000 000");
    $(".userdata input:eq(3)").mask("000 000 000");
    $(".userdata input:eq(1)").mask("000000000");
  } else {
    $(".radio_flex").after(
      '<div class="userdata" id="2"> <div class="searchbox "> <select class="category input_appeareance"></select> <input type="text" class="input_appeareance" name="search" placeholder="Pesquisa aqui"></div> <div class="table-data"> <table style="border-collapse:collapse"> <thead><tr>  <th>Tipo de data</th> <th>Código de utilizador</th><th>Nome</th> <th>Email</th> <th>NIF</th> <th>Telefone</th> <th>Pessoa-contacto</th><th>Morada</th> <th>Codigo postal</th> <th>Tipocliente</th> <th>Nome da empresa</th> <th>Nivel</th> <th>Data de entrada</th> </tr></thead><tbody> </tbody></table></div> <div class="userdata_bg"><div class="flex_userdata_group"><div class="userdata_group"><label for="">Tipo de data</label> <input type="text" name="Codigo" readonly></div><div class="userdata_group"><label for="">Codigo de utilizador</label> <input type="text" name="nome" readonly></div></div> <div class="flex_userdata_group"> <div class="userdata_group"> <label for="">Nome</label> <input type="text" name="nome" readonly></div> <div class="userdata_group"> <label for="">Email</label> <input type="text" name="nif" readonly></div> </div> <div class="flex_userdata_group"> <div class="userdata_group"> <label for="">NIF</label> <input type="text" name="Email" readonly></div> <div class="userdata_group"> <label for="">Contactos</label> <input type="text" name="Contacto" readonly></div> </div> </div>'
    );
    $(".userdata input:eq(6)").mask("000 000 000");
    requesttype = "column";
    $.ajax({
      type: "POST",
      url: "folhadeobra/do_folhadetrabalho.php",
      dataType: "json",
      data: {
        request: requesttype,
      },
      success: function (html) {
        html.splice(3, 1);
        $(html).each(function () {
          $("select.category").append(
            "<option value='" +
              JSON.stringify(this).replace(/\"/g, "") +
              "'>" +
              JSON.stringify(this).replace(/\"/g, "") +
              "</option>"
          );
        });
        table();
        $("select.category").change(function () {
          table();
        });
        $(".input_appeareance")
          .eq(1)
          .keyup(function () {
            table();
          });
        $(".input_appeareance")
          .eq(1)
          .keypress(function () {
            table();
          });
      },
    });
  }
  $(".userdata").fadeIn();
  $(".userdata").css("display", "flex");
});
var selecteduser = [];

function table() {
  var text = $(".input_appeareance").eq(1).val();
  var select = $("select.category option:selected").val();
  requesttype = "search";
  $.ajax({
    type: "POST",
    url: "folhadeobra/do_folhadetrabalho.php",
    dataType: "json",
    data: {
      request: requesttype,
      text: text,
      select: select,
    },
    success: function (html) {
      $("tbody").html("<tr ></tr>");
      $(html).each(function (index) {
        $(html[index]).each(function (index) {
          $("tbody>tr:last-child").append(
            "<td class='border-right-bottom-top'>" +
              JSON.stringify(this).replace(/\"/g, "") +
              "</td></tr>"
          );
        });
        $("tbody").append("<tr></tr>");
      });
      $("tbody tr").click(function () {
        for (i = 0; i <= 5; i++) {
          selecteduser[i] = $(this).children().eq(i).text();
          $(".userdata_bg input").eq(i).val(selecteduser[i]);
        }
      });
    },
  });
  $("tbody>tr:last-child").remove();
}

function requesttype_(request) {
  $.ajax({
    type: "POST",
    url: "folhadeobra/do_folhadetrabalho.php",
    dataType: "json",
    data: {
      request: request,
    },
    success: function (html) {
      return html;
    },
  });
}

function verification() {
  function borderred(element, elementevent, color) {
    const actcolor = color === undefined ? "red" : color;
    $(element).css("border", "3px solid " + actcolor + "");
    input(elementevent, element);
  }
  function input(elementevent, element) {
    $(elementevent).keyup(function () {
      $(element).css("border", " 0");
    });
    $(elementevent).click(function () {
      $(element).css("border", " 0");
    });
    $(elementevent).keypress(function () {
      $(element).css("border", " 0");
    });
  }

  if ($(".radio_data").is(":checked") == false) {
    scrolltoelement(".Titulo_obra");
    alert("Tem de inserir os dados do cliente");
    borderred($(".radio_flex"), $(".radio_flex"));
    return 0;
  }

  if ($("#1.userdata ").length) {
    if ($("#1.userdata input:eq(1)").val() != "")
      if (validateNIF($("#1.userdata input:eq(1)").val()) == false) {
        scrolltoelement(".Titulo_obra");
        alert("NIF incorreto");
        borderred($("#1.userdata input:eq(1)"), $("#1.userdata input:eq(1)"));
        return 0;
      }

    if ($.trim($("#1.userdata input:eq(0)").val()) == "") {
      scrolltoelement(".Titulo_obra");
      alert("Tem de preencher o nome");
      borderred($("#1.userdata input:eq(0)"), $("#1.userdata input:eq(0)"));
      return 0;
    }
  }
  if ($("#2.userdata ").length) {
    if (selecteduser.length == 0) {
      alert("Tem de inserir os dados do cliente");
      borderred($(".userdata_bg"), $("table tr"));
      scrolltoelement(".userdata");
      return 0;
    }
  }

  if ($.trim($(".txtobra:eq(0)").val()) == "") {
    alert("Tem de inserir a descrição");
    borderred($(".txtobra:eq(0)"), $(".txtobra:eq(0)"));
    scrolltoelement(".parts_obra:eq(1)");
    return 0;
  }
  if (!$(".flex-approv").hasClass("selected")) {
    alert("Tem de selecionar os cargos que têm de aprovar a folha de obra");
    borderred($(".aprovalref"), $(".flex-approv"), "white");
    scrolltoelement(".flex-approv");
    return 0;
  }
  if ($(".nivel").attr("selectedIndex") == 0) {
    alert("Selecione para quem é enviada a folha de obra");
    borderred($(".nivel"), $(".nivel"), "green");
    return 0;
  }
  return 1;

  function validateNIF(value) {
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
}
function scrolltoelement($element) {
  $([document.documentElement, document.body]).animate(
    {
      scrollTop: $($element).offset().top,
    },
    100
  );
}

$(".submitobra").click(function () {
  if (verification() == 1) {
    var tipodeuser;
    var userdata = [];
    var descr = $(" .txtobra:eq(0)").val();
    var mont = [];
    var approv = [];
    var selectedstatus = $(".nivel option:selected").text();
    $(".flex-approv.selected").each(function () {
      approv.push($(this).children(".text-appro").text());
    });
    $(".flex-mont input").each(function () {
      mont.push($(this).val());
    });
    var loc = $(" .txtobra:eq(1)").val();
    if ($("#1.userdata").length) {
      tipodeuser = 0;
      $(".userdata input").each(function () {
        userdata.push($(this).val());
      });
    } else {
      tipodeuser = 1;
      userdata = selecteduser;
    }
    requesttype = "create";
    $.ajax({
      type: "POST",
      url: "folhadeobra/do_folhadetrabalho.php",
      data: {
        request: requesttype,
        tipodeuser: tipodeuser,
        userdata: userdata,
        description: descr,
        mont: mont,
        loc: loc,
        approv: approv,
        status: selectedstatus,
      },
      success: function (html) {
        console.log(html);
        $(".folha_de_obra").append(html);
      },
    });
  }
});
