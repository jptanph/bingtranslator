$(document).ready(function(){
    $(".bingtranslator_select").selectBox();
    $('.bingtranslator_textarea').TextAreaResizer();
    $('#bingtranslator_copy').zclip({
        path:'/_sdk/img/bingtranslator/ZeroClipboard.swf',
        beforeCopy : function(){
            $('#translated_text').highlight($('#translated_text').text());
        },afterCopy : function(){
            $('#translated_text span').css({'background':'white','color': 'black'});
            
        },copy:function(){
            
           return $("#translated_text").text();
        }
    });
})

var frontPageBingtranslator = {
    loader_timer : 0,
    translate : function(){
        var sText = $("#original_text");
        var sFrom = $("#def_lang1");
        var sTo = $("#def_lang2");
        $('#translate').attr('disabled',true).css({'background':'gray'});
        this.translator_loader()
        var options = {
            url : usbuilder.getUrl('apiFrontBingtranslator'),
            dataType : 'json',
            type : 'post',
            data : {
                text1 : sText.val(),
                lang1 : sFrom.val(),
                lang2 : sTo.val()
            },success : function(server_response){
                clearInterval( frontPageBingtranslator.loader_timer);
                //alert(server_response.Data.lang)
                var result_translation = server_response.Data.translation
                //sFrom.val(server_response.Data.lang)
                sFrom.selectBox('value',server_response.Data.lang);

                $("#translated_text").html(''+result_translation+'');
                $('#translate').attr('disabled',false).css({'background':'#4e453e'})
            }
        }
        
        $.ajax(options);
    },translator_loader : function(){
        
        var sdot = '';
        var counter = 1;
        var dot_counter = 1; 
        sdot +="<span class='bingtranslator_loader'>Translating</span>";
        this.loader_timer = setInterval(function(){
            
            for(i = 0 ; i < ( ( counter + 1 ) - counter ) ;i++){
                
                sdot+=' .';
                
                if(dot_counter%4==0){
                    sdot = "<span class='bingtranslator_loader'>Translating</span>";
                }
                
                $('.translation_div').empty();
                $('.translation_div').append(sdot).fadeIn();
            }
            dot_counter++;
        },1000)
    }
}
