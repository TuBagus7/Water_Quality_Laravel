<!-- Modal -->
<div class="modal fade" id="modalDelete-{{ $device->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="/devices/delete/{{ $device->id }}" method="post">
            @csrf
            @method('DELETE')
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Data Device</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Apakah anda yakin akan menghapus data device <span class="fw-bold">{{ $device->serial_number }}</span> ?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-outline-danger">Ya, Hapus!</button>
                </div>
            </div>
        </form>
    </div>
</div>
