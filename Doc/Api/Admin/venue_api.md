Api manager
===
>By zjien

`Manager 接口`

##管理员
以下接口只适用于管理员

###创建场馆
`POST`

`/Admin/Manager/createVenue`

字段 | 描述 | 是否必须 | 数据类型 | 备注
------------- | ---------------- | ----------------- | ------------ | ------------------
name | 场馆名字 | Y | string | 
people | 场馆可容纳人数 | Y | string |
type | 场馆提供的运动类型 | Y | string |
price | 价格 | Y | int | 
region | 场馆所在城市 | Y | string |
intro | 场馆简介 | Y | string |

**Response**
```json
{
    "code": 20000,
    "response": "创建成功"
}
```


###关闭场馆
`POST`

`/Admin/Manager/closeVenue`

**Response**
```json
{
    "code": 20000,
    "response": "操作成功"
}
```


###开放场馆
`POST`

`/Admin/Manager/openVenue`

**Response**
```json
{
    "code": 20000,
    "response": "操作成功"
}
```


###更新场馆信息
`POST`

`/Admin/Manager/updateVenue`

字段 | 描述 | 是否必须 | 数据类型 | 备注
------------- | ---------------- | ----------------- | ------------ | ------------------
people | 场馆可容纳人数 | N | string |
type | 场馆提供的运动类型 | N | string |
price | 价格 | N | int | 
region | 场馆所在城市 | N | string |
intro | 场馆简介 | N | string |

**Response**
```json
{
    "code": 20000,
    "response": "修改成功"
}
```