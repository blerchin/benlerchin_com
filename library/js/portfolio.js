function portfolio_ajax() {
	var $portfolio = jQuery('.portfolio');
	var $grid = $portfolio.packery({
			itemSelector: '.portfolio-piece',
			initLayout: false
	});
	$grid.imagesLoaded(function() {
		$grid.packery();
	});

	jQuery('.portfolio .portfolio-piece .portfolio-closed').click(function(e) {
		e.preventDefault();
		var $piece = jQuery(this).parent();

		//if other pieces open, close them
		var $open = jQuery('.portfolio-piece.portfolio-open')
				.removeClass('portfolio-open')
		$open.children('.portfolio-open').hide(400);
		$open.children('.portfolio-closed').show(400, 'swing', function() {
								$portfolio.packery();
		});
		//if content already loaded, show
		if( $piece.children('.portfolio-open').length != 0 ){
			$piece.children('.portfolio-open').show();
			$piece.addClass('portfolio-open');
			$piece.children('.portfolio-closed').hide(400, 'swing', function() {
								$portfolio.packery('fit', $piece.get()[0], 0, 0);
			});
		//otherwise retrieve content and create closed/open divs
		} else {
			$piece.append("<img class='preloader' src='wp-content/themes/blerchin/library/images/preloader.gif' />");
			var src = $piece.find('h3 a').attr('href');
			function replace(html) {
				$piece.find('img.preloader').remove();
				var details = jQuery.parseHTML(html);
				var $p_open = jQuery("<div class='portfolio-open'>").appendTo($piece);
				$p_open.append("<a href='#' class='portfolio-button-close'>close</a>");
				$p_open.append( jQuery(details).find('article.portfolio-piece'));
				$p_open.find('h2').wrapInner("<a href='"+src+"'>");
				$piece.addClass('portfolio-open');
				if (window.innerWidth > 768) {
					var min_height = ($piece.parent().children().get().length - 1) * $piece.find('.portfolio-closed').height();
					$p_open.css('min-height', min_height);
				}
				$piece.children('.portfolio-closed').hide(400, 'swing', function() {
									$portfolio.packery('fit', $piece.get()[0], 0, 0);
				});
				// bind close function to just-created close button
				jQuery('.portfolio .portfolio-piece .portfolio-open a.portfolio-button-close').click(function(e) {
					e.preventDefault();
					jQuery(this).parent().hide();
					var $piece = jQuery(this).parent().parent();
					$piece.removeClass('portfolio-open');
					$piece.children('.portfolio-closed').show(400, 'swing', function() {
						$portfolio.packery();
					});
					return false;
				});
			}
			jQuery.ajax({
				url: src,
				type: "GET",
				datatype: "html",
				success: replace
			});
		}
		return false;
	});
}
