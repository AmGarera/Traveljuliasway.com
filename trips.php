<?php
// single.php, see connected twig example
$context = Timber::get_context();
$context['post'] = new TimberPost(28); // It's a new Timber\Post object, but an existing post from WordPress.
Timber::render('single.twig', $context);
?>