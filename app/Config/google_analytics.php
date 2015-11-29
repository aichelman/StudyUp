<?php
  $config = array(
  	'GA' => array(
		'profile_id' => 'ga:' . 'enter_your_number_here', //see how to get this number here http://blog.explainum.com/2011/05/how-to-find-profileid-in-new-google.html
  		'email' => '',//your_google_account@gmail.com
  		'password' => '',//your_google_pass
  		'embed_code' => "<script type=\"text/javascript\">
                                var _gaq = _gaq || [];
                                _gaq.push(['_setAccount', 'your_google_analystic_track_id']);
                                _gaq.push(['_trackPageview']);
                                  (function() {
                                    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
                                    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
                                    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
                                  })();
                                </script>"
  		)
  	);
?>