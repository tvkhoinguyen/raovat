<?php    
$COMPONENT_urlManager = array(
            'urlFormat'=>'path',
            'rules'=>array(
                'products'=> array('product/product'),
                'products/<action>/<slug:[a-zA-Z0-9-]+>'=> array('product/product/<action>'),
                // seo page
                'page/<slug:[a-zA-Z0-9-]+>'=> array('member/page/view_page_info'),
                'notify/<slug:[a-zA-Z0-9-]+>'=> array('site/viewnotifiedpage'),
                
                //seo tag
                'page/<slug:[a-zA-Z0-9-]+>'=> array('site/viewpage'),
                
                //seo tag
                'category/<slug:[a-zA-Z0-9-]+>'=> array('member/category/view_category_info'),

                //seo post : post/view_post_info/slug/this-post-demo2/cat/clothes
                'category/<cat:[a-zA-Z0-9-]+>/<slug:[a-zA-Z0-9-]+>'=> array('member/post/detail_post'),
//                'product/<action>'=>'product/product/<action>',
                

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