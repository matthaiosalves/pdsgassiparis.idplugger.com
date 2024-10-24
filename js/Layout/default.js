function setCookie(cname, cvalue, exdays) {
    const d = new Date();
    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
    const expires = "expires=" + d.toGMTString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
    const name = cname + "=";
    const decodedCookie = decodeURIComponent(document.cookie);
    const ca = decodedCookie.split(';');
    for (let i = 0; i < ca.length; i++) {
        let c = ca[i];
        while (c.charAt(0) === ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) === 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

function checkCookie() {
    const user = getCookie("teste");
    if (user !== "") {
        // alert("Welcome again " + user);
    } else {
        // user = prompt("Please enter your name:","");
        $('#mensagem_privacidade').addClass("active");
        if (user !== "" && user != null) {
            setCookie("teste", user, 30);
        }
    }
}

$(document).ready(function () {
    checkCookie();
});

function countChecked() {
    const n = $("#quiz input:checked").length;
    if (n === 5) {
        $('#quiz input:checkbox').not(':checked').prop('disabled', true)
    } else {
        $('#quiz input:checkbox').not(':checked').prop('disabled', false)
    }
}

$("#quiz input").click(countChecked);

function myFunction(x) {
    $('.abrirMenu').toggleClass("change");
    $('.menu').toggleClass('active');
}

$("header .menu li a").click(function () {
    $('.menu').removeClass('active');
    $('.abrirMenu').removeClass("change");
});

$("#mensagem_privacidade .button-cookies.politica").click(function () {
    $("#modalPolitica").modal('show');
    localStorage.setItem('cookies', 'aceito');
});
$("#mensagem_privacidade .button-cookies.azul").click(function () {
    $('#mensagem_privacidade').removeClass("active");
    setCookie("teste", 'oi', 30);
});

$("#modalPolitica .button-cookies").click(function () {
    $('#mensagem_privacidade').removeClass("active");
    $("#modalPolitica").modal('hide');
    setCookie("teste", 'oi', 30);
});

$("#modalPolitica li").click(function () {
    let dataItem = $(this).data('item');
    $('#modalPolitica .item_privacidade.active').fadeOut().removeClass('active');
    $('#modalPolitica li').removeClass('active');
    $(this).addClass('active');
    setTimeout(function () {
        $("#modalPolitica .item_privacidade").each(function () {
            if (dataItem == $(this).data('item')) {
                $(this).addClass('active').fadeIn();
            }
        });
    }, 400);

});

$(window).on('load', function () {
    $('#fimpromocao').modal('show');
    if ($("#modal-promocao-encerrada").length !== 0) {
        $("#modal-promocao-encerrada").modal();
    }
});

window.onload = function () {
    const arrayUrl = window.location.href.split("/");
    const grecaptchaBadge = document.querySelector('.grecaptcha-badge');

    function isPrivatePage() {
        const page = arrayUrl[arrayUrl.length - 1];
        const parent = arrayUrl[arrayUrl.length - 2];
        const grandparent = arrayUrl[arrayUrl.length - 3];
        return (
            (page === 'login' && parent === 'users' && grandparent === 'private') ||
            (page === 'add' && parent === 'users' && grandparent === 'private') ||
            (page === 'add' && parent === 'coupons' && grandparent === 'private')
        );
    }

    if (grecaptchaBadge) {
        if (isPrivatePage()) {
            grecaptchaBadge.classList.add("d-block");
        }
    }
}

