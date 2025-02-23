    <?php
    include_once "include/authentication.php";

    $sql = "SELECT * FROM `tbl_placement_applied` WHERE `status` = '$visible' && `student_id` = '" . $_SESSION['user']["admission_id"] . "'";
    $result = $con->query($sql);
    $row = $result->fetch_assoc();

    //  print_r($row);


    ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Placement Form</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f2f2f2;
                padding: 20px;
            }

            .receipt {
                background-color: #fff;
                border: 1px solid #ddd;
                padding: 20px;
                border-radius: 5px;
                max-width: 500px;
                margin: 0 auto;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }

            .border{
                border: 2px solid black;
                padding: 30px;
            }
            .receipt-header {
                /* text-align: center; */
                display: flex;
                margin-bottom: 20px;
                justify-content: space-between;
            }

            /* .receipt-header h2 {
                color: #333;
                margin-top: 6rem;
            } */
            .heading h2{
                color: #333;
                margin-top: 3rem;
               text-align: center;
            }

            .receipt-details {
                margin-bottom: 20px;
            }

            .receipt-details h3 {
                border-bottom: 1px solid #ddd;
                padding-bottom: 5px;
                margin-bottom: 10px;
                color: #333;
            }

            .detail-item {
                margin-bottom: 10px;
                display: flex;
                justify-content: space-between;
            }

            .detail-item span {
                color: #666;
            }

            .thank-you {
                text-align: center;
                margin-top: 20px;
                color: #666;
            }
        </style>
    </head>

    <body>

        <?php

        $sql_course = "SELECT * FROM `tbl_placement`
WHERE `company_name` ='" . $row["company_name"] . "' ";
        $result_course = $con->query($sql_course);
        $company_logo = $result_course->fetch_assoc();

        ?>


        <div class="receipt">
            <div class="border">
                <div class="receipt-header">
                    <img src="../uploads/logo1.png" alt="" style="width: 120px; height: 90px;">
                    
                    <?php
                    echo '<img src="../' . $company_logo['logo_data'] . '" alt="Image" style="width: 140px; height: 90px;" >';
                    ?>
                </div>
                <div class="heading">
                <h2>Placement Applied Details</h2>

                </div>
                <div class="receipt-details">
                    <h3>Form Details</h3>
                    <div class="detail-item">
                        <span>Status:</span>
                        <span><?php echo "Active"
                                ?></span>
                    </div>
                    <div class="detail-item">
                        <span>Name:</span>
                        <span><?php echo $row["std_name"]
                                ?></span>
                    </div>
                    <div class="detail-item">
                        <span>Name on Course:</span>
                        <span><?php echo $row["std_course"]
                                ?></span>
                    </div>
                    <div class="detail-item">
                        <span>Session:</span>
                        <span><?php echo $row["std_session"]
                                ?></span>
                    </div>
                    <!-- <div class="detail-item"> -->
                    <!-- <span>Amount:</span> -->
                    <span><?php //echo $result["data"]["amount"] 
                            ?></span>
                    <!-- </div> -->
                    <div class="detail-item">
                        <span>Applied Date:</span>
                        <span><?php echo $row["add_time"]
                                ?></span>
                    </div>
                    <div class="detail-item">
                        <span>Company Name:</span>
                        <span><?php echo $row["company_name"]
                                ?></span>
                    </div>
                    <div class="detail-item">
                        <span>Applied Post:</span>
                        <span><?php echo $row["job_type"]
                                ?></span>
                    </div>
                    <div class="detail-item">
                        <span>Apllied ID:</span>
                        <span><?php echo $row["id"]
                                ?></span>
                    </div>
                </div>
                <div class="thank-you">
                    <p>Thank you for applying placement drive</p>
                </div>
            </div>
        </div>

        <script>
            window.print();
        </script>

    </body>

    </html>