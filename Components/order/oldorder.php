<?php 


include '../../connection.php';
$database = new DatabaseConnection();
$database->connect();
$table = "orders";
$id=$_SESSION['user_id'];
$data = $database->selectoldorder($table,$id);
$item = $database->selectolditem($id);
?>
<!DOCTYPE html>
<html>
<head>
  <title>Order History</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f2f2f2;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      border-radius: 8px;
      overflow: hidden;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
      margin: 20px auto;
      background-color: #ffffff;
    }

    th, td {
      padding: 12px 15px;
      text-align: left;
    }

    th {
      background-color: #2a75bb;
      color: #ffffff;
    }

    tr:nth-child(even) {
      background-color: #f2f2f2;
    }

    tr:hover {
      background-color: #e0e0e0;
      transition: background-color 0.2s ease-in-out;
    }

    caption {
      font-size: 1.5em;
      font-weight: bold;
      margin-bottom: 10px;
    }
    a img{
        height: 50px;
    }
    #cterall{
        
  display: flex;
  flex-direction: column;
  text-align: center;
  width: 90px;
    }
    a{
        text-decoration: none;
        color: black;
    }
  </style>
</head>
<body>
  <table>
    <caption>Order History</caption>
    <thead>
      <tr>
        <th>Order Id</th>
        <th>Price</th>
        <th>Payment method</th>
        <th>Create Time</th>
      </tr>
    </thead>
    <tbody>
<?php foreach ($data as $values ) :?>
<tr>
    <td id="cterall"><?php echo $values['order_id']?><a href="invoice.php?id=<?php echo $values['order_id']?>"><img src="./images.png" alt=""> details</a></td>
    <td><?php echo $values['grandtotalamont']?></td>
    <td><?php echo $values['payment_method']?></td>
    <td><?php echo $values['create_time']?></td>
</tr>
<?php endforeach ;?>
    </tbody>
  </table>
</body>
</html>
