$(function() {
    $.vote_share = {
        version: '1.0'
    };
    $.fn.vote_share = function(config){
        config = $.extend({}, {
            vote_url: null,
            callback: function() {}
        }, config);   
    
        var vote_url = config.vote_url; 

        $(".btnVote").bind('click', {}, function(){
            $(".alert").hide();
            $(".btnVote").removeClass('active');
            method  = $(this).attr('method');
            $.post(vote_url, {
                'data[PracticeTest][method]' : method
            },
            function(response){
                if(response == method){
                    $("#alert-"+method+' #message').show();
                    $("#alert-"+method).slideDown();
                    $("#button-"+method).addClass('active');
                    $("#button-"+method).unbind('click');
                }else if(response=='auth'){
                    $("#auth-voted").slideDown();
                }else{

                }
            }
            );
        });

        $("#button-share").bind('click', {}, function(){
            $('#alert-likes #message').hide();
            $('#alert-likes').toggle();
        });
    }
});
