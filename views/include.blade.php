@php(session()->flash('adminmenu_include', true))
@endphp

@section('adminmenu_stylesheets')
    @parent

    <style>
        .adminmenu_form
        {
            display: none;
        }

        .adminmenu_item
        {
            list-style-type: none;
        }
    </style>
@endsection

@section('adminmenu_scripts')
    @parent

    <script type="text/javascript">
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
    </script>
@endsection