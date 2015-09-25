Api order
===
>By zjien

`Order 接口`

##员工
以下接口只适用于场馆员工

###查看预约订单列表
`GET`

`/Admin/Manager/listBooking`

字段 | 描述 | 是否必须 | 数据类型 | 备注
------------- | ---------------- | ----------------- | ------------ | ------------------
page | 当前页码 | N | int | 默认为1

**Response**
```json
{
    "code": 20000,
    "response": [
        {
            "dv_id": "5",
            "ma_id": "3",
            "subscriber": "2",
            "vi_id": "4",
            "date_time": "1423159938",
            "order_time": "1423151959",
            "done": 0
        },
	{
            "dv_id": "4",
            "ma_id": "3",
            "subscriber": "9",
            "vi_id": "4",
            "date_time": "1423159918",
            "order_time": "1423151929",
            "done": 0
        },
	{
            "dv_id": "3",
            "ma_id": "3",
            "subscriber": "5",
            "vi_id": "4",
            "date_time": "1423159908",
            "order_time": "1423151909",
            "done": 1
        }
    ]
}
```


###查看预约订单列表
`GET`

`/Admin/Manager/listOrderDetail`

字段解释
字段 | 描述 | 是否必须 | 数据类型 | 备注
------------- | ---------------- | ----------------- | ------------ | ------------------
dv_id | 本订单id |  | int |  
ma_id | 场馆管理员id |  | int |
subscriber | 预约人id |  | int |
vi_id | 场馆id |  | int |
date_time | 预约时间 |  | int |
order_time | 下单时间 |  | int |
done | 是否结单 |  | bool | 
nickname | 预约人昵称 |  | string |
sex | 预约人性别 |  | string |
phone | 预约人电话 |  | string |
email | 预约人电邮 |  | string |
intro | 预约人简介 |  | string |
birth | 预约人生日 |  | int | 
spt_favor | 预约人最喜欢的运动 |  | string |
region | 预约人所在城市 |  | string |

**Response**
```json
{
    "code": 20000,
    "response": {
        "dv_id": "3",
        "ma_id": "3",
        "subscriber": "2",
        "vi_id": "4",
        "date_time": "1423159938",
        "order_time": "1423151959",
        "done": "0",
        "nickname": "zjien1",
        "sex": "男",
        "phone": "15325468521",
        "email": "zjien1@qq.com",
        "intro": "我是zjien1",
        "birth": null,
        "spt_favor": "羽毛球",
        "region": "江门",
        "location": null,
        "ctime": "1422430617",
        "cIP": "127.0.0.1",
        "last_time": "1428842466",
        "last_IP": "127.0.0.1"
    }
}
```


###查看预约订单列表
`GET`

`/Admin/Manager/doneOrder`

字段 | 描述 | 是否必须 | 数据类型 | 备注
------------- | ---------------- | ----------------- | ------------ | ------------------
dv_id | 订单id | Y | int | 通过列表返回的数据获取

**Response**
```json
{
    "code": 20000,
    "response": "操作成功"
}
```