var nodeAWithForm = document.querySelectorAll('a[data-has-form]');
aWithForm = Array.prototype.slice.apply(nodeAWithForm);

var nbAWithForm = aWithForm.length

for (var i = 0; i < nbAWithForm; i++)
{
	aWithForm[i].addEventListener('click', function(event)
	{
		event.preventDefault();

		var form = this.previousElementSibling;
		if (form !== null && form.nodeName === 'FORM')
			form.submit();
	})
}