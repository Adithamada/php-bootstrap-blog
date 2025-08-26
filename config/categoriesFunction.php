<?php 
require_once 'db.php';

function createCategorySlug($category){
    $slug = strtolower(trim($category));
    $slug = preg_replace('/[^a-z0-9-]+/','-',$slug);
    $slug = preg_replace('/-+/','-',$slug);
    return rtrim($slug,'-');
}

function createCategory($category, $userId){
    global $conn;

    $category = trim(mysqli_real_escape_string($conn, $category));

    $slug = createCategorySlug($category);

    $stmt = $conn->prepare("INSERT INTO categories (category_name, slug, user_id, created_at) VALUES (?,?,?, NOW())");
    $stmt->bind_param("ssi",$category,$slug,$userId);

    if($stmt->execute()){
        return [
            'status'=>true,
            'success'=>"Category created."
        ];
    }else{
        return[
            'status'=>false,
            'error' => "Failed to make category"
        ];
    }
}

?>