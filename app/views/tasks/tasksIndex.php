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
                <table class="table table-striped">
                    <thead>
                    <th>
                        <a class="nav-link" href="/?column=name&sort=<?php if ($pageData['data']['currentSort'] === 'ASC')
                        { ?>DESC<?php } else { ?>ASC<?php } ?>&page=<?php if (isset($pageData['data']['currentPage']))?><?=
                        $pageData['data']['currentPage'] ?>">Author</a>
                    </th>
                    <th>
                        <a class="nav-link" href="/?column=email&sort=<?php if ($pageData['data']['currentSort'] === 'ASC')
                        { ?>DESC<?php } else { ?>ASC<?php } ?>&page=<?php if (isset($pageData['data']['currentPage']))?><?=
                        $pageData['data']['currentPage'] ?>">Email</a>
                    </th>
                    <th>Content</th>
                    <th>
                        <a class="nav-link" href="/?column=status&sort=<?php if ($pageData['data']['currentSort'] === 'ASC')
                        { ?>DESC<?php } else { ?>ASC<?php } ?>&page=<?php if (isset($pageData['data']['currentPage']))?><?=
                        $pageData['data']['currentPage'] ?>">Status</a>
                    </th>
                    <?php if ($pageData['permission'] == 1) { ?>
                        <th></th>
                    <?php } ?>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($pageData['data']['tasksList'] as $key => $value) { ?>
                        <tr>
                            <td><?php echo $value['name']; ?></td>
                            <td><?php echo $value['email']; ?></td>
                            <td><?php echo $value['content']; ?></td>
                            <td>
                                <?php if ($value['status'] != 1) { ?>
                                    <p class="text-center alert-secondary"> Not ready </p>
                                <?php } else { ?>
                                    <p class="text-center alert-success"> Done </p>
                                <?php } ?>
                            </td>
                            <?php if ($pageData['permission'] == 1) { ?>
                                <td>
                                    <div class="btn-group-vertical">
                                        <a href="/tasks/edit?id=<?php echo $key?>" class="btn btn-outline-danger"><i>edit</i></a>
                                        <a href="/tasks/delete?id=<?php echo $key?>" class="btn btn-outline-dark"><i>delete</i></a>
                                    </div>
                                </td>
                            <?php } ?>
                        </tr>
                    <?php } ?>
                    </tbody>
                    <tfoot>
                    </tfoot>
                </table>
                <hr />
                <a href="tasks/create" class="btn btn-outline-primary float-right"><i>Create</i></a>

                <br />
                <br />
                <div class="text-center text-sm-center">
                    <ul class="pagination d-inline-flex">
                        <?php for ($page = 1; $page <= $pageData['data']['totalPages']; $page++) { ?>
                            <li class="page-item">
                                <a class="page-link" href='<?php echo "/?page=$page"; ?>'> <?php  echo $page; ?> </a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
            </div>
        </main>
    </div>
</body>
</html>