$(function(){
    $("#btnLoginIn").on('click',function(){

        var user,pass;

        loginIn(user,pass);

    });
});

//Variables globales de la AppJsLogin
var mensaje = null;
var confirm = false;

//Funcion para iniciar sesion
var loginIn = function(a,b){

    $.ajax({
        url:'app/controller/login/LoginController.php',
        type:"post",
        dataType:"json",
        async:true,
        cache:false,
        beforeSend:function(){
            //script para terminar el loading
        },
        data:{
            user:a,pass:b
        }
    }).done(function (response) {
        //script para el loading

        console.log(response);
        MyAlert(response.result,'success');

    }).fail(function (jqhr,textStatus,errno) {
        //script para terminar el loading

        //Mostrar Mensaje con codigo de Error
        getthowError(jqhr,textStatus);

    });

};
