console.log('mix is working');

var participantes = $('#participantes');

participantes.on('click', '#asistente', function(element) {
	$(element.target).text('asistente');
});

