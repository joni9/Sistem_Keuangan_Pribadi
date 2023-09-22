@extends('layouts.app')
@section('content')
        <div class="row">
            <div class="col-md-12">
            <div class="card ">
              <div class="card-header">
                <h4 class="card-title"> Info Semua Keuangan {{ $user->name }}</h4>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table tablesorter datatable responsive" id="table_keuangan">
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
{{-- datatable --}}
<script>
    $(document).ready(function () {
        $('#table_keuangan').DataTable({
            serverSide: true,
            processing: true,
            ajax: {
                'url': "{{ route('table_keuangan') }}",
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
</script>
@endsection