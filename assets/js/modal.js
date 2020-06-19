


function showcli(nm) {
    str = nm;
    if (window.XMLHttpRequest) {
        // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else {
        // code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            $('#txtcli').html(this.response);
        }
    };
    xmlhttp.open("GET", "../mediadores/linguagemRelatorio.php?", true);
    xmlhttp.send();
    //xmlhttp.open("POST", "busca_cli.php", true);
    //xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    //xmlhttp.send("q=" + str);
}

$(document).ready(function() { //quando terminar de carregar o documento:

    $('#relatorioEsp').click(function() { 
        showcli($('#nome').val());
    });

    $("#relatorioEsp").click(function(){
        $("#modal").addClass("mostrar");
    })

    $('#btmodal').click(function() {
        $("#modal").removeClass("mostrar");
    });

});


