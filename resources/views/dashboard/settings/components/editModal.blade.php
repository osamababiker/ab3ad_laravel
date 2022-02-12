<div class="modal fade" id="editInfoModal_{{ $info->id }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"> تحديث بيانات التطبيق </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body m-3">
            <form action="{{ route('settingsTable') }}" id="settingForm_{{ $info->id }}"  method="POST">
                <input type="hidden" name="settingsId" value="{{ $info->id }}">
                @csrf
                    <div class="custom-form-field row">
                        <div class="form-group col-6">
                            <label for="appName" class="mb"> اسم التطبيق </label>
                            <input type="text" value="{{ $info->appName }}" id="appName" value="{{ $info->appName }}" name="appName" class="form-control">
                        </div>
                        <div class="form-group col-6">
                            <label for="appVersion" class="mb"> اصدار التطبيق  </label>
                            <input type="text" value="{{ $info->appVersion }}" id="appVersion" name="appVersion" class="form-control">
                        </div>
                        <div class="form-group col-6">
                            <label for="email" class="mb">  الايميل  </label>
                            <input type="text" value="{{ $info->email }}" id="email" name="email" class="form-control">
                        </div>
                        <div class="form-group col-6">
                            <label for="phone" class="mb">  رقم الهاتف  </label>
                            <input type="text" value="{{ $info->phone }}" id="phone" name="phone" class="form-control">
                        </div>
                        <div class="form-group col-12">
                            <label for="address" class="mb">   العنوان  </label>
                            <input type="text" value="{{ $info->address }}" id="address" name="address" class="form-control">
                        </div>
                        <div class="form-group col-12">
                            <label for="address" class="mb">    سعر توصيل للكيلو  </label>
                            <input type="number" value="{{ $info->price_for_k }}" id="price_for_k" name="price_for_k" class="form-control">
                        </div>
                        <div class="form-group col-12">
                            <label for="policy" class="mb">   سياسة الاستخدام والخصوصية  </label>
                            <textarea id="policy" name="policy" class="form-control">{{ $info->policy }}</textarea>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" name="editSettingsBtn" form="settingForm_{{ $info->id }}" class="btn btn-primary"> حفظ التعديلات </button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">اغلاق</button>
            </div>
        </div>
    </div>
</div>
