
function checkThis(data) {
    var error = 0;
    $.each(data, function (key, val) {
        if ($("#" + val).val() == "") {
            $("#" + val).addClass("is-invalid");
            $("#err_" + val).show();
            error++;
        }
    });

    return error;
}

function validateThis(elem) {
    var id = $(elem).attr("id");
    if ($(elem).val() == "") {
        $(elem).removeClass("is-valid");
        $(elem).addClass("is-invalid");

        $("#err_" + id).show();
    } else {
        $(elem).removeClass("is-invalid");
        $(elem).addClass("is-valid");

        $("#err_" + id).hide();
    }
}

function validateThisTipe(elem) {
    var id = $(elem).attr("data-tipe");
    if ($(elem).val() == "") {
        $(elem).removeClass("is-valid");
        $(elem).addClass("is-invalid");

        $("#err_" + id).show();
    } else {
        $(elem).removeClass("is-invalid");
        $(elem).addClass("is-valid");

        $("#err_" + id).hide();
    }
}

function directView() {
    var elem = "#";
    $('.em-error').each(function () {
        var item = $(this);

        if (item.css("display") == "inline") {
            elem += item.attr("id");
            return false;
        }
    });

    $('html, body').animate({
        scrollTop: $(elem).offset().top - 75
    }, 100);
}

function goBack() {
    window.history.back();
}

// $(document).ready(function () {
//     var url = window.location;
//     alert(url);
//     $(".nav-link a[href='" + url + "']").css("display", "none");

//     // Will only work if string in href matches with location
//     $('.nav-link a[href="' + url + '"]').parent().addClass('active');


//     // Will also work for relative and absolute hrefs
//     $('.nav-link a').filter(function () {
//         return this.href == url;
//     }).parent().addClass('active');
// });

//   =======================================================================
//    Siddebar Right Script
//   =======================================================================


$(document).ready(function(){
    // var sidebarBtn = $("#sidebar-right");
    var sidebarContent = $("#sidebar-right-content");
  
    $("#sidebar-right").click(function() {
            $("#sidebar-right-content").toggle("slow","swing");
    });
  
  });