Api manager
===
>By zjien

`Manager 接口`

##超级管理员
以下接口只适用于超级管理员

###管理员创建（只限于超级管理员使用）
`POST`

`/Admin/Manager/createManager`

字段 | 描述 | 是否必须 | 数据类型 | 备注
------------- | ---------------- | ----------------- | ------------ | ------------------
account| 账号 | Y | string | 
password | 密码 | Y | string | 

**Response**
```json
{
    "code": 20000,
    "response": "创建成功"
}
```



###禁用管理员（只限于超级管理员使用）
ps:该API需要登陆
`POST`

`/Admin/Manager/banManager`

字段 | 描述 | 是否必须 | 数据类型 | 备注
------------- | ---------------- | ----------------- | ------------ | ------------------
ma_id | 从显示列表中获取 | Y | int | 

**Response**
```json
{
    "code": 20000,
    "response": "操作成功"
}
```

###解封管理员（只限于超级管理员使用）
ps:该API需要登陆
`POST`

`/Admin/Manager/openManager`

字段 | 描述 | 是否必须 | 数据类型 | 备注
------------- | ---------------- | ----------------- | ------------ | ------------------
ma_id | 从显示列表中获取 | Y | int | 

**Response**
```json
{
    "code": 20000,
    "response": "操作成功"
}
```



###列出所有管理员（包括超级管理员）
ps:该API要登陆
`POST`

`/Admin/Manager/listsManager`

字段 | 描述 | 是否必须 | 数据类型 | 备注
------------- | ------------ | -------- | ------------- | ---------------
page | 当前页码 | N | int | 默认为1

**Response**  
```json
{
    "code": 20000,
    "response": [
        {
            "ma_id": "9",
            "account": "admin7",
            "nickname": "admin7",
            "email": null,
            "phone": null,
            "role": "1",
            "is_ban": "0",
            "parent_ma_id": "0",
            "create_time": "1443018417",
            "create_IP": "127.0.0.1",
            "last_time": "1443018417",
            "last_IP": "127.0.0.1"
        },
        {
            "ma_id": "8",
            "account": "admin6",
            "nickname": "admin6",
            "email": null,
            "phone": null,
            "role": "1",
            "is_ban": "1",
            "parent_ma_id": "0",
            "create_time": "1442992651",
            "create_IP": "127.0.0.1",
            "last_time": "1442992651",
            "last_IP": "127.0.0.1"
        },
        {
            "ma_id": "6",
            "account": "admin5",
            "nickname": "admin5",
            "email": null,
            "phone": null,
            "role": "1",
            "is_ban": "0",
            "parent_ma_id": "0",
            "create_time": "1423039615",
            "create_IP": "127.0.0.1",
            "last_time": "1423039615",
            "last_IP": "127.0.0.1"
        }
    ]
}
```





###管理员
以下接口只适用于管理员

###员工创建
`POST`

`/Admin/Manager/createStaff`

字段 | 描述 | 是否必须 | 数据类型 | 备注
------------- | ---------------- | ----------------- | ------------ | ------------------
account| 账号 | Y | string | 
password | 密码 | Y | string | 

**Response**
```json
{
    "code": 20000,
    "response": "创建成功"
}
```

###禁用员工
ps:该API需要登陆
`POST`

`/Admin/Manager/banStaff`

字段 | 描述 | 是否必须 | 数据类型 | 备注
------------- | ---------------- | ----------------- | ------------ | ------------------
ma_id | 从显示列表中获取 | Y | int | 

**Response**
```json
{
    "code": 20000,
    "response": "操作成功"
}
```

###解禁员工
ps:该API需要登陆
`POST`

`/Admin/Manager/openStaff`

字段 | 描述 | 是否必须 | 数据类型 | 备注
------------- | ---------------- | ----------------- | ------------ | ------------------
ma_id | 从显示列表中获取 | Y | int | 

**Response**
```json
{
    "code": 20000,
    "response": "操作成功"
}
```

###列出所有员工
ps:该API要登陆
`POST`

`/Admin/Manager/listsStaff`

字段 | 描述 | 是否必须 | 数据类型 | 备注
------------- | ------------ | -------- | ------------- | ---------------
page | 当前页码 | N | int | 默认为1

**Response**  
```json
{
    "code": 20000,
    "response": [
        {
            "ma_id": "10",
            "account": "staff1",
            "password": "e10adc3949ba59abbe56e057f20f883e",
            "nickname": "staff1",
            "email": null,
            "phone": null,
            "role": "2",
            "is_ban": "0",
            "parent_ma_id": "3",
            "create_time": "1443061426",
            "create_IP": "127.0.0.1",
            "last_time": "1443061426",
            "last_IP": "127.0.0.1"
        },
        {
            "ma_id": "11",
            "account": "staff2",
            "password": "e10adc3949ba59abbe56e057f20f883e",
            "nickname": "staff2",
            "email": null,
            "phone": null,
            "role": "2",
            "is_ban": "0",
            "parent_ma_id": "3",
            "create_time": "1443062632",
            "create_IP": "127.0.0.1",
            "last_time": "1443062632",
            "last_IP": "127.0.0.1"
        },
        {
            "ma_id": "12",
            "account": "staff3",
            "password": "e10adc3949ba59abbe56e057f20f883e",
            "nickname": "staff3",
            "email": null,
            "phone": null,
            "role": "2",
            "is_ban": "0",
            "parent_ma_id": "3",
            "create_time": "1443062635",
            "create_IP": "127.0.0.1",
            "last_time": "1443062635",
            "last_IP": "127.0.0.1"
        }
    ]
}
```






##通用
以下接口超管、管理员、员工均可用
###登录（通用）
`POST`

`/Admin/Manager/login`

字段 | 描述 | 是否必须 | 数据类型 | 备注
------------- | ---------------- | ----------------- | ------------ | ------------------
account| 账号  | Y | string | 
password | 密码 | Y | string | 

**Response**
```json
{
    "code": 20000,
    "response": {
        "ma_id": "1",
        "account": "super",
        "nickname": "superM",
        "email": null,
        "phone": null,
        "role": "0",
        "is_ban": "0",
        "parent_ma_id": "0",
        "create_time": "1423038560",
        "create_IP": "127.0.0.1",
        "last_time": "1442992576",
        "last_IP": "127.0.0.1"
    }
}
```



###退出（通用）
`POST`

`/Admin/Manager/logout`

**Response**
```json
{
    "code": 20000,
    "response": "成功退出"
}
```



###更新信息（通用）
ps:该API需要登陆
`POST`

`/Admin/Manager/updateInfo`

字段 | 描述 | 是否必须 | 数据类型 | 备注
------------- | ---------------- | ----------------- | ------------ | ------------------
nickname | 昵称 | N | string | 
email | 邮箱 | N | string | 
phone | 电话 | N | string | 


**Response**
```json
{
    "code": 20000,
    "response": "更新成功"
}
```


###修改密码（通用）
ps:该API要登陆
`POST`

`/Admin/Manager/updatePassword`

字段 | 描述 | 是否必须 | 数据类型 | 备注
------------- | ------------ | -------- | ------------- | ---------------
password| 原密码  | Y | string | 
newPassword | 新密码 | Y | string |

**Response**  
```json
{
    "code": 20000,
    "response": "修改密码成功"
}
```






