<?php /* Template Name: new topic page */ ?>
<?php 
// Display the front-end submission form
if (is_user_logged_in()) {
    ?>
<h2>Поділіться власним творінням</h2>
<form id="topic-submission-form" method="post">
    <label for="title">Назва:</label>
    <input type="text" id="title" name="title" required><br>

    <label for="content">Зміст:</label>
    <textarea id="content" name="content" required></textarea><br>

    <!-- You can add more custom fields here if needed -->

    <input type="submit" name="submit_topic" value="Submit">
</form>
<?php
} else {
    echo 'Перш ніж опублікувати твір, мусите зареєструватись!';
}

// Handle form submission
if (isset($_POST['submit_topic']) && is_user_logged_in()) {
    $post_title = sanitize_text_field($_POST['title']);
    $post_content = wp_kses_post($_POST['content']);
    
    $new_topic = array(
        'post_title' => $post_title,
        'post_content' => $post_content,
        'post_type' => 'topic',
        'post_status' => 'draft',
    );
    
    $post_id = wp_insert_post($new_topic);

    // You can add more code here to handle custom fields if needed

    if (!is_wp_error($post_id)) {
        echo 'Ви успішно завантажили свій твір і за якийсь час, якщо він пройде перевірку, він буде опублікований!';
    } else {
        echo 'Щось пішло не так Спробуйте ще раз!.';
    }
}
?>