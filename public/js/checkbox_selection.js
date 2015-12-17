/*This function is used to select all checkboxs*/

function checkbox_selection(slaver_checkbox, master_checkbox) {

  master_checkbox.onclick = function() {

    for (var cont = 0; cont < slaver_checkbox.length; cont++) {

      if (master_checkbox.checked == false) {
        slaver_checkbox[cont].checked = false;
      }

      if (master_checkbox.checked == true) {
        slaver_checkbox[cont].checked = true;
      }

    }
  }
}

window.onload = function() {
  var slaver_checkbox = document.querySelectorAll(".slaver_checkbox"),
      master_checkbox = document.querySelector(".master_checkbox");
      checkbox_selection(slaver_checkbox, master_checkbox);
}