  <script src="js/jquery.js" charset="utf-8"></script>
  <script src="js/bootstrap.js" charset="utf-8"></script>
  <script src="js/masonary.js" charset="utf-8"></script>
  <script src="js/imagesloaded.pkgd.js"></script>
  <script>
  (function( $ ) {

   var $container = $('.masonry-container');
   $container.imagesLoaded( function () {
       $container.masonry({
           columnWidth: '.item',
           itemSelector: '.item'
       });
   });
   })(jQuery);
  </script>
</body>
</html>
<?php mysql_close($masterdb); mysql_close($slavedb); ?>
