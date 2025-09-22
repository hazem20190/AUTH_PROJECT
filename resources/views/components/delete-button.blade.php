<form action="{{ $href }}" method="post" class="d-inline">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger btn-sm" title="Delete"
        onclick="return confirm('Are you sure you want to delete this item?')">
        <i class="bx bx-trash"></i>
    </button>
</form>
