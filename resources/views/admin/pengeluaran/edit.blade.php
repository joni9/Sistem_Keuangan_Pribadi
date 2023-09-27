<form method="PUT" action="{{ route('updatepengeluaran', $keuangan->id) }}" class="form-update">
    @csrf
    <div class="form-group">
        <label for="nominal">Nominal</label>
        <input type="number" min="1" name="nominal" id="nominal" class="form-control text-primary" placeholder="Masukkan Nominal Rupiah" value="{{ $keuangan->nominal }}">
        {{-- <label for="jenis" class="mt-2">Jenis</label>
        <input disabled name="labeljenis" id="labeljenis" class="form-control text-primary bg-white" value="Pengeluaran">
        <input type="hidden" name="jenis" id="jenis" value="keluaran"> --}}
        <label for="keterangan" class="mt-2">Keterangan</label>
        <input type="text" name="keterangan" id="keterangan" class="form-control text-primary" placeholder="Keterangan" value="{{ $keuangan->keterangan }}">
        <label for="created_at" class="mt-2">Tanggal</label>
        <input type="date" name="created_at" id="created_at" class="form-control text-primary" value="{{ $keuangan->created_at->format('Y-m-d') }}">
    </div>
    <button type="submit" class="btn btn-primary mt-2">Update</button>
</form>
