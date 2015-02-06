Api dateVenue
===
>By zjien

`DateVenue 接口`

###约该场馆
ps:该Api需要用户登陆
`POST`

`/Home/DateVenue/date`

字段 | 描述 | 是否必须 | 数据类型 | 备注
--------------------- | ------------------- | ------------------- | ---------------------- | ------------------
vi_id | 对应场馆的vi_id | Y | int | 
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



###显示某场馆的基本信息
ps:该Api需要用户登陆
`POST`

`/Home/DateVenue/listsSpeVenue`

字段 | 描述 | 是否必须 | 数据类型 | 备注
--------------------- | ------------------- | ------------------- | ---------------------- | ------------------
vi_id | 对应场馆的vi_id | Y | int | 

**Response**
```json
{
    "code": 20000,
    "response": {
        "vi_id": "1",
        "name": "市第一体育馆",
        "picture": null,
        "type": "羽毛球 乒乓球",
        "price": "25",
        "bought": "0",
        "region": "江门",
        "intro": "提供场地，不提供球拍"
    }
}
```



###显示同城场馆
ps:该Api需要用户登陆
`POST`

`/Home/DateVenue/listsCityVenue`

字段 | 描述 | 是否必须 | 数据类型 | 备注
--------------------- | ------------------- | ------------------- | ---------------------- | ------------------
region | 实时位置 | Y | varchar | GPS获取位置

**Response**
```json
{
    "code": 20000,
    "response": [
        {
            "vi_id": "1",
            "name": "市第一体育馆",
            "picture": null,
            "type": "羽毛球 乒乓球",
            "price": "25",
            "bought": "0",
            "region": "江门",
            "intro": "提供场地，不提供球拍"
        },
        {
            "vi_id": "3",
            "name": "市第三体育馆",
            "picture": null,
            "type": "足球",
            "price": "35",
            "bought": "0",
            "region": "江门",
            "intro": "提供足球和场地"
        },
        {
            "vi_id": "5",
            "name": "网球体育馆",
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
`POST`

`/Home/DateVenue/listsDate`

**Response**
```json
{
    "code": 20000,
    "response": [
        {
            "dv_id": "4",
            "subscriber": "1",
            "vi_id": "1",
            "date_time": "1423159938",
            "order_time": "1423151968",
            "name": "市第一体育馆",
            "bought": "0",
            "price": "25"
        },
        {
            "dv_id": "2",
            "subscriber": "1",
            "vi_id": "2",
            "date_time": "1423146000",
            "order_time": "1423145858",
            "name": "市第二体育馆",
            "bought": "0",
            "price": "30"
        }
    ]
}
```