Api venue
===
>By zjien

##该API仅提供给管理员使用

`Venue 接口`

###创建场馆
`POST`

`/Admin/Venue/createVenue`

字段 | 描述 | 是否必须 | 数据类型 | 备注
------------- | ---------------- | ----------------- | ------------ | ------------------
name | 场馆名 | Y | varchar | 
type | 所提供的运动类型 | Y | varchar | 可以多种类型
price | 价格 | Y | varchar | 元/时
region | 所在城市 | Y | varchar |
intro | 简介及说明 | Y | text |
picture | 场馆照片 | N | varchar |

**Response**
```json
{
    "code": 20000,
    "response": "创建成功"
}
```



###删除场馆
`POST`

`/Admin/Venue/deleteVenue`

字段 | 描述 | 是否必须 | 数据类型 | 备注
------------- | ---------------- | ----------------- | ------------ | ------------------
vi_id | 对应场馆的vi_id | Y | int | 只能删除由本人创建的场馆


**Response**
```json
{
    "code": 20000,
    "response": "删除成功"
}
```




###显示创建的场馆（只能显示自己创建的场馆）
`POST`

`/Admin/Venue/listsMyVenue`

字段 | 描述 | 是否必须 | 数据类型 | 备注
------------- | ---------------- | ----------------- | ------------ | ------------------
page | 当前页码 | N | int | 默认1
limit | 每页显示数目 | N | int | 默认10


**Response**
```json
{
    "code": 20000,
    "response": [
        {
            "vi_id": "5",
            "ma_id": "2",
            "name": "网球体育馆",
            "picture": null,
            "type": "网球",
            "price": "20",
            "bought": "0",
            "region": "江门",
            "intro": "不提供球和拍",
            "last_time": "1423127910",
            "last_IP": "127.0.0.1"
        },
        {
            "vi_id": "2",
            "ma_id": "2",
            "name": "市第二体育馆",
            "picture": null,
            "type": "篮球",
            "price": "30",
            "bought": "0",
            "region": "深圳",
            "intro": "提供篮球",
            "last_time": "1423127830",
            "last_IP": "127.0.0.1"
        },
        {
            "vi_id": "1",
            "ma_id": "2",
            "name": "市第一体育馆",
            "picture": null,
            "type": "羽毛球 乒乓球",
            "price": "25",
            "bought": "0",
            "region": "江门",
            "intro": "提供场地，不提供球拍",
            "last_time": "1423127800",
            "last_IP": "127.0.0.1"
        }
    ]
}
```



###显示所有创建的场馆（只提供超级管理员使用）
`POST`

`/Admin/Venue/listsAllVenue`

字段 | 描述 | 是否必须 | 数据类型 | 备注
------------- | ---------------- | ----------------- | ------------ | ------------------
page | 当前页码 | N | int | 默认1
limit | 每页显示数目 | N | int | 默认10


**Response**
```json
{
    "code": 20000,
    "response": [
        {
            "vi_id": "3",
            "ma_id": "1",
            "name": "市第三体育馆",
            "picture": null,
            "type": "足球",
            "price": "35",
            "bought": "0",
            "region": "江门",
            "intro": "提供足球和场地",
            "last_time": "1423127835",
            "last_IP": "127.0.0.1"
        },
        {
            "vi_id": "2",
            "ma_id": "2",
            "name": "市第二体育馆",
            "picture": null,
            "type": "篮球",
            "price": "30",
            "bought": "0",
            "region": "深圳",
            "intro": "提供篮球",
            "last_time": "1423127830",
            "last_IP": "127.0.0.1"
        },
        {
            "vi_id": "1",
            "ma_id": "2",
            "name": "市第一体育馆",
            "picture": null,
            "type": "羽毛球 乒乓球",
            "price": "25",
            "bought": "0",
            "region": "江门",
            "intro": "提供场地，不提供球拍",
            "last_time": "1423127800",
            "last_IP": "127.0.0.1"
        }
    ]
}
```