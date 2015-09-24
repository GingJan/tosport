Api dateVenue
===
>By zjien

`DateVenue 接口`


####各字段的解释
字段 | 描述 | 备注
--------------------- | ----------------- | ------------------------
dv_id | 该预约的id |
ma_id | 创建该场馆的管理员的id |
name | 该场馆的名字 |
people | 场馆剩余的预约名额 |
booked | 已被预约数｜
picture | 场馆图片 | 
type | 该场馆所提供的运动类型 |
price | 该场馆的价钱 |
bought | 总共被预约数 | 历史统计
region | 场馆所在城市 | 
intro | 场馆的简介 |
subscriber | 预定者的id | 即用户id |
vi_id | 该场馆的id |
date_time | 到场时间 |
order_time | 下单时间 |




###预约该场馆
ps:该Api需要用户登陆
`POST`

`/Home/DateVenue/date`

字段 | 描述 | 是否必须 | 数据类型 | 备注
--------------------- | ------------------- | ------------------- | ---------------------- | ------------------
vi_id | 对应场馆的vi_id | Y | int | 
ma_id | 创建该场馆管理员的ma_id | N | int |
date_time | 预约时间 | Y | int | 什么时间到场馆

**Response**
```json
{
    "code": 20000,
    "response": "预约成功"
}
```



###取消预约
ps:该Api需要用户登陆
`POST`

`/Home/DateVenue/cancelDate`

字段 | 描述 | 是否必须 | 数据类型 | 备注
--------------------- | ------------------- | ------------------- | ---------------------- | ------------------
dv_id | 对应订单dv_id | Y | int | 

**Response**
```json
{
    "code": 20000,
    "response": "取消成功"
}
```



###显示/搜索 某场馆
ps:该Api需要用户登陆
`POST`

`/Home/DateVenue/listsSpeVenue`

字段 | 描述 | 是否必须 | 数据类型 | 备注
--------------------- | ------------------- | ------------------- | ---------------------- | ------------------
vi_id | 对应场馆的vi_id | N | int | 
search | 要搜索的场馆的名字 | N | varchat | 

**Response**
```json
{
    "code": 20000,
    "response": {
        "vi_id": "1",
        "ma_id": "2",
        "name": "市第一体育馆",
        "people": "5",
        "booked": "0",
        "picture": null,
        "type": "羽毛球 乒乓球",
        "price": "25",
        "bought": "1",
        "region": "江门",
        "intro": "提供场地，不提供球拍"
    }
}
```



###显示同城场馆
ps:该Api需要用户登陆
`GET`

`/Home/DateVenue/listsCityVenue`

字段 | 描述 | 是否必须 | 数据类型 | 备注
--------------------- | ------------------- | ------------------- | ---------------------- | ------------------
page | 当前页码 | N | int | 默认为1
limit | 每页大小 | N |int | 默认为10

**Response**
```json
{
    "code": 20000,
    "response": [
        {
            "vi_id": "1",
            "ma_id": "2",
            "name": "市第一体育馆",
            "people": "5",
            "booked": "0",
            "picture": null,
            "type": "羽毛球 乒乓球",
            "price": "25",
            "bought": "1",
            "region": "江门",
            "intro": "提供场地，不提供球拍"
        },
        {
            "vi_id": "3",
            "ma_id": "1",
            "name": "市第三体育馆",
            "people": "7",
            "booked": "1",
            "picture": null,
            "type": "足球",
            "price": "35",
            "bought": "0",
            "region": "江门",
            "intro": "提供足球和场地"
        },
        {
            "vi_id": "5",
            "ma_id": "2",
            "name": "网球体育馆",
            "people": "5",
            "booked": "0",
            "picture": null,
            "type": "网球",
            "price": "20",
            "bought": "0",
            "region": "江门",
            "intro": "不提供球和拍"
        }
    ]
}
```



###显示我预约的场馆
ps:该Api需要用户登陆
`GET`

`/Home/DateVenue/listsDate`

字段 | 描述 | 是否必须 | 数据类型 | 备注
--------------------- | ------------------- | ------------------- | ---------------------- | ------------------
page | 当前页码 | N | int | 默认为1
limit | 每页大小 | N |int | 默认为10

**Response**
```json
{
    "code": 20000,
    "response": [
        {
            "dv_id": "5",
            "subscriber": "1",
            "vi_id": "3",
            "date_time": "1423327220",
            "order_time": "1423326232",
            "ma_id": "1",
            "name": "市第三体育馆",
            "bought": "0",
            "price": "35"
        },
        {
            "dv_id": "1",
            "subscriber": "1",
            "vi_id": "1",
            "date_time": "1423159938",
            "order_time": "1423151968",
            "ma_id": "2",
            "name": "市第一体育馆",
            "bought": "1",
            "price": "25"
        },
        {
            "dv_id": "2",
            "subscriber": "1",
            "vi_id": "2",
            "date_time": "1423146000",
            "order_time": "1423145858",
            "ma_id": "2",
            "name": "超级体育馆",
            "bought": "1",
            "price": "25"
        }
    ]
}
```