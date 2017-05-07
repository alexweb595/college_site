<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package college
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 push-lg-3">
                    <div class="row">
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="footer_menu_left">
                                <h4>OUR WEBSITE</h4>
                                <?php wp_nav_menu(array('theme_location' => 'menu-2', 'menu_id' => 'footer_left')); ?>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="footer_menu_right">
                                <h4>MORE</h4>
                                <?php wp_nav_menu(array('theme_location' => 'menu-3', 'menu_id' => 'footer_right')); ?>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="contacts">
                                <h4>CONTACTS</h4>
                                <div class="contacts_btn">
                                    <a href="#example">Contact Us</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 pull-lg-9">
                    <?php dynamic_sidebar('logo_bottom_img')?>
                    <div class="copyright">
                        <div class="create">
                            <a href="http://skysoft.co.il" class="copy" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/images/favico.png" alt="SkySoft">SkySoft Development</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>
<aside id="example" class="modal">
    <div>
        <div class="top_modal_window">
            <a href="#close" title="Закрыть" class="close"></a>
            <?php echo do_shortcode('[contact-form-7 id="294" title="modal window"]'); ?>
        </div><!-- .top_modal_window -->
        <div id="answer"></div><!-- #answer -->
    </div>
</aside>
<aside id="example2" class="modal">
    <div>
        <div class="top_modal_window">
            <a href="#close" title="Закрыть" class="close"></a>
            <div id="answer_loud_block">
                <!-- ... Content load ... -->
            </div><!-- #answer_loud_block -->
        </div><!-- .top_modal_window -->
    </div>
</aside>
</body>
</html>
