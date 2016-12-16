<script src="{{asset('/bower_components/admin-lte/plugins/jQuery/jquery-2.2.3.min.js')}}"></script>
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<script src="{{asset('/bower_components/admin-lte/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>

<script type="text/javascript">
	function route(){
		return '{{url("/")}}';
	}
</script>

@if(@$js)
	@foreach(@$js as $key => $file)
    @if(is_array($file))
      @foreach(@$file as $iKey => $iVal)
        <script type="text/javascript" src="{{asset('js/'.$iVal.'.js')}}?ref={{rand(8899,9999)}}"></script>
      @endforeach
    @else
		  @include('components.plugins.js.'.$file)
    @endif
	@endforeach
@endif

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>

<script src="{{asset('/bower_components/admin-lte/plugins/slimScroll/jquery.slimscroll.min.js')}}"></script>
<script src="{{asset('/bower_components/admin-lte/plugins/fastclick/fastclick.js')}}"></script>
<script src="{{asset('/bower_components/admin-lte/dist/js/app.min.js')}}"></script>

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

      $("#filter").keyup(function () {
            var filter = jQuery(this).val();
            jQuery(".filtered > li").each(function () {
                if (jQuery(this).text().search(new RegExp(filter, "i")) < 0) {
                    jQuery(this).hide();
                } else {
                    jQuery(this).show()
                }
            });
      });

      $('#search-btn').click(function(e){
          e.preventDefault();
      });
  });
 </script>
