<div class="widget-search">
	<form name="search" novalidate method="get" action="<?php echo esc_url(home_url('/')); ?>">
        <fieldset>
            <input id="s" type="search" name="s" placeholder="<?php esc_attr_e('', 'sigma'); ?>" required>
            <label for="s"><?php esc_attr_e('Search', 'sigma'); ?></label>
            <button type="submit"><i class="fa fa-search"></i></button>
        </fieldset>
    </form>
</div>
