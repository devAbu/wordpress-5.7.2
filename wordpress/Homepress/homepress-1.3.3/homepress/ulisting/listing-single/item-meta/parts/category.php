<div class="listing-category-list">
    <?php foreach ( $model->getCategory() as $category ) : ?>
        <span><?php echo esc_attr( $category->name ); ?></span>
    <?php endforeach; ?>
</div>