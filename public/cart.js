/* [CART ACTIONS] */
var cart = {
  count : function () {
  // count () : update items count

    gen.ajax({
      target : "ajax-cart.php",
      data : {
        req : "count",
      },
      container : "page-cart-count"
    });
  },

  toggle : function (reload) {
  // toggle : show/hide cart

    var pd = document.getElementById("products"),
        cd = document.getElementById("cart");

    if (reload || cd.classList.contains("ninja")) {
      gen.ajax({
        target : "ajax-cart.php",
        data : {
          req : "show",
        },
        container : "cart",
        load : function () {
          pd.classList.add("ninja");
          cd.classList.remove("ninja");
        }
      });
    } else {
      pd.classList.remove("ninja");
      cd.classList.add("ninja");
    } 
  },

  add : function (id) {
  // add () : add item to cart

    gen.ajax({
      target : "ajax-cart.php",
      data : {
        req : "add",
        FID : id
      },
      load : cart.count
    });
  },

  change : function (id) {
  // change () : change quantity

    var qty = document.getElementById("qty_"+id).value;
    console.log(qty);
    gen.ajax({
      target : "ajax-cart.php",
      data : {
        req : "change",
        FID : id,
        qty : qty
      },
      load : function () {
        cart.count();
        cart.toggle(1);
      }
    });
  },

  checkout : function () {
  // checkout () : checkout

    gen.ajax({
      target : "ajax-cart.php",
      data : {
        req : "checkout",
        CID:$SSION['sessData']['CID'],
         email : $sessData['CID']
      },
      silent : 1,
      load : function (res) {
        if (res=="OK") {
          window.location = "thank-you.php";
        } else {
          gen.nShow(res);
        }
      }
    });
    return false;
  }
};

window.addEventListener("load", cart.count);