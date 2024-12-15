<?php
include_once "./templates/header.php";
include_once "./middlewares/auth.php";
include_once "./models/User.php";
$user = User::get_by_id($user_id);
?>

<link rel="stylesheet" href="./css/note.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css"
    rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU"
    crossorigin="anonymous">
<script type="text/javascript" src="./js/imageBank.js"></script>

</head>

<body class="dx-viewport">

    <div class="container mt-5">
        <h2>您的圖庫</h2>
        <div class="mb-3">
            <input type="text" id="image-url" class="form-control" placeholder="圖片URL">
            <button id="add-image-btn" class="btn btn-primary mt-2">新增圖片</button>
        </div>
        <div id="image-list" class="row"></div>
    </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

</body>
<?php
include_once "./templates/footer.php";