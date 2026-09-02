<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Admin Control Panel - Accounts</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="admin styles.css" /> <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <!-- nav bar -->
    <div class="main-header text-center my-3">
    <h1>Men’s Day</h1>
  </div>
  <nav class="navbar navbar-expand-lg">
    <div class="container d-flex justify-content-between align-items-center">
      <!-- Left: Menu -->
      <div class="d-flex align-items-center gap-4">
        <a class="nav-link active" href="../Landing Page/Landing Page Men's Day.php">Home</a>
        <a class="nav-link " href="../About Us Page/About us.php">About</a>
        <a class="nav-link" href="../subTops/Tops Sub-Categories.php">Products</a>
      </div>

      <div class="d-flex align-items-center gap-4">
        <a href="#">
          <img src="https://cdn-icons-png.flaticon.com/512/54/54481.png" width="24" alt="Search" />
        </a>
        <a href="../Login Page/login.html">
          <img src="https://cdn-icons-png.flaticon.com/512/1077/1077063.png" width="24" alt="Profile" />
        </a>
        <a href="#" id="cartIcon">
          <img src="https://cdn-icons-png.flaticon.com/512/263/263142.png" width="24" alt="Cart" />
        </a>
      </div>
    </div>
  </nav>

  <div class="category-bar">
    <ul class="nav justify-content-center">
      <li class="nav-item">
        <a class="nav-link" href="../subTops/Tops Sub-Categories.php">Tops</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../subBottoms/Bottoms Sub-Categories.php">Bottoms</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../subOutwear/Outerwear Sub-Categories.php">Outerwear</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../subFootwear/Footwear Sub-Categories.php">Footwear</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../subAccessories/Accessories Sub-Categories.php">Accessories</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#discountModal">Discounts</a>
      </li>
    </ul>
  </div>

    <div class="admin-container">
        <h1>Admin Control Panel</h1>
        <h2>Account Management</h2>

        <div class="form-section">
            <h3>Add New Account</h3>
            <form id="addAccountForm">
                <div class="form-group">
                    <label for="addUsername">Username:</label>
                    <input type="text" class="form-control" id="addUsername" required>
                </div>
                <div class="form-group">
                    <label for="addEmail">Email:</label>
                    <input type="email" class="form-control" id="addEmail" required>
                </div>
                <div class="form-group">
                    <label for="addPassword">Password:</label>
                    <input type="password" class="form-control" id="addPassword" required>
                </div>
                <button type="submit" class="btn btn-primary">Add Account</button>
            </form>
        </div>

        <div>
            <h2>Existing Accounts</h2>
            <table class="account-table" id="accountsTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>testuser</td>
                        <td>test@example.com</td>
                        <td class="action-buttons">
                            <button class="btn btn-primary btn-sm">Edit</button>
                            <button class="btn btn-danger btn-sm">Delete</button>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>anotheruser</td>
                        <td>another@example.com</td>
                        <td class="action-buttons">
                            <button class="btn btn-primary btn-sm">Edit</button>
                            <button class="btn btn-danger btn-sm">Delete</button>
                        </td>
                    </tr>
                    </tbody>
            </table>
        </div>
    </div>

    <script src="code.js"></script>
</body>

</html>