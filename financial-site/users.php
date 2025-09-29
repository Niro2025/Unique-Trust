<?php
require_once 'includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');
    $role = trim($_POST['role'] ?? '');

    if ($username && $email && $password && $role) {
        $stmt = $db->prepare("INSERT INTO signup (username, email, password, user_level) VALUES (?, ?, ?, ?)");
        $stmt->bind_param('ssss', $username, $email, $password, $role);
        $stmt->execute();
        $stmt->close();
    }
}
// header('Location:users.php');
exit();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/dbstyle.css">

    <script src="https://cdn.jsdelivr.net/npm/@linways/table-to-excel@1.0.4/dist/tableToExcel.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/3.0.3/jspdf.umd.min.js" integrity="sha512-+EeCylkt9WHJk5tGJxYdecHOcXFRME7qnbsfeMsdQL6NUPYm2+uGFmyleEqsmVoap/f3dN/sc3BX9t9kHXkHHg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/5.0.2/jspdf.plugin.autotable.min.js" integrity="sha512-JizZOUNesiGhMcp9fsA/9W31FOat6QysBM8hSj6ir8iIANIUJ2mhko7Lo1+j0ErftmJ8SebMZLm9iielKjeIEQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <title>Users</title>
</head>

<body>
    <div class="header">
        <h1>Users</h1>
        <a href="index.php" class="btn btn-primary">Home</a>
    </div>
    <div class="user-message">

        <div class="cards">
            <div class="card">
                <table class="table">
                    <thead>
                        <tr>
                            <th>User ID</th>
                            <th>User Name</th>
                            <th>Email</th>
                            <th>Password</th>
                            <th>User Role</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        require_once 'includes/db.php';


                        $query = $db->prepare("SELECT * FROM signup");
                        $query->execute();

                        $result = $query->get_result();

                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row['id'] . "</td>";
                            echo "<td>" . $row['username'] . "</td>";
                            echo "<td>" . $row['email'] . "</td>";
                            echo "<td>" . $row['password'] . "</td>";
                            echo "<td>" . $row['user_level'] . "</td>";
                            echo "</tr>";
                        }
                        $query->close();
                        $db->close();
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="form-data">
        <form action="includes/reply.php" method="POST">
            <input type="hidden" name="message_id" id="message_id">

            <button type="submit" class="btn btn-primary">Add</button>
            <button type="submit" class="btn btn-primary">Update</button>
            <button type="submit" class="btn btn-danger">Delete</button>
            <button type="submit" class="btn btn-primary">Rename</button>

        </form>
    </div>

    <div class="modal" id="addUserModal" tabindex="-1" style="display:none; position:fixed; top:0; left:0; width:100vw; height:100vh; background:rgba(0,0,0,0.4); z-index:9999; align-items:center; justify-content:center;">
        <div class="modal-dialog" style="max-width:400px; margin:auto;">
            <div class="modal-content" style="padding: 1.5rem;">
                <div class="modal-header" style="display:flex; justify-content:space-between; align-items:center;">
                    <h5 class="modal-title">Add User</h5>
                    <button type="button" id="closeAddUserModal" style="background:none; border:none; font-size:1.5rem;">&times;</button>
                </div>
                <form action="users.php" method="POST">
                    <div class="mb-3">
                        <label for="add_username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="add_username" name="username" required>
                    </div>
                    <div class="mb-3">
                        <label for="add_email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="add_email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="add_password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="add_password" name="password" required>
                    </div>
                    <div class="mb-3">
                        <label for="add_role" class="form-label">Role</label>
                        <select class="form-control" id="add_role" name="role" required>
                            <option value="">- Select Role -</option>
                            <option value="employee">Employee</option>
                            <option value="executive">Executive</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success">Add User</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Show modal
        document.getElementById('openAddUserModal').onclick = function() {
            document.getElementById('addUserModal').style.display = 'flex';
        };
        // Hide modal
        document.getElementById('closeAddUserModal').onclick = function() {
            document.getElementById('addUserModal').style.display = 'none';
        };
        // Hide modal when clicking outside the modal content
        window.onclick = function(event) {
            var modal = document.getElementById('addUserModal');
            if (event.target === modal) {
                modal.style.display = 'none';
            }
        };
    </script>



</body>

</html>