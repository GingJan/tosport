Api order
===
>By zjien

`Order 接口`

##该API只限管理员使用

###查看所有预约单（只能查看自己所创建的场馆的）
ps：该API需要登录
`POST`

`/Admin/Order/listsAllOrder`

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
            "dv_id": "1",
            "ma_id": "2",
            "subscriber": "1",
            "vi_id": "1",
            "date_time": "1423159938",
            "order_time": "1423151968",
            "done": null
        },
        {
            "dv_id": "2",
            "ma_id": "2",
            "subscriber": "1",
            "vi_id": "2",
            "date_time": "1423146000",
            "order_time": "1423145858",
            "done": "1"
        }
    ]
}
```



###查看特定场所的预约单（只能查看自己所创建的场馆的）
PS:该API需要登录
`POST`

`/Admin/Order/listsSpeOrder`

字段 | 描述 | 是否必须 | 数据类型 | 备注
------------- | ---------------- | ----------------- | ------------ | ------------------
vi_id | 所查场所的vi_id | Y | int |
page | 当前页码 | N | int | 默认为1
limit | 每页显示数 | N | int | 默认为10

**Response**
```json
{
    "code": 20000,
    "response": [
        {
            "dv_id": "1",
            "ma_id": "2",
            "subscriber": "1",
            "vi_id": "1",
            "date_time": "1423159938",
            "order_time": "1423151968",
            "done": null
        }
    ]
}
```



###查看未结单的预约单（只能查看自己所创建的场馆的）
PS:该API需要登录
`POST`

`/Admin/Order/listsUndone`

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
            "dv_id": "3",
            "ma_id": "3",
            "subscriber": "2",
            "vi_id": "4",
            "date_time": "1423159938",
            "order_time": "1423151959",
            "done": null
        }
    ]
}
```


###结单（只能结与本人相关的单）
PS:该API需要登录
`POST`

`/Admin/Order/doneOrder`

字段 | 描述 | 是否必须 | 数据类型 | 备注
------------- | ---------------- | ----------------- | ------------ | ------------------
dv_id | 被结单的dv_id | Y | int | 即dateVenue表的dv_id

**Response**
```json
{
    "code": 20000,
    "response": "结单成功"
}
```
