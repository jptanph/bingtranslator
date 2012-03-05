
var frontPageBingtranslator = {
    translate : function(){
        var sText = $("#str");
        var sFrom = $("#from");
        var sTo = $("#to");
        
        var options = {
            url : usbuilder.getUrl('apiFrontBingtranslator'),
            dataType : 'json',
            type : 'post',
            data : {
                text1 : sText.val(),
                lang1 : sFrom.val(),
                lang2 : sTo.val()
            },success : function(server_response){
                sFrom.val(server_response.Data.lang)
                $("#result").val(server_response.Data.translation)
            }
        }
        
        $.ajax(options);
    }
}
