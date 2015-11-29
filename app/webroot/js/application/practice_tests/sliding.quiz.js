$(function() {
	$.sliding_quiz = {version: '1.0'};
	$.fn.sliding_quiz = function(config){
		config = $.extend({}, {
				questions: null,
				callback: function() {}
		}, config);

		// initial container object
		var container = $(this);
		// number of questions
		var numOfQuestions = config.questions.length;
		// array right answer
		var rightAnswers = [];
		// array user choice answer
		var userAnswers = [];
		/*
		current position of fieldset / navigation link
		*/
		var current 	= 1;

		/*Initial question*/
		if (config.questions === null) {
			container.html('<h2>Cannot find questions.</h2>');
			return;
		}
		var quizContent = '<div id="quiz-wrapper"><div id="steps"><form id="formElem" name="formElem" action="" method="post">';
		for (questionIdx = 0; questionIdx < numOfQuestions; questionIdx++) {
			if(config.questions[questionIdx] != undefined){
				show = (questionIdx==0) ? "show" : "";
				quizContent += '<fieldset class="step '+show+'" question="'+(questionIdx+1)+'" choice=""><legend>'+config.questions[questionIdx].question+'</legend>';
				for (answerIdx = 0; answerIdx < config.questions[questionIdx].answers.length; answerIdx++) {
					quizContent += '<p answer="'+(answerIdx+1)+'">'+config.questions[questionIdx].answers[answerIdx]+'</p>';
				}
				rightAnswers[questionIdx+1] = config.questions[questionIdx].result;
				quizContent += '</fieldset>';
			};
		}
		quizContent += '</form></div><div id="quiz-notice">Please select an option</div><div id="quiz-navigation" style="display:none;"><ul><li class="disabled"><a href="#" id="back-quiz">Back</a></li><li class="page-number"><a href="#">1/'+numOfQuestions+'</a></li><li class=""><a href="#" id="next-quiz">Next</a><a href="#" id="finish-quiz" style="display: none;">Finish</a></li></ul></div></div></div>';
		container.html(quizContent);

		/*Initial object*/
		// initial steps object
		var steps = container.find('#steps'),
		notice = container.find('#quiz-notice'),
		page_number = container.find(".page-number a"),
		next_button = container.find("#next-quiz"),
		back_button = container.find("#back-quiz"),
		finish_button = container.find("#finish-quiz");

		/*
		sum and save the widths of each one of the fieldsets
		set the final sum as the total width of the steps element
		*/
		var stepsWidth	= 0;
		var widths 		= new Array();
		steps.find('.step').each(function(i){
			var $step 		= $(this);
			widths[i]  		= stepsWidth;
			stepsWidth	 	+= $step.width();
		});
		steps.width(stepsWidth);

		/*
		Answer selected
		*/
		container.find('p').click(function () {
			var thisAnswer = $(this);

			if (thisAnswer.hasClass('selected')) {
				thisAnswer.removeClass('selected');
				thisAnswer.parents('.step').attr('choice', '');
			} else {
				thisAnswer.parents('.step').children('p').removeClass('selected');
				thisAnswer.addClass('selected');
				thisAnswer.parents('.step').attr('choice', thisAnswer.attr('answer'));
			}
		});

		/*
		show the navigation bar
		*/
		container.find('#quiz-navigation').show();

		/*
		when clicking on a next link
		the form slides to the next corresponding fieldset
		*/
		next_button.click(function(e){
			current = steps.find(".show");

			//calculate index
			index   = current.index() + 1;
			index ++;
			slider.next(index);

			e.preventDefault();
		});

		/*
		when clicking on a back link
		the form slides to the back corresponding fieldset
		*/
		back_button.click(function(e){

			current = steps.find(".show");

			//calculate index
			index   = current.index() + 1;
			index--;
			slider.back(index);

			e.preventDefault();
		});

		/*
		when clicking on a finish link
		show the user results
		*/
		finish_button.click(function(e){
			slider.finish();
			e.preventDefault();
		});

		var slider = {
			next: function(index){
				if (container.find('.show').attr('choice').length === 0) {
					notice.slideDown(300);
					return false;
				};
				notice.slideUp();
				if(widths[index-1] != undefined){
					steps.stop().animate({
						marginLeft: '-' + widths[index-1] + 'px'
					},500,function(){
						//mark current slide as show
						steps.find(".show").removeClass('show');
						current.next('fieldset').addClass('show');

						//increase page number
						page_number.html(index+"/"+numOfQuestions);

						//enable first back button
						back_button.parent().removeClass("disabled");
						//last next button become finish
						if(numOfQuestions == index){
							next_button.hide();
							finish_button.show();
						}
					});
				}
			},
			back: function(index){
				notice.slideUp();
				if(index-1 >= 0){
					steps.stop().animate({
						marginLeft: '-' + widths[index-1] + 'px'
					},500,function(){
						//mark current slide as show
						steps.find(".show").removeClass('show');
						current.prev('fieldset').addClass('show');

						//decrease page number
						page_number.html(index+"/"+numOfQuestions);

						//disabled first back button
						if((index - 1) <= 0){
							back_button.parent().addClass("disabled");
						}
						//enabled last next button
						if(numOfQuestions > index){
							finish_button.hide();
							next_button.show();
							next_button.parent().removeClass("disabled");
						}
					});
				}
			},
			finish: function(){
				if (container.find('.show').attr('choice').length === 0) {
					notice.slideDown(300);
					return false;
				};

				//get user answer
				container.find('.step').each(function (index) {
					questionNumber = $(this).attr('question');
					userSelect = $(this).attr('choice');
					userAnswers[questionNumber] = userSelect;
				});

				//quiz result
				var numOfRightAnswer = 0,
					questionList = '',
					answerList = '';
				for (i = 0; i < rightAnswers.length; i++) {
					if(config.questions[i] == undefined) {
						continue;
					}

					bt_rightOrwrong = 'btn-danger';
					if(rightAnswers[i+1] == userAnswers[i+1]){
						numOfRightAnswer++;
						bt_rightOrwrong = 'btn-success';
					}

					questionList += '<a href="javascript:;;" title="Review Question #' + (i + 1) + '" questionNumber="' + (i + 1)+'" class="quiz-result btn '+bt_rightOrwrong+'">Question #' + (i + 1)+'</a>';
					answerList += '<div id="q' + (i + 1)+'" class="final-result">';
					answerList += '<h3>'+config.questions[i].question+'</h3>';
					for (answersIndex = 0; answersIndex < config.questions[i].answers.length; answersIndex++) {
						var rightOrwrong = '';
						if (config.questions[i].result == (answersIndex + 1)) {
							rightOrwrong += 'right';
						}
						if (userAnswers[i+1] == (answersIndex + 1) ) {
							rightOrwrong += ' selected';
							if (config.questions[i].result != userAnswers[i+1]) {
								rightOrwrong += ' wrong';
							}
						}

						answerList += '<p class="' + rightOrwrong + '">' + config.questions[i].answers[answersIndex] + '</p>';
					}
					answerList += '</div>';
				}


				var score = Math.round((numOfRightAnswer / numOfQuestions) * 100);
				var resultContent = '<div id="quiz-wrapper"><div id="steps"><form id="formElem" name="formElem" action="" method="post"><h3>You scored '+score+'%. </h3><fieldset class="step"><div class="resultset">'+questionList+'</div><div id="your-score" class="final-result"><p>Click `Question` button to review your answer</p></div>'+answerList+'</fieldset></form></div>';

				//parse HTML
				container.html(resultContent);
				//unbind select answer
				container.find('p').unbind('click');
				//bind show result event
				container.find('.quiz-result').bind('click', function(){
						$('.final-result').hide();
						$('.quiz-result').removeClass('active');
						$(this).addClass('active');
						questionNumber = $(this).attr('questionNumber');
						$('#q' + questionNumber).fadeIn(300);
				});
			}
		};
	};
});