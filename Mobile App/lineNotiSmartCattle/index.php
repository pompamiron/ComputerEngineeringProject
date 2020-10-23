<html>

<?php require 'connectDatabase.php'; ?>

<head>

</head>

<body class="bg-dark">
  <div class="container">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header">ADD COW BEHAVIOR</div>
        <div class="card-body">
          <form action="behavior_save_db.php" method="post" autocomplete="off">
            <div class="form-group">
              <label for="cowID">Cow</label>
                <?php
                $strSQL = "SELECT cowID, name FROM `cow`";
                $result = $conn->query($strSQL);
                ?>
                <select required name="cowID" class="form-control">
                  <?php while($row = $result->fetch_assoc()) { ?> 
                    <option value = "<?php echo $row["cowID"];?>"><?php echo $row["name"];?></option>
                  <?php } ?>
                </select>
            </div>
            <div class="form-group">
              <label for="behavior">Behavior</label>
                <?php
                $strSQL = "SELECT DISTINCT  behavior FROM `behavior_data`";
                $result = $conn->query($strSQL);
                ?>
                <select required name="behavior" class="form-control">
                  <?php while($row = $result->fetch_assoc()) { ?> 
                    <option value = "<?php echo $row["behavior"];?>"><?php echo $row["behavior"];?></option>
                  <?php } ?>
                </select>
            </div>
            <div class="form-group"> 
              <button class="button button-block" name="save" />Save</button>
            </div>
          </form>
        </div>
    </div>
  </div>
</body>
</html>


