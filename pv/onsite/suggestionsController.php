<?php
$user_history
$similar_events
if (!empty($similar_events)) {
    echo "<h2>Événements similaires :</h2>";
    echo "<ul>";
    foreach ($similar_events as $event) {
        echo "<li><a href='event_details.php?id={$event['id']}'>{$event['name']}</a></li>";
    }
    echo "</ul>";
} else {
    echo "<p>Aucun événement similaire trouvé.</p>";
}
?>
