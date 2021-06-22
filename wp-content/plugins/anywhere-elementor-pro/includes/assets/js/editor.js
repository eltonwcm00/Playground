jQuery(document).ready(function (){
    elementor.hooks.addAction( 'panel/open_editor/widget', function( panel, model, view ) {
        var widget_type = model.attributes.widgetType;

        if(widget_type == 'ae-acf-repeater') {
            jQuery(document).on('change', "select[data-setting='layout_mode']", function () {
                //jQuery('settings[data-setting="ae_post_type"]').select2().trigger('change');
                elementor.reloadPreview();
            });
        }

        if(widget_type == 'ae-acf'){
            jQuery('.elementor-control-_skin label').html('Field Type');
        }

        if(widget_type == 'ae-pods'){
            jQuery('.elementor-control-_skin label').html('Field Type');
        }

        if(widget_type == 'ae-post-blocks-adv'){
            jQuery('.elementor-control-_skin label').html('Layout');

        }

        if(widget_type == 'ae-post-blocks'){
            jQuery(document).on('change', "select[data-setting='layout_mode']",  function () {
                //jQuery('settings[data-setting="ae_post_type"]').select2().trigger('change');
                //elementor.reloadPreview();
            });

            selected_post_ids = model.attributes.settings.attributes.ae_post_ids;

            // get selected data
            jQuery.ajax({
                url: aepro.ajaxurl,
                dataType: 'json',
                method: 'post',
                data: {
                    selected_posts : selected_post_ids,
                    action: 'ae_post_data',
                    fetch_mode: 'selected_posts'
                },
                success: function(res){
                    options = '';
                    if(res.data.length) {
                        jQuery.each(res.data, function (key, value) {
                            options += '<option selected value="' + value['id'] + '">' + value['text'] + '</option>';
                        });
                    }



                    jQuery("select[data-setting='ae_post_ids']").html(options).select2({
                        ajax: {
                            url: aepro.ajaxurl,
                            dataType: 'json',
                            data: function (params) {
                                return {
                                    q: params.term,
                                    action: 'ae_post_data',
                                    fetch_mode: 'posts'
                                }
                            },
                            processResults: function (res) {
                                return {
                                    results: res.data
                                }
                            }
                        }    ,
                        minimumInputLength: 2
                    });
                }
            });
        }
    } );

    /*elementor.hooks.addAction( 'panel/open_editor/widget/ae-post-blocks-adv', function( panel, model, view ) {

            let post_type = jQuery("select[data-setting='source']").val();
            jQuery("select[data-setting='source']").on('change', function () {
                post_type = jQuery("select[data-setting='source']").val();
            });

            // get selected data Include Term IDs
            let selected_include_term_ids = model.attributes.settings.attributes.include_term_ids;

            jQuery.ajax({
                url: aepro.ajaxurl,
                dataType: 'json',
                method: 'post',
                data: {
                    selected_terms: selected_include_term_ids,
                    action: 'ae_term_data',
                    fetch_mode: 'selected_terms',
                },
                success: function (res) {
                    options = '';
                    if (res.data.length) {
                        jQuery.each(res.data, function (key, value) {
                            options += '<option selected value="' + value['id'] + '">' + value['text'] + '</option>';
                        });
                    }

                    jQuery("select[data-setting='include_term_ids']").html(options).select2({
                        ajax: {
                            url: aepro.ajaxurl,
                            dataType: 'json',
                            data: function (params) {
                                return {
                                    q: params.term,
                                    action: 'ae_term_data',
                                    fetch_mode: 'terms',
                                    post_type: post_type,
                                }
                            },
                            processResults: function (res) {
                                return {
                                    results: res.data
                                }
                            },
                        },
                        minimumInputLength: 2
                    });

                }
            });

            // get selected data Exclude Term IDs
            let selected_exclude_term_ids = model.attributes.settings.attributes.exclude_term_ids;

            jQuery.ajax({
                url: aepro.ajaxurl,
                dataType: 'json',
                method: 'post',
                data: {
                    selected_terms: selected_exclude_term_ids,
                    action: 'ae_term_data',
                    fetch_mode: 'selected_terms',
                },
                success: function (res) {
                    options = '';
                    if (res.data.length) {
                        jQuery.each(res.data, function (key, value) {
                            options += '<option selected value="' + value['id'] + '">' + value['text'] + '</option>';
                        });
                    }

                    jQuery("select[data-setting='exclude_term_ids']").html(options).select2({
                        ajax: {
                            url: aepro.ajaxurl,
                            dataType: 'json',
                            data: function (params) {
                                return {
                                    q: params.term,
                                    action: 'ae_term_data',
                                    fetch_mode: 'terms',
                                    post_type: post_type,
                                }
                            },
                            processResults: function (res) {
                                return {
                                    results: res.data
                                }
                            },
                        },
                        minimumInputLength: 2
                    });

                }
            });

            // get selected data Exclude Post IDs
            selected_exclude_post_ids = model.attributes.settings.attributes.exclude_post_ids;

            // get selected data
            jQuery.ajax({
                url: aepro.ajaxurl,
                dataType: 'json',
                method: 'post',
                data: {
                    selected_posts: selected_exclude_post_ids,
                    action: 'ae_post_data',
                    fetch_mode: 'selected_posts'
                },
                success: function (res) {
                    options = '';
                    if (res.data.length) {
                        jQuery.each(res.data, function (key, value) {
                            options += '<option selected value="' + value['id'] + '">' + value['text'] + '</option>';
                        });
                    }


                    jQuery("select[data-setting='exclude_post_ids']").html(options).select2({
                        ajax: {
                            url: aepro.ajaxurl,
                            dataType: 'json',
                            data: function (params) {
                                return {
                                    q: params.term,
                                    action: 'ae_post_data',
                                    fetch_mode: 'posts'
                                }
                            },
                            processResults: function (res) {
                                return {
                                    results: res.data
                                }
                            }
                        },
                        minimumInputLength: 2
                    });
                }
            });

        // get selected data Selected Post IDs when select Manual Selection as source
        selected_post_ids = model.attributes.settings.attributes.select_post_ids;

        // get selected data
        jQuery.ajax({
            url: aepro.ajaxurl,
            dataType: 'json',
            method: 'post',
            data: {
                selected_posts: selected_post_ids,
                action: 'ae_post_data',
                fetch_mode: 'selected_posts'
            },
            success: function (res) {
                options = '';
                if (res.data.length) {
                    jQuery.each(res.data, function (key, value) {
                        options += '<option selected value="' + value['id'] + '">' + value['text'] + '</option>';
                    });
                }


                jQuery("select[data-setting='select_post_ids']").html(options).select2({
                    ajax: {
                        url: aepro.ajaxurl,
                        dataType: 'json',
                        data: function (params) {
                            return {
                                q: params.term,
                                action: 'ae_post_data',
                                fetch_mode: 'posts'
                            }
                        },
                        processResults: function (res) {
                            return {
                                results: res.data
                            }
                        }
                    },
                    minimumInputLength: 2
                });
            }
        });
    });*/
});

