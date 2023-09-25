@extends('layouts.app')
@section('content')
        <div class="row">
            <div class="col-md-12">
            <div class="card ">
              <div class="card-header">
                <h4 class="card-title"> Info Semua Keuangan {{ $user->name }}</h4>
              </div>

              <div id="show-info-saldo">

              </div>

              <div class="row mx-2">
                <div class="col-md-6 mt-4">
                        <div class="form-group">
                            <label>TANGGAL AWAL</label>
                            <input type="date" id="start_date" name="start_date" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6 mt-4">
                        <div class="form-group">
                            <label>TANGGAL AKHIR</label>
                            <input type="date" id="end_date" name="end_date" class="form-control">
                        </div>
                    </div>
              </div>

              <div class="card-body">
                <div class="table-responsive">
                  <table class="table tablesorter datatable responsive" id="table_keuangan">
                    <thead class=" text-primary">
                      <tr>
                        <th>No</th>
                        <th>Nominal</th>
                        <th>Jenis</th>
                        <th> Keterangan</th>
                        <th>Tanggal</th>
                      </tr>
                    </thead>
                    <tbody>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
{{-- datatable --}}
<script>
    $(document).ready(function () {
        $('#table_keuangan').DataTable({
            serverSide: true,
            processing: true,
            ajax: {
                'url': "{{ route('table_keuangan') }}",
                'data': function (d) {
                    d.start_date = $('#start_date').val(); // ambil nilai tanggal awal
                    d.end_date = $('#end_date').val(); // ambil nilai tanggal akhir
                }
            },
            columns: [
                {
                    data: 'No',
                    name: 'No',
                    orderable: false,
                    searchable: false,
                },
                { 
                    data: 'nominal', 
                    name: 'nominal',
                },
                { 
                    data: 'jenis', 
                    name: 'jenis',
                },
                { 
                    data: 'keterangan', 
                    name: 'keterangan',
                },
                { 
                    data: 'created_at', 
                    name: 'created_at',
                },
            ],
            lengthMenu: [[10, 25, 50, 100, 200, 500, 1000], [10, 25, 50, 100, 200, 500, 1000]],
            
        });

        $('#start_date, #end_date').change(function () {
            reloadTable('#table_keuangan');
            show();
        });
    });

    //untuk menampilkan modal halaman create
    function show() {
    var startDate = $("#start_date").val();
    var endDate = $("#end_date").val();
        $.get("{{ route('showsaldo') }}", { start_date: startDate, end_date: endDate }, function(data, status) {
            $("#show-info-saldo").html(data);
        });
    }
    show();


     //fungsi reload
    function reloadTable(id) {
        var table = $(id).DataTable();
        table.cleanData;
        table.ajax.reload();
    }
</script>
@endsection