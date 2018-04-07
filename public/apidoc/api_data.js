define({ "api": [
  {
    "type": "post",
    "url": "/login",
    "title": "创建一个token（create a token)",
    "description": "<p>创建一个token (create a token)</p>",
    "group": "Auth",
    "permission": [
      {
        "name": "none"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "login",
            "description": "<p>昵称或者邮箱</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "password",
            "description": "<p>密码</p>"
          }
        ]
      }
    },
    "version": "0.1.0",
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "Http/1.1 201 Created\n{\n     \"message\": \"success\",\n     \"data\": {\n         \"token\": \"eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vd3d3LmFwaWFwcC5jb20vYXBpL2xvZ2luIiwiaWF0IjoxNTIzMDE4NTU2LCJleHAiOjE1MjMwMjIxNTYsIm5iZiI6MTUyMzAxODU1NiwianRpIjoiQmxQY0Z0YTMyWTU1Y0RTdSIsInN1YiI6MzgsInBydiI6IjIzYmQ1Yzg5NDlmNjAwYWRiMzllNzAxYzQwMDg3MmRiN2E1OTc2ZjcifQ.lyWWygX31DyZOg3pIqgjdhWjwqyxd1tN3XcUjS6tGpc\",\n         \"expired_at\": \"2018-04-06 13:42:36\",\n         \"refresh_expired_at\": \"2018-04-20 12:42:36\"\n     },\n     \"status_code\": 200\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-Response:",
          "content": "Http/1.1 401 Unauthorized\n{\n    \"message\": \"Unauthorized\",\n    \"status_code\": 401\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Api/V1/Auth1Controllerr.php",
    "groupTitle": "Auth",
    "name": "PostLogin"
  },
  {
    "type": "post",
    "url": "/users",
    "title": "创建一个用户(create a user)",
    "description": "<p>创建一个用户(create a user)</p>",
    "group": "user",
    "permission": [
      {
        "name": "none"
      }
    ],
    "version": "0.1.0",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Email",
            "optional": false,
            "field": "email",
            "description": "<p>邮箱必填</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "password",
            "description": "<p>密码</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": "<p>昵称</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "Http/1.1 201 Created\n{\n    \"data\": {\n            \"id\": 26,\n            \"email\": \"312430882@qq.com\",\n            \"name\": \"31243088\",\n            \"avatar\": null,\n            \"created_at\": \"2018-04-05 08:28:13\",\n            \"updated_at\": \"2018-04-05 08:28:13\"\n            }\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-Response:",
          "content": "Http/1.1 400 Bad Request\n{\n    \"message\": \"422 Unprocessable Entity\",\n    \"errors\": {\n        \"password\": [\n            \"密码长度必须大于6位\"\n         ]\n     },\n    \"status_code\": 422\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Api/V1/UserController.php",
    "groupTitle": "user",
    "name": "PostUsers"
  }
] });
