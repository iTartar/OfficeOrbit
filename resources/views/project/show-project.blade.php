        <!-- Show Modal -->
        <div class="modal fade" id="showModal{{ $row->id }}" tabindex="-1" aria-labelledby="showModalLabel{{ $row->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="showModalLabel{{ $row->id }}">Show Data</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p><strong>Nama:</strong> {{ $row->nama }}</p>
                        <p><strong>Progress:</strong> {{ $row->progress }}</p>
                        <p><strong>Value:</strong> {{ $row->value }}</p>
                        <p><strong>Status:</strong> {{ $row->status }}</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>