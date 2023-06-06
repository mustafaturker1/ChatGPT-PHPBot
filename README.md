# ChatGPT PHP Bot
This is a simple ChatGPT bot implemented in PHP. It allows you to have interactive conversations with the ChatGPT language model developed by OpenAI.

Setup
After you have downloaded or cloned this project, follow these steps to set it up:

Install PHP packages by running the following command in your terminal:

```
composer install
```

Next, you need to enter your OpenAI key and Discord token in the ChatGPT.php file. Look for the following lines:

```php
$discord = new Discord([
        'token' => 'your token',
    ]);
```
```php
$open_ai_key = "your key";
```
