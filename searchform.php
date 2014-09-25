<form role="search" method="get" action="<?php echo home_url( '/' ); ?>">
	<div class="input-group">
		<input type="text" class="form-control" value="<?php the_search_query(); ?>" name="s" id="s" placeholder="<?php _e( 'Search &hellip;', 'edge' ); ?>">
		<span class="input-group-btn">
			<button class="btn btn-default" type="submit">
				<span class="glyphicon glyphicon-search"></span>
			</button>
		</span>
	</div>
	<!-- /.input-group -->
</form>