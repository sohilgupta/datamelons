<div class="grid_6 alpha">
    <div class="footer_columns first">
        <?php if (is_active_sidebar('first-footer-widget-area')) : ?>
            <?php dynamic_sidebar('first-footer-widget-area'); ?>
        <?php else : ?>
        <?php endif; ?>
    </div>
</div>
<div class="grid_6">
    <div class="footer_columns second">
        <?php if (is_active_sidebar('second-footer-widget-area')) : ?>
            <?php dynamic_sidebar('second-footer-widget-area'); ?>
        <?php else : ?> 
        <?php endif; ?> 
    </div>
</div>
<div class="grid_6">
    <div class="footer_columns third">
        <?php if (is_active_sidebar('third-footer-widget-area')) : ?>
            <?php dynamic_sidebar('third-footer-widget-area'); ?>
        <?php else : ?>
        <?php endif; ?>
    </div>
</div>
<div class="grid_6 omega">
    <div class="footer_columns last">
        <?php if (is_active_sidebar('fourth-footer-widget-area')) : ?>
            <?php dynamic_sidebar('fourth-footer-widget-area'); ?>
        <?php else : ?>
        <?php endif; ?>
    </div>
</div>
<!-- ***********************Footer Page Ends************************* -->

