<?php
namespace Blog;

return array(
    'constants' => array(
        'UPLOADED_FILES_DIRPATH' => __DIR__ . '/../public/img',
        'IMAGES_SRC_DIRPATH'     => '/img',
    ),
    'blog_media_controller' => array(
        'alias' => 'ajax_media_upload',
        'view_helper' => array(
            'display_form_as_popup'      => false,
        ),
    ),

    'blog_post_controller' => array(
        'alias' => 'ajax_media_upload',
        'controller_plugin' => array(
            'route_success' => array(
                'route'  => 'blog_post_route',
                'params' => array(
                    'action' => 'create'
                ),
                'reuse_matched_params' => true,
            ),
        ),
        // Override the overall dog controller behaviour in
        // specific actions
        'action_override' => array(
            'create' => array( //tell uploader to set the form route to different than controller
                'view_helper' => array(
                    //overrides the on success, to add medias to wall
                    'include_packaged_js_script_from_basename' => 'image_picker_aware_media_upload.js.phtml', 
                ),
            ),
        ),
    ),

    'blog_file_controller' => array(
        'service' => array(
            'file_hydrator' => 'blogUploadFileHydrator',
            'form_action_route_params' => array(
                'route' => 'blog_file_route',
                'params' => array(
                    'controller' => 'blog_file_controller',
                    'action' => 'upload',
                ),
                'reuse_matched_params' => true,
            ),
        ),
        'controller_plugin' => array(
            'route_success' => array(
                'route' => 'blog_file_route',
                'params' => array(
                    'action' => 'index'
                ),
                'reuse_matched_params' => true,
            ),
        ),
    ),
);
