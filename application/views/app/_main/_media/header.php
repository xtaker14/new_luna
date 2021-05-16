<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:300,600">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css">

<style>
.mfp-with-zoom .mfp-title, .touch .gallery-image figcaption, html:not(.touch) .gallery-image figcaption {
  position: absolute;
  /* top: 50%;
  left: 50%; */
  bottom: 0;
  left: 0;
  /* transform: translate(-50%, -50%); */
  font-size: 14px;
  /* color: rgba(255, 255, 255, 0); */
  color: #fff;
  padding: 1em;
  transition: all 0.2s ;
  font-weight: 600;
  max-width: calc(100% - 9em);
  line-height: 1.25;
  text-align: center;
  box-sizing: border-box;
}
.mfp-with-zoom .mfp-title:before, .touch .gallery-image figcaption:before, html:not(.touch) .gallery-image figcaption:before, .mfp-with-zoom .mfp-title:after, .touch .gallery-image figcaption:after, html:not(.touch) .gallery-image figcaption:after {
  content: "";
  position: absolute;
  background: rgba(0, 0, 0, 0.2);
  width: 100%;
  height: 100%;
  padding: 1em;
  transition: all 0.3s ease-in-out;
  opacity: 0;
  z-index: -1;
}
.mfp-with-zoom .mfp-title:before, .touch .gallery-image figcaption:before, html:not(.touch) .gallery-image figcaption:before, .mfp-with-zoom .mfp-title:after, .touch .gallery-image figcaption:after, html:not(.touch) .gallery-image figcaption:after {
  right: 100%;
  bottom: 100%;
}
.mfp-with-zoom .mfp-title:after, .touch .gallery-image figcaption:after, html:not(.touch) .gallery-image figcaption:after {
  left: 100%;
  top: 100%;
}

.mfp-with-zoom.mfp-ready .mfp-title, .touch .gallery-image figcaption, html:not(.touch) .gallery-image:hover figcaption {

  max-height: 70px;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);

  color: white;
  text-shadow: 0 0 1px rgba(0, 0, 0, 0.2);
  transition: all 0.2s ease 0.3s;
}
.mfp-with-zoom.mfp-ready .mfp-title:before, .touch .gallery-image figcaption:before, html:not(.touch) .gallery-image:hover figcaption:before, .mfp-with-zoom.mfp-ready .mfp-title:after, .touch .gallery-image figcaption:after, html:not(.touch) .gallery-image:hover figcaption:after {
  opacity: 1;
}
.mfp-with-zoom.mfp-ready .mfp-title:before, .touch .gallery-image figcaption:before, html:not(.touch) .gallery-image:hover figcaption:before {
  right: -1.5em;
  bottom: -1.5em;
}
.mfp-with-zoom.mfp-ready .mfp-title:after, .touch .gallery-image figcaption:after, html:not(.touch) .gallery-image:hover figcaption:after {
  left: -1.5em;
  top: -1.5em;
}

html {
  -moz-osx-font-smoothing: grayscale;
  -webkit-font-smoothing: antialiased;
  text-rendering: optimizelegibility;
}

.gallery-image {
  position: relative;
  margin: 0;
  padding: 0;
}
.gallery-image:before, .gallery-image:after {
  content: "";
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  border: 16px solid rgba(0, 0, 0, 0.1);
  transition: all 0.2s;
  will-change: border;
}
.gallery-image:after {
  border-width: 0;
}
.gallery-image img {
  display: block;
  max-width: 100%;
  height: auto;
}
html:not(.touch) .gallery-image {
  overflow: hidden;
}
html:not(.touch) .gallery-image:hover:before {
  border-width: 16px;
}
html:not(.touch) .gallery-image:hover:after {
  border-width: 32px;
}
.touch .gallery-image figcaption {
  top: auto;
  bottom: 2em;
}

.mfp-with-zoom .mfp-container, .mfp-with-zoom.mfp-bg {
  opacity: 0;
  -webkit-backface-visibility: hidden;
          backface-visibility: hidden;
  transition: all 0.3s ease-out;
}
.mfp-with-zoom.mfp-bg {
  background-color: rgba(0, 0, 0, 0.9);
}
.mfp-with-zoom.mfp-ready .mfp-container {
  opacity: 1;
}
.mfp-with-zoom.mfp-ready.mfp-bg {
  opacity: 1;
}
.mfp-with-zoom.mfp-removing .mfp-container, .mfp-with-zoom.mfp-removing.mfp-bg {
  opacity: 0;
}
.mfp-with-zoom img.mfp-img {
  padding: 0;
}
.mfp-with-zoom .mfp-figure:after {
  top: 0;
  bottom: 0;
}
.mfp-with-zoom .mfp-container {
  padding: 0;
}
.mfp-with-zoom .mfp-content {
  overflow: hidden;
}
.mfp-with-zoom .mfp-bottom-bar {
  top: auto;
  bottom: 0;
  margin-top: 0;
}
.mfp-with-zoom .mfp-title {
  top: auto;
  bottom: 2em;
}
.mfp-arrow {
  opacity: 1;
  margin-top: 0 !important;
  width: 20%;
  height: 30%;
  transform: translateY(-50%);
}
.mfp-arrow:before, .mfp-arrow:after {
  margin: 0;
  border: none;
  width: 2rem;
  height: 2rem;
  transform: rotate(-45deg) translate(-50%, -100%);
  opacity: 1;
  top: 50%;
  left: 50%;
  transition: all 0.15s;
}
.mfp-arrow:active {
  transform: translateY(-50%) scale(0.95);
}

.mfp-arrow-left {
  left: 0;
}
.mfp-arrow-left:before, .mfp-arrow-left:after {
  border-top: 2px solid white;
  border-left: 2px solid white;
}
.mfp-arrow-left:after {
  margin-left: 2rem;
}
.mfp-arrow-left:hover:before, .mfp-arrow-left:active:before {
  margin-left: 2rem;
}
.mfp-arrow-left:hover:after, .mfp-arrow-left:active:after {
  margin-left: 0;
}

.mfp-arrow-right {
  right: 0;
}
.mfp-arrow-right:before, .mfp-arrow-right:after {
  border-right: 2px solid white;
  border-bottom: 2px solid white;
}
.mfp-arrow-right:after {
  margin-left: 2rem;
}
.mfp-arrow-right:hover:before {
  margin-left: 2rem;
}
.mfp-arrow-right:hover:after {
  margin-left: 0;
}

button.mfp-close {
  opacity: 1;
  margin-top: 0 !important;
  width: 20%;
  height: 30%;
  font: 0/0 serif;
  text-shadow: none;
  color: transparent;
}
button.mfp-close:before, button.mfp-close:after {
  content: "";
  position: absolute;
  top: 50%;
  left: 50%;
  margin: 0;
  border: none;
  width: 2rem;
  height: 2rem;
  opacity: 1;
  transition: all 0.15s;
  transform-origin: 0 0;
  border-top: 2px solid white;
  border-left: 2px solid white;
}
button.mfp-close:before {
  transform: rotate(-45deg);
}
button.mfp-close:after {
  transform: rotate(135deg);
}
button.mfp-close:hover:before {
  transform: rotate(135deg);
}
button.mfp-close:hover:after {
  transform: rotate(315deg);
}
button.mfp-close:active {
  transform: scale(0.95);
}

a {
  text-decoration: none;
  color: inherit;
}

[id=footer] {
  margin-top: 10vh;
  padding: 10vh 0;
  text-align: center;
}
[id=footer] .container {
  position: relative;
}
[id=footer] .container:before, [id=footer] .container:after {
  content: "";
  position: absolute;
  bottom: 100%;
  left: 20px;
  z-index: 10;
  border-top: 2px solid;
  width: 10%;
  margin-bottom: 10vh;
}
[id=footer] .container:after {
  left: auto;
  right: 20px;
}
[id=footer] * {
  display: block;
}
[id=footer] * + * {
  margin-top: 5vh;
}
[id=footer] .logo {
  font-weight: 600;
  font-size: 1.5em;
}
[id=footer] .copy {
  text-transform: uppercase;
  font-size: 0.75em;
  font-weight: 600;
}
.mM{display:block;border-radius:50%;box-shadow:0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);position:fixed;bottom:1em;right:1em;-webkit-transform-origin:50% 50%;transform-origin:50% 50%;-webkit-transition:all 240ms ease-in-out;transition:all 240ms ease-in-out;z-index:9999;opacity:0.75}.mM svg{display:block}.mM:hover{opacity:1;-webkit-transform:scale(1.125);transform:scale(1.125)}
</style>