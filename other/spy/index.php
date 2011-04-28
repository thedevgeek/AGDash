<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>JSON Ticket Spy</title>

<style type="text/css" media="screen">
	body {
		font-size: 1em/1.5em;
		font-family: "MS Trebuchet", sans-serif;
	}
	.ctr {
		font-weight: bold;
		color: #f00;
		margin-right: 1em;
	}
	#holder DIV {
		margin-bottom: 1em;
	}
</style>
</head>
<body>
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
Closed Call count
		</span>
	</div>
</div>
</center>
</body>
</html>

