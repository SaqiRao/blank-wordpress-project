<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
   <meta charset="<?php bloginfo( 'charset' ); ?>">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title><?php bloginfo('name'); ?> &raquo; <?php is_front_page() ? bloginfo('description') : wp_title(''); ?></title>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEJdFf5kC6bJkFJWrtgmo5zbsQPSv49wn5eC02dfZEOlC0D3E5boPEuWa72+X" crossorigin="anonymous">
   <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
   <header>
      <div class="container">
         <!-- Logo and Title -->
         <div class="row">

            <!-- Navigation Menu -->
            <div class="col-md-12">
               <nav class="navbar navbar-expand-lg navbar-light bg-light">
                  <a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a>
                  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                     <span class="navbar-toggler-icon"></span>
                  </button>
                  <div class="collapse navbar-collapse" id="navbarNav">
                     <?php
                        wp_nav_menu( array(
                           'theme_location' => 'header-menu', 
                           'container' => false, 
                           'menu_class' => 'navbar-nav ms-auto',
                           'fallback_cb' => '__return_false',
                           'depth' => 2,
                           'walker' => new WP_Bootstrap_Navwalker(), 
                        ) );
                     ?>
                  </div>
               </nav>
            </div>
         </div>
      </div>
   </header>