
    $(function(){
        
      
    var $container = $('#ef-portfolio');
    $container.imagesLoaded( function(){
        $container.isotope({
          itemSelector : '.ef-item'
        });
      });
    });

