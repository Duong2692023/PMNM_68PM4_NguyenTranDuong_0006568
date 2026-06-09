<?php
session_start();

echo "<h2>DEBUG INFO</h2>";
echo "<p><strong>REQUEST_URI:</strong> " . $_SERVER['REQUEST_URI'] . "</p>";
echo "<p><strong>GET url:</strong> " . ($_GET['url'] ?? 'NOT SET') . "</p>";
echo "<p><strong>Session username:</strong> " . ($_SESSION['username'] ?? 'NOT SET') . "</p>";

$urlProcessed = [];
if (isset($_GET['url'])) {
    $urlProcessed = explode('/', filter_var(trim($_GET['url'], '/'), FILTER_SANITIZE_URL));
} else {
    $requestUri = $_SERVER['REQUEST_URI'];
    $requestUri = strtok($requestUri, '?');
    $requestUri = trim($requestUri, '/');
    if (!empty($requestUri)) {
        $urlProcessed = explode('/', filter_var($requestUri, FILTER_SANITIZE_URL));
    }
}

echo "<p><strong>URL Processed:</strong> " . print_r($urlProcessed, true) . "</p>";

if (isset($urlProcessed[0])) {
    $controllerName = ucfirst($urlProcessed[0]);
    echo "<p><strong>Controller Name:</strong> " . $controllerName . "</p>";
    
    $controllerFile = '../app/Controllers/' . $controllerName . '.php';
    echo "<p><strong>Controller File:</strong> " . $controllerFile . "</p>";
    echo "<p><strong>File exists:</strong> " . (file_exists($controllerFile) ? 'YES' : 'NO') . "</p>";
}
?>
