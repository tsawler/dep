@if((Session::has('message')) || (Session::has('error')) || (Session::has('status')))
	
	@if(Session::has('message'))
		<script>
		x = "{{ Session::get('message') }}";
		$.pnotify({
	        icon: false,
	        type: 'success',
	        text: x,
	        nonblock: true,
			nonblock_opacity: .2
	    });
		</script>
	@endif
	@if (Session::has('error'))
		<script>
		x = "{{ Session::get('error') }}";
		$.pnotify({
	        type: 'error',
	        icon: false,
	        text: x,
	        nonblock: true,
			nonblock_opacity: .2
	    });
		</script>
	@endif
	@if (Session::has('status'))
		<script>
		x = "{{ Session::get('status') }}";
		$.pnotify({
	        icon: false,
	        type: 'Info',
	        text: x,
	        nonblock: true,
			nonblock_opacity: .2
	    });
		</script>
	@endif
@endif