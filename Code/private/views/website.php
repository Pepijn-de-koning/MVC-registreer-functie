<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Homepage</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo site_url( '/css/style.css' ) ?>" media="all">
</head>
<body>
<header>
    <h1>Sharing is caring</h1>
</header>
<nav>
    Hoofdmenu
</nav>
<main>
    <section class="content">
        <h2>Homepage</h2>
        Pagina inhoud
    </section>

    <section>
      <?php echo $this->section('content');?>
    </section>

    <aside>
        <div class="top-10">
           Sidebar
        </div>
    </aside>
</main>

<footer>
    &copy; 2020
</footer>
</body>
</html>
