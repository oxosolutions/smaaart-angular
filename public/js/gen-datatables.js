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

    $('body').on('click','.delete', function(){

        if(confirm('Are you sure to delete ?')){

            window.location.href=$(this).attr('data-link');
        }else{

            return true;
        }
    });
  });