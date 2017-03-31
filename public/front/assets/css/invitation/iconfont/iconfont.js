;(function(window) {

  var svgSprite = '<svg>' +
    '' +
    '<symbol id="icon-yanzhengma" viewBox="0 0 1024 1024">' +
    '' +
    '<path d="M919.561369 245.727541c-0.899486-28.28623-24.311709-55.009871-52.010561-59.8409 0 0-107.385752-16.977673-167.643138-38.420031-75.231425-26.770713-149.681044-85.617983-149.681044-85.617983-23.220864-16.58063-58.83806-15.552208-80.374562 2.372024 0 0-52.704362 53.179177-151.044088 84.22117-90.852194 36.510542-163.464979 40.248679-163.464979 40.248679-27.402093 3.571339-50.991348 28.867468-51.522444 57.147558 0 0-3.690042 145.387251 0.966001 272.985348 1.759063 228.268914 271.994788 453.937606 408.55193 453.937606 134.416386 0 366.709963-157.224858 403.249157-450.619024C925.617295 347.953783 919.561369 245.727541 919.561369 245.727541zM709.887976 445.981401 477.54835 681.152515c-9.899464 10.018168-26.696012 11.174504-38.07927 2.124384l-121.329323-96.414887c-22.289656-17.711384-24.614607-48.538483-4.89038-69.169359 19.587104-20.48966 53.223179-23.199375 75.962066-5.403057l56.322773 44.083008 193.563484-182.358281c20.162202-18.995633 52.216245-18.458397 71.897493 0.325411-0.281409-0.293689-0.35918-0.693802-0.649799-0.984421l1.64036 1.64343c-0.290619-0.290619-0.696872-0.3776-0.99056-0.659009C729.922265 394.23076 729.659275 425.969625 709.887976 445.981401z"  ></path>' +
    '' +
    '</symbol>' +
    '' +
    '<symbol id="icon-password" viewBox="0 0 1024 1024">' +
    '' +
    '<path d="M815.157895 409.6 798.342737 409.6 798.342737 409.6 646.709895 409.6 646.709895 409.6 360.448 409.6 360.448 238.915368C360.448 182.379789 428.328421 119.484632 511.973053 119.484632 595.671579 119.484632 663.632842 182.379789 663.632842 238.915368L663.632842 280.872421C663.632842 281.114947 663.632842 281.384421 663.632842 281.6 663.632842 281.842526 663.632842 282.085053 663.632842 282.354526L663.632842 290.142316 664.225684 290.142316C668.240842 319.110737 692.843789 341.342316 722.485895 341.342316 752.262737 341.342316 776.757895 319.110737 780.853895 290.142316L781.527579 290.142316 781.527579 238.915368C781.527579 106.981053 660.803368 0 511.973053 0 363.196632 0 242.499368 106.981053 242.499368 238.915368L242.499368 409.626947 208.788211 409.626947C153.034105 409.626947 107.789474 455.464421 107.789474 512L107.789474 921.626947C107.789474 978.162526 153.034105 1024 208.788211 1024L815.184842 1024C871.019789 1024 916.210526 978.162526 916.210526 921.626947L916.210526 512C916.210526 455.464421 871.019789 409.6 815.157895 409.6L815.157895 409.6ZM562.553263 787.671579 562.553263 834.344421C562.553263 863.663158 539.917474 887.430737 511.973053 887.430737 484.109474 887.430737 461.446737 863.663158 461.446737 834.344421L461.446737 787.671579C421.645474 768.754526 394.051368 728.171789 394.051368 681.121684 394.051368 615.989895 446.895158 563.173053 511.973053 563.173053 577.131789 563.173053 629.921684 615.989895 629.921684 681.121684 629.921684 728.171789 602.381474 768.754526 562.553263 787.671579L562.553263 787.671579Z"  ></path>' +
    '' +
    '</symbol>' +
    '' +
    '<symbol id="icon-iphone" viewBox="0 0 1024 1024">' +
    '' +
    '<path d="M704 64H285.866667c-49.066667 0-89.6 40.533333-89.6 89.6v716.8c0 49.066667 40.533333 89.6 89.6 89.6H704c49.066667 0 89.6-40.533333 89.6-89.6V153.6C793.6 104.533333 753.066667 64 704 64z m-209.066667 866.133333c-25.6 0-44.8-19.2-44.8-44.8s19.2-44.8 44.8-44.8 44.8 19.2 44.8 44.8-19.2 44.8-44.8 44.8z m209.066667-149.333333c0 17.066667-12.8 29.866667-29.866667 29.866667H315.733333c-17.066667 0-29.866667-12.8-29.866666-29.866667V213.333333c0-17.066667 12.8-29.866667 29.866666-29.866666h358.4c17.066667 0 29.866667 12.8 29.866667 29.866666v567.466667z"  ></path>' +
    '' +
    '</symbol>' +
    '' +
    '</svg>'
  var script = function() {
    var scripts = document.getElementsByTagName('script')
    return scripts[scripts.length - 1]
  }()
  var shouldInjectCss = script.getAttribute("data-injectcss")

  /**
   * document ready
   */
  var ready = function(fn) {
    if (document.addEventListener) {
      if (~["complete", "loaded", "interactive"].indexOf(document.readyState)) {
        setTimeout(fn, 0)
      } else {
        var loadFn = function() {
          document.removeEventListener("DOMContentLoaded", loadFn, false)
          fn()
        }
        document.addEventListener("DOMContentLoaded", loadFn, false)
      }
    } else if (document.attachEvent) {
      IEContentLoaded(window, fn)
    }

    function IEContentLoaded(w, fn) {
      var d = w.document,
        done = false,
        // only fire once
        init = function() {
          if (!done) {
            done = true
            fn()
          }
        }
        // polling for no errors
      var polling = function() {
        try {
          // throws errors until after ondocumentready
          d.documentElement.doScroll('left')
        } catch (e) {
          setTimeout(polling, 50)
          return
        }
        // no errors, fire

        init()
      };

      polling()
        // trying to always fire before onload
      d.onreadystatechange = function() {
        if (d.readyState == 'complete') {
          d.onreadystatechange = null
          init()
        }
      }
    }
  }

  /**
   * Insert el before target
   *
   * @param {Element} el
   * @param {Element} target
   */

  var before = function(el, target) {
    target.parentNode.insertBefore(el, target)
  }

  /**
   * Prepend el to target
   *
   * @param {Element} el
   * @param {Element} target
   */

  var prepend = function(el, target) {
    if (target.firstChild) {
      before(el, target.firstChild)
    } else {
      target.appendChild(el)
    }
  }

  function appendSvg() {
    var div, svg

    div = document.createElement('div')
    div.innerHTML = svgSprite
    svgSprite = null
    svg = div.getElementsByTagName('svg')[0]
    if (svg) {
      svg.setAttribute('aria-hidden', 'true')
      svg.style.position = 'absolute'
      svg.style.width = 0
      svg.style.height = 0
      svg.style.overflow = 'hidden'
      prepend(svg, document.body)
    }
  }

  if (shouldInjectCss && !window.__iconfont__svg__cssinject__) {
    window.__iconfont__svg__cssinject__ = true
    try {
      document.write("<style>.svgfont {display: inline-block;width: 1em;height: 1em;fill: currentColor;vertical-align: -0.1em;font-size:16px;}</style>");
    } catch (e) {
      console && console.log(e)
    }
  }

  ready(appendSvg)


})(window)