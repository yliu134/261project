var gen = {
  /* [NOTIFICATION] */
  nTimer : null,
  nShow : function (message) {
  // nShow () : show notification message

    document.getElementById("noteIn").innerHTML = message;
    document.getElementById("noteOut").classList.add("show");
    if (gen.nTimer != null) { clearTimeout(gen.nTimer); }
    gen.nTimer = setTimeout(gen.nHide, 1000);
  },
  nHide : function () {
  // nHide () : hide notification message

    document.getElementById("noteOut").classList.remove("show");
  },

  /* [AJAX] */
  ajax : function (opt) {
  // ajax () : do AJAX request

    // MASSAGE DATA
    var data = null;
    if (opt.data) {
      data = new FormData();
      for (var d in opt.data) {
        data.append(d, opt.data[d]);
      }
    }

    // AJAX REQUEST
    var xhr = new XMLHttpRequest();
    xhr.open('POST', opt.target, true);
    xhr.onload = function(){
      if (opt.container) {
        document.getElementById(opt.container).innerHTML = this.response;
      } else {
        if (opt.silent==undefined) { gen.nShow(this.response); }
      }
      if (typeof opt.load == "function") {
        opt.load(this.response);
      }
    };
    xhr.send(data);
  }
};