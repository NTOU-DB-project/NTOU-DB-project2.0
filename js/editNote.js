$(function () {
  // Define the base URL for consistent path construction
  const BASE_URL = '/php-simple-note-app/';

  // Initialize the HTML editor
  const editor = $('.html-editor')
    .dxHtmlEditor({
      height: 740,
      valueType: 'html',
      toolbar: {
        items: [
          'undo',
          'redo',
          'separator',
          {
            name: 'size',
            acceptedValues: [
              '8pt',
              '10pt',
              '12pt',
              '14pt',
              '18pt',
              '24pt',
              '36pt',
            ],
          },
          {
            name: 'font',
            acceptedValues: [
              'Arial',
              'Courier New',
              'Georgia',
              'Impact',
              'Lucida Console',
              'Tahoma',
              'Times New Roman',
              'Verdana',
            ],
          },
          'separator',
          'bold',
          'italic',
          'strike',
          'underline',
          'separator',
          'alignLeft',
          'alignCenter',
          'alignRight',
          'alignJustify',
          'separator',
          'orderedList',
          'bulletList',
          'separator',
          {
            name: 'header',
            acceptedValues: [false, 1, 2, 3, 4, 5],
          },
          'separator',
          'color',
          'background',
          'separator',
          'link',
          'image',
          'separator',
          'clear',
          'codeBlock',
          'blockquote',
          'separator',
          'insertTable',
          'deleteTable',
          'insertRowAbove',
          'insertRowBelow',
          'deleteRow',
          'insertColumnLeft',
          'insertColumnRight',
          'deleteColumn',
        ],
      },
      mediaResizing: {
        enabled: true,
      },
    })
    .dxHtmlEditor('instance');

  // Save button configuration
  $('#save-btn').dxButton({
    stylingMode: 'contained',
    text: '保存',
    type: 'default',
    width: 120,
    onClick: function () {
      const currentUrl = new URL(document.location.href);
      const id = currentUrl.searchParams.get('id');

      fetch(`${BASE_URL}api/note/update.php`, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({
          id: id,
          content: editor.option('value'),
        }),
      })
        .then((response) => {
          if (!response.ok) throw new Error('Failed to save note');
          window.location.href = `${BASE_URL}index.php`;
        })
        .catch((error) => {
          DevExpress.ui.notify({
            message: "Couldn't save note",
            type: 'error',
            displayTime: 3000,
            width: 300,
          });
          console.error(error);
        });
    },
  });

  // Back button configuration
  $('#back-btn').dxButton({
    stylingMode: 'outlined',
    text: '返回',
    type: 'default',
    width: 120,
    onClick: function () {
      window.location.href = `${BASE_URL}index.php`;
    },
  });
});
