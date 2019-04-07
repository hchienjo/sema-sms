var view = '';
var begun = false;

$(function(){ // this is the main entry after loadview happens
	// main code when a page begins ...
	begun = true; // mark entry point loaded ... view might still be null

	// // hide the page first
	// $("body").css("display", "none");

	// // load up page contents if view has been loaded
	// if (view!='') { loadPage(); }

    // $("body").fadeIn(500);


    $("#closePopup").on("click", function (e) {
        e.preventDefault();
        $("#dialog-box").css("display", "none");
    });

    $("#bulk_message").keyup(function(){
        var count = $(this).val().length;
      $("#bulkcountchars").text(count);
      $("#bulkcountmsg").text(Math.floor(count/160));
      if ((count < 160) || (count >= 320)) {
        $("#msg1").text('Messages');
      } else {
        $("#msg1").text('Message');
      }
      if (count == 1) {
        $("#char1").text('Character');
      } else {
        $("#char1").text('Characters');
      }
    });

    $("#express_message").keyup(function(){
        var count = $(this).val().length;
      $("#expresscountchars").text(count);
      $("#expresscountmsg").text(Math.floor(count/160));
      if ((count < 160) || (count >= 320)) {
        $("#msg2").text('Messages');
      } else {
        $("#msg2").text('Message');
      }
      if (count == 1) {
        $("#char2").text('Character');
      } else {
        $("#char2").text('Characters');
      }
    });

    $("#cus_bulk_message").keyup(function(){
        var count = $(this).val().length;
      $("#cus_bulkcountchars").text(count);
      $("#cus_bulkcountmsg").text(Math.floor(count/160));
      if ((count < 160) || (count >= 320)) {
        $("#msg3").text('Messages');
      } else {
        $("#msg3").text('Message');
      }
      if (count == 1) {
        $("#char3").text('Character');
      } else {
        $("#char3").text('Characters');
      }
    });


        $(".nav-tabs a").click(function(){
            var content = $(".tab-content");
            content.hide();

            var tab  = $(this).parent(),
                tabIndex = tab.index(),
                tabPanel = $(this).closest('.panel'),
                tabHead = tabPanel.find(".nav-link").eq(tabIndex),
                tabPane = tabPanel.find(".tab-pane").eq(tabIndex);

            tabPanel.find('.active').removeClass('active');
            tabHead.addClass('active');
            tabPane.addClass('active');
            content.fadeIn(200);
        });

        if (view=="billing") {
            var slider = document.getElementById("unitsRange");
            var units = document.getElementById("units");
            var amount = document.getElementById("amount");
            var label = document.getElementById("unitLabel");
            
                units.value = slider.value;
                $("#amount").val(slider.value);

                if ((slider.value == '1') || (slider.value == '0'))
                    label.innerHTML = "UNIT";
                else
                    label.innerHTML = "UNITS";
            
            slider.oninput = function() {
                var value = this.value;
                $("#units").val(value);

                if (value <= 100000) {
                    $("#amount").val(value);
                } else if(value <= 250000) {
                    $("#amount").val(Math.round(value*0.9));
                } else if(value <= 500000) {
                    $("#amount").val(Math.round(value*0.8));
                } else if(value > 500001) {
                    $("#amount").val(Math.round(value*0.7));
                }

                if ((slider.value == '1') || (slider.value == '0'))
                    label.innerHTML = "UNIT";
                else
                    label.innerHTML = "UNITS";
            }

            
            units.oninput = function() {
                var value = this.value;
                $("#unitsRange").val(value);

                if (value <= 100000) {
                    $("#amount").val(value);
                } else if(value <= 250000) {
                    $("#amount").val(Math.round(value*0.9));
                } else if(value <= 500000) {
                    $("#amount").val(Math.round(value*0.8));
                } else if(value > 500001) {
                    $("#amount").val(Math.round(value*0.7));
                } 

                if ((slider.value == '1') || (slider.value == '0'))
                    label.innerHTML = "UNIT";
                else
                    label.innerHTML = "UNITS";
            }
        }
});



function checkInput(evt){

    var field=document.getElementById('units');
    var value=field.value;

    if (value == '') {
        field.value = '0';
        $("#unitsRange").val(0);
        $("#amount").val(0);
        $("#unitsLabel").val("UNITS");
    }

    if (value.length > 1 && value[0] == '0') {
        field.value = value.substr(1);
        $("#amount").val(value);
    }

}

//Popup dialog
function popup(e) {
		e.stopPropagation();
	// get the screen height and width  
	var maskHeight = $(document).height();  
	var maskWidth = $(window).width();
	
	// calculate the values for center alignment
	var dialogTop =  (maskHeight/3) - ($('#dialog-box').height()/2);  
	var dialogLeft = (maskWidth/2) - ($('#dialog-box').width()/2); 
	
	// assign values to the overlay and dialog box
	$('#dialog-box').css({top:dialogTop, left:dialogLeft}).show();
	
	// display the message
	$('#dialog-message').html("\
        <div class=\"container row\">\
            <div class=\"col-sm-4\">\
            </div>\
            <div class=\"col-sm-4\">\
            </div>\
            <div class=\"col-sm-4\">\
            </div>\
        </div>\
        ");


    // Instruction    What You should type    How it will appear
    //                             To Send a message showing the recepient's fist name     Dear {fname}, welcome to our SMS service.   Dear Kevin, welcome to our SMS service.
    //                             To send a message showing the recipients first and last name    Dear {names}, welcome to our SMS service.   Dear Kevin Jones, welcome to our SMS service.
    //                             To send a message showing the recipients title and last name    Dear {sname}, welcome to our SMS service.   Dear Mr. Jones welcome to our SMS service
			
}


$(window).on('pageshow', function(){
    $("body").fadeIn(500);
});

// toggle the hamburger-icon and sidebar when window has been resized to and fro phone/laptop
$(window).resize(function(){
  	if (view!="main" || view!="login" || view!="register") { // if logged in
	  navbar_visible = $("#menu-toggle").is(":visible");

	  if (navbar_visible) { // phone
		if ($("#wrapper")[0].className == 'toggled') {
		    $("#wrapper").toggleClass("toggled");
		    $("#menu-toggle").toggleClass("is-active");
		}
	  } else { // laptop or tablet
		if ($("#wrapper")[0].className != 'toggled') {
		    $("#wrapper").toggleClass("toggled");
		    $("#menu-toggle").toggleClass("is-active");
		}
	  }
	}
});

// toggle menu and sidebar when menu clicked
$("#menu-toggle").click(function(e) {
    e.preventDefault();
    $("#wrapper").toggleClass("toggled");
    $("#menu-toggle").toggleClass("is-active");
});


// functions
// tell the main entry which page is entering
function loadView(view) {
	this.view = view;
	if (begun) { // loadview is late
		loadPage(); // manually :P
	}
}

function beginHome() { // TODO ...handle code ....sorry my work is disorganized ...i mean, sorry for you
}

// start login page
function beginRegister() {
	// load stuff
	$('#main_view').html("\
            <div class=\"center2 content col-md-5\">\
            	<img class=\"login_logo\" style=\"cursor: pointer;\" src=\"images/logo.png\" onclick=\"window.location = '/'\">\
                <div class=\"w-100\" style=\"display: flex; flex-direction: column; justify-content: center; align-items: center;\">\
                    <span class=\"text-center lost\" style=\"text-align: center; font-family: avenir; padding-bottom: 0.5rem; \
                    padding-top: 0.5rem; color: #fff; font-size: 1.8rem;\">Sign up with us</span>\
                </div>\
                <div class=\"container\" style=\"display: flex; flex-direction: column\">\
                <form id=\"\" class=\"\">\
                    <div class=\"w-100\">\
                        <div class=\"w-100\">\
                            <input style=\"font-family: avenir; border-radius: 8px;\" id=\"et_name\" class=\"lost form-control text-left pl-4 pr-4 pt-2 pb-2 mt-3 h-25\" \
                            type=\"text\" maxlength=\"50\" required onkeypress=\"return isLetterKey(event)\" placeholder=\"Your name\">\
                            <input style=\"font-family: avenir; border-radius: 8px;\" id=\"et_email\" class=\"lost form-control text-left pl-4 pr-4 pt-2 pb-2 mt-3 h-25\" \
                            type=\"text\" required title=\"example@email.com\" pattern=\"[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$\" maxlength=\"150\"  placeholder=\"Your email address\">\
                            <input style=\"font-family: avenir; border-radius: 8px;\" id=\"et_co_name\" class=\"lost form-control text-left pl-4 pr-4 pt-2 pb-2 mt-3 h-25\" \
                            type=\"text\" required maxlength=\"150\" placeholder=\"Company name\">\
                            <input style=\"font-family: avenir; border-radius: 8px;\" id=\"et_pass\" class=\"lost form-control mt-3 mb-0 text-left pl-4 pr-4 pt-2 pb-2 h-25\" \
                            type=\"password\" placeholder=\"Your password\" pattern=\".{4,}\" required title=\"4 characters minimum\" maxlength=\"100\" required>\
                        </div>\
                    </div>\
                    <div style=\"font-family: avenir; text-align: left;\" class=\"p-3 lost\">\
	                    <input id=\"cb_terms\" type=\"checkbox\" value=\"Terms\">\
	   					<span class=\"text-white\"> I have read and accept the \
	                    <span class=\"text-white terms\"><strong>Terms of Service</strong></span><br>\
                    </div>\
                        <button id=\"btn_reg\" class=\"btn text-center w-100 lost\" style=\"font-family: avenir; padding-bottom: 0.5rem; padding-top: 0.5rem; font-weight: bold; \
                        color: #fff;  border-radius: 8px; background: #ff8300;\">Get started</button>\
                    <div class=\"pt-2 pb-2 text-center\">\
                    <hr  style=\"background: #fff\">\
                    </div>\
                    <div id=\"btn_login\" class=\"row pl-3 pr-3\">\
                        <span class=\"col-md-6 lost\" style=\"text-align: right; font-family: avenir; padding-bottom: 0.5rem; padding-top: 0.5rem; color: #fff;\">\
                        Already have an account?</span>\
                        <button class=\"btn col-md-6 lost\" style=\"font-family: avenir; padding-bottom: 0.5rem; padding-top: 0.5rem; font-weight: bold; color: #fff; \
                        border-radius: 8px; background: #ff8300;\">Log In</button>\
                    </div>\
                    <div class=\"w-100 mt-4 mb-4\" style=\"display: flex; flex-direction: column; justify-content: center; align-items: center;\">\
                        <span class=\"text-center lost\" style=\"text-align: center; font-family: avenir; padding-bottom: 0.5rem; padding-top: 0.5rem; color: #fff;\">\
                        Get your business on Instant Messaging today.</span>\
                    </div>\
                </form>\
                </div>\
            </div>");

	// onclick handlers
	$('#forg_pass').on('click', function () {
		console.log($('#cb_terms')[0].checked);
	});

	$('#btn_login').on('click', function (e) {
        e.preventDefault();
		$("body").fadeOut(270, redirectPage('/login'));
	});
}

// start login page
function beginForgot() {
	// load stuff
	$('#main_view').html("\
        <div class=\"center2 content col-md-5\">\
                <img class=\"login_logo\" style=\"cursor: pointer;\" src=\"images/logo.png\" onclick=\"sideBar(0);\">\
            <div class=\"w-100\" style=\"display: flex; flex-direction: column; justify-content: center; align-items: center;\">\
                <span class=\"text-center lost\" style=\"text-align: center; font-family: avenir; padding-bottom: 0.5rem; \
                padding-top: 0.5rem; color: #fff; font-size: 1.8rem;\">Reset password</span>\
            </div>\
            <div class=\"container\" style=\"display: flex; flex-direction: column\">\
            <form id=\"\" class=\"\">\
                <div class=\"w-100\">\
                    <div class=\"w-100\">\
                        <input style=\"font-family: avenir; border-radius: 8px;\" id=\"et_email\" class=\"lost form-control \
                        text-left pl-4 pr-4 pt-2 pb-2 mt-3 h-25\" type=\"text\" required pattern=\"[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$\" \
                        maxlength=\"150\" title=\"example@email.com\" placeholder=\"Your email address\">\
                    </div>\
                </div>\
                <div class=\"pt-2 pb-2 text-center\">\
                <hr  style=\"background: #fff\">\
                </div>\
                <div class=\"row pl-3 pr-3 text-center\">\
                    <span id=\"btn_back\" class=\"col-md-6 lost btn btn-link\" style=\"text-align: left; font-family: avenir; padding-bottom: 0.5rem; padding-top: 0.5rem; \
                    color: #fff; font-size: 1.1em;\">back</span>\
                    <button id=\"btn_reset\" class=\"btn col-md-6 lost\" style=\"font-family: avenir; padding-bottom: 0.5rem; padding-top: 0.5rem; \
                    font-weight: bold; color: #fff;  border-radius: 8px; background: #ff8300;\">Reset</button>\
                </div>\
                <div class=\"w-100 mt-4 mb-4\" style=\"display: flex; flex-direction: column; justify-content: center; align-items: center;\">\
                    <span class=\"text-center lost\" style=\"text-align: center; font-family: avenir; padding-bottom: 0.5rem; padding-top: 0.5rem; \
                    color: #fff;\">Get your business on Instant Messaging today.</span>\
                </div>\
            </form>\
            </div>\
        </div>"
    );

    $("#btn_back").click(function(event){
		$("body").css("display", "none");
    	beginLogin();
	    $("body").fadeIn(500);
    });

    $("a.trans").click(function(event){
        event.preventDefault();
        linkLocation = this.href;
		$("body").fadeOut(270, redirectPage(linkLocation));      
    });
}

function redirectPage(site) {
   window.location = site;
}

function isNumberKey(evt){
    var code = evt.charCode;
    return ((code >= 48 && code <= 57) || (code == 0));
}

function isLetterKey(evt){
    var code = evt.charCode;
    return ((code >= 65 && code <= 90) || (code >= 97 && code <= 122) || code == 0);
}

// route to page contents
function changePass() { window.location = '/dashboard/changePassword'; }
function support() { window.location = '/dashboard/support'; }
function logout() { window.location = '/logout'; }

function sideBar(index) { 
    switch(index) {
        case 0:
            window.location = '/dashboard/messaging';
            break;
        case 1:
            window.location = '/dashboard/scheduled';
            break;
        case 2:
            window.location = '/dashboard/bulk';
            break;
        case 3:
            window.location = '/dashboard/express';
            break;
        case 4:
            window.location = '/dashboard/api';
            break;
        case 5:
            window.location = '/dashboard/contacts';
            break;
        case 6:
            window.location = '/dashboard/billing';
            break;
        case 7:
            window.location = '/dashboard/config';
            break;
        default:
            window.location = window.location; // weird thing, just the refresh page
    }
}

    $(document).click(function() {
        $('#dialog-box').hide();

        // if(e.style.display == 'block')
        //    e.style.display = "none";
        
    });


function edit(ida, id1, idb, id2) {
    $(id1).hide();
    $(ida).show();
    $(id2).hide();
    $(idb).show();

    $('#btnClose').show();
    $('#btnSave').show();
    $('#btnEdit').hide();
    $('#btnDelete').hide();
}


function cancelEdit(ida, id1, idb, id2) {
    $(ida).hide();
    $(id1).show();
    $(idb).hide();
    $(id2).show();

    $('#btnClose').hide();
    $('#btnSave').hide();
    $('#btnEdit').show();
    $('#btnDelete').show();
}



function toggleMpesa() {
    $("#mpesa_pay").slideToggle(300);

}
