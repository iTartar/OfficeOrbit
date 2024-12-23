        <!-- Edit Modal -->
        <div class="modal fade" id="editModal{{ $row->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $row->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel{{ $row->id }}">Edit Data</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="/updatedata/{{ $row->id }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="nama{{ $row->id }}" class="form-label">Nama</label>
                                <input type="text" class="form-control" id="nama{{ $row->id }}" name="nama" value="{{ $row->nama }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="progress{{ $row->id }}" class="form-label">Progress</label>
                                <input type="text" class="form-control" id="progress{{ $row->id }}" name="progress" value="{{ $row->progress }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="value{{ $row->id }}" class="form-label">Value</label>
                                <input type="text" class="form-control" id="value{{ $row->id }}" name="value" value="{{ $row->value }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="status{{ $row->id }}" class="form-label">Status</label>
                                <input type="text" class="form-control" id="status{{ $row->id }}" name="status" value="{{ $row->status }}" required>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>