<footer class="p-4 bg-secondary container">
  <?php
  wp_nav_menu([
    'theme_location' => 'footer_menu',
    'menu_class'    => 'list-group',
    'list_item_class'  => 'list-group-item bg-dark',
  ]);
  ?>
</footer>
<?php wp_footer() ?>
</body>

</html>