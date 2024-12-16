<?php
include_once "./templates/header.php";
include_once './config/Database.php';
include_once "./middlewares/auth.php";
include_once './models/Note.php';
include_once "./models/User.php";
$user = User::get_by_id($user_id);

$database = new Database();
$db = $database->connect();

$note = new Note($db);


$note->id = isset($_GET['id']) ? $_GET['id'] : die();

$note->read_single();

if ($note->creator_id != $user_id) {
    header('Location: php-simple-note-app/index.php');
    exit;
}

// Start session and get user_id
$user_id = $_SESSION['user_id'] ?? null;
?>

<script>
    // Embed PHP session data in JavaScript
    const sessionData = {
        user_id: <?= json_encode($user_id) ?>,
        note_id: <?= json_encode($note->id) ?>,
    };

    console.log("Session Data:", sessionData);
</script>
<script src="./js/editNote.js"></script>
<link rel="stylesheet" href="./css/edit-note.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css"
    rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU"
    crossorigin="anonymous">

</head>

<body class="dx-viewport">

    <div class="page-container">

        <div class="edit-note-header">
            <h2><?= $note->title ?></h2>
            <div>
                <div id="back-btn"></div>
                <div id="save-btn"></div>
            </div>
        </div>

        <hr>

        <div class="html-editor">
            <?= $note->content ?>
        </div>
        <div class="permissions-container">
            <h3>想要分享你的筆記嗎?</h3>
            <form id="grant-permission-form">
                <div class="mb-3">
                    <label for="user-email">分享之前請記得保存 避免資料遺失~</label>
                    <input type="email" id="user-email" class="form-control" placeholder="輸入對方的 username">
                </div>
                <div id="share-btn"></div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

</body>
<?php
include_once "./templates/footer.php";
