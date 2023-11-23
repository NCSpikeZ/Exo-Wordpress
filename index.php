<?php get_header(); ?>

  <main>
  <section 
  class="hero" 
  id="home" 
  style="background-image: url(<?php echo get_template_directory_uri() .'/'. get_option('header-hero_background-url'); ?>);"
>
  <header>
    <h1 class="visually-hidden"><?php echo bloginfo('name'); ?></h1>
    <p class="h1 text-white">
      <span class="bg-primary"><?php echo get_option('header-hero_main-title'); ?></span><br>
      <small class="bg-secondary"><?php echo get_option('header-hero_under-title'); ?></small>
    </p>
    <a href="#about" class="please-scroll"><?php echo get_option('header-hero_scroll-label'); ?></a>
  </header>
</section>
<section class="container section about" id="about">
  <div class="row align-items-center">
    <div class="col-md">
      <?php $aboutSection = get_page_by_title('about'); ?>
      <header>
        <h2 class="mb-3"><?php echo $aboutSection->post_title; ?></h2>
      </header>
      <p class="lead"><?php echo $aboutSection->post_content; ?></p>
    </div>
    <div class="col-md">
      <img class="img-fluid" src="<?php echo get_the_post_thumbnail_url($aboutSection->ID, 'medium'); ?>" alt="cordonnier au travail">
    </div>
  </div>
</section>
    <section class="container section services" id="services">
      <header>
        <h2 class="text-center mb-3">Nos services</h2>
      </header>
      <?php
  $services = new WP_Query([ // je crée une variable $services
    'post_type' => 'services', // la je précise quel post_type je veux (dans mon cas "services")
    'post_status' => 'publish', // la je précise que je veux des posts qui sont publié
    'limit' => 3, // dans mon cas je n'en ai besoin que de trois
    'orderby' => 'date', // je les trie par date 
    'date' => true // je récupéère ma date
  ]);

  if ($services->have_posts()): // ici je vérifie que $services posède bien mes posts
?>
  <div class="row">
    <?php 
      while ($services->have_posts()): // la je lance ma boucle sur mes posts contenu dans services
      $services->the_post(); // la récupère mon post
    ?>
      <div class="col-4">
        <div class="card">
          <img 
            src="<?php the_post_thumbnail_url(); ?>"
            class="card-img-top"
            alt="<?php the_title() ?> | service | <?php echo bloginfo('name'); ?>">
          <div class="card-body">
            <h3 class="card-title h5"><?php the_title(); ?></h3>
            <p class="card-text"><?php the_content(); ?></p>
          </div>
        </div>
      </div>
    <?php endwhile; ?>
  </div>
<?php else: ?>
  <h5>On a pas encore de services a vous proposer mais ça arrive !</h5>
<?php endif; ?>
    </section>
    <div class="container section contact" id="contact">
      <header>
        <h2 class="text-center mb-3">Contactez-nous</h2>
      </header>
     <div class="row">
  <?php
    $contactPage = get_page_by_title( 'contact' ); // je récupère la page contact
    echo apply_filters('the_content', $contactPage->post_content); // j'affiche le contenu qui vient de la page contact
  ?>
</div>
    </div>
  </main>

<?php get_footer(); ?>