jQuery(document).ready(function ($) {
  var _URL = window.URL || window.webkitURL;
  const editProfileInput = $("#gc_edit_profile_input");
  const editProfileForm = $("#gc_edit_profile_form");
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
});
