<?php
/**
 * Global Custom Fields
 * A value that you can access from anywhere that returns a value you can use. 
 * Posts and Pages can have custom fields as well.
 * get the value: <?php echo get_option('myname'); ?>
 * @link https://digwp.com/demo/Digging-Into-WordPress_DEMO.pdf
*/
add_action('admin_menu', 'add_gcf_interface');
function add_gcf_interface() {
	add_options_page(
		'Global Custom Fields', 	// page title
		'Global Custom Fields', 	// menu title
		'8', 						// capability ??
		'functions',				// menu slug ??
		'editglobalcustomfields'	// function callback
	);
}
function editglobalcustomfields() { 

?>
<div class="wrap">
	<h1>Global Custom Fields</h1>
	<form method="post" action="options.php">
	<?php wp_nonce_field('update-options') ?>
		<table class="form-table">
			<tbody>
				<!--- e.g.
				<tr>
					<th scope="row">
						<label for="myname">My Name</label>
					</th>
					<td>
						<input type="text" name="myname" size="45" value="<?php echo get_option('myname'); ?>" />
						<textarea name="aqua_longitude"  cols="80%" rows="7"><?php echo get_option('aqua_longitude'); ?></textarea>
						<p class="description">Your name...</p>
					</td>
				</tr>
				-->
				<tr>
					<th scope="row">
						<label for="metaltec_metadescription">Meta Description</label>
					</th>
					<td>
						<p>FR</p>
						<textarea name="metaltec_metadescription"  cols="50%" rows="6"><?php echo get_option('metaltec_metadescription'); ?></textarea>
						<p class="description">max. 250 characters</p>
					</td>
					<td>
						<p>DE</p>
						<textarea name="metaltec_metadescription_de"  cols="50%" rows="6"><?php echo get_option('metaltec_metadescription_de'); ?></textarea>
						<p class="description">max. 250 characters</p>
					</td>
				</tr>
				<tr>
					<th scope="row">
						<label for="metaltec_metakeywords">Meta Keywords</label>
					</th>
					<td>
						<p>FR</p>
						<textarea name="metaltec_metakeywords"  cols="50%" rows="6"><?php echo get_option('metaltec_metakeywords'); ?></textarea>
						<p class="description">Separate with commas, max. 30</p>
					</td>
					<td>
						<p>DE</p>
						<textarea name="metaltec_metakeywords_de"  cols="50%" rows="6"><?php echo get_option('metaltec_metakeywords_de'); ?></textarea>
						<p class="description">Separate with commas, max. 30</p>
					</td>
				</tr>
				<tr>
					<th scope="row">
						<label for="metaltec_gatrackid">Google Analytics Tracking ID</label>
					</th>
					<td>
						<input type="text" name="metaltec_gatrackid" size="45" value="<?php echo get_option('metaltec_gatrackid'); ?>" />
						<p class="description">UA-XXXXXXXX-X</p>
					</td>
				</tr>
				<tr>
					<th scope="row">
						<label for="metaltec_latitude">Latitude</label>
					</th>
					<td>
						<input type="text" name="metaltec_latitude" size="45" value="<?php echo get_option('metaltec_latitude'); ?>" />
						<p class="description">eg: 38.792763</p>
					</td>
				</tr>
				<tr>
					<th scope="row">
						<label for="metaltec_longitude">Longitude</label>
					</th>
					<td>
						<input type="text" name="metaltec_longitude" size="45" value="<?php echo get_option('metaltec_longitude'); ?>" />
						<p class="description">eg: 15.218296</p>
					</td>
				</tr>
			</tbody>
		</table>
		<p class="submit"><input class="button button-primary" type="submit" name="Submit" value="Update Options" /></p>
		<input type="hidden" name="action" value="update" />
		<input type="hidden" name="page_options" value="metaltec_metadescription,metaltec_metadescription_de,metaltec_metakeywords,metaltec_metakeywords_de,metaltec_gatrackid,metaltec_latitude,metaltec_longitude" />
	</form>
</div>

<?php } 