<form role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
	<div class="input-group">
		<input type="text" class="form-control" value="<?php the_search_query(); ?>" name="s" id="s">
		<span class="input-group-btn">
			<button class="btn btn-default" type="submit">
				<span class="glyphicon glyphicon-search"></span>
			</button>
		</span>
	</div>
	<!-- /.input-group -->
</form>