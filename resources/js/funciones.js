function capLock(event) {
	keycode = event.keyCode ? event.keyCode : event.which;
	shiftkey = event.shiftKey ? event.shiftKey : ((keycode == 16) ? true : false);
	if(((keycode >= 65 && keycode <= 90) && !shiftkey) || ((keycode >= 97 && keycode <= 122) && shiftkey)) {
		document.getElementById('caplock').addClassName('visto');
		document.getElementById('caplock').removeClassName('oculto');
	}
	else {
		document.getElementById('caplock').addClassName('oculto');
		document.getElementById('caplock').removeClassName('visto');
	}
}