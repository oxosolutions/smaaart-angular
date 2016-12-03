@foreach(glob("js/*.js") as $file)
	<script type="text/javascript" src="{{asset($file)}}"></script>
@endforeach