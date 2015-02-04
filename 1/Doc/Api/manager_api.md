Api manager
===
>By zjien

`Manager 接口`

###管理员注册（只限于超级管理员使用）
`POST`

`/Admin/Manager/register`

字段 | 描述 | 是否必须 | 数据类型 | 备注
------------- | ---------------- | ----------------- | ------------ | ------------------
account| 账号 | Y | varchar(32) | 唯一
password | 密码 | Y | varchar(32) | 加密
repassword | 确认密码 | Y | varchar(32) | 要与password匹配

**Response**
```json
{
    "code": 20000,
    "response": "注册成功"
}
```



###删除管理员（只限于超级管理员使用）
ps:该API需要登陆
`POST`

`/Admin/Manager/deleteManager`

字段 | 描述 | 是否必须 | 数据类型 | 备注
------------- | ---------------- | ----------------- | ------------ | ------------------
ma_id | 管理员表对应的ma_id | Y | int | manager表对应的自增长ma_id

**Response**
```json
{
    "code": 20000,
    "response": "删除成功"
}
```



###管理员登录
`POST`

`/Admin/Manager/login`

字段 | 描述 | 是否必须 | 数据类型 | 备注
------------- | ---------------- | ----------------- | ------------ | ------------------
account| 账号  | Y | varchar(32) | 唯一
password | 密码 | Y | varchar(32) | 加密

**Response**
```json
{
    "code": 20000,
    "response": "登录成功！"
}
```



###退出登录
`POST`

`/Admin/Manager/logout`

**Response**
```json
{
    "code": 20000,
    "response": "成功退出"
}
```



###更新管理员信息
ps:该API需要登陆
`POST`

`/Admin/Manager/updateInfo`

字段 | 描述 | 是否必须 | 数据类型 | 备注
------------- | ---------------- | ----------------- | ------------ | ------------------
email | 邮箱 | Y | varchar(64) | 
nickname | 昵称 | N | varchar(32) | 为空时自动填充account,注册时默认account填充
phone | 电话 | N | varchar(16) | 

**Response**
```json
{
    "code": 20000,
    "response": "更新成功！"
}
```


###修改密码
ps:该API要登陆
`POST`

`/Admin/Manager/updatePassword`

字段 | 描述 | 是否必须 | 数据类型 | 备注
------------- | ------------ | -------- | ------------- | ---------------
password| 原密码  | Y | varchar(32) | 
newPassword | 新密码 | Y | varchar(32) |
repassword | 确认密码 | Y | varchar(32) | 与newPassword匹配

**Response**  
```json
{
    "code":20000,
    "response":"修改密码成功";
}
```



###列出所有管理员（包括超级管理员）
ps:该API要登陆
`POST`

`/Admin/Manager/listsManager`

字段 | 描述 | 是否必须 | 数据类型 | 备注
------------- | ------------ | -------- | ------------- | ---------------
page | 当夜页码 | N | int | 默认为1
limit | 每页显示数目 | N | int | 默认为10

**Response**  
```json
{
    "code": 20000,
    "response": [
        {
            "ma_id": "3",
            "account": "admin2",
            "nickname": "admin2",
            "email": null,
            "phone": null,
            "create_time": "1423039605",
            "create_IP": "127.0.0.1",
            "last_time": "1423039605",
            "last_IP": "127.0.0.1"
        },
        {
            "ma_id": "2",
            "account": "admin1",
            "nickname": "admin1",
            "email": "admin1@qq.com",
            "phone": "12345678901",
            "create_time": "1423039536",
            "create_IP": "127.0.0.1",
            "last_time": "1423042972",
            "last_IP": "127.0.0.1"
        },
        {
            "ma_id": "1",
            "account": "super",
            "nickname": "superM",
            "email": null,
            "phone": null,
            "create_time": "1423038560",
            "create_IP": "127.0.0.1",
            "last_time": "1423039504",
            "last_IP": "127.0.0.1"
        }
    ]
}
```