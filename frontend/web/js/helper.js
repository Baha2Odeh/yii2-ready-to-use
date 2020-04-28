$(document).on('change','[data-country-picker-with-cites]',function(){
    let country_id = $(this).val();
    let city_input_id = $(this).attr('data-country-picker-with-cites');
    jQuery.ajax({
        type : 'GET',
        url  : '/helper/city',
        data : {country_id:country_id},
    }).done(function(response) {
        let new_options = '';
        $.each(response, function(id,name) {
            new_options += '<option value = "'+id+'">'+name+'</option>';
        });
        $('#'+city_input_id).empty().append(new_options);
    });
});



$(document).on('click','[data-question-vote]',function(){
    if(isGuest) {
        alert('please login first');
        return false;
    }
    let question_id = $(this).attr('data-question-vote');
    let type = $(this).attr('data-vote-type');
    jQuery.ajax({
        type : 'POST',
        url  : '/vote/question-vote',
        data : {
            [yii.getCsrfParam()]:yii.getCsrfToken(),
            question_id:question_id,
            type:type
        },
    }).done(function(response) {
        if(response.success){
            let {vote_up,vote_down,question_id} = response;
            $(`[data-question-vote=${question_id}][data-vote-type=up]`).find('.count').html(vote_up);
            $(`[data-question-vote=${question_id}][data-vote-type=down]`).find('.count').html(vote_down);
        }
    });
});


$(document).on('click','[data-answer-vote]',function(){
    if(isGuest) {
        alert('please login first');
        return false;
    }
    let answer_id = $(this).attr('data-answer-vote');
    let type = $(this).attr('data-vote-type');
    jQuery.ajax({
        type : 'POST',
        url  : '/vote/answer-vote',
        data : {
            [yii.getCsrfParam()]:yii.getCsrfToken(),
            answer_id:answer_id,
            type:type
        },
    }).done(function(response) {
        if(response.success){
            let {vote_up,vote_down,answer_id} = response;
            $(`[data-answer-vote=${answer_id}][data-vote-type=up]`).find('.count').html(vote_up);
            $(`[data-answer-vote=${answer_id}][data-vote-type=down]`).find('.count').html(vote_down);
        }
    });
});

