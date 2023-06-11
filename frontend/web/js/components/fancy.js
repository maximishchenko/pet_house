import { Fancybox } from "@fancyapps/ui";

/* Fancybox.bind('[data-fancybox]', {
  Toolbar: {
    display: {
      right: ['close']
    },
  }
});


 */


Fancybox.bind('[data-fancybox]', {
  idle: false,
  compact: false,
  dragToClose: false,

  animated: false,
  showClass: 'f-fadeSlowIn',
  hideClass: false,

  Carousel: {
    infinite: false,
  },

  Images: {
    zoom: false,
    Panzoom: {
      maxScale: 1.5,
    },
  },

  Toolbar: {
    absolute: true,
    display: {
      left: [],
      middle: [],
      right: ['close'],
    },
  },

  Thumbs: {
    type: 'classic',
    Carousel: {
      axis: 'x',

      slidesPerPage: 1,
      Navigation: true,
      center: true,
      fill: true,
      dragFree: true,

      breakpoints: {
        '(min-width: 640px)': {
          axis: 'y',
        },
      },
    },
  },
});
