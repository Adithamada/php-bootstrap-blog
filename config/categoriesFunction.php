<?php
require_once 'db.php';

function createCategorySlug($category)
{
    $slug = strtolower(trim($category));
    $slug = preg_replace('/[^a-z0-9-]+/', '-', $slug);
    $slug = preg_replace('/-+/', '-', $slug);
    return rtrim($slug, '-');
}

function getAllCategories()
{
    global $conn;

    $result = $conn->query("SELECT * FROM categories ORDER BY created_at DESC");
    return $result->fetch_all(MYSQLI_ASSOC);
}

function createCategory($category, $userId)
{
    global $conn;

    $category = trim(mysqli_real_escape_string($conn, $category));

    $slug = createCategorySlug($category);

    $stmt = $conn->prepare("INSERT INTO categories (category_name, slug, user_id, created_at) VALUES (?,?,?, NOW())");
    $stmt->bind_param("ssi", $category, $slug, $userId);

    if ($stmt->execute()) {
        return [
            'status' => true,
            'success' => "Category created."
        ];
    } else {
        return [
            'status' => false,
            'error' => "Failed to make category"
        ];
    }
}

function updateCategory($id, $category, $status)
{
    global $conn;

    $category = trim(mysqli_real_escape_string($conn, $category));
    $slug = createCategorySlug($category);
    $stmt = $conn->prepare("UPDATE categories SET category_name = ?,slug=?, status = ? WHERE id = ?");
    $stmt->bind_param("sssi", $category, $slug, $status, $id);

    if ($stmt->execute()) {
        return [
            'status' => true,
            'success' => "Category updated."
        ];
    } else {
        return [
            'status' => false,
            'error' => "Failed to update category"
        ];
    }
}

function deleteCategory($id){
    global $conn;

    $stmt = $conn->prepare("DELETE FROM categories WHERE id=?");
    $stmt->bind_param("i",$id);

    if ($stmt->execute()) {
        return [
            'status' => true,
            'success' => "Category deleted."
        ];
    } else {
        return [
            'status' => false,
            'error' => "Failed to delete category"
        ];
    }
}
