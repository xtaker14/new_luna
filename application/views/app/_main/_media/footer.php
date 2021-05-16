
<script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>

<script id="rendered-js">
  (function() { 

    $('.gallery-link').magnificPopup({
      type: 'image',
      closeOnContentClick: true,
      closeBtnInside: false,
      mainClass: 'mfp-with-zoom mfp-img-mobile',
      image: {
      verticalFit: true,
      titleSrc: function(item) {
        return item.el.find('figcaption').text() || item.el.attr('title');
      }
      },
      zoom: {
      enabled: true
      },
      // duration: 300
      gallery: {
      enabled: true,
      navigateByImgClick: false,
      tCounter: ''
      },
      // disableOn: function() {
      //     return $(window).width() > 640;
      // }
      callbacks: {
        open: function() {
          // $('.mfp-content img').css({
          //   'visibility' : 'visible'
          // });
        },
        change: function() {
          console.log('Content changed');
          // console.log(this.content); // Direct reference to your popup element
        },
        beforeOpen: function() {
          // console.log('Start of popup initialization');
        },
        close: function() {
          // console.log('Popup removal initiated (after removalDelay timer finished)');
        },
        beforeClose: function() {
          // Callback available since v0.9.0
          // console.log('Popup close has been initiated');
        },
        afterClose: function() {
          // console.log('Popup is completely closed');
        },
        elementParse: function(item) {
          // Function will fire for each target element
          // "item.el" is a target DOM element (if present)
          // "item.src" is a source that you may modify

          // console.log('Parsing content. Item object that is being parsed:', item);
        },
        resize: function() {
          // console.log('Popup resized');
          // resize event triggers only when height is changed or layout forced
        },
        markupParse: function(template, values, item) {
          // Triggers each time when content of popup changes
          // console.log('Parsing:', template, values, item);
        },
        updateStatus: function(data) {
          // console.log('Status changed', data);
          // "data" is an object that has two properties:
          // "data.status" - current status type, can be "loading", "error", "ready"
          // "data.text" - text that will be displayed (e.g. "Loading...")
          // you may modify this properties to change current status or its text dynamically
        },
        imageLoadComplete: function() {
          // fires when image in current popup finished loading
          // avaiable since v0.9.0
          console.log('Image loaded');
          $('.mfp-content img').css({
            'visibility' : 'visible'
          });
        },
      }
    });
  }).call(this);
</script>