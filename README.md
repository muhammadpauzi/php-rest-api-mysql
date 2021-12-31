# PHP Rest API with MySQL
🐘 Learn to make Rest API with PHP and MySQL using OOP paradigm and design patterns. (Project of learn PHP and MySQL with PZN).


## **API SPEC**
<br>

**BASE URL** : `http://localhost:8080/`

### **Users**
<hr>

### Find all users
Request :
- Endpoint : `/users`
- Method : **GET**

Response : 
```json
{
    "data": [
        {
            "id": "",
            "name": "",
            "username": "",
            "email": "",
            "created_at": ""
        }
    ]
}
```

### Find a user
Request :
- Endpoint : `/users/:id`
- Method : **GET**

Response : 
```json
{
    "data": {
        "id": "",
        "name": "",
        "username": "",
        "email": "",
        "created_at": ""
    }
}
```

### Find a user with the posts
Request :
- Endpoint : `/users/:id/posts`
- Method : **GET**

Response : 
```json
{
    "data": {
        "id": "",
        "name": "",
        "username": "",
        "email": "",
        "created_at": "",
        "posts": [
            {
                "id": "",
                "title": "",
                "description": "",
                "body": "",
                "id_user": "", 
                "created_at": "", 
            }
        ]
    }
}
```

### **Posts**
<hr>

### Find all posts
Request :
- Endpoint : `/posts`
- Method : **GET**

Response : 
```json
{
    "data": [
        {
            "id": "",
            "name": "",
            "username": "",
            "email": "",
            "created_at": "",
            "title": "",
            "description": "",
            "body": "",
            "id_user": "", 
            "user_created_at": "", 
        }
    ]
}

```
### Find a post
Request :
- Endpoint : `/posts/:id`
- Method : **GET**

Response : 
```json
{
    "data": {
        "id": "",
        "name": "",
        "username": "",
        "email": "",
        "created_at": "",
        "title": "",
        "description": "",
        "body": "",
        "id_user": "", 
        "user_created_at": "", 
    }
}
```
