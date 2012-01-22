<div class="wrap">
	<h2>Elapsed Days - Set Paramater</h2>
	<form action="options.php" method="post">
		<?php wp_nonce_field('update-options'); ?>
		<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row"><label for="ElapsedDaysBorderLine">表示ライン</label></th>
					<td colspan="2"><input name="ElapsedDaysBorderLine" type="text" id="ElapsedDaysBorderLine" value="<?php echo get_option('ElapsedDaysBorderLine'); ?>" class="regular-text">日</td>
				</tr>
				<tr valign="top">
					<th scope="row" rowspan="4">表示フォーマット</th>
					<td colspan="2"><input name="ElapsedDaysViewFormat" type="text" id="ElapsedDaysViewFormat" value="<?php echo get_option('ElapsedDaysViewFormat'); ?>" class="regular-text"></td>
				</tr>
				<tr valign="top">
					<th style="width:4em;"><label for="ElapsedDaysViewFormatYear">年(%y)</label></th>
					<td><input name="ElapsedDaysViewFormatYear" type="text" id="ElapsedDaysViewFormatYear" value="<?php echo get_option('ElapsedDaysViewFormatYear'); ?>" class="regular-text"></td>
				</tr>
				<tr valign="top">
					<th style="width:4em;"><label for="ElapsedDaysViewFormatMonth">月(%m)</label></th>
					<td><input name="ElapsedDaysViewFormatMonth" type="text" id="ElapsedDaysViewFormatMonth" value="<?php echo get_option('ElapsedDaysViewFormatMonth'); ?>" class="regular-text"></td>
				</tr>
				<tr valign="top">
					<th style="width:4em;"><label for="ElapsedDaysViewFormatDay">日(%d)</label></th>
					<td><input name="ElapsedDaysViewFormatDay" type="text" id="ElapsedDaysViewFormatDay" value="<?php echo get_option('ElapsedDaysViewFormatDay'); ?>" class="regular-text"></td>
				</tr>
				<tr valign="top">
					<th style="width:4em;"><label for="ElapsedDaysViewFormatNone">当日</label></th>
					<td colspan="2"><input name="ElapsedDaysViewFormatNone" type="text" id="ElapsedDaysViewFormatNone" value="<?php echo get_option('ElapsedDaysViewFormatNone'); ?>" class="regular-text"></td>
				</tr>
			</tbody>
		</table>
		<input type="hidden" name="action" value="update" />
		<input type="hidden" name="page_options" value="ElapsedDaysBorderLine,ElapsedDaysViewFormat,ElapsedDaysViewFormatYear,ElapsedDaysViewFormatMonth,ElapsedDaysViewFormatDay,ElapsedDaysViewFormatNone" />
		<p class="submit"><input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" /></p>
	</form>
</div>