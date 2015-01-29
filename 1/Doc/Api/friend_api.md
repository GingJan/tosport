Api friend
===
>By zjien

`Friend 接口`

###添加好友
ps:该Api需要用户登陆
`POST`

`/Home/Friend/addFriend`

字段 | 描述 | 是否必须 | 数据类型 | 备注
--------------------- | ----------------- | ----------------- | ---------------------- | ------------------
u_id | 朋友的u_id | Y | int | 

**Response**
```json
{
	"code":20000,
	"response":"关注成功"
}
```



###删除好友关系
ps:该Api需要用户登陆
`POST`

`/Home/Friend/deleteFriend`

字段 | 描述 | 是否必须 | 数据类型 | 备注
--------------------- | ----------------- | ----------------- | ---------------------- | ------------------
f_id | 朋友表对应的f_id | Y | int | friends表对应的id号:f_id

**Response**
```json
{
	"code":20000,
	"response":"删除成功"
}
```



###显示个人的朋友表
ps:该Api需要登陆
`POST`

`/Home/Friend/listsFriend`

字段 | 描述 | 是否必须 | 数据类型 | 备注
--------------------- | ----------------- | ----------------- | ---------------------- | ------------------
page | 当前页码 | N | int | 默认1
limit | 每页显示多少条 | N | int | 默认15 

**Response**
```json
{
    "code": 20000,
    "response": [
        {
            "u_id": "8",
            "nickname": "xiaoming5",
            "sex": null,
            "avatar": null,
            "f_id": "7"
        },
        {
            "u_id": "7",
            "nickname": "xiaoming4",
            "sex": null,
            "avatar": null,
            "f_id": "6"
        }
    ]
}
```