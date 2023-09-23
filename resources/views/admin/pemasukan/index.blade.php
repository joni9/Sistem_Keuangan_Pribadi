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
        <h3 class="modal-title fs-5 text-center" id="exampleModalLabel">Tambah Pemasukan</h3>
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
            $(".btn-close").click();
        },
        error: function (xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
}

</script>
@endsection