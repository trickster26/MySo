<?php include('/var/www/html/php/MySo/config/connection.php'); ?> 

<?php 

// echo "ANU";
// var_dump($conn);

class Models
{
    function __construct()
    {
    }

    function Model_SignUp($name, $email, $phone, $password)
    {
        try {
            global $conn;
            $query = "INSERT INTO `user`(`name`, `email`, `phone`, `password`) VALUES ('$name','$email','$phone','$password')";
            $execute = $conn->query($query);


            $result_query = "SELECT id FROM `user` WHERE `email` = '$email' ";
            $result_set = $conn->query($result_query);
            $row = $result_set->fetch_assoc();
            $id = $row['id'];

            $profile_query = "INSERT INTO `profile` (`first_name`,  `email`, `phone`,  `user_id`) 
                VALUES ('$name', '$email', '$phone', '$id')";
            $execute_profile =  $conn->query($profile_query);

            return $execute;
        } catch (Exception $e) {
            echo $e;
        }
    }

    function getUserByEmail($email) {
        // Connect to your database
        $db = new PDO('mysql:host=localhost;dbname=register01', 'phpmyadmin', 'root');

        // Prepare a SQL query to fetch the user by email
        $query = $db->prepare("SELECT * FROM users WHERE email = :email");
        $query->bindParam(':email', $email);
        $query->execute();

        // Fetch the user data
        $user = $query->fetch(PDO::FETCH_ASSOC);

        return $user;
    }

    function Check_Exists($email){
        $sql="SELECT id FROM user WHERE email='".$email."'";
        global $conn;
        $query=mysqli_query($conn,$sql);
        if(mysqli_num_rows($query)>0){
                return false;
        }else{
                return true;
        }
    }

    function assignUserRole($user_id, $role_id) {
        $query = "INSERT INTO user_role (user_id, role_id) VALUES (?, ?)";
        global $conn;    
    
        $stmt = $conn->prepare($query);

        if ($stmt === false) {
            return false; // Failed to prepare the statement
        }

        $stmt->bind_param("ii", $user_id, $role_id);

        if ($stmt->execute()) {
            $stmt->close();
            return true; // Role assigned successfully
        } else {
            $stmt->close();
            return false; // Failed to assign the role
        }
    }


    public function getUserIdByEmail($email) {
        $query = "SELECT id FROM user WHERE email = ?";
        global $conn;

        $stmt = $conn->prepare($query);

        if ($stmt === false) {
            return false; 
        }

        $stmt->bind_param("s", $email);

        if ($stmt->execute()) {
            $stmt->bind_result($user_id);

            if ($stmt->fetch()) {
                $stmt->close();
                return $user_id; 
            }
        }

        $stmt->close();
        return false; // User not found
    }

    // *Contact Us form data insertion*
    function Model_ContactUs($name, $email, $subject, $message)
    {
        try {
            global $conn;
            $query = "INSERT INTO `contact_us` (`name`,`email`,`subject`,`message`) VALUES ('$name','$email','$subject','$message')";
            echo "model";
            echo $query;
            return $conn->query($query);
        } catch (Exception $e) {
            echo $e;
        }
    }

    function Model_Login($email, $password)
    {
        try {
            global $conn;
            $query = "SELECT * FROM user WHERE email = '$email' and password = '$password' ";
            $result = mysqli_query($conn, $query);
            return $result;
        } catch (Exception $e) {
            echo $e;
        }
    }
    // *Edit Function*
    function Model_Edit($first_name, $last_name, $email, $phone, $dob, $gender, $nationality, $image, $monthly_income)
    {
        try {
            global $conn;
            $id = $_SESSION['id'];
            $query =    "UPDATE `profile`
                            SET `first_name` = '$first_name', `last_name` = '$last_name', `email` = '$email', `phone` = '$phone', `dob` = '$dob', `gender` = '$gender', `image`= '$image', `nationality` = '$nationality', `monthly_income` = '$monthly_income' 
                            WHERE `user_id` = '$id'";

            // *Storing Updated Data in Session*
            $_SESSION["login_user"] = $first_name;
            $_SESSION["email"] = $email;
            $_SESSION["phone"] = $phone;
            $_SESSION["gender"] = $gender;
            $_SESSION["nationality"] = $nationality;
            $_SESSION["income"] = $monthly_income;
            // *Setting the file name and extension if user uploads or update the profile image*
            if (!empty($_FILES['profile-Image']['tmp_name'])) {
                $_SESSION["image"] = $image;
                $_SESSION['extension'] = explode(".", $image)[1];
            }

            return $conn->query($query);
        } catch (Exception $e) {
            echo $e;
        }
    }
    // *Checking for the use in table*
    function Check($email)
    {
        global $conn;
        $query = "SELECT * FROM `profile` WHERE email = '$email' ";
        $result = mysqli_query($conn, $query);
        $arr = mysqli_fetch_array($result, MYSQLI_ASSOC);

        $count = 0;
        foreach ($arr as $key => $value) {
            if ($value !== null && $value !== '') {
                $count++;
            }
        }
        $id =$arr['user_id'];

        $queryy = "SELECT role_id FROM `user_role` WHERE user_id = '$id'";
        $resulte = mysqli_query($conn,$queryy);
        $arry = mysqli_fetch_assoc($resulte);
        $role=$arry['role_id'];
        $_SESSION['role'] = $role;

        // *Checking if the user completed its profile or not*
        if ($count < 10) {
            $_SESSION['login_user'] = $arr['first_name'];
            $_SESSION['email'] = $arr['email'];
            $_SESSION['phone'] = $arr['phone'];
            $_SESSION['id'] = $arr['user_id'];
            $_SESSION['status'] = $arr['status'];
        } else {
            $_SESSION['login_user'] = $arr['first_name'];
            $_SESSION['email'] = $arr['email'];
            $_SESSION['phone'] = $arr['phone'];
            $_SESSION['id'] = $arr['user_id'];
            $_SESSION['gender'] = $arr['gender'];
            $_SESSION['last_name'] = $arr['last_name'];
            $_SESSION['dob'] = $arr['dob'];
            $_SESSION['nationality'] = $arr['nationality'];
            $_SESSION['income'] = $arr['monthly_income'];
            $_SESSION['image'] = $arr['image'];
            $_SESSION['extension'] = explode(".", $arr["image"])[1];
            $_SESSION['status'] = $arr['status'];
        }

        return $count;
    }

    // *This function will handle only two parameter values one is id(F.K.) and other is value*
    // **Improved Version Comming Soon**
    function Insert($data, $table, $column)
    {
        global $conn;
        // *Getting the current user id*

        $id = $_SESSION['id'];

        $result = $conn->query("SELECT * FROM `$table` WHERE user_id = $id");
        if ($result->num_rows > 0 && $table !== 'address') {
            $chk = $conn->query("DELETE FROM `$table` WHERE user_id = $id");

            // creating column names for query
            $names = '';
            $columns = array();
            foreach ($column as $name) {
                $columns[] = "" . $name . "";
            }
            $names = implode(",", $columns);
          
            $sql = "INSERT INTO $table ($names) VALUES";
            // *Inserting Multiple Values in single arrays*
            $values = array();
            foreach ($data as $row) {

                $values[] = "('" . $conn->real_escape_string($row) . "', '" . $conn->real_escape_string($id) . "')";
            }
            // *Combining the values present into the array*
            $sql .= implode(",", $values);
            return $conn->query($sql);
        } elseif ($table === 'address') {
            try {
            global $conn;
            $query = "INSERT INTO `address` (`address_type`,`street_address`,`pin_code`,`country`,`state`,`city`, `user_id`) VALUES ('$data[0]','$data[1]','$data[2]','$data[3]','$data[4]','$data[5]','$id')";
            return $conn->query($query);
        } catch (Exception $e) {
            echo $e;
        }
        } else {
            // creating column names for query
            $names = "";
            $columns = array();
            foreach ($column as $name) {
                $columns[] = "" . $name . "";
            }

            $names .= implode(",", $columns);
          
            $sql = "INSERT INTO $table ($names) VALUES";
            // *Inserting Multiple Values in single arrays*
            $values = array();
            foreach ($data as $row) {
                $values[] = "('" . $conn->real_escape_string($row) . "', '" . $conn->real_escape_string($id) . "')";
            }
            // *Combining the values present into the array*
            $sql .= implode(",", $values);
    
           

            return $conn->query($sql);
        }
    }
    function insertProduct($data){
        if(is_array($data)){
            try{
                global $conn;
                $query = "INSERT INTO `product` (`product_name`,`product_price`,`categorie`,`quantity`,`weight`, `description`, `short_description`, `discount`, `brand`, `visibility`, `image`, `approved_by`, `user_id`) VALUES ('$data[0]','$data[1]','$data[2]','$data[3]','$data[4]','$data[5]','$data[6]','$data[7]','$data[8]','$data[9]','$data[10]','$data[11]','$data[13]')";
                echo $query;
                $status = $conn ->query($query);
                $image= $data[10];
                $select_query = "SELECT `id` FROM `product` WHERE `image` = '$image'";
                $result = mysqli_query($conn, $select_query);
                $arr = mysqli_fetch_array($result, MYSQLI_ASSOC);
                $_SESSION["product-id"] = $arr['id'];
                
                return $status;
            } catch (Exception $e) {
                echo $e;
            }
        }
    }

    function insertAltImages($data){
        try{
            global $conn;

            $id = $_SESSION["product-id"];
            
            $query = "INSERT INTO `product_images` (`image`,`product_id`) VALUES ('$data','$id')";
            return $conn ->query($query);
        } catch (Exception $e) {
            echo $e;
        }
    }
    function singleProduct($pid){
        try{
            global $conn;
            $query = "SELECT * FROM `product` WHERE id ='$pid';";
           
            $result = mysqli_query($conn, $query);
            $arr = mysqli_fetch_array($result, MYSQLI_ASSOC);
           
            // Create an empty array to store the results
            $img_arr = array();

            // Your SQL query with the product_id value replaced with the actual product_id
            $query = "SELECT * FROM `product_images` WHERE product_id = '$pid'";

            // Execute the query
            $result = $conn->query($query);

            // Check if the query was successful
            if ($result) {
                // Loop through the rows and fetch data into $img_arr
                while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                    $img_arr[] = $row;
                }

                // Free the result set
                mysqli_free_result($result);

            }
            $combinedArray = array(
                'productData' => $arr,
                'productImages' => $img_arr
            );
    
            return $combinedArray;
           
        }
        catch(Exception $E){
            echo $E;
        }
    }
        
}

?>