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
      console.log(editor.option('value'));
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

  // Back button configuration
  $('#share-btn').dxButton({
    stylingMode: 'outlined',
    text: '分享',
    type: 'default',
    width: 120,
    onClick: function () {
      const currentUrl = new URL(document.location.href);
      const id = currentUrl.searchParams.get('id'); // Note ID
      const emailInput = document.getElementById('user-email'); // Email input field
      const email = emailInput.value.trim(); // Trim and get the email
      const user_id = sessionData.user_id; // Current user ID
  
      // Validate email input
      if (!email) {
        DevExpress.ui.notify({
          message: 'Please enter a valid email address.',
          type: 'warning',
          displayTime: 3000,
          width: 300,
        });
        return; // Exit if no email is provided
      }
  
      // Clear the input field after extracting the value
      emailInput.value = '';
  
      // Step 1: Fetch User ID by Email
      fetch(`${BASE_URL}api/user/emailToID.php`, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ email: email }), // Pass the email as JSON
      })
        .then((response) => {
          if (!response.ok) {
            throw new Error('Failed to fetch user ID. Server responded with ' + response.status);
          }
          return response.json();
        })
        .then((data) => {
          if (!data.id) {
            throw new Error('User ID not found in response.');
          }
  
          const userId = data.id; // Extract the user ID
          console.log('Fetched user ID:', userId);
  
          // Step 2: Grant Note Permissions
          return fetch(`${BASE_URL}api/note_auth/updatePermission.php`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({
              user_id: userId, // Borrower
              note_id: id,
              can_read: true,
              creator_id: user_id, // Current user
            }),
          });
        })
        .then((response) => {
          if (!response.ok) {
            throw new Error('Failed to grant permissions. Server responded with ' + response.status);
          }
  
          DevExpress.ui.notify({
            message: 'Permission granted successfully!',
            type: 'success',
            displayTime: 3000,
            width: 300,
          });
        })
        .catch((error) => {
          DevExpress.ui.notify({
            message: error.message || 'An unexpected error occurred.',
            type: 'error',
            displayTime: 3000,
            width: 300,
          });
          console.error(error);
        });
    },
  });
  
  
  
});
