<?php
include_once "./templates/header.php";
include_once "./middlewares/auth.php";
include_once "./models/User.php";
include_once "./models/Note.php";

// Get the logged-in user
$user = User::get_by_id($user_id);

// Create Note instance
$note = new Note($db);

// Fetch total notes count for the user
$total_notes = $note->count_notes($user_id);
?>

<head>
    <link rel="stylesheet" href="./css/note.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css"
        rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU"
        crossorigin="anonymous">
    <script type="text/javascript" src="./js/notes.js"></script>
    <script type="text/javascript" src="./js/searchNotes.js"></script>
</head>

<body class="dx-viewport">
    <div class="notes-backdrop">
        <div class="header scale-up">
            <span class="left-center-logo"></span>
            <div class="header scale-up">
                <span class="left-center-logo">
                    <form id="search-form" class="form-inline d-flex align-items-center">
                        <input type="text" id="search-input" class="form-control mr-2" placeholder="Search notes...">
                        <button type="submit" class="btn btn-primary">Search</button>
                    </form>
                </span>
                <span class="logo"><?= " $user->name, welcome to use note app!" ?></span>
                <span class="right-center-logo">
                    <div id="add-note-btn" class="btn btn-success">新增筆記</div>
                    <div id="logout-btn" class="btn btn-outline-danger">登出</div>
                </span>
            </div>
        </div>

        <div id="add-note-popup"></div>

        <div class="padded-notes-area">
            <div class="btn btn-success">目前筆記數量: <?= $total_notes ?></div>
            <div class="notes-grid">
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" 
        crossorigin="anonymous"></script>
</body>

<?php
include_once "./templates/footer.php";
?>
