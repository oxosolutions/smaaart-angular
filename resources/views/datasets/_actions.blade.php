<!-- <a href="" title="Edit"><span class="fa fa-edit"></span></a> | --> 
<a href="javascript:;" class="delete" data-link="{{route('datasets.delete',$model->id)}}" title="Delete"><span class="fa fa-trash" style='color:red' ></span></a>
| <a href="{{url('/export/csv/table/')}}/{{$model->dataset_table}}" style="width:50px;" class="btn btn-block btn-success disabled btn-xs"  title="Delete"><i class="fa fa-fw fa-cloud-download"></i>csv</a> | <a href="{{url('/export/xlsx/table/')}}/{{$model->dataset_table}}" class=""  title="Delete"><i class="fa fa-fw fa-cloud-download"></i>xlsx</a>  | <a href="{{url('/export/xls/table/')}}/{{$model->dataset_table}}" class=""  title="Delete"><i class="fa fa-fw fa-cloud-download"></i>xls</a>

