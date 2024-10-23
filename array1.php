$data = [
    ['Иванов', 'Математика', 5],
    ['Иванов', 'Математика', 4],
    ['Иванов', 'Математика', 5],
    ['Петров', 'Математика', 5],
    ['Сидоров', 'Физика', 4],
    ['Иванов', 'Физика', 4],
    ['Петров', 'ОБЖ', 4],
];

// массив для хранения сумм по предметам и ученикам
$scores = [];

// Проход по каждому элементу исходного массива и суммируем баллы
foreach ($data as $item) {
    $student = $item[0]; // Фамилия ученика
    $subject = $item[1]; // Название предмета
    $score = $item[2];   // Балл

    // Суммируем баллы по предметам для каждого ученика
    if (!isset($scores[$student][$subject])) {
        $scores[$student][$subject] = 0;
    }
    $scores[$student][$subject] += $score;
}

// Сортируем учеников по алфавиту
ksort($scores);

// Собираем уникальные предметы и сортируем их
$subjects = [];
foreach ($scores as $student => $subjects_scores) {
    foreach ($subjects_scores as $subject => $score) {
        $subjects[$subject] = true;
    }
}
ksort($subjects);

// Вывод таблицы
echo "<table border='1'>";
echo "<tr><th></th>";

// Заголовок с названиями предметов
foreach (array_keys($subjects) as $subject) {
    echo "<th>$subject</th>";
}
echo "</tr>";

// Выводим данные для каждого ученика
foreach ($scores as $student => $subjects_scores) {
    echo "<tr>";
    echo "<td>$student</td>";
    
    // Выводим баллы по каждому предмету
    foreach (array_keys($subjects) as $subject) {
        if (isset($subjects_scores[$subject])) {
            echo "<td>{$subjects_scores[$subject]}</td>";
        } else {
            echo "<td></td>";
        }
    }

    echo "</tr>";
}

echo "</table>";
