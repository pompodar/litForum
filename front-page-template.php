<?php /* Template Name: front page */ ?>
<?php 

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
    get_header();
    do_shortcode("[bbp-topic-form]")
?>


<div <?php generate_do_attr( 'content' ); ?>>
    <main <?php generate_do_attr( 'main' ); ?>>
        <?php



// Create a new WP_Query instance
$args = array(
    'post_type' => 'topic', // Change 'post' to your custom post type if needed
    //'meta_key' => 'bbp_voting_ups',
    //  'orderby' => 'meta_value_num',
    'order' => 'DESC',
    'posts_per_page' => 10
);

$query = new WP_Query($args);

// Check if there are any posts
if ($query->have_posts()) {
    $data = array();

    while ($query->have_posts()) {
        $query->the_post();
        $post_id = get_the_ID();
        $grade = get_post_meta($post_id, 'bbp_voting_ups', true);
        // Create an associative array with post_id and grade
        $data[] = array(
            'post_id' => $post_id,
            'grade' => $grade
        );
    }

    // Reset post data
    wp_reset_postdata();

    // Now, $data contains the results as an array of associative arrays.
    // You can iterate through $data to access the data as needed.
} else {
    // No posts found
}

// Your data processing logic here
foreach ($data as $row) {
    $post_id = $row['post_id'];
    $grade = $row['grade'];

    // Process each row of data here.
}

define('DB_SERVER', 'localhost');
   define('DB_USERNAME', DB_USER);
   define('DB_PASSWORD', DB_PASSWORD);
   define('DB_DATABASE', DB_NAME);
   $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);

    $query = "SELECT post_id, max(meta_value) AS grade 
 FROM wp_postmeta
 WHERE `meta_key` = 'bbp_voting_ups'
 GROUP BY post_id 
 LIMIT 10";


 $result = $db->query($query);
if (!$result) die ("newbase access failed: " . $connection->error);
 $row = $result->num_rows;
 
 for ($j = 0 ; $j < $rows ; ++$j)
 {
 $row = $result->fetch_array(MYSQLI_NUM);
 $comments[$j] = $row[0];
 }
$data = array();
while ($rows = mysqli_fetch_object($result))
{
    array_push($data, $rows);
}

$masterpiece_counter = 0;

if ( $data ) {
echo '<article class="rellax" data-rellax-speed="1"><div class="inside-article">   
<svg class="rellax" data-rellax-speed="1" viewbox="0 0 200 200" xmlns="http://www.w3.org/2000/svg"><path d="
                M 0, 73
                C 0, 41.61000000000001 41.61000000000001, 0 73, 0
                S 146, 41.61000000000001 146, 73
                    104.38999999999999, 146 73, 146
                    0, 104.38999999999999 0, 73
            " fill="#6CD410" transform="rotate(
                -39,
                100,
                100
            ) translate(
                27
                27
            )"></path></svg>     <h1 class="masterpiec-page-title">Шедеври</h1>
<ul class="masterpiece-container">';

    foreach ( $data as $topic ) {
        $masterpiece_counter++;
    $url = get_avatar_url( get_post_field( "post_author", $topic->post_id ), "size=24&default=monsterid");
    echo '<li data-aos="flip-left"
     data-aos-easing="ease-out-cubic"
     data-aos-duration="1000" data-aos-offset="-5"><div class="masterpiece"><span class="masterpiece-number">'.  $masterpiece_counter .'</span><a class="masterpiece-name" href="'.get_permalink( $topic->post_id ).'">' . get_the_title( $topic->post_id ) . '</a>' . '<img alt="" src="'. $url .'">' . '<span>' . get_the_author_meta( "display_name", get_post_field( "post_author", $topic->post_id )) . '</span>' . get_the_date('n-j-Y', $topic->post_id) . '<span class="masterpiece-grade">' . $topic->grade . '</span></div></li>';
    }

    echo '</ul></div></article>';    
}
 
 echo <<<_END
 
_END;

//    $db->close();
?>
    </main>
</div>

<?php

generate_construct_sidebars();

get_footer();
    