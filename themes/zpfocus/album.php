<?php include("inc-header.php"); ?>
<?php include("inc-sidebar.php"); ?>
		
<div class="right">
	<?php if ($zpfocus_social) include ("inc-social.php"); ?>
	<h1 id="tagline"><?php printParentBreadcrumb("", " / ", " / "); printAlbumTitle(); ?></h1>		
	
	<?php if ($zpfocus_logotype) { ?>
	<a style="display:block;" href="<?php echo getGalleryIndexURL(); ?>"><img src="<?php echo $_zp_themeroot; ?>/images/<?php echo $zpfocus_logofile; ?>" alt="<?php echo getBareGalleryTitle(); ?>" /></a>
	<?php } else { ?>
	<h2 id="logo"><a href="<?php echo getGalleryIndexURL(); ?>"><?php echo getBareGalleryTitle(); ?></a></h2>
	<?php } ?>
	
	<div class="album-details">
		<?php printAlbumDate('','',null,true); ?>
		<div class="album-tags"><?php printTags( 'links',gettext('| Tags:  '),'taglist',', ',true,'',true  ); ?></div>
	</div>
	<p class="description"><?php printAlbumDesc( true,'',gettext('Edit Description...') ); ?></p>
	
	<?php if (isAlbumPage()) { ?>
	<div class="subalbum-wrap">
		<h4 class="blockhead"><span><?php echo gettext('SubAlbums in '); echo getBareAlbumTitle(); ?> (<?php echo getNumAlbums(); ?>)</span></h4>
		<ul>
			<?php $x = 1; 
				while (next_album()):
				if( $odd = $x%2 ) {
					$css = 'goleft';
					} else {
					$css = 'goright';
				} ?>
			<li class="<?php echo $css; ?>">	
				<h4><a href="<?php echo htmlspecialchars(getAlbumURL());?>" title="<?php echo gettext('View SubAlbum:'); ?> <?php echo getBareAlbumTitle();?>"><?php echo truncate_string(getBareAlbumTitle(), 20, '...'); ?></a></h4>
				<a class="thumb" href="<?php echo htmlspecialchars(getAlbumURL());?>" title="<?php echo gettext('View SubAlbum:'); ?> <?php echo getBareAlbumTitle();?>">
					<?php if (isLandscape()) {
						printCustomAlbumThumbImage(getBareAlbumTitle(), null, 160, 120, 160, 120);
						} else {
						printCustomAlbumThumbImage(getBareAlbumTitle(), null, 120, 160, 120, 160);
					} ?>
				</a>					
				<span class="front-date"><?php printAlbumDate(); ?></span>
				<p class="front-desc">
					<?php echo truncate_string(getAlbumDesc(), 175); ?>
					<a href="<?php echo htmlspecialchars(getAlbumURL());?>" title="<?php echo gettext('View SubAlbum:'); ?> <?php echo getBareAlbumTitle();?>">&raquo;</a>
				</p>
			</li>
			<?php $x = $x+1; 
			endwhile; ?>			
		</ul>
	</div>
	<?php } ?>
	
	<?php if ((getNumImages()) > 0) { ?>
	
	<h4 class="blockhead">
		<?php if ($useGslideshow) { ?>
			<div class="slideshowlink"><?php printSlideShowLink(gettext('Slideshow')); ?></div>
		<?php } elseif ($zpfocus_use_colorbox_slideshow) { ?>
			<?php 
			$x=0; 
			while (next_image(true)): 
				if ($x>=1) { 
					$show='style="display:none;"'; 
				} else { 
					$show=''
				} 
			?>
		<?php if (!isImageVideo()) { ?>
				<a class="slideshowlink"<?php echo $show; ?> rel="slideshow" href="<?php if ($zpfocus_cbtarget) { echo htmlspecialchars(getDefaultSizedImage()); } else { echo htmlspecialchars(getUnprotectedImageURL()); } ?>" title="<?php echo getBareImageTitle();?>"><?php echo gettext('Play Slideshow'); ?></a>
			<?php $x=$x+1; } ?>
		<?php endwhile; ?>
		<?php } ?>
		<span><?php echo gettext('Images in '); echo getBareAlbumTitle(); ?> (<?php echo getNumImages(); ?>)</span>
	</h4>
	
	<div class="image-wrap">
		<ul>
			<?php while (next_image()): ?>
			<?php if (isLandscape()) { ?>
			<li class="thumb-landscape">
				<div class="album-tools-landscape">
						<?php if ( ($zpfocus_use_colorbox) &&  (!isImageVideo()) ) { ?><a class="album-tool" rel="zoom" href="<?php if ($zpfocus_cbtarget) { echo htmlspecialchars(getDefaultSizedImage()); } else { echo htmlspecialchars(getUnprotectedImageURL()); } ?>" title="<?php echo getBareImageTitle();?>"><img src="<?php echo $_zp_themeroot; ?>/images/search.png" alt="Zoom Image" /></a><?php } ?>
						<?php if ((getCommentCount()) > 0) { ?>
						<a class="album-tool" href="<?php echo htmlspecialchars(getImageURL());?>" title="<?php echo getCommentCount();?> Comments"><img src="<?php echo $_zp_themeroot; ?>/images/shout.png" alt="Comments" /></a>
						<?php } ?>
				</div>
				<a class="thumb" href="<?php echo htmlspecialchars(getImageURL());?>" title="<?php echo getBareImageTitle();?>">
					<?php printCustomSizedImage(getBareImageTitle(),null,160,120,160,120,null,null,'thumb',null,true); ?>
				</a>						
			<?php } else { ?>
			<li class="thumb-portrait">
				<div class="album-tools-portrait">
						<?php if ( ($zpfocus_use_colorbox) &&  (!isImageVideo()) ) { ?><a class="album-tool" rel="zoom" href="<?php if ($zpfocus_cbtarget) { echo htmlspecialchars(getDefaultSizedImage()); } else { echo htmlspecialchars(getUnprotectedImageURL()); } ?>" title="<?php echo getBareImageTitle();?>"><img src="<?php echo $_zp_themeroot; ?>/images/search.png" alt="Zoom Image" /></a><?php } ?>
						<?php if ((getCommentCount()) > 0) { ?>
						<a class="album-tool" href="<?php echo htmlspecialchars(getImageURL());?>" title="<?php echo getCommentCount();?> Comments"><img src="<?php echo $_zp_themeroot; ?>/images/shout.png" alt="Comments" /></a>
						<?php } ?>
				</div>
				<a class="thumb" href="<?php echo htmlspecialchars(getImageURL());?>" title="<?php echo getBareImageTitle();?>">
					<?php printCustomSizedImage(getBareImageTitle(),null,120,160,120,160,null,null,'thumb',null,true); ?>					
				</a>
			<?php } ?>
			</li>
			<?php endwhile; ?>
		</ul>
	</div>
	<?php } ?>
	
	<?php if ( (getPrevPageURL()) || (getNextPageURL()) ) { 
			printPageListWithNav('« '.gettext('Prev'), gettext('Next').' »',false,'true','page-nav','',true,'5' ); ?>
	 } 
	 ?>
	
	<?php if (function_exists('printGoogleMap')) { ?>
			<div class="gmap">
		<?php setOption('gmap_width',600,false); printGoogleMap(); ?>
			</div>
	<?php } ?>
	<?php printCodeblock(); ?>
	<?php if (function_exists('printCommentForm')) printCommentForm(); ?>
	
</div>

<?php include("inc-footer.php"); ?>