// myApp ============================= //
(function ($) {
    /* GLOBAL
     ==================================*/
    (function () {
        window.myApp = {
            top_carousel: $('#top_carousel'),
            for_students_hidden: $('.hidden_block'),
            link_hidden_block: $('.more_show'),
            tabs_link: $('.tabs_link'),
            more_show_hidden_block: $('.more_show_hidden_block'),
            toggleNav: $('.mobile-nav-button'),
            mobil_nav: $('#mobil_nav'),
            link_fancy_box: $('.gallery_link'),
            faq_page: $('#faq')
        }
    })();
    var home_url = window.location.origin + '/';
    var window_width = $(window).outerWidth(true);
    var window_height = $(window).outerHeight(true);

    /*init DOCUMENT READY
     =================================*/
    $(document).ready(function () {
        initBottomSlider();
        toggleNav();
        initFancybox();
    });

    /* init WINDOV RISIZE
     ================================*/
    $(window).resize(function () {
        window_width = $(window).outerWidth(true);
        window_height = $(window).outerHeight(true);
    });

    /* ToggleNav
     =======================================================*/
    function toggleNav() {
        myApp.toggleNav.click(function () {
            $(this).toggleClass('open');
            $(this).find('.mobile-nav-button__line:nth-of-type(1)').toggleClass('mobile-nav-button__line--1');
            $(this).find('.mobile-nav-button__line:nth-of-type(2)').toggleClass('mobile-nav-button__line--2');
            $(this).find('.mobile-nav-button__line:nth-of-type(3)').toggleClass('mobile-nav-button__line--3');
            myApp.mobil_nav.toggleClass('open').parent().toggleClass('visible');
        });
    }

    /* top slider module
     =================================*/
    if (myApp.top_carousel !== null) {
        myApp.top_carousel.slick({
            dots: false,
            infinite: true,
            autoplay: true,
            autoplaySpeed: 3000,
            pauseOnFocus: false,
            pauseOnHover: false,
            nextArrow: '<img class="slick_arrow slick_arrow_right" src="' + home_url + 'wp-content/themes/college-themes/images/icon/arrow_right.png">',
            prevArrow: '<img class="slick_arrow slick_arrow_left" src="' + home_url + 'wp-content/themes/college-themes/images/icon/arrow_left.png">',
            fade: true,
            cssEase: 'linear'
        });
    }

    /* Bottom Slider
     ===================================*/
    function initBottomSlider() {
        $('#slider_news').slick({
            infinite: true,
            slidesToShow: 3,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 3000,
            nextArrow: '<img class="slick_arrow slick_arrow_right" src="' + home_url + 'wp-content/themes/college-themes/images/icon/arrow_right.png">',
            prevArrow: '<img class="slick_arrow slick_arrow_left" src="' + home_url + 'wp-content/themes/college-themes/images/icon/arrow_left.png">',
            responsive: [
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
            ]
        });
    }

    /* Show hidden block
     ====================================*/
    myApp.link_hidden_block.on('click', function (e) {
        e.preventDefault();
        myApp.for_students_hidden.slideToggle();
        if ($(this).html() == 'More') {
            $(this).html('Close').addClass('open').removeClass('close');
        } else if ($(this).html() == 'Close') {
            $(this).html('More').addClass('close').removeClass('open');
        }
    });

    myApp.more_show_hidden_block.on('click', function (e) {
        e.preventDefault();
        $(this).prev().children('.hidden_tab_text_block').fadeToggle();
        if ($(this).html() == 'More') {
            $(this).html('Close').addClass('open').removeClass('close');
        } else if ($(this).html() == 'Close') {
            $(this).html('More').addClass('close').removeClass('open');
        }
    });

    /* Tabs link
     ====================================*/
    myApp.tabs_link.find('a').on('click', function (e) {
        e.preventDefault();
        $(this).parent().addClass('active').siblings('.tabs_link').removeClass('active');
        var current_div = $(this).parent().attr('data-tabs');
        $(current_div).addClass('visible').siblings('.single_tabs_content').removeClass('visible');
    });

    /* Custom scroll bar
     =====================================*/
    if (document.getElementById('my_tabs') !== null) {
        var tabs_content = $('.single_tabs_content');
        tabs_content.mCustomScrollbar({
            theme: "dark",
            axis: "y"
        });
    }

    /* Search widgets
     ========================================================
     */
    if (document.getElementById('search_motor') !== null) {
        searchWidgetsHome(); // Init function Search
    }

    function searchWidgetsHome() {
        // Vars ========== //
        var sub_mith = $('#sort_start');

        var name_college = $('#name_college');
        var cat_college = $('#cat_school');
        var region_college = $('#region_school');
        var address_college = $('#address_school');
        var open_college = $('#open_school');
        var director_college = $('#director_school');
        var reset = $('#reset_search');

        // Select elements === //
        name_college.select2({placeholder: "Name College"});
        cat_college.select2({minimumResultsForSearch: Infinity, placeholder: "Category College"});
        region_college.select2({minimumResultsForSearch: Infinity, placeholder: "Region College"});
        address_college.select2({minimumResultsForSearch: Infinity, placeholder: "Address College"});
        open_college.select2({minimumResultsForSearch: Infinity, placeholder: "Open"});
        director_college.select2({minimumResultsForSearch: Infinity, placeholder: "Director College"});

        // Vars data === //
        var post_id = name_college.val();
        var current_cat = cat_college.val();
        var region = region_college.val();
        var address = address_college.val();
        var open = open_college.val();
        var director = director_college.val();

        // Data prototype ==== //
        var proto_data = function (select_data) {
            // Vars data === //
            post_id = name_college.val();
            current_cat = cat_college.val();
            region = region_college.val();
            address = address_college.val();
            open = open_college.val();
            director = director_college.val();
            // data object === //
            select_data = {
                'action': '',
                'p': post_id,
                'cat': current_cat,
                'region': region,
                'address': address,
                'open': open,
                'director': director
            };
            return select_data;
        };

        // Animated & sort function === //
        function addAnimateElement() {
            // append animation element i === //
            $('.wrp_select').append('<i class="fa fa-cog fa-spin fa-3x fa-fw"></i>');
            $('.wrp_search').append('<i class="fa fa-cog fa-spin fa-3x fa-fw"></i>');
        }

        function removeAnimationElement() {
            // remove animation element i === //
            $('.wrp_select').find('i').detach();
            if ($('.wrp_search').has('i')) {
                $('.wrp_search').find('i').detach();
            }
        }

        function sortObject($obj, $element) {
            $element.empty();
            if (Object.keys($obj).length > 1) {
                $element.html('<option></option>');
            }
            for (var key in $obj) {
                $element.append('<option value="' + $obj[key] + '">' + $obj[key] + '</option>');
            }
        }

        function sortResultsAssElement($results_element, $element_dom) {
            if ($results_element !== $element_dom.val()) {
                $element_dom.empty();
                if (Object.keys($results_element).length > 1) {
                    $element_dom.html('<option></option>');
                    for (var key in $results_element) {
                        $element_dom.append('<option value="' + key + '">' + $results_element[key] + '</option>');
                    }
                } else {
                    for (var key in $results_element) {
                        $element_dom.append('<option value="' + key + '">' + $results_element[key] + '</option>');
                    }
                }
            } else if ($results_element == $element_dom.val()) {
                $element_dom.find('option[value="' + $results_element + '"]').siblings('option').detach();
            }
        }

        // Change select function === //
        reset.on('click', function (e) {
            e.preventDefault();
            var data = {
                'action': 'reset_search',
                'parent_cat': '5'
            };
            resetSearch();
            function resetSearch() {
                addAnimateElement();
                $.ajax({
                    url: ajax_url,
                    data: data,
                    type: 'POST',
                    success: function (data) {
                        var result = $.parseJSON(data);
                        if (result) {
                            removeAnimationElement();
                            sortResultsAssElement(result['post_title_id'], name_college);
                            sortResultsAssElement(result['cat_name_id'], cat_college);
                            sortObject(result['region'], region_college);
                            sortObject(result['address'], address_college);
                            sortObject(result['open'], open_college);
                            sortObject(result['director'], director_college);
                        }
                    }
                });
            }
        });

        name_college.on('change', function () {
            // DATA === //
            var data = new proto_data;
            data.action = 'title_college';
            // IF SELECTED FIELD NAME ==== //
            selectedName();
            function selectedName() {
                addAnimateElement();
                // Ajax =================================
                $.ajax({
                    url: ajax_url,
                    data: data,
                    type: 'POST',
                    success: function (data) {
                        var result = $.parseJSON(data);
                        if (result) {
                            removeAnimationElement();
                            // Cat parent object === //
                            var cat = result['current_cat'];
                            if (cat) {
                                cat_college.empty();
                                for (var key in cat) {
                                    cat_college.append('<option value="' + key + '">' + cat[key] + '</option>');
                                }
                            }
                            // Inner Html element in select === //
                            region_college.html('<option value="' + result['region'] + '">' + result['region'] + '</option>');
                            address_college.html('<option value="' + result['address'] + '">' + result['address'] + '</option>');
                            open_college.html('<option value="' + result['open'] + '">' + result['open'] + '</option>');
                            director_college.html('<option value="' + result['director'] + '">' + result['director'] + '</option>');
                        }
                    }
                });
            }
        });

        cat_college.on('change', function () {
            // DATA === //
            var data = new proto_data;
            data.action = 'selected_category_field';
            selectedCategoryField();
            //IF CATEGORY FIELD IS SELECTED ==== //
            function selectedCategoryField() {
                addAnimateElement();
                // Ajax =================================
                $.ajax({
                    url: ajax_url,
                    data: data,
                    type: 'POST',
                    success: function (data) {
                        var results = $.parseJSON(data);
                        if (results) {
                            removeAnimationElement();

                            sortObject(results['address'], address_college);
                            sortObject(results['region'], region_college);
                            sortObject(results['open'], open_college);
                            sortObject(results['director'], director_college);
                            sortResultsAssElement(results['post_title_id'], name_college);
                        }
                    }
                });
            }
        });

        region_college.on('change', function () {
            // DATA === //
            var data = new proto_data;
            data.action = 'region_field_selected';
            selectedRegionField();
            function selectedRegionField() {
                addAnimateElement();
                // Ajax =================================
                $.ajax({
                    url: ajax_url,
                    data: data,
                    type: 'POST',
                    success: function (data) {
                        var results = $.parseJSON(data);
                        console.log(results);
                        if (results) {
                            removeAnimationElement();
                            sortResultsAssElement(results['post_title_id'], name_college);
                            sortResultsAssElement(results['current_cat'], cat_college);
                            sortObject(results['address'], address_college);
                            sortObject(results['open'], open_college);
                            sortObject(results['director'], director_college);
                        }
                    }
                });
            }
        });

        address_college.on('change', function () {
            // DATA === //
            var data = new proto_data;
            data.action = 'address_field_selected';
            selectedAddressField();
            function selectedAddressField() {
                addAnimateElement();
                $.ajax({
                    url: ajax_url,
                    data: data,
                    type: 'POST',
                    success: function (data) {
                        var results = $.parseJSON(data);
                        if (results) {
                            removeAnimationElement();
                            sortResultsAssElement(results['post_title_id'], name_college);
                            sortResultsAssElement(results['current_cat'], cat_college);
                            sortObject(results['open'], open_college);
                            sortObject(results['director'], director_college);
                            address_college.find('option[value="' + address + '"]').siblings('option').detach();
                            sortObject(results['region'], region_college);
                        }
                    }
                });
            }
        });

        open_college.on('change', function () {
            // DATA === //
            var data = new proto_data;
            data.action = 'data_open_college';
            selectedOpen();
            function selectedOpen() {
                addAnimateElement();
                $.ajax({
                    url: ajax_url,
                    data: data,
                    type: 'POST',
                    success: function (data) {
                        var results = $.parseJSON(data);
                        console.log(results);
                        if (results) {
                            removeAnimationElement();
                            sortObject(results['director'], director_college);
                            open_college.find('option[value="' + results['open'] + '"]').siblings('option').detach();
                            sortResultsAssElement(results['post_title_id'], name_college);
                            sortResultsAssElement(results['current_cat'], cat_college);
                            sortObject(results['region'], region_college);
                            sortObject(results['address'], address_college);
                        }
                    }
                });
            }

        });

        director_college.on('change', function () {
            // DATA === //
            var data = new proto_data;
            data.action = 'selected_director_field';
            selectedDirector();
            function selectedDirector() {
                addAnimateElement();
                console.log(data);
                // Ajax =================================
                $.ajax({
                    url: ajax_url,
                    data: data,
                    type: 'POST',
                    success: function (data) {
                        var results = $.parseJSON(data);
                        removeAnimationElement();
                        if (results) {
                            console.log(results);
                            sortResultsAssElement(results['post_title_id'], name_college);
                            sortResultsAssElement(results['current_cat'], cat_college);
                            director_college.find('option[value="' + results['director'] + '"]').siblings('option').detach();
                            sortObject(results['region'], region_college);
                            sortObject(results['address'], address_college);
                            sortObject(results['open'], open_college);
                        }
                    }
                });

            }
        });
    }

    /* Aside
     ======================================================*/
    if (document.getElementById('secondary')) {
        var column_sidebar = $('.column_scroll');
        column_sidebar.mCustomScrollbar({
            theme: "dark",
            axis: "y"
        });
    }

    if (document.getElementById('search_results')) {
        $(document).ready(function () {
            checkCheckbox();
        });
    }

    function checkCheckbox() {
        var current_div = $('#search_results');
        var result_cat = current_div.attr('data-results_cat');
        var result_post = current_div.attr('data-results_post');
        var result_region = current_div.attr('data-results_region');
        var result_address = current_div.attr('data-results_address');
        var result_open = current_div.attr('data-results_open');
        var result_director = current_div.attr('data-results_director');
        $('.option_cat[value="' + result_cat + '"]').attr('checked', true);
        $('.option_college[value="' + result_post + '"]').attr('checked', true);
        $('.option_region[value="' + result_region + '"]').attr('checked', true);
        $('.option_address[value="' + result_address + '"]').attr('checked', true);
        $('.option_open[value="' + result_open + '"]').attr('checked', true);
        $('.option_director[value="' + result_director + '"]').attr('checked', true);
    }

    $('#reset').on('click', function () {
        $('#secondary').find('input[type=checkbox]').prop('checked', false);
    });

    $('#results').on('click', function () {
        var current_div = $('#search_results');
        current_div.append('<div class="mask_ajax"><i class="fa fa-cog fa-spin fa-3x fa-fw"></i></div><!-- .mask_ajax -->');
        // Vars === //
        var check_cat = [];
        var check_post = [];
        var check_region = [];
        var check_address = [];
        var check_open = [];
        var check_director = [];
        // Value === //
        $('input[id^=option_cat]:checked').each(function () {
            check_cat.push($(this).val());
        });
        $('input[id^=option_college]:checked').each(function () {
            check_post.push($(this).val());
        });
        $('input[id^=option_region]:checked').each(function () {
            check_region.push($(this).val());
        });
        $('input[id^=option_address]:checked').each(function () {
            check_address.push($(this).val());
        });
        $('input[id^=option_open]:checked').each(function () {
            check_open.push($(this).val());
        });
        $('input[id^=option_director]:checked').each(function () {
            check_director.push($(this).val());
        });
        // DATA === //
        var data = {
            'action': 'archive_sort_widget',
            'check_cat': check_cat,
            'check_post': check_post,
            'check_region': check_region,
            'check_address': check_address,
            'check_open': check_open,
            'check_director': check_director
        };
        // Ajax === //
        $.ajax({
            url: ajax_url,
            data: data,
            type: 'POST',
            success: function (data) {
                current_div.find('.mask_ajax').detach();
                if (data) {
                    current_div.html(data);
                    console.log(data);
                }
            }
        });
    });
    /* init Fancy box
     =====================================================*/
    function initFancybox() {
        myApp.link_fancy_box.fancybox({
            "padding": 15,
            "imageScale": true,
            "zoomOpacity": false,
            "zoomSpeedIn": 700,
            "zoomSpeedOut": 700,
            "zoomSpeedChange": 700,
            "frameWidth": 700,
            "frameHeight": 600,
            "overlayShow": true,
            "overlayOpacity": 0.8,
            "hideOnContentClick": false,
            "centerOnScroll": false
        });
    }

    /* Page answer & question
     =======================================================*/
    if (myApp.faq_page !== null) {
        loudAnswer();
    }

    function loudAnswer() {
        $('.answer_link').on('click', function(){
            var data_current_content = $(this).attr('data-answer');
            var content = $(data_current_content).clone();
            $('#answer_loud_block').html(content);
        });
    }

})(jQuery);
