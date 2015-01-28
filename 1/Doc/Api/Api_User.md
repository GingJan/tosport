Api user
===
>By zjien

`User 接口`

###用户注册
`POST`

`/Home/User/register`

字段 | 描述 | 是否必须 | 数据类型 | 备注
------------- | ---------------- | ----------------- | ------------ | ------------------
account| 用户账号  | Y | varchar(32) | 唯一
password | 密码 | Y | varchar(32) | 加密
repassword | 确认密码 | Y | varchar(32) | 要与password匹配
email | 邮箱 | Y | varchar(64) | 用于找回密码/todo

**Response**
```json
{
    "code":20000,
    "response"："注册成功!"
}
```


###更改用户基本信息
ps:该Api需要用户登陆

`POST`

`/Home/User/updateInfo`

字段 | 描述 | 是否必须 | 数据类型 | 备注
--------------- | ------------------ | -------------------- | ------------------ | --------------------
nickname | 昵称 | N | varchar(32) | 为空时自动填充account,注册时默认等于account
sex | 性别 | N | varchar(8) | 
phone | 电话 | N | varchar(16) | 
email | 邮箱 | N | varchar(64) | 
avatar | 头像 | N | varchar(256) | 头像图片的URL
intro | 个性签名 | N | text | 
birth | 生日 | N | int(10) | 时间戳
spt_favor | 运动爱好 | N | text | 字符串 
region | 地区 |N |varchar(32) |

**Response**  

```json
{
    "code":20000,
    "response":"修改信息成功"
}
```


###用户登陆
`POST`

`/Home/User/login`

字段 | 描述 | 是否必须 | 数据类型 | 备注
------------- | ----------- | --------------- | -------------- | ---------------
account| 用户账号  | Y | varchar(32) |
password | 密码 | Y | varchar(32) |

**Response**  
```json
{
    "code":20000,
    "response"："登陆成功！";
}
```



###退出登录
`POST`

`/Home/User/logout`

**Response**  
```json
{
    "code":20000,
    "response"："退出成功！";
}
```


###修改密码
ps:该Api需要用户登陆
`POST`

`/Home/User/updatePassword`

字段 | 描述 | 是否必须 | 数据类型 | 备注
------------- | ------------ | -------- | ------------- | ---------------
password| 原密码  | Y | varchar(32) | 
newPassword | 新密码 | Y | varchar(32) |
repassword | 确认密码 | Y | varchar(32) | 与newPassword匹配

**Response**  
```json
{
    "code":20000,
    "response":"密码修改成功！";
}
```



###显示用户信息
`POST`

`/Home/User/listsUserInfo`

字段 | 描述 | 是否必须 | 数据类型 | 备注
------------- | ------------ | -------- | ------------- | ---------------
account| 用户账号  | Y | varchar(32) | 

**Response**  
```json
{
    "code": 20000,
    "response": {
        "u_id": "1",
        "account": "zjien",
        "nickname": "zjien",
        "sex": null,
        "phone": "12345678901",
        "email": "694396727@qq.com",
        "avatar": null,
        "intro": null,
        "birth": null,
        "spt_favor": null,
        "region": "广东",
        "ctime": "1422431594",
        "cIP": "127.0.0.1",
        "last_time": "1422431594",
        "last_IP": "127.0.0.1"
    }
}
```


###找回密码
`POST`

`/Home/User/forgetPassword`

字段 | 描述 | 是否必须 | 数据类型 | 备注
------------- | ------------ | -------- | ------------- | ---------------
email | 用户邮箱  | Y | varchar(64) | 未实现该功能TODO 

**Response**
```json
{
    "code":20000,
    "response":"找回密码邮件已发送";
}
```