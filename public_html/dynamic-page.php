<?php

/**
 * ---------------------------------------------------------------------------------
 * SQL CONNECTION CREDENTIALS
 * ---------------------------------------------------------------------------------
 * Configure SQL Connection using configuration file in server
 * ---------------------------------------------------------------------------------
 */
$sql_configuration_array    = parse_ini_file("../../../../sql-config.ini", true);
$db_name                    = $sql_configuration_array['database']['database'];
$db_hostname                = $sql_configuration_array['database']['hostname'];
$db_username                = $sql_configuration_array['database']['username'];
$db_password                = $sql_configuration_array['database']['password'];

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
        $this->rank                                 = $rank;
        $this->city_town                            = $city_town;
        $this->province                             = $province;
        $this->population                           = $population;
        $this->avg_home_price_2020                  = $avg_home_price_2020;
        $this->avg_mortgage_payment_20_down         = $avg_mortgage_payment_20_down;
        $this->min_income_required_20_down          = $min_income_required_20_down;
        $this->proximity_to_large_water_body        = $proximity_to_large_water_body;
        $this->proximity_to_mountains               = $proximity_to_mountains;
        $this->scenery_rating                       = City::getStarsFrom($scenery_rating);
        $this->nightlife_rating                     = City::getStarsFrom($nightlife_rating);
        $this->outdoor_activity_rating              = City::getStarsFrom($outdoor_activity_rating);
        $this->climate_rating                       = City::getStarsFrom($climate_rating);
        $this->drive_to_commercial_airport_minutes  = $drive_to_commercial_airport_minutes;
        $this->summary                              = $summary;
        $this->link                                 = $link;
    }

    // ----------------------------------------------------------------
    // Creates a star rating string from an integer
    // ----------------------------------------------------------------
    public static function getStarsFrom($rating) {
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

    // ---------------------------------------------------------------
    // STEP 1: Connect to SQL Database
    // ---------------------------------------------------------------
    $sql_connection = mysqli_connect($db_hostname, $db_username, $db_password);
    if (!$sql_connection) {
        die("connection fail: " . mysqli_connect_error());
    }
    mysqli_select_db($sql_connection, $db_name);

    // ---------------------------------------------------------------
    // STEP 2: Create SQL Query
    // ---------------------------------------------------------------
    $sql_query = "SELECT * from cities where rank = $city_rank;";

    // ---------------------------------------------------------------
    // Step 3: Get Query Record Result
    // ---------------------------------------------------------------
    $sql_query_result = mysqli_query($sql_connection, $sql_query);

    // ---------------------------------------------------------------
    // Step 4: Convert SQL Result Object to Associative Array
    // ---------------------------------------------------------------
    $sql_query_result_array = mysqli_fetch_assoc($sql_query_result);
}

// ---------------------------------------------------------------
// Using the city rank, obtain SQL record array items
// ---------------------------------------------------------------

$rank                                = $sql_query_result_array['rank'];
$city_town                           = $sql_query_result_array['city_town'];
$province                            = $sql_query_result_array['province'];
$population                          = $sql_query_result_array['population'];
$avg_home_price_2020                 = $sql_query_result_array['avg_home_price_2020'];
$avg_mortgage_payment_20_down        = $sql_query_result_array['avg_mortgage_payment_20_down'];
$min_income_required_20_down         = $sql_query_result_array['min_income_required_20_down'];
$proximity_to_large_water_body       = $sql_query_result_array['proximity_to_large_water_body'];
$proximity_to_mountains              = $sql_query_result_array['proximity_to_mountains'];
$scenery_rating                      = $sql_query_result_array['scenery_rating'];
$nightlife_rating                    = $sql_query_result_array['nightlife_rating'];
$outdoor_activity_rating             = $sql_query_result_array['outdoor_activity_rating'];
$climate_rating                      = $sql_query_result_array['climate_rating'];
$drive_to_commercial_airport_minutes = $sql_query_result_array['drive_to_commercial_airport_minutes'];
$summary                             = $sql_query_result_array['summary'];
$link                                = $sql_query_result_array['link'];

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
    <script src="https://cdn.apple-mapkit.com/mk/5.x.x/mapkit.js"></script>
</head>

<body>
    <main>
        <section id="hero-section">
            <div id="hero-card">
                <hgroup id="hero-card-header">
                    <div>
                        <h1 id="hero-card-title"><?php echo $city->city_town . ", " . $city->province; ?></h1>
                        <p id="hero-card-subtitle"><?php echo number_format($city->population, 0, ".", ","); ?> 👤</p>
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
                        <td><?php echo $city->scenery_rating; ?></td>
                    </tr>
                    <tr>
                        <td>Outdoor</td>
                        <td><?php echo $city->outdoor_activity_rating; ?></td>
                    </tr>
                    <tr>
                        <td>Nightlife</td>
                        <td><?php echo $city->nightlife_rating; ?></td>
                    </tr>
                    <tr>
                        <td>Climate</td>
                        <td><?php echo $city->climate_rating; ?></td>
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
                            <td class="table-data-vertical-value"><?php echo number_format($city->population, 0, ".", ","); ?></td>
                        </tr>
                        <tr class="table-row-vertical">
                            <td class="table-data-vertical-label">Average Home Price (2020)</td>
                            <td class="table-data-vertical-value"><?php echo "$" . number_format($city->avg_home_price_2020, 0, ".", ","); ?></td>
                        </tr>
                        <tr class="table-row-vertical">
                            <td class="table-data-vertical-label">Average Mortgage Payment (2020)</td>
                            <td class="table-data-vertical-value"><?php echo "$" . number_format($city->avg_mortgage_payment_20_down, 0, ".", ","); ?></td>
                        </tr>
                        <tr class="table-row-vertical">
                            <td class="table-data-vertical-label">Drive to Commercial Airport (minutes)</td>
                            <td class="table-data-vertical-value"><?php echo $city->drive_to_commercial_airport_minutes; ?></td>
                        </tr>
                    </table>
                </div>
                <div id="city-map"></div>
            </div>
        </section>

    </main>

    <!-- DEBUG AREA
    <aside>
        <pre>
            <?php var_dump($sql_query_result_array) ?>
        </pre>
    </aside>
    -->

    <footer>
        <script>
            <?php
            // ---------------------------------------------------------------------------
            // Change the background image of the URL image using the City object
            // ---------------------------------------------------------------------------
            $filename_id            = trim($city->rank);
            $filename_city          = trim($city->city_town);
            $filename_province      = trim($city->province);
            $url_filename           = strtolower('./images/city-' . $filename_id . '-' . $filename_city . '-' . $filename_province . '.jpg');
            $url_filename_cleansed  = get_clean_url_from($url_filename);
            echo "document.getElementById('hero-card').setAttribute('style', 'background-image: url($url_filename_cleansed)')";
            // ---------------------------------------------------------------------------

            // ---------------------------------------------------------------------------
            // Function to clean URLS
            // ---------------------------------------------------------------------------
            function get_clean_url_from($string) {
                $string = trim(strtolower($string));
                $string = str_replace(' ', '-', $string);                     // Remove dashes ("-")
                $string = str_replace('.-', '-', $string);                    // Remove dot followed by a dash (".-")
                $string = preg_replace('/[^\/A-Za-z0-9\-\.]/', '', $string);  // Remove all special characters (except letters, numbers, dashes, "." and "/")
                $string = preg_replace('/-+/', '-', $string);                 // Remove double dashes ("--")

                // SPECIAL CASES
                $string = str_replace('city-69-carignan/chambly-qc.jpg', 'city-69-carignan-chambly-qc.jpg', $string);
                $string = str_replace('city-86-kleinburg/nashville-on.jpg', 'city-86-kleinburg-nashville-on.jpg', $string);
                return $string;
            }
            // ---------------------------------------------------------------------------

            ?>
        </script>

        <script>
            mapkit.init({
                authorizationCallback: function(done) {
                    var xhr = new XMLHttpRequest();
                    xhr.open("GET", "/services/jwt");
                    xhr.addEventListener("load", function() {
                        done(this.responseText);
                    });
                    xhr.send();
                }
            });

            var Cupertino = new mapkit.CoordinateRegion(
                new mapkit.Coordinate(37.3316850890998, -122.030067374026),
                new mapkit.CoordinateSpan(0.167647972, 0.354985255)
            );
            var map = new mapkit.Map("city-map");
            map.region = Cupertino;
        </script>
    </footer>
</body>

</html>