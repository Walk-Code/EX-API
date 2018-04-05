define({ "api": [
  {
    "type": "get",
    "url": "/login",
    "title": "用户登陆(user login)",
    "description": "<p>用户登陆</p>",
    "group": "User",
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
            "type": "String",
            "optional": false,
            "field": "userName",
            "description": "<p>昵称必填</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "password",
            "description": "<p>密码必填且长度必须大于6</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n    token: eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjEsImlzcyI6Imh0dHA6XC9cL21vYmlsZS5kZWZhcmEuY29tXC9hdXRoXC90b2tlbiIsImlhdCI6IjE0NDU0MjY0MTAiLCJleHAiOiIxNDQ1NjQyNDIxIiwibmJmIjoiMTQ0NTQyNjQyMSIsImp0aSI6Ijk3OTRjMTljYTk1NTdkNDQyYzBiMzk0ZjI2N2QzMTMxIn0.9UPMTxo3_PudxTWldsf4ag0PHq1rK8yO9e5vqdwRZLY\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Api/V1/UserController.php",
    "groupTitle": "User",
    "name": "GetLogin"
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
          "content": "Http/1.1 201 OK\n{\n    \"data\": {\n            \"id\": 26,\n            \"email\": \"312430882@qq.com\",\n            \"name\": \"31243088\",\n            \"avatar\": null,\n            \"created_at\": \"2018-04-05 08:28:13\",\n            \"updated_at\": \"2018-04-05 08:28:13\"\n            }\n}",
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
