 $(function () {

    $('#apiusers').DataTable({
      processing: true,
      serverSide: true,
      ajax: route()+'/get_users',
      columns: [
            { data: 'id', name: 'id' },
            { data: 'name', name: 'name' },
            { data: 'email', name: 'email' },
            { data: 'api_token', name: 'token' },
            { data: 'created_at', name: 'created_at' },
            { data: 'updated_at', name: 'updated_at' },
            { data: 'actions', name: 'actions', orderable: false, searchable: false, "className": 'actions' },
      ]
    });


    $('#departments').DataTable({
      processing: true,
      serverSide: true,
      ajax: route()+'/list_depart',
      columns: [
            { data: 'id', name: 'id' },
            { data: 'dep_code', name: 'dep_code' },
            { data: 'dep_name', name: 'dep_name' },
            { data: 'created_by', name: 'created_by' },
            { data: 'created_at', name: 'created_at' },
            { data: 'updated_at', name: 'created_at' },
            { data: 'actions', name: 'actions', orderable: false, searchable: false, "className": 'actions' },
      ]
    });

    $('#designations').DataTable({
      processing: true,
      serverSide: true,
      ajax: route()+'/list_desig',
      columns: [
            { data: 'id', name: 'id' },
            { data: 'designation', name: 'designation' },
            { data: 'created_at', name: 'created_at' },
            { data: 'updated_at', name: 'created_at' },
            { data: 'actions', name: 'actions', orderable: false, searchable: false, "className": 'actions' },
      ]
    });

    $('#ministry').DataTable({
      processing: true,
      serverSide: true,
      ajax: route()+'/list_minist',
      columns: [
            { data: 'ministry_id', name: 'ministry_id' },
            { data: 'ministry_title', name: 'ministry_title' },
            { data: 'ministry_description', name: 'ministry_description' },
            { data: 'ministry_phone', name: 'ministry_phone' },
            { data: 'ministry_ministers', name: 'ministry_ministers' },
            { data: 'created_by', name: 'created_by' },
            { data: 'created_at', name: 'created_at' },
            { data: 'actions', name: 'actions', orderable: false, searchable: false, "className": 'actions' },
      ]
    });

    $('#goals').DataTable({
      processing: true,
      serverSide: true,
      ajax: route()+'/list_goals',
      columns: [
            { data: 'goal_number', name: 'goal_number' },
            { data: 'goal_title', name: 'goal_title' },
            { data: 'goal_tagline', name: 'goal_tagline' },
            { data: 'goal_url', name: 'goal_url' },
            { data: 'goal_icon', name: 'goal_icon' },
            { data: 'created_by', name: 'created_by' },
            { data: 'created_at', name: 'created_at' },
            { data: 'actions', name: 'actions', orderable: false, searchable: false, "className": 'actions' },
      ]
    });

    $('#schema').DataTable({
      processing: true,
      serverSide: true,
      ajax: route()+'/schema_list',
      columns: [
            { data: 'id', name: 'id' },
            { data: 'schema_id', name: 'schema_id' },
            { data: 'schema_title', name: 'schema_title' },
            { data: 'schema_desc', name: 'schema_desc' },
            { data: 'created_by', name: 'created_by' },
            { data: 'created_at', name: 'created_at' },
            { data: 'actions', name: 'actions', orderable: false, searchable: false, "className": 'actions' },
      ]
    });

    $('#Intervention').DataTable({
      processing: true,
      serverSide: true,
      ajax: route()+'/intervention_list',
      columns: [
            { data: 'id', name: 'id' },
            { data: 'intervent_id', name: 'intervent_id' },
            { data: 'intervent_title', name: 'intervent_title' },
            { data: 'intervent_desc', name: 'intervent_desc' },
            { data: 'created_by', name: 'created_by' },
            { data: 'created_at', name: 'created_at' },
            { data: 'actions', name: 'actions', orderable: false, searchable: false, "className": 'actions' },
      ]
    });


    $('#target').DataTable({
      processing: true,
      serverSide: true,
      ajax: route()+'/target_list',
      columns: [
            { data: 'id', name: 'id' },
            { data: 'target_id', name: 'target_id' },
            { data: 'target_title', name: 'target_title' },
            { data: 'target_desc', name: 'target_desc' },
            { data: 'created_by', name: 'created_by' },
            { data: 'created_at', name: 'created_at' },
            { data: 'actions', name: 'actions', orderable: false, searchable: false, "className": 'actions' },
      ]
    });

    $('#resource').DataTable({
      processing: true,
      serverSide: true,
      ajax: route()+'/resource_list',
      columns: [
            { data: 'id', name: 'id' },
            { data: 'resource_id', name: 'resource_id' },
            { data: 'resource_title', name: 'resource_title' },
            { data: 'resource_desc', name: 'resource_desc' },
            { data: 'created_by', name: 'created_by' },
            { data: 'created_at', name: 'created_at' },
            { data: 'actions', name: 'actions', orderable: false, searchable: false, "className": 'actions' },
      ]
    });

    $('#indicator').DataTable({
      processing: true,
      serverSide: true,
      ajax: route()+'/indicators_list',
      columns: [
            { data: 'id', name: 'id' },
            { data: 'indicator_title', name: 'indicator_title' },
            { data: 'targets_id', name: 'targets_id' },
            { data: 'created_by', name: 'created_by' },
            { data: 'created_at', name: 'created_at' },
            { data: 'actions', name: 'actions', orderable: false, searchable: false, "className": 'actions' },
      ]
    });
    $('#pages').DataTable({
      processing: true,
      serverSide: true,
      ajax: route()+'/pages_list',
      columns: [
            { data: 'id', name: 'id' },
            { data: 'page_title', name: 'page_title' },
            { data: 'page_slug', name: 'page_slug' },
            { data: 'content', name: 'content' },
            { data: 'page_image', name: 'page_image' },
            { data: 'status', name: 'status' },
            { data: 'created_by', name: 'created_by' },
            { data: 'created_at', name: 'created_at' },
            { data: 'actions', name: 'actions', orderable: false, searchable: false, "className": 'actions' },
      ]
    });

    $('#visualisations').DataTable({
      processing: true,
      serverSide: true,
      ajax: route()+'/visualisation_list',
      columns: [
            { data: 'id', name: 'id' },
            { data: 'dataset_id', name: 'dataset_id' },
            { data: 'visual_name', name: 'visual_name' },
            { data: 'settings', name: 'settings' },
            { data: 'options', name: 'options' },
            { data: 'created_by', name: 'created_by' },
            { data: 'created_at', name: 'created_at' },
            { data: 'actions', name: 'actions', orderable: false, searchable: false, "className": 'actions' },
      ]
    });

    $('#datasets').DataTable({
      processing: true,
      serverSide: true,
      ajax: route()+'/dataset_list',
      columns: [
            { data: 'id', name: 'id' },
            { data: 'dataset_name', name: 'dataset_name' },
            { data: 'dataset_records', name: 'dataset_records' },
            { data: 'user_id', name: 'user_id' },
            { data: 'created_at', name: 'created_at' },
            { data: 'updated_at', name: 'updated_at' },
            { data: 'actions', name: 'actions', orderable: false, searchable: false, "className": 'actions' },
      ]
    });

     $('#roles').DataTable({
      processing: true,
      serverSide: true,
      ajax: route()+'/list_roles',
      columns: [
            { data: 'name', name: 'name' },
            { data: 'display_name', name: 'display_name' },
            { data: 'description', name: 'description' },
            { data: 'created_at', name: 'created_at' },
            { data: 'actions', name: 'actions', orderable: false, searchable: false, "className": 'actions' },
      ]
    });



     $('#permisson').DataTable({
      processing: true,
      serverSide: true,
      ajax: route()+'/list_permisson',
      columns: [
            { data: 'name', name: 'name' },
            { data: 'display_name', name: 'display_name' },
            { data: 'route', name: 'route' },
            { data: 'created_at', name: 'created_at' },
            { data: 'actions', name: 'actions', orderable: false, searchable: false, "className": 'actions' },
      ]
    });

     $('#setting').DataTable({
      processing: true,
      serverSide: true,
      ajax: route()+'/list_setting',
      columns: [
            { data: 'name', name: 'name' },
            { data: 'display_name', name: 'display_name' },
            { data: 'created_at', name: 'created_at' },
            { data: 'actions', name: 'actions', orderable: false, searchable: false, "className": 'actions' },
      ]
    });
     

    $('body').on('click','.delete', function(){

        if(confirm('Are you sure to delete ?')){

            window.location.href=$(this).attr('data-link');
        }else{

            return true;
        }
    });
  });
