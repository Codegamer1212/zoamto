// Function to open the modal
function openModal() {
    document.getElementById("modal").style.display = "block";
  }
  
  // Function to close the modal
  function closeModal() {
    document.getElementById("modal").style.display = "none";
  }
  $(document).ready(function() {

  $(".delete-button").click(function () {
    var menuid = $(this).attr("id");
    $.ajax({
      url: "menu_item_delete.php",
      type: "POST",
      data: {
        menuid: menuid,
      },
      success: function (response) {
        $("#tr-" + menuid).remove();
      },
      error: function (xhr, status, error) {
        console.log("Error deleting menu item:", error);
      },
    });
  });
 
  
});


  