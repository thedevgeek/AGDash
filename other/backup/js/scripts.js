 $(document).ready(function() { 
 
        $('#reheat').click(function() { 
            $.blockUI({ message: $('#question'), css: { width: '275px' } }); 
        }); 
 
        $('#yes').click(function() { 
            // update the block message 
            $.blockUI({ message: "<h1>Importing Data from HEAT...</h1>" }); 
 
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
