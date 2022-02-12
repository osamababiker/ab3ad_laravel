<div class="modal fade" id="editCategoryModal_{{ $category->id }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"> تحديث بيانات التصنيف </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body m-3">
            <form action="{{ route('categoriesTable') }}" id="editCategoryForm_{{ $category->id }}"" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="categoryId" value="{{ $category->id }}">
                <div class="custom-form-field row">
                    <div class="form-group col-6">
                        <label for="name" class="mb"> اسم التصنيف </label>
                        <input type="text" value="{{ $category->name }}" name="name" id="name" class="form-control" placeholder="ادخل اسم التصنيف هنا">
                    </div>
                    <div class="form-group col-6">
                        <label for="image" class="mb"> صورة  التصنيف </label>
                        <input type="file" value="{{ $category->image }}" name="image" id="image" class="form-control" placeholder="ادخل صورة التصنيف هنا">
                    </div>

                </div>
            </form>
            </div>
            <div class="modal-footer">
                <button type="submit" name="editCategoryBtn" form="editCategoryForm_{{ $category->id }}" class="btn btn-primary"> حفظ التعديلات </button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">اغلاق</button>
            </div>
        </div>
    </div>
</div>

