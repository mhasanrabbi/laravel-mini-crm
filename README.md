# **Laravel Mini CRM**


## *Features*

|Topic|Examples  |
|--|--|
|Route Model Binding| [UserController](https://github.com/mhasanrabbi/laravel-mini-crm/blob/7cf3fa2e169f1b443acbb2f4e88537384490ece8/routes/web.php#L18) |
|Route Redirect|[web.php](https://github.com/mhasanrabbi/laravel-mini-crm/blob/7cf3fa2e169f1b443acbb2f4e88537384490ece8/routes/web.php#L9)|
|Database Seeder and Factories|[factories](https://github.com/mhasanrabbi/laravel-mini-crm/tree/develop/database/factories) <br> [seeders](https://github.com/mhasanrabbi/laravel-mini-crm/tree/develop/database/seeders)|
|Eloquent Query Scopes| [search](https://github.com/mhasanrabbi/laravel-mini-crm/blob/7cf3fa2e169f1b443acbb2f4e88537384490ece8/app/Models/User.php#L27) |


## Preview
![enter image description here](https://raw.githubusercontent.com/mhasanrabbi/images-repo/main/crm.png?token=GHSAT0AAAAAABY6VCHBFU6EHNUBZRGT3SU6Y4M34GA)

## *Installation*


### Clone the repository:
``` 
$ git clone https://github.com/mhasanrabbi/laravel-mini-pos.git
```

### Change Directory

```
$ cd laravel-mini-pos
```
### Install Composer
``` 
$ composer install
```
### Generate APP_KEY 
``` 
$ php artisan key:generate
```

### Change below credentials with your own config in `.env`
``` 
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=
```

### Run Migration and Seed Database

``` 
$ php artisan migrate --seed
```

### Start Local Development Server

``` 
$ php artisan serve
```

### Login as Admin

email: `admin@admin.com` 
password: `password` 

### Login as user
email: `user@user.com`
password: `password` 
