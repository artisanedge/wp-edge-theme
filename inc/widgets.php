<?php
class EdgeRecentPostsWidget extends WP_Widget {
	function EdgeRecentPostsWidget() {
		parent::__construct( false, __( 'Edge Recent Posts', 'edge' ) );
	}

	function widget( $args, $instance ) {
		extract( $args );
		echo $before_widget;
		if ( ! empty( $instance['title'] ) ) {
			echo $before_title;
			echo strip_tags( $instance['title'] );
			echo $after_title;
		}
		echo "<ul>";
		$num = 10;
		if ( ! empty( $instance['num'] ) ) {
			$num = $instance['num'];
		}
		$recent_posts = wp_get_recent_posts( array( 'numberposts' => $num, 'post_type' => 'post', 'post_status' => 'publish') );
		foreach ( $recent_posts as $post ) {
?>
			<li>
				<table>
					<tr>
						<td style="width: 85px; text-align: left;">
							<a href="<?php echo get_permalink( $post['ID'] ); ?>">
							<?php if ( has_post_thumbnail( $post['ID'] ) ) : ?>
								<?php echo get_the_post_thumbnail( $post['ID'], array( 75, 75 ), array( 'style' => 'border-style: solid; border-width: 1px; border-color: silver;') ); ?>
							<?php else : ?>
								<img src="http://placehold.it/75x75&text=No Image" style="border-style: solid; border-width: 1px; border-color: silver;">
							<?php endif; ?>
							</a>
						</td>
						<td style="vertical-align: top;">
							<a href="<?php echo get_permalink( $post['ID'] ); ?>">
								<?php echo $post["post_title"]; ?>
							</a>
						</td>
					</tr>
				</table>
			</li>
<?php			
		}
		echo "</ul>";
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['num'] = is_numeric( $new_instance['num'] ) ? $new_instance['num'] : 10;
		return $instance;
	}

	function form( $instance ) {
		$instance = wp_parse_args( $instance, array( 'title' => 'Recent Posts', 'num' => 10 ) );
		$title = strip_tags( $instance['title'] );
		$num = $instance['num'];
?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>">Title:</label><br>
			<input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('num'); ?>">Num:</label><br>
			<input id="<?php echo $this->get_field_id('num'); ?>" name="<?php echo $this->get_field_name('num'); ?>" type="text" value="<?php echo esc_attr( $num ); ?>">
		</p>
<?php
	}
}
add_action( 'widgets_init', function() {
	register_widget( 'EdgeRecentPostsWidget' );
} );

class EdgeProfileWidget extends WP_Widget {
	function EdgeProfileWidget() {
		parent::__construct( false, __( 'Edge Profile', 'edge' ) );
	}

	function widget( $args, $instance ) {
		extract( $args );
		echo $before_widget;
		if ( ! empty( $instance['title'] ) ) {
			echo $before_title;
			echo strip_tags( $instance['title'] );
			echo $after_title;
		}

		$email_hash = md5( strtolower( trim( get_bloginfo( 'admin_email' ) ) ) );
		$str = file_get_contents( "https://www.gravatar.com/$email_hash.php" );
		$profile = unserialize( $str );
		if ( is_array( $profile ) && isset( $profile['entry'] ) ) {
			$me = $profile['entry'][0];
?>
<table>
	<tr>
		<td style="vertical-align: top; height: 110px;">
			<img src="<?php echo $me['thumbnailUrl'] ?>?s=100" style="width: 100px; height: 100px;">
		</td>
		<td rowspan="2" style="vertical-align: top; padding-left: 10px;">
			<div style="font-size: 1.1em; font-weight: bold; margin-bottom: 8px;">
			<?php if ( ! empty( $instance['detail_url'] ) ) : ?>
				<a href="<?php echo $instance['detail_url']; ?>"><?php echo $me['name']['formatted'] ?></a>
			<?php else : ?>
				<?php echo $me['name']['formatted'] ?>
			<?php endif; ?>
			</div>
			<div style="font-size: 0.9em;">
				<?php echo $me['aboutMe'] ?>
			</div>
		</td>
	</tr>
	<tr>
		<td style="text-align: center; vertical-align: top;">
		<?php foreach( $me['accounts'] as $account ) : ?>
			<?php if ( $account['domain'] == 'twitter.com' ) : ?>
				<a href="<?php echo $account['url']; ?>" target="_blank"><i class="fa fa-twitter fa-lg"></i></a>
			<?php endif; ?>
			<?php if ( $account['domain'] == 'facebook.com' ) : ?>
				<a href="<?php echo $account['url']; ?>" target="_blank"><i class="fa fa-facebook-square fa-lg"></i></a>
			<?php endif; ?>
			<?php if ( $account['domain'] == 'plus.google.com' ) : ?>
				<a href="<?php echo $account['url']; ?>" target="_blank"><i class="fa fa-google-plus-square fa-lg"></i></a>
			<?php endif; ?>
		<?php endforeach; ?>
		<?php if ( ! empty( $instance['github_url'] ) ) : ?>
			<a href="<?php echo $instance['github_url']; ?>" target="_blank"><i class="fa fa-github fa-lg"></i></a>
		<?php endif; ?>
		</td>
	</tr>
</table>
<?php
		}

		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['detail_url'] = strip_tags( $new_instance['detail_url'] );
		$instance['github_url'] = strip_tags( $new_instance['github_url'] );
		return $instance;
	}

	function form( $instance ) {
		$instance = wp_parse_args( $instance, array( 'title' => 'Profile', 'num' => 10 ) );
		$title = strip_tags( $instance['title'] );
		$detailUrl = strip_tags( $instance['detail_url'] );
		$githubUrl = strip_tags( $instance['github_url'] );
?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>">Title:</label><br>
			<input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('detail_url'); ?>">Detail URL:</label><br>
			<input id="<?php echo $this->get_field_id('detail_url'); ?>" name="<?php echo $this->get_field_name('detail_url'); ?>" type="text" value="<?php echo esc_attr( $detailUrl ); ?>">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('github_url'); ?>">GitHub URL:</label><br>
			<input id="<?php echo $this->get_field_id('github_url'); ?>" name="<?php echo $this->get_field_name('github_url'); ?>" type="text" value="<?php echo esc_attr( $githubUrl ); ?>">
		</p>
<?php
	}
}
add_action( 'widgets_init', function() {
	register_widget( 'EdgeProfileWidget' );
} );
