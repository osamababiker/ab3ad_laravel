<div class="modal fade" id="editDriverModal_{{ $driver->id }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"> تحديث حالة المندوب </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body m-3">
            <form action="{{ route('driversTable') }}" id="editDriverForm_{{ $driver->id }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="driverId" value="{{ $driver->id }}">
                <div class="custom-form-field row">
                    <div class="form-group col-6">
                        <label for="isAccepted" class="mb"> حالة المندوب </label>
                        <select name="isAccepted" id="isAccepted">
                            <option value="1"> موافقة </option>
                            <option value="2"> رفض </option>
                        </select>
                    </div>
                </div>
            </form>
            </div>
            <div class="modal-footer">
                <button type="submit" name="editDriverBtn" form="editDriverForm_{{ $driver->id }}" class="btn btn-primary"> حفظ التعديلات </button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">اغلاق</button>
            </div>
        </div>
    </div>
</div>

