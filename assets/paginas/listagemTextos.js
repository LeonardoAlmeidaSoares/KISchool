$(function(){
    $(textareas).each(function(ext, val){
        //console.log(val);
        CKEDITOR.replace(val);
    });
    //CKEDITOR.replace(".textareas");
});