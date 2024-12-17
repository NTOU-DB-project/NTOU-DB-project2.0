$(document).ready(function () {
    const BASE_URL = '/php-simple-note-app/';

    $('#search-form').submit(function (event) {
        event.preventDefault();
        const query = $('#search-input').val();

        // // 查看錯誤
        // const requestUrl = `${BASE_URL}api/note/search.php?query=${query}`;
        // console.log('Request URL:', requestUrl);

        fetch(`${BASE_URL}api/note/search.php?query=${query}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                $('.notes-grid').empty();
                renderNotes(data);
            })
            .catch(error => {
                console.error('Error:', error);
            });
    });

    // $('#search-input').kepress(function (event) {
    //     if(event.key === 'Enter') {
    //         event.preventDefault();
    //         $('#search-form').submit();
    //     }
    // });

    const renderNotes = function (data) {
        $.each(data, function (key, val) {
            const tmp = document.createElement('DIV');
            tmp.innerHTML = val.content;
            const stringContent = tmp.textContent || tmp.innerText || '';

            const noteCardHtml = `
                <div class="note-card" data-id=${val.id}>
                    <div class="note-header-wrapper">
                        <h3>${val.title}</h3>
                        <button class="note-delete-btn" data-id=${val.id}>
                            <i class="fa fa-trash"></i>
                        </button>
                    </div>
                    Last Updated: ${luxon.DateTime.fromSQL(val.updated_at).toRelative()}
                    <div class="note-card-content">${stringContent}</div>
                </div>`;

            $('.notes-grid').append(noteCardHtml);
        });

        if (Array.isArray(data) && data.length === 0) {
            const emptyHtml = `
                <div class="empty-center">
                    <div class="empty-container">
                        <div class="empty-wrapper">
                            <img src="${BASE_URL}assets/empty-notes.svg" height="200" width="200" alt="empty" />
                            <h3>Empty notes</h3>
                            <p>Press the add button on the top right to add a note</p>
                        </div>
                    </div>
                </div>`;
            $('.notes-grid').append(emptyHtml);
        }

        $(document).off('click', '.note-card', editNote);
        $(document).on('click', '.note-card', editNote);

        $(document).off('click', '.note-delete-btn', handleNoteDelete);
        $(document).on('click', '.note-delete-btn', handleNoteDelete);
    };


    const handleNoteDelete = function (event) {
        event.stopPropagation();
        const id = $(this).attr('data-id');

        fetch(`${BASE_URL}api/note/delete.php`, {
            method: 'DELETE',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ id: id }),
        })
            .then((response) => {
                if (!response.ok) throw new Error('Failed to delete note');
                DevExpress.ui.notify({
                    message: 'Successfully deleted note',
                    type: 'success',
                    displayTime: 3000,
                    width: 300,
                });
                showNotes();
            })
            .catch((error) => {
                DevExpress.ui.notify({
                    message: 'Connection problem',
                    type: 'error',
                    displayTime: 3000,
                    width: 300,
                });
                console.log(error);
            });
    };

    const editNote = function () {
        const id = $(this).attr('data-id');
        window.location.href = `${BASE_URL}edit.php?id=${id}`;
    };

});