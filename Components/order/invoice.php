<?php

include '../../connection.php';
$db = new DatabaseConnection();
$conenect = $db->connect();
$orderid = $_GET['id'];
$data = $db->selectdataforinvoic($orderid);

foreach ($data as $value) {
}

?>
<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <title></title>
  <link rel="stylesheet" href="orderinvoice.css">

</head>

<body>
  <button id="generate-pdf-button">Generate PDF</button>
  <div id="invoxie">
    <span class="preheader">This is an invoice for your purchase on {{ purchase_date }}. Please submit payment by {{ due_date }}</span>
    <table class="email-wrapper" width="100%" cellpadding="0" cellspacing="0" role="presentation">
      <tr>
        <td align="center">
          <table class="email-content" width="100%" cellpadding="0" cellspacing="0" role="presentation">
            <tr>
              <td class="email-masthead">
                <a href="https://example.com" class="f-fallback email-masthead_name">
                  <img src="../../images/redfood.png" alt="" height="50px">
                </a>
              </td>
            </tr>
            <tr>
              <td class="email-body" width="100%" cellpadding="0" cellspacing="0">
                <table class="email-body_inner" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation">
                  <tr>
                    <td class="content-cell">
                      <div class="f-fallback">
                        <div id="addresname">
                          <p> MR .<?php echo $value['username'] ?></p>
                          <p> Email :<?php echo $value['email'] ?></p>
                        </div>
                        <h1>Address</h1>
                        <?php $em = $value['address'];
                        $addres = explode(',', $em);
                        ?>
                        <div id="address">
                          <p><?php echo $addres[0] ?></p>
                          <p><?php echo $addres[1] ?>,</p>
                          <div id="cemtea">
                            <p><?php echo $addres[4] ?>,</p>
                            <p><?php echo $addres[2] ?>,</p>
                          </div>
                          <p><?php echo $addres[3] ?></p>
                        </div>
                        <p>This is an invoice for your recent purchase.</p>
                        <table class="attributes" width="100%" cellpadding="0" cellspacing="0" role="presentation">
                          <tr>
                            <td class="attributes_content">
                              <table width="100%" cellpadding="0" cellspacing="0" role="presentation">
                                <tr>
                                  <td class="attributes_item">
                                    <span class="f-fallback">
                                      <strong>Payment Method:</strong> <?php echo $value['payment_method'] ?>
                                    </span>
                                  </td>
                                </tr>
                                <tr>
                                  <td class="attributes_item">
                                    <span class="f-fallback">
                                      <strong>Order ID:</strong> <?php echo $value['order_id'] ?>
                                    </span>
                                  </td>
                                </tr>
                              </table>
                            </td>
                          </tr>
                        </table>


                        <table id="productdetail">
                          <tr>
                            <th>Reaturant Name</th>
                            <th width="19%">Item Name</th>
                            <th>Item per price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                          </tr>
                          <?php foreach ($data as $value) : ?>
                            <tr>
                              <td><?php echo $value['restaurant_name'] ?></td>
                              <td><?php echo $value['item_name'] ?></td>
                              <td><?php echo $value['price'] ?></td>
                              <td><?php echo $value['quantity'] ?></td>
                              <td><?php echo $value['quantity'] * $value['price'] ?></td>

                            </tr>
                          <?php endforeach; ?>
                          <tbody>
                            <tr>
                              <th colspan="2">Shipping</th>
                              <td colspan="3"><?php echo $value['shpping'] ?></td>
                            </tr>
                            <tr>
                              <th colspan="2">Gst</th>
                              <td colspan="3"><?php echo $value['tax'] ?></td>
                            </tr>
                            <tr>
                              <th colspan="2">Grandtotal</th>
                              <td colspan="3"><?php echo $value['grandtotalamont'] ?></td>
                            </tr>
                          </tbody>
                        </table>
                        <p>If you have any questions about this invoice, simply reply to this email or reach out to our <a href="{{support_url}}">support team</a> for help.</p>
                        <p>Cheers,
                          <br>The Red Food Team
                        </p>

                      </div>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>

          </table>
        </td>
      </tr>
    </table>
  </div>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.5.0-beta4/html2canvas.min.js"></script>
<script>
  function generatePDF() {
    const element = document.getElementById('invoxie'); // Replace 'your-html-content-id' with the ID of the element containing your HTML content
    const filename = 'generated_pdf.pdf';

    html2canvas(element).then(canvas => {
      const pdf = new jspdf.jsPDF('p', 'mm', 'a4'); // Use 'jspdf.jsPDF' instead of 'jsPDF'
      const imgData = canvas.toDataURL('bACKGOROND.jpg', 1.0);
      const pdfWidth = pdf.internal.pageSize.getWidth();
      const pdfHeight = (canvas.height * pdfWidth) / canvas.width;

      pdf.addImage(imgData, 'JPEG', 0, 0, pdfWidth, pdfHeight);
      pdf.save(filename);
    });
  }

  document.getElementById('generate-pdf-button').addEventListener('click', generatePDF);
</script>

</html>