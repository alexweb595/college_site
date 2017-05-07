<?php
/**
 * Created by IntelliJ IDEA.
 * User: Ayvar
 * Date: 21.03.2017
 * Time: 23:20
 */
?>

<div id="faq" class="faq_page_block">
    <div class="page_text_block">
        <div class="container">
            <div class="row">
                <?php
                if (have_rows('repeater_block')):
                    $i = 0;
                    while (have_rows('repeater_block')) : the_row();
                        $i++;
                        $title_question = get_sub_field('title_question');
                        $content_question = get_sub_field('content_question');
                        $content_answer = get_sub_field('content_answer');
                        echo '<div class="col-lg-6">';
                        echo '<div class="text_block">';
                        echo '<h1>'.$title_question.'</h1>';
                        echo '<p>'.$content_question.'</p>';
                        echo '<div id="answer_'.$i.'" class="hidden_answer_block">'.$content_answer.'</div>';
                        echo '<div class="answer_btn"><a class="answer_link" data-answer="#answer_'.$i.'" href="#example2">+ Answer</a></div>';
                        echo '</div>';
                        echo '</div>';
                    endwhile;

                endif;
                ?>
            </div>
        </div>
        <div class="find_btn">
            <div class="container">
                <div class="section_title">CAN FIND YOUR ANSWER</div>
            </div>
            <div class="form_ms">
                <div class="container">
                    <div class="col-lg-6">
                        <?php echo do_shortcode('[contact-form-7 id="312" title="Form ansver & question"]');?><!-- FORM -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

