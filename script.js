jQuery(document).ready(function ($) {
  const { ajaxurl } = gc_script_params;

  const categoryEditIcon = $(".gc_edit_category_icon");
  const categoryDeleteIcon = $(".gc_delete_category_icon");
  const categoryInput = $("#gc_category_input");
  const oldCategoryInput = $("#gc_old_category_input");

  categoryEditIcon.click((e) => {
    const clickedCategoryName = e.target.getAttribute("data-category");
    categoryInput.focus();
    categoryInput.val(clickedCategoryName);
    oldCategoryInput.val(clickedCategoryName);
  });

  categoryDeleteIcon.click((e) => {
    const clickedCategoryName = e.target.getAttribute("data-category");
    console.log("clickedCategoryName", clickedCategoryName);
    $.post(
      ajaxurl,
      {
        action: "gc_delete_category",
        category: clickedCategoryName,
      },
      () => location.reload()
    );
  });
});
