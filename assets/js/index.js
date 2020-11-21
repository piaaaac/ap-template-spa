
// -------------------------------------------
// CLASSES
// -------------------------------------------

function App (initialUid) {

  this.state = {
    uid: null,
  };

  // --- direct js
  
  this.loadPage = function (uid, pushState) {
  
    // --- preliminary operations

    $("body").addClass("loading");
    var that = this;
    var requestMeta, responseMeta, template;

    // --- in case of UID like projects/proj-12
    var search = uid.match(/([a-z0-9\-]+)\/([a-z0-9\-]+)/);
    if (search) {
      requestMeta = {
        "method": "GET",
        "url": "https://processform.frontend.biz/api/public/modules/content/document/"+ search[2],
      };
      responseMeta = {
        "cmsModule": "content",
        "type": "item",
      };
      template = "single-content";

    } else {
      requestMeta = apiBindings[uid].request;
      responseMeta = apiBindings[uid].response;
      template = apiBindings[uid].template;
    }

    // --- request

    var queryString = 'json=' + JSON.stringify(requestMeta.data);
    $.ajax({
      "url": requestMeta.url,
      "type": requestMeta.method,
      "data": queryString,
    })
    .done(function (responseData) {
      $("body").removeClass("loading");
      console.log("API response: ", responseData);

      // --- clean up the response 

      var responseType = responseMeta.type;
      var data = mapResponseToTemplateContext(responseData, responseType);

      // --- use template

      var hbt = templates[template];
      var markup = hbt(data);
      $("#content").html(markup);
      $("html, body").animate({ "scrollTop": 0 }, 600);

      // --- Manage browser history
      
      if (pushState !== false) {
        history.pushState({"uid": uid}, null, uid);
      }
      that.state.uid = uid;
    });
  }

  this.loadPage(initialUid);

  this.handleMenuClick = function (uid) {
    this.loadPage(uid);
    this.toggleMenu(false);
  }

  this.toggleMenu = function (toggle) {
    var t = (toggle !== undefined) ? toggle : !$("#menu-xs").hasClass("open");
    $("#menu-xs").toggleClass("open", t);
    $("body").toggleClass("menu-open", t);
    $(".hamburger").toggleClass("is-active", t);
  }
}

window.onpopstate = function (event) {
  console.log(event.state);
  var uid = event.state.uid;
  a.loadPage(uid, false);
}




