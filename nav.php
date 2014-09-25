	<!-- Navigation -->
	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="<?php edge_container_class(); ?>">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-1">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="navbar-brand"><?php bloginfo( 'name' ); ?></a>
			</div>
			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse" id="navbar-collapse-1">
				<ul class="nav navbar-nav">
				<?php if ( has_nav_menu( 'primary' ) ) : ?>
					<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
				<?php else : ?>
					<li>
						<a href="<?php bloginfo('siteurl'); ?>/about/">About</a>
					</li>
					<li>
						<a href="<?php bloginfo('siteurl'); ?>/contact/">Contact</a>
					</li>
				<?php endif; ?>
				</ul>
				<div class="navbar-right">
					<form class="navbar-form" role="search" method="get" action="<?php echo home_url( '/' ); ?>">
						<div class="input-group">
							<input type="text" class="form-control" value="<?php the_search_query(); ?>" name="s" id="s" placeholder="<?php _e( 'Search &hellip;', 'edge' ); ?>">
							<span class="input-group-btn">
								<button class="btn btn-default" type="submit">
									<span class="glyphicon glyphicon-search"></span>
								</button>
							</span>
						</div>
					</form>
				</div>
			</div>
			<!-- /.navbar-collapse -->
		</div>
		<!-- /.container -->
	</nav>
