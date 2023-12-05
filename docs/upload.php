<?php

print_r($_FILES);
$uploadDir =  __DIR__ . '/vendor/uploads/';

function generateNewFileName($originalFileName) {
    // Получение текущей даты и времени в формате YYYYMMDDhhnmmss
    $datePart = date('YmdHis');

    // Транслитерация символов с кириллицы на латиницу
    $transliteratedFileName = transliterate($originalFileName);

    // Замена пробелов на нижние подчеркивания
    $sanitizedFileName = preg_replace('/\s+/', '_', $transliteratedFileName);

    // Сборка нового имени файла
    $newFileName = $datePart . '_' . $sanitizedFileName;

    return $newFileName;
}

function transliterate($text) {
    $transliterationTable = array(
        'а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd',
        'е' => 'e', 'ё' => 'e', 'ж' => 'zh', 'з' => 'z', 'и' => 'i',
        'й' => 'y', 'к' => 'k', 'л' => 'l', 'м' => 'm', 'н' => 'n',
        'о' => 'o', 'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't',
        'у' => 'u', 'ф' => 'f', 'х' => 'h', 'ц' => 'c', 'ч' => 'ch',
        'ш' => 'sh', 'щ' => 'sch', 'ь' => '', 'ы' => 'y', 'ъ' => '',
        'э' => 'e', 'ю' => 'yu', 'я' => 'ya',
        'А' => 'A', 'Б' => 'B', 'В' => 'V', 'Г' => 'G', 'Д' => 'D',
        'Е' => 'E', 'Ё' => 'E', 'Ж' => 'Zh', 'З' => 'Z', 'И' => 'I',
        'Й' => 'Y', 'К' => 'K', 'Л' => 'L', 'М' => 'M', 'Н' => 'N',
        'О' => 'O', 'П' => 'P', 'Р' => 'R', 'С' => 'S', 'Т' => 'T',
        'У' => 'U', 'Ф' => 'F', 'Х' => 'H', 'Ц' => 'C', 'Ч' => 'Ch',
        'Ш' => 'Sh', 'Щ' => 'Sch', 'Ь' => '', 'Ы' => 'Y', 'Ъ' => '',
        'Э' => 'E', 'Ю' => 'Yu', 'Я' => 'Ya',
    );

    return strtr($text, $transliterationTable);
}

if (isset($_FILES)) {

  if ($_FILES['file1']) {
    $file = $_FILES['file1'];
  }
  if ($_FILES['file2']) {
    $file = $_FILES['file2'];
  }
  if ($_FILES['file3']) {
    $file = $_FILES['file3'];
  }
  if ($_FILES['file4']) {
    $file = $_FILES['file4'];
  }

  $fileName = basename($file['name']);
  $fileName = generateNewFileName($fileName);
  $uploadedFile = $uploadDir . $fileName ;

  echo $uploadedFile;

  $response = array();


  if (move_uploaded_file($file['tmp_name'], $uploadedFile)) {
    $response['success'] = true;
    $response['message'] = 'File has been uploaded successfully.';
  } else {
    $response['success'] = false;
    $response['message'] = 'Error uploading file.';
  }

  echo json_encode($response);


};



?>
