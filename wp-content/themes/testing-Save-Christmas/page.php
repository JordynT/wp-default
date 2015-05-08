<?php get_header(); ?>
<div id="main" class="site-main">

	<header class="page-header arrowed">
		<h1 class="page-title"><?php the_title(); ?></h1>
	</header>

	<div class="container">
		<div id="primary" class="content-area">
			<div id="content" class="site-content" role="main">


				<article id="post-189" class="post-189 page type-page status-publish hentry">


					<div class="entry-content">
						<h2><?php the_title(); ?></h2>

						<?php the_content(); ?>
<!---->
<!---->
<!--						<div class='gf_browser_chrome gform_wrapper' id='gform_wrapper_1'><a id='gf_1' name='gf_1'-->
<!--																							 class='gform_anchor'></a>-->
<!---->
<!--							<form method='post' enctype='multipart/form-data' target='gform_ajax_frame_1' id='gform_1'-->
<!--								  action='/contact/#gf_1'>-->
<!--								<div class='gform_body'>-->
<!--									<ul id='gform_fields_1'-->
<!--										class='gform_fields top_label form_sublabel_below description_below'>-->
<!--										<li id='field_1_1'-->
<!--											class='gfield gfield_contains_required field_sublabel_below field_description_below'>-->
<!--											<label class='gfield_label' for='input_1_1'>Name<span-->
<!--													class='gfield_required'>*</span></label>-->
<!---->
<!--											<div class='ginput_container'>-->
<!--												<input name='input_1' id='input_1_1' type='text' value='' class='medium'-->
<!--													   tabindex='1'/>-->
<!--											</div>-->
<!--										</li>-->
<!--										<li id='field_1_2'-->
<!--											class='gfield gfield_contains_required field_sublabel_below field_description_below'>-->
<!--											<label class='gfield_label' for='input_1_2'>Email<span-->
<!--													class='gfield_required'>*</span></label>-->
<!---->
<!--											<div class='ginput_container'>-->
<!--												<input name='input_2' id='input_1_2' type='text' value='' class='medium'-->
<!--													   tabindex='2'/>-->
<!--											</div>-->
<!--										</li>-->
<!--										<li id='field_1_3' class='gfield field_sublabel_below field_description_below'>-->
<!--											<label class='gfield_label' for='input_1_3'>Phone</label>-->
<!---->
<!--											<div class='ginput_container'><input name='input_3' id='input_1_3'-->
<!--																				 type='text' value='' class='medium'-->
<!--																				 tabindex='3'/></div>-->
<!--										</li>-->
<!--										<li id='field_1_4'-->
<!--											class='gfield gfield_contains_required field_sublabel_below field_description_below'>-->
<!--											<label class='gfield_label' for='input_1_4'>Message / Question<span-->
<!--													class='gfield_required'>*</span></label>-->
<!---->
<!--											<div class='ginput_container'>-->
<!--                                    <textarea name='input_4' id='input_1_4' class='textarea medium'-->
<!--											  tabindex='4' rows='10' cols='50'></textarea>-->
<!--											</div>-->
<!--										</li>-->
<!--									</ul>-->
<!--								</div>-->
<!--								<div class='gform_footer top_label'><input type='submit' id='gform_submit_button_1'-->
<!--																		   class='gform_button button' value='Submit'-->
<!--																		   tabindex='5'-->
<!--																		   onclick='if(window["gf_submitting_1"]){return false;}  window["gf_submitting_1"]=true;  '/>-->
<!--									<input type='hidden' name='gform_ajax'-->
<!--										   value='form_id=1&amp;title=&amp;description=&amp;tabindex=1'/>-->
<!--									<input type='hidden' class='gform_hidden' name='is_submit_1' value='1'/>-->
<!--									<input type='hidden' class='gform_hidden' name='gform_submit' value='1'/>-->
<!---->
<!--									<input type='hidden' class='gform_hidden' name='gform_unique_id' value=''/>-->
<!--									<input type='hidden' class='gform_hidden' name='state_1'-->
<!--										   value='WyJbXSIsIjI3YmYxY2YxOGFkZDcyMTFhYjg1ODE3NjczNWFkMmNkIl0='/>-->
<!--									<input type='hidden' class='gform_hidden' name='gform_target_page_number_1'-->
<!--										   id='gform_target_page_number_1' value='0'/>-->
<!--									<input type='hidden' class='gform_hidden' name='gform_source_page_number_1'-->
<!--										   id='gform_source_page_number_1' value='1'/>-->
<!--									<input type='hidden' name='gform_field_values' value=''/>-->
<!---->
<!--								</div>-->
<!--							</form>-->
						</div>
						<iframe style='display:none;width:0px;height:0px;' src='about:blank' name='gform_ajax_frame_1'
								id='gform_ajax_frame_1'></iframe>
<!--						<script type='text/javascript'>jQuery(document).ready(function ($) {-->
<!--								gformInitSpinner(1, 'http://saveachristmas.com/wp-content/plugins/gravityforms/images/spinner.gif');-->
<!--								jQuery('#gform_ajax_frame_1').load(function () {-->
<!--									var contents = jQuery(this).contents().find('*').html();-->
<!--									var is_postback = contents.indexOf('GF_AJAX_POSTBACK') >= 0;-->
<!--									if (!is_postback) {-->
<!--										return;-->
<!--									}-->
<!--									var form_content = jQuery(this).contents().find('#gform_wrapper_1');-->
<!--									var is_confirmation = jQuery(this).contents().find('#gform_confirmation_wrapper_1').length > 0;-->
<!--									var is_redirect = contents.indexOf('gformRedirect(){') >= 0;-->
<!--									var is_form = form_content.length > 0 && !is_redirect && !is_confirmation;-->
<!--									if (is_form) {-->
<!--										jQuery('#gform_wrapper_1').html(form_content.html());-->
<!--										setTimeout(function () { /* delay the scroll by 50 milliseconds to fix a bug in chrome */-->
<!--											jQuery(document).scrollTop(jQuery('#gform_wrapper_1').offset().top);-->
<!--										}, 50);-->
<!--										if (window['gformInitDatepicker']) {-->
<!--											gformInitDatepicker();-->
<!--										}-->
<!--										if (window['gformInitPriceFields']) {-->
<!--											gformInitPriceFields();-->
<!--										}-->
<!--										var current_page = jQuery('#gform_source_page_number_1').val();-->
<!--										gformInitSpinner(1, 'http://saveachristmas.com/wp-content/plugins/gravityforms/images/spinner.gif');-->
<!--										jQuery(document).trigger('gform_page_loaded', [1, current_page]);-->
<!--										window['gf_submitting_1'] = false;-->
<!--									} else if (!is_redirect) {-->
<!--										var confirmation_content = jQuery(this).contents().find('#gforms_confirmation_message_1').html();-->
<!--										if (!confirmation_content) {-->
<!--											confirmation_content = contents;-->
<!--										}-->
<!--										setTimeout(function () {-->
<!--											jQuery('#gform_wrapper_1').replaceWith('<' + 'div id=\'gforms_confirmation_message_1\' class=\'gform_confirmation_message_1 gforms_confirmation_message\'' + '>' + confirmation_content + '<' + '/div' + '>');-->
<!--											jQuery(document).scrollTop(jQuery('#gforms_confirmation_message_1').offset().top);-->
<!--											jQuery(document).trigger('gform_confirmation_loaded', [1]);-->
<!--											window['gf_submitting_1'] = false;-->
<!--										}, 50);-->
<!--									} else {-->
<!--										jQuery('#gform_1').append(contents);-->
<!--										if (window['gformRedirect']) {-->
<!--											gformRedirect();-->
<!--										}-->
<!--									}-->
<!--									jQuery(document).trigger('gform_post_render', [1, current_page]);-->
<!--								});-->
<!--							});</script>-->
<!--						<script type='text/javascript'> if (typeof gf_global == 'undefined') var gf_global = {-->
<!--								"gf_currency_config": {-->
<!--									"name": "U.S. Dollar",-->
<!--									"symbol_left": "$",-->
<!--									"symbol_right": "",-->
<!--									"symbol_padding": "",-->
<!--									"thousand_separator": ",",-->
<!--									"decimal_separator": ".",-->
<!--									"decimals": 2-->
<!--								},-->
<!--								"base_url": "http:\/\/saveachristmas.com\/wp-content\/plugins\/gravityforms",-->
<!--								"number_formats": [],-->
<!--								"spinnerUrl": "http:\/\/saveachristmas.com\/wp-content\/plugins\/gravityforms\/images\/spinner.gif"-->
<!--							};-->
<!--							jQuery(document).bind('gform_post_render', function (event, formId, currentPage) {-->
<!--								if (formId == 1) {-->
<!--									if (!/(android)/i.test(navigator.userAgent)) {-->
<!--										jQuery('#input_1_3').mask('(999) 999-9999').bind('keypress', function (e) {-->
<!--											if (e.which == 13) {-->
<!--												jQuery(this).blur();-->
<!--											}-->
<!--										});-->
<!--									}-->
<!--								}-->
<!--							});-->
<!--							jQuery(document).bind('gform_post_conditional_logic', function (event, formId, fields, isInit) {-->
<!--							});</script>-->
<!--						<script type='text/javascript'> jQuery(document).ready(function () {-->
<!--								jQuery(document).trigger('gform_post_render', [1, 1])-->
<!--							}); </script>-->


					</div>
				</article>
				<!-- #post -->
				<div id="comments" class="comments-area">


				</div>
				<!-- #comments -->

			</div>
			<!-- #content -->
		</div>
		<!-- #primary -->

		<div id="tertiary" class="sidebar-container" role="complementary">
			<div class="blog-widget-area">
				<aside id="text-8" class="blog-widget widget_text"><h3 class="blog-widget-title">Thanks!</h3>

					<div class="textwidget">Thanks for your interest in our charity. Please note we are not officially
						running under a non-profit, so we can provide no receipts for tax deductible donations. If you
						know if a non-profit proxy that may collect on our behalf, feel free to give us a referral!
					</div>
				</aside>
			</div>
		</div>
		<!-- #tertiary -->    </div>


</div><!-- #main -->
<footer id="colophon" class="site-footer" role="contentinfo">

	<div class="footer-social">
		<a class="rss" href="http://saveachristmas.com/feed/"><i class="icon-rss"></i></a>
		<a class="twitter hidden" href=""><i class="icon-twitter"></i></a>
		<a class="facebook hidden" href=""><i class="icon-facebook"></i></a>
		<a class="linkedin hidden" href=""><i class="icon-linkedin"></i></a>
		<a class="gplus hidden" href=""><i class="icon-gplus"></i></a>
		<a class="pinterest hidden" href=""><i class="icon-pinterest"></i></a>
		<a class="instagram hidden" href=""><i class="icon-instagram"></i></a>
		<a class="vimeo hidden" href=""><i class="icon-vimeo"></i></a>

		<a href="#" class="btt"><i class="icon-up-open-big"></i></a>
	</div>

	<div class="copyright container">
		<div class="site-info">
			&copy; 2015 Save A Christmas. All Rights Reserved
		</div>
		<!-- .site-info -->

		<nav id="site-footer-navigation" class="footer-navigation">
			<div class="menu-footer-menu-container">
				<ul id="menu-footer-menu" class="nav-menu">
					<li id="menu-item-445"
						class="menu-item menu-item-type-custom menu-item-object-custom menu-item-445"><a
							href="/">Home</a></li>
					<li id="menu-item-444"
						class="menu-item menu-item-type-post_type menu-item-object-page current-menu-item page_item page-item-189 current_page_item menu-item-444">
						<a href="http://saveachristmas.com/contact/">Contact</a></li>
				</ul>
			</div>
		</nav>
	</div>
</footer><!-- #colophon -->
</div><!-- #page -->


<div id="login-modal-wrap" class="modal-login modal">
	<h2 class="modal-title">Sign In</h2>

	<div class="atcf-login">
		<form name="loginform" id="loginform" action="http://saveachristmas.com/wp-login.php?wpe-login=saveachristmas"
			  method="post">

			<p class="login-username">
				<label for="user_login">Username</label>
				<input type="text" name="log" id="user_login" class="input" value="" size="20"/>
			</p>

			<p class="login-password">
				<label for="user_pass">Password</label>
				<input type="password" name="pwd" id="user_pass" class="input" value="" size="20"/>
			</p>

			<p class="login-remember"><label><input name="rememberme" type="checkbox" id="rememberme" value="forever"/>
					Remember Me</label></p>

			<p class="login-submit">
				<input type="submit" name="wp-submit" id="wp-submit" class="button-primary" value="Log In"/>
				<input type="hidden" name="redirect_to" value="http://saveachristmas.com/contact/"/>
			</p>

			<p>
				<a href="http://saveachristmas.com/wp-login.php?action=lostpassword">Forgot Password</a> or <a
					href="http://saveachristmas.com/sign-up/">Register</a></p>
		</form>
	</div>
</div>
<div id="register-modal-wrap" class="modal-register modal">
	<h2 class="modal-title">Sign Up</h2>

	<p>Currently signup is not possible.</p>
</div>
<script type='text/javascript'
		src='http://saveachristmas.com/wp-content/themes/campaignify/js/jquery.magnific-popup.min.js?ver=2.1.4'></script>
<script type='text/javascript'
		src='http://saveachristmas.com/wp-content/themes/campaignify/js/jquery.fittext.js?ver=2.1'></script>
<script type='text/javascript'>
	/* <![CDATA[ */
	var campaignifySettings = {
		"l10n": [],
		"ajaxurl": "http:\/\/saveachristmas.com\/wp-admin\/admin-ajax.php",
		"page": {"is_campaign": false, "is_single_comments": false, "is_blog": false},
		"campaignWidgets": {
			"widget_campaignify_campaign_feature": false,
			"widget_campaignify_hero_contribute": false,
			"widget_campaignify_campaign_pledge_levels": false,
			"widget_campaignify_campaign_content": false
		},
		"security": {"gallery": "6c47b59ce6"}
	};
	/* ]]> */
</script>
<script type='text/javascript'
		src='http://saveachristmas.com/wp-content/themes/campaignify/js/campaignify.js?ver=20130603'></script>
<?php get_footer(); ?>

