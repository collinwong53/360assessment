<?php
include('mysql_connect.php');
$name = $email = $email_error = $phone = $comments = $success = '';
if($_POST){
    if(empty($_POST['email'])){
        echo "Email is required";
    }else{
        $email = $_POST['email'];
        if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
            echo "invalid email format";
        }else{
            $name = $_POST['name'];
            $email = $_POST['email'];
            if(!empty($_POST['phone'])){
                $phone = $_POST['phone'];
            }
            if(!empty($_POST['comments'])){
                $comments = $_POST['comments'];
            }
            $query = 
                "INSERT INTO 
                    client 
                SET 
                    name = ?, 
                    email = ?, 
                    phone = ?, 
                    comments = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param('ssss',$name,$email,$phone,$comments);
            $stmt->execute();
            if($conn->affected_rows>0){
                $success = 'success';
                include('email_reply.php');
            }else{
                $success = 'fail';
            }
        }
     } 
    }  
?>
<html>
<body>
<form method='post' action="<?php echo htmlspecialChars($_SERVER["PHP_SELF"]);?>">
    Name: <input type='text' name='name' required><br>
    Email: <input type='text' name='email' required><br>
    Phone: <input type='text' name='phone'><br>
    Comments:<br>
    <textarea name='comments' rows='10' cols='30'></textarea><br>
    <input type='checkbox' name='terms' required>I agree to the terms and conditions 
    <input type='submit'>
</form>
</body>
</html>