## README (English)
# ImageConverter

`ImageConverter` is a PHP class designed to convert images in HTML code into an array of image URLs placed before the first image. This tool removes subsequent image tags, leaving only the first one.

## Description

The class parses an HTML document, searches for `<img>` tags, collects their URLs, and inserts an array of these URLs before the first `<img>` tag. Then, it removes the subsequent image tags.

## Installation

1. Download/clone the repository.
2. Ensure PHP is installed.
3. Place the HTML file you want to convert in the root folder of the project and name it index.html.

## Usage

1. Include the `ImageConverter` class in your project:
   ```
   include "ImageConverter.php"; 
   ```
2. Create an instance of `ImageConverter` and convert the HTML:
    ```
    $imageConverter = new ImageConverter();
    $newHTML = $imageConverter->convertImagesToPlaceholder('index.html');
    ```
3. Save the converted HTML to a file:
    ```
    file_put_contents('out.html', $newHTML); 
    ```

## Example

Original HTML:
```
<img src="image1.jpg">
<img src="image2.jpg">
<p>Текст после изображений</p>
```

Result:
```
["image1.jpg", "image2.jpg"]
<img src="image1.jpg">
<p>Текст после изображений</p>
```
---
## README (Русский)
# ImageConverter

`ImageConverter` — это PHP-класс, предназначенный для преобразования изображений в HTML-коде в массив ссылок на изображения перед первым изображением. Этот инструмент удаляет последующие теги изображений, оставляя только первый.

## Описание

Класс анализирует HTML-документ, ищет теги `<img>`, собирает их ссылки и вставляет массив ссылок на изображения перед первым тегом `<img>`. После этого остальные теги изображений удаляются.

## Установка

1. Скачайте/клонируйте репозиторий.
2. Убедитесь, что у вас установлен PHP.
3. Поместите HTML-файл, который хотите преобразовать, в корневую папку проекта под именем `index.html`.

## Использование

1. Включите класс `ImageConverter` в ваш проект:
   ```
   include "ImageConverter.php"; 
   ```
2. Создайте объект класса ImageConverter и преобразуйте HTML:
    ```
    $imageConverter = new ImageConverter();
    $newHTML = $imageConverter->convertImagesToPlaceholder('index.html');
    ```
3. Сохраните преобразованный HTML в файл:
    ```
    file_put_contents('out.html', $newHTML); 
    ```

## Пример

Исходный HTML:
```
<img src="image1.jpg">
<img src="image2.jpg">
<p>Текст после изображений</p>
```

Результат:
```
["image1.jpg", "image2.jpg"]
<img src="image1.jpg">
<p>Текст после изображений</p>
```
