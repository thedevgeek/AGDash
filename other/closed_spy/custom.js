 $(document).ready(function() {
         $("#num").load("closed.php");
   var refreshId = setInterval(function() {
          $("#num").load('closed.php?randval='+ Math.random());
   }, 1000);
});

