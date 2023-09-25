    <div class="row mx-4 mt-4">
        <div class="col-md-3">
            <div class="card border border-info  shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header bg-info py-3 text-center">
                    <h6 class="text-center font-weight-bold">PENGELUARAN BULAN INI</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <h4 class="text-center">Rp {{ number_format($pengeluaranbulan, 0, ',', '.') }}</h4>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card border border-danger shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header bg-danger py-3 text-center">
                    <h6 class="text-center font-weight-bold">SEMUA PENGELUARAN</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <h4  class="text-center">Rp {{ number_format($semuapengeluaran, 0, ',', '.') }}</h4>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border border-warning shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header bg-warning py-3 text-center">
                    <h6 class="text-center font-weight-bold">PENGELUARAN TAHUN INI</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <h4  class="text-center">Rp {{ number_format($pengeluarantahun, 0, ',', '.') }}</h4>
                </div>
            </div>
        </div>
        
    </div>