# 📌 **Project Documentation: Character Management**  

## 📂 **Prerequisites**  
Before running the project, make sure you have the following installed:  

- **PHP 7.4+** (With SQLite enabled)  
- **Composer** (To manage dependencies like DomPDF)  
- **PHP Extensions**: SQLite3, PDO, and GD (for images)  
- **Local Server**: You can use PHP's built-in server, XAMPP, or Laragon  

---

## 📥 **Installation and Setup**  
### 1️⃣ **Clone the Project**  
If the project is hosted in a repository, clone it with:  
```sh
git clone https://github.com/TDWTheMaster/Task-6-Web-App-in-PHP-for-Managing-Characters-from-Works-etc.git
cd Task-6-Web-App-in-PHP-for-Managing-Characters-from-Works-etc
```
If you have it in a ZIP file, simply extract the files into a folder.  

### 2️⃣ **Install Dependencies**  
Run the following command in the project root directory to install **DomPDF**:  
```sh
composer install
```
If **Composer** is not installed, download it from [getcomposer.org](https://getcomposer.org).  

### 3️⃣ **Set Up the Database**  
- **SQLite** does not require additional configuration, but make sure the `serie_db.sqlite` file exists in the project root.  
- If it does not exist, you can create it by running this PHP script:  
```php
<?php
$db = new SQLite3('serie_db.sqlite');
$db->exec("CREATE TABLE IF NOT EXISTS personajes (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nombre TEXT NOT NULL,
    color TEXT NOT NULL,
    tipo TEXT NOT NULL,
    nivel INTEGER NOT NULL,
    foto TEXT
)");
echo "Database and table created successfully.";
?>
```
Save it as `setup_db.php` and run it with:  
```sh
php setup_db.php
```

---

## 🚀 **Running the Project**  
To start PHP's built-in server on port `5050`, use:  
```sh
php -S localhost:5050
```
Then, open your browser and go to:  
```
http://localhost:5050/index.php
```

---

## 🛠 **Main Features**  
- **Add Characters** → Form to register characters with an image.  
- **Edit Characters** → Modify existing character data.  
- **Delete Characters** → Delete records with confirmation.  
- **Download as PDF** → Generate and open a character profile in a new tab.  

---

## 📝 **Additional Notes**  
- In `php.ini`, enable everything related to SQLite.  
- If you are using **XAMPP or Laragon**, move the project to the `htdocs` folder and access it via `http://localhost/your_project/`.  
- If you have issues displaying images in the PDF, ensure the paths are absolute or convert images to **base64** (already implemented).  
- If you need to use MySQL instead of SQLite, update the configuration in `db_config.php` and manually create the database.  

---

With this guide, any user will be able to install and run the project without issues. 🚀
