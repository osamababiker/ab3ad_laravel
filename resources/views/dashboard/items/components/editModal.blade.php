<div class="modal fade" id="editItemModal_{{ $item->id }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"> تحديث بيانات المنتج </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body m-3">
            <form action="{{ route('itemsTable') }}" id="updateForm_{{ $item->id }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="item_id" value="{{ $item->id }}">
                <div class="custom-form-field row">
                    <div class="form-group col-md-6">
                        <label for="name" class="mb"> اسم المنتج </label>
                        <input type="text" value="{{ $item->name }}" name="name" id="name" class="form-control" placeholder="ادخل اسم المنتج هنا">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="categoryId">تصنيف المنتج</label>
                        <select name="categoryId" id="categoryId" class="form-control">
                            <option value="{{ $item->category->id }}">{{ $item->category->name }}</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="price">سعر المنتج</label>
                        <input type="text" value="{{ $item->price }}" name="price" id="price" class="form-control">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="image" class="mb"> صورة  المنتج </label>
                        <input type="file" name="image" id="image" class="form-control" placeholder="ادخل صورة المنتج هنا">
                    </div>
                </div>
            </form>
            </div>
            <div class="modal-footer">
                <button type="submit" name="edit_item_btn" form="updateForm_{{ $item->id }}" class="btn btn-primary"> حفظ التعديلات </button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">اغلاق</button>
            </div>
        </div>
    </div>
</div>

