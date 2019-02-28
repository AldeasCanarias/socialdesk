<?php
/* Template Name: Formulario Entrada */
?>

<?php

get_header();

$is_page_builder_used = et_pb_is_pagebuilder_used( get_the_ID() );

?>

<div id="main-content">

	<?php if ( ! $is_page_builder_used ) : ?>

		<div class="container">
			<div id="content-area" class="clearfix">
				<div id="left-area">

	<?php endif; ?>

				<?php  /*Formulario*/  ?>
				<form name="contenidoColaboradores" id="contenidoColaboradores" method="post">
					<p>
						<input type="text" name="tituloPost" placeholder="Escribe aquí el título de la entrada"/>
					</p>

					<p>
						<?php
							wp_editor(
								$post_obj->post_content,
								'userpostcontent',
								array('textarea_name' => 'contenido')
							);
							?>
					</p>

					<p>
						<input type="file" name="fichero">
					</p>


					<p>
						<input type="submit" value="Enviar Post"/>
					</p>

					<?php wp_nonce_field('contenidoColaboradores'); ?>

				</form>

				<?php

					/*Concatenar las partes del contenido del form*/
					$content = array($_POST['contenido'] . $_POST['fichero']);

					/*Crear entrada*/
					$mi_entrada = array(
					'post_title' => wp_strip_all_tags($_POST['tituloPost']),
					'post_content' => $content,
					'post_type' => 'post',
					'post_status' => 'pending',
					'post_author' => $user_id,
					);

					/*Insertar entrada*/
					$nuevo_post = wp_insert_post($mi_entrada);
				?>

				<?php if ( ! $is_page_builder_used ) : ?>

				</div> <!-- #left-area -->

				<?php get_sidebar(); ?>
			</div> <!-- #content-area -->
		</div> <!-- .container -->

	<?php endif; ?>

</div> <!-- #main-content -->

<?php

get_footer();
