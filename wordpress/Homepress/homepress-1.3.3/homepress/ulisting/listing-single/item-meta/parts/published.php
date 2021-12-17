<div class="listing-published">
<?php
    $posted = get_the_time( 'U' );
    echo human_time_diff( $posted, current_time( 'U' ) ) . __(' ago', 'homepress');
?>
</div>
