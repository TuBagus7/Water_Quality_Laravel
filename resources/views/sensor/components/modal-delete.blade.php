<!-- Modal -->
<div class="modal fade" id="modalDelete-{{ $sensor->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="/sensors/delete/{{ $sensor->id }}" method="post">
            @csrf
            @method('DELETE')
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Data Sensor</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Apakah anda yakin akan menghapus data sensor <span class="fw-bold">{{ $sensor->nama_sensor }}</span> ?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-outline-danger">Ya, Hapus!</button>
                </div>
            </div>
        </form>
    </div>
</div>
