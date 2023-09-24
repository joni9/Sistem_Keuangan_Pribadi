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
        var nominal = $("#nominal").val();
        var jenis = $("#jenis").val();
        var keterangan = $("#keterangan").val();
        $.ajax({
            type: "POST", // Menggunakan metode POST
            url: "{{ route('storepengeluaran') }}",
            data: {
              _token: '{{ csrf_token() }}',
                nominal: nominal,
                jenis: jenis,
                keterangan: keterangan,
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
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }

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
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
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