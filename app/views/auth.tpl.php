<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <br />
    <title><?php echo $pageData['title']; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/public/css/bootstrap.min.css" id="bootstrap-css">
    <link rel="stylesheet" href="/public/css/style.css">
</head>
<body>

<header>
</header>

<div id="content">
    <div class="container h-100">
        <div class="row h-100 justify-content-center align-items-center">
            <div class="col-sm-6 col-md-4 col-md-offset-4">
                <h1 class="text-center login-title">Authorization</h1>
                <div class="account-wall">
                    <img class="profile-img" src="/public/image/auth_avatar.png"
                         alt="">
                    <form class="form-signin" id="form-signin" method="post" name="form-signin">
                        <?php if(!empty($pageData['loginError'])) :?>
                            <p><?php echo  $pageData['loginError']?></p>
                        <?php endif; ?>
                        <input type="text" class="form-control" id="login" name="login" placeholder="Login" required autofocus>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                        <button class="btn btn-lg btn-primary btn-block" type="submit">
                            Sign in</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<footer>
</footer>

<script src="/public/js/jquery-3.3.1.min.js"></script>
<script src="/public/js/bootstrap.min.js"></script>
</body>
</html>