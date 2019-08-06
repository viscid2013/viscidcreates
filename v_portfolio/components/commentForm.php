<?php
session_start();
 
if (isset($_REQUEST['c_iid'])){
	$ciid = $_REQUEST['c_iid'];
}
if (isset($_REQUEST['loc'])){
	$loc = $_REQUEST['loc'];
}

?>
	<div id="commentEnterDiv_<?php echo $ciid; ?>">
		<div id="commentMsg_<?php echo $ciid; ?>" class="w3-block w3-theme-alertPink" style="display: none; padding: 4px;"></div>
	<form name="commentForm_<?php echo $ciid; ?>" id="commentForm_<?php echo $ciid; ?>">
		<input type="text" class="commClass_<?php echo $ciid; ?>" id="comment_iid" name="comment_iid" value="<?php echo $ciid; ?>" style="display: none" />
		<input type="text" class="commClass_<?php echo $ciid; ?>" id="comment_loc" name="comment_loc" value="<?php echo $loc; ?>" style="display: none" />
		<textarea class="w3-input w3-border commClass_<?php echo $ciid; ?>" id="comment" name="comment" onKeyUp="entryLimit(this.id,'250','<?php echo $ciid; ?>','comm')"></textarea>		
		<div class="w3-block w3-theme w3-center" id="subComment" onClick="postComment('<?php echo $ciid; ?>','<?php echo $loc; ?>')">Submit</div>
		<div class="w3-block w3-theme-alertPink w3-center" id="cancelComment" onClick="fetchComments('<?php echo $loc; ?>','<?php echo $ciid; ?>')">Cancel</div>
		</form>
	</div>
	
