<?php    
$COMPONENT_urlManager = array(
            'urlFormat'=>'path',
            'rules'=>array(
                'site/register_event/<slug:[a-zA-Z0-9-]+>'=> array('site/register_event'),
                'site/support/<site:[a-zA-Z0-9-]+>/<category_slug:[a-zA-Z0-9-]+>'=> array('site/support'),
                'site/support/<site:[a-zA-Z0-9-]+>'=> array('site/support'),
                
                // seo page
                'page/<slug:[a-zA-Z0-9-]+>'=> array('member/page/view_page_info'),
                
                //seo tag
                'tag/<name:[a-zA-Z0-9-]+>'=> array('member/tag/view_tag_info'),
                
                //seo tag
                'page/<slug:[a-zA-Z0-9-]+>'=> array('site/viewpage'),
                
                //seo tag
                'category/<slug:[a-zA-Z0-9-]+>'=> array('member/category/view_category_info'),

                //seo post : post/view_post_info/slug/this-post-demo2/cat/clothes
                'category/<cat:[a-zA-Z0-9-]+>/<slug:[a-zA-Z0-9-]+>'=> array('member/post/detail_post'),
//                'product/<action>'=>'product/product/<action>',
                'products/<action>/<slug:[a-zA-Z0-9-]+>'=> array('product/product/<action>'),
                'products/<action:(index|downloadbrochure|search)>'=> array('product/product/<action>'),
                '<action:(error|unsubscribe)>'=>'site/<action>',
                'admin/<action:(login|logout|error|changePassword)>'=>'admin/site/<action>',
                'member/<action:(error|login|logout|forgot_password|register|change_password)>'=>'member/site/<action>',
                'member/<action:(profile|edit_profile|change_password)>'=>'member/users/<action>',
                'member/verify_register/<id>'=>'member/site/verify_register',
                '<controller:\w+>/<id:\d+>'=>'<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
                '<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
                '<url:(admin|member)>'=>'<url>/site/',
    //
            ),
            'showScriptName'=>false,
        )
?>