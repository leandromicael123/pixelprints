$(".link:eq(7)").click(function () {
  if ($(".totalbtn").css("opacity") == 1)
    $(".totalbtn").animate({ opacity: 0 }, 300);
  else if ($(".totalbtn").css("opacity") == 0) {
    $(".totalbtn").animate({ opacity: 1 }, 300);
  }
});
$(document).on("keydown", "form", function (event) {
  return event.key != "Enter";
});
$(window).load(function () {
  $(".loader").fadeOut("slow");
});
$(function () {
  invokeslideinfinite1();
  invokeslideinfinite2();
  timeout();
  timeoutjulia();
  document
    .getElementsByClassName("input_resale date")[0]
    .setAttribute("type", "text");
  document
    .getElementsByClassName("input_resale date")
    ["data"].addEventListener("click", function () {
      document
        .getElementsByClassName("input_resale date")[0]
        .setAttribute("type", "date");
    });
});
const tempodeintervaloslider1 = 7000;
var currentslide1;
var $totalslides1;
var sliderinfinite1;
function invokeslideinfinite1() {
  sliderinfinite1 = setInterval(() => {
    $totalslides1 = $(".bubble").length;
    currentslide1 = $(".currentbubble").index();
    var nextslide = currentslide1 + 1;
    if (nextslide >= $totalslides1) {
      nextslide = 0;
    }
    $(".bubble").eq(nextslide).click();
  }, tempodeintervaloslider1);
}

var tempodeintervaloslider2 = 15000;
var sliderinfinite2;
function invokeslideinfinite2() {
  sliderinfinite2 = setInterval(() => {
    $(".plusbtn").click();
  }, tempodeintervaloslider2);
}

function jump(h) {
  var url = location.href;
  location.href = "#" + h;
  history.replaceState(null, null, url);
}
$("input.em").on("keypress", function (e) {
  if (e.which == 13) {
    $(".entrarbtn").click();
  }
});
$(".entrarbtn").click(function () {
  var email = $("input.em:eq(0)").val();
  var password = $("input.em:eq(1)").val();
  var checkbox = $("#check").is(":checked");
  $.ajax({
    type: "POST",

    url: "nav_login.php",

    data: {
      email: email,
      password: password,
      sessao: checkbox,
    },

    success: function (html) {
      console.log(html);
      if (html == 0) {
        if (!$(".error_pas").length) {
          $("input.em:eq(1)").after(
            "<div class='error_pas'>Email ou palavra-passe incorreta</div>"
          );
          $(".error_pas").fadeIn();
        }
        $(".error_pas").fadeIn();
      }
      if (html == 1) {
        window.location.assign("Index.php");
      }
      $(".incr_pass").fadeIn();
      $("input.em").keyup(function () {
        $(".error_pas").fadeOut();
      });
      $("input.em").keypress(function () {
        $(".error_pas").fadeOut();
      });
    },
  });
});
$(".bluebtn.white_none").click(function () {
  location.href = "../php/#orcamento";
});
$(".bars").click(function () {
  $(".navbar_black").css("right", "-20rem");
  $(".navbar_black").css("display", "flex");
  $(".navbar_black").animate({ right: "0" }, 200);
  $(".cross").click(function () {
    $(".navbar_black").animate({ right: "-15rem" }, 200);
    setTimeout(function () {
      $(".navbar_black").css("display", "none");
    }, 200);
    $(".bars").show();
  });

  $(".bars").hide();
});
$(".links:eq(0)").click(function () {
  location.href = "../php/#inicio";
});
$(".links:eq(1)").click(function () {
  location.href = "../php/#Quemsomos";
});
$(".links:eq(2)").click(function () {
  location.href = "../php/#servicos";
});
$(".links:eq(4)").click(function () {
  location.href = "../php/#revenda";
});
$(".links:eq(5)").click(function () {
  location.href = "../php/#portefolio";
});
$(".links:eq(6)").click(function () {
  location.href = "../php/#contactos";
});
$(".link:eq(0)").click(function () {
  location.href = "../php/#inicio";
});
$(".link:eq(1)").click(function () {
  location.href = "../php/#Quemsomos";
});
$(".link:eq(2)").click(function () {
  location.href = "../php/#servicos";
});
$(".link:eq(4)").click(function () {
  location.href = "../php/#revenda";
});
$(".link:eq(5)").click(function () {
  location.href = "../php/#portefolio";
});
$(".link:eq(6)").click(function () {
  location.href = "../php/#contactos";
});

var tempo_slide = 500; //0.7 segundos
var tmp_slider_auto = 20000;
function timeout_wait() {
  timeout1 = false;
  timeoutactive = false;
}
function timeout() {
  if (timeout1 == true) {
    if (timeoutactive == true) {
      return;
    }

    $(".plusbtn").off();
    $(".btn").off();
    $(".minusbtn").off();
    setTimeout(timeout_wait, tempo_slide);
    return;
  }
  adicionar();
  subtrair();
  btn_click();
}
function timeout_wait() {
  timeout1 = false;
  timeoutactive = false;
  adicionar();
  subtrair();
  btn_click();
}
var timeout2 = false;
var timeoutactive2 = false;
function timeoutjulia() {
  if (timeout2 == true) {
    if (timeoutactive2 == true) {
      return;
    }

    $(".threecarouselleft").off();
    $(".threecarouselright").off();
    setTimeout(timeout_wait1, 1000);
    return;
  }
  adicionar_portfolio();
  subtrair_portfolio();
}
function timeout_wait1() {
  timeout1 = false;
  timeoutactive = false;
  adicionar_portfolio();
  subtrair_portfolio();
}

var timeout1 = false;
timeoutactive = false;
var margin = [0, 100];
$(".bubble").click(function () {
  clearInterval(sliderinfinite1);
  invokeslideinfinite1();
  $(".bubble").removeClass("currentbubble");

  $(this).addClass("currentbubble");
  $(".infinitecarousel-white").animate(
    { marginLeft: "-" + margin[$(".currentbubble").index()] + "%" },
    500
  );
});

function adicionar() {
  $(".plusbtn").click(function () {
    clearInterval(sliderinfinite2);
    invokeslideinfinite2();
    if (parseInt($("#imgcarousel0").css("margin-left")) <= -3840) {
      btn_logic(btn[0]);
      $("#imgcarousel0").css("margin-left", 640);
      $("#imgcarousel0").animate({ marginLeft: "0" }, tempo_slide);
      return;
    }
    btn_logic(btn[$(".btn.bg_white.btnactive").index()]);
    $("#imgcarousel0").animate({ marginLeft: "-=640" }, tempo_slide);
    timeout1 = true;
    timeout();
  });
}
function subtrair() {
  $(".minusbtn").click(function () {
    clearInterval(sliderinfinite2);
    invokeslideinfinite2();
    if (parseInt($("#imgcarousel0").css("margin-left")) == 0) {
      btn_logic(btn[6]);
      $("#imgcarousel0").css("margin-left", -4480);
      btn_logic(btn[6]);
      $("#imgcarousel0").animate({ marginLeft: "-3840" }, tempo_slide);
      return;
    }
    btn_logic(btn[$(".btn.bg_white.btnactive").index() - 2]);

    $("#imgcarousel0").animate({ marginLeft: "+=640" }, tempo_slide);

    timeout1 = true;
    timeout();
  });
}

function btn_click() {
  $(".btn").click(function () {
    clearInterval(sliderinfinite2);
    invokeslideinfinite2();
    $("#imgcarousel0").animate(
      { marginLeft: btn[$(this).index() - 1] },
      tempo_slide
    );
    btn_logic(btn[$(this).index() - 1]);
  });
}

var btn = [0, -640, -1280, -1920, -2560, -3200, -3840];
function btn_logic(value) {
  switch (value) {
    case btn[0]:
      addclass("btnactive", ".btn", ".btn:eq(0)");
      break;
    case btn[1]:
      addclass("btnactive", ".btn", ".btn:eq(1)");
      break;
    case btn[2]:
      addclass("btnactive", ".btn", ".btn:eq(2)");
      break;
    case btn[3]:
      addclass("btnactive", ".btn", ".btn:eq(3)");
      break;
    case btn[4]:
      addclass("btnactive", ".btn", ".btn:eq(4)");
      break;
    case btn[5]:
      addclass("btnactive", ".btn", ".btn:eq(5)");
      break;
    case btn[6]:
      addclass("btnactive", ".btn", ".btn:eq(6)");
      break;
  }
}

function addclass(classtoadd, elements, specific) {
  $(elements).each(function () {
    $(this).removeClass(classtoadd);
  });
  $(specific).addClass(classtoadd);
}
$(".text-link:eq(5)").click(function () {
  $(".menu-account").fadeToggle();
  $(".menu-account").css("display", "flex");
});

function adicionar_portfolio() {
  $(".threecarouselright").click(function () {
    if (
      parseInt($(".general01").css("margin-left")) - convertRemToPixels(15.1) <=
      -convertRemToPixels(90)
    ) {
      $(this).hide();
    }
    if (
      parseInt($(".general01").css("margin-left")) == convertRemToPixels(-90)
    ) {
      $(this).hide();
      return;
    }
    $(".general01").animate(
      { marginLeft: "-=" + convertRemToPixels(15.1) + "" },
      500
    );

    $(".threecarouselleft").show();

    timeout2 = true;
    timeoutjulia();
  });
}
function subtrair_portfolio() {
  $(".threecarouselleft").click(function () {
    if (
      parseInt($(".general01").css("margin-left")) + convertRemToPixels(15.1) >=
      convertRemToPixels(0)
    ) {
      $(this).hide();
    }
    if (parseInt($(".general01").css("margin-left")) == 0) {
      $(this).hide();
      return;
    }
    if (
      parseInt($(".general01").css("margin-left") - convertRemToPixels(15)) == 0
    ) {
      $(this).hide();
    }
    $(".general01").animate(
      { marginLeft: "+=" + convertRemToPixels(15.1) + "" },
      500
    );
    $(".threecarouselright").show();

    timeout2 = true;
    timeoutjulia();
  });
}
function convertRemToPixels(rem) {
  return rem * parseFloat(getComputedStyle(document.documentElement).fontSize);
}
