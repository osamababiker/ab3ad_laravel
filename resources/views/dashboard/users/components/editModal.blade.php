<div class="modal fade" id="editUserModal_{{ $user->id }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"> تحديث حساب  {{ $user->name }} </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body m-3">
                <div>
                    <form action="{{ route('usersTable') }}" id="editUserForm_{{ $user->id }}" method="POST">
                        @csrf
                        <input type="hidden" name="userId" value="{{ $user->id }}">
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="isDriver">نوع حساب المستخدم</label>
                                <select name="isDriver" id="isDriver" class="form-control">
                                    @if($user->isDriver == 1)
                                    <option selected value="1">مندوب</option>
                                    <option value="0">عميل </option>
                                    @else
                                    <option selected value="0"> عميل</option>
                                    <option value="1">مندوب</option>
                                    @endif
                                </select>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="role">صلاحية الوصول للوحة التحكم  </label>
                                <select name="role" id="role" class="form-control">
                                    @if($user->role == 1)
                                    <option selected value="1">أدمن</option>
                                    <option value="0">مستخدم عادي</option>
                                    @else
                                    <option selected value="0">مستخدم عادي</option>
                                    <option value="1">أدمن</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" name="editUserBtn" form="editUserForm_{{ $user->id }}" class="btn btn-primary"> حفظ التعديلات </button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">اغلاق</button>
            </div>
        </div>
    </div>
</div>
