var pagetree = '';
jQuery(document).ready(function() {
		jQuery('#smPagetree .action-links').hide();
  		var pagetree = jQuery("#smPagetree #simpletree").simpletreeview({
		open: '<span class="open">&nbsp;</span>',
		close: '<span class="close">&nbsp;</span>',
		slide: false,
		speed: '400',
		collapsed: true,
		expand: '0.0'
	});
	jQuery("a#expand").click(function(e) {
    	pagetree.expand(jQuery("#smPagetree #simpletree ul")); // Same as '1.1'
		e.preventDefault();
	});
	jQuery("a#collapse").click(function(e) {
		pagetree.collapse(jQuery("#smPagetree #simpletree ul")); // Same as "ul#archives > li:eq(1) > ul > li:eq(1) > ul"
		jQuery('#simpletree').show();
		e.preventDefault();
	});
	jQuery(".leafname").click(function(e) {
		console.info(jQuery(this).parent().siblings('span.handle').trigger('click'));
		e.preventDefault();
	});
	
	jQuery("#smPagetree .treeleaflet").hover(
	  function () {
		jQuery(this).children('.action-links').show();
	  }, 
	  function () {
		jQuery(this).find('.action-links').hide();
	  }
	);
});