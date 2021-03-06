<?php
/*
 * Template Name: Home page
 */

get_header();
include_once('inc/inc-home.php');
?>

<div class="container">
	
	<div class="band" id="home-latest-activity">
		<h2>Activity around the UK</h2>
		
		<div role="tabpanel">

			<!-- Nav tabs -->
			<?php if( have_rows('country_tabs') ) : $i = 0; ?>
			<ul class="nav nav-tabs" role="tablist">
				<?php while ( have_rows('country_tabs') ) : the_row(); $term = get_term( get_sub_field('country'), 'countries' ); ?>
				<li role="presentation" <?php if ($i == 0) : ?>class="active"<?php endif ?>><a href="#<?= $term->slug?>" aria-controls="<?= $term->slug ?>" role="tab" data-toggle="tab"><?= $term->name ?></a></li>
				<?php $i++; endwhile ?>
			</ul><!--.nav-->
			<?php endif; wp_reset_postdata(); ?>

			<?php if( have_rows('country_tabs') ) : $i = 0; ?>
			<!-- Tab content -->
			<div class="tab-content">
				<?php while ( have_rows('country_tabs') ) : the_row(); $term = get_term( get_sub_field('country'), 'countries' ); ?>
				<!-- Tab pane -->
				<div role="tabpanel" class="tab-pane <?php if ($i == 0) : ?>active<?php endif ?>" id="<?php echo $term->slug ?>">
					<div class="row wide-gutter-row">
						<div class="col-sm-4 wide-gutter-col">
							<h3><?php echo $term->name ?></h3>
							<p><?php echo get_sub_field('intro_text') ?></p>
							<?php if (get_sub_field('link')) : ?>
							<p><a href="<?php echo get_permalink(get_sub_field('link')) ?>" class="btn btn-primary">Read more</a></p>
							<?php endif ?>
						</div>
						<div class="col-sm-4 wide-gutter-col">
							<?php 
							$activityposts = array('post_type' => 'post', 'posts_per_page' => 3, 'countries' => $term->slug ); 
							$activity_query = new WP_Query( $activityposts ); 
							?>
							<h3>Latest posts</h3>
							<?php if ( $activity_query->have_posts() ) : ?>
							<ul>
								<?php while ( $activity_query->have_posts() ) : $activity_query->the_post(); ?>
								<li><a href="<?php echo get_permalink() ?>"><?php echo get_the_title() ?></a></li>
								<?php endwhile; wp_reset_postdata(); ?>
							</ul>
							<?php endif ?>
						</div>
						<div class="col-sm-4 wide-gutter-col">
							<?php if (get_sub_field('feature_image')) : ?>
							<p>
								<?php if (get_sub_field('feature_link')) : ?><a target="_blank" href="<?php echo get_sub_field('feature_link') ?>"><?php endif ?>
								<img src="<?php echo get_sub_field('feature_image')['sizes']['tab-feature'] ?>" alt="" class="img-responsive">
								<?php if (get_sub_field('feature_link')) : ?></a><?php endif ?>
							</p>
							<?php endif ?>
							<?php if (get_sub_field('feature_text')) : ?>
							<p><?= get_sub_field('feature_text') ?></p>
							<?php endif ?>
						</div>
					</div>
				</div><!--.tabpanel-->
				<?php $i++; endwhile ?>
			</div><!--.tab-content-->
			<?php endif ?>

		</div><!--.tabpanel-->
	</div><!--.home-latest-activity-->

	<?php if( have_rows('featured_text') ): ?>
	<div class="band" id="home-features">
		<div class="bg-red home-features">
			<div class="row wide-gutter-row">
				<?php while ( have_rows('featured_text') ) : the_row(); ?>
				<div class="col-sm-4 wide-gutter-col text-center">
					<img src="<?php echo get_sub_field('icon')['sizes']['thumbnail'] ?>" class="img-responsive" alt="" height="" width="">
					<h3><?php echo get_sub_field('title') ?></h3>
					<p><?php echo get_sub_field('text') ?></p>
				</div>
				<?php endwhile ?>
			</div>
		</div><!--.bg-red-->
	</div><!--.home-features-->
	<?php endif ?>

	<div class="band" id="home-latest-updates">
		<div class="row wide-gutter-row">
			<div class="col-sm-8 wide-gutter-col">
				<h2>Latest updates</h2>
				<?php $i = 0; if ( $the_query->have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
				<?php if ($i !== 0 ) : ?><hr><?php endif; ?>
				<div class="media">
					<?php if (has_post_thumbnail()) : 
					$attachment_id = get_post_thumbnail_id( get_the_ID());
					$imgsrc = wp_get_attachment_image_src( $attachment_id, 'small-thumb' );
					?>
					<div class="media-left">
						<a href="<?php echo get_permalink() ?>"><img class="media-object margin-top-3" src="<?php echo $imgsrc[0] ?>" alt="..."></a>
					</div>
					<?php endif ?>
					<div class="media-body">
						<h3 class="media-heading"><a href="<?php echo get_permalink() ?>"><?php echo get_the_title() ?></a></h3>
						<p class="small meta"><?php echo get_the_date() ?> &ndash; <?php echo comments_number() ?></p>
						<p><?php echo wp_trim_words(get_the_excerpt(), '40') ?></p>
					</div>
				</div><!--.media-->
				<?php $i++; endwhile; endif; wp_reset_postdata(); ?>
			</div>
			<div class="col-sm-4 wide-gutter-col">
				<h2><?= get_field('twitter_title') ?></h2>
				<?= get_field('twitter_embed') ?>
			</div>
		</div>
	</div><!--.home-latest-updates-->

	<hr class="band-divider">

	<div class="band" id="home-events">
		<div class="row">
			<div class="col-sm-6 event-list">
				<h2>Coming up</h2>
				<?php if ($uevents_query->have_posts()) : ?>
				<?php while ( $uevents_query->have_posts() ) : $uevents_query->the_post(); ?>
				<article class="media">
					<div class="media-left">
						<date class="date"><span><?php echo date('d', strtotime(get_field('start_date'))) ?></span><?php echo date('M', strtotime(get_field('start_date'))) ?></date>
					</div>
					<div class="media-body">
						<h3 class="media-heading"><a href="<?php echo get_permalink() ?>"><?php echo get_the_title() ?></a></h3>
						<p><?php echo get_field('location') ?></p>
					</div>
				</article><!--.media-->
				<?php endwhile ?>
				<?php else : ?>
				<p>No upcoming events.</p>
				<?php endif; wp_reset_postdata(); ?>
			</div>
			<div class="col-sm-6 event-list">
				<h2>Recent</h2>
				<?php if ($revents_query->have_posts()) : ?>
				<?php while ( $revents_query->have_posts() ) : $revents_query->the_post(); ?>
				<article class="media">
					<div class="media-left">
						<date class="date"><span><?php echo date('d', strtotime(get_field('start_date'))) ?></span><?php echo date('M', strtotime(get_field('start_date'))) ?></date>
					</div>
					<div class="media-body">
						<h3 class="media-heading"><a href="<?php echo get_permalink() ?>"><?php echo get_the_title() ?></a></h3>
						<p><?php echo get_field('location') ?></p>
					</div>
				</article><!--.media-->
				<?php endwhile ?>
				<?php else : ?>
				<p>No recent events.</p>
				<?php endif; wp_reset_postdata(); ?>
			</div>
		</div>
	</div><!--.band#home-events-->

</div><!--.container-->

<?php get_footer() ?>
