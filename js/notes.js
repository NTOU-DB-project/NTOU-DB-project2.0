$(function () {
  // Ensure all paths are consistent
  const BASE_URL = '/php-simple-note-app/';

  $('#logout-btn').dxButton({
    stylingMode: 'contained',
    text: 'logout',
    type: 'danger',
    width: 120,
    onClick: function () {
      window.location.href = `${BASE_URL}logout.php`;
    },
  });

  $('#add-note-btn').dxButton({
    icon: 'plus',
    text: 'add note',
    onClick: function (e) {
      popup.show();
    },
  });

  const handleAddNote = function (event) {
    event.preventDefault();
    const noteTitle = event.target[0].value;

    fetch(`${BASE_URL}api/note/create.php`, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({
        title: noteTitle,
        content: '<p>empty note</p>',
      }),
    })
      .then((response) => {
        if (!response.ok) throw new Error('Failed to add note');
        DevExpress.ui.notify({
          message: 'Added note successfully',
          type: 'success',
          displayTime: 3000,
          width: 300,
        });
        showNotes();
        popup.hide();
      })
      .catch((error) => {
        DevExpress.ui.notify({
          message: "Couldn't add note",
          type: 'error',
          displayTime: 3000,
          width: 300,
        });
        console.log(error);
      });
  };

  const popup = $('#add-note-popup')
    .dxPopup({
      width: 500,
      height: 350,
      showTitle: true,
      title: '新增筆記',
      closeOnOutsideClick: true,
      contentTemplate: () => {
        const content = $("<form method='post' />");
        content.submit(handleAddNote);
        content.dxForm({
          colCount: 1,
          items: [
            {
              dataField: '筆記標題',
              validationRules: [
                {
                  type: 'required',
                  message: 'Please enter note title',
                },
              ],
            },
            {
              itemType: 'button',
              horizontalAlignment: 'right',
              buttonOptions: {
                text: '新增',
                type: 'success',
                useSubmitBehavior: true,
              },
            },
          ],
        });

        return content;
      },
    })
    .dxPopup('instance');

  const showNotes = function () {
    fetch(`${BASE_URL}api/note/read.php`)
      .then((response) => {
        if (!response.ok) throw new Error('Failed to fetch notes');
        return response.json();
      })
      .then((data) => {
        $('.notes-grid').empty();
        $('.empty-center').remove();
        renderNotes(data);
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
      $('.padded-notes-area').append(emptyHtml);
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

  showNotes();
});
