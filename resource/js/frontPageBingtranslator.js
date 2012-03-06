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
    reverse_flag :1,
    
    translate : function(){
        var sText = $("#original_text");
        var sFrom = $("#def_lang1");
        var sTo = $("#def_lang2");
        $('#translate').attr('disabled',true).css({'background':'gray','cursor':'default'});
        $("#translated_text").html('');
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
                var result_translation = server_response.Data.translation
                sFrom.selectBox('value',server_response.Data.lang);
                $("#translated_text").html(''+result_translation+'');
                $('#translate').attr('disabled',false).css({'background':'#4e453e','cursor':'pointer'})
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
                
                $('.translation_div').html(sdot);
            }
            dot_counter++;
        },1000)
    },reverse : function(){
        
        var sFrom = $("#def_lang1");
        var sTo = $("#def_lang2");
        
        var sFromTemp = $("#def_lang2").val();
        var sToTemp = $("#def_lang1").val();
        
        if(this.reverse_flag==1){
            sFrom.selectBox('value',sToTemp);
            sTo.selectBox('value',sFromTemp);
            frontPageBingtranslator.reverse_flag = 0;
        }else if(this.reverse_flag==0){
            
            sTo.selectBox('value',sToTemp);
            sFrom.selectBox('value',sFromTemp);
            frontPageBingtranslator.reverse_flag = 1;
        }

    }
}
