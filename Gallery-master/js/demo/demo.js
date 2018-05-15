
$(function () {
  'use strict'

  blueimp.Gallery([
    {
      title: 'CAR Race',
      href: 'https://alshamil.bluecast.ae/uploads/videos/carrace.mp4',
      type: 'video/mp4',
      poster: 'http://alshamil.silveroaktechnovations.com/uploads/product_images/videoThumbnail.jpg'
    },
  ], {
    container: '#blueimp-video-carousel',
    carousel: true
  })
})