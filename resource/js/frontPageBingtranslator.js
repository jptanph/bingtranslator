$(document).ready(function(){
    $(".bingtranslator_select").selectBox();
    $('.bingtranslator_textarea').TextAreaResizer();
})

var frontPageBingtranslator = {
    translate : function(){
        var sText = $("#original_text");
        var sFrom = $("#def_lang1");
        var sTo = $("#def_lang2");
        $('#translate').attr('disabled',true).css({'background':'gray'})
        var options = {
            url : usbuilder.getUrl('apiFrontBingtranslator'),
            dataType : 'json',
            type : 'post',
            data : {
                text1 : sText.val(),
                lang1 : sFrom.val(),
                lang2 : sTo.val()
            },success : function(server_response){
                //alert(server_response.Data.lang)
                var result_translation = server_response.Data.translation
                //sFrom.val(server_response.Data.lang)
                sFrom.selectBox('value',server_response.Data.lang);

                $("#translated_text").html(''+result_translation+'');
                $('#translate').attr('disabled',false).css({'background':'#4e453e'})
            }
        }
        
        $.ajax(options);
    }
}
