(function(window){var svgSprite="<svg>"+""+'<symbol id="icon-iconfont14" viewBox="0 0 1024 1024">'+""+'<path d="M207.166293 192.992479 207.166293 192.992479c6.864338-6.864338 17.992793-6.864338 24.857131 0l267.546475 267.546475c6.864338 6.864338 17.992793 6.864338 24.857131 0l267.548522-267.547499c6.864338-6.864338 17.992793-6.864338 24.856108 0l0.002047 0.002047c6.864338 6.864338 6.864338 17.992793 0 24.857131l-292.4077 292.40463c-6.864338 6.864338-17.992793 6.864338-24.857131 0l-292.403606-292.40463C200.301955 210.986295 200.301955 199.856817 207.166293 192.992479z"  ></path>'+""+'<path d="M207.166293 513.747807 207.166293 513.747807c6.864338-6.864338 17.992793-6.864338 24.857131 0l267.546475 267.546475c6.864338 6.864338 17.992793 6.864338 24.857131 0l267.548522-267.547499c6.864338-6.864338 17.992793-6.864338 24.856108 0l0.002047 0.002047c6.864338 6.864338 6.864338 17.992793 0 24.857131l-292.4077 292.403606c-6.864338 6.864338-17.992793 6.864338-24.857131 0l-292.403606-292.403606C200.301955 531.7406 200.301955 520.611122 207.166293 513.747807z"  ></path>'+""+'<path d="M511.998977 735.585241"  ></path>'+""+"</symbol>"+""+"</svg>";var script=function(){var scripts=document.getElementsByTagName("script");return scripts[scripts.length-1]}();var shouldInjectCss=script.getAttribute("data-injectcss");var ready=function(fn){if(document.addEventListener){if(~["complete","loaded","interactive"].indexOf(document.readyState)){setTimeout(fn,0)}else{var loadFn=function(){document.removeEventListener("DOMContentLoaded",loadFn,false);fn()};document.addEventListener("DOMContentLoaded",loadFn,false)}}else if(document.attachEvent){IEContentLoaded(window,fn)}function IEContentLoaded(w,fn){var d=w.document,done=false,init=function(){if(!done){done=true;fn()}};var polling=function(){try{d.documentElement.doScroll("left")}catch(e){setTimeout(polling,50);return}init()};polling();d.onreadystatechange=function(){if(d.readyState=="complete"){d.onreadystatechange=null;init()}}}};var before=function(el,target){target.parentNode.insertBefore(el,target)};var prepend=function(el,target){if(target.firstChild){before(el,target.firstChild)}else{target.appendChild(el)}};function appendSvg(){var div,svg;div=document.createElement("div");div.innerHTML=svgSprite;svgSprite=null;svg=div.getElementsByTagName("svg")[0];if(svg){svg.setAttribute("aria-hidden","true");svg.style.position="absolute";svg.style.width=0;svg.style.height=0;svg.style.overflow="hidden";prepend(svg,document.body)}}if(shouldInjectCss&&!window.__iconfont__svg__cssinject__){window.__iconfont__svg__cssinject__=true;try{document.write("<style>.svgfont {display: inline-block;width: 1em;height: 1em;fill: currentColor;vertical-align: -0.1em;font-size:16px;}</style>")}catch(e){console&&console.log(e)}}ready(appendSvg)})(window)