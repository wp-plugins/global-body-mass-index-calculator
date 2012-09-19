jQuery(document).ready(function($) {

//#############################Tab color####################################
   $('#tabColorSelector1').ColorPicker({
           color: $("[name='tabcolor']").val() ? $("[name='tabcolor']").val() : '#ccc',
           onShow: function (colpkr) {
                   $(colpkr).fadeIn(500);
                   return false;
           },
           onHide: function (colpkr) {
                   $(colpkr).fadeOut(500);
                   return false;
           },
           onChange: function (hsb, hex, rgb) {
               $('#tabColorSelector1 div').css('backgroundColor', '#' + hex);
               $("[name='tabcolor']").val('#' + hex);
               $('#bmitabDemo').css('backgroundColor', '#' + hex);
           }
   });
      $('#currtabColorSelector1').ColorPicker({
           color: $("[name='currtabcolor']").val() ? $("[name='currtabcolor']").val() : '#fff',
           onShow: function (colpkr) {
                   $(colpkr).fadeIn(500);
                   return false;
           },
           onHide: function (colpkr) {
                   $(colpkr).fadeOut(500);
                   return false;
           },
           onChange: function (hsb, hex, rgb) {
               $('#currtabColorSelector1 div').css('backgroundColor', '#' + hex);
               $("[name='currtabcolor']").val('#' + hex);
               $('#bmicurrtabDemo').css('backgroundColor', '#' + hex);
           }
   });
 
 //#############################Tab color####################################  

       $('#bgColorSelector1').ColorPicker({
           color: $("[name='bgcolor']").val() ? $("[name='bgcolor']").val() : '#3399CC',
           onShow: function (colpkr) {
                   $(colpkr).fadeIn(500);
                   return false;
           },
           onHide: function (colpkr) {
                   $(colpkr).fadeOut(500);
                   return false;
           },
           onChange: function (hsb, hex, rgb) {
               $('#bgColorSelector1 div').css('backgroundColor', '#' + hex);
               $("[name='bgcolor']").val('#' + hex);
               $('#bmiCalcDemo').attr('style', "color: " + $("[name='textcolor']").val() + "; border: 1px solid rgba(21, 11, 11, 0.199219); padding: 5px; width: 200px; -moz-border-radius: 12px; -webkit-border-radius: 12px; border-radius: 12px; -moz-box-shadow: 0px 0px 4px #ffffff; -webkit-box-shadow: 0px 0px 4px #ffffff; box-shadow: 0px 0px 4px #ffffff; background-color: <?php echo $data['bgcolor']; ?>; background-image: -moz-linear-gradient(top, " + $("[name='bgcolor']").val() + ", " + $("[name='bgendcolor']").val() + "); background-image: -webkit-gradient(linear,left top,left bottom,color-stop(0, " + $("[name='bgcolor']").val() + "),color-stop(1, " + $("[name='bgendcolor']").val() + ")); filter:  progid:DXImageTransform.Microsoft.gradient(startColorStr='" + $("[name='bgcolor']").val() + "', EndColorStr='" + $("[name='bgendcolor']").val() + "'); -ms-filter: \"progid:DXImageTransform.Microsoft.gradient(startColorStr='" + $("[name='bgcolor']").val() + "', EndColorStr='" + $("[name='bgendcolor']").val() + "')\"; text-shadow: 1px 1px 3px #888;")
           }
   });
   
   
   $('#bgEndColorSelector1').ColorPicker({
           color: $("[name='bgendcolor']").val() ? $("[name='bgendcolor']").val() : '#1C5992',
           onShow: function (colpkr) {
                   $(colpkr).fadeIn(500);
                   return false;
           },
           onHide: function (colpkr) {
                   $(colpkr).fadeOut(500);
                   return false;
           },
           onChange: function (hsb, hex, rgb) {
               $('#bgEndColorSelector1 div').css('backgroundColor', '#' + hex);
               $("[name='bgendcolor']").val('#' + hex);
               $('#bmiCalcDemo').attr('style', "color: " + $("[name='textcolor']").val() + "; border: 1px solid rgba(21, 11, 11, 0.199219); padding: 5px; width: 200px; -moz-border-radius: 12px; -webkit-border-radius: 12px; border-radius: 12px; -moz-box-shadow: 0px 0px 4px #ffffff; -webkit-box-shadow: 0px 0px 4px #ffffff; box-shadow: 0px 0px 4px #ffffff; background-color: <?php echo $data['bgcolor']; ?>; background-image: -moz-linear-gradient(top, " + $("[name='bgcolor']").val() + ", " + $("[name='bgendcolor']").val() + "); background-image: -webkit-gradient(linear,left top,left bottom,color-stop(0, " + $("[name='bgcolor']").val() + "),color-stop(1, " + $("[name='bgendcolor']").val() + ")); filter:  progid:DXImageTransform.Microsoft.gradient(startColorStr='" + $("[name='bgcolor']").val() + "', EndColorStr='" + $("[name='bgendcolor']").val() + "'); -ms-filter: \"progid:DXImageTransform.Microsoft.gradient(startColorStr='" + $("[name='bgcolor']").val() + "', EndColorStr='" + $("[name='bgendcolor']").val() + "')\"; text-shadow: 1px 1px 3px #888;")
           }
   });

   $('#textColorSelector1').ColorPicker({
      
           color: $("[name='textcolor']").val() ? $("[name='textcolor']").val() : '#0000ff',
           onShow: function (colpkr) {
             
                   $(colpkr).fadeIn(500);
                   return false;
           },
           onHide: function (colpkr) {
                   $(colpkr).fadeOut(500);
                   return false;
           },
           onChange: function (hsb, hex, rgb) {
                   $('#textColorSelector1 div').css('backgroundColor', '#' + hex);
                   $("[name='textcolor']").val('#' + hex);
               $('#bmiCalcDemo').attr('style', "color: " + $("[name='textcolor']").val() + "; border: 1px solid rgba(21, 11, 11, 0.199219); padding: 5px; width: 200px; -moz-border-radius: 12px; -webkit-border-radius: 12px; border-radius: 12px; -moz-box-shadow: 0px 0px 4px #ffffff; -webkit-box-shadow: 0px 0px 4px #ffffff; box-shadow: 0px 0px 4px #ffffff; background-color: <?php echo $data['bgcolor']; ?>; background-image: -moz-linear-gradient(top, " + $("[name='bgcolor']").val() + ", " + $("[name='bgendcolor']").val() + "); background-image: -webkit-gradient(linear,left top,left bottom,color-stop(0, " + $("[name='bgcolor']").val() + "),color-stop(1, " + $("[name='bgendcolor']").val() + ")); filter:  progid:DXImageTransform.Microsoft.gradient(startColorStr='" + $("[name='bgcolor']").val() + "', EndColorStr='" + $("[name='bgendcolor']").val() + "'); -ms-filter: \"progid:DXImageTransform.Microsoft.gradient(startColorStr='" + $("[name='bgcolor']").val() + "', EndColorStr='" + $("[name='bgendcolor']").val() + "')\"; text-shadow: 1px 1px 3px #888;")
           }
   });

   

       $('#wp_inactive_widgets #bgColorSelector').ColorPicker({
           color: $("[name='bgcolor']").val() ? $("[name='bgcolor']").val() : '#3399CC',
           onShow: function (colpkr) {
                   $(colpkr).fadeIn(500);
                   return false;
           },
           onHide: function (colpkr) {
                   $(colpkr).fadeOut(500);
                   return false;
           },
           onChange: function (hsb, hex, rgb) {
               $('#bgColorSelector div').css('backgroundColor', '#' + hex);
               $("[name='bgcolor']").val('#' + hex);
               $('#wp_inactive_widgets #bmiCalcDemo').attr('style', "color: " + $("[name='textcolor']").val() + "; border: 1px solid rgba(21, 11, 11, 0.199219); padding: 5px; width: 200px; -moz-border-radius: 12px; -webkit-border-radius: 12px; border-radius: 12px; -moz-box-shadow: 0px 0px 4px #ffffff; -webkit-box-shadow: 0px 0px 4px #ffffff; box-shadow: 0px 0px 4px #ffffff; background-color: <?php echo $data['bgcolor']; ?>; background-image: -moz-linear-gradient(top, " + $("[name='bgcolor']").val() + ", " + $("[name='bgendcolor']").val() + "); background-image: -webkit-gradient(linear,left top,left bottom,color-stop(0, " + $("[name='bgcolor']").val() + "),color-stop(1, " + $("[name='bgendcolor']").val() + ")); filter:  progid:DXImageTransform.Microsoft.gradient(startColorStr='" + $("[name='bgcolor']").val() + "', EndColorStr='" + $("[name='bgendcolor']").val() + "'); -ms-filter: \"progid:DXImageTransform.Microsoft.gradient(startColorStr='" + $("[name='bgcolor']").val() + "', EndColorStr='" + $("[name='bgendcolor']").val() + "')\"; text-shadow: 1px 1px 3px #888;")
           }
   });

   $('#wp_inactive_widgets #bgEndColorSelector').ColorPicker({
           color: $("[name='bgendcolor']").val() ? $("[name='bgendcolor']").val() : '#1C5992',
           onShow: function (colpkr) {
                   $(colpkr).fadeIn(500);
                   return false;
           },
           onHide: function (colpkr) {
                   $(colpkr).fadeOut(500);
                   return false;
           },
           onChange: function (hsb, hex, rgb) {
               $('#bgEndColorSelector div').css('backgroundColor', '#' + hex);
               $("[name='bgendcolor']").val('#' + hex);
               $('#wp_inactive_widgets #bmiCalcDemo').attr('style', "color: " + $("[name='textcolor']").val() + "; border: 1px solid rgba(21, 11, 11, 0.199219); padding: 5px; width: 200px; -moz-border-radius: 12px; -webkit-border-radius: 12px; border-radius: 12px; -moz-box-shadow: 0px 0px 4px #ffffff; -webkit-box-shadow: 0px 0px 4px #ffffff; box-shadow: 0px 0px 4px #ffffff; background-color: <?php echo $data['bgcolor']; ?>; background-image: -moz-linear-gradient(top, " + $("[name='bgcolor']").val() + ", " + $("[name='bgendcolor']").val() + "); background-image: -webkit-gradient(linear,left top,left bottom,color-stop(0, " + $("[name='bgcolor']").val() + "),color-stop(1, " + $("[name='bgendcolor']").val() + ")); filter:  progid:DXImageTransform.Microsoft.gradient(startColorStr='" + $("[name='bgcolor']").val() + "', EndColorStr='" + $("[name='bgendcolor']").val() + "'); -ms-filter: \"progid:DXImageTransform.Microsoft.gradient(startColorStr='" + $("[name='bgcolor']").val() + "', EndColorStr='" + $("[name='bgendcolor']").val() + "')\"; text-shadow: 1px 1px 3px #888;")
           }
   });

   $('#wp_inactive_widgets #textColorSelector').ColorPicker({
      
           color: $("[name='textcolor']").val() ? $("[name='textcolor']").val() : '#0000ff',
           onShow: function (colpkr) {
              
                   $(colpkr).fadeIn(500);
                   return false;
           },
           onHide: function (colpkr) {
                   $(colpkr).fadeOut(500);
                   return false;
           },
           onChange: function (hsb, hex, rgb) {
                   $('#textColorSelector div').css('backgroundColor', '#' + hex);
                   $("[name='textcolor']").val('#' + hex);
               $('#widgets-right #bmiCalcDemo').attr('style', "color: " + $("[name='textcolor']").val() + "; border: 1px solid rgba(21, 11, 11, 0.199219); padding: 5px; width: 200px; -moz-border-radius: 12px; -webkit-border-radius: 12px; border-radius: 12px; -moz-box-shadow: 0px 0px 4px #ffffff; -webkit-box-shadow: 0px 0px 4px #ffffff; box-shadow: 0px 0px 4px #ffffff; background-color: <?php echo $data['bgcolor']; ?>; background-image: -moz-linear-gradient(top, " + $("[name='bgcolor']").val() + ", " + $("[name='bgendcolor']").val() + "); background-image: -webkit-gradient(linear,left top,left bottom,color-stop(0, " + $("[name='bgcolor']").val() + "),color-stop(1, " + $("[name='bgendcolor']").val() + ")); filter:  progid:DXImageTransform.Microsoft.gradient(startColorStr='" + $("[name='bgcolor']").val() + "', EndColorStr='" + $("[name='bgendcolor']").val() + "'); -ms-filter: \"progid:DXImageTransform.Microsoft.gradient(startColorStr='" + $("[name='bgcolor']").val() + "', EndColorStr='" + $("[name='bgendcolor']").val() + "')\"; text-shadow: 1px 1px 3px #888;")
           }
   });

   $('#widgets-right #bgColorSelector').ColorPicker({
           color: $("[name='bgcolor']").val() ? $("[name='bgcolor']").val() : '#3399CC',
           onShow: function (colpkr) {
                   $(colpkr).fadeIn(500);
                   return false;
           },
           onHide: function (colpkr) {
                   $(colpkr).fadeOut(500);
                   return false;
           },
           onChange: function (hsb, hex, rgb) {
               $('#bgColorSelector div').css('backgroundColor', '#' + hex);
               $("[name='bgcolor']").val('#' + hex);
               $('#widgets-right #bmiCalcDemo').attr('style', "color: " + $("[name='textcolor']").val() + "; border: 1px solid rgba(21, 11, 11, 0.199219); padding: 5px; width: 200px; -moz-border-radius: 12px; -webkit-border-radius: 12px; border-radius: 12px; -moz-box-shadow: 0px 0px 4px #ffffff; -webkit-box-shadow: 0px 0px 4px #ffffff; box-shadow: 0px 0px 4px #ffffff; background-color: <?php echo $data['bgcolor']; ?>; background-image: -moz-linear-gradient(top, " + $("[name='bgcolor']").val() + ", " + $("[name='bgendcolor']").val() + "); background-image: -webkit-gradient(linear,left top,left bottom,color-stop(0, " + $("[name='bgcolor']").val() + "),color-stop(1, " + $("[name='bgendcolor']").val() + ")); filter:  progid:DXImageTransform.Microsoft.gradient(startColorStr='" + $("[name='bgcolor']").val() + "', EndColorStr='" + $("[name='bgendcolor']").val() + "'); -ms-filter: \"progid:DXImageTransform.Microsoft.gradient(startColorStr='" + $("[name='bgcolor']").val() + "', EndColorStr='" + $("[name='bgendcolor']").val() + "')\"; text-shadow: 1px 1px 3px #888;")
           }
   });

   $('#widgets-right #bgEndColorSelector').ColorPicker({
           color: $("[name='bgendcolor']").val() ? $("[name='bgendcolor']").val() : '#1C5992',
           onShow: function (colpkr) {
                   $(colpkr).fadeIn(500);
                   return false;
           },
           onHide: function (colpkr) {
                   $(colpkr).fadeOut(500);
                   return false;
           },
           onChange: function (hsb, hex, rgb) {
               $('#bgEndColorSelector div').css('backgroundColor', '#' + hex);
               $("[name='bgendcolor']").val('#' + hex);
               $('#widgets-right #bmiCalcDemo').attr('style', "color: " + $("[name='textcolor']").val() + "; border: 1px solid rgba(21, 11, 11, 0.199219); padding: 5px; width: 200px; -moz-border-radius: 12px; -webkit-border-radius: 12px; border-radius: 12px; -moz-box-shadow: 0px 0px 4px #ffffff; -webkit-box-shadow: 0px 0px 4px #ffffff; box-shadow: 0px 0px 4px #ffffff; background-color: <?php echo $data['bgcolor']; ?>; background-image: -moz-linear-gradient(top, " + $("[name='bgcolor']").val() + ", " + $("[name='bgendcolor']").val() + "); background-image: -webkit-gradient(linear,left top,left bottom,color-stop(0, " + $("[name='bgcolor']").val() + "),color-stop(1, " + $("[name='bgendcolor']").val() + ")); filter:  progid:DXImageTransform.Microsoft.gradient(startColorStr='" + $("[name='bgcolor']").val() + "', EndColorStr='" + $("[name='bgendcolor']").val() + "'); -ms-filter: \"progid:DXImageTransform.Microsoft.gradient(startColorStr='" + $("[name='bgcolor']").val() + "', EndColorStr='" + $("[name='bgendcolor']").val() + "')\"; text-shadow: 1px 1px 3px #888;")
           }
   });

   $('#widgets-right #textColorSelector').ColorPicker({
           color: $("[name='textcolor']").val() ? $("[name='textcolor']").val() : '#0000ff',
           onShow: function (colpkr) {
                   $(colpkr).fadeIn(500);
                   return false;
           },
           onHide: function (colpkr) {
                   $(colpkr).fadeOut(500);
                   return false;
           },
           onChange: function (hsb, hex, rgb) {
                   $('#textColorSelector div').css('backgroundColor', '#' + hex);
                   $("[name='textcolor']").val('#' + hex);
               $('#widgets-right #bmiCalcDemo').attr('style', "color: " + $("[name='textcolor']").val() + "; border: 1px solid rgba(21, 11, 11, 0.199219); padding: 5px; width: 200px; -moz-border-radius: 12px; -webkit-border-radius: 12px; border-radius: 12px; -moz-box-shadow: 0px 0px 4px #ffffff; -webkit-box-shadow: 0px 0px 4px #ffffff; box-shadow: 0px 0px 4px #ffffff; background-color: <?php echo $data['bgcolor']; ?>; background-image: -moz-linear-gradient(top, " + $("[name='bgcolor']").val() + ", " + $("[name='bgendcolor']").val() + "); background-image: -webkit-gradient(linear,left top,left bottom,color-stop(0, " + $("[name='bgcolor']").val() + "),color-stop(1, " + $("[name='bgendcolor']").val() + ")); filter:  progid:DXImageTransform.Microsoft.gradient(startColorStr='" + $("[name='bgcolor']").val() + "', EndColorStr='" + $("[name='bgendcolor']").val() + "'); -ms-filter: \"progid:DXImageTransform.Microsoft.gradient(startColorStr='" + $("[name='bgcolor']").val() + "', EndColorStr='" + $("[name='bgendcolor']").val() + "')\"; text-shadow: 1px 1px 3px #888;")
           }
   });

$("[name='textcolor']").ColorPicker({
	onSubmit: function(hsb, hex, rgb, el) {
		$(el).val(hex);
		$(el).ColorPickerHide();
	},
	onBeforeShow: function () {
		$(this).ColorPickerSetColor(this.value);
	}
})
.bind('keyup', function(){
	$(this).ColorPickerSetColor(this.value);
});
});