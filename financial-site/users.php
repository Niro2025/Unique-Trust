<?php


require_once 'includes/db.php';

// Add User

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['useradd'])) {

  // Registation Form Validation

  if (!isset($_POST['username'], $_POST['password'], $_POST['email'])) {

    $register_error = 'Please complete the registation form!';
  } else if (empty($_POST['username']) || empty($_POST['password']) || empty($_POST['email'])) {

    $register_error = 'Please complete the registation form!';
  }

  // Registation feilds Validation
  else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    $register_error = 'Email is not valid';
  } else if (preg_match('/^[a-zA-Z0-9]+$/', $_POST['username']) == 0) {
    $register_error = 'Username is not valid';
  } else if (strlen($_POST['password']) < 4) {
    $register_error = 'Password must be long, at least 4 Characters';
  } else if (empty($_POST['role'])) {
    $register_error = 'Role must be selected';
  } else {
    // Check username exists

    if ($query = $db->prepare('SELECT username FROM signup WHERE username = ?')) {

      $query->bind_param('s', $_POST['username']);
      $query->execute();
      $query->store_result();

      if ($query->num_rows > 0) {
        $register_error = 'Username exists, please choose another!';
      } else {

        $password = $_POST['password'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $role = $_POST['role'];



        if ($query = $db->prepare('INSERT INTO signup (username, email, password, user_level) VALUES (?, ?, ?, ?)')) {
          $query->bind_param('ssss', $username, $email, $password, $role);
          $query->execute();

          $success_message = "Registration Successful";
          // header("Location: login.php");
        } else {
          $register_error = "Error in entering data";
        }
      }
      $query->close();
    } else {

      $register_error = "Error in entering data"; // Prob with entering feild datas
    }
  }
}


// Update Users


if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['userupdate'])) {
  if (isset($_POST['user-id'], $_POST['username'], $_POST['email'], $_POST['password'], $_POST['role'])) {

    if (empty($_POST['username']) || empty($_POST['password']) || empty($_POST['email'])) {

      $register_error = 'Please complete the registation form!';
    } else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
      $register_error = 'Email is not valid';
    } else if (preg_match('/^[a-zA-Z0-9]+$/', $_POST['username']) == 0) {
      $register_error = 'Username is not valid';
    } else if (strlen($_POST['password']) < 4) {
      $register_error = 'Password must be long, at least 4 Characters';
    } else if (empty($_POST['role'])) {
      $register_error = 'Role must be selected';
    } else {


      echo $_POST['user-id'] . " - " . $_POST['username'] . " - " . $_POST['email'] . " - " . $_POST['password'] . " - " . $_POST['role'];

      $userid = $_POST['user-id'];
      $username = $_POST['username'];
      $email = $_POST['email'];
      $password = $_POST['password'];
      $role = $_POST['role'];

      if ($query = $db->prepare("UPDATE signup SET username = ?, email = ?, password = ?, user_level = ? WHERE id = ?")) {
        $query->bind_param('ssssi', $username, $email, $password, $role, $userid);
        $query->execute();

        if ($query->affected_rows > 0) {
          $success_message = "User updated successfully.";
        } else {
          $register_error = "No changes made or user not found.";
        }
        $query->close();
      } else {
        $register_error = "Error in updating data.";
      }
    }
  } else {
    $register_error = "All fields are required for update.";
  }
}

// Delete Users

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['userdelete'])) {
  if (isset($_POST['user-id'])) {
    $userid = $_POST['user-id'];

    if ($query = $db->prepare("DELETE FROM signup WHERE id = ?")) {
      $query->bind_param('i', $userid);
      $query->execute();

      if ($query->affected_rows > 0) {
        $success_message = "User deleted successfully.";
      } else {
        $register_error = "User not found.";
      }
      $query->close();
    } else {
      $register_error = "Error in deleting data.";
    }
  } else {
    $register_error = "User ID is required for deletion.";
  }
}



?>




<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/users.css">

  <script src="https://cdn.jsdelivr.net/npm/@linways/table-to-excel@1.0.4/dist/tableToExcel.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/3.0.3/jspdf.umd.min.js"
    integrity="sha512-+EeCylkt9WHJk5tGJxYdecHOcXFRME7qnbsfeMsdQL6NUPYm2+uGFmyleEqsmVoap/f3dN/sc3BX9t9kHXkHHg=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/5.0.2/jspdf.plugin.autotable.min.js"
    integrity="sha512-JizZOUNesiGhMcp9fsA/9W31FOat6QysBM8hSj6ir8iIANIUJ2mhko7Lo1+j0ErftmJ8SebMZLm9iielKjeIEQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  <title>Users</title>
</head>

<body>

  <header>
    <div class="container nav-container">
      <div class="logo">
        <img src="assets/img/logo.png" alt="Unique Trust Investment Logo" style="height:100px;">
        <span class="company-name">Unique Trust Investment</span>
      </div>

      <div class="header-container">
        <h1>Users</h1>
      </div>

      <div class="user-container">
        <div class="user-info">
          <span class="user-name">Admin</span>
          <span class="user-role">Administrator</span>

        </div>
        <div class="user-actions">
          <button class="btn button">Logout</button>
        </div>
      </div>

      <nav>
        <ul class="nav-links">
          <li><a href="index.php">Home</a></li>
          <li><a href="users.php">Users</a></li>

        </ul>
        <div class="hamburger" id="hamburger-menu">
          <span></span><span></span><span></span>
        </div>
      </nav>
    </div>
  </header>



  </div>
  <div class="container">
    <div class="form-box active" id="user-form">
      <form action="users.php" method="post">

        <?php if (!empty($register_error)): ?>
          <div class="error-message">
            <span>Registation Fails!</span></br>
            <?php echo $register_error; ?>
          </div>
        <?php endif; ?>
        <?php if (!empty($success_message)): ?>
          <div class="success-message">
            <?php echo $success_message; ?>
          </div>
        <?php endif; ?>

        <div class="fields">
          <div class="field">
            <label for="userid">User ID</label>
            <input type="number" id="userid" disabled>
            <input type="hidden" name="user-id" id="user-id">
          </div>

          <div class="field">
            <label for="username">User Name</label>
            <input type="text" name="username" id="username" placeholder="Username" required>
          </div>

          <div class="field">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" placeholder="Email" required>
          </div>

          <div class="field">
            <label for="password">Password</label>
            <input type="text" name="password" id="password" placeholder="Password" required>
          </div>

          <div class="field">
            <label for="role">User Role</label>
            <select name="role" id="role">
              <option value="">- Select Role -</option>
              <option value="employee">Employee</option>
              <option value="executive">Executive</option>
              <option value="admin">Admin</option>
            </select>
          </div>
         
        </div>
        <div class="button-container">
          <div class="buttons">
            <button class="btn btn-primary" id="add-user" name="useradd" type="submit">Add User</button>

          </div>
          <button type='submit' id="update-user" name="userupdate" class='btn btn-primary' onclick='updateUser(this)'
            disabled>Update</button>
          <button type='submit' id="delete-user" name="userdelete" class='btn button' onclick='deleteUser(this)'
            disabled>Delete</button>
          <button type='submit' id="close-user" name="userclose" class='btn button' onclick='toggleButtons(true)'
            disabled>Close</button>

          <div>
            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">
              Delete Item
            </button>

            <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel"
              aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                      aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <p class="mb-0">Are you sure you want to delete this item? This action cannot be undone.</p>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="confirmDelete">Delete</button>
                  </div>
                </div>
              </div>
            </div>

          </div>
          <!-- <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                  <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                  <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <p class="mb-0">Are you sure you want to delete this item? This action cannot be undone.</p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                  <button type="submit" class="btn btn-danger" id="delete-user" name="userdelete" onclick='deleteUser(this)'>Delete</button>
                </div>
              </div>
            </div>
          </div> -->





        </div>
      </form>
    </div>
  </div>



  <div class="user-table">
    <table>
      <thead>
        <tr>
          <th>User ID</th>
          <th>User Name</th>
          <th>Email</th>
          <th>Password</th>
          <th>User Role</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody class="table-body">
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
          echo "<td><button type='submit' class='btn btn-primary' onclick='viewUser(this)'>Edit</button> </td>";
          echo "</tr>";
        }
        $query->close();
        $db->close();

        ?>
      </tbody>
    </table>
  </div>

  <script>
    function viewUser(button) {
      const row = button.closest('tr');
      const userId = row.cells[0].innerText;
      const username = row.cells[1].innerText;
      const email = row.cells[2].innerText;
      const password = row.cells[3].innerText;
      const role = row.cells[4].innerText;

      console.log(button);
      console.log(row);
      console.log(userId, username, email, password, role);




      rowHighlight(row);
      toggleButtons(true);

      document.getElementById('userid').value = userId;
      document.getElementById('user-id').value = userId;
      document.getElementById('username').value = username;
      document.getElementById('email').value = email;
      document.getElementById('password').value = password;
      document.getElementById('role').value = role;
      scrollToTop();

    }

    function rowHighlight(row) {

      const rows = document.querySelectorAll('tbody tr');
      rows.forEach(r => r.classList.remove('highlighted-row'));


      row.classList.add('highlighted-row');
    }

    function toggleButtons(enable) {
      document.getElementById('update-user').disabled = !enable;
      document.getElementById('delete-user').disabled = !enable;
      document.getElementById('close-user').disabled = !enable;
      document.getElementById('add-user').disabled = enable;
    }

    function scrollToTop() {
      document.body.scrollTop = 0;
      document.documentElement.scrollTop = 0;
    }
  </script>

</body>

</html>