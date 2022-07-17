<div class="modal fade" id="deleteRequestModal_{{ $request->id }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"> هل انت متأكد من رغبتك في حذف على الطلب </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body m-3">
                <p class="mb-0"> هل انت متأكد من رغبتك في حذف هذا الطلب  </p>
                <form action="{{ route('requestsTable') }}" id="deleteRequestForm_{{ $request->id }}" method="POST">
                    @csrf
                    <input type="hidden" name="requestId" value="{{ $request->id }}">
                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" name="delete_btn" form="deleteRequestForm_{{ $request->id }}" class="btn btn-warning"> نعم متأكد </button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">اغلاق</button>
            </div>
        </div>
    </div>
</div>
