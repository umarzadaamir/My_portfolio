<?php
include_once "db_connection.php";
try {
  $database = new Database();
  $db = $database->connect();
  $sql_countries = "SELECT * FROM country";
  $stmt_countries = $db->prepare($sql_countries);
  $stmt_countries->execute();
  $countries = $stmt_countries->fetchAll(PDO::FETCH_ASSOC);

  $sql_provinces = "SELECT * FROM province";
  $stmt_provinces = $db->prepare($sql_provinces);
  $stmt_provinces->execute();
  $provinces = $stmt_provinces->fetchAll(PDO::FETCH_ASSOC);

  $sql_districts = "SELECT * FROM district";
  $stmt_districts = $db->prepare($sql_districts);
  $stmt_districts->execute();
  $districts = $stmt_districts->fetchAll(PDO::FETCH_ASSOC);

  $sql_tehsil = "SELECT * FROM tehsil";
  $stmt_tehsil = $db->prepare($sql_tehsil);
  $stmt_tehsil->execute();
  $tehsil = $stmt_tehsil->fetchAll(PDO::FETCH_ASSOC);

  $sql = "SELECT id, department_name FROM department";
  $result = $db->query($sql);
  $departments = $result->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $error) {
  echo "<h2 style='color:red;'>Error: " . $error->getMessage() . "</h2>";
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login Form with Bootstrap Validation</title>
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
    rel="stylesheet" />
  <link rel="stylesheet" href="registor.css" />
</head>

<body>
  <div class="login-container">
    <h2 class="text-center mb-4">Registration</h2>
    <form action="post.php" class="needs-validation" novalidate method="post" enctype="multipart/form-data">
      <div class="row">
        <div class="col-md-6 mb-3">
          <label for="name" class="form-label">name</label>
          <div class="input-with-icon position-relative">
            <input
              type="text"
              class="form-control text-center"
              id="name"
              name="name"
              placeholder="Enter your name"
              required
              minlength="5"
              style="padding-left: 40px" />
            <img
              src="username.png"
              alt="User"
              style="
                  position: absolute;
                  left: 12px;
                  top: 50%;
                  margin-left: 5px;
                  transform: translateY(-50%);
                  width: 15px;
                  height: 15px;
                  pointer-events: none;
                " />
            <div class="invalid-feedback">Please provide a valid name.</div>
          </div>
        </div>
        <div class="col-md-6 mt-1">
          <label for="Father" class="">Father</label>
          <div class="input-with-icon position-relative">
            <input
              type="text"
              class="form-control text-center"
              id="Father"
              name="Father"
              placeholder="Father name"
              required
              minlength="5"
              style="padding-left: 40px" />
            <img
              src="father.png"
              alt="country"
              style="
                  position: absolute;
                  left: 12px;
                  top: 50%;
                  margin-left: 5px;
                  transform: translateY(-50%);
                  width: 15px;
                  height: 15px;
                  pointer-events: none;
                " />
            <div class="invalid-feedback">
              Please provide a valid country.
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6 mb-3">
          <label for="useraddres" class="form-label">address</label>
          <div class="input-with-icon position-relative">
            <input
              type="text"
              class="form-control text-center"
              id="useraddress"
              name="useraddress"
              placeholder="Enter your address "
              required
              minlength="5"
              style="padding-left: 40px" />
            <img
              src="address.png"
              alt="User"
              style="
                  position: absolute;
                  left: 12px;
                  top: 50%;
                  margin-left: 5px;
                  transform: translateY(-50%);
                  width: 15px;
                  height: 15px;
                  pointer-events: none;
                " />
            <div class="invalid-feedback">
              Please provide a valid address.
            </div>
          </div>
        </div>
        <div class="col-md-6 mb-3">
          <label for="phone" class="form-label">phone</label>
          <div class="input-with-icon position-relative">
            <input
              type="number"
              class="form-control text-center"
              pattern="\d*"
              maxlength="11"
              oninput="limitInput(this)"
              id="phone"
              name="phone"
              placeholder="Enter your phone"
              required
              minlength="6"
              style="padding-left: 40px" />
            <img
              src="phone.png"
              alt="phone"
              style="
                  position: absolute;
                  left: 12px;
                  top: 50%;
                  margin-left: 5px;
                  transform: translateY(-50%);
                  width: 15px;
                  height: 15px;
                  pointer-events: none;
                " />
            <div class="invalid-feedback">Please provide a valid phone.</div>
            <div class="valid-feedback">Looks good!</div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6 mb-3">
          <label for="country" class="">country</label>
          <div class="input-with-icon position-relative form-control">
            <select
              name="country"
              id="country"
              class="form-select border-0 bg-transparent shadow-none text-center">
              <option value="">Select Country</option>
              <hr />
              <?php foreach ($countries as $country): ?>
                <option value="<?= $country['country_id']; ?>">
                  <?= $country['country_name']; ?>
                </option>
              <?php endforeach; ?>
            </select>
            <img
              src="world.png"
              alt="country"
              style="
                  position: absolute;
                  left: 12px;
                  top: 50%;
                  margin-left: 5px;
                  transform: translateY(-50%);
                  width: 15px;
                  height: 15px;
                  pointer-events: none;
                " />
            <div class="invalid-feedback">
              Please provide a valid country.
            </div>
          </div>
        </div>
        <div class="col-md-6 mb-3">
          <label for="province" class="">province</label>
          <div class="input-with-icon position-relative form-control">
            <select name="province" id="province" class="form-select border-0 bg-transparent shadow-none text-center">
              <option value="">Select province</option>
              <?php foreach ($provinces as $province): ?>
                <option value="<?= $province['province_id']; ?>">
                  <?= $province['province_name']; ?>
                </option>
              <?php endforeach; ?>
            </select>
            <img
              src="city.png"
              alt="province"
              style="
                  position: absolute;
                  left: 12px;
                  top: 50%;
                  margin-left: 5px;
                  transform: translateY(-50%);
                  width: 15px;
                  height: 15px;
                  pointer-events: none;
                " />
            <div class="invalid-feedback">Please provide a valid province.</div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6 mb-3">
          <label for="district" class="">district</label>
          <div class="input-with-icon position-relative form-control">
            <select name="district" id="district" class="form-select border-0 bg-transparent shadow-none text-center">
              <option value="">Select district</option>
              <?php foreach ($districts as $district): ?>
                <option value="<?= $district['district_id']; ?>">
                  <?= $district['district_name']; ?>
                </option>
              <?php endforeach; ?>
            </select>
            <img
              src="city.png"
              alt="province"
              style="
                  position: absolute;
                  left: 12px;
                  top: 50%;
                  margin-left: 5px;
                  transform: translateY(-50%);
                  width: 15px;
                  height: 15px;
                  pointer-events: none;
                " />
            <div class="invalid-feedback">Please provide a valid district.</div>
          </div>
        </div>
        <div class="col-md-6">
          <label for="tehsil" class="">tehsil</label>
          <div class="input-with-icon position-relative form-control">
            <select name="tehsil" id="tehsil" class="form-select border-0 bg-transparent shadow-none text-center">
              <option value="">Select tehsil</option>
              <?php foreach ($tehsil as $tehsiles): ?>
                <option value="<?= $tehsiles['tehsil_id']; ?>">
                  <?= $tehsiles['tehsil_name']; ?>
                </option>
              <?php endforeach; ?>
            </select>
            <img
              src="city.png"
              alt="province"
              style="
                  position: absolute;
                  left: 12px;
                  top: 50%;
                  margin-left: 5px;
                  transform: translateY(-50%);
                  width: 15px;
                  height: 15px;
                  pointer-events: none;
                " />
            <div class="invalid-feedback">Please provide a valid tehsil.</div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6 mb-3">
          <label for="date" class="form-label">date of birth </label>
          <div class="input-with-icon position-relative">
            <input
              type="date"
              class="form-control text-center"
              id="date"
              name="date"
              placeholder="Enter your date of birth"
              required
              minlength="5"
              style="padding-left: 40px" />
            <img
              src="date.png"
              alt="date"
              style="
                  position: absolute;
                  left: 12px;
                  top: 50%;
                  margin-left: 5px;
                  transform: translateY(-50%);
                  width: 15px;
                  height: 15px;
                  pointer-events: none;
                " />
            <div class="invalid-feedback">Please provide a valid date.</div>
          </div>
        </div>
        <div class="col-md-6 mb-3">
          <label for="country" class="">department</label>
          <div class="input-with-icon position-relative form-control">
            <select
              name="department"
              id="department"
              class="form-select border-0 bg-transparent shadow-none text-center">
              <option value="">your department</option>
              <hr />
              <hr />
              <?php
              if (count($departments) > 0) {
                foreach ($departments as $row) {
                  echo '<option value="' . $row['id'] . '">' . $row['department_name'] . '</option>';
                }
              } else {
                echo '<option value="">No Departments Found</option>';
              }
              ?>
            </select>



            <img
              src="department.png"
              alt="department"
              style="
                  position: absolute;
                  left: 12px;
                  top: 50%;
                  margin-left: 5px;
                  transform: translateY(-50%);
                  width: 15px;
                  height: 15px;
                  pointer-events: none;
                " />
            <div class="invalid-feedback">
              Please provide a valid department.
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6 mb-3">
          <label for="cnic" class="form-label">cnic</label>
          <div class="input-with-icon position-relative">
            <input
              type="text"
              class="form-control text-center"
              id="cnic"
              name="cnic"
              placeholder="XXXXX-XXXXXXX-X"
              required
              minlength="15"
              maxlength="15"
              style="padding-left: 40px"
              oninput="formatCNIC(this)" />
            <img
              src="cnic.png"
              alt="cnic"
              style="
                  position: absolute;
                  left: 12px;
                  top: 50%;
                  margin-left: 5px;
                  transform: translateY(-50%);
                  width: 15px;
                  height: 15px;
                  pointer-events: none;
                " />
            <div class="invalid-feedback">Please provide a valid cnic.</div>
          </div>
        </div>
        <div class="col-md-6 mb-3">
          <label for="Email" class="form-label">Email</label>
          <div class="input-with-icon position-relative">
            <input
              type="Email"
              class="form-control text-center"
              id="Email"
              name="Email"
              placeholder="Enter your  email"
              required
              minlength="6"
              style="padding-left: 40px" />
            <img
              src="email.png"
              alt="Email"
              style="
                  position: absolute;
                  left: 12px;
                  top: 50%;
                  margin-left: 5px;
                  transform: translateY(-50%);
                  width: 15px;
                  height: 15px;
                  pointer-events: none;
                " />
            <span id="error" style="color:red;"></span>
            <div class="invalid-feedback">Please provide a valid email.</div>
          </div>
        </div>
      </div>
      <div class="login">
        <div class="row">
          <div class="col-md-6 mb-3">
            <label for="password" class="form-label">password</label>
            <div class="input-with-icon position-relative">
              <input
                type="password"
                class="form-control text-center"
                id="password"
                name="password"
                placeholder="Enter your password  "
                required
                minlength="5"
                style="padding-left: 40px" />
              <img
                src="password.png"
                alt="User"
                style="
                    position: absolute;
                    left: 12px;
                    top: 50%;
                    margin-left: 5px;
                    transform: translateY(-50%);
                    width: 15px;
                    height: 15px;
                    pointer-events: none;
                  " />
              <div class="invalid-feedback">
                Please provide a valid password.
              </div>
            </div>
          </div>
          <div class="col-md-6 mb-3">
            <label for="Confirm_password" class="form-label">Confirm Password</label>
            <div class="input-with-icon position-relative">
              <input
                type="password"
                class="form-control text-center"
                id="Confirm_password"
                name="Confirm_password"
                placeholder=" Confirm Password"
                required
                minlength="6"
                style="padding-left: 40px" />

              <img
                src="password.png"
                alt="Password"
                style="
                    position: absolute;
                    left: 12px;
                    top: 50%;
                    margin-left: 5px;
                    transform: translateY(-50%);
                    width: 15px;
                    height: 15px;
                    pointer-events: none;
                  " />
              <div class="invalid-feedback">Confirm Password.</div>
            </div>
          </div>
          <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="rememberMe" />
            <label class="form-check-label" for="rememberMe">Remember me</label>
          </div>
          <button type="submit" name="post" class="btn btn-primary w-100">Register</button>
          <div class="text-center mt-3">
            <a href="../form\form.php" class="text-decoration-none">Go Back</a>
          </div>
    </form>
    <script src="registor.js"></script>
    <script>
      // for cnic
      function formatCNIC(input) {
        let value = input.value.replace(/[^0-9]/g, '');
        if (value.length > 5) value = value.slice(0, 5) + '-' + value.slice(5);
        if (value.length > 13) value = value.slice(0, 13) + '-' + value.slice(13);
        input.value = value;
      }
      // for phone
      function limitInput(input) {
        input.value = input.value.replace(/[^0-9]/g, '');
        if (input.value.length > 11) {
          input.value = input.value.slice(0, 11);
        }
      }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>

</body>

</html>