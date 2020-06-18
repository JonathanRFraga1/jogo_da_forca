function verCampos(e){
    var ling = $("[name='linguagem']").val();
    
   var rb = $("input[type='radio'][name='dificuldade']").is(':checked');
    if(rb == false){
        e.preventDefault;
    }
}

$(document).ready(function(){
    $('#formulario').on('submit', verCampos);
});
