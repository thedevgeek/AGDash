 $(document).ready(function() { 
 
        $('#reheat').click(function() { 
            $.blockUI({ message: $('#question'), css: { width: '275px' } }); 
        }); 
 
        $('#yes').click(function() { 
            // update the block message 
            $.blockUI({ message: "<center><h2>Refreshing the Data...<br><br><img src=img/loading.gif></h2></center>" }); 
 
            $.ajax({ 
                url: 'generate.php', 
                cache: false, 
                complete: function() { 
                    // unblock when remote call returns 
                    $.unblockUI(),
		window.location="http://172.27.79.116/agdash/"; 
                } 
            }); 
        }); 
 
        $('#no').click(function() { 
            $.unblockUI(); 
            return false; 
        }); 
 
    }); 
