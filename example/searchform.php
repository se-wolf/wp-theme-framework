<form id="searchform" method="get" action="<?php echo home_url('/'); ?>">
	<input type="text" id="search-field" class="search-field" name="s" value="<?php the_search_query(); ?>">
	<input id ="search-submit" type="submit" value="Suchen" />
	<label for="search-submit"></label>
</form>