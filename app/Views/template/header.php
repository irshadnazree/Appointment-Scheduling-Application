<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Que / <?= $page?></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- 
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    <script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    
    <link rel="stylesheet" type="text/css" href="https://bootswatch.com/5/quartz/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/assets/css/style.css">
    
</head>

<body>
    <nav class="navbar navbar-expand-lg mx-5 navbar-dark">
        <div class="container-fluid">
            <h1><a class="navbar-brand fs-2" href="<?= base_url()?>">Que</a></h1>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarColor01">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/serviceList">Services</a>
                    </li>
                </ul>
                <?php if(session()->get('isLoggedIn')):?>
                    <div class="d-flex">
                        <div class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><?= ucfirst(session('firstName'))." ".ucfirst(substr(session('lastName'), 0, 1))?></a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="/profile">Profile</a>
                                <a class="dropdown-item" href="/dashboard">Dashboard</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="/logout">Logout</a>
                            </div>
                        </div>
                    </div>
                <?php else:?>
                    <div class="d-flex">
                        <a href="/register" class="btn btn-sm btn-outline-secondary me-sm-2 py-1 px-3">Sign Up</a>
                        <a href="/login" class="btn btn-sm btn-primary py-1 px-3">Log In</a>
                    </div>
                <?php endif?>
            </div>
        </div>
    </nav>
    
