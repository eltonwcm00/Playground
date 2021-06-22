<?php

namespace Aepro\Modules\AcfGallery\Skins;

use Elementor\Controls_Manager;
use Elementor\Skin_Base as Elementor_Skin_Base;
use Elementor\Widget_Base;
use Elementor\Plugin;
use Elementor\Icons_Manager;
use Aepro\Helper;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

abstract class Skin_Base extends Elementor_Skin_Base
{

    protected function _register_controls_actions()
    {
        add_action('elementor/element/ae-acf-gallery/section_layout/before_section_end', [$this, 'register_controls']);

        add_action('elementor/element/ae-acf-gallery/section_style/before_section_end', [$this, 'register_style_controls']);

        add_action('elementor/element/ae-acf-gallery/section_overlay/before_section_end', [$this, 'register_overlay_controls']);

        add_action('elementor/element/ae-acf-gallery/section_overlay_style/before_section_end', [$this, 'register_overlay_style_controls']);

    }

    public function register_controls(Widget_Base $widget){
        $this->parent = $widget;

    }

    function carousel_styles(){

        $this->add_control(
            'heading_style_arrow',
            [
                'label' => __('Arrow', 'ae-pro'),
                'type' => Controls_Manager::HEADING,
                'condition' =>
                    [
                        $this->get_control_id('navigation_button') => 'yes',
                    ]
            ]
        );
        $this->add_control(
            'arrow_color',
            [
                'label' => __('Arrow Color', 'ae-pro'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ae-swiper-button-prev' => 'background-color:{{VAlUE}};',
                    '{{WRAPPER}} .ae-swiper-button-next' => 'background-color:{{VAlUE}};',
                    '{{WRAPPER}} .ae-swiper-button-prev.swiper-button-disabled' => 'background-color:{{VAlUE}}; opacity: .5;',
                    '{{WRAPPER}} .ae-swiper-button-next.swiper-button-disabled' => 'background-color:{{VAlUE}}; opacity: .5;'
                ],
                'condition' =>
                    [
                        $this->get_control_id('navigation_button') => 'yes',
                        $this->get_control_id('custom_navigation_icon!') => 'yes'
                    ]
            ]
        );

        $this->add_control(
            'arrow_size',
            [
                'label' => __('Arrow Size', 'ae-pro'),
                'type' => Controls_Manager::SLIDER,
                'range' =>
                    [
                        'px' => [
                            'min' => 1,
                            'max' => 100,
                            'step' => 1
                        ],
                    ],

                'selectors' => [
                    '{{WRAPPER}} .ae-swiper-button-prev' => '-webkit-mask-size:{{SIZE}}px auto; mask-size:{{SIZE}}px auto; width:{{SIZE}}px; height:calc({{SIZE}}px*2)',
                    '{{WRAPPER}} .ae-swiper-button-next' => '-webkit-mask-size:{{SIZE}}px auto; mask-size:{{SIZE}}px auto; width:{{SIZE}}px; height:calc({{SIZE}}px*2)',
                ],
                'condition' =>
                    [
                        $this->get_control_id('navigation_button') => 'yes',
                        $this->get_control_id('custom_navigation_icon!') => 'yes'
                    ]
            ]
        );
        $this->start_controls_tabs( 'tabs_arrow_styles' );

        $this->start_controls_tab(
            'tab_arrow_normal',
            [
                'label' => __( 'Normal', 'ae-pro' ),
            ]
        );

        $this->add_control(
            'arrow_color_custom_icon',
            [
                'label' => __('Color', 'ae-pro'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ae-swiper-button-prev i' => 'color:{{VAlUE}};',
                    '{{WRAPPER}} .ae-swiper-button-next i' => 'color:{{VAlUE}};'
                ],
                'default' => '#444',
                'condition' =>
                    [
                        $this->get_control_id('navigation_button') => 'yes',
                        $this->get_control_id('custom_navigation_icon') => 'yes'
                    ]
            ]
        );

        $this->add_control(
            'arrow_bg_color_custom_icon',
            [
                'label' => __(' Background Color', 'ae-pro'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ae-swiper-button-prev' => 'background-color:{{VAlUE}};',
                    '{{WRAPPER}} .ae-swiper-button-next' => 'background-color:{{VAlUE}};'
                ],
                'condition' =>
                    [
                        $this->get_control_id('navigation_button') => 'yes',
                        $this->get_control_id('custom_navigation_icon') => 'yes'
                    ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'arrow_border',
                'label' => __( 'Border', 'ae-pro' ),
                'selector' => '{{WRAPPER}} .ae-swiper-container .ae-swiper-button-prev, {{WRAPPER}} .ae-swiper-container .ae-swiper-button-next, {{WRAPPER}} .ae-swiper-button-prev, {{WRAPPER}} .ae-swiper-button-next',
                'condition' =>
                    [
                        $this->get_control_id('navigation_button') => 'yes',
                        $this->get_control_id('custom_navigation_icon') => 'yes'
                    ]
            ]
        );

        $this->add_control(
            'arrow_border_radius',
            [
                'label' => __( 'Border Radius', 'ae-pro' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .ae-swiper-container .ae-swiper-button-prev, {{WRAPPER}} .ae-swiper-button-prev' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow:hidden;',
                    '{{WRAPPER}} .ae-swiper-container .ae-swiper-button-next, {{WRAPPER}} .ae-swiper-button-next' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow:hidden;',
                ],
                'condition' =>
                    [
                        $this->get_control_id('navigation_button') => 'yes',
                        $this->get_control_id('custom_navigation_icon') => 'yes'
                    ]
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_arrow_hover',
            [
                'label' => __( 'Hover', 'ae-pro' ),
            ]
        );
        $this->add_control(
            'arrow_color_hover',
            [
                'label' => __('Color', 'ae-pro'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ae-swiper-button-prev:hover i' => 'color:{{VAlUE}};',
                    '{{WRAPPER}} .ae-swiper-button-next:hover i' => 'color:{{VAlUE}};'
                ],
                'condition' =>
                    [
                        $this->get_control_id('navigation_button') => 'yes',
                        $this->get_control_id('custom_navigation_icon') => 'yes'
                    ]
            ]
        );

        $this->add_control(
            'arrow_bg_color_hover',
            [
                'label' => __(' Background Color', 'ae-pro'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ae-swiper-button-prev:hover' => 'background-color:{{VAlUE}};',
                    '{{WRAPPER}} .ae-swiper-button-next:hover' => 'background-color:{{VAlUE}};'
                ],
                'condition' =>
                    [
                        $this->get_control_id('navigation_button') => 'yes',
                        $this->get_control_id('custom_navigation_icon') => 'yes'
                    ]
            ]
        );

        $this->add_control(
            'arrow_border_color_hover',
            [
                'label' => __(' Border Color', 'ae-pro'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ae-swiper-button-prev:hover' => 'border-color:{{VAlUE}};',
                    '{{WRAPPER}} .ae-swiper-button-next:hover' => 'border-color:{{VAlUE}};'
                ],
                'condition' =>
                    [
                        $this->get_control_id('navigation_button') => 'yes',
                        $this->get_control_id('custom_navigation_icon') => 'yes'
                    ]
            ]
        );

        $this->add_control(
            'arrow_border_radius_hover',
            [
                'label' => __( 'Border Radius', 'ae-pro' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .ae-swiper-container .ae-swiper-button-prev:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow:hidden;',
                    '{{WRAPPER}} .ae-swiper-container .ae-swiper-button-next:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow:hidden;',
                ],
                'condition' =>
                    [
                        $this->get_control_id('navigation_button') => 'yes',
                        $this->get_control_id('custom_navigation_icon') => 'yes'
                    ]
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_control(
            'arrow_size_custom_icon',
            [
                'label' => __('Arrow Size', 'ae-pro'),
                'type' => Controls_Manager::SLIDER,
                'default' =>
                    [
                        'size' => 25
                    ],
                'range' =>
                    [
                        'min' => 20,
                        'max' => 100,
                        'step' => 1
                    ],
                'selectors' => [
                    '{{WRAPPER}} .ae-swiper-button-prev i' => 'font-size:{{SIZE}}px;',
                    '{{WRAPPER}} .ae-swiper-button-next i' => 'font-size:{{SIZE}}px;',
                    '{{WRAPPER}} .ae-swiper-button-prev svg' => 'width : {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .ae-swiper-button-next svg' => 'width : {{SIZE}}{{UNIT}};',
                ],
                'condition' =>
                    [
                        $this->get_control_id('navigation_button') => 'yes',
                        $this->get_control_id('custom_navigation_icon') => 'yes'
                    ]
            ]
        );


        $this->add_responsive_control(
            'arrow_horizontal_position',
            [
                'label' => __( 'Horizontal Position', 'ae-pro' ),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options' => [
                    'left' => [
                        'title' => __( 'Left', 'ae-pro' ),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'ae-pro' ),
                        'icon' => 'eicon-h-align-center',
                    ],
                    'right' => [
                        'title' => __( 'Right', 'ae-pro' ),
                        'icon' => 'eicon-h-align-right',
                    ],
                ],
                /*'selectors' => [
                    '{{WRAPPER}} .ae-swiper-button-wrapper' => '{{VALUE}}',
                ],
                'selectors_dictionary' => [
                    'left' => 'position: absolute; height: 100%; top: 0; width: 100px; left: 0;',
                    'center' => '',
                    'right' => 'bottom: auto; width: auto; right: 0;',
                ],*/
                'default' => 'center',
                'condition' => [
                    $this->get_control_id('navigation_button') => 'yes',
                    $this->get_control_id('arrows_layout') => 'inside'
                ]
            ]
        );

        $this->add_responsive_control(
            'arrow_vertical_position',
            [
                'label' => __( 'Vertical Position', 'ae-pro' ),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options' => [
                    'top' => [
                        'title' => __( 'Top', 'ae-pro' ),
                        'icon' => 'eicon-v-align-top',
                    ],
                    'middle' => [
                        'title' => __( 'Middle', 'ae-pro' ),
                        'icon' => 'eicon-v-align-middle',
                    ],
                    'bottom' => [
                        'title' => __( 'Bottom', 'ae-pro' ),
                        'icon' => 'eicon-v-align-bottom',
                    ],
                ],
                /*'selectors_dictionary' => [
                    'top' => 'top: 0; bottom: auto; width: 100px;',
                    'middle' => 'translate(-50%);',
                    'bottom' => 'top: auto; bottom: 0; transform: unset;',
                ],
                'selectors' => [
                    '{{WRAPPER}} .ae-swiper-button-wrapper' => '{{VALUE}}',
                    '{{WRAPPER}} .ae-swiper-button-next' => '{{VALUE}}',

                ],*/
                'default' => 'center',
                'condition' => [
                    $this->get_control_id('navigation_button') => 'yes',
                    $this->get_control_id('arrows_layout') => 'inside'
                ]
            ]
        );

        $this->add_responsive_control(
            'horizontal_arrow_offset',
            [
                'label' => __('Horizontal Offset', 'ae-pro'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ '%', 'px' ],
                'default' => [
                    'unit' => '%',
                ],
                'tablet_default' => [
                    'unit' => '%',
                ],
                'mobile_default' => [
                    'unit' => '%',
                ],
                'range' =>
                    [
                        'min' => 1,
                        'max' => 1000,
                        'step' => 1
                    ],
                'selectors' => [
                    '{{WRAPPER}} .ae-hpos-left .ae-swiper-button-wrapper' => 'left: {{SIZE}}{{UNIT}}',
                    '{{WRAPPER}} .ae-hpos-right .ae-swiper-button-wrapper' => 'right: {{SIZE}}{{UNIT}}',
                    '{{WRAPPER}} .ae-hpos-center .ae-swiper-button-prev' => 'left: {{SIZE}}{{UNIT}}',
                    '{{WRAPPER}} .ae-hpos-center .ae-swiper-button-next' => 'right: {{SIZE}}{{UNIT}}',

                ],
                'condition' => [
                    $this->get_control_id('navigation_button') => 'yes',
                    $this->get_control_id('arrows_layout') => 'inside'
                ]
            ]
        );
        $this->add_responsive_control(
            'vertical_arrow_offset',
            [
                'label' => __('Vertical Offset', 'ae-pro'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ '%', 'px' ],
                'default' => [
                    'unit' => '%',
                ],
                'tablet_default' => [
                    'unit' => '%',
                ],
                'mobile_default' => [
                    'unit' => '%',
                ],
                'range' =>
                    [
                        'min' => 1,
                        'max' => 1000,
                        'step' => 1
                    ],
                'selectors' => [
                    '{{WRAPPER}} .ae-vpos-top .ae-swiper-button-wrapper' => 'top: {{SIZE}}{{UNIT}}',
                    '{{WRAPPER}} .ae-vpos-bottom .ae-swiper-button-wrapper' => 'bottom: {{SIZE}}{{UNIT}}',
                    '{{WRAPPER}} .ae-vpos-middle .ae-swiper-button-prev' => 'top: {{SIZE}}{{UNIT}}',
                    '{{WRAPPER}} .ae-vpos-middle .ae-swiper-button-next' => 'top: {{SIZE}}{{UNIT}}',

                ],
                'condition' => [
                    $this->get_control_id('navigation_button') => 'yes',
                    $this->get_control_id('arrows_layout') => 'inside'
                ]
            ]
        );

        $this->add_responsive_control(
            'arrow_gap',
            [
                'label' => __('Arrow Gap', 'ae-pro'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ '%', 'px' ],
                'default' => [
                    'unit' => 'px',
                    'size' => '25'
                ],
                'tablet_default' => [
                    'unit' => '%',
                ],
                'mobile_default' => [
                    'unit' => '%',
                ],
                'range' =>
                    [
                        'min' => 1,
                        'max' => 1000,
                        'step' => 1
                    ],
                'selectors' => [
                    '{{WRAPPER}} .ae-acf-gallery-widget-wrapper .ae-swiper-container' => 'margin-left: {{SIZE}}{{UNIT}}; margin-right: {{SIZE}}{{UNIT}}',
                    '{{WRAPPER}} .ae-acf-gallery-widget-wrapper .ae-swiper-outer-wrapper' => 'position: relative',
                    '{{WRAPPER}} .ae-swiper-button-prev' => 'left: 0',
                    '{{WRAPPER}} .ae-swiper-button-next' => 'right: 0'

                ],
                'condition' => [
                    $this->get_control_id('navigation_button') => 'yes',
                    $this->get_control_id('arrows_layout') => 'outside'
                ]
            ]
        );

        $this->add_responsive_control(
            'arrow_padding',
            [
                'label' => __( 'Padding', 'ae-pro' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .ae-swiper-button-prev' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .ae-swiper-button-next' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->add_control(
            'heading_style_dots',
            [
                'label' => __('Dots', 'ae-pro'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' =>
                    [
                        $this->get_control_id('ptype') => 'bullets'
                    ]
            ]
        );

        $this->add_control(
            'dots_size',
            [
                'label' => __('Dots Size', 'ae-pro'),
                'type' => Controls_Manager::SLIDER,
                'default' =>
                    [
                        'size' => 5
                    ],
                'range' =>
                    [
                        'min' => 1,
                        'max' => 10,
                        'step' => 1
                    ],
                'selectors' => [
                    '{{WRAPPER}} .swiper-pagination-bullet' => 'width:{{SIZE}}px; height:{{SIZE}}px;',
                ],
                'condition' =>
                    [
                        $this->get_control_id('ptype') => 'bullets'
                    ]
            ]
        );

        $this->add_control(
            'dots_color',
            [
                'label' => __('Active Dot Color', 'ae-pro'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .swiper-pagination-bullet-active' => 'background-color:{{VAlUE}} !important;',
                ],
                'condition' =>
                    [
                        $this->get_control_id('ptype') => 'bullets'
                    ]
            ]
        );

        $this->add_control(
            'inactive_dots_color',
            [
                'label' => __('Inactive Dot Color', 'ae-pro'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .swiper-pagination-bullet' => 'background-color:{{VAlUE}};',
                ],
                'condition' =>
                    [
                        $this->get_control_id('ptype') => 'bullets'
                    ]
            ]
        );

        $this->add_responsive_control(
            'pagination_bullet_margin',
            [
                'label' => __( 'Margin', 'ae-pro' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .ae-swiper-pagination' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' =>
                    [
                        $this->get_control_id('ptype') => 'bullets'
                    ]
            ]
        );

        $this->add_control(
            'heading_style_scroll',
            [
                'label' => __('Scrollbar', 'ae-pro'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' =>
                    [
                        $this->get_control_id('scrollbar') => 'yes'
                    ]
            ]
        );
        $this->add_control(
            'scroll_size',
            [
                'label' => __('Scrollbar Size', 'ae-pro'),
                'type' => Controls_Manager::SLIDER,
                'default' =>
                    [
                        'size' => 5
                    ],
                'range' =>
                    [
                        'min' => 1,
                        'max' => 10,
                        'step' => 1
                    ],
                'selectors' => [
                    '{{WRAPPER}} .swiper-container-vertical .ae-swiper-scrollbar' => 'width:{{SIZE}}px;',
                    '{{WRAPPER}} .swiper-container-horizontal .ae-swiper-scrollbar' => 'height:{{SIZE}}px;',
                ],
                'condition' =>
                    [
                        $this->get_control_id('scrollbar') => 'yes'
                    ]
            ]
        );

        $this->add_control(
            'scrollbar_color',
            [
                'label' => __('Scrollbar Drag Color', 'ae-pro'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .swiper-scrollbar-drag' => 'background-color:{{VAlUE}};',
                ],
                'condition' =>
                    [
                        $this->get_control_id('scrollbar') => 'yes'
                    ]
            ]
        );

        $this->add_control(
            'scroll_color',
            [
                'label' => __('Scrollbar Color', 'ae-pro'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ae-swiper-scrollbar' => 'background-color:{{VAlUE}};',
                ],
                'condition' =>
                    [
                        $this->get_control_id('scrollbar') => 'yes'
                    ]
            ]
        );

        $this->add_control(
            'heading_style_progress',
            [
                'label' => __('Progress Bar', 'ae-pro'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' =>
                    [
                        $this->get_control_id('ptype') => 'progress'
                    ]
            ]
        );
        $this->add_control(
            'progressbar_color',
            [
                'label' => __('Prgress Bar Color', 'ae-pro'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .swiper-pagination-progressbar' => 'background-color:{{VAlUE}};',
                ],
                'condition' =>
                    [
                        $this->get_control_id('ptype') => 'progress'
                    ]
            ]
        );

        $this->add_control(
            'progress_color',
            [
                'label' => __('Prgress Color', 'ae-pro'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .swiper-pagination-progressbar-fill' => 'background-color:{{VAlUE}};',
                ],
                'condition' =>
                    [
                        $this->get_control_id('ptype') => 'progress'
                    ]
            ]
        );



        $this->add_control(
            'progressbar_size',
            [
                'label' => __('Prgress Bar Size', 'ae-pro'),
                'type' => Controls_Manager::SLIDER,
                'default' =>
                    [
                        'size' => 5
                    ],
                'range' =>
                    [
                        'min' => 1,
                        'max' => 10,
                        'step' => 1
                    ],
                'selectors' => [
                    '{{WRAPPER}} .swiper-container-horizontal .swiper-pagination-progressbar' => 'height:{{SIZE}}px;',
                    '{{WRAPPER}} .swiper-container-vertical .swiper-pagination-progressbar' => 'width:{{SIZE}}px;',
                ],
                'condition' =>
                    [
                        $this->get_control_id('ptype') => 'progress'
                    ]
            ]
        );

        $this->add_responsive_control(
            'pagination_progress_margin',
            [
                'label' => __( 'Margin', 'ae-pro' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .ae-swiper-pagination' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' =>
                    [
                        $this->get_control_id('ptype') => 'progress'
                    ]
            ]
        );
    }

    public function common_style_control(){

        $this->add_control(
            'heading_style_arrow',
            [
                'label' => __('Arrow', 'ae-pro'),
                'type' => Controls_Manager::HEADING,
                'condition' =>
                    [
                        $this->get_control_id('navigation_button') => 'yes'
                    ]
            ]
        );
        $this->add_control(
            'arrow_size',
            [
                'label' => __('Arrow Size', 'ae-pro'),
                'type' => Controls_Manager::SLIDER,
                'range' =>
                [
	                'px' => [
		                'min' => 1,
		                'max' => 100,
		                'step' => 1
	                ],
                ],

                'selectors' => [
                    '{{WRAPPER}} .ae-swiper-button-prev' => '-webkit-mask-size:{{SIZE}}px auto; mask-size:{{SIZE}}px auto; width:{{SIZE}}px; height:calc({{SIZE}}px*2)',
                    '{{WRAPPER}} .ae-swiper-button-next' => '-webkit-mask-size:{{SIZE}}px auto; mask-size:{{SIZE}}px auto; width:{{SIZE}}px; height:calc({{SIZE}}px*2)',
                ],
                'condition' =>
                    [
                        $this->get_control_id('navigation_button') => 'yes'
                    ]
            ]
        );

        $this->add_control(
            'arrow_color',
            [
                'label' => __('Arrow Color', 'ae-pro'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ae-swiper-button-prev' => 'background-color:{{VAlUE}};',
                    '{{WRAPPER}} .ae-swiper-button-next' => 'background-color:{{VAlUE}};',
                    '{{WRAPPER}} .ae-swiper-button-prev.swiper-button-disabled' => 'background-color:{{VAlUE}}; opacity: .5;',
				    '{{WRAPPER}} .ae-swiper-button-next.swiper-button-disabled' => 'background-color:{{VAlUE}}; opacity: .5;'
                ],
                'condition' =>
                    [
                        $this->get_control_id('navigation_button') => 'yes'
                    ]
            ]
        );


        $this->add_control(
            'heading_style_dots',
            [
                'label' => __('Dots', 'ae-pro'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' =>
                    [
                        $this->get_control_id('ptype') => 'bullets'
                    ]
            ]
        );

        $this->add_control(
            'dots_size',
            [
                'label' => __('Dots Size', 'ae-pro'),
                'type' => Controls_Manager::SLIDER,
                'default' =>
                    [
                        'size' => 5
                    ],
                'range' =>
                    [
                        'min' => 1,
                        'max' => 10,
                        'step' => 1
                    ],
                'selectors' => [
                    '{{WRAPPER}} .swiper-pagination-bullet' => 'width:{{SIZE}}px; height:{{SIZE}}px;',
                ],
                'condition' =>
                    [
                        $this->get_control_id('ptype') => 'bullets'
                    ]
            ]
        );

        $this->add_control(
            'dots_color',
            [
                'label' => __('Dots Color', 'ae-pro'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .swiper-pagination-bullet' => 'background-color:{{VAlUE}};',
                ],
                'condition' =>
                    [
                        $this->get_control_id('ptype') => 'bullets'
                    ]
            ]
        );




        $this->add_control(
            'heading_style_scroll',
            [
                'label' => __('Scrollbar', 'ae-pro'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' =>
                    [
                        $this->get_control_id('scrollbar') => 'yes'
                    ]
            ]
        );
        $this->add_control(
            'scroll_size',
            [
                'label' => __('Scrollbar Size', 'ae-pro'),
                'type' => Controls_Manager::SLIDER,
                'default' =>
                    [
                        'size' => 5
                    ],
                'range' =>
                    [
                        'min' => 1,
                        'max' => 10,
                        'step' => 1
                    ],
                'selectors' => [
                    '{{WRAPPER}} .ae-swiper-scrollbar' => 'height:{{SIZE}}px;',
                ],
                'condition' =>
                    [
                        $this->get_control_id('scrollbar') => 'yes'
                    ]
            ]
        );

        $this->add_control(
            'scrollbar_color',
            [
                'label' => __('Scrollbar Color', 'ae-pro'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .swiper-scrollbar-drag' => 'background-color:{{VAlUE}};',
                ],
                'condition' =>
                    [
                        $this->get_control_id('scrollbar') => 'yes'
                    ]
            ]
        );

        $this->add_control(
            'scroll_color',
            [
                'label' => __('Scroll Color', 'ae-pro'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ae-swiper-scrollbar' => 'background-color:{{VAlUE}};',
                ],
                'condition' =>
                    [
                        $this->get_control_id('scrollbar') => 'yes'
                    ]
            ]
        );

        $this->add_control(
            'heading_style_progress',
            [
                'label' => __('Progress Bar', 'ae-pro'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' =>
                    [
                        $this->get_control_id('ptype') => 'progress'
                    ]
            ]
        );
        $this->add_control(
            'progressbar_color',
            [
                'label' => __('Progress Bar Color', 'ae-pro'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .swiper-pagination-progressbar' => 'background-color:{{VAlUE}};',
                ],
                'condition' =>
                    [
                        $this->get_control_id('ptype') => 'progress'
                    ]
            ]
        );

        $this->add_control(
            'progress_color',
            [
                'label' => __('Progress Color', 'ae-pro'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .swiper-pagination-progressbar-fill' => 'background-color:{{VAlUE}};',
                ],
                'condition' =>
                    [
                        $this->get_control_id('ptype') => 'progress'
                    ]
            ]
        );

        $this->add_control(
            'progressbar_size',
            [
                'label' => __('Progress Bar Size', 'ae-pro'),
                'type' => Controls_Manager::SLIDER,
                'default' =>
                    [
                        'size' => 5
                    ],
                'range' =>
                    [
                        'min' => 1,
                        'max' => 10,
                        'step' => 1
                    ],
                'selectors' => [
                    '{{WRAPPER}} .swiper-pagination-progressbar' => 'height:{{SIZE}}px;',
                ],
                'condition' =>
                    [
                        $this->get_control_id('ptype') => 'progress'
                    ]
            ]
        );




    }

    protected function common_controls()
    {
        $this->add_control(
            'common_comtrols',
            [
                'label' => __('Setting', 'ae-pro'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );





        $this->add_control(
            'speed',
            [
                'label' => __('Speed', 'ae-pro'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 300,
                ],
                'range' => [
                    'px' => [
                        'min' => 300,
                        'max' => 10000,
                        'step' => 300
                    ]
                ]

            ]
        );

        $this->add_control(
            'autoplay',
            [
                'label' => __('Autoplay', 'ae-pro'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'label_on' => __('On', 'ae-pro'),
                'label_off' => __('Off', 'ae-pro'),
                'return_value' => 'yes',
            ]

        );

        $this->add_control(
            'duration',
            [
                'label' => __('Duration', 'ae-pro'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 3000,
                ],
                'range' => [
                    'px' =>[
                        'min' => 300,
                        'max' => 10000,
                        'step' => 300
                    ]
                ],
                'condition' => [
                    $this->get_control_id('autoplay') => 'yes'
                ],
            ]
        );

        // Todo:: different effects management
        $this->add_control(
            'effect',
            [
                'label' => __('Effects', 'ae-pro'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'fade' => __('Fade', 'ae-pro'),
                    'slide' => __('Slide', 'ae-pro'),
                    'cube' => __('Cube', 'ae-pro'),
                    'coverflow' => __('Coverflow', 'ae-pro'),
                    'flip' => __('Flip', 'ae-pro'),
                ],
                'default'=>'slide',
            ]
        );

        $this->add_responsive_control(
            'space',
            [
                'label' => __('Space Between Slides', 'ae-pro'),
                'type' => Controls_Manager::SLIDER,
                'default' =>[
                    'size' => 15,
                ],
                'tablet_default' => [
                    'size' => 10,
                ],
                'mobile_default' => [
                    'size' => 0,
                ],
                'range' => [
                    'px'=>[
                        'min'=> 0,
                        'max'=> 50,
                        'step'=> 5,
                    ]
                ]
            ]
        );

        $this->add_control(
            'loop',
            [
                'label' => __('Loop', 'ae-pro'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'label_on' => __('Yes', 'ae-pro'),
                'label_off' => __('No', 'ae-pro'),
                'return_value' => 'yes',
            ]
        );

	    $this->add_control(
		    'auto_height',
		    [
			    'label' => __('Auto Height', 'ae-pro'),
			    'type' => Controls_Manager::SWITCHER,
			    'default' => '',
			    'label_on' => __('Yes', 'ae-pro'),
			    'label_off' => __('No', 'ae-pro'),
			    'return_value' => 'yes',
		    ]
	    );

        $this->add_control(
            'zoom',
            [
                'label' => __('Zoom', 'ae-pro'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'label_on' => __('Yes', 'ae-pro'),
                'label_off' => __('No', 'ae-pro'),
                'return_value' => 'yes',
            ]
        );

    }

    protected function field_control(){
        $this->add_control(
            'field_name',
            [
                'label' => __('Custom Field Name', 'ae-pro'),
                'type'  => Controls_Manager::TEXT,
            ]
        );


        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail',
                'exclude' => [ 'custom' ],
            ]
        );

        $this->add_control(
            'enable_image_ratio',
            [
                'label' => __( 'Enable Image Ratio', 'ae-pro' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => '',
                'label_on' => __( 'Yes', 'ae-pro' ),
                'label_off' => __( 'No', 'ae-pro' ),
                'return_value' => 'yes',
            ]
        );

        $this->add_responsive_control(
            'image_ratio',
            [
                'label' => __('Image Ratio', 'ae-pro'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 0.66,
                ],
                'tablet_default' => [
                    'size' => '',
                ],
                'mobile_default' => [
                    'size' => 0.5,
                ],
                'range' => [
                    'px' => [
                        'min' => 0.1,
                        'max' => 2,
                        'step' => 0.01,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .ae-swiper-slide-wrapper.ae_image_ratio_yes .ae-acf-image' => 'padding-bottom: calc( {{SIZE}} * 100% );',
                    '{{WRAPPER}} .ae-grid-item-inner.ae_image_ratio_yes .ae-acf-image' => 'padding-bottom: calc( {{SIZE}} * 100% );',
                ],
                'condition' => [
                    $this->get_control_id('enable_image_ratio') => 'yes',
                ]
            ]
        );

        $this->add_control(
            'open_lightbox',
            [
                'label' => __('Lightbox', 'ae-pro'),
                'type' => Controls_Manager::SELECT,
                'options' =>
                    [
                        'default' => __( 'Default' , 'ae-pro'),
                        'yes' =>__( 'Yes' , 'ae-pro'),
                        'no' =>__('No' , 'ae-pro'),
                    ],
                'default'=>'no'
            ]
        );
    }

    protected function image_carousel_control()
    {

        $this->add_control(
            'image_carousel',
            [
                'label' => __('Carousel', 'ae-pro'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control( 
            'slide_per_view',
            [
                'label' => __( 'Slides Per View', 'ae-pro' ),
                'type' => Controls_Manager::TEXT,
               /* 'options'=> [
                    1 => __('1','ae-pro'),
                    2 => __('2','ae-pro'),
                    3 => __('3','ae-pro'),
                    4 => __('4','ae-pro'),
                ], */
                'default' => 3,
                'tablet_default' => 2,
                'mobile_default' => 1,
            ]
        );

        $this->add_responsive_control(
            'slides_per_group',
            [
                'label' => __( 'Slides Per Group', 'ae-pro' ),
                'type' => Controls_Manager::TEXT,
                'default' => 1,
                'tablet_default' => 1,
                'mobile_default' => 1,
            ]
        );

    }

    protected function pagination_controls(){



        $this->add_control(
            'pagination_heading',
            [
                'label' => __('Pagination', 'ae-pro'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );



        $this -> add_control(
            'ptype',
            [
                'label' => __(' Pagination Type' , 'ae-pro'),
                'type' => Controls_Manager::SELECT,
                'options' =>
                    [
                        ''        => __('None', 'ae-pro'),
                        'bullets' => __( 'Bullets' , 'ae-pro'),
                        'fraction' =>__( 'Fraction' , 'ae-pro'),
                        'progress' =>__('Progress' , 'ae-pro'),
                    ],
                'default'=>'bullets'
            ]
        );

        $this->add_control(
            'clickable',
            [
                'label' =>__('Clickable' , 'ae-pro'),
                'type' =>Controls_Manager::SWITCHER,
                'default' => 'yes',
                'label_on'=>__('Yes', 'ae-pro'),
                'label_off' =>__('No' , 'ae-pro'),
                'condition'=> [
                    $this->get_control_id('ptype') => 'bullets'
                ],
            ]
        );

        $this->add_control(
            'keyboard',
            [
                'label' => __('Keyboard Control' , 'ae-pro'),
                'type' =>Controls_Manager::SWITCHER,
                'default'=> 'yes',
                'label_on'=>__('Yes', 'ae-pro'),
                'label_off' =>__('No' , 'ae-pro'),
                'return_value'=>'yes',
            ]
        );

        $this->add_control(
            'scrollbar',
            [
                'label' =>__('Scroll bar', 'ae-pro'),
                'type' =>Controls_Manager::SWITCHER,
                'default'=>'yes',
                'label_on' =>__('Yes' , 'ae-pro'),
                'label_off'=>__('No' , 'ae-pro'),
                'return_value' => 'yes',
            ]
        );
    }

    protected function navigation_controls(){
        $this->add_control(
            'navigation_arrow_heading',
            [
                'label' => __('Prev/Next Navigaton', 'ae-pro'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',

            ]
        );

        $this->add_control(
            'navigation_button',
            [
                'label' => __('Enable' , 'ae-pro'),
                'type' =>Controls_Manager::SWITCHER,
                'default' => 'yes',
                'label_on' => __('Yes' , 'ae-pro'),
                'label_off' => __('No' , 'ae-pro'),
                'return_value' => 'yes',
            ]
        );

        $this->add_control(
            'arrows_layout',
            [
                'label' => __( 'Position', 'ae-pro' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'inside',
                'options' => [
                    'inside' => __('Inside', 'ae-pro'),
                    'outside' => __('Outside', 'ae-pro'),
                ],
                'condition'=> [
                    $this->get_control_id('navigation_button') => 'yes'
                ],

            ]

        );

        $this->add_control(
            'custom_navigation_icon',
            [
                'label' => __('Enable Custom Navigation Icon' , 'ae-pro'),
                'type' =>Controls_Manager::SWITCHER,
                'default' => 'yes',
                'label_on' => __('Yes' , 'ae-pro'),
                'label_off' => __('No' , 'ae-pro'),
                'return_value' => 'yes',
                'condition'=> [
                    $this->get_control_id('navigation_button') => 'yes'
                ],
            ]
        );

        $this->add_control(
            'arrow_icon_left',
            [
                'label' => __( 'Icon Prev', 'ae-pro' ),
                'type' => Controls_Manager::ICONS,
                'fa4compatibility' => 'icon',
                'default' => [
                    'value' => 'fa fa-angle-left',
                    'library' => 'fa-solid',
                ],
                'condition'=> [
                    $this->get_control_id('navigation_button') => 'yes',
                    $this->get_control_id('custom_navigation_icon') => 'yes'
                ],
            ]
        );

        $this->add_control(
            'arrow_icon_right',
            [
                'label' => __( 'Icon Next', 'ae-pro' ),
                'type' => Controls_Manager::ICONS,
                'fa4compatibility' => 'icon',
                'default' => [
                    'value' => 'fa fa-angle-right',
                    'library' => 'fa-solid',
                ],
                'condition'=> [
                    $this->get_control_id('navigation_button') => 'yes',
                    $this->get_control_id('custom_navigation_icon') => 'yes'
                ],
            ]
        );
    }

    protected function grid_view(){
        $this->add_control(
            'grid_layout',
            [

                'type' => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'columns',
            [
                'label' => __('Columns', 'ae-pro'),
                'type'  => Controls_Manager::NUMBER,
                'desktop_default' => '4',
                'tablet_default' => '2',
                'mobile_default' => '1',
                'min' => 1,
                'max' => 6,
                'selectors' => [
                    '{{WRAPPER}} .ae-grid-item' => 'width: calc(100%/{{VALUE}})',
                ]
            ]
        );

        $this->add_control(
          'masonry',
            [
                'label' =>__('Masonry Layout' , 'ae-pro'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'label_on' => __('On', 'ae-pro'),
                'label_off' => __('Off', 'ae-pro'),
                'return_value' => 'yes',
                'condition' => [
                    $this->get_control_id('columns!') => 1,
                    $this->get_control_id('enable_image_ratio!') => 'yes'
                ]
            ]

        );

        $this->add_responsive_control(
            'gutter',
            [
                'label' => __('Gutter','ae-pro'),
                'type' => Controls_Manager::SLIDER,
                'range'=>[
                    'px'=>[
                        'min' => 0,
                        'max' =>40,
                        'step' => 2,
                    ]
                ],
                'default'=>[
                    'unit' => 'px',
                    'size' => 30,
                ],
                'selectors' => [
                    '{{WRAPPER}} .ae-grid-item' => 'padding-left:calc({{SIZE}}{{UNIT}}/2);' ,
                    '{{WRAPPER}} .ae-grid-wrapper .ae-grid-item' => 'padding-right:calc({{SIZE}}{{UNIT}}/2);' ,
                    '{{WRAPPER}} .ae-grid .ae-grid-item' => 'margin-bottom:{{SIZE}}{{UNIT}};'
                ]
            ]
        );



    }
    protected function grid_overlay_controls(){
        $this->add_control(
            'show_overlay',
            [
                'label' => __('Show Overlay','ae-pro'),
                'type'  => Controls_Manager::SELECT,
                'options' => [
                    'hover' => __('On Hover','ae-pro'),
                    'always' => __('Always','ae-pro'),
                    'never' => __('Never','ae-pro'),
                    'hide-on-hover' => __('Hide on Hover' , 'ae-pro')
                ],
                'default'   => 'hover',
                'prefix_class'  => 'overlay-'
            ]
        );


        $this->add_control(
        'caption',
            [
                'label' => __('Caption' , 'ae-pro'),
                'type' =>Controls_Manager::SWITCHER,
                'default'=> 'yes',
                'label_on'=>__('Yes', 'ae-pro'),
                'label_off' =>__('No' , 'ae-pro'),
                'return_value'=>'yes',
                'condition'=>
                    [
                        $this->get_control_id('show_overlay!')=>'never',
                    ]
            ]


        );

        $this->add_control(
            'icon_style',
            [
                'label'=>__('Icon','ae-pro'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition'=>
                    [
                        $this->get_control_id('show_overlay!')=>'never',
                    ]

            ]
        );

        $this->add_control(
            'icon',
            [
                'label' => __( 'Icon', 'ae-pro' ),
                'type' => Controls_Manager::ICON,
                'label_block' => true,
                'default' => 'fa fa-link',
                'condition'=>
                    [
                        $this->get_control_id('show_overlay!')=>'never',
                    ]
            ]
        );

        $this->add_control(
            'view',
            [
                'label' => __( 'View', 'ae-pro' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'default' => __( 'Default', 'ae-pro' ),
                    'stacked' => __( 'Stacked', 'ae-pro' ),
                    'framed' => __( 'Framed', 'ae-pro' ),

                ],
                'default' => 'default',
                'prefix_class' => 'ae-icon-view-',
                'condition'=>[
                    $this->get_control_id('icon!')=>'',
                    $this->get_control_id('show_overlay!') => 'never'
                ],
            ]
        );


    }
    protected function grid_overlay_style_control(){


        $this->add_control(
            'overlay',
            [
                'label' => __('Overlay','ae-pro'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition'=>[
                    $this->get_control_id('show_overlay!')=>'never',
                ]
            ]

        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'overlay_color',
                'label' => __( 'Color', 'ae-pro' ),
                'types' => [ 'none', 'classic','gradient' ],
                'selector' => '{{WRAPPER}} .ae-grid-overlay',
                'condition'=>[
                    $this->get_control_id('show_overlay!')=>'never',
                ]
            ]
        );

        $this->add_control(
            'animation',
            [
                'label' => __('Animation', 'ae-pro'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '' => __('None','ae-pro'),
                    'pulse' => __('Pulse', 'ae-pro'),
                    'headShake' => __('Head Shake', 'ae-pro'),
                    'tada' => __('Tada', 'ae-pro'),
                    'fadeIn' => __('Fade In', 'ae-pro'),
                    'fadeInDown' => __('Fade In Down', 'ae-pro'),
                    'fadeInLeft' => __('Fade In Left', 'ae-pro'),
                    'fadeInRight' => __('Fade In Right', 'ae-pro'),
                    'fadeInUp' => __('Fade In Up', 'ae-pro'),
                    'rotateInDownLeft' => __('Rotate In Down Left','ae-pro'),
                    'rotateInDownRight' => __('Rotate In Down Right','ae-pro'),
                    'rotateInUpLeft' => __('Rotate In Up Left','ae-pro'),
                    'rotateInUpRight' =>__('Rotate In Up Right','ae-pro'),
                    'zoomIn' => __('Zoom In','ae-pro'),
                    'zoomInDown' => __('Zoom In Down','ae-pro'),
                    'zoomInLeft' => __('Zoom In Left', 'ae-pro'),
                    'zoomInRight' => __('Zoom In Right', 'ae-pro'),
                    'zoomInUp' => __('Zoom In Up', 'ae-pro'),
                    'slideInLeft' => __('Slide In Left', 'ae-pro'),
                    'slideInRight' => __('Slide In Right', 'ae-pro'),
                    'slideInUp' => __('Slide In Up', 'ae-pro'),
                    'slideInDown' => __('Slide In Down', 'ae-pro'),
                ],
                'default'=>'fadeIn',
                'condition' =>[
                    $this->get_control_id('show_overlay')=> ['hover', 'hide-on-hover'],
                ]
            ]
        );

        $this->add_control(
            'animation_time',
            [
                'label' => __('Animation Time','ae-pro'),
                'type'  => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 1.00
                ],
                'range' => [
                    'min' => 1.00,
                    'max' => 10.00,
                    'step' => 0.01
                ],
                'condition' => [
                    $this->get_control_id('animation!') => ''
                ],
                'selectors' => [
                    '{{WRAPPER}} .ae-grid-overlay' => 'animation-duration:{{SIZE}}s;'
                ]
            ]
        );

        $this->add_control(
            'caption_style',
            [
                'label' => __('Caption','ae-pro'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition'=>[
                    $this->get_control_id('caption')=>'yes',
                ]
            ]

        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'typography',
                'label' => __( 'Typography', 'ae-pro' ),
                'global' => [
                        'default' => Global_Typography::TYPOGRAPHY_ACCENT
                ],
                'selector' => '{{WRAPPER}} .ae-overlay-caption',
                'condition'=>[
                    $this->get_control_id('caption')=>'yes',
                ]
            ]
        );

        $this->add_control(
            'caption_color',
            [
                'label' => __('Color','ae-pro'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ae-overlay-caption' => 'color:{{VALUE}};'
                ],
                'global' => [
                        'default' => Global_Colors::COLOR_PRIMARY
                ] ,
                'condition'=>[
                    $this->get_control_id('caption')=>'yes',
                ]
            ]
        );

        $this->add_control(
            'caption_color_hover',
            [
                'label' => __('Hover Color','ae-pro'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ae-overlay-caption:hover' => 'color:{{VALUE}};'
                ],
                'condition'=>[
                    $this->get_control_id('caption')=>'yes',
                ]
            ]
        );

        $this->add_control(
            'icon_overlay_style',
            [
                'label'=>__('Icon','ae-pro'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition'=>[
                    $this->get_control_id('icon!')=>'',
                ],

            ]

        );

        $this->add_control(
            'primary_color',
            [
                'label' => __( 'Primary Color', 'ae-pro' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}}.ae-icon-view-stacked .ae-overlay-icon' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}}.ae-icon-view-framed .ae-overlay-icon, {{WRAPPER}}.ae-icon-view-default .ae-overlay-icon' => 'color: {{VALUE}}; border-color: {{VALUE}};',
                ],
                'global' => [
                        'default' => Global_Colors::COLOR_PRIMARY
                ],
                'condition'=>[
                    $this->get_control_id('icon!')=>'',
                ],
            ]
        );

        $this->add_control(
            'secondary_color',
            [
                'label' => __( 'Secondary Color', 'ae-pro' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'condition' => [
                    $this->get_control_id('view!') => 'default',
                ],
                'selectors' => [
                    '{{WRAPPER}}.ae-icon-view-framed .ae-overlay-icon' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}}.ae-icon-view-stacked .ae-overlay-icon' => 'color: {{VALUE}};',
                ],
                'condition'=>[
                    $this->get_control_id('icon!')=>'',
                ],
            ]
        );

        $this->add_control(
            'primary_color_hover',
            [
                'label' => __( 'Primary Color Hover', 'ae-pro' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}}.ae-icon-view-stacked:hover .ae-overlay-icon:hover' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}}.ae-icon-view-framed:hover .ae-overlay-icon:hover, {{WRAPPER}}.ae-icon-view-default .ae-overlay-icon' => 'color: {{VALUE}}; border-color: {{VALUE}};',
                ],
                'global' => [
                        'default'=> Global_Colors::COLOR_PRIMARY
                ],
                'condition'=>[
                $this->get_control_id('icon!')=>'',
            ],

            ]
        );

        $this->add_control(
            'secondary_color_hover',
            [
                'label' => __( 'Secondary Color Hover', 'ae-pro' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'condition' => [
                    $this->get_control_id('view!') => 'default',
                ],
                'selectors' => [
                    '{{WRAPPER}}.ae-icon-view-framed:hover .ae-overlay-icon:hover' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}}.ae-icon-view-stacked:hover .ae-overlay-icon:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'size',
            [
                'label' => __( 'Size', 'ae-pro' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 6,
                        'max' => 300,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .ae-overlay-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
                'condition'=>[
                    $this->get_control_id('icon!')=>'',
                ],
            ]
        );

        $this->add_control(
            'icon_padding',
            [
                'label' => __( 'Icon Padding', 'ae-pro' ),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .ae-overlay-icon' => 'padding: {{SIZE}}{{UNIT}};',
                ],
                'range' => [
                    'em' => [
                        'min' => 0,
                        'max' => 5,
                    ],
                ],
                'condition' => [
                    $this->get_control_id('view!') => 'default',
                ],

            ]
        );

        $this->add_control(
            'rotate',
            [
                'label' => __( 'Rotate', 'ae-pro' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 0,
                    'unit' => 'deg',
                ],
                'selectors' => [
                    '{{WRAPPER}} .ae-overlay-icon i' => 'transform: rotate({{SIZE}}{{UNIT}});',
                ],
                'condition'=>[
                    $this->get_control_id('icon!')=>'',
                ],
            ]
        );

        $this->add_control(
            'border_width',
            [
                'label' => __( 'Border Width', 'ae-pro' ),
                'type' => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .ae-overlay-icon' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    $this->get_control_id('view') => 'framed',
                ],
            ]
        );

        $this->add_control(
            'border_radius',
            [
                'label' => __( 'Border Radius', 'ae-pro' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .ae-overlay-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    $this->get_control_id('view!') => 'default',
                ],
            ]
        );

    }

    protected function grid_style_control(){

        $this->start_controls_tabs('style_tabs');

            $this->start_controls_tab(
                'normal',
                [
                    'label' => __('Normal','ae-pro')
                ]
            );

                $this->add_group_control(
                    Group_Control_Border::get_type(),
                    [
                        'name' => 'grid_border',
                        'label' => __( 'Border', 'ae-pro' ),
                        'selector' => '{{WRAPPER}} .ae-grid-item .ae-grid-item-inner',
                    ]
                );

                $this->add_control(
                    'item_border_radius',
                    [
                        'label' => __( 'Border Radius', 'ae-pro' ),
                        'type' => Controls_Manager::DIMENSIONS,
                        'size_units' => [ 'px', '%' ],
                        'selectors' => [
                            '{{WRAPPER}} .ae-grid-item-inner' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                    ]
                );

                $this->add_group_control(
                    Group_Control_Box_Shadow::get_type(),
                    [
                        'name' => 'item_box_shadow',
                        'label' => __( 'Item Shadow', 'ae-pro' ),
                        'selector' => '{{WRAPPER}} .ae-grid-item-inner',
                    ]
                );

            $this->end_controls_tab();


            $this->start_controls_tab(
                'hover',
                [
                    'label' => __('Hover','ae-pro')
                ]
            );

                $this->add_group_control(
                    Group_Control_Border::get_type(),
                    [
                        'name' => 'grid_border_hover',
                        'label' => __( 'Border', 'ae-pro' ),
                        'selector' => '{{WRAPPER}} .ae-grid-item-inner:hover',
                    ]
                );

                $this->add_control(
                    'item_border_radius_hover',
                    [
                        'label' => __( 'Border Radius', 'ae-pro' ),
                        'type' => Controls_Manager::DIMENSIONS,
                        'size_units' => [ 'px', '%' ],
                        'selectors' => [
                            '{{WRAPPER}} .ae-grid-item-inner:hover *' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            '{{WRAPPER}} .ae-grid-item-inner:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                        ],
                    ]
                );

                $this->add_group_control(
                     Group_Control_Box_Shadow::get_type(),
                    [
                        'name' => 'item_box_shadow_hover',
                        'label' => __( 'Item Shadow', 'ae-pro' ),
                        'selector' => '{{WRAPPER}} .ae-grid-item-inner:hover ',
                    ]
        );

            $this->end_controls_tab();

        $this->end_controls_tabs();

    }

    protected function get_gallery_data(){
        $images = [];
        $helper = new Helper();
        $post_data = $helper->get_demo_post_data();

        if($post_data->post_type == 'elementor_library'){
            return false;
        }

        $cf_name = $this->get_instance_value('field_name');

        if(!empty($cf_name)){
            if(class_exists('acf_pro')){
                $images = get_field($cf_name, $post_data->ID);
	            $repeater = $helper->is_repeater_block_layout();
	            if($repeater['is_repeater']){
		            if(isset($repeater['field'])){
			            $repeater_field = get_field($repeater['field'], $post_data->ID);
			            $images = $repeater_field[0][$cf_name];

		            }else {
			            $images = get_sub_field($cf_name);
		            }
	            }
            }elseif(class_exists('acf_plugin_photo_gallery')) {
                $images_arr = [];
                $images_arr = acf_photo_gallery($cf_name, $post_data->ID);
                $index = 0;
                foreach($images_arr as $img){
                    $images[$index]['ID'] = $img['id'];
                    $images[$index]['id'] = $img['id'];
                    $images[$index]['title'] = $img['title'];
                    $images[$index]['filename'] = $img['title'];
                    $images[$index]['url'] = $img['full_image_url'];
                    $image_sizes = $helper->ae_get_intermediate_image_sizes_for_acf_photo_gallery();
                    foreach($image_sizes as $image_size => $size_data){
                        $img_data = wp_get_attachment_image_src($img['id'],$image_size);
                        $images[$index]['sizes'][$size_data] = $img_data[0];
                        $images[$index]['sizes'][$size_data.'-width'] = $img_data[1];
                        $images[$index]['sizes'][$size_data.'-height'] = $img_data[2];
                    }
                    $index = $index + 1;
                }
            }else{
                $images = [];
            }

        }
        return $images;
    }

    protected function swiper_html(){
        $image_size = $this->get_instance_value('thumbnail_size');
        $images = $this->get_gallery_data();
        $arrows_layout = $this->get_instance_value('arrows_layout');
	    $swiper_data = $this->get_swiper_data();
        $settings = $this->parent->get_settings_for_display();

        if(!empty($images)) {

            $this->parent->add_render_attribute('outer-wrapper', 'class', 'ae-swiper-outer-wrapper');
            $this->parent->add_render_attribute('outer-wrapper', 'data-swiper-settings', json_encode($swiper_data));
            $this->parent->add_render_attribute('acf-gallery-widget-wrapper', 'class', 'ae-acf-gallery-widget-wrapper' );
            $this->parent->add_render_attribute('acf-gallery-widget-wrapper', 'class', 'ae-carousel-yes' );

            $arrow_horizontal_position = $this->get_instance_value('arrow_horizontal_position');
            if((!isset($arrow_horizontal_position) || $arrow_horizontal_position != 'center') && $arrows_layout == 'outside'){
                $this->parent->set_settings($this->get_control_id( 'arrow_horizontal_position' ), 'center');
            }else{
                $this->parent->add_render_attribute('acf-gallery-widget-wrapper', 'class', 'ae-vpos-' . $this->get_instance_value('arrow_vertical_position'));
                $this->parent->add_render_attribute('acf-gallery-widget-wrapper', 'class', 'ae-hpos-' . $this->get_instance_value('arrow_horizontal_position'));
            }



            $this->parent->add_render_attribute('swiper_slide_wrapper', 'class', 'ae-swiper-slide-wrapper swiper-slide-wrapper');
            if($this->get_instance_value('enable_image_ratio') == 'yes') {
                $this->parent->add_render_attribute('swiper_slide_wrapper', 'class', 'ae_image_ratio_yes');
            }
            if($this->get_instance_value('open_lightbox') != 'no') {
                $this->parent->add_render_attribute('link', [
                    'data-elementor-open-lightbox' => $this->get_instance_value('open_lightbox'),
                    'data-elementor-lightbox-slideshow' => 'ae-acf-gallery-'.rand(0,99999),
                ]);
                if (Plugin::$instance->editor->is_edit_mode()) {
                    $this->parent->add_render_attribute('link', [
                        'class' => 'elementor-clickable',
                    ]);
                }
            }
            ?>
            <div <?php echo $this->parent->get_render_attribute_string('acf-gallery-widget-wrapper'); ?>>
            <div <?php echo $this->parent->get_render_attribute_string('outer-wrapper'); ?> >
                <div class="ae-swiper-container swiper-container">
                    <div class="ae-swiper-wrapper swiper-wrapper">

                        <?php
                            foreach ($images as $image) {
                                ?>
                                <div class="ae-swiper-slide swiper-slide">
                                    <div <?php echo $this->parent->get_render_attribute_string('swiper_slide_wrapper'); ?>>
                                        <?php if($this->get_instance_value('enable_image_ratio') == 'yes') { ?>
                                        <div class="ae-acf-image">
                                        <?php } ?>
                                        <?php if ($this->get_instance_value('open_lightbox') != 'no') { ?>
                                            <a <?php echo $this->parent->get_render_attribute_string('link'); ?> href="<?php echo wp_get_attachment_url($image['id'], 'full'); ?>">
                                        <?php } ?>
                                            <?php echo wp_get_attachment_image($image['id'], $image_size); ?>
                                        <?php if ($this->get_instance_value('open_lightbox') != 'no') { ?>
                                            </a>
                                        <?php } ?>
                                        <?php if($this->get_instance_value('enable_image_ratio') == 'yes') { ?>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            <?php } ?>
                    </div>

                    <?php if($swiper_data['ptype'] != ''){ ?>
                        <div class = "ae-swiper-pagination swiper-pagination"></div>
                    <?php } ?>

                    <?php if($swiper_data['navigation'] == 'yes' && $arrows_layout == 'inside'){ ?>
                        <?php if($this->get_instance_value('arrow_horizontal_position') != 'center'){ ?>
                            <div class="ae-swiper-button-wrapper swiper-button-wrapper">
                        <?php } ?>
                        <?php if($this->get_instance_value('custom_navigation_icon') == 'yes'){ ?>
                            <div class = "ae-swiper-button-prev swiper-button-prev custom_navigation_icon">
                                <?php if(is_rtl()){
                                    Icons_Manager::render_icon($this->get_instance_value('arrow_icon_right'), ['aria-hidden' => 'true']);
                                }else{
                                    Icons_Manager::render_icon($this->get_instance_value('arrow_icon_left'), ['aria-hidden' => 'true']);
                                } ?>
                            </div>
                            <div class = "ae-swiper-button-next swiper-button-next custom_navigation_icon">
                                <?php if(is_rtl()){
                                    Icons_Manager::render_icon($this->get_instance_value('arrow_icon_left'), ['aria-hidden' => 'true']);
                                }else{
                                    Icons_Manager::render_icon($this->get_instance_value('arrow_icon_right'), ['aria-hidden' => 'true']);
                                } ?>

                            </div>
                        <?php }else{ ?>
                            <div class = "ae-swiper-button-prev swiper-button-prev"></div>
                            <div class = "ae-swiper-button-next swiper-button-next"></div>
                        <?php } ?>
                        <?php if($this->get_instance_value('arrow_horizontal_position') != 'center'){;?>
                            </div>
                        <?php } ?>
                    <?php } ?>

                    <?php if($swiper_data['scrollbar'] == 'yes'){ ?>
                        <div class = "ae-swiper-scrollbar swiper-scrollbar"></div>

                    <?php } ?>

                </div>
                <?php if($swiper_data['navigation'] == 'yes' && $arrows_layout == 'outside'){ ?>
                    <?php if($this->get_instance_value('arrow_horizontal_position') != 'center'){ ?>
                        <div class="ae-swiper-button-wrapper swiper-button-wrapper">
                    <?php } ?>
                    <?php if($this->get_instance_value('custom_navigation_icon') == 'yes'){ ?>
                        <div class = "ae-swiper-button-prev swiper-button-prev custom_navigation_icon">
                            <?php if(is_rtl()){
                                Icons_Manager::render_icon($this->get_instance_value('arrow_icon_right'), ['aria-hidden' => 'true']);
                            }else{
                                Icons_Manager::render_icon($this->get_instance_value('arrow_icon_left'), ['aria-hidden' => 'true']);
                            } ?>
                        </div>
                        <div class = "ae-swiper-button-next swiper-button-next custom_navigation_icon">
                            <?php if(is_rtl()){
                                Icons_Manager::render_icon($this->get_instance_value('arrow_icon_left'), ['aria-hidden' => 'true']);
                            }else{
                                Icons_Manager::render_icon($this->get_instance_value('arrow_icon_right'), ['aria-hidden' => 'true']);
                            } ?>

                        </div>
                    <?php }else{ ?>
                        <div class = "ae-swiper-button-prev swiper-button-prev"></div>
                        <div class = "ae-swiper-button-next swiper-button-next"></div>
                    <?php } ?>
                    <?php if($this->get_instance_value('arrow_horizontal_position') != 'center'){ ?>
                        </div>
                    <?php } ?>
                <?php } ?>
            </div>
            </div>
        <?php }
    }
    protected function grid_html(){
        $image_size = $this->get_instance_value('thumbnail_size');
        $masonry= $this->get_instance_value('masonry');
        $animation = $this->get_instance_value('animation');
        $images = $this->get_gallery_data();
        
        $icon=$this->get_instance_value('icon');

        $caption=$this->get_instance_value('caption');

        $this->parent->add_render_attribute('grid-wrapper','class','ae-masonry-'.$masonry);
        $this->parent->add_render_attribute('grid-wrapper','class','ae-grid-wrapper');
           ?>
        <?php
        $this->parent->add_render_attribute('grid_item_inner', 'class', 'ae-grid-item-inner');
        if($this->get_instance_value('enable_image_ratio') == 'yes') {
            $this->parent->add_render_attribute('grid_item_inner', 'class', 'ae_image_ratio_yes');
        }

            $this->parent->add_render_attribute('link', [
                'data-elementor-open-lightbox' => $this->get_instance_value('open_lightbox'),
                'data-elementor-lightbox-slideshow' => 'ae-acf-gallery-'.rand(0,99999),
            ]);
        if (Plugin::$instance->editor->is_edit_mode()) {
            $this->parent->add_render_attribute('link', [
                'class' => 'elementor-clickable',
            ]);
        }
        ?>

               <div <?php echo $this->parent->get_render_attribute_string('grid-wrapper'); ?>>
                    <div class="ae-grid">
                        <?php
                        if(!empty($images)) {
                            foreach ($images as $image) {
                                if ($image_size == 'full') {
                                    $src = $image['url'];
                                } else {
                                    $src = $image['sizes'][$image_size];
                                } ?>
                                <figure class="ae-grid-item">
                                    <div <?php echo $this->parent->get_render_attribute_string('grid_item_inner'); ?>>
                                        <?php if($this->get_instance_value('enable_image_ratio') == 'yes') { ?>
                                        <div class="ae-acf-image">
                                            <?php } ?>
                                        <a href="<?php echo $image['url']; ?>" <?php echo $this->parent->get_render_attribute_string('link'); ?>>
                                            <img src="<?php echo $src; ?>"/>
                                            <div class="ae-grid-overlay <?php echo $animation ?>">
                                                <div class="ae-grid-overlay-inner">
                                                    <div class="ae-icon-wrapper">
                                                        <?php if (!empty($icon)) { ?>
                                                            <div class="ae-overlay-icon"><i
                                                                        class="<?php echo $icon ?>"> </i></div>
                                                        <?php } ?>
                                                    </div>

                                                    <?php if (!empty($image['caption']) && $caption == 'yes') { ?>
                                                        <div class="ae-overlay-caption"><?php echo $image['caption']; ?></div>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </a>
                                            <?php if($this->get_instance_value('enable_image_ratio') == 'yes') { ?>
                                            </div>
                                                <?php } ?>
                                    </div>
                                </figure>
                            <?php }
                        }?>
                     </div>
               </div>
        <?php
    }

	function get_swiper_data( ){

		// $direction = $this->get_instance_value('orientation');

		//print_r(json_encode($space));
		/*$loop = $this->get_instance_value('loop');

		$zoom = $this->get_instance_value('zoom');
		$pagination_type = $this->get_instance_value('ptype');
		$navigation_button = $this->get_instance_value('navigation_button');
		$clickable = $this->get_instance_value('clickable');
		$keyboard = $this->get_instance_value('keyboard');

		$ptype= $this->get_instance_value('ptype');*/

		// TODO:: Swiper Data Populate
        if($this->get_instance_value('speed')['size']) {
            $swiper_data['speed'] = $this->get_instance_value('speed')['size'];
        }else{
            $swiper_data['speed'] = 1000;
        }
		$swiper_data['direction'] = 'horizontal';

		if($this->get_instance_value('autoplay') === 'yes'){
		    $duration = $this->get_instance_value('duration');
			$swiper_data['autoplay']['delay'] = $duration['size'];
            $swiper_data['autoplay']['disableOnInteraction'] = true;
		}else{
            $swiper_data['autoplay'] = false;
        }

		$swiper_data['effect'] = $this->get_instance_value('effect');

		$swiper_data['loop'] = $this->get_instance_value('loop');
		$swiper_data['autoHeight'] = ($this->get_instance_value('auto_height') == 'yes');
/*
        if($this->get_instance_value('effect') == 'fade' || $this->get_instance_value('effect') == 'flip'){
            $swiper_data['spaceBetween']['default'] = 0;
            $swiper_data['spaceBetween']['tablet'] = 0;
            $swiper_data['spaceBetween']['mobile'] = 0;

            $swiper_data['slidesPerView']['default'] = 1;
            $swiper_data['slidesPerView']['tablet'] = 1;
            $swiper_data['slidesPerView']['mobile'] = 1;

            $swiper_data['slidesPerGroup']['default'] = 1;
            $swiper_data['slidesPerGroup']['tablet'] = 1;
            $swiper_data['slidesPerGroup']['mobile'] = 1;

        }else {*/
            $swiper_data['spaceBetween']['default'] = $this->get_instance_value('space_mobile')['size'] != '' ? $this->get_instance_value('space_mobile')['size'] : 5;
            $swiper_data['spaceBetween']['tablet'] = $this->get_instance_value('space')['size'] != '' ? $this->get_instance_value('space')['size'] : 15;
            $swiper_data['spaceBetween']['mobile'] = $this->get_instance_value('space_tablet')['size'] != '' ? $this->get_instance_value('space_tablet')['size'] : 10;

            $swiper_data['slidesPerView']['default'] = $this->get_instance_value('slide_per_view_mobile') != '' ? $this->get_instance_value('slide_per_view_mobile') : 1;
            $swiper_data['slidesPerView']['tablet'] = $this->get_instance_value('slide_per_view') != '' ? $this->get_instance_value('slide_per_view') : 3;
            $swiper_data['slidesPerView']['mobile'] = $this->get_instance_value('slide_per_view_tablet') != '' ? $this->get_instance_value('slide_per_view_tablet') : 2;

            $swiper_data['slidesPerGroup']['default'] = $this->get_instance_value('slides_per_group_mobile') != '' ? $this->get_instance_value('slides_per_group_mobile') : 1;
            $swiper_data['slidesPerGroup']['tablet'] = $this->get_instance_value('slides_per_group') != '' ? $this->get_instance_value('slides_per_group') : 1;
            $swiper_data['slidesPerGroup']['mobile'] = $this->get_instance_value('slides_per_group_tablet') != '' ? $this->get_instance_value('slides_per_group_tablet') : 1;

        //}

		$swiper_data['ptype'] = $this->get_instance_value('ptype');
		$swiper_data['clickable'] = $this->get_instance_value('clickable');
		$swiper_data['navigation'] = $this->get_instance_value('navigation_button');
		$swiper_data['scrollbar'] = $this->get_instance_value('scrollbar');

		return $swiper_data;
	}





}