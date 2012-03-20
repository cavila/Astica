if (!jQuery) { 
		   var head = document.getElementsByTagName("head")[0];
		   script = document.createElement('script');		   
		   script.id = 'jQuery';
		   script.type = 'text/javascript';
		   script.src = 'http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js';
		   head.appendChild(script);
		}