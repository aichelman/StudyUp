(function($) {
    $.admin_add = {version: '1.0'};
    $.fn.admin_add = function(config){
        config = $.extend({}, {
                practice_test_id: '',
                loadPartNumber: '',
                selectPartNumber: '',
                maximumNumOfAnswers: '',

                callback: function() {

                }
        }, config);


        if($.browser.msie){
            $.ajaxSetup({cache: false});
        }

        if(config.practice_test_id != ''){
            $('#QuestionPracticeTestId').trigger('change');
        }


        /**
         * Add/Remove answer options
         */
        $("#plus").click(function(){
            var yourclass=".clonable"; //The class you have used in your form
            var clonecount = $(yourclass).length; //how many clones do we already have?
            var newid = Number(clonecount) + 1; //Id of the new clone

            $(yourclass+":first").fieldclone({//Clone the original elelement
                newid_: newid, //Id of the new clone, (you can pass your own if you want)
                target_: $("#answerTemplate"), //where do we insert the clone? (target element)
                insert_: "before", //where do we insert the clone? (after/before/append/prepend...)
                limit_: config.maximumNumOfAnswers //Maximum Number of Clones
            });

            $(yourclass+":last").find("input").val('');
            $(yourclass+":last").find("input[type=radio]").val(clonecount);

            return false;
        });

        $("#minus").bind('click', {}, function(){
            var yourclass=".clonable";
            if($(yourclass).size() > 1){
                $(yourclass+":last").remove();
                $(yourclass+":last").find("input[type=radio]").attr('checked', true);
            }
        });

        $("#edit-plus").click(function(){
            var yourclass=".clonable"; //The class you have used in your form
            var clonecount = $(yourclass).length; //how many clones do we already have?
            var newid = Number(clonecount) + 1; //Id of the new clone
            var whoChecked = $(yourclass).find("input:radio:checked").val();
            $(yourclass+":first").fieldclone({//Clone the original elelement
                newid_: newid, //Id of the new clone, (you can pass your own if you want)
                target_: $("#answerTemplate"), //where do we insert the clone? (target element)
                insert_: "before", //where do we insert the clone? (after/before/append/prepend...)
                limit_: config.maximumNumOfAnswers //Maximum Number of Clones
            });

           $(yourclass+":last").find("input").val('');
           $(yourclass+":last").find("input[type=radio]").attr('checked', false);
           $(yourclass+":last").find("input[type=radio]").val(clonecount);
           $(yourclass).find("input:radio[value="+whoChecked+"]").attr('checked', true);
           
           
           //return false;
        });

        $("#edit-minus").bind('click', {}, function(){
            var yourclass=".clonable";
            if($(yourclass).size() > 1){
                $(yourclass+":last").remove();
            }
        });
    }
    return this;
})(jQuery);