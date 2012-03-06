$(document).ready(function(){
    
   frontPageBingtranslator.init_default();
    
   $(this).keyup(function(e) {
       if (e.keyCode == 27) {
           $("#bingtranslator").css({'visibility':'hidden'});          
           frontPageBingtranslator.open_flag=true;
       }
   });
});



var frontPageBingtranslator = {
    
    loader_timer : 0,
    reverse_flag :1,
    is_empty : true,
    open_flag : true,
    translate : function(){
        var sText = $("#original_text");
        var sFrom = $("#def_lang1");
        var sTo = $("#def_lang2");
        
        if(sText.val()=='' || $.trim(sText.val())=='' || frontPageBingtranslator.is_empty){
            
            return false;
        }else{
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
        }
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

    },init_default : function(){
       this.is_empty = true;


        $("#translate").click(function (event) {
            
            $("#translated_text").css('background','#fff url(\'images/loader.gif\') no-repeat center center');
            //some ajax stuff here
            $('#translated_text').load('test.html #test');
            $("#translated_text").css('background','#fff none no-repeat center center');
            event.preventDefault();
            return false;
        }); 
        
        

        $("#original_text").blur(function(){
           var str = $(this).val();
           if(str.length==0){
               $("#original_text").val('Enter word(s) here.').css({'fontStyle':'italic','color':'gray'});
               frontPageBingtranslator.is_empty = true;
           }else{
               
               frontPageBingtranslator.is_empty = false;
           }
        })
        
        $("#original_text").focus(function(){
            $("#original_text").css({'fontStyle':'normal','color':'black'});

            if(frontPageBingtranslator.is_empty){
                $(this).val('')
            }else{
                
            }
        })
        
        $(".bingtranslator_select").selectBox();
        
        $('#bingtranslator_copy').zclip({
            path:'[IMG]/ZeroClipboard.swf',
            beforeCopy : function(){
                $('#translated_text').highlight($('#translated_text').text());
            },afterCopy : function(){
                $('#translated_text span').css({'background':'white','color': 'black'});
                
            },copy:function(){
                
               return $("#translated_text").text();
            }
        });
        
       
    },open_dialog : function(){
        
        if(this.open_flag==true){
            $("#bingtranslator").css({'visibility':'visible'});
            this.open_flag=false;
        }else if(this.open_flag==false){
            $("#bingtranslator").css({'visibility':'hidden'});          
            this.open_flag=true;
        }
        
    },close_dialog : function(){
        $("#bingtranslator").css({'visibility':'hidden'}); 
        this.open_flag=true;
    }
}
