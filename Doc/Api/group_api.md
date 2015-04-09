Api group
===
>By zjien

`Group 接口`

###创建群组
ps：该API需要登陆
`POST`

`/Home/Group/createGroup`

字段 | 描述 | 是否必须 | 数据类型 | 备注
------------- | ---------------- | ----------------- | ------------ | ------------------
group_account| 群组账号 | Y | varchar(32) | 唯一
name | 群组名称 | Y | varchar(32) | 唯一
people | 容纳人数 | Y | int | 
intro | 群组简介 | N | text | 
picture | 群组头像 | N | file | 

**Response**
```json
{
    "code": 20000,
    "response": "创建成功"
}
```



###显示我所创建的群组
ps：该API需要登陆
`POST`

`/Home/Group/listsGroup`

字段 | 描述 | 是否必须 | 数据类型 | 备注
------------- | ---------------- | ----------------- | ------------ | ------------------
page | 当前页码 | N | int | 默认为1
limit | 每页显示数 | N | int | 默认为10

**Response**
```json
{
    "code": 20000,
    "response": [
        {
            "gi_id": "3",
            "group_account": "Timky1",
            "name": "Timky1",
            "creator_id": "2",
            "people": "30",
            "joined": "0",
            "region": "江门",
            "intro": null,
            "create_time": "1423624065"
        },
        {
            "gi_id": "4",
            "group_account": "Timky2",
            "name": "Timky2",
            "creator_id": "2",
            "people": "30",
            "joined": "0",
            "region": "江门",
            "intro": "这是Timky1的分群组",
            "create_time": "1423624131"
        }
    ]
}
```



###获取某群组的信息
ps：该API需要登陆
`POST`

`/Home/Group/getGroupInfo`

字段 | 描述 | 是否必须 | 数据类型 | 备注
------------- | ---------------- | ----------------- | ------------ | ------------------
gi_id | 群组的id | Y | int |

**Response**
```json
{
    "code": 20000,
    "response": {
        "gi_id": "5",
        "group_account": "Curios",
        "name": "Curious",
        "creator_id": "3",
        "people": "15",
        "joined": "2",
        "region": "江门",
        "intro": null,
        "create_time": "1423624172"
    }
}
```




###更新群组
ps：该API需要登陆
`POST`

`/Home/Group/updateGroup`

字段 | 描述 | 是否必须 | 数据类型 | 备注
------------- | ---------------- | ----------------- | ------------ | ------------------
gi_id | 被更新群组的id | Y | int |
name | 群组名称 | Y | varchar | 
people | 容纳人数 | Y | int | 
intro | 群组简介 | N | text | 

**Response**
```json
{
    "code": 20000,
    "response": "更新成功"
}
```


###删除群组
ps：该API需要登陆
`POST`

`/Home/Group/deleteGroup`

字段 | 描述 | 是否必须 | 数据类型 | 备注
------------- | ---------------- | ----------------- | ------------ | ------------------
gi_id | 被删除群组的id | Y | int |

**Response**
```json
{
    "code": 20000,
    "response": "删除成功"
}
```


###加入群组
ps：该API需要登陆
`POST`

`/Home/Group/joinGroup`

字段 | 描述 | 是否必须 | 数据类型 | 备注
------------- | ---------------- | ----------------- | ------------ | ------------------
gi_id | 要加入群组的id | Y | int |

**Response**
```json
{
    "code": 20000,
    "response": "成功加入该群组"
}
```




###退出群组
ps：该API需要登陆
`POST`

`/Home/Group/quitGroup`

字段 | 描述 | 是否必须 | 数据类型 | 备注
------------- | ---------------- | ----------------- | ------------ | ------------------
gi_id | 要退出群组的id | Y | int |

**Response**
```json
{
    "code": 20000,
    "response": "退出成功"
}
```



###退出群组
ps：该API需要登陆
`POST`

`/Home/Group/quitGroup`

字段 | 描述 | 是否必须 | 数据类型 | 备注
------------- | ---------------- | ----------------- | ------------ | ------------------
gi_id | 要退出群组的id | Y | int |

**Response**
```json
{
    "code": 20000,
    "response": "退出成功"
}
```


###显示我加入的群组
ps：该API需要登陆
`POST`

`/Home/Group/listsJoinGroup`

字段 | 描述 | 是否必须 | 数据类型 | 备注
------------- | ---------------- | ----------------- | ------------ | ------------------
page | 当前页码 | N | int | 默认为1
limit | 每页显示数 | N | int | 默认为10

**Response**
```json
{
    "code": 20000,
    "response": [
        {
            "gp_id": "3",
            "gi_id": "3",
            "associator_id": "2",
            "power": "2",
            "join_time": "1423624065"
        },
        {
            "gp_id": "5",
            "gi_id": "5",
            "associator_id": "2",
            "power": "0",
            "join_time": "1423624609"
        },
        {
            "gp_id": "9",
            "gi_id": "2",
            "associator_id": "2",
            "power": "0",
            "join_time": "1423624875"
        }
    ]
}
```



###显示加入的群组成员
ps：该API需要登陆
`POST`

`/Home/Group/listsAssociator`

字段 | 描述 | 是否必须 | 数据类型 | 备注
------------- | ---------------- | ----------------- | ------------ | ------------------
page | 当前页码 | N | int | 默认为1
limit | 每页显示数 | N | int | 默认为10

**Response**
```json
{
    "code": 20000,
    "response": [
        {
            "gp_id": "4",
            "gi_id": "5",
            "associator_id": "3",
            "power": "2",
            "join_time": "1423624172"
        },
        {
            "gp_id": "5",
            "gi_id": "5",
            "associator_id": "2",
            "power": "0",
            "join_time": "1423624609"
        },
        {
            "gp_id": "12",
            "gi_id": "5",
            "associator_id": "1",
            "power": "0",
            "join_time": "1423637049"
        }
    ]
}
```



###设置群组成员的权限（该API只提供给群组的创建人）
ps：该API需要登陆
`POST`

`/Home/Group/grantPower`

字段 | 描述 | 是否必须 | 数据类型 | 备注
------------- | ---------------- | ----------------- | ------------ | ------------------
gi_id | 群组id | Y | int |
associator_id | 被设置成员的u_id | Y | int |

**Response**
```json
{
    "code": 20000,
    "response": "设置成功"
}
```



###撤销某用户的群组管理员权限（该API只提供给群组的创建人）
ps：该API需要登陆
`POST`

`/Home/Group/revokePower`

字段 | 描述 | 是否必须 | 数据类型 | 备注
------------- | ---------------- | ----------------- | ------------ | ------------------
gi_id | 群组id | Y | int |
associator_id | 被撤销成员的u_id | Y | int |

**Response**
```json
{
    "code": 20000,
    "response": "撤销成功"
}
```


