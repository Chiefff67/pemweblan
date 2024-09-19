<script type="text/javascript" src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script type="text/javascript" src="https://rawgit.com/notifyjs/notifyjs/master/dist/notify.js"></script>
<script type="text/javascript" src="//cdn.datatables.net/2.1.6/js/dataTables.min.js"></script>
<link rel="stylesheet" href="//cdn.datatables.net/2.1.6/css/dataTables.dataTables.min.css">

<table id="example" class="display" style="width:100%">
    <thead>
        <tr>
            <th>Username</th>
            <th>Password</th>
            <th>Name</th>
        </tr>
    </thead>
    <tbody>

    </tbody>
</table>

<script>
    $(document).ready(function() {
        var table = $('#example').DataTable({
            "processing": true,
            "responsive": true,
            "serverSide": true,
            "ordering": true, // Set true agar bisa di sorting
            "order": [
                [0, 'asc']
            ], // Default sortingnya berdasarkan kolom / field ke 0 (paling pertama)
            "ajax": {
                "url": "server.php", // URL file untuk proses select datanya
                "type": "POST",
            },
            "deferRender": true,
            "aLengthMenu": [
                [5, 10, 50],
                [5, 10, 50]
            ], // Combobox Limit
            "columns": [{
                    "data": "username"
                },
                {
                    "data": "password"
                },
                {
                    "data": "name"
                },
            ],
        });
    });
</script>