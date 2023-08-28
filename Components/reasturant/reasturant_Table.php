<?php
include '../../connection.php';
$dbConnection = new DatabaseConnection();
$dbConnection->connect();
$limit = 5;
$page = isset($_POST['page_no']) ? $_POST['page_no'] : 1;

$offset = ($page - 1) * $limit;
$user_id = $_SESSION['user_id'];

$data = $dbConnection->selectDataForResturant($limit, $offset,$user_id);
$table = "resturant";
$totalRecords = $dbConnection->getResturantCount($user_id);

$totalPages = ceil($totalRecords / $limit);


?>

<link rel="stylesheet" href="reastaurants.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<link rel="stylesheet" href="reasturant_Table.css">
<script>
  $(document).ready(function() {
    function loadTable2(pageno) {
      $.ajax({
        url: 'reasturant_Table.php',
        type: 'POST',
        data: {
          page_no: pageno
        },
        success: function(response) {
          $('#page-content').html(response);
        },
        error: function(xhr, status, error) {
          console.log(error);
        }
      });
    }


    $(document).on('click', '.pag2 a', function(e) {
      e.preventDefault();
      var pageno = $(this).attr('href');
      console.log(pageno);
      loadTable2(pageno);
    });
  });
</script>

</head>

<body>

<style>
  #result{
    position: absolute;
    left: 21%;
    color: blue;
  
}
</style>
  <div class="addnew">
    <button id="open-modal-btn" class="Addnewuser">Add New User</button>
    <span id="result"></span>

  </div>



  <div id="modal">
    <form id="restaurant-form" method="post">
      <span id="error" style="color:red"></span>
      <span class="close">&times;</span>
      <input type="hidden" id="restaurant_id" name="restaurant_id">
      <label for="restaurant-name">Restaurant Name:</label>
      <input type="text" id="restaurant-name" name="restaurant_name">

      <label for="location">Location:</label>
      <input type="text" id="location" name="location">

      <label for="contact-number">Contact Number:</label>
      <input type="text" id="contact-number" name="contact_number">

      <label for="availability">Availability:</label>
      <select id="availability" name="availability">
        <option value="">Select Availablity</option>
        <option value="0">Unavailable</option>
        <option value="1">Available</option>
      </select>

      <button type="submit">Submit</button>
    </form>
  </div>

  <!-- ... Your existing HTML code ... -->

  <div class="pag2">
    <?php for ($i = 1; $i <= $totalPages; $i++) {
      echo   "<a class='active' href='{$i}'>{$i}</a>";
    } ?>
  </div>
  <h3 class="h3sty">Restaurant List</h3>
  <div class="tablecontainer2">
    <table>

      <tr>
        <th>Id</th>
        <th>Restaurant name</th>
        <th class="locations">Location</th>
        <th>Contact number</th>
        <th>Owner name</th>
        <th>Availability</th>
        <th>Add time</th>
        <th>Action</th>
      </tr>
      <?php foreach ($data as $value) : ?>
        <tr id="tr-<?php echo $value['resturant_id']; ?>">
          <td><?php echo $value['resturant_id']; ?></td>
          <td><?php echo $value['restaurant_name']; ?></td>
          <td><?php echo $value['location']; ?></td>
          <td><?php echo $value['contact_number']; ?></td>
          <td><?php echo $value['name']; ?></td>
          <td><?php echo $value['availabilty']; ?></td>
          <td><?php echo $value['create_time']; ?></td>
          <td>
            <button id="<?php echo $value['resturant_id']; ?>" class="delete-button">Delete</button>
            <button id="up-<?php echo $value['resturant_id']; ?>" class="update-button">Update</button>
          </td>
        </tr>

      <?php endforeach; ?>
    </table>
  </div>
  <div>

  </div>
  <script src="reasturant_table.js"></script>

 