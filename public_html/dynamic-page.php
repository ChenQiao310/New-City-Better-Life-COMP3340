<?php

/**
 * ---------------------------------------------------------------------------------
 * CLASS: CITY
 * ---------------------------------------------------------------------------------
 * A data type that represents a City Object, with fields obtained from a MySQL record
 * using the city rank as the primary key.
 * ---------------------------------------------------------------------------------
 */
final class City {

    public $rank;
    public $city_town;
    public $province;
    public $population;
    public $avg_home_price_2020;
    public $avg_mortgage_payment_20_down;
    public $min_income_required_20_down;
    public $proximity_to_large_water_body;
    public $proximity_to_mountains;
    public $scenery_rating;
    public $nightlife_rating;
    public $outdoor_activity_rating;
    public $climate_rating;
    public $drive_to_commercial_airport_minutes;
    public $summary;
    public $link;

    // ----------------------------------------------------------------
    // All of these fields are obtained from one SQL record of a city
    // ----------------------------------------------------------------
    public function __construct(
        $rank,
        $city_town,
        $province,
        $population,
        $avg_home_price_2020,
        $avg_mortgage_payment_20_down,
        $min_income_required_20_down,
        $proximity_to_large_water_body,
        $proximity_to_mountains,
        $scenery_rating,
        $nightlife_rating,
        $outdoor_activity_rating,
        $climate_rating,
        $drive_to_commercial_airport_minutes,
        $summary,
        $link
    ) {
        $this->rank = $rank;
        $this->city_town = $city_town;
        $this->province = $province;
        $this->population = $population;
        $this->avg_home_price_2020 = $avg_home_price_2020;
        $this->avg_mortgage_payment_20_down = $avg_mortgage_payment_20_down;
        $this->min_income_required_20_down = $min_income_required_20_down;
        $this->proximity_to_large_water_body = $proximity_to_large_water_body;
        $this->proximity_to_mountains = $proximity_to_mountains;
        $this->scenery_rating = $scenery_rating;
        $this->nightlife_rating = $nightlife_rating;
        $this->outdoor_activity_rating = $outdoor_activity_rating;
        $this->climate_rating = $climate_rating;
        $this->drive_to_commercial_airport_minutes = $drive_to_commercial_airport_minutes;
        $this->summary = $summary;
        $this->link = $link;
    }

    // ----------------------------------------------------------------
    // Creates a star rating string from an integer
    // ----------------------------------------------------------------
    public static function getStarsFromRating($rating) {
        $star_string = "";
        for ($x = 1; $x <= $rating; $x++) {
            $star_string .= "★";
        }
        return $star_string;
    }
}


/**
 * ---------------------------------------------------------------------------------
 * HOW IT WORKS:
 * ---------------------------------------------------------------------------------
 * The dynamic pages are generated using a custom URL that includes a query string:
 *      "./dynamic-page.php?city=1"
 * The "city=1" is a parameter that we place in the URL so we can land on the 
 * dynamic page file with this ID. In this example, we can use the key "1" to 
 * obtain the mySQL city record with the primary key == 1;
 * ---------------------------------------------------------------------------------
 */

// ---------------------------------------------------------------
// Grab the city rank from the URL (through a GET request)
// ---------------------------------------------------------------
if (isset($_GET['city'])) {
    $city_rank = $_GET['city'];
    // MYSQLI CODE goes here
}

// ---------------------------------------------------------------
// Using the city rank, obtain SQL record. mySQL results go here.
// Strings can be replaced with the query results. 
// Test data for now.
// ---------------------------------------------------------------

$rank                                = "1";
$city_town                           = "Langford";
$province                            = "BC";
$population                          = "42653";
$avg_home_price_2020                 = "725300";
$avg_mortgage_payment_20_down        = "3024";
$min_income_required_20_down         = "107604";
$proximity_to_large_water_body       = "1";
$proximity_to_mountains              = "1";
$scenery_rating                      = "4";
$nightlife_rating                    = "3";
$outdoor_activity_rating             = "4";
$climate_rating                      = "4";
$drive_to_commercial_airport_minutes = "30";
$summary                             = "A fast-growing city with endless green spaces";
$link                                = "NULL";

// ---------------------------------------------------------------
// Create a new City object that will be used throughout the page.
// ---------------------------------------------------------------
$city = new City(
    $rank,
    $city_town,
    $province,
    $population,
    $avg_home_price_2020,
    $avg_mortgage_payment_20_down,
    $min_income_required_20_down,
    $proximity_to_large_water_body,
    $proximity_to_mountains,
    $scenery_rating,
    $nightlife_rating,
    $outdoor_activity_rating,
    $climate_rating,
    $drive_to_commercial_airport_minutes,
    $summary,
    $link
);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New City Better Life | <?php echo $city->city_town . ", " . $city->province; ?></title>
    <link rel="stylesheet" href="./styles/main.css">
</head>

<body>
    <main>
        <section id="hero-section">
            <div id="hero-card">
                <hgroup id="hero-card-header">
                    <div>
                        <h1 id="hero-card-title"><?php echo $city->city_town . ", " . $city->province; ?></h1>
                        <p id="hero-card-subtitle"><?php echo $city->population; ?> 👤</p>
                    </div>
                    <div>
                        <p id="hero-card-rank">
                            #<?php echo $city->rank; ?>
                        </p>
                    </div>
                </hgroup>
                <table id="hero-table">
                    <tr>
                        <td>Scenery</td>
                        <td><?php echo City::getStarsFromRating($city->scenery_rating); ?></td>
                    </tr>
                    <tr>
                        <td>Outdoor</td>
                        <td><?php echo City::getStarsFromRating($city->outdoor_activity_rating); ?></td>
                    </tr>
                    <tr>
                        <td>Nightlife</td>
                        <td><?php echo City::getStarsFromRating($city->nightlife_rating); ?></td>
                    </tr>
                    <tr>
                        <td>Climate</td>
                        <td><?php echo City::getStarsFromRating($city->climate_rating); ?></td>
                    </tr>
                    <tfoot>
                        <tr>
                            <td colspan="2" id="hero-table-city-summary">
                                <?php echo $city->summary; ?>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </section>
        <section id="city-info">
            <div id="city-info-content">
                <div id="city-details">
                    <table id="city-details-table">
                        <caption id="city-details-title">
                            City Summary
                        </caption>
                        <tr class="table-row-vertical">
                            <td class="table-data-vertical-label">Livability Rank</td>
                            <td class="table-data-vertical-value">#<?php echo $city->rank; ?></td>
                        </tr>
                        <tr class="table-row-vertical">
                            <td class="table-data-vertical-label">City/Town Name</td>
                            <td class="table-data-vertical-value"><?php echo $city->city_town; ?></td>
                        </tr>
                        <tr class="table-row-vertical">
                            <td class="table-data-vertical-label">City Province</td>
                            <td class="table-data-vertical-value"><?php echo $city->province; ?></td>
                        </tr>
                        <tr class="table-row-vertical">
                            <td class="table-data-vertical-label">Population</td>
                            <td class="table-data-vertical-value"><?php echo $city->population; ?></td>
                        </tr>
                        <tr class="table-row-vertical">
                            <td class="table-data-vertical-label">Average Home Price (2020)</td>
                            <td class="table-data-vertical-value"><?php echo $city->avg_home_price_2020; ?></td>
                        </tr>
                        <tr class="table-row-vertical">
                            <td class="table-data-vertical-label">Average Mortgage Payment (2020)</td>
                            <td class="table-data-vertical-value"><?php echo $city->avg_mortgage_payment_20_down; ?></td>
                        </tr>
                        <tr class="table-row-vertical">
                            <td class="table-data-vertical-label">Drive to Commercial Airport (minutes)</td>
                            <td class="table-data-vertical-value"><?php echo $city->drive_to_commercial_airport_minutes; ?></td>
                        </tr>
                    </table>
                </div>
                <div id="city-map">
                    GOOGLE MAP
                </div>
            </div>
        </section>
    </main>
    <footer>
        <script>
            <?php
            // ---------------------------------------------------------------------------
            // Change the background image of the URL image using the City object
            // ---------------------------------------------------------------------------
            $i = $city->rank;
            $n = $city->city_town;
            $p = $city->province;
            echo "document.getElementById('hero-card').setAttribute('style', 'background-image: url(./images/city-$i-$n-$p.jpg')";
            ?>
        </script>
    </footer>
</body>

</html>