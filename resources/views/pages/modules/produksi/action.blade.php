<a href="{{ url('/pages/produksi/' . $row->id . '/edit') }}"
    class="btn btn-warning btn-sm">
    <i class="fas fa-edit"></i> Edit
</a>

<form action="{{ url('/pages/produksi/' . $row->id) }}"
    method="POST"
    class="d-inline"
    onsubmit="return confirm('Apakah Anda yakin ingin menghapus data produksi ini?')">

    @csrf
    @method('DELETE')

    <button type="submit" class="btn btn-danger btn-sm">
        <i class="fas fa-trash"></i> Hapus
    </button>

</form>