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
            { data: 'created_at', name: 'created_at' },
            { data: 'actions', name: 'actions', orderable: false, searchable: false, "className": 'actions' },
      ]
    });
  });