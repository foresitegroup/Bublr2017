jQuery(document).ready(function(){
  jQuery('#sponsor-logos .site-width .sponsors').slick({
    infinite: true,
    slidesToShow: 5,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 2000,
    accessibility: false,
    arrows: false,
    dots: false,
    responsive: [
      {
        breakpoint: 801,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 3
        }
      },
      {
        breakpoint: 481,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 2
        }
      }
    ]
  });
});