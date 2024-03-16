<?php
if (isset($_GET['action'])) {
    include('../../db/db.php');

    $action = $_GET['action'];

    if ($action === 'add') {
?>
        <form class="add-spot-container" id="add-spot-form">
            <div class="input-container">
                <input type="text" id="spot-name" class="form-control" name="spot_name" placeholder="." required>
                <label for="spot-name">Tourist spot</label>
            </div>
            <div class="input-container">
                <input type="text" id="location" class="form-control" name="location" placeholder="." required>
                <label for="location">Location</label>
            </div>
            <div class="input-container">
                <textarea id="description" class="form-control" name="description" placeholder="." required></textarea>
                <label for="description">Description</label>
            </div>
            <div class="input-container">
                <textarea id="amenities" class="form-control" name="amenities" placeholder="." required></textarea>
                <label for="amenities">Amenities</label>
            </div>
            <div class="input-container">
                <textarea name="map" id="map" class="form-control" placeholder="."></textarea>
                <label for="map">Map</label>
            </div>
            <div class="input-container">
                <textarea name="budget" id="budget" class="form-control" placeholder="."></textarea>
                <label for="budget">Budget</label>
            </div>
            <div class="input-container">
                <textarea name="entrance_fee" id="entrance_fee" class="form-control" placeholder="."></textarea>
                <label for="entrance_fee">Entrance Fee</label>
            </div>
            <div class="categories-container">
                <div class="select-container">
                    <select id="spot-type" name="spot_type" class="form-control">
                        <option value=""></option>
                        <option value="Hotel">Hotel</option>
                        <option value="Resort">Resort</option>
                        <option value="Lake">Lake</option>
                        <option value="Mall">Mall</option>
                        <option value="Farm">Farm</option>
                        <option value="Restaurant">Restaurant</option>
                    </select>
                    <label for="spot-type">Spot Type</label>
                </div>
            </div>
            <div class="upload-container">
                <div class="upload-container-input-container">
                    <input type="file" id="spot-photo" name="spot_photo" accept="image/jpeg, image/png">
                    <label for="spot-photo">Upload a photo (JPG, PNG)</label>
                </div>
                <div class="upload-container-input-container">
                    <input type="file" id="business-permit" name="business_permit" accept="application/pdf">
                    <label for="business-permit">Upload Business permit (PDF)</label>
                </div>
            </div>
            <div class="submit-container">
                <input type="submit" id="submit-new-spot" name="submit_new_spot">
            </div>
        </form>
    <?php
    } else {
    ?>
        <table class="table">
            <thead>
                <tr>
                    <th>Tourist spot</th>
                    <th>Address</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>

                <?php
                $sql = "SELECT * FROM tourist_spot WHERE `STATUS` = 'active'";
                $sql_result = $conn->query($sql);
                if ($sql_result->num_rows > 0) {
                    while ($spot = $sql_result->fetch_assoc()) {
                ?>
                        <tr>
                            <td><?php echo $spot['SPOT_NAME'] ?></td>
                            <td><?php echo $spot['LOCATION'] ?></td>
                            <td><?php echo $spot['DESCRIPTION'] ?></td>
                            <td class="actions-td">
                                <a href="#" id="edit" class="btn btn-dark" data-spot_id="<?php echo $spot['SPOT_ID'] ?>"><i class="fa-regular fa-pen-to-square"></i></a>
                                <a href="#" id="delete" class="btn btn-danger" data-spot_id="<?php echo $spot['SPOT_ID'] ?>"><i class="fa-solid fa-trash"></i></a>
                            </td>
                        </tr>
                    <?php
                    }
                } else {
                    ?>
                    <tr>
                        <td colspan="4">
                            <center>No spot found.</center>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    <?php
    }
} else {
    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,500;0,600;0,900;1,200;1,500&family=Roboto+Condensed:wght@300;400&display=swap');
        </style>
        <title>Access Denied</title>
    </head>

    <body>
        <div class="access-denied-container">
            <h1>Access Denied</h1>
            <p>You are not authorize to access this page.</p>
        </div>
    </body>

    </html>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'poppins', sans-serif;
        }

        .access-denied-container {
            display: flex;
            flex-direction: column;
            align-items: center;

            position: absolute;
            top: 40%;
        }

        .access-denied-container h1 {
            font-weight: 500;
            font-size: 43px;
            margin: 0;
            color: red;
        }

        .access-denied-container p {
            font-size: 15px;
            margin: 0;
        }
    </style>
<?php
}
