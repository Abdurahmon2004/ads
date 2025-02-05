<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalTitle">Edit Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editProductForm" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="id" id="editCategoryId">
                    <ul class="nav nav-tabs" id="languageTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="uz-tab" data-toggle="tab" href="#uzz" role="tab" aria-controls="uz" aria-selected="true">Uz</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="en-tab" data-toggle="tab" href="#enz" role="tab" aria-controls="en" aria-selected="false">En</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="ru-tab" data-toggle="tab" href="#ruz" role="tab" aria-controls="ru" aria-selected="false">Ru</a>
                        </li>
                    </ul>

                    <div class="tab-content" id="languageTabContent">
                        <div class="tab-pane fade show active" id="uzz" role="tabpanel" aria-labelledby="uz-tab">
                            <label for="site_name_uz">Nomi [uz]</label>
                            <input type="text" class="form-control" id="edit_name_uz" name="uz" required>
                        </div>
                        <div class="tab-pane fade" id="enz" role="tabpanel" aria-labelledby="en-tab" >
                            <label for="site_name_en">Nomi [en]</label>
                            <input type="text" class="form-control" id="edit_name_en" name="en" required>
                        </div>
                        <div class="tab-pane fade" id="ruz" role="tabpanel" aria-labelledby="ru-tab">
                            <label for="site_name_ru">Nomi [ru]</label>
                            <input type="text" class="form-control" id="edit_name_ru" name="ru" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="Rasmi">Rasmi</label><br>
                        <input type="file" class="form-control" name="image" accept="image/*">
                    </div>
                    <div class="mb-3">
                        <label for="edit_status" class="form-label">Holati</label><br>
                        <input type="checkbox" value="1" id="edit_status" name="status" data-bootstrap-switch>
                    </div>
                    <div class="mb-3">
                        <label for="edit_status" class="form-label">Yutuqlimi?</label><br>
                        <input type="checkbox" value="1" id="edit_gift" name="gift" data-bootstrap-switch>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="updateProductBtn">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    function fillEditModal(category) {
        $('#editCategoryId').val(category.id);
        $('#edit_name_uz').val(category.name.uz);
        $('#edit_name_en').val(category.name.en);
        $('#edit_name_ru').val(category.name.ru);
        category.status == 1 ?$('#edit_status').bootstrapSwitch('state', true, true) : '';
        category.gift == 1 ?$('#edit_gift').bootstrapSwitch('state', true, true) : '';
        $('#editModal').modal('show');
    }

    $('#editProductForm').on('submit', function (e) {
        e.preventDefault();
        var formData = new FormData(this);
        var categoryId = $('#editCategoryId').val();
        formData.append('_method', 'PUT');
        $.ajax({
            type: 'POST',
            url: '/category/' + categoryId,
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                $('#editModal').modal('hide');
                alert(response.success);
                loadCategories()
            },
            error: function (response) {
                console.log(response.errors);
            }
        });
    });
</script>

</script>
