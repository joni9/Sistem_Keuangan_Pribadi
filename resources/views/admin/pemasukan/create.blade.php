<form method="POST" action="{{ route('storepemasukan') }}">
    @csrf
    <div class="form-group">
    <label for="nominal">Nominal</label>
    <input type="number" min="1" name="nominal" id="nominal" class="form-control text-primary" placeholder="Masukkan Nominal Rupiah">
    <label for="jenis" class="mt-2">Jenis</label>
    <input disabled name="labeljenis" id="labeljenis" class="form-control text-primary bg-white" value="Pemasukan">
    <input type="hidden" name="jenis" id="jenis" value="pemasukan">
    <label for="keterangan" class="mt-2">Keterangan</label>
    <input type="text" name="keterangan" id="keterangan" class="form-control text-primary" placeholder="Keterangan">
    
</div>
<button type="button" class="btn btn-primary mt-2" onclick="store()">Save changes</button>
</form>


