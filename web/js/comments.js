
class Comments{

    submitCommentEvent(e){
        e.preventDefault();
        var $target = $(e.target);
        if ($target.find('#commentform-content').val() === ""){
            return false;
        }
        $.post("/comment/create", $target.serialize()).then(() => {
            this.getComments($('.comments').data('pictureid'));
            $target.find('#commentform-content').val('')
        });
    }

    createForm(id, parentID){
        var languageComment = $('.languages-data').data('add-btn');
        var $form =  $(`<form class="form-inline" action="/comment/create?id=${id}" method="POST">
                <input type="text" id="commentform-content" class="form-control" name="CommentForm[content]">
                <input type="hidden" id="commentform-parent_id" class="form-control" name="CommentForm[parent_id]" value="${parentID}">
                <input type="hidden" id="commentform-picture_id" class="form-control" name="CommentForm[picture_id]" value="${id}">
                <button class="btn btn-success">${languageComment}</button>
            </form>`);
        $form.submit(this.submitCommentEvent.bind(this))
        return $form;

    }

    createCommentTemplate(object, isChildren){
        var languageAnswer = $('.languages-data').data('answer');
        var points = parseInt(object.points);
        if (!points){
            points = 0;
        }
        let childrenString = '';
        if (!isChildren){
            childrenString = `
                <div class="rating-link"><a href="#">${languageAnswer}</a></div>
                <div class="children" style="padding-left:40px"></div>
                <div class="form-answer"></div>`;
        }

        let $template = $(`<div class="comment">
                        <div class="author">${object.author}</div>
                        <div class="content">${object.content}</div>
                        <div class="rating"><a href="#" class="rating add-event add" data-rate="1">+</a> <a href="#" class="rating add-event minus" data-rate="0">-</a> (<span class="comment-rate">${points}</span>)</div>
                        ${childrenString}
                    </div>`);
        if (!isChildren){
            $template.find(".rating-link a").click((e) => {
                var $form = this.createForm(object.picture_id, object.id);
                $(e.target).closest(".comment").find('.form-answer').append($form);
                return false;
            });
        }
        $template.find(".rating.add-event").click((e) => {
            let rate = $(e.target).data('rate');
            $.get('/rating/comment-rate',{
                'comment_id' : object.id,
                'rate' : rate
            }).then(function(data, status){
                var json = JSON.parse(data);
                $template.find('.comment-rate').eq(0).text(json.rate);
            });
            return false;
        });
        $template.find(".rating.minus").click(() => {

        });
        return $template;
    }
    getComments(id){
        var languageNotFound = $('.languages-data').data('not_found');
        $.getJSON( "/comment", {'pictureID' : id},(data) => {
            $(".comments").html("");
            if (data.length > 0){
                data.forEach((object) => {
                    let $template = this.createCommentTemplate(object, false);
                    object.children.forEach((children) => {
                        let $childrenTemplate = this.createCommentTemplate(children, true);
                        $template.find(".children").append($childrenTemplate);
                    });

                    $(".comments").append($template);
                });
            }else{
                $(".comments").html(languageNotFound);
            }
        });
    }

}


$(function(){
    var commentID = parseInt($('.comments').data('pictureid'));
    var comment = new Comments();
    comment.getComments(commentID);
    var $form = comment.createForm(commentID, 0);
    $('.comment-form-origin').append($form);
});