$(document).ready(function() {
    const BASE_URL = '/php-simple-note-app/';
    const userId = <?= json_encode($user_id) ?>;

    const loadImages = () => {
        fetch(`${BASE_URL}api/image/read.php`)
            .then(response => response.json())
            .then(data => {
                $('#image-list').empty();
                data.forEach(image => {
                    $('#image-list').append(`
                        <div class="col-md-4">
                            <div class="card mb-4">
                                <img src="${image.url}" class="card-img-top" alt="Image">
                                <div class="card-body">
                                    <button class="btn btn-danger delete-image-btn" data-id="${image.id}">刪除</button>
                                </div>
                            </div>
                        </div>
                    `);
                });
            });
    };

    $('#add-image-btn').click(function() {
        const imageUrl = $('#image-url').val();
        fetch(`${BASE_URL}api/image/create.php`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ note_id: 1, url: imageUrl }) // 假設 note_id 為 1，你可以根據需要進行調整
        })
        .then(response => response.json())
        .then(data => {
            loadImages();
            $('#image-url').val('');
        });
    });

    $(document).on('click', '.delete-image-btn', function() {
        const imageId = $(this).data('id');
        fetch(`${BASE_URL}api/image/delete.php`, {
            method: 'DELETE',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ id: imageId })
        })
        .then(response => response.json())
        .then(data => {
            loadImages();
        });
    });

    loadImages();
});