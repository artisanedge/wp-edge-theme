	<!-- Navigation -->
	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="<?php edge_container_class(); ?>">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="navbar-brand"><?php bloginfo( 'name' ); ?></a>
			</div>
			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
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
			</div>
			<!-- /.navbar-collapse -->
		</div>
		<!-- /.container -->
	</nav>
