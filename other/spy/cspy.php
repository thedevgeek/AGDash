<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript" src="spy.js"></script>
<script type="text/javascript" charset="utf-8">
	$(document).ready(function() { 
		$('#holder').spy({ limit: 3, fadeLast: 2, ajax: 'spy.php', push : custom_push, method: 'json', isDupe: isDupe });
	});
	
	function isDupe(l, p) 
	{
		return (l.num == p.num);
	}
	
	function custom_push(r)
	{
		var json = r;
		// I'm being lazy here, but you get the idea:
		var html = '<div><span class="ctr">'; //  removed due to conflicts in Safari 3 - style="display:none"
		html += json.num + '</span><span class="content">';
		html += json.string + '</span></div>';
		$('#' + this.id).prepend(html);
	}
	
</script>
<center>
<div id="holder">
	<div>
		<span class="ctr"></span><span class="content">
		</span>
	</div>
</div>
</center>
