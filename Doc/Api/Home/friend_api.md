Api friend
===
>By zjien

`Friend 接口`

###关注其他用户
ps:该Api需要用户登陆

PPS：该接口有可能修改
`POST`

`/Home/Friend/addFriend`

字段 | 描述 | 是否必须 | 数据类型 | 备注
--------------------- | ----------------- | ----------------- | ---------------------- | ------------------
u_id | 对方u_id | Y | int | A关注B，不代表A和B相互建立关系

**Response**
```json
{
    "code": 20000,
    "response": "关注成功"
}
```



###取消关注
ps:该Api需要用户登陆
`POST`

`/Home/Friend/deleteFriend`

字段 | 描述 | 是否必须 | 数据类型 | 备注
--------------------- | ----------------- | ----------------- | ---------------------- | ------------------
f_id | 朋友表对应的f_id | Y | int | friends表对应的id号:f_id

**Response**
```json
{
    "code": 20000,
    "response": "取消关注成功"
}
```



###显示我关注的人
ps:该Api需要登陆
`GET`

`/Home/Friend/listsFriend`

字段 | 描述 | 是否必须 | 数据类型 | 备注
--------------------- | ----------------- | ----------------- | ---------------------- | ------------------
page | 当前页码 | N | int | 默认1
limit | 每页显示多少条 | N | int | 默认10 

**Response**
```json
{
    "code": 20000,
    "response": [
        {
            "u_id": "3",
            "nickname": "zjien3",
            "sex": "男",
            "avatar": null,
            "region": "广州",
            "f_id": "2"
        },
        {
            "u_id": "2",
            "nickname": "zjien1",
            "sex": "男",
            "avatar": null,
            "region": "江门",
            "f_id": "1"
        }
    ]
}
```