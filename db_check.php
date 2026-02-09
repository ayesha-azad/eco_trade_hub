<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h1>ECO Trade Hub - Environment Diagnostics</h1>";

// 1. Check MySQLi Extension
echo "<h3>1. PHP Extensions</h3>";
if (extension_loaded('mysqli')) {
    echo "✅ mysqli extension is loaded.<br>";
} else {
    echo "❌ mysqli extension is NOT loaded! InfinityFree requires this for your database connection.<br>";
}

// 2. Check Connection file
echo "<h3>2. Connection File</h3>";
$connect_path = __DIR__ . '/includes/connect.php';
if (file_exists($connect_path)) {
    echo "✅ includes/connect.php found.<br>";
    include($connect_path);
} else {
    echo "❌ includes/connect.php NOT found at: $connect_path<br>";
    exit();
}

// 3. Check Database Connection
echo "<h3>3. Database Connection</h3>";
if (isset($conn) && $conn instanceof mysqli) {
    if ($conn->connect_error) {
        echo "❌ Database connection failed: " . $conn->connect_error . "<br>";
    } else {
        echo "✅ Successfully connected to database: " . ($database ?? 'unknown') . "<br>";
        
        // 4. Check Tables
        echo "<h3>4. Required Tables</h3>";
        $required_tables = ['products', 'brands', 'categories', 'users', 'cart_details'];
        foreach ($required_tables as $table) {
            $check = mysqli_query($conn, "SHOW TABLES LIKE '$table'");
            if (mysqli_num_rows($check) > 0) {
                echo "✅ Table '$table' exists.<br>";
                
                // Check if table has data
                $count_res = mysqli_query($conn, "SELECT COUNT(*) as total FROM `$table`");
                $count_row = mysqli_fetch_assoc($count_res);
                echo "&nbsp;&nbsp;&nbsp;&nbsp;- Rows: " . $count_row['total'] . "<br>";
            } else {
                echo "❌ Table '$table' is MISSING!<br>";
            }
        }
    }
} else {
    echo "❌ \$conn variable is not defined or not a valid mysqli object. Check your connect.php variables.<br>";
}

echo "<h3>5. Path Information</h3>";
echo "Current File: " . __FILE__ . "<br>";
echo "Current Directory: " . __DIR__ . "<br>";
echo "Document Root: " . $_SERVER['DOCUMENT_ROOT'] . "<br>";

?>
