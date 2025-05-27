<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Laravel Starter Kit

यह Laravel Starter Kit रोल और परमिशन मैनेजमेंट के साथ आता है। इसमें एक डिफ़ॉल्ट एडमिन यूज़र भी शामिल है।

---

## प्रोजेक्ट सेटअप

नीचे दिए गए स्टेप्स को फॉलो करके इस प्रोजेक्ट को सेटअप करें:

---

### 1. प्रोजेक्ट क्लोन करें

GitHub से प्रोजेक्ट क्लोन करने के लिए:
```bash
git clone git@github.com:kanhaiya508/staterkit.git
 क्लोन की गई डायरेक्टरी में जाएं:

bash
Copy code
cd staterkit
2. Composer Update
Laravel प्रोजेक्ट में आवश्यक पैकेज जोड़ने के लिए:

bash
Copy code
composer update
3. .env फाइल सेट करें
.env.example फाइल को .env में कॉपी करें:

bash
Copy code
cp .env.example .env
अब डेटाबेस और अन्य सेटिंग्स को एडिट करें:

dotenv
Copy code
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_user
DB_PASSWORD=your_database_password
4. ऐप कुंजी जनरेट करें
एप्लिकेशन की कुंजी जनरेट करने के लिए:

bash
Copy code
php artisan key:generate
5. माईग्रेशन रन करें
डेटाबेस टेबल्स बनाने के लिए:

bash
Copy code
php artisan migrate
6. सीडर्स रन करें
रोल और परमिशन जोड़ने के लिए:

bash
Copy code
php artisan db:seed --class=PermissionTableSeeder
डिफ़ॉल्ट एडमिन यूज़र बनाने के लिए:

bash
Copy code
php artisan db:seed --class=CreateAdminUserSeeder
7. सर्वर स्टार्ट करें
Laravel एप्लिकेशन को सर्वर पर चलाने के लिए:

bash
Copy code
php artisan serve
8. एडमिन लॉगिन करें
एडमिन पैनल में लॉगिन करने के लिए डिफ़ॉल्ट क्रेडेंशियल्स:

ईमेल: admin@gmail.com
पासवर्ड: 123456