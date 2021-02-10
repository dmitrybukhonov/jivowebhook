# JivoWebHook
**Расширение для приема ответа от Jivo**

## Установка
### Composer
Добавьте в блок "require" в composer.json вашего проекта:
```
composer require dmitrybukhonov/jivowebhook
```

## Использование
Ознакомьтесь с [официальной документацией](https://www.jivosite.ru/support/knowledge-base/article/jivosite-api#webhooks) Jivo  
```php
        $jivoHook = new JivoHook;

        if ($jivoHook->getEmailHook()) {
            $httpClient = new Client([
                'verify' => false,
            ]);
            $httpClient->post($url, [
                'form_params' => [
                    'email' => $jivoHook->getEmailHook(),
                ],
            ]);
        }
```
