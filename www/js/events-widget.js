(function(){
	var el = document.getElementById('widget-upcoming-events-content');
	if (!el) {
		return;
	}

	el.innerHTML = 'Loading events...';

	var xhr = (window.ActiveXObject) ? new ActiveXObject("Microsoft.XMLHTTP") : (XMLHttpRequest && new XMLHttpRequest()) || null;
	xhr.onreadystatechange = function() {
		if (xhr.readyState === 4) {
			if (xhr.status === 200) {
				el.innerHTML = xhr.responseText;
			}
			else {
				el.innerHTML = 'Problem contacting server';
			}
		}
	};

	xhr.open('GET', '/pittsburghcc/muffintest/ajax/events.php', true);
	xhr.setRequestHeader('Content-type', 'text/html');
	xhr.send();
})();