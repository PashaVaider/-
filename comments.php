<?php
// Подключение к базе данных
$dsn = "mysql:host=localhost;dbname=your_database_name;charset=utf8";
$username = "your_username";
$password = "your_password";

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Ошибка подключения к базе данных: " . $e->getMessage();
}

// Если форма отправлена
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Защита от SQL-инъекций с использованием подготовленных выражений
    $username = trim($_POST['username']);
    $comment_text = trim($_POST['comment_text']);

    if (!empty($username) && !empty($comment_text)) {
        $stmt = $pdo->prepare("INSERT INTO comments (username, comment_text) VALUES (:username, :comment_text)");
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->bindParam(':comment_text', $comment_text, PDO::PARAM_STR);
        $stmt->execute();

        // Перенаправление на ту же страницу для предотвращения повторной отправки формы при обновлении страницы
        header("Location: comments.php");
        exit();
    }
}

// Получение всех комментариев
$stmt = $pdo->query("SELECT * FROM comments ORDER BY created_at DESC");
$comments = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Комментарии</title>
</head>
<body>
    <h1>Комментарии</h1>

    <!-- Список комментариев -->
    <ul>
        <?php if ($comments): ?>
            <?php foreach ($comments as $comment): ?>
                <li>
                    <strong><?php echo htmlspecialchars($comment['username']); ?></strong>: 
                    <?php echo htmlspecialchars($comment['comment_text']); ?>
                    <em>(<?php echo $comment['created_at']; ?>)</em>
                </li>
            <?php endforeach; ?>
        <?php else: ?>
            <li>Комментариев пока нет.</li>
        <?php endif; ?>
    </ul>

    <!-- Форма добавления комментария -->
    <h2>Добавить комментарий</h2>
    <form action="comments.php" method="POST">
        <label for="username">Имя:</label>
        <input type="text" id="username" name="username" required>
        <br>
        <label for="comment_text">Комментарий:</label>
        <textarea id="comment_text" name="comment_text" required></textarea>
        <br>
        <button type="submit">Отправить</button>
    </form>
</body>
</html>
