$(window).load(function () {
  $(".loader").fadeOut("slow");
});
$("#formid").on("keyup keyp", function (e) {
  var keyCode = e.keyCode || e.which;
  if (keyCode === 13) {
    e.preventDefault();
    return false;
  }
});
$(window).on("load", function () {
  $(".reg-classe:eq(3)").mask("0000-000");
  $(".btn-enviar.btn-envem.login").off();
  $(".btn-enviar.btn-envem.password").off();
  $(".btn-enviar.btn-envem.edit").off();
  $(".btn-enviar.btn-envem.edit").click(function () {
    var email = $("input[name='email']").val();
    $.ajax({
      type: "POST",

      url: "emailexist.php",

      data: {
        email: email,
      },
      success: function (html) {
        console.log(html);
        if (html == 2 || html == 0) {
          $("input[type='submit']").length == 0
            ? $("form").append("<input type='submit' style='display:none'>")
            : "";
          $("input[type='submit']").click();
          $("input[type='submit']").remove();
        } else {
          alert("Email já existe");
        }
      },
    });
  });
  $(".btn-enviar.btn-envem.recvpassword").click(function () {
    if ($(".reg-classe:eq(0)").val() != $(".reg-classe:eq(1)").val()) {
      $(".reg-classe").css({ border: "0 solid red" }).animate(
        {
          borderWidth: 2,
        },
        50
      );
      return;
    }
    $(".form_flex").submit();
  });
  $(".btn-enviar.btn-envem.password").click(function () {
    if (
      $(".reg-classe.email-login").val() ==
      $(".reg-classe.password-login").val()
    ) {
      $(".form_flex").submit();
    } else {
      $(".reg-classe").css({ border: "0 solid red" }).animate(
        {
          borderWidth: 2,
        },
        50
      );
    }
  });
  $(".btn-enviar.btn-envem.login").click(function () {
    var email = $("input.email-login").val();
    var password = $("input.password-login").val();
    var checkbox = $("#paiva").is(":checked");
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
          if (!$(".incr_pass").length) {
            $(".password-login").after(
              "<div class='incr_pass'>Email ou palavra-passe incorreta</div>"
            );
            $(".incr_pass").fadeIn();
          }
        }
        if (html == 1) {
          window.location.assign("Index.php");
        }
        $(".incr_pass").fadeIn();
        $("input.reg-classe").keyup(function () {
          $(".incr_pass").fadeOut();
        });
        $("input.reg-classe").keypress(function () {
          $(".incr_pass").fadeOut();
        });
      },
    });
  });
  $(".reg-classe").keyup(function () {
    $(this).css("border", "none");
    $(".error_class").remove();
  });
  $(".reg-classe").keypress(function () {
    $(this).css("border", "none");
    $(".error_class").remove();
  });
});

function jump(h) {
  var url = location.href;
  location.href = "#" + h;
  history.replaceState(null, null, url);
}
$(".reg-classe.mandatory").keyup(function () {
  $(this).css("border", "none");
});
$(".reg-classe.mandatory").keypress(function () {
  $(this).css("border", "none");
});
$(".btn-enviar.btn-envem.signin").click(function () {
  var count = 0;
  $(
    ".reg-classe:not(.reg-classe:eq(3)):not(.reg-classe:eq(3)):not(.reg-classe:eq(2)):not(.reg-classe:eq(2))"
  ).each(function () {
    if ($(this).val() == "") {
      count = 1;
      $(this).css({ border: "0 solid red" }).animate(
        {
          borderWidth: 3,
        },
        50
      );
    }
  });
  if (count == 0) {
    if ($(".reg-classe:eq(8)").val() != $(".reg-classe:eq(8)").val()) {
      $(".reg-classe:eq(9)").css({ border: "0 solid red" }).animate(
        {
          borderWidth: 3,
        },
        50
      );
      $(".reg-classe:eq(8)").css({ border: "0 solid red" }).animate(
        {
          borderWidth: 3,
        },
        50
      );
      return;
    }

    if ($(".form_flex").length) {
      var email = $(".reg-classe:eq(1)").val();
      $.ajax({
        type: "POST",

        url: "emailexist.php",

        data: {
          email: email,
        },

        success: function (html) {
          console.log(html);
          if (html == 0) {
            if (!$(".submit").length) {
              $(".form_flex").append(
                '<input type="submit" class="submit" style="display:none">'
              );
            }
            $(".submit").click();
            return;
          }
          if (!$(".error_class").length)
            $(".reg-classe:eq(1)").css({ border: "0 solid red" }).animate(
              {
                borderWidth: 2,
              },
              50
            );
          $(".form_flex").append(
            "<div class='error_class'>Email já existe</div>"
          );
        },
      });
    }
  }
});
$(".bars").click(function () {
  $(".navbar_black").css("display", "flex");
  $(".navbar_black").animate(
    { transform: "translate(-50%,-50%) scale(0.4)" },
    300
  );
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
$(".link:eq(0)").click(function () {
  location.href = "../php/#inicio";
});
$(".link:eq(1)").click(function () {
  location.href = "../php/#Quemsomos";
});
$(".link:eq(2)").click(function () {
  location.href = "../php/#servicos";
});
