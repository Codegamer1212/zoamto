<!DOCTYPE html>
<html>
<head>
</head>
<body>
  <!-- Your HTML content goes here -->
  <div id="your-html-content-id">
    <h1>Hello, this is a sample content.</h1>
    <p>This is a paragraph in the content.</p>
  </div>
  
  <button id="generate-pdf-button">Generate PDF</button>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.5.0-beta4/html2canvas.min.js"></script>
  <script>
    function generatePDF() {
      const element = document.getElementById('your-html-content-id'); // Replace 'your-html-content-id' with the ID of the element containing your HTML content
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
</body>
</html>
