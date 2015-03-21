Api thirdUser
===
>By zjien

`ThirdUser 接口`

###第三方用户第一次登陆

`POST`

`/Home/ThirdUser/firstLogin`

字段 | 描述 | 是否必须 | 数据类型 | 备注
--------------------- | ----------------- | ----------------- | ---------------------- | ------------------
account | 第三方用户的UserID | Y | varchar | 
nickname | 昵称 | N | varchar |
sex | 性别 | N | varchar |

**Response**
```json
{
    "code": 20000,
    "response": "注册成功"
}
```



###登陆

`POST`

`/Home/ThirdUser/login`

字段 | 描述 | 是否必须 | 数据类型 | 备注
--------------------- | ----------------- | ----------------- | ---------------------- | ------------------
account | 第三方用户的UserID | Y | varchar | 

**Response**
```json
{
    "code": 20000,
    "response": "登陆成功"
}
```