<?php 
session_start();
if ( $_SESSION["Nivel"] == "Utilizador" || $_SESSION["session"] != true)
{
    echo ' "<script>window.location.assign("Index.php")</script>";';
    return;
}
include ("navbar/navbar.php"); 
?>


<body>
    <div class="btn-up">
        < </div>
            <div class="total-folha">
                <div class="mega-titulo" style='
    margin-bottom: 2rem;'>Administração e gestão</div>
                <div class="big_menu">

                </div>
                <div class='loadexample'>
                    <div class="folha_de_obra">
                        <div class="cartootxt">Não fiques a olhar para mim, tens de trabalhar!</div><img
                            class='img-cartoon'
                            src="http://images6.fanpop.com/image/photos/35700000/Phoenix-Wright-HD-Sprites-ace-attorney-35724949-960-640.gif"
                            alt="" style='
width: 30rem;
    margin-top: 4rem;
    margin-left: auto;
    margin-right: auto;'>
                    </div>
                </div>
            </div>
</body>

<script>
const menu = [
    ["Criar folhas de obras", "criar", "folhadeobra.php"],
    ["Aprovar folhas de obras", "aprovar", "folhadeobraapproval.php"],
    ["Inserir e modificar dados de clientes", "user", "create_modify_user.php"]
];

function GetURLParameter(sParam) {
    var sPageURL = window.location.search.substring(1);
    var sURLVariables = sPageURL.split('&');
    for (var i = 0; i < sURLVariables.length; i++) {
        var sParameterName = sURLVariables[i].split('=');
        if (sParameterName[0] == sParam) {
            return decodeURIComponent(sParameterName[1]);
        }
    }
}
$(window).scroll(function() {
    if ($(window).scrollTop() > $(".big_menu").offset().top) {
        $(".btn-up").fadeIn().css("display", "flex");
    } else {
        $(".btn-up").fadeOut();
    }
});
$(".btn-up").click(function() {
    $([document.documentElement, document.body]).animate({
            scrollTop: $(".mega-titulo").offset().top,
        },
        100
    );
})
let intervals = [];

function getparameter(method) {
    $(".big-col").removeClass("Selected-big-col");
    var id = window.setInterval(function() {}, 0);
    while (id--) {
        window.clearInterval(id);
    }
    console.log(intervals);

    switch (method) {
        case "criar":
            if (GetURLParameter("result") == "true") {
                $(".big-col:eq(0)").addClass("Selected-big-col");
                $.get("folhadeobra_result.php", {
                        cod: GetURLParameter("cod"),
                    },
                    function(
                        data, status) {
                        $(".loadexample").html(data);
                    })
                break;
            }
            $.get(menu[0][2], function(data, status) {
                $(".big-col:eq(0)").addClass("Selected-big-col");
                $(".loadexample").html("");
                $(".loadexample").html(data);

            });
            break;
        case "aprovar":

            if (GetURLParameter("result") == "true") {
                $(".big-col:eq(1)").addClass("Selected-big-col");
                $.get("folhadeobra_result.php", {
                        usercode: GetURLParameter("usercode"),
                        type: GetURLParameter("type")
                    },
                    function(
                        data, status) {
                        $(".loadexample").html(data);
                    })
                break;
            }
            $.get(menu[1][2], function(data, status) {
                $(".big-col:eq(1)").addClass("Selected-big-col");
                $(".loadexample").html("");
                $(".loadexample").html(data);
            });
            break;
        case "user":
            $.get(menu[2][2], function(data, status) {
                $(".big-col:eq(2)").addClass("Selected-big-col");
                $(".loadexample").html("");
                $(".loadexample").html(data);
            });
            break;
        default:

            break;
    }
}
$(window).on('popstate', function() {
    getparameter(GetURLParameter("metodo"));
});
$(function() {
    getparameter("<?php echo $_GET["metodo"]?>");
    console.log("<?php echo $_GET["metodo"]?>");
});
menu.map(function(obj, index) {
    $(".big_menu").append(`<div class='big-col'>${obj[0]}</div>`);
    $(".big_menu>.big-col:last-child").click(function() {
        var currentURL = window.location.protocol + "//" + window.location.host + window
            .location.pathname + `?metodo=${obj[1]}`;
        window.history.pushState({
            path: currentURL
        }, '', currentURL);
        getparameter(obj[1]);
    });


});
</script>
<script src="../Jquery/jquery.js"></script>
<script src="../Jquery/loginsignin.js"></script>