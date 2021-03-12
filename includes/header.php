<!DOCTYPE html>
<html>


<head>
    <title>Projects</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <style>
        <?php require dirname(__DIR__) . '/css/styles.css'; ?>
    </style>
</head>


<body>
    <div>
        <header>
            <nav class='navbar'>
                <ul class='navbar__list'>
                    <h3>WeLove Test</h3>
                    <li><a href="/">Projektlista</a></li>

                    <li><a href="/projects/create.php">Létrehozás</a></li>
                    <li>
                        <div class='dropdown'>
                            <button class='dropbtn'><span>Szűrés</span></button>
                            <div class='dropdown-content'>
                                <ul>
                                    <li>
                                        <a href="/projects/filter.php?filter=1">Fejleszés vár</a>
                                    </li>
                                    <li>
                                        <a href="/projects/filter.php?filter=2">Folyamatban</a>
                                    </li>
                                    <li>
                                        <a href="/projects/filter.php?filter=3">Kész</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>
                </ul>



            </nav>
        </header>
        <main>
            <div class='center'>