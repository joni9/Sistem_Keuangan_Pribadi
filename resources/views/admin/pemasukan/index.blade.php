@extends('layouts.app')
@section('content')

        <div class="row">
            <div class="col-md-12">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary btn-md" onclick="create()">
                + Tambah Pemasukan
                </button>
            <div class="card ">
              <div class="card-header">
                <h4 class="card-title"> Info Pemasukan {{ $user->name }}</h4>
              </div>

              <div id="show-info-pemasukan">

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
                  <table class="table tablesorter datatable responsive" id="table_pemasukan">
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
<div class="modal fade" id="TambahPemasukanModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
        $('#table_pemasukan').DataTable({
            serverSide: true,
            processing: true,
            ajax: {
                'url': "{{ route('table_pemasukan') }}",
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
            reloadTable('#table_pemasukan');
        });
        
    });

    //untuk menampilkan modal halaman create
    function create(){
      $.get("{{ route('createpemasukan') }}", {}, function(data, status){
        $("#NamaLabelModal").html('Tambah Pemasukan');
        $("#page").html(data);
        $("#TambahPemasukanModal").modal('show');
      });
    }

    //fungsi untuk menyimpan data create
    function store() {
        var nominal = $("#nominal").val();
        var jenis = $("#jenis").val();
        var keterangan = $("#keterangan").val();
        $.ajax({
            type: "POST", // Menggunakan metode POST
            url: "{{ route('storepemasukan') }}",
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
                reloadTable('#table_pemasukan');
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }

    //untuk menampilkan show
    function show(){
      $.get("{{ route('showpemasukan') }}", {}, function(data, status){
        $("#show-info-pemasukan").html(data);
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
                $('#NamaLabelModal').text('Edit Pemasukan');
                $('#page').html(response);
                $('#TambahPemasukanModal').modal('show');
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
                    reloadTable('#table_pemasukan');
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
                        reloadTable('#table_pemasukan');
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