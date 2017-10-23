$(function () {

    var History = window.History;

    if (History.enabled) {
        var page = get_url_value('page');
        var path = page ? page : 'home';
        // Load the page
        load_page_content(path);
    } else {
        return false;
    }

    // Content update and back/forward button handler
    History.Adapter.bind(window, 'statechange', function() {
        var State = History.getState();
        // Do ajax
        load_page_content(State.data.path);
        // Log the history object to your browser's console
        History.log(State);
    });

    // Navigation link handler
    $('body').on('click', 'nav a', function(e) {
        e.preventDefault();

        var urlPath = $(this).attr('href');
        var title = $(this).text();

        History.pushState({path: urlPath}, title, './?page=' + urlPath); // When we do this, History.Adapter will also execute its contents.
    });

    function load_page_content(page) {
        $.ajax({
            type: 'post',
            url: page + '.html',
            data: {},
            success: function(response) {
                $('.content').html(response);
            }
        });
    }

    function get_url_value(variable) {
        var query = window.location.search.substring(1);
        var vars = query.split("&");
        for (var i=0;i<vars.length;i++) {
            var pair = vars[i].split("=");
            if(pair[0] == variable){return pair[1];}
        }
        return(false);
    }


    $('#btnSalirHome').click(function () {

        $.ajax({
            url:'app/controller/login/getLoginOut.php',
            type:'get',
            data:{},
            async:true,
            cache:false,
            beforeSend:function () {
                $("body").append('<span id="preloader">Cargando Espere . . . .</span>');
            },
        }).done(function (response) {
            History.pushState({path: 'app/controller/login/getLoginOut.php'}, 'Prueba 1', './?page=' + 'app/controller/login/getLoginOut.php');

            $("#preloader").remove();
            $("#resultado").html(response);


        }).fail( function( jqXHR, textStatus, errno ) {

            getthowError(jqXHR,textStatus);

        });


    });
    $('#btnSalirHome2').click(function () {

        $.ajax({
            url:'app/controller/login/getLoginOut2.php',
            type:'get',
            data:{},
            async:true,
            cache:false,
            beforeSend:function () {
                $("body").append('<span id="preloader">Cargando Espere . . . .</span>');
            },
        }).done(function (response) {
            History.pushState({path: 'app/controller/login/getLoginOut2.php'}, 'Prueba 2', './?page=' + 'app/controller/login/getLoginOut2.php');

            $("#preloader").remove();
            $("#resultado").html(response);

        }).fail( function( jqXHR, textStatus, errno ) {

            getthowError(jqXHR,textStatus);

        });


    });

});

var MyAlert = function (mensaje,type) {

    alert(mensaje);
}

var getthowError = function (jqXHR,textStatus) {

    if (jqXHR.status === 0) {

        MyAlert('Not connect: Verify Network.','danger');

    } else if (jqXHR.status == 404) {

        MyAlert('Requested page not found [404]','danger');

    } else if (jqXHR.status == 500) {

        MyAlert('Internal Server Error [500].','danger');

    } else if (textStatus === 'parsererror') {

        MyAlert('Requested JSON parse failed.','danger');

    } else if (textStatus === 'timeout') {

        MyAlert('Time out error.','danger');

    } else if (textStatus === 'abort') {

        MyAlert('Ajax request aborted.','danger');

    } else {

        MyAlert('Uncaught Error: ' + jqXHR.responseText,'danger');

    }

}