<?php
// Control core classes for avoid errors
if (class_exists('CSF')) {

    //
    // Set a unique slug-like ID
    $really_easy_banner = '_really_easy_banner';

    //
    // Create options
    CSF::createOptions($really_easy_banner, array(
        'menu_title' => 'Really Easy Banner',
        'framework_title' => 'Really Easy Banner',
        'menu_slug' => 'really_easy_banner_options',
        'nav' => 'inline',
        'menu_position' => 3,
    ));

    //
    // Create a section
    CSF::createSection($really_easy_banner, array(
        'title' => 'General',
        'fields' => array(

            array(
                'id'          => 'banner_layout',
                'type'        => 'select',
                'title'       => 'Layout Select',
                'placeholder' => 'Select an option',
                'options'     => array(
                    'layout1'  => 'Layout 1',
                    'layout2'  => 'Layout 2',
                    'layout3'  => 'Layout 3',
                ),
                'default'     => 'layout1'
            ),
            array(
                'id'      => 'main_heading',
                'type'    => 'text',
                'title'   => 'Main Heading',
                'default' => 'This is a banner simple view to with a link.For background & animation purchase our premium version'
            ),
            array(
                'id'      => 'button_text',
                'type'    => 'text',
                'title'   => 'Button Text',
                'default' => 'Click Here'
            ),
            array(
                'id'    => 'button_link',
                'type'  => 'link',
                'title' => 'Button Link',
            ),
            array(
                'id'    => 'background_img',
                'type'  => 'media',
                'title' => 'Background Image',
            ),

        )
    ));

}
