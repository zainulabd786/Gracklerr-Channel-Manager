jQuery(document).ready(function ($) {
  var _URL = window.URL || window.webkitURL;
  const editProfileInput = $("#gc_edit_profile_input");
  const editProfileForm = $("#gc_edit_profile_form");
  const editBannerInput = $("#gc_edit_banner_input");
  const editBannerForm = $("#gc_edit_banner_form");

  editProfileInput.change(function () {
    var file, img;
    let validImage = false;
    if ((file = this.files[0])) {
      img = new Image();
      var objectUrl = _URL.createObjectURL(file);
      img.onload = function () {
        if (this.width !== 748 && this.height !== 758) {
          validImage = false;
          editProfileInput.val(null);
          alert("profile image should match 748x758 pixels");
        } else {
          validImage = true;
          editProfileForm.submit();
        }
      };
      img.src = objectUrl;
    }
  });

   editBannerInput.change(function () {
     var file, img;
     let validImage = false;
     if ((file = this.files[0])) {
       img = new Image();
       var objectUrl = _URL.createObjectURL(file);
       img.onload = function () {
       console.log("this.width", this.width);
       console.log("this.height", this.height);
         if (this.width !== 1024 && this.height !== 341) {
           validImage = false;
           editBannerInput.val(null);
           alert("profile image should match 1024x341 pixels");
         } else {
           validImage = true;
           editBannerForm.submit();
         }
       };
       img.src = objectUrl;
     }
   });

});
