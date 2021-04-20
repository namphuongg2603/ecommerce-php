<?php 
 session_start(); 
 session_unset(); 
 session_destroy();

?> 

<script>
    setTimeout(() => {
        window.location.href = "/ecommerce-php/views/page/index.php"
    }, 1000);
</script>
