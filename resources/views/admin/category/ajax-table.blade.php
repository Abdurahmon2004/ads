<table class="table table-hover table-striped table-sm">
    <thead>
    <tr>
        <th>ID</th>
        <th>Uzbek</th>
        <th>English</th>
        <th>Russian</th>
        <th>Soni</th>
        <th>Yutuqlimi?</th>
        <th>Holati</th>
        <th>Amallar</th>
    </tr>
    </thead>
    <tbody>
    @foreach($categories as $category)
        <tr>
            <td>{{ $category->id }}</td>
            <td>{{ $category->getTranslation('name', 'uz') }}</td>
            <td>{{ $category->getTranslation('name', 'en') }}</td>
            <td>{{ $category->getTranslation('name', 'ru') }}</td>
            <td>{{ $category->qrcode->count() }}</td>
            <td>{{ $category->gift == 0 ? 'Yo`q': 'Ha' }}</td>
            <td>{{ $category->status == 0 ? 'Nofaol': 'Faol' }}</td>
            <td>
                <a href="{{route('qrcode.index',$category->id)}}" class="btn btn-secondary"><i class="nav-icon fas fa-list"></i></a>
                <button class="btn btn-info" onclick="showCategoryDetails({{ $category }})" data-toggle="modal" data-target="#showCategoryModal"><i class="nav-icon fas fa-eye"></i></button>
                <button class="btn btn-warning" onclick="fillEditModal({{ $category }})" data-toggle="modal" data-target="#editCategoryModal"><i class="nav-icon fas fa-pen"></i></button>
                <button class="btn btn-danger" onclick="deleteCategory({{ $category->id }})"><i class="nav-icon fas fa-trash"></i></button>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
<script>
    function deleteCategory(id) {
        if (confirm('Are you sure you want to delete this category?')) {
            $.ajax({
                type: 'DELETE',
                url: '/admin/category/' + id,
                data: {
                    '_token': '{{ csrf_token() }}',
                },
                success: function(response) {
                    alert(response.success);
                    loadCategorys();
                },
                error: function(response) {
                    console.log(response.errors);
                }
            });
        }
    }
</script>
