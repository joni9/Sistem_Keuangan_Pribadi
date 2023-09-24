@extends('layouts.app')
@section('content')

        <div class="row">
            <div class="col-md-12">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" onclick="create()">
                  Tambah Pemasukan
                </button>
            <div class="card ">
              <div class="card-header">
                <h4 class="card-title"> Info Pemasukan {{ $user->name }}</h4>
              </div>

              <div class="card-body">
                <div class="table-responsive">
                  <table class="table tablesorter datatable responsive" id="table_pemasukan">
                    <thead class=" text-primary">
                      <tr>
                        <th>
                          No
                        </th>
                        <th>
                          Nominal
                        </th>
                        <th>
                          Jenis
                        </th>
                        <th class="text-center">
                          Keterangan
                        </th>
                        <th class="text-center">
                          Aksi
                        </th>
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
    $.ajax({
        url: url,
        method: method,
         data: {
              _token: '{{ csrf_token() }}',
                nominal: nominal,
                keterangan: keterangan,
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