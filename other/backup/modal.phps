<html>
<head>
<title>Modal Import Test</title>
<script src="js/jquery.js"></script>
<script src="js/jquery.blockUI.js"></script>
<script type="text/javascript"> 
    $(document).ready(function() { 
 
        $('#test').click(function() { 
            $.blockUI({ message: $('#question'), css: { width: '275px' } }); 
        }); 
 
        $('#yes').click(function() { 
            // update the block message 
            $.blockUI({ message: "<h1>Remote call in progress...</h1>" }); 
 
            $.ajax({ 
                url: 'importemployee.php', 
                cache: false, 
                complete: function() { 
                    // unblock when remote call returns 
                    $.unblockUI(); 
                } 
            }); 
        }); 
 
        $('#no').click(function() { 
            $.unblockUI(); 
            return false; 
        }); 
 
    }); 
</script> 
</head>
<body>
<input id="test" type="submit" value="Show Dialog" /> 
<div id="question" style="display:none; cursor: default"> 
        <h1>Would you like to contine?.</h1> 
        <input type="button" id="yes" value="Yes" /> 
        <input type="button" id="no" value="No" /> 
</div> 
</body>
</html>
