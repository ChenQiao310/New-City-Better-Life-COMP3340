<?php

session_start();
if(!isset($_SESSION['username'])){
    header('location:login.php');
}

?>
<html>

<head>
    <title>Home Page</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport"
        content="width=device-width, height=device-height, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
    <meta http-equiv='cache-control' content='no-cache'>
    <meta http-equiv='expires' content='0'>
    <meta http-equiv='pragma' content='no-cache'>
    <link rel="stylesheet" href="styles/main.css" />
    <script src="https://cdn.plot.ly/plotly-2.1.0.min.js"></script>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <script src="scripts/map.js"></script>
    <script src="login.js"></script>
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB6lQGac4TVDla2dTOa6lK1ji1g8Zcz6V0&callback=initMap&libraries=&v=weekly"
        async></script>
</head>

<body class="sidebar-navigation">
    <aside>
        <nav>
            <span>
                Menu
            </span>
            <ul>
                <li><a href="#">Home Page</a></li>
                <li><a href="logout.php">logout</a></li>
                <li><a href="#">My Favorite</a></li>
                <li><a href="#">Top 10 livable cities</a></li>
                <li><a href="#">Find dream city</a></li>
                <li><a href="#">About</a></li>
            </ul>
        </nav>
    </aside>

    <main>

        <section class="single-column" style="color: #e67300;">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Welcome, <?php echo $_SESSION['username']; ?>
        </section>

        <section class="single-column">
            <div id="map"></div>
        </section>

        <section class="single-column">
            <div id="mostLivableCities">
                <h3>
                    <span class="title">Canada's Top 10</span><br>
                    <span class="subtitle">Most Livable Cities</span>
                </h3>
                <div id="mostLivableCitiesTableContainer">
                    <table id="mostLivableCitiesTable" role="table">
                        <thead>
                            <tr>
                                <th>
                                    Rank
                                </th>
                                <th>
                                    City/ Town
                                </th>
                                <th>
                                    Prov
                                </th>
                                <th>
                                    Pop. (Latest)
                                </th>
                                <th>
                                    Pop. Growth
                                </th>
                                <th>
                                    Avg Home Price<br> 2020
                                </th>
                                <th>
                                    Avg 1-year<br> home price growth
                                </th>
                                <th>
                                    Avg Mortgage<br> Payment (20% Down)
                                </th>
                                <th>
                                    Minimum Income<br> Required (20% Down)
                                </th>
                                <th>
                                    Scenery Rating
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    1
                                </td>
                                <td>
                                    Langford
                                </td>
                                <td>
                                    BC

                                </td>
                                <td>
                                    42,653
                                </td>
                                <td>
                                    5.2%
                                </td>
                                <td>
                                    $725,300
                                </td>
                                <td>
                                    11.6%
                                </td>
                                <td>
                                    $3,024
                                </td>
                                <td>
                                    $107,604
                                </td>
                                <td>
                                    ****
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    2
                                </td>
                                <td>
                                    Kelowna
                                </td>
                                <td>
                                    BC
                                </td>
                                <td>
                                    222,748
                                </td>
                                <td>
                                    2.0%
                                </td>
                                <td>
                                    $553,175
                                </td>
                                <td>
                                    5.6%
                                </td>
                                <td>
                                    $2,307

                                </td>
                                <td>
                                    $86,616
                                </td>
                                <td>
                                    ****
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    3
                                </td>
                                <td>
                                    Trois-Rivières
                                </td>
                                <td>
                                    QC
                                </td>
                                <td>
                                    163,287
                                </td>
                                <td>
                                    1.5%
                                </td>
                                <td>
                                    $224,600
                                </td>
                                <td>
                                    32.8%
                                </td>
                                <td>
                                    $937
                                </td>
                                <td>
                                    $48,866
                                </td>
                                <td>
                                    ***
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    4
                                </td>
                                <td>
                                    Bathurst
                                </td>
                                <td>

                                    NB
                                </td>
                                <td>
                                    31,691
                                </td>
                                <td>
                                    0.0%
                                </td>
                                <td>
                                    $112,850
                                </td>
                                <td>
                                    0.3%
                                </td>
                                <td>
                                    $471
                                </td>
                                <td>
                                    $34,444
                                </td>
                                <td>
                                    ****
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    5
                                </td>
                                <td>
                                    Rossland
                                </td>
                                <td>
                                    BC
                                </td>
                                <td>
                                    4,108
                                </td>
                                <td>
                                    2.5%
                                </td>
                                <td>
                                    $443,889
                                </td>
                                <td>
                                    39.9%
                                </td>

                                <td>
                                    $1,851
                                </td>
                                <td>
                                    $73,477
                                </td>
                                <td>
                                    ****
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    6
                                </td>
                                <td>
                                    Niagara-on-the-Lake
                                </td>
                                <td>
                                    ON
                                </td>
                                <td>
                                    18,865
                                </td>
                                <td>
                                    1.3%
                                </td>
                                <td>
                                    $515,000
                                </td>
                                <td>
                                    32.1%
                                </td>
                                <td>
                                    $2,147
                                </td>
                                <td>
                                    $86,848
                                </td>
                                <td>
                                    *****
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    7
                                </td>
                                <td>
                                    Cowichan Bay

                                </td>
                                <td>
                                    BC
                                </td>
                                <td>
                                    90,448
                                </td>
                                <td>
                                    1.2%
                                </td>
                                <td>
                                    $561,900
                                </td>
                                <td>
                                    16.5%
                                </td>
                                <td>
                                    $2,343
                                </td>
                                <td>
                                    $85,415
                                </td>
                                <td>
                                    *****
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    8
                                </td>
                                <td>
                                    Sydney
                                </td>
                                <td>
                                    NS
                                </td>
                                <td>
                                    95,901
                                </td>
                                <td>
                                    -0.3%
                                </td>
                                <td>
                                    $157,338
                                </td>
                                <td>
                                    49.9%
                                </td>
                                <td>
                                    $656
                                </td>
                                <td>
                                    $43,055
                                </td>
                                <td>
                                    ***
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    9
                                </td>
                                <td>
                                    Penticton
                                </td>
                                <td>
                                    BC
                                </td>
                                <td>
                                    46,885
                                </td>
                                <td>
                                    0.9%
                                </td>
                                <td>
                                    $523,386
                                </td>
                                <td>
                                    21.7%
                                </td>
                                <td>
                                    $2,182
                                </td>
                                <td>
                                    $83,821
                                </td>
                                <td>
                                    ****
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    10
                                </td>
                                <td>
                                    Quebec City
                                </td>
                                <td>
                                    QC
                                </td>
                                <td>
                                    832,328
                                </td>
                                <td>
                                    0.9%
                                </td>
                                <td>
                                    $283,000
                                </td>
                                <td>
                                    11.4%
                                </td>
                                <td>
                                    $1,180
                                </td>
                                <td>
                                    $55,724
                                </td>
                                <td>
                                    *****
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
        <section class="single-column">
            <div id="airQuality"></div>
        </section>
    </main>

    <footer>
        <script src="scripts/graph.js"></script>
    </footer>
</body>

</html>