<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php echo $pageData['title']; ?></title>

    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <link href="/public/css/bootstrap.min.css" rel="stylesheet">
    <link href="/public/css/fontawesome.min.css" rel="stylesheet">
    <link href="/public/css/style.css" rel="stylesheet">

</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light">
        <div class="container">
            <a class="navbar-brand" href="/">
                Tasks
            </a>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <?php if ($pageData['permission'] == 1) { ?>
                            <a class="nav-link" href="/auth/logout">LOGOUT</a>
                        <?php } else { ?>
                            <a class="nav-link" href="/auth/login">LOGIN</a>
                        <?php } ?>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="py-4">
        <div class="container">
            <form class="form-horizontal" action="/tasks/save" method="post">

                <input type="hidden" class="form-control" name="id" value="<?php echo $pageData['task']['id']?>">
                <label>Name</label>
                <input type="text" class="form-control" name="name"
                       value="<?php echo $pageData['task']['name']?>"
                required maxlength="100">
                <br>
                <label>Email</label>
                <input type="email" class="form-control" name="email" required value="<?php echo $pageData['task']['email']?>" maxlength="100">
                <br>
                <label>Content</label>
                <textarea class="form-control" name="content" required maxlength="1000"><?php echo $pageData['task']['content']?></textarea>
                <br>
                    <?php if($pageData['permission'] == 1) { ?>
                        <label> Execution status </label>
                        <div class="checkbox">
                            <input type="checkbox" class="big-checkbox" value="1" name="status" <?php echo $pageData['task']['status'] ? "checked" : false ?>>
                            <br>
                        </div>
                    <?php } ?>
                <div class="float-right">
                    <input class="btn btn-outline-primary" type="submit" value="Save">
                </div>

            </form>
        </div>
    </main>
</div>
</body>
</html>
