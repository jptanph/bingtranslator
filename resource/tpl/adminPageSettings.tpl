
<p class="require"><span class="neccesary">*</span> Required</p>
<table border="1" cellspacing="0" class="table_input_vr" style="margin-bottom:3px;">
<colgroup>
	<col width="165px" />
	<col width="*" />
</colgroup>
<tr>
	<th><label for="show_html_value">Choose default language 1</label></th>
	<td>
		<span class="neccesary">*</span>
		<select id="def1" value="" class="fix" name="def1" maxlength="15">
		    <option>en</option>
		</select>

		<br />&nbsp;&nbsp;&nbsp;E.G. (en)
		<span class="limit">
			<span id="span-username" style="display:none;">Required Field</span>
		</span>
	</td>
</tr>
<tr>
	<th><label for="show_html_value">Choose default language 2</label></th>
	<td>
		<span class="neccesary">*</span>
		<select id="def1" value="" class="fix" name="def1" maxlength="15">
		    <option>en</option>
		</select>
		<br />&nbsp;&nbsp;&nbsp;E.G. (ar)
		<span class="limit">
			<span id="span-username" style="display:none;">Required Field</span>
		</span>
	</td>
</tr>

</table>

<script type="text/javascript">
//<![CDATA[
function chk_validate (){
	document.getElementById('module_label_wrap').className='warn_border';
}
//]]>
</script>
<div class="tbl_lb_wide_btn">
	<a href="#" class="btn_apply" title="Save changes" id="save-settings" onclick="adminPageSettings.execSave();" >Save</a>
	<a href="#" class="add_link" id="restore-settings" title="Reset to default" onclick="adminPageSettings.execReset();">Reset to Default</a>
</div>
