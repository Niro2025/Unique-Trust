<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Message Reply</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/dbstyle.css">

</head>
<body>
    <div class="container">

        <h1>Reply to Message</h1>

        <h3>Admin Name:</h3>

        <div class="reply-form">
            <div class="form-table">
                <table class="table">
                    <thead>
                        <tr>
                                <th>Message ID</th>
                                <th>Customer Name</th>
                                <th>Email</th>
                                <th>Message</th>
                                <th>Date and Time</th>
                                <th>Category</th>  
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            require_once 'includes/db.php';


                            $query = $db->prepare("SELECT * FROM messages WHERE message_id = ?");
                            $query->bind_param("i", $_GET['message_id']);
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
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="form-data">
                    <form action="includes/reply.php" method="POST">
                        <input type="hidden" name="message_id" id="message_id">
                        <div>
                            <label for="reply_message" class="form-label">Reply Message</label>
                            <textarea class="form-control" id="reply_message" name="reply_message" rows="3" required></textarea>
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Send</button>
                        <button type="submit" class="btn btn-danger">Delete</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                        <button type="submit" class="btn btn-primary">Add</button>
                        <button type="submit" class="btn btn-primary">Rename</button>
                        
                    </form>
                </div>
            </div>
</body>
</html>