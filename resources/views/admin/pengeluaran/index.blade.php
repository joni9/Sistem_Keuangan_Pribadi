@extends('layouts.app')
@section('content')

        <div class="row">
            <div class="col-md-12">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" onclick="create()">
                  + Tambah Pengeluaran
                </button>
            <div class="card ">
              <div class="card-header">
                <h4 class="card-title"> Info Pengeluaran {{ $user->name }}</h4>
              </div>

              <div id="show-info-pengeluaran">

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
                  <table class="table tablesorter datatable responsive" id="table_pengeluaran">
                    <thead class=" text-primary">
                      <tr>
                        <th>No</th>
                        <th>Nominal</th>
                        <th>Jenis</th>
                        <th> Keterangan</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
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


<!-- Modal -->
<div class="modal fade" id="TambahPengeluaranModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title fs-5 text-center" id="NamaLabelModal"></h3>
        <div type="button" class="btn btn-secondary btn-sm btn-close"" data-bs-dismiss="modal">x</div>
      </div>
      <div class="modal-body">
        <div id="page"></div>
      </div>

    </div>
  </div>
</div>


{{-- datatable --}}
<script>
    $(document).ready(function () {
        $('#table_pengeluaran').DataTable({
            serverSide: true,
            processing: true,
            ajax: {
                'url': "{{ route('table_pengeluaran') }}",
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
                { 
                    data: 'aksi', 
                    name: 'aksi', 
                    searchable: false,
                },
            ],
            lengthMenu: [[10, 25, 50, 100, 200, 500, 1000], [10, 25, 50, 100, 200, 500, 1000]],
            
        });

        $('#start_date, #end_date').change(function () {
            reloadTable('#table_pengeluaran');
            show();
        });
    });

    //untuk menampilkan modal halaman create
    function create(){
      $.get("{{ route('createpengeluaran') }}", {}, function(data, status){
        $("#NamaLabelModal").html('Tambah Pengeluaran');
        $("#page").html(data);
        $("#TambahPengeluaranModal").modal('show');
      });
    }

    //fungsi untuk menyimpan data create
    function store() {
        // Mendapatkan referensi ke tombol
        var saveButton = document.getElementById('savebutton');
        // Nonaktifkan tombol
        saveButton.disabled = true;
        
        var nominal = $("#nominal").val();
        var jenis = $("#jenis").val();
        var keterangan = $("#keterangan").val();
        var created_at = $("#created_at").val();
        $.ajax({
            type: "POST", // Menggunakan metode POST
            url: "{{ route('storepengeluaran') }}",
            data: {
              _token: '{{ csrf_token() }}',
                nominal: nominal,
                jenis: jenis,
                keterangan: keterangan,
                created_at: created_at,
            },
            success: function (data) {
                Swal.fire({
                    title: 'Sukses',
                    text: 'Data berhasil ditambahkan',
                    icon: 'success',
                    showConfirmButton: false, // Menghilangkan tombol "OK"
                    timer: 1500 // Menampilkan pesan selama 2 detik
                });
                $(".btn-close").click();
                reloadTable('#table_pengeluaran');
                show();
            },
            error: function (xhr) {
                var errors = xhr.responseJSON.errors;
                var errorMessages = [];

                for (var key in errors) {
                    errorMessages.push(errors[key][0]);
                }
                saveButton.disabled = false;
                // Tampilkan pesan kesalahan dalam modal atau di tempat yang sesuai
                alert(errorMessages.join("\n"));
            }
        });
    }

    //untuk menampilkan modal halaman create
    function show() {
    var startDate = $("#start_date").val();
    var endDate = $("#end_date").val();
        $.get("{{ route('showpengeluaran') }}", { start_date: startDate, end_date: endDate }, function(data, status) {
            $("#show-info-pengeluaran").html(data);
        });
    }
    show();

    //edit data
    $(document).on('submit', '.form-edit', function(e) {
        e.preventDefault();

        var form = $(this);
        var url = form.attr('action');
        var method = form.attr('method');
        $.ajax({
            url: url,
            method: method,
            data: form.serialize(),
            success: function(response) {
                $('#NamaLabelModal').text('Edit pengeluaran');
                $('#page').html(response);
                $('#TambahPengeluaranModal').modal('show');
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
            }
        });
    });

    //update data
    $(document).on('submit', '.form-update', function(e) {
        e.preventDefault();

        var form = $(this);
        var url = form.attr('action');
        var method = form.attr('method');
        var nominal = $("#nominal").val();
        var keterangan = $("#keterangan").val();
        var created_at = $("#created_at").val();
        $.ajax({
            url: url,
            method: method,
            data: {
                  _token: '{{ csrf_token() }}',
                    nominal: nominal,
                    keterangan: keterangan,
                    created_at: created_at,
                },
            success: function(response) {
                Swal.fire({
                        title: 'Sukses',
                        text: 'Data berhasil diupdate',
                        icon: 'success',
                        showConfirmButton: false, // Menghilangkan tombol "OK"
                        timer: 1500 // Menampilkan pesan selama 2 detik
                    });
                    $(".btn-close").click();
                    reloadTable('#table_pengeluaran');
                    show();
            },
            error: function(xhr, status, error) {
                var errorResponse = JSON.parse(xhr.responseText);
                var errorMessages = [];

                if (errorResponse.errors) {
                    for (var key in errorResponse.errors) {
                        errorMessages.push(errorResponse.errors[key][0]);
                    }
                } else {
                    errorMessages.push('Terjadi kesalahan saat memproses permintaan');
                }
                // Menampilkan pesan kesalahan menggunakan alert
                alert(errorMessages.join('\n'));
            }
        });
    });

    //delete data
    $(document).on('submit', '.form-delete', function(e) {
        e.preventDefault();

        var form = $(this);
        var url = form.attr('action');
        var method = form.attr('method');

        Swal.fire({
            title: 'Konfirmasi',
            text: 'Apakah Anda yakin ingin menghapus data ini?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: url,
                    method: method,
                    data: form.serialize(),
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Sukses',
                            text: 'Data berhasil dihapus',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        reloadTable('#table_pengeluaran');
                        show();
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr.responseText);
                    }
                });
            }
        });
    });


    //fungsi reload
    function reloadTable(id) {
        var table = $(id).DataTable();
        table.cleanData;
        table.ajax.reload();
    }

</script>
@endsection