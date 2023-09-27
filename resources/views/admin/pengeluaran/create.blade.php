<form method="POST" action="{{ route('storepengeluaran') }}">
    @csrf
    <div class="form-group">
        <label for="nominal">Nominal</label>
        <input type="number" required min="1" name="nominal" id="nominal" class="form-control text-primary" placeholder="Masukkan Nominal Rupiah">
        <input type="hidden" name="jenis" id="jenis" value="keluaran">
        <label for="keterangan" class="mt-2">Keterangan</label>
        <input type="text" required name="keterangan" id="keterangan" class="form-control text-primary" placeholder="Keterangan">
        <label for="created_at" class="mt-2">Tanggal</label>
        <input type="date" name="created_at" id="created_at" class="form-control text-primary">
    </div>
<button type="button" id="savebutton" class="btn btn-primary mt-2" onclick="store()">Save changes</button>
</form>


