- npx serve ile default olarak çalışan dosyanın adı `index.html` dir.
- npx serve yerine vscoe içindeki "Go Live" eklentisi de aynı işi yapıyor.

- BIND etmek için `:value="varname"`
- ÇİFT YÖNLÜ BIND etmek için `v-model="varname"`

```BASH
npx serve
```

## Cross-Origin Resource Sharing (CORS) hatalarını PHP tarafında önlemek için:

Cross-Origin Resource Sharing (CORS) hatalarını PHP tarafında önlemek için, öncelikle PHP kodunuzda uygun başlıkları ayarlayarak istemcinin (örneğin, tarayıcı) gelen isteğinizi kabul etmesini sağlamanız gerekir. İşte basit bir örnek:

```php
<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

// Diğer PHP kodları buraya eklenecek
?>
```

Bu kod, gelen isteğin hangi kaynaklardan (origin) gelirse gelsin kabul edilmesine izin verir (`Access-Control-Allow-Origin: *`). Ayrıca, hangi HTTP yöntemlerini kabul ettiğimizi belirtir (`Access-Control-Allow-Methods: GET, POST, OPTIONS`) ve hangi başlıkların isteğe eklenebileceğini belirtir (`Access-Control-Allow-Headers: Content-Type`).

Ancak, `Access-Control-Allow-Origin: *` kullanımı herkesin erişimine izin verir, bu da güvenlik riski oluşturabilir. Gerçek bir uygulama için, izin verilen belirli alanları belirtmek daha güvenlidir. Örneğin:

```php
<?php
$allowedOrigins = [
    "http://example.com",
    "https://example.com"
];

$origin = $_SERVER["HTTP_ORIGIN"];

if (in_array($origin, $allowedOrigins)) {
    header("Access-Control-Allow-Origin: " . $origin);
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
    header("Access-Control-Allow-Headers: Content-Type");
}

// Diğer PHP kodları buraya eklenecek
?>
```

Bu örnekte, yalnızca belirli kökenlere (`$allowedOrigins`) erişime izin verilir. Bu, güvenlik açısından daha sağlam bir yaklaşımdır.
