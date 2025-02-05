<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalTitle">Yangi Qrkod qo'shish</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="addCategoryForm">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <ul class="nav nav-tabs" id="languageTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="uz-tab" data-toggle="tab" href="#uz" role="tab"
                                   aria-controls="uz" aria-selected="true">Uz</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="en-tab" data-toggle="tab" href="#en" role="tab"
                                   aria-controls="en" aria-selected="false">En</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="ru-tab" data-toggle="tab" href="#ru" role="tab"
                                   aria-controls="ru" aria-selected="false">Ru</a>
                            </li>
                        </ul>

                        <div class="tab-content" id="languageTabContent">
                            <div class="tab-pane fade show active" id="uz" role="tabpanel" aria-labelledby="uz-tab">
                                <label for="site_name_uz">Nomi [uz]</label>
                                <input type="text" class="form-control" id="site_name_uz" name="uz" required>
                            </div>
                            <div class="tab-pane fade" id="en" role="tabpanel" aria-labelledby="en-tab">
                                <label for="site_name_en">Nomi [en]</label>
                                <input type="text" class="form-control" id="site_name_en" name="en" required>
                            </div>
                            <div class="tab-pane fade" id="ru" role="tabpanel" aria-labelledby="ru-tab">
                                <label for="site_name_ru">Nomi [ru]</label>
                                <input type="text" class="form-control" id="site_name_ru" name="ru" required>
                            </div>
                        </div>

                    </div>
                    <div class="mb-3">
                        <label for="Rasmi">Soni</label><br>
                        <input type="number" name="count" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="Rasmi">Rasmi</label><br>
                        <input type="file" class="form-control" name="image" accept="image/*">
                    </div>
                    <div class="mb-3">
                        <label for="Holati">Yutuqlimi?</label><br>
                        <input type="checkbox" value="1" name="gift" data-bootstrap-switch>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Yopish</button>
                    <button type="submit" class="btn btn-primary" id="addProductBtn">Saqlash</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $('#addCategoryForm').on('submit', function (e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            type: 'POST',
            url: '{{ route("category.store") }}',
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                $('#addModal').modal('hide');
                $('#addCategoryForm')[0].reset();
                loadCategories()
            },
            error: function (response) {
                console.log(response.errors);
            }
        });
    });
</script>
