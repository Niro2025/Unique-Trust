<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/dbstyle.css">

    <script src="https://cdn.jsdelivr.net/npm/@linways/table-to-excel@1.0.4/dist/tableToExcel.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/3.0.3/jspdf.umd.min.js" integrity="sha512-+EeCylkt9WHJk5tGJxYdecHOcXFRME7qnbsfeMsdQL6NUPYm2+uGFmyleEqsmVoap/f3dN/sc3BX9t9kHXkHHg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/5.0.2/jspdf.plugin.autotable.min.js" integrity="sha512-JizZOUNesiGhMcp9fsA/9W31FOat6QysBM8hSj6ir8iIANIUJ2mhko7Lo1+j0ErftmJ8SebMZLm9iielKjeIEQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</head>

<body>
    <div class="sidebar">
        <ul>
            <li><a href="#">Dashboard</a></li>
            <li><a href="#">Clients</a></li>
            <li><a href="#">Messages</a></li>
            <li><a href="#">Reports</a></li>
        </ul>
    </div>
    
    <div class="main">
        <button id="downloadexcel">Download Excel</button>
        <button id="downloadpdf">Download PDF</button>
        <div class="user-message">
            <div class="cards">
                <div class="card">
<table class="table">
    <thead>
        <tr>
            <th>Message ID</th>
            <th>Customer Name</th>
            <th>Email</th>
            <th>Message</th>
            <th>Date and Time</th>
            <th>Category</th>
            <th>Action</th>
            <th>Reply Message</th>
            <th>Replier</th>
            <th>Reply Date and Time</th>
        </tr>
    </thead>
    <tbody>
        <?php
        require_once 'includes/db.php';


        $query = $db ->prepare("SELECT * FROM messages");
        $query->execute();

        $result = $query->get_result();

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['message_id'] . "</td>";
            echo "<td>" . $row['customer_name'] . "</td>";
            echo "<td>" . $row['email'] . "</td>";
            echo "<td>" . $row['message'] . "</td>";
            echo "<td>" . $row['date'] . "</td>";
            echo "<td>" . $row['category'] . "</td>";
            echo "<td><button class='btn btn-primary'>Reply</button></td>";
            echo "<td>" . $row['reply_message'] . "</td>";
            echo "<td>" . $row['handler'] . "</td>";
            echo "<td>" . $row['reply_date'] . "</td>";
            echo "</tr>";
        }
        ?>
    </tbody>
</table>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    document.getElementById('downloadexcel').addEventListener('click', function() {
        let table = document.querySelector('table');
        TableToExcel.convert(table, {
            name: 'Messages.xlsx',
            sheet: {
                name: 'Sheet 1'
            }
        });
    });

    document.getElementById('downloadpdf').addEventListener('click', function() {
        const { jsPDF } = window.jspdf;
        var doc = new jsPDF();
        doc.autoTable({ html: 'table' });
        doc.save('Messages.pdf');
    }); </script>


</html>