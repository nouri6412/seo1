<?php if (1 == 1) : ?>
    <!--profile page custom JS-->
    <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/assets/css/tagcomplete.css">
    <script src="<?php echo get_template_directory_uri(); ?>/assets/js/tagcomplete.js"></script>
    <script>
        let offcanvas = document.querySelector('.offcanvas')


        offcanvas.addEventListener('click', (e) => {
            e.preventDefault()
            document.querySelector('.convas-body').classList.toggle('h')
        })

        let btn_close = document.querySelector('#wt-main')


        btn_close.addEventListener('click', (e) => {
            e.preventDefault()
            document.querySelector('.convas-body').classList.remove('h')
        })
        $(function() {
            <?php
            $args = array(
                'post_type' => 'skill'
            );
            $the_query = new WP_Query($args);
            ?>
            var data = [
                <?php
                while ($the_query->have_posts()) :
                    $the_query->the_post();
                ?> '<?php echo get_the_title(); ?>',
                <?php
                endwhile;
                wp_reset_query();
                ?>
            ];

            $(".tags_input").tagComplete({

                keylimit: 1,
                hide: false,
                autocomplete: {
                    data: data
                }
            });

            $(".tag_input").on('keypress', function(e) {
                if (e.which == 13) {
                    custom_theme_mbm_base_ajax({
                        'action': 'mbm_job_tag_insert',
                        'title': $(this).val()
                    }, function(result) {

                    });
                }
            });

        });
    </script>
<?php endif; ?>