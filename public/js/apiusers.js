 $(function () {

    $('#apiusers').DataTable({
      processing: true,
      serverSide: true,
      ajax: route()+'/get_users',
      columns: [
            { data: 'id', name: 'id' },
            { data: 'name', name: 'name' },
            { data: 'email', name: 'email' },
            { data: 'created_at', name: 'created_at' },
            { data: 'updated_at', name: 'updated_at' }
      ]
    });
  });