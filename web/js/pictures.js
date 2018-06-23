$(function(){
    $(".like-event").click(function(){
        var rate = 1;
        if ($(this).hasClass('dislike-event')){
            rate = 0;
        }
        var that = this;
        $.get($(this).attr('link'),{
            'picture_id' : $(this).data('picture_id'),
            'rate' : rate
        }).then(function(data, status){
            var json = JSON.parse(data);
            $(that).parent().find('.like').text(json.rate);
        });
        return false;
    })
})