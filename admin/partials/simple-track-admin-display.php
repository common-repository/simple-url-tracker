<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://en.gravatar.com/jasonatp15
 * @since      1.0.0
 *
 * @package    Simple_Track
 * @subpackage Simple_Track/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<p>
	<h3>Instructions:</h3>
		To create new tracking link.
	<ol>
		<li>Enter at least 3 of the five fields below.</li>
		<li>Update Post.</li>
		<li>Copy your new link at the bottom that contains new campaign fields.</li>
		<li>Monitor traffic through Google analitics.</li>
	</ol>
			
</p>


<br>


	

    <label for="campain_field">Campaign Source *</label>
		<select name="campain_field" id="campain_field" class="postbox">
			<option value="affiliate">Affiliate</option>
			<option value="facebook">Facebook</option>
			<option value="instagram">Instagram</option>
			<option value="twitter">Twitter</option>
			<option value="news-letter">News Letter</option>
			<option value="pinterest">Pinterest</option>
			<option value="Linkedin">Linkedin</option>
		</select>
		<br>
	<label for="medium_field">Campaign Medium *</label>
		<select name="medium_field" id="medium_field" class="postbox">
			<option value="cpc">CPC</option>
			<option value="banner">Banner</option>
			<option value="email">Email</option>
		</select>
		<br>
	<label for="campain_name_field">Campaign Name *</label>
		<input type="text" name="campain_name_field" id="campain_name_field" value="simple-url"><br>
		<label for="campain_term_field">Campaign Term </label>
		<input type="text" name="campain_term_field" id="campain_term_field"><span>Optional (Identify the paid keywords)</span><br>
	<label for="campain_content_field">Campaign Content </label>
    	<input type="text" name="campain_content_field" id="campain_content_field"><span>Optional (Use to differentiate ads)</span><br>
	<h2>Original Link <?= get_permalink();?></h2>
	<h3>Update post to create new link.</h3>
	