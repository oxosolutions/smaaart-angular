<!-- jQuery 2.2.3 -->
<script src="{{asset('/bower_components/admin-lte/plugins/jQuery/jquery-2.2.3.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.6 -->
<script src="{{asset('/bower_components/admin-lte/bootstrap/js/bootstrap.min.js')}}"></script>
<!-- Morris.js charts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>


<script type="text/javascript">
	function route(){
		return '{{url("/")}}';
	}
</script>

<!--Include Plugin -->
@if(@$js)
	@foreach(@$js as $key => $file)
		@include('components.plugins.js.'.$file)
	@endforeach
@endif

<!-- daterangepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>

<!-- Slimscroll -->
<script src="{{asset('/bower_components/admin-lte/plugins/slimScroll/jquery.slimscroll.min.js')}}"></script>
<!-- FastClick -->
<script src="{{asset('/bower_components/admin-lte/plugins/fastclick/fastclick.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('/bower_components/admin-lte/dist/js/app.min.js')}}"></script>

<!-- <script src="{{asset('/bower_components/admin-lte/dist/js/pages/dashboard.js')}}"></script> -->

<script src="{{asset('/bower_components/admin-lte/dist/js/demo.js')}}"></script>

 <script type="text/javascript">
  	$(document).ready(function(){
      var rand = function() {
          return Math.random().toString(36).substr(2); // remove `0.`
      };

      var token = function() {
          return rand() + rand() + rand(); // to make it longer
      };

      $('.generate-token').click(function(){

      		$('#token').val(token());
      });
      $('#token').val(token());
      
  });
 </script>