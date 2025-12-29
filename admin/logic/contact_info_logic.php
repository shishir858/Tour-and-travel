<?php
// Contact Info CRUD Logic

function addContactInfo($conn, $data) {
    $address = $conn->real_escape_string($data['address']);
    $phone = $conn->real_escape_string($data['phone']);
    $email1 = $conn->real_escape_string($data['email1']);
    $email2 = $conn->real_escape_string($data['email2']);
    $facebook = $conn->real_escape_string($data['facebook']);
    $instagram = $conn->real_escape_string($data['instagram']);
    $pinterest = $conn->real_escape_string($data['pinterest']);
    $twitter = $conn->real_escape_string($data['twitter']);
    $whatsapp = $conn->real_escape_string($data['whatsapp']);
    $logo = $conn->real_escape_string($data['logo']);
    
    $sql = "INSERT INTO contact_info (address, phone, email1, email2, facebook, instagram, pinterest, twitter, whatsapp, logo) 
            VALUES ('$address', '$phone', '$email1', '$email2', '$facebook', '$instagram', '$pinterest', '$twitter', '$whatsapp', '$logo')";
    return $conn->query($sql);
}

function updateContactInfo($conn, $id, $data) {
    $address = $conn->real_escape_string($data['address']);
    $phone = $conn->real_escape_string($data['phone']);
    $email1 = $conn->real_escape_string($data['email1']);
    $email2 = $conn->real_escape_string($data['email2']);
    $facebook = $conn->real_escape_string($data['facebook']);
    $instagram = $conn->real_escape_string($data['instagram']);
    $pinterest = $conn->real_escape_string($data['pinterest']);
    $twitter = $conn->real_escape_string($data['twitter']);
    $whatsapp = $conn->real_escape_string($data['whatsapp']);
    $logo = $conn->real_escape_string($data['logo']);
    
    $sql = "UPDATE contact_info SET address='$address', phone='$phone', email1='$email1', email2='$email2', 
            facebook='$facebook', instagram='$instagram', pinterest='$pinterest', twitter='$twitter', 
            whatsapp='$whatsapp', logo='$logo' WHERE id=$id";
    return $conn->query($sql);
}

function deleteContactInfo($conn, $id) {
    return $conn->query("DELETE FROM contact_info WHERE id = $id");
}

function getContactInfo($conn, $id) {
    $result = $conn->query("SELECT * FROM contact_info WHERE id = $id");
    return $result->fetch_assoc();
}

function getAllContactInfo($conn) {
    return $conn->query("SELECT * FROM contact_info ORDER BY id DESC");
}
?>
