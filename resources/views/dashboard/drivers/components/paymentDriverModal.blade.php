<div class="modal fade" id="paymentDriverModal_{{ $driver->id }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"> ادخال مدفوع جديد  </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body m-3">
            <form action="{{ route('driversTable') }}" id="addPaymentForm_{{ $driver->id }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="driverId" value="{{ $driver->id }}">
                <div class="custom-form-field row">
                    <div class="form-group col-md-12">
                        <label for="amount" class="mb">  اجمالي المبلغ المدفوع </label>
                        <input  id="amount" type="number" class="form-control" name="amount">
                    </div>
                </div>
            </form>
            </div>
            <div class="modal-footer">
                <button type="submit" name="addPaymentBtn" form="addPaymentForm_{{ $driver->id }}" class="btn btn-primary">  اضافة </button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">اغلاق</button>
            </div>
        </div>
    </div>
</div>

